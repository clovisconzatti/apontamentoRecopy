<?php

namespace App\Http\Controllers\materiaprima;

use App\Http\Controllers\Controller;
use App\Models\materiaprima;
use Illuminate\Http\Request;

class materiaprimaController extends Controller
{
    public function listAll(Request $request ){
        $filtros = [];

        $materiaprima  = ($request->get('materiaprima'))? $request->get('materiaprima') : session('materiaprima');
        session()->put('materiaprima', $materiaprima);
        if($materiaprima){
            $filtros[]=['materiaprimas.materiaprima','like','%'.$materiaprima.'%'];
        }

        $materiaprimas = materiaprima::where($filtros);
        return view('materiaprima.listAll' , compact('materiaprimas'));
    }

    public function formAdd()
    {
        return view('materiaprima.add');
    }
    public function strore(Request $request)
    {
        try{
            $materiaprima = new materiaprima([
                "id"                => $request->id
                ,"materiaprima"     => $request->materiaprima
                ,"unidade"          => $request->unidade
                ]);
            $materiaprima->save();
        }catch(\Exception $e){
            return response()->json($materiaprima);
        }
        return response()->json('success');
    }

    public function formEdit($id)
    {
        $materiaprima = materiaprima::where('id','=',$id)->first();

        return view('materiaprima.edit' , compact('materiaprima'));
    }

    public function edit($id, Request $request)
    {
        try{
            $materiaprima = materiaprima::find($id);
            $materiaprima->materiaprima   = $request->materiaprima;
            $materiaprima->unidade        = $request->unidade;
            $materiaprima->save();
        }catch(\Exception $e){
            return response()->json($materiaprima);
        }
        return response()->json('success');
    }

}

