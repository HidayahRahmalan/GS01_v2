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
    Schema::create('visual_features', function (Blueprint $table) {
        $table->id('feature_ID'); // Primary Key
        $table->foreignId('image_ID')->constrained('images', 'image_ID'); // Foreign Key
        $table->string('clothing_type', 100)->nullable();
        $table->string('background_type', 100)->nullable();
        $table->string('background_color', 50)->nullable();
        $table->string('face_position', 100)->nullable();
        $table->string('camera_posture', 100)->nullable();
        $table->string('body_composition', 100)->nullable();
        $table->timestamps();
    });
}

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('visual_features');
    }
};
