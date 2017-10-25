<?php

use Illuminate\Database\Seeder;
use App\Entities\User;
use Illuminate\Support\Facades\Hash;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
       $this->makeFirstUser();
    }

    private function makeFirstUser()
    {
        User::firstOrCreate([
             'id' => '1',
             'name' => 'Master',
             'last_name' => 'Ultra',
             'email' => 'master.ultra@email.com.br',
             'password' => Hash::make('secret'),
             'api_token' => 'd0e528d984b0fbb4817d02aa2c418d35e2411511',
             'remember_token' => 'd0e528d984b0fbb4817d02aa2c418d35e2411511'
         ]);
    }
}
