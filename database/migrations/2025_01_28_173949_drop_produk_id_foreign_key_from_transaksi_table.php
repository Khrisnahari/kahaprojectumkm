<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::table('transaksi', function (Blueprint $table) {
            // Hapus foreign key constraint
            $table->dropForeign('transaksi_produk_id_foreign');
        });
    }

    public function down()
    {
        Schema::table('transaksi', function (Blueprint $table) {
            // Tambahkan kembali foreign key jika rollback
            $table->foreign('produk_id')->references('id')->on('produk')->onDelete('cascade');
        });
    }
};
