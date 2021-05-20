<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateQuizzesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('quizzes', function (Blueprint $table) {
            $table->id();
            $table->foreignId("course_id");
            $table->foreign("course_id")->references("id")->on("courses")->onDelete("cascade");
            $table->foreignId("lesson_id");
            $table->foreign("lesson_id")->references("id")->on("lessons")->onDelete("cascade");
            $table->string("title");
            $table->longText("instructions")->nullable();
            $table->integer("number_of_question");
            $table->string("access_type");
            $table->dateTime("due_date")->nullable();
            $table->integer("allowed_attempt");
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
        Schema::dropIfExists('quizzes');
    }
}
