<?php

namespace App\Http\Controllers\insumo;

use App\Http\Controllers\Controller;
use App\Models\insumo;
use App\Models\materiaprima;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class insumoController extends Controller
{
    public function listAll(Request $request ){
        $filtros = [];

        $insumo  = ($request->get('materiaprima'))? $request->get('materiaprima') : session('materiaprima');
        session()->put('materiaprima', $insumo);
        if($insumo){
            $filtros[]=['materiaprima.materiaprima','like','%'.$insumo.'%'];
        }

        $insumos = insumo:: leftJoin('materiaprima','materiaprima.id','insumo.id_materiaprima')
                                        ->where($filtros)
                                        ->where('materiaprima.tipo','=','I')
                                        ->orderBy('data','desc')
                                        ->orderBy('id','desc')
                                        ->get([
                                            'insumo.id'
                                            , 'insumo.data'
                                            , 'insumo.id_materiaprima'
                                            , 'materiaprima.materiaprima'
                                            , 'insumo.qtd'
                                            , 'insumo.os'
                                    ]);
        return view('insumo.listAll' , compact('insumos'));
    }

    public function formAdd()
    {
        $user_id            = Auth::user()->id;
        $insumos            = insumo::orderby('id')->get();
        $materiaprimas      = materiaprima::orderby('materiaprima')->where('materiaprima.tipo','=','I')->get();
        return view('insumo.add', compact('insumos','materiaprimas'));
    }
    public function strore(Request $request)
    {
        try{
            $insumo = new insumo([
                "id"                    => $request->id
                ,"data"                 => $request->data
                ,"id_materiaprima"      => $request->id_materiaprima
                ,"qtd"                  => $request->qtd
                ,"os"                   => $request->os
                ]);
            $insumo->save();
        }catch(\Exception $e){
            return response()->json($insumo);
        }
        return response()->json('success');
    }

    public function formEdit($id)
    {
        $insumos = insumo::where('id','=',$id)->first();
        $materiaprimas      = materiaprima::orderby('materiaprima')->get();
        // dd($insumos,$materiaprimas);

        return view('insumo.edit' , compact('insumos','materiaprimas'));
    }

    public function edit($id, Request $request)
    {
        // dd($request);
        try{
            $insumo = insumo::find($id);
            $insumo->data                = $request->data;
            $insumo->id_materiaprima     = $request->id_materiaprima;
            $insumo->qtd                 = $request->qtd;
            $insumo->os                  = $request->os;
            $insumo->save();
        }catch(\Exception $e){
            return response()->json($insumo);
        }
        return response()->json('success');
    }

}

