<?php

namespace App\Http\Controllers;

use App\Models\Account;
use Illuminate\Http\Request;
use Inertia\Inertia;
use App\Models\PayPeriod;

class PayPeriodController extends Controller
{
    public function index()
    {
        return Inertia::render('PayPeriods/Index');
    }
}
