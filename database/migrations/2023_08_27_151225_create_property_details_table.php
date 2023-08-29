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
        Schema::create('property_details', function (Blueprint $table) {
            $table->id();
            $table->foreignId('property_id')->constrained();
            $table->foreignId('detail_id')->constrained();
            $table->double('size');
            $table->integer('rooms');
            $table->integer('bathrooms');
            $table->integer('garage');
            $table->double('garage_size');
            $table->date('build_year');
            $table->boolean('status');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('property_details');
    }
};
