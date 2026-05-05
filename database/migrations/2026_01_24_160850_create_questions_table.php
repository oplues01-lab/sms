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
    Schema::create('questions', function (Blueprint $table) {
    $table->id();
    $table->foreignId('subject_id')->constrained()->cascadeOnDelete();
    $table->foreignId('class_id')->constrained()->cascadeOnDelete();
    $table->foreignId('term_id')->constrained()->cascadeOnDelete();
    $table->foreignId('academic_session_id')->constrained()->cascadeOnDelete();

    $table->enum('type', ['assessment', 'exam']);
    $table->text('question');
    $table->string('option_a')->nullable();
    $table->string('option_b')->nullable();
    $table->string('option_c')->nullable();
    $table->string('option_d')->nullable();
    $table->string('correct_option')->nullable();

    $table->integer('marks')->default(1);
    $table->foreignId('teacher_id')->constrained('users');
    $table->timestamps();
});

    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('questions');
    }
};
