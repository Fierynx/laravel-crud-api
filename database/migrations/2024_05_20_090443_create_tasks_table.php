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
        Schema::create('tasks', function (Blueprint $table) {
            $table->id('TaskId');
            $table->foreignId('SubjectId')->references('SubjectId')->on('subjects')->onDelete('cascade')->onUpdate('cascade');
            $table->dateTime('Deadline');
            $table->string('Title');
            $table->text('Description');
            $table->string('Status')->default('Not Started');
            $table->string('Image');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('tasks');
    }
};
