<?php

use Illuminate\Database\Seeder;
use App\Referentprd;

/**
 * ReferentprdTableSeeder: Seeder pour table des réferents PRD - pour test en developpement uniquement
 * @Author: Romain Jedynak
 */
class ReferentprdTableSeeder extends Seeder
{

    //function run(): méthode principale pour l'alimentation de la table des référents PRD
    public function run()
    {
      DB::table('referentprd')->delete();
    	
    	Referentprd::create(array(
          'id' => '1',
      		'nom' => 'Bague',
      		'prenom' => 'Danièle',
    	));

    	Referentprd::create(array(
          'id' => '2',
      		'nom' => 'Moreau',
      		'prenom' => 'Patrice',
    	));

    }
}
