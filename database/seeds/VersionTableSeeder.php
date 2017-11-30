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
    }
}
