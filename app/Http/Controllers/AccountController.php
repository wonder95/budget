<?php

namespace App\Http\Controllers;

use App\Http\Resources\AccountResource;
use App\Models\Account;
use Illuminate\Http\Request;
use Inertia\Inertia;
use App\Http\Requests\CreateAccountRequest;
use Illuminate\Support\Str;

class AccountController extends Controller
{
    public function index()
    {
        return Inertia::render('Accounts/AccountIndex', [
            'accounts' => AccountResource::collection(Account::all())
        ]);
    }

    public function store(CreateAccountRequest $request)
    {
        $values = $request->validated();

        $account = Account::create([
            'name' => $values['name'],
            'slug' => Str::slug($values['name']),
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

    public function register(Account $account)
    {
        return Inertia::render('Accounts/RegisterIndex', [
            'account' => $account
        ]);

    }
}
