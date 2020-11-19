<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreUpdatePlan;
use App\Models\Plan;
use Illuminate\Http\Request;

class PlanController extends Controller
{
    private $repository;

    public function __construct(Plan $plan)
    {
        $this->repository = $plan;

        //$this->middleware(['can:plans']);
    }

    /**
     * Exibe uma lista com todos os planos.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $plans = $this->repository->with('details')->get();

        return view('admin.plans.index', compact('plans'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.plans.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  App\Http\Requests\StoreUpdatePlan  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreUpdatePlan $request)
    {
        $this->repository->create($request->all());

        return redirect()->route('plans.index');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $plan = $this->repository->where('id', $id)->first();

        if(!$plan)
            return redirect()->back();
        
        return view('admin.plans.edit', compact('plan'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  App\Http\Requests\StoreUpdatePlan  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(StoreUpdatePlan $request, $id)
    {
        $plan = $this->repository->where('id', $id)->first();

        if (!$plan)
            return redirect()->back();

        $plan->update($request->all());

        return redirect()->route('plans.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $plan = $this->repository
                     ->with('details')
                     ->where('id', $id)
                     ->first();

        if (!$plan)
            return redirect()->back();

        if ($plan->companies->count() > 0) {
            $notification = array(
                'message' => 'Não é possível excluir esse plano, pois existem empresas vinculados a ele.', 
                'alert-type' => 'error'
            );
            return redirect()->back()->with($notification);
        }

        $plan->extensions()->detach();

        $plan->delete();

        return redirect()->route('plans.index')
                         ->with('message', 'Plano deletado com sucesso.');
    }
}
