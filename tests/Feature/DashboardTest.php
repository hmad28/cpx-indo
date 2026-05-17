<?php

use App\Models\Category;
use App\Models\Diskon;
use App\Models\Faq;
use App\Models\Product;
use App\Models\Testimonial;
use App\Models\User;
use App\Models\WhatsappNumber;
use Illuminate\Support\Carbon;

it('renders the improved admin dashboard with operational data', function () {
    $user = User::factory()->create();
    $category = Category::create(['name' => 'Jersey Premium']);
    $product = Product::create([
        'name' => 'CPX Home Jersey',
        'price' => 250000,
        'description' => 'Jersey home CPX untuk testing dashboard.',
        'category_id' => $category->id,
    ]);
    $product->is_best_seller = true;
    $product->save();

    Diskon::create([
        'product_id' => $product->id,
        'discount_percentage' => 15,
        'start_date' => Carbon::today()->subDay(),
        'end_date' => Carbon::today()->addDays(3),
        'status' => 'active',
    ]);
    Faq::create(['question' => 'Bagaimana cara order?', 'answer' => 'Hubungi WhatsApp admin.']);
    Testimonial::create(['name' => 'Raka', 'message' => 'Bahannya nyaman.']);
    WhatsappNumber::create([
        'page_name' => 'Home',
        'position' => 'footer',
        'phone_number' => '081234567890',
        'display_name' => 'Admin CPX',
        'message' => 'Halo CPX',
        'is_active' => true,
    ]);

    $response = $this->actingAs($user)->get(route('dashboard'));

    $response
        ->assertOk()
        ->assertSee('CPX Command Center')
        ->assertSee('Skor kelengkapan')
        ->assertSee('100%')
        ->assertSee('CPX Home Jersey')
        ->assertSee('Jersey Premium')
        ->assertSee('Diskon berjalan')
        ->assertSee('15%')
        ->assertSee('Nomor WhatsApp');
});

it('protects dashboard management routes from guests', function (string $routeName) {
    $this->get(route($routeName))->assertRedirect(route('login'));
})->with([
    'best-seller.index',
    'diskons.index',
    'admin.whatsapp-numbers.index',
]);
