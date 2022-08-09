<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAvtosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('avtos', function (Blueprint $table) {
            $table->id();
            $table->string('id_citisen');
            $table->string('brand_avto');
            $table->string('regis_num');
            $table->string('color');
            $table->string('photo');
            $table->string('addit_inf');
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
        Schema::dropIfExists('avtos');
    }
}
