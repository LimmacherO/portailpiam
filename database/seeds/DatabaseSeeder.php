<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Classe principale pour l'appel aux Seeders
     * Permet d'alimenter les tables créés lors de la migration en développement
     *
     * @return void
     */
    public function run()
    {
    	  //$this->call(DomaineTableSeeder::class);
        $this->call(ReferentqiTableSeeder::class);
        $this->call(ReferentProdTableSeeder::class);
        //$this->call(ApplicationTableSeeder::class);
        $this->call(VersionTableSeeder::class);
        $this->call(TacheTypeTableSeeder::class);
        $this->call(TacheTableSeeder::class);
        $this->call(VersionEtatSeeder::class);
    }
}
