<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use App\Models\User;
use App\Models\Subject;
return new class extends Migration
{
    public function up(): void
    {
        Schema::create('grades', function (Blueprint $table) {
            $table->id();
            $table->foreignId('student_id')->constrained('students');
            $table->foreignId('subject_id')->constrained('subjects');
            $table->unsignedTinyInteger('grade');
            $table->timestamps();
        });

    }

    public function down(): void
    {
        Schema::dropIfExists('grades');
    }

    // public function user()
    // {
    //     return $this->belongsTo(User::class);
    // }

};
