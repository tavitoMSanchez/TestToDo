<?php

namespace App\Http\Controllers;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\ValidationException;

class LoginController extends Controller
{
    public function login(Request $request)
    {
        $request->validate([
            'email' => ['required', 'email'],
            'password' => ['required']
        ],
        [
            'required' => 'Campo Requerido'
        ]);
        $user = User::where('email', $request->email)->first();
        if (Auth::attempt($request->only('email', 'password'))){
            return $user->createToken($request->device_name)->accessToken;
        }
        throw ValidationException::withMessages([
            'datos' =>['Las credenciales son incorrectas.']
        ]);
    }
    public function logout(Request $request)
    {
       // dd($request);
        $request->user()->token()->delete();
        return response()->json(['msg' => 'Logout Exitoso']);
    }
}