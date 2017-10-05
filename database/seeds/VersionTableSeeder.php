<?php

use Illuminate\Database\Seeder;
use App\Version;
use Carbon\Carbon;

/**
 * VersionTableSeeder: Seeder pour table des versions - pour test en developpement uniquement
 * @Author: Romain Jedynak
 */
class VersionTableSeeder extends Seeder
{
    //function run(): méthode principale pour l'alimentation de la table des versions
    public function run()
    {
        DB::table('versions')->delete();
    	
    	/*Version::create(array(
      		'version' => 'Version 4.0.40',
      		'libelle' => 'RCU - 4.0.40 Correctifs DAI',
          'referentqi_id' => '1',
          'application_id' => '2',
          'referencealfa' => '123456',
          'referentprd_id' => '1',
          'date_mep' =>  Carbon::create('2017', '09', '01'),
          'inc_nblivtma' => '0',
    	));

    	Version::create(array(
      		'version' => 'Version 2.1.70',
      		'libelle' => 'GAC Correctifs divers',
          'referentqi_id' => '2',
          'application_id' => '1',
          'referencealfa' => '654321',
          'referentprd_id' => '2',
          'date_mep' =>  Carbon::create('2017', '10', '01'),
          'inc_nblivtma' => '0',
    	));*/

    }
}
