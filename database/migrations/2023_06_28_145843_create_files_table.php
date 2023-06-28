<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('files', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('user_id')->nullable();
            $table->unsignedBigInteger('event_id')->nullable();
            $table->string('title')->nullable();
            $table->string('desc')->nullable();
            $table->string('url');
            $table->enum('type', ['doc', 'image', 'audio', 'video']);
            $table->unsignedBigInteger('earned')->default(0);
            $table->timestamps();

            $table->foreign('user_id')->references('id')->on('users')
                ->onDelete('set null');
            $table->foreign('event_id')->references('id')->on('events')
                ->onDelete('set null');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('files');
    }
};
