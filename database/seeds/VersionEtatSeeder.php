<?php

use Illuminate\Database\Seeder;
use App\VersionEtat;

class VersionEtatSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('versionetat')->delete();

        VersionEtat::create(array(
          'libelle' => 'Prévue',
    	));

    	VersionEtat::create(array(
          'libelle' => 'En cours',
    	));

    	VersionEtat::create(array(
          'libelle' => 'QI terminée',
    	));

    	VersionEtat::create(array(
          'libelle' => 'Annulée',
    	));

    	VersionEtat::create(array(
          'libelle' => 'Clos',
    	));
    }
}
