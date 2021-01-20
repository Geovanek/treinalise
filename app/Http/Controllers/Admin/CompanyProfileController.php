<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Company;
use Illuminate\Http\Request;

class CompanyProfileController extends Controller
{
    public function index($slug)
    {
        $company = Company::where('slug', $slug)
                    ->with(['user', 'athletes', 'plan'])
                    ->firstOrFail();

        return view('admin.companies.profile', compact('company'));
    }
}
