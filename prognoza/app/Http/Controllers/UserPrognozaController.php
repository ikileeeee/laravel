<?php

namespace App\Http\Controllers;

use App\Models\Prognoza;
use Illuminate\Http\Request;

class UserPrognozaController extends Controller
{
    public function index($user_id)
    {
        $prognoze= Prognoza::get()->where('user_id',$user_id);
        if(is_null($prognoze))
            return response()->json("Traženi meteorolog nije uneo nijednu prognozu", 404);
        else return response()->json($prognoze);
    
    }
}
