@extends('layouts.model')
@section('content')
    <table class="table table-borderless table-advance table-condensed">
        <tr>
            <td width="80%">
                <h3>
                    <i class="fas fa-laptop"></i> Entrada de Matéria Prima
                </h3>
            </td>
            <td width="50%" align="center">
                <h3>
                    <a class="cor-digiliza" href="{{route('entradamp.add')}}">
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
            <form method="get" action="{{ route('entradamp.listAll') }}">
                @csrf
                    <div class="form-group col-md-4">
                        Materia Prima
                        <input class="form-control" type="text" name="entradamp" id="entradamp">
                    </div>
                </div>
                <button class="btn btn-primary" type="submit" >
                    <span class="fas fa-play"></span> Filtrar
                </button>
            </form >
        </div>
    </div>
    <p>

    <table class="table table-bordered table-condensed table-striped fonte-20">
        <thead>
            <tr>
                <th width="5%">Data</th>
                <th width="15%">Fornecedor</th>
                <th width="5%">NF</th>
                <th width="10%">Materia Prima</th>
                <th width="5%">Quantidade</th>
                <th width="5%">Valor Unitário</th>
                <th width="10%">Valor Total</th>
                <th width="5%">Valor do IPI</th>
                <th width="5%">Vlr Frete</th>
                <th width="5%">Outras Despesas</th>
                <th width="3%"></th>
            </tr>
        </thead>
        <tbody>
            @foreach ($entradamps as $entradamp)
                <tr>
                    <td align="center"> {{ date('d/m/Y',strtotime ($entradamp->data)) }} </td>
                    <td> {{ $entradamp->fornecedor }} </td>
                    <td> {{ $entradamp->nro_nf }} </td>
                    <td> {{ $entradamp->materiaprima }} </td>
                    <td> {{ $entradamp->qnt }} </td>
                    <td> {{ $entradamp->vlr_unit }} </td>
                    <td> {{ $entradamp->vlr_total }} </td>
                    <td> {{ $entradamp->vlr_ipi }} </td>
                    <td> {{ $entradamp->vlr_frete }} </td>
                    <td> {{ $entradamp->vlr_outros }} </td>
                    <td>
                        <div class="btn-group-vertical">
                            <div class="btn-group">
                            <button type="button"  class="btn btn-outline-info dropdown-toggle" data-toggle="dropdown">
                                <i class="fas fa-cogs"></i>
                                <span>Ação</span>
                            </button>
                            <div class="dropdown-menu">
                                <a class="dropdown-item" href="{{route('entradamp.formEdit', $entradamp->id)}}">
                                    <i class="far fa-edit"></i>&nbsp;&nbsp;&nbsp;
                                    <span>Editar</span>
                                </a>
                                <a class="dropdown-item" href="#">
                                    {{-- <form action=" {{ route('entradamp.destroy',['entradamp'=> $entradamp->id ]) }} " method="POST">
                                        @csrf
                                        @method('delete')
                                        <input type="hidden" name='entradamp' value=" {{ $entradamp->id }} ">
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
