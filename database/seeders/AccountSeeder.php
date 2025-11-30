<?php

namespace Database\Seeders;

use App\Models\Account;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class AccountSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Account::create([
            'name' => 'Primary Checking',
            'slug' => 'primary-checking',
            'type' => 'deposit'
        ]);

        Account::create([
            'name' => 'Savings',
            'slug' => 'savings',
            'type' => 'deposit'
        ]);

        Account::create([
            'name' => 'Atmos VISA',
            'slug' => 'atmos-visa',
            'type' => 'credit'
        ]);
    }
}
