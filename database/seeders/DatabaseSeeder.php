<?php

namespace Database\Seeders;

use App\Models\Listing;
use App\Models\User;
use App\Models\Project;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        User::factory(10)->create();

        $admin = User::factory()->create([
            'name' => 'Administrator Profile',
            'email' => 'admin@example.com',
            'is_admin' => true
        ]);

        Listing::factory(10)->create(['by_user_id' => 1]);
        Listing::factory(10)->create(['by_user_id' => 2]);

        Listing::factory(10)->create(['by_user_id' => 11]);

        $project = Project::firstOrCreate([
            'name' => 'Test Project',
        ]);

        // Associate the project with the administrator user
        $project->users()->syncWithoutDetaching([$admin->id]);
    }
}
