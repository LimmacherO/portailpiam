<?php

use Illuminate\Database\Seeder;
use App\Application;

class ApplicationTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
      DB::table('application')->delete();
    	
    	Application::create(array(
          'id' => '1',
      		'libelle' => 'GAC',
      		'domaine_id' => '2',
    	));

    	Application::create(array(
          'id' => '2',
      		'libelle' => 'RCU',
      		'domaine_id' => '1',
    	));
    }
}
