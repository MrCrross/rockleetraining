<?php

namespace Migrations;

use Illuminate\Database\Capsule\Manager as Capsule;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateExercisesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Capsule::schema()->create('exercises', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->integer('time')->unsigned();
            $table->text('description');
            $table->integer('level')->unsigned();
            $table->bigInteger('exercise_type_id')->unsigned();
            $table->foreign('exercise_type_id')
                ->references('id')
                ->on('exercise_types')
                ->onDelete('restrict');
            $table->bigInteger('training_id')->unsigned();
            $table->foreign('training_id')
                ->references('id')
                ->on('trainings')
                ->onDelete('restrict');
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
        Capsule::schema()->dropIfExists('exercises');
    }

}