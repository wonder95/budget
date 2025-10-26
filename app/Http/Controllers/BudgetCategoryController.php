<?php

namespace App\Http\Controllers;

use App\Http\Requests\CreateBudgetCategoryRequest;
use App\Http\Resources\BudgetCategoryResource;
use App\Models\BudgetCategory;
use Inertia\Inertia;
class BudgetCategoryController extends Controller
{
    public function index()
    {
        return Inertia::render('BudgetCategories/Index', [
            'budgetCategories' => BudgetCategoryResource::collection(BudgetCategory::all())
        ]);
    }

    public function store(CreateBudgetCategoryRequest $request)
    {
        $values = $request->validated();

        $budgetCategory = BudgetCategory::create([
            'name' => $values['name']
        ]);

        return redirect()->back()->with('success', 'Budget Category ' . $budgetCategory->name . ' created');
    }
}
