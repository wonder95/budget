<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Inertia\Inertia;
class RegistersController extends Controller
{
    public function index()
    {
        return Inertia::render('Registers/Index');
    }
}
