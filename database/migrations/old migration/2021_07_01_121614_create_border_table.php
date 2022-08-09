<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateBorderTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('border', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('id_citisen');
            $table->string('citizenship');
            $table->string('full_name');
            $table->date('date_birth');
            $table->string('passport');
            $table->date('crossing_date');
            $table->date('crossing_time');
            $table->string('way_crossing');
            $table->string('checkpoint');
            $table->string('route');
            $table->string('place_birth');
            $table->string('place_regis');
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
        Schema::dropIfExists('border');
    }
}
