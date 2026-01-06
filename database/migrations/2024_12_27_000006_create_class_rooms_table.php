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
        Schema::create('class_rooms', function (Blueprint $table) {
            $table->id();
            $table->string('code')->unique();
            $table->string('name');
            $table->foreignId('lecturer_id')->nullable()->constrained()->onDelete('set null');
            $table->string('room')->nullable();
            $table->integer('capacity')->default(30);
            $table->string('schedule_day')->nullable();
            $table->string('schedule_time')->nullable();
            $table->enum('status', ['active', 'cancelled', 'completed'])->default('active');
            $table->integer('credits')->default(3);
            $table->text('description')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('class_rooms');
    }
};
