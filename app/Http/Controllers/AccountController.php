<?php

namespace App\Http\Controllers;

use App\Models\Account;
use Illuminate\Http\Request;
use Inertia\Inertia;
use App\Http\Requests\CreateAccountRequest;

class AccountController extends Controller
{
    public function index()
    {
        return Inertia::render('Accounts/Index', [
            'accounts' => Account::all()
        ]);
    }

    public function store(CreateAccountRequest $request)
    {
        $values = $request->validated();

        $account = Account::create([
            'name' => $values['name'],
            'type' => $values['type'],
        ]);

        return redirect()->back()->with('success', 'Account ' . $account->name . ' created');
    }

    public function update(CreateAccountRequest $request, Account $account)
    {
        $values = $request->validated();


        $account->update([
            'name' => $values['name'],
        ]);
    }
}
