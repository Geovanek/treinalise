<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Company;
use App\Models\Plan;
use Illuminate\Http\Request;

class PlanCompanyController extends Controller
{
    protected $repository, $plan;

    public function __construct(Company $company, Plan $plan)
    {
        $this->repository = $company;
        $this->plan = $plan;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index($id)
    {
        if (!$plan = $this->plan->with('companies.user')->find($id)) {
            return redirect()->back();
        }

        return view('admin.plans.planCompanies.index', compact('plan'));
    }
}
