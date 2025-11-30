<?php

namespace Database\Seeders;

use Aliziodev\LaravelTaxonomy\Facades\Taxonomy;
use App\Enums\CategoryType;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

class BudgetCategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Taxonomy::create([
            'name' => 'Main Spending',
            'slug' => 'main-spending',
            'description' => 'The main bucket of money',
            'type' => 'budget'
        ]);

        Taxonomy::create([
            'name' => 'Groceries',
            'slug' => 'groceries',
            'description' => 'Buying the food',
            'type' => 'budget'
        ]);

        Taxonomy::create([
            'name' => 'Gas',
            'slug' => 'gas',
            'description' => 'Gas for vehicles',
            'type' => 'budget'
        ]);

        Taxonomy::create([
            'name' => 'Tithe',
            'slug' => 'tithe',
            'description' => 'Giving back to God',
            'type' => 'budget'
        ]);

        Taxonomy::create([
            'name' => 'Payment',
            'slug' => 'payment',
            'description' => 'Set aside in case of monthly payment need',
            'type' => 'budget'
        ]);

        Taxonomy::create([
            'name' => 'Extra',
            'slug' => 'extra',
            'description' => "Set aside so we don't spend it",
            'type' => 'budget'
        ]);
    }
}
