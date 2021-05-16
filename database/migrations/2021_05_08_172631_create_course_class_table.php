<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCourseClassTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('course_class', function (Blueprint $table) {
            $table->foreignId("course_id");
            $table->foreign("course_id")->references("id")->on("courses")->onDelete("cascade");
            $table->foreignId("kelas_id");
            $table->foreign("kelas_id")->references("id")->on("kelas")->onDelete("cascade");
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
        Schema::dropIfExists('course_class');
    }
}
