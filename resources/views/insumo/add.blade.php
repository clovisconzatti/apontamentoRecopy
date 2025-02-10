@extends('layouts.model')

@section('content')
    <h3 class=""><i class="fas fa-laptop"></i> Consumo de Insumo</h3><hr>
    <form action="" id="cadastro-insumo" nome="cadastro-insumo" method="post">
        @csrf
        @method('patch')

        <input type="hidden" name="route" id="route" value="/insumo/store">
        <input type="hidden" name="type" id="type" value="POST">
        <input type="hidden" name="origem" id="origem" value="insumo">

        <div class="row">
            <div class="form-group col-md-3">
                Data
                <input class="form-control" type="date" name="data" id="data"  value="{{ date('Y-m-d') }}" >
            </div>
            <div class="form-group col-md-2">
                Número da OS
                <input class="form-control limpar" type="number" step="any" name="os" id="os">
            </div>
            <div class="form-group limpar col-md-4">
                Insumo
                <select class="form-control limpar" type="text" name="id_materiaprima" id="id_materiaprima">
                    <option value="%">Todas</option>
                    @foreach ($materiaprimas as $materiaprima )
                        <option value="{{ $materiaprima->id }}">{{ $materiaprima->materiaprima }}</option>
                    @endforeach
                </select>
            </div>
            <div class="form-group col-md-2">
                Quantidade
                <input class="form-control limpar" type="number" step="any" name="qtd" id="qtd">
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
                $(location).attr('href',url+'/insumo');
            })
        })
    </script>

@endsection
