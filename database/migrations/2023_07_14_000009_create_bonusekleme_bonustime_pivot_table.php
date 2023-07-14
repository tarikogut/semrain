<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateBonuseklemeBonustimePivotTable extends Migration
{
    public function up()
    {
        Schema::create('bonusekleme_bonustime', function (Blueprint $table) {
            $table->unsignedBigInteger('bonusekleme_id');
            $table->foreign('bonusekleme_id', 'bonusekleme_id_fk_8753419')->references('id')->on('bonuseklemes')->onDelete('cascade');
            $table->unsignedBigInteger('bonustime_id');
            $table->foreign('bonustime_id', 'bonustime_id_fk_8753419')->references('id')->on('bonustimes')->onDelete('cascade');
        });
    }
}
