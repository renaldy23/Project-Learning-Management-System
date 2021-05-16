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
            $table->id();
            $table->foreignId("task_id");
            $table->foreign("task_id")->references("id")->on("tasks")->onDelete("cascade");
            $table->foreignId("siswa_id")->nullable();
            $table->foreign("siswa_id")->references("id")->on("siswa")->onDelete("cascade");
            $table->string("online_text")->nullable();
            $table->string("attach_files")->nullable();
            $table->string("status")->nullable();
            $table->integer("grade")->nullable();
            $table->dateTime("submitted_at")->nullable();
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
