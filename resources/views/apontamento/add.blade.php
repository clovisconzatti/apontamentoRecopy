@extends('layouts.model')

@section('content')
    <h3 class=""><i class="fas fa-laptop"></i> Apontamento</h3><hr>
    <form action="" id="cadastro-apontamento" nome="cadastro-apontamento" method="post">
        @csrf
        @method('patch')

        <input type="hidden" name="route" id="route" value="/apontamento/store">
        <input type="hidden" name="type" id="type" value="POST">
        <input type="hidden" name="origem" id="origem" value="apontamento">

        <div class="row">
            <div class="form-group col-md-3">
                * Data *
                <input class="form-control" type="date" name="data" id="data"  value="{{ date('Y-m-d') }}" >
            </div>
            <div class="form-group col-md-2">
                * Hs Inicial *
                <input class="form-control limpar" type="time" name="h_inicial" id="h_inicial">
            </div>
            <div class="form-group col-md-2">
                * Hs Final *
                <input class="form-control limpar" type="time" name="h_final" id="h_final">
            </div>
            <div class="form-group col-md-3">
                Colaborador:
                <select class="form-control limpar" type="text" name="colaborador" id="colaborador">
                <option value="%">Todas</option>
                    @foreach ($colaboradores as $colaborador )
                        <option value="{{ $colaborador->id }}">{{ $colaborador->colaborador }}</option>
                    @endforeach
                </select>
            </div>
            <div class="form-group col-md-10">
                Observação
                <input class="form-control limpar" type="text" name="obs" id="obs">
            </div>
        </div>
            <div class="row">
            <div class="form-group col-md-7">
                Nro_OS - Cliente:
                <select class="form-control limpar" type="text" name="nro_os" id="nro_os">
                <option value="%">Todas</option>
                    @foreach ($cadastro_oss as $cadastro_os )
                        <option value="{{ $cadastro_os->os }}">{{ $cadastro_os->os }} - {{ $cadastro_os->cliente_id }}</option>
                    @endforeach
                </select>
            </div>
            {{-- <div class="form-group col-md-5">
                Cliente:
                <select class="form-control limpar" type="text" name="cliente" id="cliente">
                    <option value="%">Todas</option>
                    @foreach ($clientes as $cliente )
                        <option value="{{ $cliente->id }}">{{ $cliente->cliente }}</option>
                    @endforeach
                </select>
            </div> --}}
            </div>
        <div class="row">
            <div class="form-group col-md-3">
                <button type="submit" name="salvar" value="" id="salvar" class="btn btn-success btn-block">
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
