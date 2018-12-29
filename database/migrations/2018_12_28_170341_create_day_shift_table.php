<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateDayShiftTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('day_shift', function (Blueprint $table) {
            $table->increments('id');

            $table->integer('day_id')
                ->unsigned()
                ->nullable();

            $table->foreign('day_id')
                ->references('id')
                ->on('days')
                ->onDelete('cascade');

            $table->integer('shift_id')
                ->unsigned()
                ->nullable();

            $table->foreign('shift_id')
                ->references('id')
                ->on('shifts')
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
        Schema::dropIfExists('day_shift');
    }
}
