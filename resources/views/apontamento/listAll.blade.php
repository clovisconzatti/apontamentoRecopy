@extends('layouts.model')
@section('content')
    <table class="table table-borderless table-advance table-condensed">
        <tr>
            <td width="80%">
                <h3>
                    <i class="fas fa-laptop"></i> Apontamentos
                </h3>
            </td>
            <td width="50%" align="center">
                <h3>
                    <a class="cor-digiliza" href="{{route('apontamento.add')}}">
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
                <form method="get" action="{{ route('apontamento.listAll') }}">
                    @csrf
                    <div class="row">
                        <div class="form-group col-md-5">
                            Colaborador:
                            <input class="form-control" type="text" name="colaborador" value="">
                        </div>
                        <div class="form-group col-md-5">
                            Cliente:
                            <input class="form-control" type="text" name="cliente" value="">
                        </div>
                        <div class="form-group col-md-3">
                            Data inicial:
                            <input class="form-control" type="date" name="dtInicial" value="">
                        </div>
                        <div class="form-group col-md-3">
                            Data final:
                            <input class="form-control" type="date" name="dtFinal" value="">
                        </div>
                    </div>

                    <button class="btn btn-primary" type="submit" >
                        <span class="fas fa-play"></span> Filtrar
                    </button>
                </form >
            </div>
        </div>
        <p>

    <table class="table table-bordered table-condensed table-striped fonte-10">
        <thead>
            <tr>
                <th width="5%">Data</th>
                <th width="5%">Hora Incial</th>
                <th width="5%">Hora Final</th>
                <th width="5%">Nro_OS</th>
                <th width="5%">Colaborador</th>
                <th width="20%">Observação</th>
                <th width="2%"></th>
            </tr>
        </thead>
        <tbody>
            @foreach ($apontamentos as $apontamento)
            <tr>
                    <td align="center"> {{ date('d/m/Y',strtotime($apontamento->data)) }} </td>
                    <td> {{ $apontamento->h_inicial }} </td>
                    <td> {{ $apontamento->h_final }} </td>
                    <td> {{ $apontamento->nro_os }} </td>
                    <td> {{ $apontamento->colaborador }} </td>
                    <td> {{ $apontamento->obs }} </td>

                    <td>
                        <div class="btn-group-vertical">
                            <div class="btn-group">
                            <button type="button"  class="btn btn-outline-info dropdown-toggle" data-toggle="dropdown">
                                <i class="fas fa-cogs"></i>
                                <span>Ação</span>
                            </button>
                            <div class="dropdown-menu">
                                <a class="dropdown-item" href="{{route('apontamento.formEdit',$apontamento->id)}}">
                                    <i class="far fa-edit"></i>&nbsp;&nbsp;&nbsp;
                                    <span>Editar</span>
                                </a>
                                <a class="dropdown-item" href="#">
                                    {{-- <form action=" {{ route('apontamento.destroy',['apontamento'=> $apontamento->id ]) }} " method="POST">
                                        @csrf
                                        @method('delete')
                                        <input type="hidden" name='apontamento' value=" {{ $apontamento->id }} ">
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

    {{-- {{$apontamentoes->links()}} --}}
@endsection
