<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTacheTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tache', function(Blueprint $table) {
            $table->increments('id');
            $table->string('label'); //en anglais pour les besoins du module gantt
            $table->date('start'); //en anglais pour les besoins du module gantt
            $table->date('end'); //en anglais pour les besoins du module gantt


            $table->integer('tachetype_id')->unsigned();
            $table->foreign('tachetype_id')
                  ->references('id')
                  ->on('tachetype')
                  ->onDelete('restrict')
                  ->onUpdate('restrict');

            $table->integer('version_id')->unsigned();
            $table->foreign('version_id')
                  ->references('id')
                  ->on('versions')
                  ->onDelete('restrict')
                  ->onUpdate('restrict');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('tache');
    }
}
