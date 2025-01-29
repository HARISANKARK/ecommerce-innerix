<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class PersonalAccessTokenTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('personal_access_tokens')->insert([
            'tokenable_type' => 'App\Models\User',
            'tokenable_id' => 1,
            'name' => 'Super-admin',
            'token' => '71047db427a6b1a6a74a678015d68f4d2f9dd0a1ae327b3ed750a3e02c2920bc',
            'abilities' => '["*"]',
            'last_used_at' => '2025-01-29 13:16:29',
            'created_at' => now(),
            'updated_at' => now(),
        ]);
    }
}
