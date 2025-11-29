<?php

namespace App\Http\Controllers;

use Aliziodev\LaravelTaxonomy\Facades\Taxonomy as TaxonomyFacade;
use Aliziodev\LaravelTaxonomy\Models\Taxonomy;
use App\Enums\CategoryType;
use App\Http\Requests\CreateEmployerRequest;
use App\Http\Resources\EmployerResource;
use App\Models\Employer;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Inertia\Inertia;

class EmployerController extends Controller
{
    public function index()
    {
        return Inertia::render('Employers/EmployerIndex', [
            'employers' => EmployerResource::collection(Employer::all())
        ]);
    }

    public function store(CreateEmployerRequest $request)
    {
        $values = $request->validated();

        $employer = Employer::create([
            'name' => $values['name'],
            'slug' => Str::slug( $values['name'], '-')
        ]);

        return redirect()->back()->with('success', 'Employer ' . $employer->name . ' created');
    }

    public function update(CreateEmployerRequest $request, Employer $employer)
    {
        $values = $request->validated();

        $employer->update([
            'name' => $values['name'],
            'slug' => Str::slug( $values['name'], '-')
        ]);

        return redirect()->back()->with('success', 'Employer ' . $employer->name . ' updated');
    }

    public function show(Employer $employer)
    {
        return Inertia::render('Employers/EmployerShow', [
            'employer' => $employer,
        ]);
    }
}
