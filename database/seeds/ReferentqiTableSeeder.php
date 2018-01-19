<?php

use Illuminate\Database\Seeder;
use App\Referentqi;

/**
 * ReferentqiTableSeeder: Seeder pour table des réferents QI - pour test en developpement uniquement
 * @Author: Romain Jedynak
 */
class ReferentqiTableSeeder extends Seeder
{

    //function run(): méthode principale pour l'alimentation de la table des référents QI
    public function run()
    {
      DB::table('referentqi')->delete();

    	Referentqi::create(array(
          'id' => '1',
      		'nom' => 'Non renseigné',
          'prenom' => '',
    	));
    }
}
