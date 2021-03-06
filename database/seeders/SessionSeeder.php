<?php

namespace Database\Seeders;

use App\Models\Session;
use App\Models\User;
use Illuminate\Database\Seeder;

class SessionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $user = User::factory()
            ->create([
               'name' => 'Creighton Magoun',
               'email' => 'magoun@gmail.com'
            ]);
        
        Session::factory()
            ->count(10)
            ->create([
                'user_id' => $user->id
            ]);
    }
}
