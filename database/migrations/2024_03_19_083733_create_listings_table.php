<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('listings', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->foreignId('category_id')->references('id')->on('categories');
            $table->foreignId('tag_id')->references('id')->on('tags');
            $table->foreignId('created_by')->references('id')->on('users');
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('listings');
    }
};
