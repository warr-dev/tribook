<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use App\Models\User;
use App\Models\Tricycle;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        // \App\Models\User::factory(10)->create();
        $user=new User();
        $user->username='admin';
        $user->acctype='admin';
        $user->cpnum='09321465987';
        $user->password=Hash::make('admin123');
        $user->save();

        Tricycle::factory(50)->create();

        
    }
}
