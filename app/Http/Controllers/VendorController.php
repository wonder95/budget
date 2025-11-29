<?php

namespace App\Http\Controllers;

use App\Models\Vendor;
use App\Http\Requests\CreateVendorRequest;
use Inertia\Inertia;

class VendorController extends Controller
{
    public function index()
    {
        return Inertia::render('Vendors/VendorIndex', [
            'vendors' => Vendor::all()
        ]);
    }

    public function store(CreateVendorRequest $request)
    {
        $values = $request->validate();

        $vendor = Vendor::create([
            'name' => $values['name']
        ]);

        return redirect()->back()->with('success', 'Vendor ' . $vendor->name . ' created');
    }
}
