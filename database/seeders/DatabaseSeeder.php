<?php

namespace Database\Seeders;

use App\Models\User;
use App\Models\CrmProject;
use Illuminate\Database\Eloquent\Factories\Sequence;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // User::factory(10)->create();

        // User::factory()->create([
        //     'name' => 'Test User',
        //     'email' => 'test@example.com',
        // ]);
        CrmProject::factory()
        ->count(5)
        ->state(new Sequence(['segment' => 'scaffolding'],['segment'=> 'safety fence']))
        ->create();
    }
}
