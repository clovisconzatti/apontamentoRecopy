@extends('layouts.model')

@section('content')
    <h3 class=""><i class="fa fa-address-book"></i>Alteração de Cliente</h3><hr>
    <form action="" id="cadastro-cliente" nome="cadastro-cliente" method="post">
        @csrf
        @method('patch')
        <input type="hidden" name="route" id="route" value="/cliente/edit/{{$cliente->id}}">
        <input type="hidden" name="type" id="type" value="PATCH">
        <input type="hidden" name="origem" id="origem" value="cliente">
        <div class="row">
            <div class="form-group col-md-8">
                Nome do Cliente
                <input class="form-control" type="text" name="cliente" id="cliente" value="{{ $cliente->cliente }}">
            </div>
            </div>
        <div class="row">
            <div class="form-group col-md-3">
                <button type="submit" name="salvar" value="{{$cliente->id}}" id="salvar" class="btn btn-success btn-block">
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
                $(location).attr('href',url+'/cliente');
            })
        })

    </script>

@endsection
