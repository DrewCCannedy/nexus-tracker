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
        Schema::create('game_players', function (Blueprint $table) {
            $table->id();
            $table->timestamps();

            $table->integer('place');

            $table->unsignedBigInteger('faction_leader_id');
            $table->foreign('faction_leader_id')->references('id')->on('faction_leaders');

            $table->unsignedBigInteger('player_id');
            $table->foreign('player_id')->references('id')->on('players');

            $table->unsignedBigInteger('game_id');
            $table->foreign('game_id')->references('id')->on('games')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('game_players');
    }
};
