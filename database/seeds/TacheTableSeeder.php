<?php

use Illuminate\Database\Seeder;
use App\Tache;
use Carbon\Carbon;

class TacheTableSeeder extends Seeder
{

    //function run(): méthode principale pour l'alimentation de la table des référents QI
    public function run()
    {
      DB::table('tache')->delete();
    	

      Tache::create(array(
          'label' => 'Livraison TMA',
          'start' => Carbon::create('2017', '09', '04'),
          'end' => Carbon::create('2017', '09', '04'),
          'tachetype_id' => '1',
          'version_id' => '1',
      ));

    	Tache::create(array(
          'label' => 'Qualification technique',
      	  'start' => Carbon::create('2017', '09', '04'),
      	  'end' => Carbon::create('2017', '09', '08'),
          'tachetype_id' => '2',
          'version_id' => '1',
    	));

    	Tache::create(array(
          'label' => 'Qualification fonctionnelle',
      	  'start' => Carbon::create('2017', '09', '09'),
      	  'end' => Carbon::create('2017', '09', '15'),
          'tachetype_id' => '2',
          'version_id' => '1',
    	));


    	Tache::create(array(
          'label' => 'Recette métier',
      	  'start' => Carbon::create('2017', '09', '16'),
      	  'end' => Carbon::create('2017', '10', '15'),
          'tachetype_id' => '2',
          'version_id' => '1',
    	));

    }
}
