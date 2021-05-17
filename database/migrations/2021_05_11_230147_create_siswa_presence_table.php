<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSiswaPresenceTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('presence_detail', function (Blueprint $table) {
            $table->id();
            $table->foreignId("siswa_id")->nullable();
            $table->foreign("siswa_id")->references("id")->on("siswa")->onDelete("cascade");
            $table->foreignId("presence_id");
            $table->foreign("presence_id")->references("id")->on("presences")->onDelete("cascade");
            $table->string("status")->nullable();
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
        Schema::dropIfExists('siswa_presence');
    }
}
