<?php

namespace Database\Seeders;

use App\Models\Branch;
use Illuminate\Database\Seeder;

class BranchSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Branch::create([
            'name' => 'Central',
            'street' => 'Central Av',
            'int_number' => '120',
            'ext_number' => '902',
            'suburb' => 'Park',
            'postal_code' => '0190',
            'city' => 'Central City',
            'state' => 'Central State',
            'country' => 'Central Country'
        ]);
    }
}
