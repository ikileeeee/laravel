<?php

namespace App\Http\Controllers;

use App\Models\Prognoza;
use App\Models\Region;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Http\Resources\PrognozaResource;
use App\Http\Resources\PrognozaCollection;
use Illuminate\Support\Facades\Validator;


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
        $validator= Validator::make($request->all(),[
            'dan'=>'required|date_format:Y-m-d',
            'temperatura'=>'required|integer',
            'pojava'=>'required|string|max:50',
            'region_id'=>'required',
           ]);
        if($validator->fails()){
          return response()->json($validator->errors());
       }
       $prognoza=Prognoza::create([
        'dan'=>$request->dan,
        'temperatura'=>$request->temperatura,
        'pojava'=>$request->pojava,
        'region_id'=>$request->region_id,
        'user_id'=>Auth::user()->id,
       ]);
       
       return response()->json(['Prognoza je uspesno kreirana.',new PrognozaResource($prognoza)]);
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
    public function update(Request $request, int $id)
    {
       $validator= Validator::make($request->all(),[
            'dan'=>'required|date_format:Y-m-d',
            'temperatura'=>'required',
            'pojava'=>'required|string|max:50',
            'region_id'=>'required',
           ]);
        if($validator->fails()){
          return response()->json($validator->errors());
       }/* 
       $prognoza->dan=$request->dan;
       $prognoza->temperatura=$request->temperatura;
       $prognoza->pojava=$request->pojava;
       $prognoza->region_id=$request->region_id;
       $prognoza->user_id=Auth::user()->id;
       $prognoza->save();*/
    
       $prognoza=Prognoza::find($id);
       $prognoza->dan=$request->dan;
       $prognoza->temperatura=$request->temperatura;
       $prognoza->pojava=$request->pojava;
       $prognoza->region_id=$request->region_id;
       $prognoza->save();

       return response()->json(['Prognoza je uspesno izmenjena.',new PrognozaResource($prognoza)]);

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
    public function destroy(int $id)
    {
        $prognoza=Prognoza::find($id);
        if(is_null($prognoza)){
            return response()->json('Nema ove prognoze', 404);
        }
        $prognoza->delete();
        
        return response()->json('Prognoza je uspešno obrisana!');
    }
}
