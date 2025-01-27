<?php

namespace App\Http\Controllers\entradamp;

use App\Http\Controllers\Controller;
use App\Models\entradamp;
use App\Models\cliente;
use App\Models\materiaprima;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class entradampController extends Controller
{
    public function listAll(Request $request ){
        $filtros = [];

        $entradamp  = ($request->get('entradamp'))? $request->get('entradamp') : session('entradamp');
        session()->put('entradamp', $entradamp);
        if($entradamp){
            $filtros[]=['entradamps.entradamp','like','%'.$entradamp.'%'];
        }

        $entradamps = entradamp:: leftJoin('cliente','cliente.id','entradamp.id_fornecedor')
                                        ->leftJoin('users','users.id','entradamp.user_id')
                                        ->leftJoin('materiaprima','materiaprima.id','entradamp.id_mp')
                                        ->where($filtros)
                                        ->orderBy('data','desc')
                                        ->orderBy('id','desc')
                                        ->get([
                                            'entradamp.id'
                                            , 'entradamp.user_id'
                                            , 'entradamp.data'
                                            , 'cliente.cliente  as fornecedor'
                                            , 'materiaprima.materiaprima'
                                            , 'entradamp.qnt'
                                            , 'entradamp.vlr_unit'
                                            , 'entradamp.vlr_total'
                                            , 'entradamp.vlr_ipi'
                                            , 'entradamp.vlr_frete'
                                            , 'entradamp.vlr_outros'
                                            , 'entradamp.nro_nf'
                                            , 'users.name'
                                            , 'materiaprima.id  as id_mp'
                                            , 'cliente.id   as id_fornecedor'
                                    ]);
        return view('entradamp.listAll' , compact('entradamps'));
    }

    public function formAdd()
    {
        $user_id            = Auth::user()->id;
        $entradamps         = entradamp::orderby('id')->get();
        $clientes           = cliente::orderby('cliente')->get();
        $materiaprimas      = materiaprima::orderby('materiaprima')->get();
        return view('entradamp.add', compact('entradamps','clientes','materiaprimas'));
    }
    public function strore(Request $request)
    {
        try{
            $entradamp = new entradamp([
                "id"                    => $request->id
                ,"data"                 => $request->data
                ,"fornecedor"           => $request->fornecedor
                ,"materiaprima"         => $request->materiaprima
                ,"qnt"                  => $request->qnt
                ,"vlr_unit"             => $request->vlr_unit
                ,"vlr_total"            => $request->vlr_total
                ,"vlr_ipi"              => $request->vlr_ipi
                ,"vlr_frete"            => $request->vlr_frete
                ,"vlr_outros"           => $request->vlr_outros
                ,"nro_nf"               => $request->nro_nf
                ,"name"                 => $request->name
                ,"id_mp"                => $request->id_mp
                ,"id_fornecedor"        => $request->id_fornecedor
                ]);
            $entradamp->save();
        }catch(\Exception $e){
            return response()->json($entradamp);
        }
        return response()->json('success');
    }

    public function formEdit($id)
    {
        $entradamp = entradamp::where('id','=',$id)->first();
        $clientes           = cliente::orderby('cliente')->get();
        $materiaprimas      = materiaprima::orderby('materiaprima')->get();

        return view('entradamp.edit' , compact('entradamp','clientes','materiaprimas'));
    }

    public function edit($id, Request $request)
    {
        try{
            $entradamp = entradamp::find($id);
            $entradamp->data                = $request->data;
            $entradamp->fornecedor          = $request->fornecedor;
            $entradamp->materiaprima        = $request->materiaprima;
            $entradamp->qnt                 = $request->qnt;
            $entradamp->vlr_unit            = $request->vlr_unit;
            $entradamp->vlr_total           = $request->vlr_total;
            $entradamp->vlr_ipi             = $request->vlr_ipi;
            $entradamp->vlr_frete           = $request->vlr_frete;
            $entradamp->vlr_outros          = $request->vlr_outros;
            $entradamp->nro_nf              = $request->nro_nf;
            $entradamp->id_mp               = $request->id_mp;
            $entradamp->id_fornecedor       = $request->id_fornecedor;
            $entradamp->save();
        }catch(\Exception $e){
            return response()->json($entradamp);
        }
        return response()->json('success');
    }

}

