<?php

namespace App\Http\Controllers\apontamento;

use App\Http\Controllers\Controller;
use App\Models\apontamento;
use App\Models\cadastro_os;
use App\Models\cliente;
use App\Models\colaborador;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class apontamentoController extends Controller
{

    public function listAll(Request $request ){
        $filtros=[];

        $user = User::where('email','=',Auth::user()->email)->first();
        $filtrouser = $user->id;
        $userSelecionado = $request->user;

        $nivel = Auth::user()->nivel;
        if($nivel!='admin'){
            $filtros[]=['apontamento.user_id','=',$user->id];
        };
        if($nivel=='admin'){
            $user = user::where('ativo','S')->orderBy('name')->get();
            $filtrouser = $user;
            $filtrouser  = ($request->get('user'))? $request->user : session('filtrouser');

            if($userSelecionado=="0"){ $filtrouser = "0";};

            session()->put('filtrouser', $filtrouser);

            if($filtrouser>0){
                $filtros[]=['apontamento.user_id','=',$filtrouser];
            }
        }else{
            $filtros[]=['apontamento.user_id','>','0'];
            $user = user::where('Id','=',$user)->get();
        }

        $filtroDtInicial  = ($request->get('dtInicial'))? $request->get('dtInicial') : session('filtroDtInicial');
        session()->put('filtroDtInicial', $filtroDtInicial);
        $filtroDtFinal  = ($request->get('dtFinal'))? $request->get('dtFinal') : session('filtroDtFinal');
        session()->put('filtroDtFinal', $filtroDtFinal);

        $colaborador  = ($request->get('colaborador'))? $request->get('colaborador') : session('colaborador');
        session()->put('colaborador', $colaborador);

        $cliente  = ($request->get('cliente'))? $request->get('cliente') : session('cliente');
        session()->put('cliente', $cliente);


        if($colaborador){
            $filtros[]=['users.name','like','%'.$colaborador.'%'];
        }
        if($cliente){
            $filtros[]=['cliente.cliente','like','%'.$cliente.'%'];
        }


        if($filtroDtFinal){
            $filtros[]=['apontamento.data','>=',$filtroDtInicial];
            $filtros[]=['apontamento.data','<=',$filtroDtFinal];
        }
        $apontamentos = apontamento:: leftJoin('cliente','cliente.id','apontamento.cliente')
                                        ->leftJoin('users','users.id','apontamento.user_id')
                                        ->leftJoin('cadastro_os','cadastro_os.id','apontamento.id_os')
                                        ->leftJoin('colaborador','colaborador.id','apontamento.colaborador')
                                        ->where($filtros)
                                        ->orderBy('data','desc')
                                        ->orderBy('id','desc')
                                        ->get([
                                            'apontamento.id'
                                            , 'apontamento.user_id'
                                            , 'apontamento.data'
                                            , 'apontamento.h_inicial'
                                            , 'apontamento.h_final'
                                            , 'apontamento.nro_os'
                                            , 'apontamento.cliente as cod_cli'
                                            , 'cliente.cliente'
                                            , 'users.name'
                                            , 'cadastro_os.id as id_os'
                                            , 'cadastro_os.os'
                                            , 'colaborador.colaborador'
                                            , 'obs'
                                    ]);
        // dd($apontamentos);
        return view('apontamento.listAll' , compact('apontamentos','filtroDtInicial','filtroDtFinal'));
    }

    public function formAdd()
    {
        $user_id            = Auth::user()->id;
        $clientes           = cliente::orderby('cliente')->get();
        $cadastro_oss        = cadastro_os::orderby('id')->get();
        $colaboradores       = colaborador::orderby('colaborador')->get();
        return view('apontamento.add',compact('clientes','cadastro_oss','colaboradores'));
    }
    public function strore(Request $request)
    {
        try{
            $apontamento = new apontamento([
                "user_id"           => Auth::user()->id
                , "data"            => $request->data
                , "h_inicial"       => $request->h_inicial
                , "h_final"         => $request->h_final
                , "nro_os"          => $request->nro_os
                , "cliente"         => $request->cliente
                , "id_os"           => $request->id_os
                , "os"              => $request->os
                , "colaborador"     => $request->colaborador
                , "obs"             => $request->obs
            ]);
            $apontamento->save();
        }catch(\Exception $e){
            return response()->json($e);
        }
        return response()->json('success');
    }

    public function formEdit($id)
    {
        $apontamento = apontamento::where('id','=',$id)->first();
        $clientes           = cliente::orderby('cliente')->get();
        $cadastro_oss         = cadastro_os::orderby('id')->get();
        $colaboradores        = colaborador::orderby('colaborador')->get();
        return view('apontamento.edit' , compact('apontamento','clientes','cadastro_oss','colaboradores'));
    }

    public function edit($id, Request $request)
    {
        try{
            $apontamento = apontamento::find($id);
            $apontamento->data              = $request->data;
            $apontamento->h_inicial		    = $request->h_inicial;
            $apontamento->h_final           = $request->h_final;
            $apontamento->nro_os            = $request->nro_os;
            $apontamento->colaborador       = $request->colaborador;
            $apontamento->obs               = $request->obs;
            $apontamento->save();
        }catch(\Exception $e){
            return response()->json($apontamento);
        }
        return response()->json('success');
    }


}
