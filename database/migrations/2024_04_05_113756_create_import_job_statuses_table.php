<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('import_job_statuses', function (Blueprint $table) {
            $table->id();
            $table->string('file_name');
            $table->integer('status')->nullable(); // 0 = Started, 1 = Completed, 2 = Failed
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('import_job_statuses');
    }
};
