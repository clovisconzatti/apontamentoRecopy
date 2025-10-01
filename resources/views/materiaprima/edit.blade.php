@extends('layouts.model')

@section('content')
    <h3 class=""><i class="fa fa-address-book"></i> Alteração de Matéria Prima</h3><hr>
    <form action="" id="cadastro-materiaprima" nome="cadastro-materiaprima" method="post">
        @csrf
        @method('patch')
        <input type="hidden" name="route" id="route" value="/materiaprima/edit/{{$materiaprima->id}}">
        <input type="hidden" name="type" id="type" value="PATCH">
        <input type="hidden" name="origem" id="origem" value="materiaprima">
        <div class="row">
            <div class="form-group col-md-4">
                Matéria Prima
                <input class="form-control" type="text" name="materiaprima" id="materiaprima" value="{{ $materiaprima->materiaprima }}">
            </div>
            <div class="form-group col-md-2">
                Unidade
                <select class="form-control limpar" name="unidade" id="unidade">
                    <option value="">Selecione</option>
                    <option value="UN" {{($materiaprima->unidade=='UN')? 'selected' : ''}}>Unidade</option>
                    <option value="PC" {{($materiaprima->unidade=='PC')? 'selected' : ''}}>Peça</option>
                    <option value="MT" {{($materiaprima->unidade=='MT')? 'selected' : ''}}>Metro</option>
                    <option value="M²" {{($materiaprima->unidade=='M²')? 'selected' : ''}}>Metro Quadrado</option>
                    <option value="M³" {{($materiaprima->unidade=='M³')? 'selected' : ''}}>Metro Cubico</option>
                    <option value="KG" {{($materiaprima->unidade=='KG')? 'selected' : ''}}>Kilo</option>
                </select>
            </div>
            <div class="form-group col-md-2">
                Codigo do Sistema
                <input class="form-control limpar" type="text" name="cod_sistema" id="cod_sistema" value="{{ $materiaprima->cod_sistema }}">
            </div>
            <div class="form-group col-md-2">
                Estoque Minimo
                <input class="form-control limpar" type="text" name="estoque_minimo" id="estoque_minimo" value="{{ $materiaprima->estoque_minimo }}">
            </div>
            <div class="form-group col-md-2">
                Matéria Prima ou Insumo
                <Select class="form-control limpar" type="text" name="tipo" id="tipo">
                    <option value="">Selecione</option>
                    <option value="MP" {{($materiaprima->tipo=='MP')? 'selected' : ''}}>Materia Prima</option>
                    <option value="I" {{($materiaprima->tipo=='I')? 'selected' : ''}}>Insumo</option>
                </Select>
            </div>
        </div>
        <div class="row">
            <div class="form-group col-md-3">
                <button type="submit" name="salvar" value="{{$materiaprima->id}}" id="salvar" class="btn btn-success btn-block">
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
