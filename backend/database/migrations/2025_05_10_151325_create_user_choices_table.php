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

        // l’utilisateur qui a cliqué (nullable tant que tu n’as pas l’auth)
        $table->foreignId('user_id')
              ->nullable()
              ->constrained()
              ->cascadeOnDelete();

        // le choix sélectionné
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
