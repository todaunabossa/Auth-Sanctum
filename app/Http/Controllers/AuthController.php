<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class AuthController extends Controller
{
    public function create(Request $request){
        $rules = [
            'name' => 'required|string|max:100',
            'email' => 'required|string|email|unique:users',
            'password' => 'required|string|min:8',  
        ];
        $validator = \Validator::make($request->input(), $rules);
        if($validator->fails()){
            return response()->json([
                'status'=> false,
                'errors'=> $validator->errors()->all()
            ],400);
        }
        $user = User::create([
            'name'=> $request->name, 'email' => $request->email,
            'password'=> Hash::make($request->password)
        ]);

        return response()->json([
            'status'=> true,
            'msg'=> 'User created successfully!',
            'token' => $user -> createToken('Api Token')->plainTextToken
        ],201);
    }
    
    public function login(){
        $rules = [
            'email' => 'required|string|email|max:100',
            'password' => 'required|string',  
        ];
        $validator = \Validator::make($request->input(), $rules);
        if($validator->fails()){
            return response()->json([
                'status'=> false,
                'errors'=> $validator->errors()->all()
            ],400);
        }
        if(!Auth::attempt($request->only('email', 'password'))){
            return response()->json([
                'status'=> false,
                'errors'=> ['Unauthorized']
            ],401);
        }
        $user = User::where('email',$request->email)->fisrt();
        return response()->json([
            'status'=> true,
            'msg'=> 'User logged in successfully!',
            'data' => $user,
            'token' => $user -> createToken('Api Token')->plainTextToken
        ],201);
    }
    
    public function logout(){
        auth()->user()->tokens()->delete();
        return response()->json([
            'status'=> true,
            'msg'=> 'User logged out successfully!',
        ],201);
    }
}
