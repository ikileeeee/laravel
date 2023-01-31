<?php

namespace App\Http\Controllers;

use App\Models\Prognoza;
use App\Models\Region;
use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Resources\PrognozaResource;
use App\Http\Resources\PrognozaCollection;


class PrognozaController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return ['prognoze' => PrognozaResource::collection(Prognoza::get())];
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Prognoza  $prognoza
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $prog=Prognoza::find($id);
        if(is_null($prog)){
            return response()->json('Data not found', 404);
        }
        return new PrognozaResource($prog);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Prognoza  $prognoza
     * @return \Illuminate\Http\Response
     */
    public function edit(Prognoza $prognoza)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Prognoza  $prognoza
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Prognoza $prognoza)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Prognoza  $prognoza
     * @return \Illuminate\Http\Response
     */
    public function getById($prognoza)
    {
        $prognoza= Prognoza::findOrFail($prognoza);

        return new PrognozaResource($prognoza);
    }
    public function destroy(Prognoza $prognoza)
    {
        $prognoza->delete();
        return response()->json('Prognoza je uspešno obrisana!');
    }
}
