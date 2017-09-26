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
      		'libelle' => 'Retraite',
    	));

    	Domaine::create(array(
          	'id' => '2',
      		'libelle' => 'Affiliation',
    	));
    }
}
