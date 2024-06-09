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
            $table->foreignId('category')->nullable()->references('id')->on('categories');
            $table->foreignId('parent_category')->nullable()->references('id')->on('parent_categories');
            $table->integer('phone_number')->nullable();
            $table->string('name');
            $table->text('business_url')->nullable();
            $table->string('business_email')->nullable();
            $table->text('unique_url')->nullable();
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('listings');
    }
};
