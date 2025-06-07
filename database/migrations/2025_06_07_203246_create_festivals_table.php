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
        Schema::create('festivals', function (Blueprint $table) {
            $table->id();
            $table->date('aufbau_start')->nullable();
            $table->date('aufbau_end')->nullable();
            $table->date('festival_start')->nullable();
            $table->date('festival_end')->nullable();
            $table->date('abbau_start')->nullable();
            $table->date('abbau_end')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('festivals');
    }
};
