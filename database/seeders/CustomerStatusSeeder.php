<?php

namespace Database\Seeders;

use App\Models\CustomerStatus;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Schema;

class CustomerStatusSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        if (Schema::hasTable('customer_statuses') && CustomerStatus::query()->doesntExist()) {
            $statues = [
                [
                    'name' => 'Yeni Müşteri',
                    'color' => 'primary'
                ],
                [
                    'name' => 'Yakın Takip',
                    'color' => 'warning'
                ],
                [
                    'name' => 'İlgisiz',
                    'color' => 'danger'
                ],
                [
                    'name' => 'Ulaşılamıyor',
                    'color' => 'danger'
                ],
                [
                    'name' => 'Takipte Kal',
                    'color' => 'success'
                ]
            ];

            foreach ($statues as $status) {
                CustomerStatus::create([
                    'name' => $status['name'],
                    'color' => $status['color']
                ]);
            }
        }
    }
}
