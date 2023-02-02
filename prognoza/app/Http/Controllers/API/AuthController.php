<?php

namespace App\Http\Controllers\API;

use App\Models\User;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{
    public function register(Request $request)
    {
       $validator= Validator::make($request->all(),[
        'name'=>'required|string|max:25',
        'prezime'=>'required|string|max:25',
        'email'=>'required|string|max:255|email|unique:users',
        'password'=>'required|string|min:5'
       ]);

       if($validator->fails()){
        return response()->json($validator->errors());
       }
       $user= User::create([
        'name'=>$request->name,
        'prezime'=>$request->prezime,
        'email'=>$request->email,
        'password'=>Hash::make($request->password)
       ]);
       
       $token= $user->createToken('auth_token')->plainTextToken;
       return response()->json(['nov meteorolog'=>$user,'access_token'=>$token,'token_type'=>'Bearer']);
    }

    public function login(Request $request)
    {
        if(!Auth::attempt($request->only('email','password'))){
            return response()->json(['message'=>'Unauthorized'],401);
        }
        $user=User::where('email',$request['email'])->firstOrFail();

        $token=$user->createToken('auth_token')->plainTextToken;

        return response()->json(['message'=>'Dobrodosao/la, '.$user->name,'access_token'=>$token,'token_type'=>'Bearer']);
    }

    public function logout()
    {
        auth()->user()->tokens()->delete();
        return [
            'message'=>'Uspesno ste se odjavili!'
        ];
    }


}
