<?php

namespace App\Http\Controllers;

use App\Models\Subscription;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class SubscriptionController extends Controller
{
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'plan' => 'required|string|max:255',
            'fechainicio' => 'required|string|max:255',
            'fechacaducidad' => 'required|string|max:255',
            'user_id' => 'required|int',
        ]);
        if($validator->fails()){
            return response()->json($validator->messages(), 400);
        }
        $subscription = Subscription::create([
            'plan' => $request->get('plan'),
            'fechainicio' => $request->get('fechainicio'),
            'fechacaducidad' => $request->get('fechacaducidad'),
            'user_id' => $request->get('user_id'),
        ]);
        return response()->json(['message'=>'Subscription Created','data'=>$subscription],200);
    }

    public function show(Subscription $subscription)
    {
        return response()->json(['message'=>'Subscription showed','data'=>$subscription],200);
    }

    public function show_user(Subscription $subscription)
    {
        return response()->json(['message'=>'','data'=>$subscription->user],200);
    }

}
