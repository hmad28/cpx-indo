<?php

namespace Database\Seeders;

use App\Models\Category;
use App\Models\Diskon;
use App\Models\Faq;
use App\Models\Product;
use App\Models\Testimonial;
use App\Models\User;
use App\Models\WhatsappNumber;
use Illuminate\Database\Seeder;
use Illuminate\Support\Carbon;

class DashboardDemoSeeder extends Seeder
{
    public function run(): void
    {
        if (! User::where('email', 'admin@cpx.test')->exists()) {
            User::create([
                'name' => 'Admin CPX',
                'username' => 'admin',
                'email' => 'admin@cpx.test',
                'password' => bcrypt('password'),
                'email_verified_at' => now(),
            ]);
        }

        $categoryNames = [
            'Jersey Futsal',
            'Jersey Sepak Bola',
            'Jersey Basket',
            'Jersey Sepeda',
            'Jersey Custom',
            'Setelan Olahraga',
        ];

        $categories = collect($categoryNames)->map(function ($name) {
            return Category::firstOrCreate(['name' => $name]);
        });

        $sampleProducts = [
            ['Jersey Real Madrid Home', 145000, 'Jersey Sepak Bola', true,  18],
            ['Jersey Manchester City Away', 135000, 'Jersey Sepak Bola', true,  null],
            ['Jersey PSG Limited Edition', 165000, 'Jersey Sepak Bola', false, 25],
            ['Jersey Futsal Pro Series', 110000, 'Jersey Futsal', true,  10],
            ['Jersey Futsal Classic Stripe', 95000,  'Jersey Futsal', false, null],
            ['Jersey Basket NBA Lakers', 175000, 'Jersey Basket', true,  null],
            ['Jersey Basket Custom Team', 155000, 'Jersey Basket', false, 15],
            ['Jersey Sepeda Aero Light', 220000, 'Jersey Sepeda', false, null],
            ['Jersey Sepeda Mountain Trail', 198000, 'Jersey Sepeda', false, 12],
            ['Jersey Custom Team Esport', 130000, 'Jersey Custom', true,  20],
            ['Jersey Custom Komunitas Lari', 125000, 'Jersey Custom', false, null],
            ['Setelan Latihan Premium', 185000, 'Setelan Olahraga', true,  null],
            ['Setelan Training Junior', 125000, 'Setelan Olahraga', false, 30],
        ];

        foreach ($sampleProducts as $i => [$name, $price, $catName, $best, $disc]) {
            $cat = $categories->firstWhere('name', $catName);
            $product = Product::firstOrCreate(
                ['name' => $name],
                [
                    'price' => $price,
                    'image' => 'insertpichere.jpg',
                    'description' => 'Jersey berbahan premium, breathable, dan nyaman dipakai untuk segala aktivitas.',
                    'kelebihan' => json_encode(['Bahan premium', 'Cepat menyerap keringat', 'Jahitan rapi']),
                    'category_id' => $cat?->id,
                    'is_best_seller' => $best ? 1 : 0,
                    'created_at' => now()->subDays($i * 2),
                    'updated_at' => now()->subDays($i * 2),
                ]
            );

            if ($disc !== null) {
                Diskon::firstOrCreate(
                    ['product_id' => $product->id],
                    [
                        'discount_percentage' => $disc,
                        'start_date' => Carbon::today()->subDays(2),
                        'end_date' => Carbon::today()->addDays(15),
                        'status' => 'active',
                    ]
                );
            }
        }

        $testimonials = [
            ['Andi Saputra', 'Kapten Tim Garuda FC', 'Kualitas bahannya juara, tim kami pakai berbulan-bulan tanpa luntur warnanya.'],
            ['Rina Lestari', 'Manajer Komunitas Lari', 'Pengerjaan custom cepat dan hasilnya sesuai desain. Recommended banget!'],
            ['Bagas Pradipta', 'Pelatih Futsal SMA', 'Pelayanan ramah dan harganya bersahabat untuk tim sekolah kami.'],
            ['Kevin Wibowo', 'Streamer Esports', 'Jersey custom esports kami jadi makin keren, fans pun makin solid.'],
            ['Dewi Anggraini', 'Atlet Sepeda', 'Jerseynya ringan, breathable, dan cocok untuk long ride.'],
        ];
        foreach ($testimonials as [$name, $position, $message]) {
            Testimonial::firstOrCreate(
                ['name' => $name],
                ['position' => $position, 'message' => $message, 'photo' => null]
            );
        }

        $faqs = [
            ['Berapa minimal order untuk jersey custom?', 'Minimal order custom adalah 5 pcs untuk satu desain.'],
            ['Berapa lama proses produksinya?', 'Rata-rata 7–10 hari kerja sejak desain final disetujui.'],
            ['Apakah bisa request bahan tertentu?', 'Bisa. Kami menyediakan dryfit, milano, dan paragon.'],
            ['Bagaimana cara melakukan pembayaran?', 'Pembayaran melalui transfer bank atau e-wallet dengan DP 50%.'],
            ['Apakah kalian melayani pengiriman ke luar kota?', 'Ya, kami mengirim ke seluruh Indonesia dengan ekspedisi rekanan.'],
        ];
        foreach ($faqs as [$q, $a]) {
            Faq::firstOrCreate(['question' => $q], ['answer' => $a]);
        }

        $waNumbers = [
            ['Home', 'footer', '081234567890', 'Admin CPX 1', 'Halo admin CPX, saya ingin bertanya'],
            ['Home', 'product_card', '081234567891', 'Sales CPX', 'Halo kak, saya tertarik dengan produk ini'],
            ['Custom', 'custom_section', '081234567892', 'Custom Team CPX', 'Halo, saya mau konsultasi desain custom'],
        ];
        foreach ($waNumbers as [$page, $pos, $phone, $disp, $msg]) {
            WhatsappNumber::firstOrCreate(
                ['page_name' => $page, 'position' => $pos, 'phone_number' => $phone],
                ['display_name' => $disp, 'message' => $msg, 'is_active' => true]
            );
        }
    }
}
