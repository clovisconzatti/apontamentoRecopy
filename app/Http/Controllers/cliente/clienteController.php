<?php

namespace App\Http\Controllers\cliente;

use App\Http\Controllers\Controller;
use App\Models\cliente;
use Illuminate\Http\Request;

class clienteController extends Controller
{
    public function listAll(Request $request ){
        $filtros = [];

        $cliente  = ($request->get('cliente'))? $request->get('cliente') : session('cliente');
        session()->put('cliente', $cliente);
        if($cliente){
            $filtros[]=['cliente.cliente','like','%'.$cliente.'%'];
        }

        $clientes = cliente::where($filtros)->orderBy('cliente')->get();

        return view('cliente.listAll' , compact('clientes'));
    }

    public function formAdd()
    {
        return view('cliente.add');
    }
    public function strore(Request $request)
    {
        try{
            $cliente = new cliente([
                "id"                => $request->id
                ,"cliente"          => $request->cliente
                ]);
            $cliente->save();
        }catch(\Exception $e){
            return response()->json($cliente);
        }
        return response()->json('success');
    }

    public function formEdit($id)
    {
        $cliente = cliente::where('id','=',$id)->first();

        return view('cliente.edit' , compact('cliente'));
    }

    public function edit($id, Request $request)
    {
        try{
            $cliente = cliente::find($id);
            $cliente->cliente = $request->cliente;
            $cliente->save();
        }catch(\Exception $e){
            return response()->json($cliente);
        }
        return response()->json('success');
    }

}
