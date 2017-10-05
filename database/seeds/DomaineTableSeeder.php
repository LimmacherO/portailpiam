<?php

use Illuminate\Database\Seeder;
use App\Domaine;

class DomaineTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('domaine')->delete();
    	
    	Domaine::create(array(
          'id' => '1',
      		'libelle' => 'Affi & Recouvrement',
    	));

    	Domaine::create(array(
          'id' => '2',
      		'libelle' => 'Décisionnel',
    	));

      Domaine::create(array(
          'id' => '3',
          'libelle' => 'Gestion Interne',
      ));

      Domaine::create(array(
          'id' => '4',
          'libelle' => 'Optimisation Prod',
      ));

      Domaine::create(array(
          'id' => '5',
          'libelle' => 'Relations Client',
      ));

      Domaine::create(array(
          'id' => '6',
          'libelle' => 'Retraite',
      ));

      Domaine::create(array(
          'id' => '7',
          'libelle' => 'Santé ASS',
      ));

      Domaine::create(array(
          'id' => '8',
          'libelle' => 'Santé Médical',
      ));

      Domaine::create(array(
          'id' => '9',
          'libelle' => 'Santé Prestations',
      ));

      Domaine::create(array(
          'id' => '10',
          'libelle' => 'Téléservices',
      ));

      Domaine::create(array(
          'id' => '11',
          'libelle' => 'Transverse',
      ));

    }
}
