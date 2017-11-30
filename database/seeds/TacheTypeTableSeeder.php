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
          'libelle' => 'Livraison TMA',
    	));

    	TacheType::create(array(
          'libelle' => 'QI/QT',
    	));

    	TacheType::create(array(
          'libelle' => 'Qualification fonctionnelle',
    	));

    	TacheType::create(array(
          'libelle' => 'Recette métier',
    	));

      TacheType::create(array(
          'libelle' => 'Acheminement vers DPE',
      ));

      TacheType::create(array(
          'libelle' => 'Pré production',
      ));

      TacheType::create(array(
          'libelle' => 'Production',
      ));

      TacheType::create(array(
          'libelle' => 'Autre',
      ));

    }
}
