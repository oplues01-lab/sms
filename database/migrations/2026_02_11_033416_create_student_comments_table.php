<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('comments', function (Blueprint $table) {
            $table->id();
            $table->foreignId('student_id')->constrained()->onDelete('cascade');
            $table->string('admission_no');
            $table->foreignId('class_id')->constrained('classes')->onDelete('cascade');
            $table->foreignId('class_arm_id')->constrained('class_arms')->onDelete('cascade');
            $table->foreignId('term_id')->constrained('terms')->onDelete('cascade');
            $table->foreignId('session_id')->constrained('academic_sessions')->onDelete('cascade');
            $table->enum('comment_type', ['class_teacher', 'principal']);
            $table->text('comment');
            $table->foreignId('commented_by')->constrained('users')->onDelete('cascade');
            $table->timestamps();
            
            // Ensure one comment per student per type per term/session
            $table->unique(['student_id', 'term_id', 'session_id', 'comment_type'], 'unique_student_comment');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('student_comments');
    }
};