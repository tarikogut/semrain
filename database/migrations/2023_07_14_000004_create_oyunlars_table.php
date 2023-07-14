<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateOyunlarsTable extends Migration
{
    public function up()
    {
        Schema::create('oyunlars', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('oyun_adi')->nullable();
            $table->timestamps();
            $table->softDeletes();
        });
    }
}
