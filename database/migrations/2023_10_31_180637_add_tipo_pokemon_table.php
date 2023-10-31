<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('pokemon', function (Blueprint $table) {
            $table->unsignedBigInteger('tipo_uno_id')->nullable();
            $table->unsignedBigInteger('tipo_dos_id')->nullable();

            $table->foreign('tipo_uno_id')->references('id')->on('tipo_pokemon');
            $table->foreign('tipo_dos_id')->references('id')->on('tipo_pokemon');

        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('pokemon', function (Blueprint $table) {
            $table->dropForeign('tipo_uno_id');
            $table->dropForeign('tipo_dos_id');

        });
    }
};
