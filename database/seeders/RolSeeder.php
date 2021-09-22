<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;

class RolSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $role = Role::create(['name'=>'admin']);
        $rol_vendedor = Role::create(['name'=>'vendedor']);

        Permission::create(['name'=>'categories.index'])->assignRole($role);
        Permission::create(['name'=>'categories.create'])->assignRole($role);
        Permission::create(['name'=>'categories.edit'])->assignRole($role);
        Permission::create(['name'=>'categories.update'])->assignRole($role);
        Permission::create(['name'=>'categories.destroy'])->assignRole($role);

        Permission::create(['name'=>'client.index'])->assignRole($role);
        Permission::create(['name'=>'client.create'])->assignRole($role);
        Permission::create(['name'=>'client.edit'])->assignRole($role);
        Permission::create(['name'=>'client.update'])->assignRole($role);
        Permission::create(['name'=>'client.destroy'])->assignRole($role);

        Permission::create(['name'=>'product.index'])->assignRole($role);
        Permission::create(['name'=>'product.create'])->assignRole($role);
        Permission::create(['name'=>'product.edit'])->assignRole($role);
        Permission::create(['name'=>'product.update'])->assignRole($role);
        Permission::create(['name'=>'product.destroy'])->assignRole($role);

        Permission::create(['name'=>'providers.index'])->assignRole($role,$rol_vendedor);
        Permission::create(['name'=>'providers.create'])->assignRole($role,$rol_vendedor);
        Permission::create(['name'=>'providers.edit'])->assignRole($role,$rol_vendedor);
        Permission::create(['name'=>'providers.update'])->assignRole($role,$rol_vendedor);
        Permission::create(['name'=>'providers.destroy'])->assignRole($role);

        Permission::create(['name'=>'purchases.index'])->assignRole($role,$rol_vendedor);
        Permission::create(['name'=>'purchases.create'])->assignRole($role,$rol_vendedor);
        Permission::create(['name'=>'purchases.edit'])->assignRole($role,$rol_vendedor);
        Permission::create(['name'=>'purchases.update'])->assignRole($role,$rol_vendedor);
        Permission::create(['name'=>'purchases.destroy'])->assignRole($role);

        Permission::create(['name'=>'sales.index'])->assignRole($role,$rol_vendedor);
        Permission::create(['name'=>'sales.create'])->assignRole($role,$rol_vendedor);
        Permission::create(['name'=>'sales.edit'])->assignRole($role,$rol_vendedor);
        Permission::create(['name'=>'sales.update'])->assignRole($role,$rol_vendedor);
        Permission::create(['name'=>'sales.destroy'])->assignRole($role,$rol_vendedor);

        Permission::create(['name'=>'purchase.upload'])->assignRole($role,$rol_vendedor);
        Permission::create(['name'=>'purchase.change_status'])->assignRole($role,$rol_vendedor);
        Permission::create(['name'=>'product.change_status'])->assignRole($role,$rol_vendedor);
        Permission::create(['name'=>'sale.change_status'])->assignRole($role,$rol_vendedor);

        Permission::create(['name'=>'purchases.pdf'])->assignRole($role,$rol_vendedor);
        Permission::create(['name'=>'sales.pdf'])->assignRole($role,$rol_vendedor);
        Permission::create(['name'=>'sales.print'])->assignRole($role,$rol_vendedor);
        Permission::create(['name'=>'report.report_day'])->assignRole($role);
        Permission::create(['name'=>'report.report_date'])->assignRole($role);
        Permission::create(['name'=>'report.report_results'])->assignRole($role);

        Permission::create(['name'=>'business.index'])->assignRole($role);
        Permission::create(['name'=>'business.update'])->assignRole($role);

        Permission::create(['name'=>'printer.index'])->assignRole($role);
        Permission::create(['name'=>'printer.update'])->assignRole($role);

        Permission::create(['name'=>'users.index'])->assignRole($role);
        Permission::create(['name'=>'users.create'])->assignRole($role);
        Permission::create(['name'=>'users.edit'])->assignRole($role);
        Permission::create(['name'=>'users.update'])->assignRole($role);
        Permission::create(['name'=>'users.destroy'])->assignRole($role);

        Permission::create(['name'=>'roles.index'])->assignRole($role);
        Permission::create(['name'=>'roles.create'])->assignRole($role);
        Permission::create(['name'=>'roles.edit'])->assignRole($role);
        Permission::create(['name'=>'roles.update'])->assignRole($role);
        Permission::create(['name'=>'roles.destroy'])->assignRole($role);

    }
}

