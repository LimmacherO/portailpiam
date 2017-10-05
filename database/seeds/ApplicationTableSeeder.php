<?php

use Illuminate\Database\Seeder;
use App\Application;

class ApplicationTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
      DB::table('application')->delete();
    	
      //Alimentation des tables du domaine "Affiliation et recouvrement"
    	Application::create(array(
      		'libelle' => 'TAIGA',
      		'domaine_id' => '1',
    	));

    	Application::create(array(
      		'libelle' => 'SAGESS',
      		'domaine_id' => '1',
    	));

      Application::create(array(
          'libelle' => 'BDU',
          'domaine_id' => '1',
      ));

      Application::create(array(
          'libelle' => 'SCR',
          'domaine_id' => '1',
      ));

      Application::create(array(
          'libelle' => 'RIBA',
          'domaine_id' => '1',
      ));

      Application::create(array(
          'libelle' => 'TAPAS',
          'domaine_id' => '1',
      ));

      Application::create(array(
          'libelle' => 'GAC',
          'domaine_id' => '1',
      ));

      Application::create(array(
          'libelle' => 'ANV/CTS',
          'domaine_id' => '1',
      ));

      Application::create(array(
          'libelle' => 'PCA',
          'domaine_id' => '1',
      ));

      Application::create(array(
          'libelle' => 'FICOBA',
          'domaine_id' => '1',
      ));

      //Alimentation des tables du domaine "Décisionnel"
      Application::create(array(
          'libelle' => 'DECISIONNEL',
          'domaine_id' => '2',
      ));

      //Alimentation des tables du domaine "Gestion Interne"
      Application::create(array(
          'libelle' => 'CFRH',
          'domaine_id' => '3',
      ));

      Application::create(array(
          'libelle' => 'ALFA',
          'domaine_id' => '3',
      ));

      //Alimentation des tables du domaine "Optimisation PROD"
      Application::create(array(
          'libelle' => 'IMPVIR',
          'domaine_id' => '4',
      ));

      Application::create(array(
          'libelle' => 'GPND',
          'domaine_id' => '4',
      ));

      Application::create(array(
          'libelle' => 'COLLAD',
          'domaine_id' => '4',
      ));

      Application::create(array(
          'libelle' => 'SCOPMASTER',
          'domaine_id' => '4',
      ));

      Application::create(array(
          'libelle' => 'ARCAD',
          'domaine_id' => '4',
      ));

      Application::create(array(
          'libelle' => 'VPOM',
          'domaine_id' => '4',
      ));

      //Alimentation des tables du domaine "Retation clients"
      Application::create(array(
          'libelle' => 'CALI',
          'domaine_id' => '5',
      ));

      Application::create(array(
          'libelle' => 'GBA',
          'domaine_id' => '5',
      ));

      Application::create(array(
          'libelle' => 'RDVI',
          'domaine_id' => '5',
      ));

      Application::create(array(
          'libelle' => 'GED/GDT',
          'domaine_id' => '5',
      ));

      Application::create(array(
          'libelle' => 'ORCHESTRA/BND',
          'domaine_id' => '5',
      ));

      Application::create(array(
          'libelle' => 'eSTAT',
          'domaine_id' => '5',
      ));

      //Alimentation des tables du domaine "Retraite"
      Application::create(array(
          'libelle' => 'ADAU',
          'domaine_id' => '6',
      ));

      Application::create(array(
          'libelle' => 'INSTANCES COMMUNES',
          'domaine_id' => '6',
      ));

      Application::create(array(
          'libelle' => 'ASUR',
          'domaine_id' => '6',
      ));

      Application::create(array(
          'libelle' => 'RCU',
          'domaine_id' => '6',
      ));

    }
}
