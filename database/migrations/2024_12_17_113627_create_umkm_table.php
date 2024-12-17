<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
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
            $table->string('image');
            $table->string('nama_umkm');
            $table->string('kategori');
            $table->string('alamat');
            $table->string('status');
            $table->timestamps();
        });

        // DB::table('umkm')->insert(
        //     array(
        //         'nama_umkm' => 'Leisure Stuff',
        //         'kategori' => 'Fashion',
        //         'alamat' => 'Darmasaba',
        //         'status' => 'Belum Verifikasi',
        //         'gambar' => 'default.jpg',
        //         'created_at' => date('Y-m-d H:i:s'),
        //         'updated_at' => date('Y-m-d H:i:s'),
        //     )
        // );
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('umkm');
    }
};
