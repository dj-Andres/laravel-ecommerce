<?php

namespace Database\Seeders;

use App\Models\Business;
use App\Models\Printer;
use App\Models\Tag;
use App\Models\Category;
use App\Models\Client;
use App\Models\Product;
use App\Models\Provider;
use App\Models\SubCategory;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        // \App\Models\User::factory(10)->create();
        $this->call(RolSeeder::class);
        $this->call(UserSeeder::class);
        //$this->call(BusinessSeeder::class);
        $this->call(PrinterSeeder::class);
        Tag::factory(8)->create();
        Category::factory(10)->create();
        SubCategory::factory(10)->create();
        Provider::factory(10)->create();
        Product::factory(10)->create();
        Client::factory(10)->create();
    }
}
