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
        Schema::create('panorama_images', function (Blueprint $table) {
            $table->id();
            $table->string('path');
            $table->string('filename');
            $table->integer('sort')->default(0);
            $table->foreignId('panorama_id')
                ->references('id')
                ->on('panoramas')
                ->cascadeOnDelete();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('panorama_images');
    }
};
