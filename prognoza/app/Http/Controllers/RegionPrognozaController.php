<?php

namespace App\Http\Controllers;

use App\Models\Prognoza;
use Illuminate\Http\Request;

class RegionPrognozaController extends Controller
{
    public function index($region_id)
    {
        $prognoze= Prognoza::get()->where('region_id',$region_id);
        if(is_null($prognoze))
            return response()->json("Traženi region nema nijednu prognozu", 404);
        else return response()->json($prognoze);
    
    }
}
