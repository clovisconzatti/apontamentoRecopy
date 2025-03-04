<?php

namespace App\Http\Controllers\cadastroos;

use App\Http\Controllers\Controller;
use App\Models\cadastro_os;
use App\Models\cliente;
use App\Models\materiaprima;
use App\Models\movimento_os;
use App\Models\produto;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class cadastroosController extends Controller
{

    public function listAll(Request $request ){
        // dd($request);
        $filtros=[];

        $user = user::where('email','=',Auth::user()->email)->first();
        $filtrouser = $user->id;
        $userSelecionado = $request->user;

        $nivel = Auth::user()->nivel;
        if($nivel!='admin'){
            $filtros[]=['cadastro_os.usuario','=',$user->id];
        };
        if($nivel=='admin'){
            $user = User::where('ativo','S')->orderBy('name')->get();
            $filtrouser = $user;
            $filtrouser  = ($request->get('user'))? $request->user : session('filtrouser');

            if($userSelecionado=="0"){ $filtrouser = "0";};

            session()->put('filtrouser', $filtrouser);

            if($filtrouser>0){
                $filtros[]=['cadastro_os.usuario','=',$filtrouser];
            }
        }else{
            $filtros[]=['cadastro_os.usuario','>','0'];
            $user = user::where('Id','=',$user)->get();
        }

        $filtroDtInicial  = ($request->get('data'))? $request->get('data') : session('filtroDtInicial');
        session()->put('filtroDtInicial', $filtroDtInicial);
        $filtroDtFinal  = ($request->get('data'))? $request->get('data') : session('filtroDtFinal');
        session()->put('filtroDtFinal', $filtroDtFinal);

        $usuario  = ($request->get('usuario'))? $request->get('usuario') : session('usuario');
        session()->put('usuario', $usuario);

        $cliente  = ($request->get('cliente'))? $request->get('cliente') : session('cliente');
        session()->put('cliente', $cliente);

        $produto  = ($request->get('produto'))? $request->get('produto') : session('produto');
        session()->put('produto', $produto);


        if($usuario){
            $filtros[]=['users.name','like','%'.$usuario.'%'];
        }
        if($cliente){
            $filtros[]=['cliente.cliente','like','%'.$cliente.'%'];
        }


        if($filtroDtFinal){
            $filtros[]=['cadastro_os.data','>=',$filtroDtInicial];
            $filtros[]=['cadastro_os.data','<=',$filtroDtFinal];
        }
        // DB::connection()->enableQueryLog();
        $cadastro_oss = cadastro_os::   leftJoin('cliente','cliente.id','cadastro_os.cliente_id')
                                        ->leftJoin('produto','produto.id','cadastro_os.produto_id')
                                        ->leftJoin('users','users.id','cadastro_os.usuario')
                                        ->where($filtros)
                                        ->orderBy('data','desc')
                                        ->orderBy('id','desc')
                                        ->get([
                                            'cadastro_os.id'
                                            , 'cadastro_os.usuario'
                                            , 'cadastro_os.data'
                                            , 'cadastro_os.os'
                                            , 'cadastro_os.cliente_id'
                                            , 'cadastro_os.produto_id'
                                            , 'cliente.cliente'
                                            , 'produto.produto'
                                            , 'users.name'
                                    ]);
        // $queries = DB::getQueryLog();
        // dd($queries);
        return view('cadastroos.listAll' , compact('cadastro_oss','filtroDtInicial','filtroDtFinal','usuario','cliente','produto'));
    }

    public function formAdd()
    {
        $user_id            = Auth::user()->id;
        $cadastro_oss       = cadastro_os::orderby('data','desc')->get();
        $clientes           = cliente::orderby('cliente')->get();
        $produtos           = produto::orderby('produto')->get();
        $materiaprima       = materiaprima::orderby('materiaprima')->get();
        return view('cadastroos.add',compact('cadastro_oss','clientes','produtos','materiaprima'));
    }
    public function strore(Request $request)
    {
        try{
            $cadastro_os = new cadastro_os([
                "usuario"           => Auth::user()->id
                , "data"            => $request->data
                , "os"              => $request->os
                , "cliente_id"      => $request->cliente
                , "produto_id"      => $request->produto
                , "cliente"         => $request->cliente
                , "produto"         => $request->produto
            ]);
            $cadastro_os->save();
            $movimentoos_id=$cadastro_os->id;
        }catch(\Exception $e){
            return response()->json($e);
        }

        foreach($request->mp_id as $key => $mp){
            try{
                $movimentoos=new movimento_os([
                    'movimentoos_id'          =>$movimentoos_id
                    ,'mp_id'                  =>$mp
                    ,'qnt'                    =>$request->qnt[$key]
                ]);
                $movimentoos->save();
            }catch(\Exception $e){
                return response()->json($e);
            }
        };

        return response()->json('success');
    }

    public function formEdit($id)
    {
        $cadastro_os        = cadastro_os::where('id','=',$id)->first();
        $clientes           = cliente::orderby('cliente')->get();
        $produtos           = produto::orderby('produto')->get();
        $materiaprima       = materiaprima::orderby('materiaprima')->get();
        $movimento_os       = movimento_os::where('movimentoos_id',$id)->get();


        return view('cadastroos.edit' , compact('cadastro_os','clientes','produtos','materiaprima','movimento_os'));
    }

    public function edit($id, Request $request)
    {
        try{
            $cadastro_os = cadastro_os::find($id);
            $cadastro_os->data            = $request->data;
            $cadastro_os->os              = $request->os;
            $cadastro_os->cliente_id      = $request->cliente;
            $cadastro_os->produto_id      = $request->produto;
            $cadastro_os->save();
        }catch(\Exception $e){
            return response()->json($cadastro_os);
        }

        $cadastro_os->movimento_os()->delete();
        foreach($request->mp_id as $key => $mp){
            try{
                $movimentoos=new movimento_os([
                    'movimentoos_id'          =>$id
                    ,'mp_id'                  =>$mp
                    ,'qnt'                    =>$request->qnt[$key]
                ]);
                $movimentoos->save();
            }catch(\Exception $e){
                return response()->json($e);
            }
        };
        return response()->json('success');
    }


}
