<?php

namespace App\Providers;

use App\Models\Category;
use App\Models\WhatsappNumber;
use Illuminate\Support\Facades\View;
use Illuminate\Support\Facades\Blade;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    public function register(): void
    {
        //
    }

    public function boot(): void
    {
        // Share categories ke header
        View::composer('components.header', function ($view) {
            $view->with('categories', Category::all());
        });

        // Blade directive untuk json encode
        Blade::directive('js', function ($expression) {
            return "<?php echo json_encode($expression, JSON_HEX_TAG | JSON_HEX_APOS | JSON_HEX_AMP | JSON_HEX_QUOT); ?>";
        });

        // Mapping route ke page_name
        $pageMap = [
            'home' => 'Home',
            'products.index' => 'Products',
            'products.show' => 'Products',
            'cart.index' => 'Cart',
            // Tambah sesuai route kamu
        ];
        View::composer('components.footer', function ($view) use ($pageMap) {
            $currentRoute = Route::currentRouteName() ?? 'home';
            // Exclude admin routes supaya footer WA kosong di dashboard
            if (str_starts_with($currentRoute, 'admin.')) {
                $view->with('whatsappNumbers', collect());  // Kirim koleksi kosong, supaya di blade aman
                return;
            }
            $pageName = $pageMap[$currentRoute] ?? 'Home';
            // Ambil nomor WA aktif untuk halaman ini dan posisi 'footer'
            $whatsappNumbers = WhatsappNumber::getActiveByPageAndPosition($pageName, 'footer');
            $view->with('whatsappNumbers', $whatsappNumbers);
        });

        // Jika kamu ingin share WA numbers di view lain (misal product card), buat composer lain
        // Contoh:
        // View::composer('components.product-card', function ($view) use ($pageMap) {
        //     // logic serupa dengan posisi 'product_card'
        // });
    }
}
