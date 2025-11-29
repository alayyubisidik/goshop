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
        Schema::create('contact_settings', function (Blueprint $table) {
            $table->id();

            $table->text('map_url');

            $table->string('box_title_one')->nullable();
            $table->text('description_one')->nullable();

            $table->string('box_title_two')->nullable();
            $table->text('description_two')->nullable();

            $table->string('box_title_three')->nullable();
            $table->text('description_three')->nullable();

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('contact_settings');
    }
};
