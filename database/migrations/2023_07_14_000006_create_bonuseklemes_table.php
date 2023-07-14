<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateBonuseklemesTable extends Migration
{
    public function up()
    {
        Schema::create('bonuseklemes', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('oyun_adi')->nullable();
            $table->decimal('yatirim', 15, 2)->nullable();
            $table->timestamps();
            $table->softDeletes();
        });
    }
}
