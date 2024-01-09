<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateRaceFormsTable extends Migration
{
    /**            
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('race_forms', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('dog_id')->nullable();
            $table->string('race_code')->nullable();
            $table->string('venue')->nullable();
            $table->string('race_id')->nullable();
            $table->string('dpg_name')->nullable();
            $table->string('sex')->nullable();
            $table->string('plc')->nullable();
            $table->string('box')->nullable();
            $table->string('wgt')->nullable();
            $table->string('dist')->nullable();
            $table->string('date')->nullable();
            $table->string('track')->nullable();
            $table->string('G')->nullable();
            $table->string('Time')->nullable();
            $table->string('Win')->nullable();
            $table->string('Bon')->nullable();
            $table->string('_Sec')->nullable();
            $table->string('MGN')->nullable();
            $table->string('W_2G')->nullable();
            $table->string('PIR')->nullable();
            $table->string('SP')->nullable();
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
        Schema::dropIfExists('race_forms');
    }
}
