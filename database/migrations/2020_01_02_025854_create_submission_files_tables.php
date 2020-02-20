<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSubmissionFilesTables extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('submission_files', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->bigInteger('submission_id');
            $table->string('submission_token');
            $table->string('submission_file', 330);
            $table->integer('submission_file_index');
            $table->integer('submission_file_type')->default(0); //default is figure, 1 is others
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
        Schema::dropIfExists('submission_files_tables');
    }
}
