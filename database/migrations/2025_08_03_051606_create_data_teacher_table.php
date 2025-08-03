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
        Schema::create('data_teacher', function (Blueprint $table) {
            $table->id();
            $table->string('nik', 16)->unique();
            $table->string('fullname', 255);
            $table->enum('gender', ['L', 'P']);
            $table->date('dob');
            $table->integer('class_id')->constrained('data_classes');
            $table->integer('user_id')->constrained('users')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('data_teacher');
    }
};
