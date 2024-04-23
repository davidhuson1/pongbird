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
            $table->unsignedBigInteger('opponent_1');
            $table->foreign('opponent_1')->references('id')->on('users')->onDelete('cascade');
            $table->unsignedBigInteger('opponent_2');
            $table->foreign('opponent_2')->references('id')->on('users')->onDelete('cascade');
            $table->unsignedTinyInteger('score_opponent_1');
            $table->unsignedTinyInteger('score_opponent_2');
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
