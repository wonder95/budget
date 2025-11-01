<?php

namespace App\Http\Controllers;

use App\Http\Requests\CreatePayPeriodRequest;
use App\Http\Resources\PayPeriodResource;
use App\Models\PayPeriod;
use Illuminate\Http\Request;
use Inertia\Inertia;

class PayPeriodController extends Controller
{
    public function index()
    {
        return Inertia::render('PayPeriods/Index', [
            'payPeriods' => PayPeriodResource::collection(PayPeriod::all())
        ]);
    }

    public function store(CreatePayPeriodRequest $request)
    {
        $values = $request->validated();

        $payPeriod = PayPeriod::create([
            'start_date' => $values['start_date'],
            'end_date' => $values['end_date'],
        ]);

        return redirect()->back()->with('success', 'Pay Period ' . $payPeriod->start_date . ' - ' . $payPeriod->endDate . ' created');
    }

    public function update(CreatePayPeriodRequest $request, PayPeriod $payPeriod)
    {
        $values = $request->validated();

        $changed = $payPeriod->update([
            'start_date' => $values['start_date'],
            'end_date' => $values['end_date'],
        ]);

        return redirect()->back()->with('success', 'Pay Period ' . $payPeriod->start_date . ' - ' . $payPeriod->end_date . ' updated');
    }
}
