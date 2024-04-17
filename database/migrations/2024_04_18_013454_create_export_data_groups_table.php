<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('export_data_groups', function (Blueprint $table) {
            $table->id();
            $table->string('group_name');
            $table->text('column_names');
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('export_data_groups');
    }
};
