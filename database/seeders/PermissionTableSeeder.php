<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Permission;

class PermissionTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $permissions = [
            [
                'id' => 1,
                'name' => 'dashboard.view',
                'group' => 'dashboard',
            ],
            [
                'id' => 2,
                'name' => 'users.view',
                'group' => 'users',
            ],
            [
                'id' => 3,
                'name' => 'users.create',
                'group' => 'users',
            ],
            [
                'id' => 4,
                'name' => 'users.edit',
                'group' => 'users',
            ],
            [
                'id' => 5,
                'name' => 'users.delete',
                'group' => 'users',
            ],
            [
                'id' => 6,
                'name' => 'users.toggle_status',
                'group' => 'users',
            ],
            [
                'id' => 7,
                'name' => 'users.change_password',
                'group' => 'users',
            ],
            [
                'id' => 8,
                'name' => 'wards.view',
                'group' => 'masters',
            ],
            [
                'id' => 9,
                'name' => 'wards.create',
                'group' => 'masters',
            ],
            [
                'id' => 10,
                'name' => 'wards.edit',
                'group' => 'masters',
            ],
            [
                'id' => 11,
                'name' => 'wards.delete',
                'group' => 'masters',
            ],
            [
                'id' => 12,
                'name' => 'locations.view',
                'group' => 'masters',
            ],
            [
                'id' => 13,
                'name' => 'locations.create',
                'group' => 'masters',
            ],
            [
                'id' => 14,
                'name' => 'locations.edit',
                'group' => 'masters',
            ],
            [
                'id' => 15,
                'name' => 'locations.delete',
                'group' => 'masters',
            ],
            [
                'id' => 16,
                'name' => 'banners.view',
                'group' => 'masters',
            ],
            [
                'id' => 17,
                'name' => 'banners.create',
                'group' => 'masters',
            ],
            [
                'id' => 18,
                'name' => 'banners.edit',
                'group' => 'masters',
            ],
            [
                'id' => 19,
                'name' => 'banners.delete',
                'group' => 'masters',
            ],
            [
                'id' => 20,
                'name' => 'police_stations.view',
                'group' => 'masters',
            ],
            [
                'id' => 21,
                'name' => 'police_stations.create',
                'group' => 'masters',
            ],
            [
                'id' => 22,
                'name' => 'police_stations.edit',
                'group' => 'masters',
            ],
            [
                'id' => 23,
                'name' => 'police_stations.delete',
                'group' => 'masters',
            ],
            [
                'id' => 24,
                'name' => 'documents.view',
                'group' => 'masters',
            ],
            [
                'id' => 25,
                'name' => 'documents.create',
                'group' => 'masters',
            ],
            [
                'id' => 26,
                'name' => 'documents.edit',
                'group' => 'masters',
            ],
            [
                'id' => 27,
                'name' => 'documents.delete',
                'group' => 'masters',
            ],
            [
                'id' => 28,
                'name' => 'change-password',
                'group' => 'users',
            ],
            [
                'id' => 29,
                'name' => 'application-form',
                'group' => 'frontend',
            ],
            [
                'id' => 30,
                'name' => 'police-request.pending',
                'group' => 'police',
            ],
            [
                'id' => 31,
                'name' => 'police-request.rejected',
                'group' => 'police',
            ],
            [
                'id' => 32,
                'name' => 'police-request.approved',
                'group' => 'police',
            ],
            [
                'id' => 33,
                'name' => 'cancel-application',
                'group' => 'frontend',
            ],
            [
                'id' => 34,
                'name' => 'make-payment',
                'group' => 'frontend',
            ],
            [
                'id' => 35,
                'name' => 'qr-code',
                'group' => 'frontend',
            ],
            [
                'id' => 36,
                'name' => 'certificate',
                'group' => 'frontend',
            ],
            [
                'id' => 37,
                'name' => 'report.view',
                'group' => 'police',
            ],
        ];

        foreach ($permissions as $permission) {
            Permission::updateOrCreate([
                'id' => $permission['id']
            ], [
                'id' => $permission['id'],
                'name' => $permission['name'],
                'group' => $permission['group']
            ]);
        }
    }
}
