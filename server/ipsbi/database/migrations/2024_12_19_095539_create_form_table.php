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
        Schema::create('form', function (Blueprint $table) {
            $table->integer('id_form')->primary()->autoIncrement();
            $table->integer('id_user');
            $table->string('title');
            $table->string('desc');
            $table->text('link');
            $table->string('foto_form');
            $table->timestamps();
        });

        Schema::table('form', function (Blueprint $table) {
            $table->foreign('id_user')->references('id_user')->on('users')->onUpdate('cascade')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('form');
    }
};
