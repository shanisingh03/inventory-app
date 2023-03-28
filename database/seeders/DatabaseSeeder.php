<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        

        \App\Models\User::factory()->create([
            'name' => 'Admin User',
            'role_id' => 1,
            'email' => 'admin@inventory-app.test',
        ]);
        \App\Models\User::factory()->create([
            'name' => 'Moderator User',
            'role_id' => 2,
            'email' => 'moderator@inventory-app.test',
        ]);
        \App\Models\User::factory()->create([
            'name' => 'Client',
            'role_id' => 3,
            'email' => 'client@inventory-app.test',
        ]);


        // Product
        \App\Models\Product::factory(10)->create();
    }
}
