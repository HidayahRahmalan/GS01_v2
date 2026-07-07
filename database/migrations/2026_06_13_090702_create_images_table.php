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
    Schema::create('images', function (Blueprint $table) {
        $table->id('image_ID'); // Primary Key
        $table->foreignId('user_ID')->constrained('users', 'user_ID'); // Foreign Key linked to users table
        $table->string('file_name', 255);
        $table->integer('file_size');
        $table->dateTime('upload_date');
        $table->string('image_format', 50);
        $table->text('description')->nullable();
        $table->timestamps();
    });
}

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('images');
    }
};
