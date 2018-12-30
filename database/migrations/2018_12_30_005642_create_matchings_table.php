<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateMatchingsTable extends Migration
{

    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('matchings', function (Blueprint $table) {
            $table->increments('id');
            $table->timestamps();

            $table->integer('shift_id')->unsigned();
            $table->foreign('shift_id')
                ->references('id')->on('shifts')
                ->onDelete('cascade');

            $table->integer('worker_id')->unsigned();
            $table->foreign('worker_id')
                ->references('id')->on('workers')
                ->onDelete('cascade');

            $table->unique(['shift_id', 'worker_id']);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('matchings');
    }
}
