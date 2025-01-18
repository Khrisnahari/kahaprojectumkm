<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('pembeli', function (Blueprint $table) {
            $table->id();
            $table->string('username');
            $table->string('password');
            $table->string('email');
            $table->string('namalengkap')->nullable();
            $table->string('no_telp')->nullable();
            $table->string('alamat')->nullable();
            $table->timestamps();
        });

        DB::table('pembeli')->insert(
            array(
                'username' => 'indra29 ',
                'password' => Hash::make('indra29'),
                'email' => 'indrapurnamaa@gmail.com',
                'namalengkap' => 'Kadek Indra Purnama Mertayana',
                'no_telp' => '085737358815',
                'alamat' => 'Jimbaran',
                'created_at' => date('Y-m-d H:i:s'),
                'updated_at' => date('Y-m-d H:i:s'),
            )
        );
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('pembeli');
    }
};
