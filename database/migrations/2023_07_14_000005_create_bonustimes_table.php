<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateBonustimesTable extends Migration
{
    public function up()
    {
        Schema::create('bonustimes', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('bonusadi')->nullable();
            $table->date('bonustarihi')->nullable();
            $table->timestamps();
            $table->softDeletes();
        });
    }
}
