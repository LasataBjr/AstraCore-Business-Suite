<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations. For eg: Project 1 = img1.jpg, img2.jpg
     */
    public function up(): void
    {
        Schema::create('project_images', function (Blueprint $table) {
            $table->id();
             $table->foreignId('project_id')
                ->constrained()// This will automatically reference the 'id' column on the 'projects' table
                ->cascadeOnDelete();// If a project is deleted, its associated images will also be deleted
            $table->string('image');
            $table->integer('sort_order')->default(0);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('project_images');
    }
};
