<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePeoplesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('peoples', function (Blueprint $table) {
            $table->id();
            $table->string('full_name');
            $table->string('passport_data')->nullable();
            $table->string('passport_data1')->nullable();
            $table->string('passport_data2')->nullable();
            $table->date('date_birth')->nullable();
            $table->string('photo')->nullable();
            $table->string('place_registration')->nullable();
            $table->string('place_residence')->nullable();
            $table->string('phone_number')->nullable();
            $table->string('phone_number1')->nullable();
            $table->string('phone_number2')->nullable();
            $table->string('social_account')->nullable();
            $table->string('social_account1')->nullable();
            $table->string('social_account2')->nullable();
            $table->string('social_account3')->nullable();
            $table->string('social_account4')->nullable();
            $table->text('addit_inf')->nullable();
            $table->string('user')->nullable();
            $table->integer('id_user');

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
        Schema::dropIfExists('peoples');
    }
}
