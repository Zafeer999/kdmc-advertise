<?php

namespace Database\Seeders;

use App\Models\Tenant;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

class DefaultLoginUserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Super Admin Seeder ##
        $superAdminRole = Role::updateOrCreate(['name' => 'Super Admin']);
        $permissions = Permission::pluck('id','id')->all();
        $superAdminRole->syncPermissions($permissions);

        $user = User::updateOrCreate([
            'email' => 'superadmin@gmail.com'
        ],[
            'name' => 'Core Ocean',
            'email' => 'superadmin@gmail.com',
            'mobile' => '9999999991',
            'password' => Hash::make('12345678'),
        ]);
        $user->assignRole([$superAdminRole->id]);




        // Admin Seeder ##
        $adminRole = Role::updateOrCreate(['name' => 'Admin']);
        $permissions = Permission::pluck('id','id')->all();
        $adminRole->syncPermissions($permissions);

        $user = User::updateOrCreate([
            'email' => 'admin@gmail.com'
        ],[
            'name' => 'Admin',
            'email' => 'admin@gmail.com',
            'mobile' => '9999999992',
            'password' => Hash::make('12345678'),
        ]);
        $user->assignRole([$adminRole->id]);



        // Police Seeder ##
        $policeRole = Role::updateOrCreate(['name' => 'Police']);
        $permissions = Permission::where('group', 'police')->orWhere('group', 'dashboard')->pluck('id','id');
        $policeRole->syncPermissions($permissions);

        $user = User::updateOrCreate([
            'email' => 'police@gmail.com'
        ],[
            'ward_id' => '1',
            'police_station_id' => '1',
            'name' => 'Police',
            'email' => 'police@gmail.com',
            'mobile' => '9999999993',
            'password' => Hash::make('12345678'),
        ]);
        $user->assignRole([$policeRole->id]);




        // Ward Seeder ##
        $wardRole = Role::updateOrCreate(['name' => 'Ward']);
        $permissions = Permission::where('group', 'police')->orwhereIn('id', [29, 33, 37])->orWhere('group', 'dashboard')->pluck('id','id');
        $wardRole->syncPermissions($permissions);

        $user = User::updateOrCreate([
            'email' => 'ward@gmail.com'
        ],[
            'ward_id' => '1',
            'name' => 'Ward',
            'email' => 'ward@gmail.com',
            'mobile' => '9999999994',
            'password' => Hash::make('12345678'),
        ]);
        $user->assignRole([$wardRole->id]);




        // User Seeder ##
        $userRole = Role::updateOrCreate(['name' => 'User']);
        $permissions = Permission::where('group', 'frontend')->orWhere('group', 'dashboard')->pluck('id','id');
        $userRole->syncPermissions($permissions);

        $user = User::updateOrCreate([
            'email' => 'user1@gmail.com'
        ],[
            'name' => 'User 1',
            'email' => 'user1@gmail.com',
            'mobile' => '9999999995',
            'password' => Hash::make('12345678'),
        ]);
        $user->assignRole([$userRole->id]);

        $user = User::updateOrCreate([
            'email' => 'user2@gmail.com'
        ],[
            'name' => 'User 2',
            'email' => 'user2@gmail.com',
            'mobile' => '9999999996',
            'password' => Hash::make('12345678'),
        ]);
        $user->assignRole([$userRole->id]);


    }
}
