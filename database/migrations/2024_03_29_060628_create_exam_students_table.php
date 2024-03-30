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
        Schema::create('exam_students', function (Blueprint $table) {
            $table->id();
            $table->integer('student_id');
            $table->integer('exam_id');
            $table->integer('turkce_dogru');
            $table->integer('turkce_yanlis');
            $table->integer('matematik_dogru');
            $table->integer('matematik_yanlis');
            $table->integer('inkilap_dogru');
            $table->integer('inkilap_yanlis');
            $table->integer('fenbilimleri_dogru');
            $table->integer('fenbilimleri_yanlis');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('exam_students');
    }
};
