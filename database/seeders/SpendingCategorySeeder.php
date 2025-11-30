<?php

namespace Database\Seeders;

use Aliziodev\LaravelTaxonomy\Models\Taxonomy;
use App\Enums\CategoryType;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

class SpendingCategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $utilities = Taxonomy::create([
            'name' => 'Utilties',
            'slug' => 'utilities',
            'description' => 'Utilities for the house',
            'type' => 'spending',
            'parent_id' => null,
        ]);

        Taxonomy::create([
            'name' => 'Electric',
            'slug' => 'electric',
            'description' => 'Electricity',
            'type' => 'spending',
            'parent_id' => $utilities->id,
        ]);

        Taxonomy::create([
            'name' => 'Natural Gas',
            'slug' => 'natural-gas',
            'description' => 'Natural gas for heating',
            'type' => 'spending',
            'parent_id' => $utilities->id,
        ]);

        Taxonomy::create([
            'name' => 'Water',
            'slug' => 'water',
            'description' => 'Includes stormrwater and sewer',
            'type' => 'spending',
            'parent_id' => $utilities->id,
        ]);

        Taxonomy::create([
            'name' => 'Phone & Internet',
            'slug' => 'phone-internet',
            'description' => 'Landline and internet',
            'type' => 'spending',
            'parent_id' => $utilities->id,
        ]);

        Taxonomy::create([
            'name' => 'Cell Phones',
            'slug' => 'cell-phones',
            'description' => 'Landline and internet',
            'type' => 'spending',
            'parent_id' => $utilities->id,
        ]);

        $vehicles = Taxonomy::create([
            'name' => 'Vehicles',
            'slug' => 'vehicles',
            'description' => 'Vehicle Maintenance',
            'type' => 'spending',
            'parent_id' => null,
        ]);

        Taxonomy::create([
            'name' => 'Fuel',
            'slug' => 'fuel',
            'description' => 'Fuel make cars go',
            'type' => 'spending',
            'parent_id' => $vehicles->id,
        ]);

        Taxonomy::create([
            'name' => 'Maintenance',
            'slug' => 'maintenance',
            'description' => 'Keeping vehicles running',
            'type' => 'spending',
            'parent_id' => $vehicles->id,
        ]);

        Taxonomy::create([
            'name' => 'Insurance',
            'slug' => 'insurance',
            'description' => 'For when bad things happen',
            'type' => 'spending',
            'parent_id' => $vehicles->id,
        ]);

        Taxonomy::create([
            'name' => 'Groceries',
            'slug' => 'groceries',
            'description' => 'Da food',
            'type' => 'spending',
            'parent_id' => null,
        ]);

        Taxonomy::create([
            'name' => 'Entertainment',
            'slug' => 'entertainment',
            'description' => 'Da food',
            'type' => 'spending',
            'parent_id' => null,
        ]);

        Taxonomy::create([
            'name' => 'Household',
            'slug' => 'household',
            'description' => 'Da food',
            'type' => 'spending',
            'parent_id' => null,
        ]);
    }
}
