<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateDomaineTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('domaine', function(Blueprint $table) {
            $table->increments('id');
            $table->string('libelle')->unique();
            $table->string('export_background_color')->default('#FFFFFF'); //Couleur de fond lors export de ce domaine
            $table->string('export_font_color')->default('#000000'); //Couleur du texte lors export de ce domaine
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('domaine');
    }
}
