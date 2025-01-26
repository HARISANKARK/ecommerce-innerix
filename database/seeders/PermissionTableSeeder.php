<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class PermissionTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $permissions = [
            [
                'name' => 'create',
                'guard_name' => 'web'
            ],
            [
                'name' => 'view',
                'guard_name' => 'web'
            ],
            [
                'name' => 'edit',
                'guard_name' => 'web'
            ],
            [
                'name' => 'delete',
                'guard_name' => 'web'
            ],
            [
                'name' => 'categories',
                'guard_name' => 'web'
            ],
            [
                'name' => 'products',
                'guard_name' => 'web'
            ],
            [
                'name' => 'orders',
                'guard_name' => 'web'
            ],
        ];

        foreach ($permissions as $permission) {
            DB::table('permissions')->insert([
                'name' => $permission['name'],
                'guard_name' => $permission['guard_name']
            ]);
        }
    }
}
