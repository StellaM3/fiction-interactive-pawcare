<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up()
{
    Schema::table('choices', function (Blueprint $table) {
        $table->integer('impact_bonheur')->default(0);
        $table->integer('impact_sante')->default(0);
        $table->integer('impact_energie')->default(0);
    });
}

public function down()
{
    Schema::table('choices', function (Blueprint $table) {
        $table->dropColumn(['impact_bonheur', 'impact_sante', 'impact_energie']);
    });
}
};
