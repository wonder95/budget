<?php

namespace App\Http\Controllers;

use Aliziodev\LaravelTaxonomy\Models\Taxonomy;
use App\Enums\CategoryType;
use App\Http\Requests\CreateSpendingCategoryRequest;
use App\Http\Resources\SpendingCategoryResource;
use Inertia\Inertia;
use Aliziodev\LaravelTaxonomy\Facades\Taxonomy as TaxonomyFacade;

class SpendingCategoryController extends Controller
{
    public function index()
    {

       $categories = TaxonomyFacade::flatTree(CategoryType::Spending->value);

        return Inertia::render('SpendingCategories/Index', [
//            'spendingCategories' => SpendingCategoryResource::collection(TaxonomyFacade::findByType('spending'))
            'spendingCategories' => $categories
        ]);
    }

    public function store(CreateSpendingCategoryRequest $request)
    {
        $values = $request->validated();

        $spendingCategory = Taxonomy::create([
            'name' => $values['name'],
            'slug' => $values['slug'],
            'description' => $values['description'],
            'type' => CategoryType::Spending->value,
            'parent_id' => $values['parent_id'] ?? null,

        ]);

        return redirect()->back()->with('success', 'Spending Category ' . $spendingCategory->name . ' created');
    }

    public function update(CreateSpendingCategoryRequest $request, Taxonomy $category)
    {
        $values = $request->validated();

        $category->update([
            'name' => $values['name'],
            'slug' => $values['slug'],
            'description' => $values['description'],
        ]);

        return redirect()->back()->with('success', 'Spending Category ' . $category->name . ' updated');
    }
}
