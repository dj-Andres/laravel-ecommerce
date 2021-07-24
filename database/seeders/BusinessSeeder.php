<?php

namespace Database\Seeders;

use App\Models\Business;
use Illuminate\Database\Seeder;

class BusinessSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Business::create([
            'name' => 'Diego Corp',
            'description' => 'Test Name',
            'address' => 'Marcel Laniado y Ayacucho',
            'ruc' => '12345678901'

        ]);
    }
}
