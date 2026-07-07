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
        Schema::create('image_tag', function (Blueprint $table) {
            // Match your exact int(11) types from phpMyAdmin
            $table->integer('image_ID');
            $table->integer('tag_ID');
            $table->integer('user_ID'); // Tracks who created the connection for TBR
            $table->timestamps();

            // Setup primary composite index keys
            $table->primary(['image_ID', 'tag_ID', 'user_ID']);

            // Foreign Key constraints pointing to your custom primary key column names
            $table->foreign('image_ID')->references('image_ID')->on('image')->onDelete('cascade');
            $table->foreign('tag_ID')->references('tag_ID')->on('tag')->onDelete('cascade');
            $table->foreign('user_ID')->references('user_ID')->on('users')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('image_tags');
    }
};
