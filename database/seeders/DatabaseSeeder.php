<?php

namespace Database\Seeders;

use App\Models\Subject;
use App\Models\Task;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use App\Models\User;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // User::factory(10)->create();

        $users = [
            ['name' => 'ceo', 'email' => 'ceo@gmail.com', 'Role' => 'Admin', 'password'=> 'ceo'],
            ['name' => 'cfo', 'email' => 'cfo@gmail.com', 'Role' => 'Admin', 'password'=> 'cfo'],
            ['name' => 'cio', 'email' => 'cio@gmail.com', 'Role' => 'Admin', 'password'=> 'cio'],
            ['name' => 'cmo', 'email' => 'cmo@gmail.com', 'Role' => 'Admin', 'password'=> 'cmo'],
            ['name' => 'cpo', 'email' => 'cpo@gmail.com', 'Role' => 'Admin', 'password'=> 'cpo'],
            ['name' => 'fave', 'email' => 'fave@gmail.com', 'Role' => 'Staff', 'password'=> 'fave'],
            ['name' => 'rnd', 'email' => 'rnd@gmail.com', 'Role' => 'Staff', 'password'=> 'rnd'],
        ];

        foreach($users as $user){
            User::factory()->create($user);
        }

        Subject::factory(20)->create();
        Task::factory(20)->create();
        
    }
}
