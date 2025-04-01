<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use App\Models\User as UserModel;
use Illuminate\Validation\Rules;


class User extends Controller
{
    public function register(Request $request){
        try {
            $request->validate([
                'name' => ['required', 'string', 'max:255'],
                'email' => ['required', 'string', 'lowercase', 'email', 'max:255', 'unique:'.UserModel::class],
                'password' => ['required', 'confirmed', 'min:6'],
            ]);
    
            $user = UserModel::create([
                'name' => $request->input('name'),
                'email' => $request->input('email'),
                'password' => Hash::make($request->input('password'))
            ]);
    
            return response()->json(['đăng ky thanh cong']);

        } catch (\Exception $e) {
            return response()->json(['error' => $e->getMessage()], 500);
        }
        
    }    

}
