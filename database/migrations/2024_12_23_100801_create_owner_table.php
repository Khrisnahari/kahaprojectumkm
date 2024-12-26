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
        Schema::create('owner', function (Blueprint $table) {
            $table->id();
            $table->string('username');
            $table->string('password');
            $table->string('email');
            $table->string('namalengkap')->nullable();
            $table->string('no_telp')->nullable();
            $table->timestamps();
        });

        DB::table('owner')->insert(
            array(
                'username' => 'umkmku',
                'password' => Hash::make('umkmku'),
                'email' => 'umkmku@gmail.com',
                'namalengkap' => 'Testing UMKM',
                'no_telp' => '12345678',
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
        Schema::dropIfExists('owner');
    }
};
