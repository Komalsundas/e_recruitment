<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use App\Models\User;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // Create Admin user
        $admin = User::factory()->create([
            'name' => 'Admin',
            'email' => 'hr@bt.bt',
            'password' => Hash::make('12345678'),
        ]);

        // Create Super Admin user
        $superAdmin = User::factory()->create([
            'name' => 'Super Admin',
            'email' => 'itservices@bt.bt',
            'password' => Hash::make('it@2024'),
            // Add any other super admin-specific fields here
        ]);


        // Additional seeders..
        $this->call(EmploymentTypeSeeder::class);
        $this->call(QualificationSeeder::class);
}
}