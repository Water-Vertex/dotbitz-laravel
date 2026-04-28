<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;
use App\Models\User;

class RolesAndPermissionsSeeder extends Seeder
{
    public function run(): void
    {
        app()[\Spatie\Permission\PermissionRegistrar::class]->forgetCachedPermissions();

        // ✅ 'web' guard use karo (sanctum ki jagah)
        $guard = 'web';

        // ========== ALL TABLES/MODULES ==========
        $modules = [
            'students', 'instructors', 'guardians', 'courses', 'batches',
            'assignments', 'assessments', 'quizzes', 'mcqs',
            'announcements', 'faqs', 'policies', 'contacts', 'appointments',
            'class_schedules', 'orders', 'coupons',
        ];

        // Create all permissions
        foreach ($modules as $module) {
            Permission::firstOrCreate([
                'name' => "view_{$module}", 
                'guard_name' => $guard
            ]);
            Permission::firstOrCreate([
                'name' => "create_{$module}", 
                'guard_name' => $guard
            ]);
            Permission::firstOrCreate([
                'name' => "edit_{$module}", 
                'guard_name' => $guard
            ]);
            Permission::firstOrCreate([
                'name' => "delete_{$module}", 
                'guard_name' => $guard
            ]);
        }

        // Extra permissions
        $extraPermissions = ['view_dashboard', 'view_reports', 'manage_roles'];
        foreach ($extraPermissions as $permission) {
            Permission::firstOrCreate([
                'name' => $permission, 
                'guard_name' => $guard
            ]);
        }

        // ========== CREATE ROLES ==========
        
        // 👑 ADMIN - ALL PERMISSIONS
        $admin = Role::firstOrCreate([
            'name' => 'admin', 
            'guard_name' => $guard
        ]);
        $admin->syncPermissions(Permission::all());
        
        // 📊 MANAGER - NO PERMISSIONS (Admin will assign via UI)
        Role::firstOrCreate([
            'name' => 'manager', 
            'guard_name' => $guard
        ]);
        
        // 💰 ACCOUNTS - NO PERMISSIONS
        Role::firstOrCreate([
            'name' => 'accounts', 
            'guard_name' => $guard
        ]);
        
        // 👔 EXECUTIVE - NO PERMISSIONS
        Role::firstOrCreate([
            'name' => 'executive', 
            'guard_name' => $guard
        ]);

        // ========== ASSIGN ROLE TO EXISTING ADMIN ==========
        $adminUser = User::where('email', 'admin@dotbitz.com')->first();
        if ($adminUser) {
            $adminUser->syncRoles(['admin']);
            $this->command->info('✅ Existing admin assigned admin role');
        }

        // ========== CREATE DEMO USERS ==========
        $managerUser = User::firstOrCreate(
            ['email' => 'manager@dotbitz.com'],
            ['name' => 'Manager User', 'password' => bcrypt('password123')]
        );
        $managerUser->assignRole('manager');

        $accountsUser = User::firstOrCreate(
            ['email' => 'accounts@dotbitz.com'],
            ['name' => 'Accounts User', 'password' => bcrypt('password123')]
        );
        $accountsUser->assignRole('accounts');

        $executiveUser = User::firstOrCreate(
            ['email' => 'executive@dotbitz.com'],
            ['name' => 'Executive User', 'password' => bcrypt('password123')]
        );
        $executiveUser->assignRole('executive');

        $this->command->info('=========================================');
        $this->command->info('✅ Roles and Permissions Seeded Successfully!');
        $this->command->info('=========================================');
        $this->command->info('');
        $this->command->info('🔐 Login Credentials:');
        $this->command->info('   Admin:     admin@dotbitz.com (your existing password)');
        $this->command->info('   Manager:   manager@dotbitz.com / password123');
        $this->command->info('   Accounts:  accounts@dotbitz.com / password123');
        $this->command->info('   Executive: executive@dotbitz.com / password123');
    }
}