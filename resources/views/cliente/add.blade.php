@extends('layouts.model')

@section('content')
    <h3 class=""><i class="fas fa-laptop"></i> Cliente</h3><hr>
    <form action="" id="cadastro-cliente" nome="cadastro-cliente" method="post">
        @csrf
        @method('patch')

        <input type="hidden" name="route" id="route" value="/cliente/store">
        <input type="hidden" name="type" id="type" value="POST">
        <input type="hidden" name="origem" id="origem" value="cliente">

        <div class="row">
            {{-- <div class="form-group col-md-3"></div> --}}
            {{-- <div class="form-group col-md-4">Manhã</div> --}}
            {{-- <div class="form-group col-md-4">Tarde</div> --}}
        </div>
        <div class="row">
            <div class="form-group col-md-9">
                Nome do Cliente
                <input class="form-control limpar" type="text" name="cliente" id="cliente">
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
                $(location).attr('href',url+'/cliente');
            })
        })
    </script>

@endsection
