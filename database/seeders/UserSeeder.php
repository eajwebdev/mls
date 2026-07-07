<?php

namespace Database\Seeders;

use App\Models\Branch;
use App\Models\User;
use App\Support\Menu;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Schema;

class UserSeeder extends Seeder
{
    public function run(): void
    {
        if (! Schema::hasTable('users')) {
            return;
        }

        $branchId = null;

        if (Schema::hasTable('branches')) {
            $branch = Branch::updateOrCreate(
                ['code' => 'MAIN'],
                [
                    'name' => 'Main Branch',
                    'address' => 'Main Office',
                    'contact_number' => null,
                    'is_active' => true,
                ]
            );

            if ((int) $branch->machine_count === 0) {
                $branch->update(['machine_count' => config('laundry.default_machine_count')]);
            }

            $branchId = $branch->id;
        }

        $users = [
            [
                'name' => 'Super Admin',
                'username' => 'superadmin',
                'email' => 'superadmin@laundry.test',
                'password' => 'superadmin@123',
                'role' => 'super_admin',
                'branch_id' => null,
                'access' => Menu::keys(),
            ],
            [
                'name' => 'Admin',
                'username' => 'admin',
                'email' => 'admin@laundry.test',
                'password' => 'admin@123',
                'role' => 'admin',
                'branch_id' => null,
                'access' => Menu::keys(),
            ],
            [
                'name' => 'Branch Manager',
                'username' => 'manager',
                'email' => 'manager@laundry.test',
                'password' => 'manager@123',
                'role' => 'branch_manager',
                'branch_id' => $branchId,
                'access' => ['dashboard', 'customers', 'services', 'job_orders', 'cycles', 'employees', 'payments', 'receivables', 'po_transactions', 'expenses', 'accounts_payable', 'petty_cash', 'inventory', 'attendance', 'reports', 'sms_logs', 'settings'],
            ],
            [
                'name' => 'Cashier User',
                'username' => 'cashier',
                'email' => 'cashier@laundry.test',
                'password' => 'cashier@123',
                'role' => 'cashier',
                'branch_id' => $branchId,
                'access' => ['dashboard', 'customers', 'job_orders', 'cycles', 'payments', 'receivables', 'po_transactions'],
            ],
            [
                'name' => 'Staff User',
                'username' => 'staff',
                'email' => 'staff@laundry.test',
                'role' => 'staff',
                'branch_id' => $branchId,
                'access' => ['dashboard', 'job_orders', 'cycles'],
            ],
        ];

        foreach ($users as $user) {
            User::updateOrCreate(
                ['username' => $user['username']],
                [
                    'name' => $user['name'],
                    'email' => $user['email'],
                    'email_verified_at' => now(),
                    'password' => $user['password'] ?? 'admin123',
                    'role' => $user['role'],
                    'branch_id' => $user['branch_id'],
                    'access' => $user['access'],
                    'status' => 'active',
                ]
            );
        }
    }
}
