<?php

namespace App\Http\Controllers;

use App\Http\Requests\CreateSpendingCategoryRequest;
use App\Http\Resources\SpendingCategoryResource;
use App\Models\SpendingCategory;
use Inertia\Inertia;

class SpendingCategoryController extends Controller
{
    public function index()
    {
        return Inertia::render('SpendingCategories/Index', [
            'spendingCategories' => SpendingCategoryResource::collection(SpendingCategory::all())
        ]);
    }

    public function store(CreateSpendingCategoryRequest $request)
    {
        $values = $request->validated();

        $spendingCategory = SpendingCategory::create([
            'name' => $values['name']
        ]);

        return redirect()->back()->with('success', 'Spending Category ' . $spendingCategory->name . ' created');
    }

    public function update(CreateSpendingCategoryRequest $request, SpendingCategory $category)
    {
        $values = $request->validated();

        $category->update([
            'name' => $values['name'],
        ]);

        return redirect()->back()->with('success', 'Spending Category ' . $category->name . ' updated');
    }
}
