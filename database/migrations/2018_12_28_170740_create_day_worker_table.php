<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateDayWorkerTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('day_worker', function (Blueprint $table) {
            $table->increments('id');

            $table->integer('day_id')
                ->unsigned()
                ->nullable();

            $table->foreign('day_id')
                ->references('id')
                ->on('days')
                ->onDelete('cascade');

            $table->integer('worker_id')
                ->unsigned()
                ->nullable();

            $table->foreign('worker_id')
                ->references('id')
                ->on('workers')
                ->onDelete('cascade');

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
        Schema::dropIfExists('day_worker');
    }
}
