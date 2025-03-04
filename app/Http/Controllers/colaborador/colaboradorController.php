<?php

namespace App\Http\Controllers\colaborador;

use App\Http\Controllers\Controller;
use App\Models\colaborador;
use Illuminate\Http\Request;

class colaboradorController extends Controller
{
    public function listAll(Request $request ){
        $filtros = [];

        $colaborador  = ($request->get('colaborador'))? $request->get('colaborador') : session('colaborador');
        session()->put('colaborador', $colaborador);
        if($colaborador){
            $filtros[]=['colaborador.colaborador','like','%'.$colaborador.'%'];
        }

        $colaboradores = colaborador::where($filtros)->orderBy('colaborador')->get();

        return view('colaborador.listAll' , compact('colaboradores'));
    }

    public function formAdd()
    {
        return view('colaborador.add');
    }
    public function strore(Request $request)
    {
        try{
            $colaborador = new colaborador([
                "id"                    => $request->id
                ,"colaborador"          => $request->colaborador
                ,"setor"                => $request->setor

                ]);
            $colaborador->save();
        }catch(\Exception $e){
            return response()->json($colaborador);
        }
        return response()->json('success');
    }

    public function formEdit($id)
    {
        $colaborador = colaborador::where('id','=',$id)->first();

        return view('colaborador.edit' , compact('colaborador'));
    }

    public function edit($id, Request $request)
    {
        try{
            $colaborador = colaborador::find($id);
            $colaborador->colaborador = $request->colaborador;
            $colaborador->setor       = $request->setor;
            $colaborador->save();
        }catch(\Exception $e){
            return response()->json($colaborador);
        }
        return response()->json('success');
    }

}
