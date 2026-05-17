<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Product;
use App\Models\ProductImage;
use App\Models\Size;
use App\Models\WhatsappNumber;
use App\Support\HtmlSanitizer;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Str;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $products = Product::paginate(8);
        $categories = Category::all();
        $sizes = Size::all();

        return view('admin.products.index', compact(['products', 'categories', 'sizes']));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|max:100',
            'price' => 'required|numeric',
            'size_image' => 'required|image|mimes:jpg,jpeg,png,webp|max:5120',
            'description' => 'required|max:2000',
            'kelebihan' => 'nullable|array',
            'kelebihan.*' => 'nullable|string|max:255',
            'category_id' => 'required|exists:categories,id',
            'sizes' => 'array',
            'sizes.*' => 'exists:sizes,id',
            // gallery
            'images' => 'required|array|max:8',
            'images.*' => 'image|mimes:jpg,jpeg,png,webp|max:5120',
        ]);

        // Simpan size image
        $sizeImage = $request->file('size_image');
        $sizeImageName = time().'_'.Str::random(6).'.'.$sizeImage->extension();
        $sizeImage->move(public_path('images'), $sizeImageName);

        $imageName = null;

        // proses gallery (images[])
        if ($request->hasFile('images')) {
            $files = $request->file('images');

            if (count($files) > 0) {
                // ambil gambar pertama jadi image utama
                $mainImage = $files[0];
                $imageName = time().'_main.'.$mainImage->extension();
                $mainImage->move(public_path('images'), $imageName);
            }
        }

        $product = Product::create([
            'name' => $request->name,
            'price' => $request->price,
            'image' => $imageName ?? 'default.jpg', // fallback biar gak error
            'size_image' => $sizeImageName,
            'description' => HtmlSanitizer::clean($request->description),
            'kelebihan' => json_encode($request->kelebihan ?? []),
            'category_id' => $request->category_id,
        ]);

        $product->sizes()->sync($request->sizes ?? []);

        // simpan sisanya ke product_images
        if ($request->hasFile('images')) {
            $files = $request->file('images');

            // skip gambar pertama (sudah dipakai sebagai image utama)
            foreach (array_slice($files, 1) as $file) {
                $filename = time().'_'.Str::random(8).'.'.$file->extension();
                $file->move(public_path('images'), $filename);

                $product->images()->create([
                    'path' => $filename,
                ]);
            }
        }

        return redirect()->route('products.index')->with('success', 'Produk berhasil ditambahkan!');
    }

    /**
     * Display the specified resource.
     */
    public function show(Product $product)
    {
        // Eager load relasi diskons (dan yang lain jika perlu)
        $product->load('diskons'); // Load diskons untuk produk ini
        $products = Product::with('category', 'diskons')->paginate(4)->map(function ($product) {
            $product->is_new = $product->created_at ? $product->created_at->gt(now()->subDays(30)) : false;

            $today = now()->startOfDay();
            $activeDiscount = $product->diskons
                ->where('status', 'active')
                ->where('start_date', '<=', $today)
                ->where('end_date', '>=', $today)
                ->sortByDesc('discount_percentage')
                ->first();

            if ($activeDiscount) {
                $product->has_discount = true;
                $product->discount_percentage = $activeDiscount->discount_percentage;
                $product->discounted_price = round($product->price * (1 - $activeDiscount->discount_percentage / 100));
            } else {
                $product->has_discount = false;
                $product->discount_percentage = 0;
                $product->discounted_price = $product->price;
            }

            $product->discounted_price_formatted = number_format($product->discounted_price, 0, ',', '.');
            $product->original_price = $product->price;
            $product->display_price = $product->price;

            return $product;
        }); // Tetap sama (mungkin produk terkait?)
        $sizes = $product->sizes;
        $images = $product->images; // Ambil multiple images, diurutkan berdasarkan position
        // Cek diskon aktif (ambil yang persentase tertinggi jika multiple)
        $activeDiscount = $product->diskons
            ->where('status', 'active')
            ->where('start_date', '<=', Carbon::today())
            ->where('end_date', '>=', Carbon::today())
            ->sortByDesc('discount_percentage')
            ->first(); // Atau ->first() jika prioritas urutan ID
        $hasDiscount = ! is_null($activeDiscount);
        $discountPercentage = $hasDiscount ? $activeDiscount->discount_percentage : 0;
        $discountedPrice = $hasDiscount ? round($product->price * (1 - $discountPercentage / 100)) : $product->price; // Round ke integer jika harga integer
        // Pass variabel tambahan ke view

        $footerNumbers = WhatsappNumber::getActiveByPageAndPosition('Home', 'footer');
        $productCardNumbers = WhatsappNumber::getActiveByPageAndPosition('Home', 'product_card');

        return view('product-page', compact('product', 'sizes', 'products', 'images', 'hasDiscount', 'discountPercentage', 'discountedPrice', 'productCardNumbers'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Product $product)
    {
        $data = $request->validate([
            'name' => 'sometimes|max:100',
            'price' => 'sometimes|numeric',
            'size_image' => 'sometimes|image|mimes:jpg,jpeg,png,webp|max:5120',
            'description' => 'sometimes|max:2000',
            'kelebihan' => 'sometimes|array',
            'kelebihan.*' => 'nullable|string|max:255',
            'category_id' => 'sometimes|exists:categories,id',
            'sizes' => 'sometimes|array',
            'sizes.*' => 'exists:sizes,id',
            'images' => 'nullable|array|max:8',
            'images.*' => 'nullable|image|mimes:jpg,jpeg,png,webp|max:5120',
            'delete_images' => 'nullable|array',
            'delete_images.*' => 'integer|exists:product_images,id',
            'delete_size_image' => 'nullable|integer|exists:products,id',  // Flag untuk delete size_image (value = product ID)
        ]);

        // Handle kelebihan (JSON encode)
        if (array_key_exists('description', $data)) {
            $data['description'] = HtmlSanitizer::clean($data['description']);
        }

        // Handle kelebihan (JSON encode)
        if ($request->filled('kelebihan')) {
            $data['kelebihan'] = json_encode($request->kelebihan);
        }

        // Handle size_image: upload baru atau delete
        if ($request->hasFile('size_image')) {
            // Hapus old size_image jika ada
            if ($product->size_image && File::exists(public_path('images/'.$product->size_image))) {
                File::delete(public_path('images/'.$product->size_image));
            }
            $sizeImage = $request->file('size_image');
            $sizeImageName = time().'_'.Str::random(6).'.'.$sizeImage->extension();
            $sizeImage->move(public_path('images'), $sizeImageName);
            $data['size_image'] = $sizeImageName;
        } elseif ($request->filled('delete_size_image')) {
            // Hapus existing size_image jika flag delete ada
            if ($product->size_image && File::exists(public_path('images/'.$product->size_image))) {
                File::delete(public_path('images/'.$product->size_image));
            }
            $data['size_image'] = null;  // Set ke null di DB
        }

        // DELETE existing images terlebih dahulu (berdasarkan delete_images[])
        if ($request->has('delete_images')) {
            $toDelete = ProductImage::whereIn('id', $request->delete_images)
                ->where('product_id', $product->id)
                ->get();

            foreach ($toDelete as $img) {
                if (File::exists(public_path('images/'.$img->path))) {
                    File::delete(public_path('images/'.$img->path));
                }
                $img->delete();
            }
        }

        // Cek total files setelah hapus (existing + new) tidak boleh > 8
        $existingCount = $product->images()->count();  // Sudah dikurangi yang dihapus
        $newFiles = $request->file('images', []);

        if ($existingCount + count($newFiles) > 8) {
            return back()->withErrors(['images' => 'Total gambar tidak boleh lebih dari 8.']);
        }

        // Upload new images
        if (! empty($newFiles)) {
            foreach ($newFiles as $file) {
                $filename = time().'_'.Str::random(8).'.'.$file->extension();
                $file->move(public_path('images'), $filename);
                $product->images()->create(['path' => $filename]);
            }
        }

        // Update data product (tanpa images dan sizes, karena sudah di-handle terpisah)
        $product->update($data);

        // Sync sizes (many-to-many)
        $product->sizes()->sync($request->sizes ?? []);

        return redirect()->route('products.index')->with('success', 'Produk berhasil diperbarui!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Product $product)
    {
        foreach ($product->images as $img) {
            if (File::exists(public_path('images/'.$img->path))) {
                File::delete(public_path('images/'.$img->path));
            }
        }
        // optional: delete main images too
        if ($product->image && File::exists(public_path('images/'.$product->image))) {
            File::delete(public_path('images/'.$product->image));
        }
        if ($product->size_image && File::exists(public_path('images/'.$product->size_image))) {
            File::delete(public_path('images/'.$product->size_image));
        }

        $product->delete();

        return redirect()->route('products.index')->with('success', 'The product '.$product->name.' has been deleted successfully!');
    }

    public function setBestSeller(Request $request, Product $product)
    {
        $product->update([
            'is_best_seller' => $request->boolean('is_best_seller'),
        ]);

        return redirect()->back()->with('success', 'Produk berhasil diperbarui sebagai Best Seller');
    }

    public function byCategory($slug)
    {
        $productCardNumbers = WhatsappNumber::getActiveByPageAndPosition('Home', 'product_card');

        $category = Category::where('slug', $slug)->firstOrFail();
        $products = Product::where('category_id', $category->id)->get();

        return view('our-products', [
            'products' => $products,
            'activeCategory' => $category, // penting buat ditampilin di view
            'productCardNumbers' => $productCardNumbers,
        ]);
    }
}
