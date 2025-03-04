@extends('layouts.model')
@section('content')
    <table class="table table-borderless table-advance table-condensed">
        <tr>
            <td width="80%">
                <h3>
                    <i class="fas fa-laptop"></i> Cadastro de OS
                </h3>
            </td>
            <td width="50%" align="center">
                <h3>
                    <a class="cor-digiliza" href="{{route('cadastroos.add')}}">
                        <i class="fas fa-plus-circle"></i>&nbsp;&nbsp;&nbsp;
                        <span>Novo</span>
                    </a>
                </h3>
            </td>
        </tr>
    </table><hr>
    <button class="btn btn-primary" type="button" data-toggle="collapse" data-target="#collapseExample" aria-expanded="false" aria-controls="collapseExample">
        <span class="fas fa-filter"></span> Filtros
    </button><p>
    <div class="collapse" id="collapseExample">
        <div class="card card-body">
            <form method="get" action="{{ route('cadastroos.listAll') }}">
                @csrf
                <div class="row">
                    <div class="form-group col-md-2">
                        Data Inicial
                        <input class="form-control" type="date" name="filtroDtInicial" id="filtroDtInicial">
                    </div>
                    <div class="form-group col-md-2">
                        Data Final
                        <input class="form-control" type="date" name="filtroDtFinal" id="filtroDtFinal">
                    </div>
                    <div class="form-group col-md-4">
                        Cliente
                        <input class="form-control" type="text" name="cliente" id="cliente">
                    </div>
                    <div class="form-group col-md-4">
                        Produto
                        <input class="form-control" type="text" name="produto" id="produto">
                    </div>
                </div>
                <button class="btn btn-primary" type="submit" >
                    <span class="fas fa-play"></span> Filtrar
                </button>
            </form >
        </div>
    </div>
    <p>
    </div>

    <table class="table table-bordered table-condensed table-striped fonte-20">
        <thead>
            <tr>
                <th width="10%">Data</th>
                <th width="5%">OS</th>
                <th width="20%">Cliente</th>
                <th width="20%">Produto</th>
                <th width="10%"></th>
            </tr>
        </thead>
        <tbody>
            @foreach ($cadastro_oss as $cadastroos)
                <tr>
                    <td> {{ date('d/m/Y', strtotime($cadastroos->data)) }} </td>
                    <td> {{ $cadastroos->os }} </td>
                    <td> {{ $cadastroos->cliente_id }} </td>
                    <td> {{ $cadastroos->produto }} </td>
                    <td>
                        <div class="btn-group-vertical">
                            <div class="btn-group">
                            <button type="button"  class="btn btn-outline-info dropdown-toggle" data-toggle="dropdown">
                                <i class="fas fa-cogs"></i>
                                <span>Ação</span>
                            </button>
                            <div class="dropdown-menu">
                                <a class="dropdown-item" href="{{route('cadastroos.formEdit', $cadastroos->id)}}">
                                    <i class="far fa-edit"></i>&nbsp;&nbsp;&nbsp;
                                    <span>Editar</span>
                                </a>
                                <a class="dropdown-item" href="#">
                                    {{-- <form action=" {{ route('cadastroos.destroy',['cadastroos'=> $cadastroos->id ]) }} " method="POST">
                                        @csrf
                                        @method('delete')
                                        <input type="hidden" name='cadastroos' value=" {{ $cadastroos->id }} ">
                                        <i class="far fa-trash-alt"></i>
                                        <input type="submit" class="btn btn-default delete"  value="Eliminar"> --}}
                                    </form>
                                </a>
                            </div>
                            </div>
                        </div>
                    </td>
                </tr>
            @endforeach

        </tbody>
    </table>

    {{-- {{$Operadores->links()}} --}}
@endsection
