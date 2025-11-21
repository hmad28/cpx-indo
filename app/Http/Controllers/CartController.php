<?php

namespace App\Http\Controllers;

use App\Models\Size;
use App\Models\Product;
use Illuminate\Http\Request;
use App\Models\WhatsappNumber;
use Carbon\Carbon; // Jika perlu fallback cek diskon di add (opsional)

class CartController extends Controller
{
    public function index(Request $request)
    {
        $products = Product::with('category', 'diskons')->paginate(3)->map(function ($product) {
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
        });
        $cart = session()->get('cart', []);
        $footerNumbers = WhatsappNumber::getActiveByPageAndPosition('Home', 'footer');
        $productCardNumbers = WhatsappNumber::getActiveByPageAndPosition('Home', 'product_card');
        return view('cart.index', compact(['cart', 'products', 'productCardNumbers', 'footerNumbers']));
    }

    public function add(Request $request, Product $product)
    {
        $cart = session()->get('cart', []);
        $qty = $request->input('qty', 1);
        $size = $request->input('size'); // ambil dari radio button

        // Capture diskon dari hidden inputs (dari form product/home)
        $originalPrice = $product->price;
        $discountPercentage = (float) $request->input('discount_percentage', 0);
        $discountedPrice = $discountPercentage > 0 
            ? round($originalPrice * (1 - $discountPercentage / 100)) 
            : $originalPrice;
        $hasDiscount = $discountPercentage > 0;

        // Fallback: Jika tidak ada hidden, cek diskon aktif dari DB (opsional, untuk kompatibilitas)
        if (!$hasDiscount) {
            $activeDiscount = $product->diskons
                ->where('status', 'active')
                ->where('start_date', '<=', Carbon::today())
                ->where('end_date', '>=', Carbon::today())
                ->sortByDesc('discount_percentage')
                ->first();
            if ($activeDiscount) {
                $discountPercentage = $activeDiscount->discount_percentage;
                $discountedPrice = round($originalPrice * (1 - $discountPercentage / 100));
                $hasDiscount = true;
            }
        }

        // bikin key unik supaya size berbeda tetap bisa masuk cart
        $cartKey = $product->id . '-' . $size;

        $cart[$cartKey] = [
            'image' => $product->image,
            'name' => $product->name,
            'qty' => ($cart[$cartKey]['qty'] ?? 0) + $qty,
            'price' => $discountedPrice, // Pakai discounted sebagai base untuk subtotal/total
            'original_price' => $originalPrice, // Harga asli untuk tampilan strikethrough
            'discount_percentage' => $discountPercentage, // Untuk badge
            'has_discount' => $hasDiscount, // Boolean untuk kondisi view
            'size' => $size,
            'slug' => $product->slug,
        ];

        session()->put('cart', $cart);

        return redirect()->route('cart.index');
    }

    public function checkout()
    {
        $cart = session()->get('cart', []);
        $total = 0;
        $message = "Halo, saya mau pesan:\n";
        
        foreach($cart as $c){
            $subtotal = $c['qty'] * $c['price'];
            $total += $subtotal;
            $priceText = $c['has_discount'] 
                ? "Rp " . number_format($c['original_price'], 0, ',', '.') . " (Diskon " . $c['discount_percentage'] . "% = Rp " . number_format($subtotal / $c['qty'], 0, ',', '.') . ")"
                : "Rp " . number_format($subtotal / $c['qty'], 0, ',', '.');
            $message .= "- {$c['name']} (Size: {$c['size']}) x{$c['qty']} = {$priceText}\n";
        }
        $message .= "\nTotal: Rp " . number_format($total, 0, ',', '.');

        // Ambil data WhatsApp number
        $whatsappData = WhatsappNumber::getActiveByPageAndPosition('Cart', 'cart_section');
        
        // Cek apakah ada data
        if ($whatsappData->isEmpty()) {
            return back()->with('error', 'Nomor WhatsApp tidak ditemukan');
        }
        
        // Ambil nomor telepon dari item pertama
        $phoneNumber = $whatsappData->first()->phone_number;
        
        // Format nomor (tambahkan 62 jika dimulai dengan 0)
        if (substr($phoneNumber, 0, 1) === '0') {
            $phoneNumber = '62' . substr($phoneNumber, 1);
        }
        
        // Buat URL WhatsApp
        $waUrl = "https://wa.me/{$phoneNumber}?text=" . urlencode($message);

        return redirect($waUrl);
    }

    public function remove($id)
    {
        $cart = session()->get('cart', []);
        if(isset($cart[$id])) {
            unset($cart[$id]);
            session()->put('cart', $cart);
        }
        return redirect()->route('cart.index');
    }

    public function updateQty(Request $request)
    {
        $productId = $request->input('product_id');
        $qty = $request->input('qty');

        $cart = session()->get('cart', []);

        if (isset($cart[$productId])) {
            $cart[$productId]['qty'] = $qty;
            session()->put('cart', $cart);

            $subtotal = $cart[$productId]['qty'] * $cart[$productId]['price']; // Pakai discounted
            $total = collect($cart)->sum(fn($item) => $item['qty'] * $item['price']);

            return response()->json([
                'success' => true,
                'subtotal' => number_format($subtotal, 0, ',', '.'),
                'total' => number_format($total, 0, ',', '.')
            ]);
        }

        return response()->json(['success' => false]);
    }
}
