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
        Schema::create('customers', function (Blueprint $table) {
            $table->id('customer_id');
            $table->string('nama');
            $table->string('email')->unique();
            $table->string('notlp');
            $table->string('ktp'); // Kolom untuk menyimpan path file KTP
            $table->string('kk'); // Kolom untuk menyimpan path file KK
            $table->dateTime('jadwal_sidang'); // Ubah tipe menjadi date atau dateTime
            
            $table->unsignedBigInteger('user_id');
            $table->foreign('user_id')->references('user_id')->on('users')->onDelete('cascade');

            $table->unsignedBigInteger('jenis_sidang_id');
            $table->foreign('jenis_sidang_id')->references('jenis_sidang_id')->on('jenis_sidangs')->onDelete('cascade');

            $table->timestamps();

            $table->string('role')->default('user');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('customers');
    }
};