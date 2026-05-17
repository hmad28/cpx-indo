<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Diskon;
use App\Models\Faq;
use App\Models\Product;
use App\Models\Testimonial;
use App\Models\WhatsappNumber;
use Illuminate\Support\Carbon;

class DashboardController extends Controller
{
    public function __invoke()
    {
        $today = Carbon::today();

        $productCount = Product::count();
        $categoryCount = Category::count();
        $testimonialCount = Testimonial::count();
        $faqCount = Faq::count();
        $bestSellerCount = Product::where('is_best_seller', true)->count();
        $activeWhatsappCount = WhatsappNumber::active()->count();
        $activeDiscountCount = Diskon::where('status', 'active')
            ->whereDate('start_date', '<=', $today)
            ->whereDate('end_date', '>=', $today)
            ->count();

        $latestProducts = Product::with('category')
            ->latest()
            ->take(5)
            ->get();

        $topCategories = Category::withCount('products')
            ->orderByDesc('products_count')
            ->take(5)
            ->get();

        $discountsEndingSoon = Diskon::with('product')
            ->where('status', 'active')
            ->whereDate('end_date', '>=', $today)
            ->orderBy('end_date')
            ->take(4)
            ->get();

        return view('dashboard.index', compact(
            'productCount',
            'categoryCount',
            'testimonialCount',
            'faqCount',
            'bestSellerCount',
            'activeWhatsappCount',
            'activeDiscountCount',
            'latestProducts',
            'topCategories',
            'discountsEndingSoon',
        ));
    }
}
