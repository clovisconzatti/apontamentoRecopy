@extends('layouts.model')

@section('content')
    <h3 class=""><i class="fa fa-address-book"></i>Alteração de OS</h3><hr>
    <form action="" id="cadastro-cadastroos" nome="cadastro-cadastroos" method="post">
        @csrf
        @method('patch')
        <input type="hidden" name="route" id="route" value="/cadastroos/edit/{{$cadastro_os->id}}">
        <input type="hidden" name="type" id="type" value="PATCH">
        <input type="hidden" name="origem" id="origem" value="cadastroos">
        <div class="row">
            <div class="form-group col-md-2">
                Data
                <input class="form-control" type="date" name="data" id="data" value="{{ $cadastro_os->data }}" >
            </div>
            <div class="form-group col-md-2">
                Nr. OS
                <input class="form-control" type="number" name="os" id="os" value="{{ $cadastro_os->os }}">
            </div>
            <div class="form-group col-md-4">
                Cliente
                <select class="form-control limpar" type="text" name="cliente" id="cliente" value="{{ $cadastro_os->cliente }}">
                    <option value="%">Todas</option>
                    @foreach ($clientes as $cliente )
                        <option value="{{ $cliente->id }}">{{ $cliente->cliente }}</option>
                    @endforeach
                </select>
            </div>
            <div class="form-group col-md-4">
                Produto
                <select class="form-control limpar" type="text" name="produto" id="produto" value="{{ $cadastro_os->produto }}">
                    <option value="%">Todas</option>
                    @foreach ($produtos as $produto )
                        <option value="{{ $produto->id }}">{{ $produto->produto }}</option>
                    @endforeach
                </select>
            </div>
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
                $(location).attr('href',url+'/cadastroos');
            })
        })

    </script>

@endsection