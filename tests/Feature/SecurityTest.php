<?php

use App\Models\Category;
use App\Models\Product;
use App\Models\Testimonial;

it('sanitizes product description html before rendering public product pages', function () {
    $category = Category::create(['name' => 'Security Jersey']);
    $product = Product::create([
        'name' => 'XSS Test Jersey',
        'price' => 100000,
        'description' => '<p onclick="alert(1)">Aman <strong>dipakai</strong></p><script>alert("xss")</script><a href="javascript:alert(1)">bad</a>',
        'category_id' => $category->id,
    ]);

    $response = $this->get(route('product-page', $product));

    $response
        ->assertOk()
        ->assertSee('<strong>dipakai</strong>', false)
        ->assertDontSee('alert("xss")', false)
        ->assertDontSee('onclick="alert(1)"', false)
        ->assertDontSee('javascript:', false);
});

it('sanitizes testimonial messages before rendering public testimonial pages', function () {
    Testimonial::create([
        'name' => 'Security Customer',
        'message' => '<img src=x onerror="alert(1)">Review aman<script>alert("xss")</script>',
    ]);

    $response = $this->get(route('testimonials'));

    $response
        ->assertOk()
        ->assertSee('Review aman')
        ->assertDontSee('alert("xss")', false)
        ->assertDontSee('onerror', false)
        ->assertDontSee('<img src=x', false);
});

it('ignores client supplied discount values when adding products to cart', function () {
    $category = Category::create(['name' => 'Cart Security']);
    $product = Product::create([
        'name' => 'Full Price Jersey',
        'price' => 100000,
        'description' => 'Produk tanpa diskon aktif.',
        'category_id' => $category->id,
    ]);

    $this->post(route('cart.add', $product), [
        'qty' => 2,
        'discount_percentage' => 99,
        'discounted_price' => 1000,
    ])->assertRedirect(route('cart.index'));

    $cart = session('cart');
    $cartItem = $cart[$product->id.'-'];

    expect($cartItem['price'])->toBe(100000)
        ->and($cartItem['discount_percentage'])->toBe(0)
        ->and($cartItem['has_discount'])->toBeFalse();
});
