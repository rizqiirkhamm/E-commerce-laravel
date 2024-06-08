<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class AdminSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
     $user = new \App\Models\User;
     $user->name = 'master';
     $user->email = 'master@test.com';
     $user->password = 'master123';
     $user->level = 'admin';
     $user->save();
    }
   
}
