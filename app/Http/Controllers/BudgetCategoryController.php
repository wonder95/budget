<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Inertia\Inertia;
class BudgetCategoryController extends Controller
{
    public function index()
    {
        return Inertia::render('BudgetCategories/Index');
    }
}
