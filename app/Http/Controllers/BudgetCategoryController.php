<?php

namespace App\Http\Controllers;

use Aliziodev\LaravelTaxonomy\Facades\Taxonomy;
use App\Enums\CategoryType;
use App\Http\Requests\CreateBudgetCategoryRequest;
use App\Http\Resources\BudgetCategoryResource;
use App\Models\BudgetCategory;
use Aliziodev\LaravelTaxonomy\Models\Taxonomy as TaxonomyModel;
use Inertia\Inertia;
class BudgetCategoryController extends Controller
{
    public function index()
    {
        return Inertia::render('BudgetCategories/Index', [
            'budgetCategories' => BudgetCategoryResource::collection(Taxonomy::findByType('budget'))
        ]);
    }

    public function store(CreateBudgetCategoryRequest $request)
    {
        $values = $request->validated();

        $budgetCategory = Taxonomy::create([
            'name' => $values['name'],
            'slug' => $values['slug'],
            'description' => $values['description'],
            'type' => CategoryType::Budget->value,
        ]);

        return redirect()->back()->with('success', 'Budget Category ' . $budgetCategory->name . ' created');
    }

    public function update(CreateBudgetCategoryRequest $request, TaxonomyModel $category)
    {
        $values = $request->validated();

        $category->update([
            'name' => $values['name'],
        ]);

        return redirect()->back()->with('success', 'Budget Category ' . $category->name . ' updated');
    }
}
