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
    Schema::create('user_choices', function (Blueprint $table) {
        $table->id();

        // colonne user_id (null le temps que tu n’as pas d’auth)
        $table->foreignId('user_id')
              ->nullable()
              ->constrained()
              ->cascadeOnDelete();

        // choix sélectionné
        $table->foreignId('choice_id')
              ->constrained()
              ->cascadeOnDelete();

        $table->timestamps();
    });
}
    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('user_choices');
    }
};
