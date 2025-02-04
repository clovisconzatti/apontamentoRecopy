@extends('layouts.model')

@section('content')
    <h3 class=""><i class="fas fa-laptop"></i> Cadastro da OS</h3><hr>
    <form action="" id="cadastro-cadastroos" nome="cadastro-cadastroos" method="post">
        @csrf
        @method('patch')
        <input type="hidden" name="route" id="route" value="/cadastroos/store">
        <input type="hidden" name="type" id="type" value="POST">
        <input type="hidden" name="origem" id="origem" value="cadastroos">
        <div class="row">
            <div class="form-group col-md-2">
                Data
                <input class="form-control" type="date" name="data" id="data" value="{{ date('Y-m-d') }}" >
            </div>
            <div class="form-group col-md-2">
                Nr. OS
                <input class="form-control limpar" type="number" name="os" id="os" >
            </div>
            <div class="form-group col-md-4">
                Cliente
                <select class="form-control limpar" type="text" name="cliente" id="cliente">
                    <option value="%">Todas</option>
                    @foreach ($clientes as $cliente )
                        <option value="{{ $cliente->cliente }}">{{ $cliente->cliente }}</option>
                    @endforeach
                </select>
            </div>
            <div class="form-group col-md-4">
                Produto
                <select class="form-control limpar" type="text" name="produto" id="produto">
                    <option value="%">Todas</option>
                    @foreach ($produtos as $produto )
                        <option value="{{ $produto->id }}">{{ $produto->produto }}</option>
                    @endforeach
                </select>
            </div>
        </div>
        <div class="row">
            <div class="form-group col-md-3">
                Matéria Prima
            </div>
            <div class="form-group col-md-2">
                Quantidade
            </div>
        </div>
        <div class="row">
            <div class="form-group col-md-12">
                {{-- inicio do movimento --}}
                <div id="sectionItem">
                    <div class="sectionItem">
                        <div class="row">
                            <div class="form-group col-md-3">
                                <select class="form-control limpar" type="text" id="mp_id" name="mp_id[]">
                                <option value="%">Todas</option>
                                    @foreach ($materiaprima as $materiaprima )
                                        <option value="{{ $materiaprima->id }}">{{ $materiaprima->materiaprima }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="form-group col-md-2">
                                <input class="form-control limpar" type="text" id="qnt" name="qnt[]">
                            </div>
                            <div class="form-group col-md-2">
                                <button type="button" name="add-Item[]" id="addItem" value="" class="btn btn-outline-primary addsectionItem fas fonte-10">
                                    <span class="fas fa-plus"></span>
                                </button>
                                <button type="button" name="delItem" id="minusItem" value="" class="btn btn-outline-danger removeItem fas fonte-10">
                                    <span class="fas fa-minus"></span>
                            </div>
                        </div>
                    </div>
                </div>
                {{-- fim da movimento --}}
            </div>
        </div><hr>
        <hr>
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
                $(location).attr('href',url+'/cadastroos');
            })
        })


        /******************************** clone Item ******************************/
 var templateItem = $('#sectionItem .sectionItem:first').clone();
    //clear inputs
    templateItem.find("select").val('');
    templateItem.find("input").val('');

    //define counter
    var sectionsCountItem = $(document).find('.sectionItem').length;
    //add new section
    $('body').on('click', '.addsectionItem', function() {
        //increment
        sectionsCountItem++;
        //loop through each input
        var section = templateItem.clone().find(':input').each(function(){
            //set id to store the updated section number
            var newIdItem = this.id + sectionsCountItem;
            //update for label
            $(this).prev().attr('for', newIdItem);
            //update id
            this.id = newIdItem;

        }).end()

        //inject new section
        .appendTo('#sectionItem');
        colocaChosen();

        var Key = parseInt($(this).attr("id").replace(/\D/g, ''));
        if(isNaN(Key)){
            Key=1
        };
        Key ++;

        return false;
    });

    //remove section
    $('#sectionItem').on('click', '.removeItem', function() {
        var id = $(this).attr("id").replace(/[^\d]+/g,'');
        var  acao = 'del';
        if($(document).find('.sectionItem').length>1){
            $(this).parent().fadeOut(300, function(){
                //remove parent element (main section)
                $(this).parent().parent().remove();

                return false;
            })
        }
        return false;
    });

    </script>

@endsection
