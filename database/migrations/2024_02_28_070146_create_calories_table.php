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
        Schema::create('calories', function (Blueprint $table) {
            $table->id();
            $table->string('kalori_pagi');
            $table->string('kalori_siang');
            $table->string('kalori_malam');

            $table->string('makan_pagi');
            $table->string('makan_siang');
            $table->string('makan_malam');

            $table->string('kategori_pagi');           
            $table->string('kategori_siang');
            $table->string('kategori_malam');

            $table->string('kuantitas_pagi');           
            $table->string('kuantitas_siang');
            $table->string('kuantitas_malam');

            $table->string('satuan_pagi');           
            $table->string('satuan_siang');
            $table->string('satuan_malam');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('calories');
    }
};
