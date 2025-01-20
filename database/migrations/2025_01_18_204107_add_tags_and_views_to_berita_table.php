<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddTagsAndViewsToBeritaTable extends Migration
{
    public function up()
    {
        Schema::table('beritas', function (Blueprint $table) {
            $table->string('tags')->nullable(); // Daftar tag
            $table->integer('views')->default(0); // Jumlah pembaca
        });
    }

    public function down()
    {
        Schema::table('beritas', function (Blueprint $table) {
            $table->dropColumn(['tags', 'views']);
        });
    }
}
