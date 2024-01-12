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
        Schema::create('buildings', function (Blueprint $table) {
            $table->id();
            $table->integer('building_age');
            $table->double('src_price', 8, 1);
            $table->double('rc_price', 8, 1);
            $table->double('sc_price', 8, 1);
            $table->double('lgs_price', 8, 1);
            $table->double('wood_price', 8, 1);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('buildings');
    }
};
