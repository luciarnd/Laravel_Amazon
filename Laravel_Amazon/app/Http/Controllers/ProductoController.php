<?php

namespace App\Http\Controllers;

use App\Models\Producto;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class ProductoController extends Controller
{

    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'precio' => 'required|int',
            'fabricante' => 'required|string|max:255',
            'descripcion' => 'required|string|max:255',
        ]);
        if($validator->fails()){
            return response()->json($validator->messages(), 400);
        }
        $producto = Producto::create([
            'precio' => $request->get('precio'),
            'fabricante' => $request->get('fabricante'),
            'descripcion' => $request->get('descripcion'),
        ]);
        return response()->json(['message'=>'Producto Created','data'=>$producto],200);
    }

    public function show(Producto $producto)
    {
        return response()->json(['message'=>'','data'=>$producto],200);
    }

    public function listPedidos(Producto $producto)
    {
        return response()->json(['message'=>'Pedido showed','data'=>$producto->pedidos],200);
    }


}
