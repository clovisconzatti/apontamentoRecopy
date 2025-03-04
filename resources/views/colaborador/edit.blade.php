@extends('layouts.model')

@section('content')
    <h3 class=""><i class="fa fa-address-book"></i>Alteração de Colaborador</h3><hr>
    <form action="" id="cadastro-colaborador" nome="cadastro-colaborador" method="post">
        @csrf
        @method('patch')
        <input type="hidden" name="route" id="route" value="/colaborador/edit/{{$colaborador->id}}">
        <input type="hidden" name="type" id="type" value="PATCH">
        <input type="hidden" name="origem" id="origem" value="colaborador">
        <div class="row">
            <div class="form-group col-md-5">
                Nome do Colaborador
                <input class="form-control" type="text" name="colaborador" id="colaborador" value="{{ $colaborador->colaborador }}">
            </div>
            <div class="form-group col-md-3">
                Setor
                <input class="form-control" type="text" name="setor" id="setor" value="{{ $colaborador->setor }}">
            </div>
            </div>
        <div class="row">
            <div class="form-group col-md-3">
                <button type="submit" name="salvar" value="{{$colaborador->id}}" id="salvar" class="btn btn-success btn-block">
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
                $(location).attr('href',url+'/colaborador');
            })
        })

    </script>

@endsection
