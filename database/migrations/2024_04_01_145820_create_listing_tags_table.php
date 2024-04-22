<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('listing_tags', function (Blueprint $table) {
            $table->id();
            $table->foreignId('listing_id')->references('id')->on('listings')->onDelete('cascade');
            $table->foreignId('tag_id')->references('id')->on('tags')->onDelete('cascade');
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('listing_tags');
    }
};
