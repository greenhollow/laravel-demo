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
        Schema::create('humans_pets', function (Blueprint $table) {
            $table->unsignedBiginteger('human_id')->unsigned();
            $table->unsignedBiginteger('pet_id')->unsigned();

            $table->foreign('human_id')
                ->references('id')
                ->on('humans')
                ->onDelete('cascade')
            ;
            $table->foreign('pet_id')
                ->references('id')
                ->on('pets')
                ->onDelete('cascade')
            ;
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('humans_pets');
    }
};
