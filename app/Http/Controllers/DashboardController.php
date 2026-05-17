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
    public function index()
    {
        $today = Carbon::today();
        $startOfMonth = Carbon::now()->startOfMonth();

        $productCount = Product::count();
        $categoryCount = Category::count();
        $testimonialCount = Testimonial::count();
        $faqCount = Faq::count();
        $bestSellerCount = Product::where('is_best_seller', true)->count();
        $whatsappCount = WhatsappNumber::where('is_active', true)->count();

        $activeDiscounts = Diskon::with('product:id,name,price,image,slug')
            ->where('status', 'active')
            ->whereDate('start_date', '<=', $today)
            ->whereDate('end_date', '>=', $today)
            ->orderByDesc('discount_percentage')
            ->get();

        $activeDiscountCount = $activeDiscounts->count();

        $newProductsThisMonth = Product::where('created_at', '>=', $startOfMonth)->count();
        $newTestimonialsThisMonth = Testimonial::where('created_at', '>=', $startOfMonth)->count();

        $avgPrice = (int) round(Product::avg('price') ?? 0);

        $recentProducts = Product::with('category:id,name')
            ->latest()
            ->take(5)
            ->get();

        $latestTestimonials = Testimonial::latest()->take(4)->get();

        $productsByCategory = Category::withCount('products')
            ->orderByDesc('products_count')
            ->get();

        $maxCategoryCount = $productsByCategory->max('products_count') ?: 1;

        $latestFaqs = Faq::latest()->take(3)->get();

        return view('dashboard.index', compact(
            'productCount',
            'categoryCount',
            'testimonialCount',
            'faqCount',
            'bestSellerCount',
            'whatsappCount',
            'activeDiscountCount',
            'activeDiscounts',
            'newProductsThisMonth',
            'newTestimonialsThisMonth',
            'avgPrice',
            'recentProducts',
            'latestTestimonials',
            'productsByCategory',
            'maxCategoryCount',
            'latestFaqs'
        ));
    }
}
