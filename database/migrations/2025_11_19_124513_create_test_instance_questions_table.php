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
        Schema::create('test_instance_questions', function (Blueprint $table) {
            $table->id();
            $table->foreignId('test_instance_id')->constrained()->onDelete('cascade');
            $table->foreignId('quiz_id')->constrained()->onDelete('cascade');
            $table->string('user_answer')->nullable(); // A/B/C/D
            $table->boolean('is_correct')->nullable(); // tekshirilgandan keyin 1/0
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('test_instance_questions');
    }
};
