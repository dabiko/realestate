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
        Schema::create('properties', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained();
            $table->foreignId('category_id')->constrained();
            $table->string('amenity_id');
            $table->integer('agent_id');
            $table->text('thumbnail');
            $table->string('name');
            $table->string('slug');
            $table->string('code');
            $table->integer('low_price');
            $table->integer('max_price');
            $table->text('video_link')->nullable();
            $table->string('purpose');
            $table->string('tag');
            $table->text('short_desc');
            $table->text('long_desc');
            $table->boolean('is_approved')->default(0);
            $table->boolean('status')->default(0);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('properties');
    }
};
