<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateBettingsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('bettings', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('position')->nullable();
            $table->string('venue')->nullable();
            $table->string('race_id')->nullable();
            $table->string('date')->nullable();
            $table->string('name')->nullable();
            $table->string('trainer')->nullable();
            $table->string('time')->nullable();
            $table->float('sp')->nullable()->default(0.0);
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
        Schema::dropIfExists('bettings');
    }
}
