<?php

namespace App\Http\Controllers;

use App\Models\Employee;
use Illuminate\Http\Request;

class FrontendController extends Controller
{
    public function index(Request $request)
    {
        $employees = Employee::all(); 
        return view('frontend.home.index', compact('employees'));
    }
}
