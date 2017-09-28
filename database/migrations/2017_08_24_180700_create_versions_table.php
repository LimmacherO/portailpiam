<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateVersionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('versions', function(Blueprint $table) {

            //ID d'identification de la version
            $table->increments('id');

            //Timestamps de la version --> utile pour du suivi
            $table->timestamps();

            $table->string('version');
            $table->string('libelle');
            


            $table->integer('application_id')->unsigned();
            $table->foreign('application_id')
                  ->references('id')
                  ->on('application')
                  ->onDelete('cascade')
                  ->onUpdate('cascade');

            //Champs référence ALFA --> taille 6 max
            $table->integer('referencealfa');

            //Indicateur: nombre de livraison TMA. Actuellement manuel!
            $table->integer('inc_nblivtma');

            /**
            * Section "Qualification"
            **/
            $table->integer('referentqi_id')->unsigned();
            $table->foreign('referentqi_id')
                  ->references('id')
                  ->on('referentqi')
                  ->onDelete('cascade')
                  ->onUpdate('cascade');

            $table->longText('alerteqi')->default('')->nullable();

            /**
            * Section "Production"
            **/
            //Référent production
            $table->integer('referentprd_id')->unsigned();
            $table->foreign('referentprd_id')
                  ->references('id')
                  ->on('referentprd')
                  ->onDelete('cascade')
                  ->onUpdate('cascade');

            // Date de mise en production
            $table->date('date_mep');

            $table->longText('alerteprd')->default('')->nullable();

            /**
            * Section "Commentaire"
            **/
            $table->longText('commentaire')->default('')->nullable();

        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('versions');
    }
}
