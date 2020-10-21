<?php

namespace App\Http\Controllers\App\Company;

use App\Models\Athlete;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class CoachAthleteController extends Controller
{
    protected $repository;

    public function __construct(Athlete $athlete)
    {
        $this->repository = $athlete;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $athletes = $this->repository->get();
        return view('app.company.coach.index', compact('athletes'));
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Athlete $athlete)
    {
        return view('app.company.athletes.edit', compact('athlete'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Athlete $athlete)
    {
        $athlete->update($request->all());
        return redirect()->route('athletes.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
