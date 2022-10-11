<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class UserController extends Controller
{
    public function register(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required|string|max:255',
            'apellido' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|min:6',
            'c_password' => 'required|same:password',
            'telefono' => 'required|string|max:255'
        ]);
        if($validator->fails()){
            return response()->json($validator->messages(), 400);
        }
        $user = User::create([
            'name' => $request->get('name'),
            'apellido' => $request->get('apellido'),
            'email' => $request->get('email'),
            'password' => Hash::make($request->get('password')),
            'telefono' => $request->get('telefono'),

        ]);
        return response()->json(['message'=>'User Created','data'=>$user],200);
    }

    public function show(User $user)
    {
        return response()->json(['message'=>'','data'=>$user],200);
    }

    public function show_subscription(User $user)
    {
        return response()->json(['message'=>'','data'=>$user->subscription],200);
    }

    public function show_pedidos(User $user)
    {
        $pedidos = $user->pedidos;
        return response()->json(['message'=>'','data'=>$pedidos],200);
    }


}
