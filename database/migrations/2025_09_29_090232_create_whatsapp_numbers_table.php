// database/migrations/xxxx_create_whatsapp_numbers_table.php
<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('whatsapp_numbers', function (Blueprint $table) {
            $table->id();
            $table->string('page_name'); // nama halaman (Home, About, Contact, dll)
            $table->string('position')->default('footer');  // default footer jika tidak diisi
            $table->string('phone_number'); // nomor WA
            $table->string('display_name'); // nama untuk ditampilkan
            $table->text('message')->nullable(); // pesan default
            $table->boolean('is_active')->default(true);
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('whatsapp_numbers');
    }
};