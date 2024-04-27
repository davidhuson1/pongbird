<?php

use App\Models\User;
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
        Schema::create('matches', function (Blueprint $table) {
            $table->id();
            $table->timestamps();
            $table->unsignedBigInteger('opponent_a');
            $table->foreign('opponent_a')->references('id')->on('users')->onDelete('cascade');
            $table->unsignedBigInteger('opponent_b');
            $table->foreign('opponent_b')->references('id')->on('users')->onDelete('cascade');
            $table->unsignedTinyInteger('score_opponent_a');
            $table->unsignedTinyInteger('score_opponent_b');
            $table->string('winner', 20);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('matches');
    }
};
