<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Extension;
use App\Models\Plan;
use Illuminate\Http\Request;

class PlanExtensionController extends Controller
{
    protected $repository;

    public function __construct(Plan $plan)
    {
        $this->repository = $plan;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index($slug)
    {
        if (!$plan = $this->repository->where('slug', $slug)->first()) {
            return redirect()->back();
        }

        $extensions = Extension::where('active', true)->get();

        return view('admin.plans.planExtensions.index', compact('plan', 'extensions'));
    }
}
