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
        Schema::create('weather', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('user_id')->unique()->unsigned();
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
            $table->string('feels_like')->default(null);
            $table->string('grnd_level')->default(null);
            $table->string('humidity')->default(null);
            $table->string('pressure')->default(null);
            $table->string('sea_level')->default(null);
            $table->string('temp')->default(null);
            $table->string('temp_max')->default(null);
            $table->string('temp_min')->default(null);
            $table->string('main')->default(null);
            $table->string('description')->default(null);
            $table->string('visibility')->default(null);
            $table->string('timezone')->default(null);
            $table->string('wind_deg')->default(null);
            $table->string('wind_gust')->default(null);
            $table->string('wind_speed')->default(null);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('weather');
    }
};
