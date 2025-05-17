<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateVoiceRecordingsTable extends Migration
{
    public function up()
    {
        Schema::create('voice_recordings', function (Blueprint $table) {
            $table->id();
            // $table->unsignedBigInteger('customization_id')->nullable(); // Foreign key to customizations table
            $table->unsignedBigInteger('user_id');
            $table->string('file_path'); // Path to the audio file
            $table->integer('file_size')->nullable(); // Size of the file
            $table->string('file_type')->nullable(); // Type of the file (mp3, wav, etc.)
            $table->timestamps();
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
            // Foreign Key constraint to customizations table
            // $table->foreign('customization_id')->references('id')->on('customizations')->onDelete('cascade');
        });
    }

    public function down()
    {
        Schema::dropIfExists('voice_recordings');
    }
}
