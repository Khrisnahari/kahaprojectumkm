<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::table('transaksi', function (Blueprint $table) {
            // Hapus kolom produk_id
            $table->dropColumn('produk_id');
        });
    }

    public function down()
    {
        Schema::table('transaksi', function (Blueprint $table) {
            // Tambahkan kembali kolom produk_id
            $table->unsignedBigInteger('produk_id')->nullable();
        });
    }

};
