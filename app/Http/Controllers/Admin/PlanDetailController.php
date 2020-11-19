<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreUpdatePlanDetail;
use App\Models\Plan;
use App\Models\PlanDetail;
use Illuminate\Http\Request;

class PlanDetailController extends Controller
{
    protected $repository, $plan;

    public function __construct(PlanDetail $detail, Plan $plan)
    {
        $this->repository = $detail;
        $this->plan = $plan;
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index($slug)
    {
        if (!$plan = $this->plan->with('details')->where('slug', $slug)->first()) {
            return redirect()->back();
        }

        return view('admin.plans.planDetails.index', compact('plan'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create($slug)
    {
        if (!$plan = $this->plan->with('details')->where('slug', $slug)->first()) {
            return redirect()->back();
        }

        return view('admin.plans.planDetails.create', compact('plan'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreUpdatePlanDetail $request, $slug)
    {
        if (!$plan = $this->plan->where('slug', $slug)->first()) {
            return redirect()->back();
        }

        $plan->details()->create($request->all());

        return redirect()->route('details.index', $plan->slug)
                         ->with('message', 'Detalhe criado com sucesso.');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($slug, $id)
    {
        $plan = $this->plan->where('slug', $slug)->first();
        $detail = $this->repository->find($id);

        if (!$plan || !$detail) {
            return redirect()->back();
        }

        return view('admin.plans.planDetails.edit', compact('plan', 'detail'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(StoreUpdatePlanDetail $request, $slug, $id)
    {
        $plan = $this->plan->where('slug', $slug)->first();
        $detail = $this->repository->find($id);

        if (!$plan || !$detail) {
            return redirect()->back();
        }

        $detail->update($request->all());

        return redirect()->route('details.index', $plan->slug)
                         ->with('message', 'Detalhe editado com sucesso.');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($slug, $id)
    {
        $detail = $this->repository->find($id);

        if (!$detail) {
            $notification = array(
                'message' => 'Não foi possível excluir este detalhe.', 
                'alert-type' => 'error'
            );
            return redirect()->back()->with($notification);
        }
        
        $detail->delete();

        return redirect()->route('details.index', $slug)
                         ->with('message', 'Detalhe deletado com sucesso.');
    }
}
