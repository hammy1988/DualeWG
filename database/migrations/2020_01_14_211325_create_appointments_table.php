<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAppointmentsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('appointments', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->bigInteger('flatshare_id')->unsigned();
            $table->string('title');
            $table->string('description');
            $table->dateTime('start_at');
            $table->dateTime('end_at')->nullable()->default(null);;
            $table->boolean('fullday');
            $table->integer('recurring')->default(-1);
            $table->timestamps();
            $table->foreign('flatshare_id')->references('id')->on('flatshares')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('appointments');
    }
}
