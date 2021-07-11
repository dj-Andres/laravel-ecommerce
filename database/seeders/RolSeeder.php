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

        Permission::create(['name'=>'providers.index'])->assignRole($role);
        Permission::create(['name'=>'providers.create'])->assignRole($role);
        Permission::create(['name'=>'providers.edit'])->assignRole($role);
        Permission::create(['name'=>'providers.update'])->assignRole($role);
        Permission::create(['name'=>'providers.destroy'])->assignRole($role);

        Permission::create(['name'=>'purchases.index'])->assignRole($role);
        Permission::create(['name'=>'purchases.create'])->assignRole($role);
        Permission::create(['name'=>'purchases.edit'])->assignRole($role);
        Permission::create(['name'=>'purchases.update'])->assignRole($role);
        Permission::create(['name'=>'purchases.destroy'])->assignRole($role);

        Permission::create(['name'=>'sales.index'])->assignRole($role);
        Permission::create(['name'=>'sales.create'])->assignRole($role);
        Permission::create(['name'=>'sales.edit'])->assignRole($role);
        Permission::create(['name'=>'sales.update'])->assignRole($role);
        Permission::create(['name'=>'sales.destroy'])->assignRole($role);

        Permission::create(['name'=>'purchase.upload'])->assignRole($role);
        Permission::create(['name'=>'purchase.change_status'])->assignRole($role);
        Permission::create(['name'=>'product.change_status'])->assignRole($role);
        Permission::create(['name'=>'sale.change_status'])->assignRole($role);

        Permission::create(['name'=>'purchases.pdf']);
        Permission::create(['name'=>'sales.pdf']);
        Permission::create(['name'=>'sales.print']);
        Permission::create(['name'=>'report.report_day']);
        Permission::create(['name'=>'report.report_date']);
        Permission::create(['name'=>'report.report_results']);

        Permission::create(['name'=>'business.index']);
        Permission::create(['name'=>'business.update']);

        Permission::create(['name'=>'printer.index']);
        Permission::create(['name'=>'printer.update']);

        Permission::create(['name'=>'users.index'])->assignRole($role);
        Permission::create(['name'=>'users.create'])->assignRole($role);
        Permission::create(['name'=>'users.edit'])->assignRole($role);
        Permission::create(['name'=>'users.update'])->assignRole($role);
        Permission::create(['name'=>'users.destroy'])->assignRole($role);

    }
}
