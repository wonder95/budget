<?php

namespace Database\Seeders;

use App\Models\PayPeriod;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class PayPeriodSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        PayPeriod::create([
            'start_date' => '2025-10-10',
            'end_date' => '2025-10-23',
        ]);

        PayPeriod::create([
            'start_date' => '2025-10-24',
            'end_date' => '2025-11-06',
        ]);

        PayPeriod::create([
            'start_date' => '2025-11-07',
            'end_date' => '2025-11-20',
        ]);

        PayPeriod::create([
            'start_date' => '2025-11-21',
            'end_date' => '2025-12-04',
        ]);
    }
}
