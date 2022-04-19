<?php

namespace Database\Seeders;

use App\Models\City;
use Illuminate\Database\Seeder;

class CreateCitiesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        City::create([
            'id'    => 'ESXX0016',
            'name'  => 'A Coruña'
        ]);

        City::create([
            'id'    => 'ESCT0001',
            'name'  => 'Barcelona'
        ]);

        City::create([
            'id'    => 'ESXX0006',
            'name'  => 'Bilbao'
        ]);

        City::create([
            'id'    => 'ESXX0656',
            'name'  => 'Castro-Urdiales'
        ]);

        City::create([
            'id'    => 'ESMX0001',
            'name'  => 'Madrid'
        ]);

        City::create([
            'id'    => 'ESXX0004',
            'name'  => 'Sevilla'
        ]);
    }
}
