<?php

use Illuminate\Database\Seeder;
use App\TacheType;

class TacheTypeTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {

      
      DB::table('tachetype')->delete();
    	
    	TacheType::create(array(
          'libelle' => 'Jalon',
    	));

    	TacheType::create(array(
          'libelle' => 'Tache QI',
    	));

    	TacheType::create(array(
          'libelle' => 'Tache PRP',
    	));

    	TacheType::create(array(
          'libelle' => 'Tache PRD',
    	));

    }
}
