<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;
use Spatie\Permission\PermissionRegistrar;

class UserRolePermissionSeeder extends Seeder
{
    /**
     * Seed roles, permissions, dan users lengkap.
     */
    public function run(): void
    {
        // Reset cached roles and permissions
        app()[PermissionRegistrar::class]->forgetCachedPermissions();

        // ==============================
        // PERMISSIONS
        // ==============================
        $permissions = [
            // User management
            'View Any User', 'View User', 'Create User', 'Update User',
            'Delete User', 'Restore User', 'Force Delete User',

            // Role management
            'View Any Role', 'View Role', 'Create Role', 'Update Role',
            'Delete Role', 'Restore Role', 'Force Delete Role',

            // Permission management
            'View Any Permission', 'View Permission', 'Create Permission',
            'Update Permission', 'Delete Permission', 'Restore Permission',
            'Force Delete Permission',

            // Incident management
            'View Any Incident', 'View Incident', 'Create Incident',
            'Update Incident', 'Delete Incident',

            // Accident management
            'View Any Accident', 'View Accident', 'Create Accident',
            'Update Accident', 'Delete Accident',

            // Follow Up management
            'View Any Follow Up', 'View Follow Up', 'Create Follow Up',
            'Update Follow Up', 'Delete Follow Up',

            // Development management
            'View Any Development', 'View Development', 'Create Development',
            'Update Development', 'Delete Development',

            // Approval
            'Approve Incident',
        ];

        foreach ($permissions as $permission) {
            Permission::firstOrCreate(['name' => $permission]);
        }

        // ==============================
        // ROLES & THEIR PERMISSIONS
        // ==============================
        $roles = [
            'Administrator' => $permissions, // Administrator mendapat semua permission

            'Direktur' => [
                'View Any Incident', 'View Incident',
                'View Any Accident', 'View Accident',
                'View Any Follow Up', 'View Follow Up',
                'View Any Development', 'View Development',
                'Approve Incident',
            ],

            'PIC' => [
                'View Any Incident', 'View Incident',
                'View Any Accident', 'View Accident',
                'View Any Follow Up', 'View Follow Up', 'Create Follow Up', 'Update Follow Up',
                'View Any Development', 'View Development', 'Create Development', 'Update Development',
            ],

            'User' => [
                'View Any Incident', 'View Incident', 'Create Incident', 'Update Incident',
                'View Any Accident', 'View Accident', 'Create Accident', 'Update Accident',
            ],
        ];

        foreach ($roles as $roleName => $rolePermissions) {
            $role = Role::firstOrCreate(['name' => $roleName]);
            $role->syncPermissions($rolePermissions);
        }

        // ==============================
        // USERS
        // ==============================
        $users = [
            [
                'name'     => 'Super Admin',
                'email'    => 'admin@sispensi.com',
                'nip'      => 'ADM-001',
                'password' => Hash::make('12345678'),
                'role'     => 'Administrator',
            ],
            [
                'name'     => 'Ir. Budi Hartono',
                'email'    => 'direktur@sispensi.com',
                'nip'      => 'DIR-001',
                'password' => Hash::make('12345678'),
                'role'     => 'Direktur',
            ],
            [
                'name'     => 'Agus Prasetyo',
                'email'    => 'pic@sispensi.com',
                'nip'      => 'PIC-001',
                'password' => Hash::make('12345678'),
                'role'     => 'PIC',
            ],
            [
                'name'     => 'Rizky Maulana',
                'email'    => 'pic2@sispensi.com',
                'nip'      => 'PIC-002',
                'password' => Hash::make('12345678'),
                'role'     => 'PIC',
            ],
            [
                'name'     => 'Andi Setiawan',
                'email'    => 'user@sispensi.com',
                'nip'      => 'USR-001',
                'password' => Hash::make('12345678'),
                'role'     => 'User',
            ],
            [
                'name'     => 'Siti Rahayu',
                'email'    => 'user2@sispensi.com',
                'nip'      => 'USR-002',
                'password' => Hash::make('12345678'),
                'role'     => 'User',
            ],
            [
                'name'     => 'Doni Firmansyah',
                'email'    => 'user3@sispensi.com',
                'nip'      => 'USR-003',
                'password' => Hash::make('12345678'),
                'role'     => 'User',
            ],
        ];

        foreach ($users as $userData) {
            $user = User::firstOrCreate(
                ['email' => $userData['email']],
                [
                    'name'     => $userData['name'],
                    'nip'      => $userData['nip'],
                    'password' => $userData['password'],
                ]
            );

            $user->assignRole($userData['role']);
        }

        $this->command->info('✅ Roles, Permissions, dan Users berhasil di-seed!');
        $this->command->table(
            ['Name', 'Email', 'Role'],
            collect($users)->map(fn($u) => [$u['name'], $u['email'], $u['role']])->toArray()
        );
    }
}
