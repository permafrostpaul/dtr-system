<?php

namespace Database\Seeders;

use App\Models\User;
use App\Models\Event;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // Seed users
        User::factory()->create([
            'lastname' => 'Test User',
            'email' => 'test@example.com',
        ]);

        // Seed events
        Event::create([
            'title' => 'Sample Event 1',
            'description' => 'This is a description for Sample Event 1.',
            'start_date' => '2024-08-27',
            'end_date' => '2024-08-27',
        ]);

        Event::create([
            'title' => 'Sample Event 2',
            'description' => 'This is a description for Sample Event 2.',
            'start_date' => '2024-09-01',
            'end_date' => '2024-09-01',
        ]);

        // Add more events as needed
    }
}
