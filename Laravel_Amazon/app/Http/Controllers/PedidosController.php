<?php

namespace App\Http\Controllers;

use App\Models\Pedido;
use App\Models\Producto;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class PedidosController extends Controller
{
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'fecha' => 'required|string|max:255',
            'precio_total' => 'required|int',
            'user_id' => 'required|int',
        ]);
        if($validator->fails()){
            return response()->json($validator->messages(), 400);
        }
        $pedido = Pedido::create([
            'fecha' => $request->get('fecha'),
            'precio_total' => $request->get('precio_total'),
            'user_id' => $request->get('user_id'),
        ]);
        return response()->json(['message'=>'Pedido Created','data'=>$pedido],200);
    }

    public function listPedidos(Pedido $pedido)
    {
        return response()->json(['message'=>'Pedido showed','data'=>$pedido],200);
    }

    public function show_user(Pedido $pedido)
    {
        $user = $pedido->user;
        return response()->json(['message'=>'','data'=>$user],200);
    }

    public function añadirProducto(Request $request, Pedido $pedido, Producto $producto)
    {
        $note = '';
        if($request->note){
            $note = $request->note;
        }
        if($pedido->productos()->save($producto, array('note' => $note))){
            return response()->json(['message'=>'Pedido Producto Created','data'=>$producto],200);
        }
        return response()->json(['message'=>'Error','data'=>null],400);
    }

    public function listProductos(Pedido $pedido)
    {
        $productos = $pedido->productos;
        return response()->json(['message'=>null,'data'=>$productos],200);
    }



}
