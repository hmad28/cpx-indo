<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
   public function up()
    {
        Schema::table('products', function (Blueprint $table) {
            // buat slug unik
            $table->unique('slug');
            // jika mau set NOT NULL dan kamu punya doctrine/dbal:
            // $table->string('slug')->nullable(false)->change();
        });
    }

    public function down()
    {
        Schema::table('products', function (Blueprint $table) {
            $table->dropUnique(['slug']);
            // jika change dipakai, balikkan ke nullable
        });
    }
};
