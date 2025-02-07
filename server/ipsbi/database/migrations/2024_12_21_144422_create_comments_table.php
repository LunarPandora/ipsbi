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
        Schema::create('comments', function (Blueprint $table) {
            $table->integer('id_komentar')->primary()->autoIncrement();
            $table->integer("id_post");
            $table->string("isi_komentar");
            $table->string("nama");
            $table->string("email");
            $table->timestamps();
        });

        Schema::table('comments', function (Blueprint $table) {
            $table->foreign('id_post')->references('id_post')->on('posts')->onUpdate('cascade')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('comments');
    }
};
