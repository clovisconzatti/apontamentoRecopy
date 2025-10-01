@extends('layouts.model')

@section('content')
    <h3 class=""><i class="fas fa-laptop"></i> Cadastro de Produto</h3><hr>
    <form action="" id="cadastro-materiaprima" nome="cadastro-materiaprima" method="post">
        @csrf
        @method('patch')

        <input type="hidden" name="route" id="route" value="/materiaprima/store">
        <input type="hidden" name="type" id="type" value="POST">
        <input type="hidden" name="origem" id="origem" value="materiaprima">

        <div class="row">
            <div class="form-group limpar col-md-4">
                Materia Prima
                <input class="form-control limpar" type="text" name="materiaprima" id="materiaprima">
            </div>
            <div class="form-group col-md-2">
                Unidade
                <select class="form-control limpar" type="text" name="unidade" id="unidade">
                    <option value="">Selecione...</option>
                    <option value="UN">Unidade</option>
                    <option value="PC">Peça</option>
                    <option value="MT">Metro</option>
                    <option value="M²">Metro Quadrado</option>
                    <option value="M³">Metro Cubico</option>
                    <option value="KG">Kilo</option>
                </select>
            </div>
            <div class="form-group col-md-2">
                Codigo do Sistema
                <input class="form-control limpar" type="text" name="cod_sistema" id="cod_sistema">
            </div>
            <div class="form-group col-md-2">
                Estoque Minimo
                <input class="form-control limpar" type="text" name="estoque_minimo" id="estoque_minimo">
            </div>
            <div class="form-group col-md-2">
                Matéria Prima/Insumo
                <select class="form-control limpar" name="tipo" id="tipo">
                    <option value="">Selecione...</option>
                    <option value="MP">Matéria Prima</option>
                    <option value="I">Insumo</option>
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
                $(location).attr('href',url+'/materiaprima');
            })
        })
    </script>

@endsection
