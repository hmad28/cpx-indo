<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('diskons', function (Blueprint $table) {
            $table->id();
            $table->foreignId('product_id')->constrained('products')->onDelete('cascade'); // Relasi ke tabel products
            $table->decimal('discount_percentage', 5, 2); // Misal: 10.00% (bisa ganti ke amount jika diskon fixed)
            $table->date('start_date'); // Tanggal mulai diskon
            $table->date('end_date'); // Tanggal akhir diskon
            $table->enum('status', ['active', 'inactive'])->default('active'); // Status diskon
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('diskons');
    }
};
