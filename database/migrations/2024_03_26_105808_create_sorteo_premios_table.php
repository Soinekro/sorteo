<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSorteoPremiosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('sorteo_premios', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('premio_id');
            $table->foreign('premio_id')->references('id')->on('events');
            $table->unsignedBigInteger('winner_id');
            $table->foreign('winner_id')->references('id')->on('users');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('sorteo_premios');
    }
}
