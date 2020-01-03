<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSubmissionAuthorsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('submission_authors', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->bigInteger('submission_id');
            $table->string('submission_token');
            $table->string('author_firstname', 75);
            $table->string('author_secondname', 75);
            $table->string('author_email', 75);
            $table->string('author_institute', 250);
            $table->string('author_location', 45);
            $table->integer('author_gender')->default(0);
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
        Schema::dropIfExists('submission_authors');
    }
}
