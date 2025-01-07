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
        Schema::create('umkm', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('owner_id');
            $table->string('image');
            $table->string('nama_umkm');
            $table->string('kategori');
            $table->string('alamat');
            $table->string('deskripsi_umkm');
            $table->string('jam_buka');
            $table->string('jam_tutup');
            $table->string('status');
            $table->timestamps();

            $table->foreign('owner_id')->references('id')->on('owner')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('umkm');
    }
};
