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
          Schema::create('backup_histories', function (Blueprint $table) {
            $table->id();
            $table->string('backup_name');
            $table->string('backup_path');
            $table->string('file_size')->nullable();
            $table->string('status'); // success, failed, processing
            $table->text('error_message')->nullable();
            $table->timestamp('backup_started_at')->nullable();
            $table->timestamp('backup_completed_at')->nullable();
            $table->integer('backup_duration_seconds')->nullable();
            $table->timestamps();
     });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('backup_histories');
    }
};
