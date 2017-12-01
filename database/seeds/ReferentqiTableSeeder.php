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
      		'nom' => 'Jedynak',
      		'prenom' => 'Romain',
    	));

    	Referentqi::create(array(
          'id' => '2',
      		'nom' => 'Hennequin',
      		'prenom' => 'Stéphane',
    	));

      Referentqi::create(array(
          'id' => '3',
          'nom' => 'Herb',
          'prenom' => 'Jean',
      ));

      Referentqi::create(array(
          'id' => '4',
          'nom' => 'Lemore',
          'prenom' => 'Jean-françois',
      ));

      Referentqi::create(array(
          'id' => '5',
          'nom' => 'Richard',
          'prenom' => 'Quentin',
      ));

      Referentqi::create(array(
          'id' => '6',
          'nom' => 'Mojahid',
          'prenom' => 'Bouchaib',
      ));

      Referentqi::create(array(
          'id' => '7',
          'nom' => 'Lombardo',
          'prenom' => 'Pascal',
      ));

      Referentqi::create(array(
          'id' => '8',
          'nom' => 'Weil',
          'prenom' => 'Dany',
      ));

      Referentqi::create(array(
          'id' => '9',
          'nom' => 'Ehrbar',
          'prenom' => 'Frédéric',
      ));


    }
}
