@extends('layouts.model')

@section('content')
    <h3 class=""><i class="fa fa-address-book"></i>Alteração de Entrada de Matéria Prima</h3><hr>
    <form action="" id="cadastro-entradamp" nome="cadastro-entradamp" method="post">
        @csrf
        @method('patch')
        <input type="hidden" name="route" id="route" value="/entradamp/edit/{{$entradamp->id}}">
        <input type="hidden" name="type" id="type" value="PATCH">
        <input type="hidden" name="origem" id="origem" value="entradamp">

        <div class="row">
            <div class="form-group col-md-3">
                Data
                <input class="form-control" type="date" name="data" id="data"  value="{{ date('Y-m-d') }}" >
            </div>
            {{-- <div class="form-group col-md-6">
                Fornecedor
                <select class="form-control limpar" type="text" name="fornecedor" id="id_fornecedor">
                    <option value="%">Todas</option>
                    @foreach ($clientes as $cliente )
                        <option value="{{ $cliente->id }}">{{ $cliente->cliente }}</option>
                    @endforeach
                </select>
            </div> --}}
            <div class="form-group col-md-2">
                Número da NF
                <input class="form-control limpar" type="number" step="any" name="nro_nf" id="nro_nf" value="{{$entradamp->nro_nf}}">
            </div>
            <div class="form-group limpar col-md-4">
                Materia Prima
                <select class="form-control limpar" type="text" name="materiaprima" id="id_mp">
                    <option value="%">Todas</option>
                    @foreach ($materiaprimas as $materiaprima )
                        <option value="{{ $materiaprima->id }}">{{ $materiaprima->materiaprima }}</option>
                    @endforeach
                </select>
            </div>
            <div class="form-group col-md-2">
                Quantidade
                <input class="form-control limpar" type="number" step="any" name="qnt" id="qnt" value="{{$entradamp->qnt}}">
            </div>
            <div class="form-group col-md-2">
                Valor Unitário
                <input class="form-control limpar" type="number" step="any" name="vlr_unit" id="vlr_unit" value="{{$entradamp->vlr_unit}}">
            </div>
            <div class="form-group col-md-2">
                Valor Total
                <input class="form-control limpar" type="number" step="any" name="vlr_total" id="vlr_total" value="{{$entradamp->vlr_total}}">
            </div>
            <div class="form-group col-md-2">
                Valor do IPI
                <input class="form-control limpar" type="number" step="any" name="vlr_ipi" id="vlr_ipi" value="{{$entradamp->vlr_ipi}}">
            </div>
            <div class="form-group col-md-2">
                Valor do Frete
                <input class="form-control limpar" type="number" step="any" name="vlr_frete" id="vlr_frete" value="{{$entradamp->vlr_frete}}">
            </div>
            <div class="form-group col-md-2">
                Outras Despesas
                <input class="form-control limpar" type="number" step="any" name="vlr_outros" id="vlr_outros" value="{{$entradamp->vlr_outros}}">
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
                $(location).attr('href',url+'/entradamp');
            })
        })
    </script>

@endsection
