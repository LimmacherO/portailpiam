<?php

use Illuminate\Database\Seeder;
use App\Tache;
use Carbon\Carbon;

class TacheTableSeeder extends Seeder
{

    //function run(): méthode principale pour l'alimentation de la table des référents QI
    public function run()
    {
      DB::table('tache')->delete();
    }
}
