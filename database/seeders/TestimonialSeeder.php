<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Testimonial;

class TestimonialSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Testimonial::create([
            'name' => 'Ahmad Fauzi',
            'position' => 'CEO PT. Sukses Selalu',
            'message' => 'Pelayanan sangat baik, website kami jadi lebih profesional dan cepat!',
            'photo' => null, // bisa isi path "testimonials/foto1.jpg" kalau ada file
        ]);

        Testimonial::create([
            'name' => 'Siti Aminah',
            'position' => 'Mahasiswa',
            'message' => 'Belajar di Rumah IT Al Imam Nafi’ bikin saya makin percaya diri coding.',
            'photo' => null,
        ]);

        Testimonial::create([
            'name' => 'Budi Santoso',
            'position' => 'Freelancer',
            'message' => 'Proyek selesai tepat waktu, timnya komunikatif banget!',
            'photo' => null,
        ]);
    }
}
