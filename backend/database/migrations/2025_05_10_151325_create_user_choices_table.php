<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('user_choices', function (Blueprint $t) {
            $t->id();
            $t->foreignId('user_id');
            $t->foreignId('choice_id');
        });
    }
    public function down(): void
    {
        Schema::dropIfExists('user_choices');
    }
};