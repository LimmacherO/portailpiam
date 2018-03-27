<?php

use Illuminate\Database\Seeder;
use App\User;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
      DB::table('users')->delete();

      User::create(array(
          'name' => 'PIAM',
          'username' => 'PIAM',
          'email' => 'piam@rsi.fr',
          'password' => 'PIAM'
      ));
    }
}
