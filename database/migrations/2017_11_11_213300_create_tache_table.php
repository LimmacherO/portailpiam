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
            $table->string('libelle');
            $table->date('debut')->nullable();
            $table->date('fin')->nullable();

            $table->integer('tachetype_id')->unsigned();
            $table->foreign('tachetype_id')
                  ->references('id')
                  ->on('tachetype')
                  ->onDelete('cascade')
                  ->onUpdate('cascade');

            $table->integer('version_id')->unsigned();
            $table->foreign('version_id')
                  ->references('id')
                  ->on('versions')
                  ->onDelete('cascade')
                  ->onUpdate('cascade');

            $table->boolean('deletable')->default(true);

            //Si la tâche est un jalon alors true, sinon false
            $table->boolean('jalon')->default(true);

            //Ordre de la tâche
            $table->integer('num_order');

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
