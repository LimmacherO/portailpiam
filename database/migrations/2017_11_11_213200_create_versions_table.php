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

            $table->string('version'); // "Version MOE"
            $table->string('version_dimensions')->nullable();

            $table->string('libelle');

            $table->string('product_dimensions')->nullable();
            
            $table->integer('application_id')->unsigned();
            $table->foreign('application_id')
                  ->references('id')
                  ->on('application')
                  ->onDelete('cascade')
                  ->onUpdate('cascade');

            //Champs référence ALFA --> taille 6 max
            $table->integer('referencealfa')->nullable();
            $table->date('referencealfa_date')->nullable();

            //Indicateur: nombre de livraison TMA. Actuellement manuel!
            $table->integer('inc_nblivtma')->default(0);

            //enjeux metiers et si ainsi que le QoS calculé lors de la création ou mise à jour
            $table->integer('qos')->default(0);
            $table->integer('enjeuxmetier')->default(0);
            $table->integer('enjeuxsi')->default(0);

            /**
            * Section "Qualification"
            **/
            $table->integer('referentqi_id')->unsigned();
            $table->foreign('referentqi_id')
                  ->references('id')
                  ->on('referentqi')
                  ->onDelete('cascade')
                  ->onUpdate('cascade');

            $table->longText('alerteqi')->nullable();

            $table->integer('avancementqi')->default(0)->nullable();

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
            $table->date('date_mep')->nullable();

            $table->longText('alerteprd')->nullable();

            $table->text('prp_estimationcharge')->nullable(); //estimation charge pré-production
            $table->text('prd_estimationcharge')->nullable(); //estimation charge 

            $table->integer('prd_nbreports')->default(0)->nullable();

            /**
            * Section "Commentaire"
            **/
            $table->longText('commentaire')->nullable();

            $table->integer('versionetat_id')->unsigned();
            $table->foreign('versionetat_id')
                  ->references('id')
                  ->on('versionetat')
                  ->onDelete('cascade')
                  ->onUpdate('cascade');

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
