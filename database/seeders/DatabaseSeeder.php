<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    use WithoutModelEvents;

    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        $this->call([
            RoleSeeder::class,
        ]);

        $user = User::factory()->create([
            'name' => 'Test User',
            'email' => 'test@example.com',
        ]);
        $user->addMediaFromUrl('https://cdn-icons-png.flaticon.com/512/6596/6596121.png')->toMediaCollection('avatar');
        $user->assignRole('super-admin');
        
        // User::factory(10)->create();
    }
}
