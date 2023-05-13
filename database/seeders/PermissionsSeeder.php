<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\PermissionRegistrar;

class PermissionsSeeder extends Seeder
{
    public function run(): void
    {
        // Reset cached roles and permissions
        app()[PermissionRegistrar::class]->forgetCachedPermissions();

        // Create default permissions
        Permission::create(['name' => 'list academicyears']);
        Permission::create(['name' => 'view academicyears']);
        Permission::create(['name' => 'create academicyears']);
        Permission::create(['name' => 'update academicyears']);
        Permission::create(['name' => 'delete academicyears']);

        Permission::create(['name' => 'list complaints']);
        Permission::create(['name' => 'view complaints']);
        Permission::create(['name' => 'create complaints']);
        Permission::create(['name' => 'update complaints']);
        Permission::create(['name' => 'delete complaints']);

        Permission::create(['name' => 'list complaintypes']);
        Permission::create(['name' => 'view complaintypes']);
        Permission::create(['name' => 'create complaintypes']);
        Permission::create(['name' => 'update complaintypes']);
        Permission::create(['name' => 'delete complaintypes']);

        Permission::create(['name' => 'list countries']);
        Permission::create(['name' => 'view countries']);
        Permission::create(['name' => 'create countries']);
        Permission::create(['name' => 'update countries']);
        Permission::create(['name' => 'delete countries']);

        Permission::create(['name' => 'list courses']);
        Permission::create(['name' => 'view courses']);
        Permission::create(['name' => 'create courses']);
        Permission::create(['name' => 'update courses']);
        Permission::create(['name' => 'delete courses']);

        Permission::create(['name' => 'list departments']);
        Permission::create(['name' => 'view departments']);
        Permission::create(['name' => 'create departments']);
        Permission::create(['name' => 'update departments']);
        Permission::create(['name' => 'delete departments']);

        Permission::create(['name' => 'list departmentheads']);
        Permission::create(['name' => 'view departmentheads']);
        Permission::create(['name' => 'create departmentheads']);
        Permission::create(['name' => 'update departmentheads']);
        Permission::create(['name' => 'delete departmentheads']);

        Permission::create(['name' => 'list enrollments']);
        Permission::create(['name' => 'view enrollments']);
        Permission::create(['name' => 'create enrollments']);
        Permission::create(['name' => 'update enrollments']);
        Permission::create(['name' => 'delete enrollments']);

        Permission::create(['name' => 'list lectures']);
        Permission::create(['name' => 'view lectures']);
        Permission::create(['name' => 'create lectures']);
        Permission::create(['name' => 'update lectures']);
        Permission::create(['name' => 'delete lectures']);

        Permission::create(['name' => 'list messages']);
        Permission::create(['name' => 'view messages']);
        Permission::create(['name' => 'create messages']);
        Permission::create(['name' => 'update messages']);
        Permission::create(['name' => 'delete messages']);

        Permission::create(['name' => 'list ntalevels']);
        Permission::create(['name' => 'view ntalevels']);
        Permission::create(['name' => 'create ntalevels']);
        Permission::create(['name' => 'update ntalevels']);
        Permission::create(['name' => 'delete ntalevels']);

        Permission::create(['name' => 'list programs']);
        Permission::create(['name' => 'view programs']);
        Permission::create(['name' => 'create programs']);
        Permission::create(['name' => 'update programs']);
        Permission::create(['name' => 'delete programs']);

        Permission::create(['name' => 'list semesters']);
        Permission::create(['name' => 'view semesters']);
        Permission::create(['name' => 'create semesters']);
        Permission::create(['name' => 'update semesters']);
        Permission::create(['name' => 'delete semesters']);

        Permission::create(['name' => 'list students']);
        Permission::create(['name' => 'view students']);
        Permission::create(['name' => 'create students']);
        Permission::create(['name' => 'update students']);
        Permission::create(['name' => 'delete students']);

        //create student exclusive permissions assign them in array
        $studentPermissions = [
            'list complaints',
            'view complaints',
            'create complaints',
            'update complaints',
            'delete complaints',
            'list messages',
            'view messages',
            'create messages',
            'update messages',
            'delete messages',
            'view students',
            'create students',
            'update students',
            'update roles',
        ];

        $userPermissions = [
            'create lectures',
            'update lectures',
            'delete complaints',
            'list messages',
            'view messages',
            'create messages',
            'update messages',
            'view students',
            'create students',
            'update students',
            'update roles',
            'update permissions',
            'create users',
            'update users',
        ];

        $lecturerRole = [
            'list complaints',
            'view complaints',
            'list messages',
            'view messages',
            'create messages',
            'update messages',
            'delete messages',
            'view lectures',
            'create lectures',
            'update lectures',
            'update roles',
            'update permissions',
        ];

        
        // Create user role and assign existing permissions
        $currentPermissions = Permission::all();
        $userRole = Role::create(['name' => 'user']);
        $userRole->givePermissionTo($userPermissions);
        //create studentRole, assign existing permissions
        $studentRole = Role::create(['name' => 'student']);
        $studentRole->givePermissionTo($studentPermissions);
        //create lecturerRole, assign existing permissions
        $lecturerRole = Role::create(['name' => 'lecturer']);
        $lecturerRole->givePermissionTo($lecturerRole);
        //create genderdeskRole, assign existing permissions
        $genderdeskRole = Role::create(['name' => 'gender-desk']);
        $genderdeskRole->givePermissionTo($currentPermissions);
        //create departmentheadRole, assign existing permissions
        $departmentheadRole = Role::create(['name' => 'department-head']);
        $departmentheadRole->givePermissionTo($currentPermissions);
        

        // Create admin exclusive permissions
        Permission::create(['name' => 'list roles']);
        Permission::create(['name' => 'view roles']);
        Permission::create(['name' => 'create roles']);
        Permission::create(['name' => 'update roles']);
        Permission::create(['name' => 'delete roles']);

        Permission::create(['name' => 'list permissions']);
        Permission::create(['name' => 'view permissions']);
        Permission::create(['name' => 'create permissions']);
        Permission::create(['name' => 'update permissions']);
        Permission::create(['name' => 'delete permissions']);

        Permission::create(['name' => 'list users']);
        Permission::create(['name' => 'view users']);
        Permission::create(['name' => 'create users']);
        Permission::create(['name' => 'update users']);
        Permission::create(['name' => 'delete users']);

        // Create admin role and assign all permissions
        $allPermissions = Permission::all();
        $adminRole = Role::create(['name' => 'super-admin']);
        $adminRole->givePermissionTo($allPermissions);

        $user = \App\Models\User::whereEmail('developer@ludovickonyo.com')->first();

        if ($user) {
            $user->assignRole($adminRole);
        }
    }
}
