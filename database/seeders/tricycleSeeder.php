<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Tricycle;

class tricycleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        
        Tricycle::factory(50)->create();
    }
}
