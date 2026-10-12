<?php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('reaction_logs', function (Blueprint $table) {
            $table->id();
            $table->string('session_id')->index();
            $table->string('name')->nullable(); // Ini yang sering terlewat
            $table->integer('age');
            $table->integer('attempt_number');
            $table->integer('reaction_time_ms');
            $table->boolean('is_correct');
            $table->string('device_platform')->nullable();
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('reaction_logs');
    }
};