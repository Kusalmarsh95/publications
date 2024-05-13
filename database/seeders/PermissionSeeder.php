<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Permission;

class PermissionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {

        $permissions = [

            'administration',
            'administration-user',
            'administration-user-create',
            'administration-user-edit',
            'administration-user-delete',
            'administration-role',
            'administration-role-create',
            'administration-role-edit',
            'administration-role-delete',

            'master-data',
            'master-data-unit',
            'master-data-unit-create',
            'master-data-unit-edit',
            'master-data-unit-delete',
            'master-data-items-category',
            'master-data-items-category-create',
            'master-data-items-category-edit',
            'master-data-items-category-delete',
            'master-data-items',
            'master-data-items-create',
            'master-data-items-edit',
            'master-data-items-delete',
            'master-data-service-category',
            'master-data-service-category-create',
            'master-data-service-category-edit',
            'master-data-service-category-delete',
            'master-data-service',
            'master-data-service-create',
            'master-data-service-edit',
            'master-data-service-delete',

            'stock-management',
            'stock-management-suppliers',
            'stock-management-suppliers-create',
            'stock-management-suppliers-edit',
            'stock-management-suppliers-delete',
            'stock-management-workers',
            'stock-management-workers-create',
            'stock-management-workers-edit',
            'stock-management-workers-delete',
            'stock-management-purchase',
            'stock-management-purchase-create',
            'stock-management-purchase-edit',
            'stock-management-purchase-delete',
            'stock-management-issues',
            'stock-management-issues-create',
            'stock-management-issues-edit',
            'stock-management-issues-delete',

            'publication-management',
            'publication-management-customers',
            'publication-management-customers-create',
            'publication-management-customers-edit',
            'publication-management-customers-delete',
            'publication-management-orders',
            'publication-management-orders-create',
            'publication-management-orders-edit',
            'publication-management-orders-all',
            'publication-management-orders-reject',
            'publication-management-orders-complete',
            'publication-management-orders-forward',

        ];

        foreach ($permissions as $permission) {
            Permission::firstOrCreate(['name' => $permission, 'guard_name' => 'web']);
        }
    }
}
