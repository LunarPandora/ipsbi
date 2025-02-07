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
        Schema::create('posts', function (Blueprint $table) {
            $table->integer('id_post')->primary()->autoIncrement();
            $table->string('judul');
            $table->string('url_isi');
            $table->string('foto_post');
            $table->integer('id_user');
            $table->integer('id_kategori');
            $table->string('tag');
            $table->timestamps();
        });

        Schema::table('posts', function (Blueprint $table) {
            $table->foreign('id_user')->references('id_user')->on('users')->onUpdate('cascade')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('posts');
    }
};
