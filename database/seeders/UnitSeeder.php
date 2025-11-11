<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Unit;

class UnitSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $data = [
            ['name' => 'Adet'],
            ['name' => 'Metre'],
            ['name' => 'Metrekare'],
            ['name' => 'Kilogram'],
            ['name' => 'Litre'],
        ];

        foreach ($data as $unit) {
            Unit::firstOrCreate([
                'name' => $unit['name'],
            ]);
        }
    }
}
