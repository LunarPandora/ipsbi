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
        Schema::create('users', function (Blueprint $table) {
            $table->integer('id_user')->primary()->autoIncrement();
            $table->string("username");
            $table->string("password");
            $table->string("role");
            $table->string("email");
            $table->string("foto_profil");
            $table->timestamps();
        });

        // Create column
        // Schema::create('users', function (Blueprint $table) {
        //     $table->id();
        //     $table->integer("no_urut")->autoIncrement(); // Kolom no_urut diatur menjadi auto_increment
        //     $table->string("username")->comment('ini komen'); // Kolom username diberikan komentar
        //     $table->string("password")->first(); // Kolom password ditaruh di posisi paling pertama
        //     $table->string("role")->default('user'); // Default value dari kolom role adalah 'user'
        //     $table->string("email")->after('password'); // Kolom email ditaruh di posisi setelah password
        //     $table->string("foto_profil")->nullable(true); // Kolom foto_profil dapat dikosongkan (NULL)
        //     $table->timestamps();
        // });

        // Modify column
        // Schema::table('users', function (Blueprint $table){
        //     $table->integer("no_urut")->unsigned()->change(); // Kolom no urut tidak lagi auto_increment
        //     $table->string("role")->default('admin')->change(); // Default value dari kolom role berubah menjadi 'admin'
        //     $table->string("username", 50)->change(); // Batas karakter dari kolom username menjadi 50 karakter
    
        //     $table->renameColumn('email', 'mail'); // Mengubah nama kolom 'email' menjadi 'mail'
        //     $table->dropColumn('foto_profil'); // Menghapus kolom 'foto_profil'
        // });

        // Create index
        // Schema::table('users', function (Blueprint $table){
        //     $table->integer('no_urut')->primary(); // Kolom no_urut berubah menjadi Primary Key dari tabel 'users'
        //     $table->unique('email'); // Kolom email bersifat unik dan tidak ada data yang sama / kembar
        // });

        // Modify index
        // Schema::table('users', function (Blueprint $table){
        //     $table->renameIndex('no_urut', 'no_antrian'); // Index 'no_urut' berubah menjadi 'no_antrian'
        //     $table->dropPrimary('no_antrian'); // index primary_key 'no_antrian' dihapus
        //     $table->dropUnique('email'); // index unique dari 'email' dihapus, kolom dapat kembali menampung data kembar
        // });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('users');
    }
};
