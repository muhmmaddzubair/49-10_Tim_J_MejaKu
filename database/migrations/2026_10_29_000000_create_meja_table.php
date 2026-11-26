<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('meja', function (Blueprint $table) {
            $table->id();                                   
            $table->string('nomor_meja', 10)->unique();     
            $table->unsignedTinyInteger('kapasitas');       
            $table->enum('zona', ['Indoor', 'VIP'])->default('Indoor');
            $table->enum('status', ['Tersedia', 'Terisi', 'Dipesan', 'Perbaikan'])->default('Tersedia');
            $table->timestamps();                           
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('meja');
    }
};
