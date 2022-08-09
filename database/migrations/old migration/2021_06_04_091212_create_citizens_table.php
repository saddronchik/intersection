<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCitizensTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('citizens', function (Blueprint $table) {
            $table->id();
            $table->string('full_name')->nullable();
            $table->string('passport_data')->nullable();
            $table->date('date_birth')->nullable();
            $table->string('photo')->nullable();
            $table->string('place_residence')->nullable();
            $table->integer('phone_number')->nullable();
            $table->string('social_account')->nullable();
            $table->text('addit_inf')->nullable();

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
        Schema::dropIfExists('citizens');
    }
}
