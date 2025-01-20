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
        Schema::create('transaksi', function (Blueprint $table) {
            $table->id();
            $table->string('order_id')->unique();
            $table->unsignedBigInteger('pembeli_id'); // Foreign key untuk user
            $table->decimal('total', 15, 2);
            $table->string('status')->default('pending'); // Status transaksi
            $table->string('payment_url'); // URL Snap Midtrans
            $table->timestamps();

            // Foreign key relation
            $table->foreign('pembeli_id')->references('id')->on('pembeli')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('transaksi');
    }
};
