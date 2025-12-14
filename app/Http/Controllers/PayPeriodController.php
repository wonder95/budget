<?php

namespace App\Http\Controllers;

use Aliziodev\LaravelTaxonomy\Facades\Taxonomy;
use Aliziodev\LaravelTaxonomy\Facades\Taxonomy as TaxonomyFacade;
use App\Enums\CategoryType;
use App\Http\Requests\CreatePayPeriodRequest;
use App\Http\Resources\BudgetCategoryResource;
use App\Http\Resources\PayPeriodResource;
use App\Models\PayPeriod;
use Illuminate\Http\Request;
use Inertia\Inertia;

class PayPeriodController extends Controller
{
    public function index()
    {
        return Inertia::render('PayPeriods/PayPeriodIndex', [
            'payPeriods' => PayPeriodResource::collection(PayPeriod::all())
        ]);
    }

    public function store(CreatePayPeriodRequest $request)
    {
        $values = $request->validated();

        $payPeriod = PayPeriod::create([
            'start_date' => $values['start_date'],
            'end_date' => $values['end_date'],
            'starting_balance' => $values['starting_balance'],
        ]);

        return redirect()->back()->with('success', 'Pay Period ' . $payPeriod->start_date . ' - ' . $payPeriod->endDate . ' created');
    }

    public function update(CreatePayPeriodRequest $request, PayPeriod $payPeriod)
    {
        $values = $request->validated();

        $changed = $payPeriod->update([
            'start_date' => $values['start_date'],
            'end_date' => $values['end_date'],
            'starting_balance' => $values['starting_balance'],
        ]);

        return redirect()->back()->with('success', 'Pay Period ' . $payPeriod->start_date . ' - ' . $payPeriod->end_date . ' updated');
    }

    /** Show transactions for the pay period */
    public function transactions(PayPeriod $payPeriod)
    {

        return Inertia::render('PayPeriods/PayPeriodTransactions', [
            'transactions' => $payPeriod->transactions()->get(),
            'payPeriod' => $payPeriod,
            'budgetCategories' => BudgetCategoryResource::collection(Taxonomy::findByType('budget')),
            'spendingCategories' => TaxonomyFacade::tree(CategoryType::Spending->value)
        ]);
    }
}
