<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateIotdataTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('iotdata', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('device_id');
            $table->float('pm2_5', 6, 2);
            $table->float('pm10', 6, 2);
            $table->float('temp', 5, 2);
            $table->float('hum', 4, 2);
            $table->float('pressure', 6, 1);
            $table->float('sealevel', 6, 1);
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
        Schema::dropIfExists('iotdata');
    }
}
