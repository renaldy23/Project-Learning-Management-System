<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateQuestionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('questions', function (Blueprint $table) {
            $table->id();
            $table->foreignId("quiz_id");
            $table->foreign("quiz_id")->references("id")->on("quizzes")->onDelete("cascade");
            $table->integer("number");
            $table->longText("question_title");
            $table->char("option_a")->nullable();
            $table->char("option_b")->nullable();
            $table->char("option_c")->nullable();
            $table->char("option_d")->nullable();
            $table->char("key")->nullable();
            $table->double("nilai");
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
        Schema::dropIfExists('questions');
    }
}
