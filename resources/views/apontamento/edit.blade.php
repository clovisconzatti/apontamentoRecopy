@extends('layouts.model')

@section('content')
    <h3 class=""><i class="fa fa-address-book"></i> Apontamento</h3><hr>
    <form action="" id="cadastro-apontamento" nome="cadastro-apontamento" method="post">
        @csrf
        @method('patch')
        <input type="hidden" name="route" id="route" value="/apontamento/edit/{{$apontamento->id}}">
        <input type="hidden" name="type" id="type" value="PATCH">
        <input type="hidden" name="origem" id="origem" value="apontamento">

        <div class="row">
            <div class="form-group col-md-3">
                Data:
                <input class="form-control" type="date" name="data" id="data"  value="{{$apontamento->data}}" >
            </div>
            <div class="form-group col-md-2">
                Hs Inicial
                <input class="form-control" type="time" name="h_inicial" id="h_inicial" value="{{$apontamento->h_inicial}}">
            </div>
            <div class="form-group col-md-2">
                Hs Final
                <input class="form-control" type="time" name="h_final" id="h_final" value="{{$apontamento->h_final}}">
            </div>
            <div class="form-group col-md-3">
                Colaborador
                <select class="form-control" type="text" name="colaborador" id="colaborador">
                    <option value="%">Todas</option>
                        @foreach ($colaboradores as $colaborador )
                            <option value="{{ $colaborador->id }}" {{ $colaborador->id==$apontamento->colaborador ? 'selected' : '' }}>{{ $colaborador->colaborador }}</option>
                        @endforeach
                    </select>
            </div>
            <div class="form-group col-md-10">
                Obeservação
                <input class="form-control" type="text" name="obs" id="obs" value="{{$apontamento->obs}}">
            </div>
        </div>
        <div class="row">
            <div class="form-group col-md-7">
                Nro_OS
                <select class="form-control" type="text" name="nro_os" id="nro_os">
                    <option value="%">Todas</option>
                        @foreach ($cadastro_oss as $cadastro_os )
                            <option value="{{ $cadastro_os->os }}" {{ $cadastro_os->os==$apontamento->nro_os ? 'selected' : '' }}>{{ $cadastro_os->os }} - {{ $cadastro_os->cliente_id }}</option>
                        @endforeach
                    </select>
            </div>

            </div>
        <div class="row">
            <div class="form-group col-md-3">
                <button type="submit" name="salvar" value="{{$apontamento->id}}" id="salvar" class="btn btn-success btn-block">
                    <span class="fas fa-save"></span> Salvar
                </button>
            </div>
                <div class="form-group col-md-3">
                    <button type="button" name="sair" id="sair" value="" class="btn btn-danger btn-block">
                        <span class="fa fa-door-open"></span> Sair
                    </button>
                </div>
            </div>
        </div>
    </form>

    <script>
        $(document).ready(function(){

            $('button#sair').click(function(){
                $(location).attr('href',url+'/apontamento');
            })
        })

    </script>

@endsection
