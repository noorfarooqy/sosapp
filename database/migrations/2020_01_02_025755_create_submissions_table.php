<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSubmissionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('submissions', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->bigInteger('user_id');
            $table->string('user_token', 330);
            $table->string('submssion_token', 330);
            $table->integer('submission_type');
            $table->string('submission_title', 230);
            $table->text('submission_abstract', 120000);
            $table->string('submission_keywords', 1030);
            $table->string('submission_manuscript', 330);
            $table->string('submission_cover', 330);
            $table->integer('submission_status')->default(0);
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
        Schema::dropIfExists('submissions');
    }
}
