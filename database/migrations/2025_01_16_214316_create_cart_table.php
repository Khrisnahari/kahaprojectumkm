<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('cart', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('pembeli_id'); // ID pembeli
            $table->unsignedBigInteger('produk_id'); // ID produk
            $table->integer('quantity'); // Jumlah item
            $table->timestamps();

            $table->foreign('pembeli_id')->references('id')->on('pembeli')->onDelete('cascade');
            $table->foreign('produk_id')->references('id')->on('produk')->onDelete('cascade');
        });
    }

    public function down()
    {
        Schema::dropIfExists('cart');
    }
};
