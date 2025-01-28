<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
   /**
     * Jalankan migrasi untuk menghapus kolom.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('transaksi', function (Blueprint $table) {
            $table->dropColumn('quantity'); // Hapus kolom quantity
        });
    }

    /**
     * Rollback migrasi untuk menambahkan kembali kolom.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('transaksi', function (Blueprint $table) {
            $table->integer('quantity')->after('pembeli_id'); // Tambahkan kembali kolom quantity
        });
    }
};
