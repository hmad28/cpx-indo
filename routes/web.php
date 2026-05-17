<?php

use Carbon\Carbon;
use App\Models\Faq;
use App\Models\Product;
use App\Models\Category;
use App\Models\Testimonial;
use Illuminate\Http\Request;
use App\Models\WhatsappNumber;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\FaqController;
use App\Http\Controllers\CartController;
use App\Http\Controllers\DiskonController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\DiscountController;
use App\Http\Controllers\BestSellerController;
use App\Http\Controllers\Admin\ProductController;
use App\Http\Controllers\Admin\CategoryController;
use App\Http\Controllers\WhatsappNumberController;
use App\Http\Controllers\Admin\TestimonialController;

Route::get('/login', function () {
    return view('welcome');
});

Route::get('/profile', function () {
    return view('profile.edit');
});

Route::get('/', function () {
    $products = Product::with(['category', 'diskons']) // Eager load diskons
        // ->latest() // Uncomment jika mau sort terbaru
        ->take(8)
        ->get()
        ->map(function ($product) {
            // Logic existing: is_new
            $product->is_new = $product->created_at 
                ? $product->created_at->gt(now()->subDays(30)) 
                : false;
            // Logic diskon: Cek aktif dan set atribut
            $activeDiscount = $product->diskons
                ->where('status', 'active')
                ->where('start_date', '<=', Carbon::today())
                ->where('end_date', '>=', Carbon::today())
                ->sortByDesc('discount_percentage')
                ->first();
            $product->has_discount = !is_null($activeDiscount);
            $product->discount_percentage = $product->has_discount ? $activeDiscount->discount_percentage : 0;
            $product->discounted_price = $product->has_discount ? round($product->price * (1 - $product->discount_percentage / 100)) : $product->price;
            $product->display_price = $product->discounted_price; // Raw number untuk calc
            return $product;
        });

    // Ambil nomor WA untuk footer dan produk card sekaligus
    $footerNumbers = WhatsappNumber::getActiveByPageAndPosition('Home', 'footer');
    $productCardNumbers = WhatsappNumber::getActiveByPageAndPosition('Home', 'product_card');

    return view('home', compact('products', 'footerNumbers', 'productCardNumbers'));
})->name('home');

Route::get('/our-products', function (Request $request) {
    $query = Product::with(['category', 'diskons']); // Tambah 'diskons' untuk eager load
    if ($request->filled('keyword')) {
        $keyword = $request->keyword;
        $query->where('name', 'like', "%{$keyword}%")
              ->orWhereHas('category', function ($q) use ($keyword) {
                  $q->where('name', 'like', "%{$keyword}%");
              });
    }
    $products = $query->get()->map(function ($product) {
        // Existing: Mark new product
        $product->is_new = $product->created_at 
            ? $product->created_at->gt(now()->subDays(30)) 
            : false;
        // New: Cek diskon aktif (mirip CartController fallback)
        $today = Carbon::today();
        $activeDiscount = $product->diskons
            ->where('status', 'active')
            ->where('start_date', '<=', $today)
            ->where('end_date', '>=', $today)
            ->sortByDesc('discount_percentage') // Ambil yang tertinggi %
            ->first();
        if ($activeDiscount) {
            $discountPercentage = $activeDiscount->discount_percentage;
            $discountedPrice = round($product->price * (1 - $discountPercentage / 100));
            $product->has_discount = true;
            $product->discount_percentage = $discountPercentage;
            $product->discounted_price = $discountedPrice;
            $product->discounted_price_formatted = number_format($discountedPrice, 0, ',', '.');
        } else {
            // No diskon: Fallback ke harga normal
            $product->has_discount = false;
            $product->discount_percentage = 0;
            $product->discounted_price = $product->price;
            $product->discounted_price_formatted = number_format($product->price, 0, ',', '.');
        }
        return $product;
    });
    $productCardNumbers = WhatsappNumber::getActiveByPageAndPosition('Home', 'product_card');
    return view('our-products', compact('products', 'productCardNumbers'));
})->name('our-products');

Route::get('/our-products/{category:slug}', [ProductController::class, 'byCategory'])->name('products.byCategory');

Route::get('/about', function () {
    $faqs = Faq::all();
    return view('about', compact('faqs'));
})->name('about');

Route::get('/testimonials', function () {
    $testimonials = Testimonial::all();
    return view('testimonials', compact('testimonials'));
})->name('testimonials');

Route::get('/custom', function () {
    $customJerseyNumber = WhatsappNumber::getActiveByPageAndPosition('Custom', 'custom_section');

    // dd($customJerseyNumber);
    return view('custom', compact('customJerseyNumber'));
})->name('custom');

Route::get('/product-page/{product:slug}', [ProductController::class, 'show'])->name('product-page');


Route::get('/dashboard', [DashboardController::class, 'index'])
    ->middleware(['auth', 'verified'])
    ->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';

Route::get('/cart', [CartController::class, 'index'])->name('cart.index');
Route::post('/cart/add/{product}', [CartController::class, 'add'])->name('cart.add');
Route::get('/cart/checkout', [CartController::class, 'checkout'])->name('cart.checkout');
Route::delete('/cart/remove/{id}', [CartController::class, 'remove'])->name('cart.remove');
Route::post('/cart/update/{product}', [CartController::class, 'updateQty'])->name('cart.update');
Route::post('/cart/update-qty', [CartController::class, 'updateQty'])->name('cart.updateQty');

Route::middleware(['auth'])->prefix('admin')->group(function () {
    Route::resource('products', ProductController::class);
    Route::resource('categories', CategoryController::class);
    Route::resource('testimonials', TestimonialController::class);
    Route::resource('faq', FaqController::class);
});

Route::get('/size-guide', function () {
    return view('sizes');
})->name('sizes');

Route::prefix('/dashboard/manage-best-seller')->name('best-seller.')->group(function () {
    Route::get('/', [BestSellerController::class, 'index'])->name('index');
    Route::post('/', [BestSellerController::class, 'store'])->name('store');
    Route::delete('/{id}', [BestSellerController::class, 'destroy'])->name('destroy');
});

// Routes untuk kelola diskon
Route::get('/diskons', [DiskonController::class, 'index'])->name('diskons.index');
Route::post('/diskons', [DiskonController::class, 'store'])->name('diskons.store');
Route::delete('/diskons/{diskon}', [DiskonController::class, 'destroy'])->name('diskons.destroy');



Route::prefix('admin')->name('admin.')->group(function () {  // Jika pakai prefix admin
    Route::get('/whatsapp-numbers', [WhatsappNumberController::class, 'index'])->name('whatsapp-numbers.index');
    Route::post('/whatsapp-numbers', [WhatsappNumberController::class, 'store'])->name('whatsapp-numbers.store');
    Route::put('/whatsapp-numbers/{whatsappNumber}', [WhatsappNumberController::class, 'update'])->name('whatsapp-numbers.update');
    Route::delete('/whatsapp-numbers/{whatsappNumber}', [WhatsappNumberController::class, 'destroy'])->name('whatsapp-numbers.destroy');
});