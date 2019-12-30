<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePersonInfoTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('person_info', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->bigInteger('user_id')->unique();
            $table->string('user_token',330);
            $table->string('profile_picture',330);
            $table->string('user_title',45);
            $table->string('living_city',45);
            $table->string('living_country',45);
            $table->string('institute',250);
            $table->string('institute_country',45);
            $table->boolean('gender');
            $table->string('profession',45);
            $table->boolean('is_active')->default(true);
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
        Schema::dropIfExists('person_info');
    }
}
