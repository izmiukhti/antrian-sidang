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
        Schema::create('antrians', function (Blueprint $table) {
            $table->id('antrian_id');
            $table->string('nomor_antrian');
            $table->enum('status_sidang', ['Pending', 'Proses', 'Selesai'])->default('Pending');
            $table->dateTime('jadwal_sidang');
            
            // Foreign key ke tabel 'users'
            $table->unsignedBigInteger('user_id');
            $table->foreign('user_id')->references('user_id')->on('users')->onDelete('cascade');
            
            // Foreign key ke tabel 'jenis_sidang'
            $table->unsignedBigInteger('jenis_sidang_id');
            $table->foreign('jenis_sidang_id')->references('jenis_sidang_id')->on('jenis_sidangs')->onDelete('cascade');
            $table->timestamps();
        });
        
        
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('antrians');
    }
};
