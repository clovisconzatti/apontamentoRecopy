$(document).ready(function(){
    $(document).find('select').chosen();

    /*********************hoje*********************************************************** */
        today=new Date();
        y=today.getFullYear();
        m=today.getMonth()+1;
        m=("00" + m).slice(-2);
        d=today.getDate();
        d=("00" + d).slice(-2);

        const hoje = y + '-' + m + '-' + d;
        $('#data1').val(hoje);


        /**********sempre que tabalhar com Ajax no Laravel tem que incluir essa tag *************/
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });

/***********************colocando duas casas decimais************************************* */
    var decimal = $('.floatNumberField').attr('decimal');
    $('.floatNumberField').val(parseFloat($('.floatNumberField').val()).toFixed(decimal));

    $(".floatNumberField").on('change',function(){
        var decimal = $(this).attr('decimal');
        $(this).val(parseFloat($(this).val()).toFixed(decimal));
    });
/**********************formata numero **************************************************/
    const formCurrency = new Intl.NumberFormat('pt-BR', {
        style: 'currency',
        currency: 'BRL',
        minimumFractionDigits: 2
    })


/*************************pegando a url do servidor**************************************/

    url = $('input#appurl').val();
    var proCodigo = $(document).find('#produto').val();

/************************ buscaCep ******************************************************/
    $(document).on('blur', 'input#cep', function(event){
        event.preventDefault() // não permite que o navegador faça o submit
        var cep = $(this).val();
        var endereco = $('input#endereco').val().trim();
        if(endereco==''){
            buscaCep(cep);
        };
    })

/************************ buscaCnpj ******************************************************/
    $(document).on('blur', 'input#cnpj', function(event){
        var cnpj=$(this).val().replace('.','').replace('/','').replace('-','');

        if(cnpj.length>=14){
            buscaCnpj(cnpj);
        };
    })


/***********************mensagem confirma exclusão **************************************/
    $(document).on('click', '.delete', function(event){
        event.preventDefault()
        Swal({
            title: 'Deseja realmente excluir?',
            type: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#d33',
            cancelButtonColor: '#3085d6',
            cancelButtonText: 'Cancelar',
            confirmButtonText: 'Remover'
        }).then((result) => {
            if (result.value) {
                var form = $(this).parent()
                form.submit()
            }
        });
    })

    /**********************time intervel *********************************************************************/
    // atualizaCards();
    // setInterval(function(){
    //     atualizaCards();
    // }, 5000);

    /**********************FORMATA VALOR DIGITAR ***************************************************************/
    $('.formataValor').on('change',function(event){
        var valor  = parseFloat($(this).val().replace('.','').replace(',','.'));
        valor = formCurrency.format(valor).replace('R$','');
        $(this).val(valor);
    })

    /**********************FORMATA CNPJ DIGITAR ***************************************************************/
    $('#cnpj').on('keyup',function(){
        var cnpj = $(this).val().replaceAll('.','').replaceAll('-','').replaceAll('/','');
        $(this).val(cnpj);

        if(cnpj.length>=11 && cnpj.length<14){
            $(this).val(cnpj.replace(/^(\d{3})(\d{3})(\d{3})(\d{2})/, "$1.$2.$3-$4"))
        }else if(cnpj.length>=14){
            $(this).val(cnpj.replace(/^(\d{2})(\d{3})(\d{3})(\d{4})(\d{2})/, "$1.$2.$3/$4-$5"))
        }
    })


    /**********************gravar menu com ajax **************************************************/
    $(document).on('submit', 'form#cadastro-menu', function(event){
        event.preventDefault()
        var route = $(this).find('input#route').val();
        var type = $(this).find('input#type').val();
        var origem = $(this).find('#origem').val();

        var descricao           = $(this).find('input#descricao').val();
        var tipo                = $(this).find('select#tipo').val();
        var ordem               = $(this).find('input#ordem').val();
        var rota                = $(this).find('input#rota').val();
        var icone               = $(this).find('input#icone').val();


        /********************************************************************************************* */
        if(!descricao || !tipo || !ordem ){
            Swal({
                title: 'Preencha todos os campos obrigatório',
                type: 'error',
                timer:3000
            })
        }else{
            var dados= {
                'descricao' : descricao
                ,'tipo'     : tipo
                ,'ordem'    : ordem
                ,'rota'     : rota
                ,'icone'    : icone
            }
            grava(dados,route,type,origem);
        }
    })


    /***********************liberaMenu *****************************/
    $('#usuario').on('change',function(){
        liberaMenuDisponivel();
        removeMenuLiberado();
    })

    $(document).on('click','input.disponivel',function(event){
        if($(this).is(":checked")){
            var disponivelId = $(this).val();
            var usuario = $(document).find('#usuario').val();
            addMenuUsuario(disponivelId,usuario)
        }else{
            var liberadoId = $(this).val();
            removeMenuUsuario(liberadoId)
        }
    })
    $(document).on('click','button.liberado',function(event){
        var liberadoId = $(this).val();
        removeMenuUsuario(liberadoId)
    })

    /**********************gravar produto **************************************************/
    $(document).on('submit', 'form#cadastro-produto', function(event){
        event.preventDefault()
        var route = $(this).find('input#route').val();
        var type = $(this).find('input#type').val();
        var origem = $(this).find('#origem').val();

        var produto = $(this).find('#produto').val();

        /********************************************************************************************* */
        if(!produto){
            Swal({
                title: 'Preencha todos os campos obrigatório',
                type: 'error',
                timer:3000
            })
        }else{
            var dados= {
                'produto'     : produto

            }
            grava(dados,route,type,origem);
        }
    })

    /**********************gravar cliente **************************************************/
    $(document).on('submit', 'form#cadastro-cliente', function(event){
        event.preventDefault()
        var route = $(this).find('input#route').val();
        var type = $(this).find('input#type').val();
        var origem = $(this).find('#origem').val();

        var cliente = $(this).find('#cliente').val();

          /********************************************************************************************* */
        if(!cliente){
            Swal({
                title: 'Preencha todos os campos obrigatório',
                type: 'error',
                timer:3000
            })
        }else{
            var dados= {
                'cliente'     : cliente

            }
            grava(dados,route,type,origem);
        }
    })

    /**********************gravar os **************************************************/
    $(document).on('submit', 'form#cadastro-cadastroos', function(event){
        event.preventDefault()
        var route = $(this).find('input#route').val();
        var type = $(this).find('input#type').val();
        var origem = $(this).find('#origem').val();

        var data            = $(this).find('input#data').val();
        var cliente         = $(this).find('select#cliente').val();
        var produto         = $(this).find('select#produto').val();
        var os              = $(this).find('input#os').val();

        var mp_id=[];
        $(this).find('select[name="mp_id[]"]').each(function(index){
            mp_id.push($(this).val());
        })

        var qnt=[];
        $(this).find('input[name="qnt[]"]').each(function(index){
            qnt.push($(this).val());
        })

        if(cliente=='%'){cliente=0;};
        if(produto=='%'){produto=0;};

        /********************************************************************************************* */
        if(!data || !cliente || !produto || !os){
            Swal({
                title: 'Preencha todos os campos obrigatório',
                type: 'error',
                timer:3000
            })
        }else{
            var dados= {
                'data'          : data
                ,'cliente'      : cliente
                ,'produto'      : produto
                ,'os'           : os
                ,'mp_id'        : mp_id
                ,'qnt'          : qnt

            }
            grava(dados,route,type,origem);
            // console.log(dados)
        }
    })

        /**********************gravar materia prima **************************************************/
    $(document).on('submit', 'form#cadastro-materiaprima', function(event){
        event.preventDefault()
        var route = $(this).find('input#route').val();
        var type = $(this).find('input#type').val();
        var origem = $(this).find('#origem').val();

        var materiaprima            = $(this).find('input#materiaprima').val();
        var unidade                 = $(this).find('select#unidade').val();
        var cod_sistema             = $(this).find('input#cod_sistema').val();
        var estoque_minimo          = $(this).find('input#estoque_minimo').val();
        var tipo                    = $(this).find('select#tipo').val();
        if(materiaprima=='%'){materiaprima=0;};

          /********************************************************************************************* */
        if(!materiaprima || !unidade || !cod_sistema || !tipo){
            Swal({
                title: 'Preencha todos os campos obrigatório',
                type: 'error',
                timer:3000
            })
        }else{
            var dados= {
                'materiaprima'      : materiaprima
                ,'unidade'          : unidade
                ,'cod_sistema'      : cod_sistema
                ,'estoque_minimo'   : estoque_minimo
                ,'tipo'             : tipo

            }
            grava(dados,route,type,origem);
        }
    })

    /**********************gravar apontamento **************************************************/
    $(document).on('submit', 'form#cadastro-apontamento', function(event){
        event.preventDefault()


        var route = $(this).find('input#route').val();
        var type = $(this).find('input#type').val();
        var origem = $(this).find('#origem').val();

        var user_id         = $(this).find('#user_id').val();
        var data            = $(this).find('input#data').val();
        var h_inicial       = $(this).find('input#h_inicial').val();
        var h_final         = $(this).find('input#h_final').val();
        var nro_os          = $(this).find('select#nro_os').val();
        var colaborador     = $(this).find('select#colaborador').val();
        var obs             = $(this).find('input#obs').val();

        if(nro_os=='%'){nro_os='';};
        if(h_inicial=='%'){h_inicial='';};
        if(h_final=='%'){h_final='';};
        if(data=='%'){data='';};

        /********************************************************************************************* */
        if(!data || !h_inicial || !h_final || !nro_os || !colaborador){
            Swal({
                title: 'Preencha todos os campos obrigatório',
                type: 'error',
                timer:3000
            })
        }else{
            var dados= {
                'user_id'       : user_id
                ,'data'         : data
                ,'h_inicial'    : h_inicial
                ,'h_final'      : h_final
                ,'nro_os'       : nro_os
                ,'colaborador'  : colaborador
                ,'obs'          : obs
                }
            // console.log(dados);
            grava(dados,route,type,origem);
        }
    })

         /**********************gravar entrada materia prima **************************************************/
         $(document).on('submit', 'form#cadastro-entradamp', function(event){
            event.preventDefault()
            var route = $(this).find('input#route').val();
            var type = $(this).find('input#type').val();
            var origem = $(this).find('#origem').val();

            var data                    = $(this).find('input#data').val();
            var id_fornecedor           = $(this).find('select#id_fornecedor').val();
            var id_mp                   = $(this).find('select#id_mp').val();
            var qnt                     = $(this).find('input#qnt').val();
            var vlr_unit                = $(this).find('input#vlr_unit').val();
            var vlr_total               = $(this).find('input#vlr_total').val();
            var vlr_ipi                 = $(this).find('input#vlr_ipi').val();
            var vlr_frete               = $(this).find('input#vlr_frete').val();
            var vlr_outros              = $(this).find('input#vlr_outros').val();
            var nro_nf                  = $(this).find('input#nro_nf').val();

              /********************************************************************************************* */
            if(!id_mp){
                Swal({
                    title: 'Preencha todos os campos obrigatório',
                    type: 'error',
                    timer:3000
                })
            }else{
                var dados= {
                    'data'              : data
                    ,'id_fornecedor'    : id_fornecedor
                    ,'id_mp'            : id_mp
                    ,'qnt'              : qnt
                    ,'vlr_unit'         : vlr_unit
                    ,'vlr_total'        : vlr_total
                    ,'vlr_ipi'          : vlr_ipi
                    ,'vlr_frete'        : vlr_frete
                    ,'vlr_outros'       : vlr_outros
                    ,'nro_nf'           : nro_nf


                }
                grava(dados,route,type,origem);
            }
        })


            /**********************gravar colaborador **************************************************/
            $(document).on('submit', 'form#cadastro-colaborador', function(event){
            event.preventDefault()
            var route = $(this).find('input#route').val();
            var type = $(this).find('input#type').val();
            var origem = $(this).find('#origem').val();

            var colaborador         = $(this).find('input#colaborador').val();
            var setor               = $(this).find('input#setor').val();

                /********************************************************************************************* */
            if(!colaborador){
                Swal({
                    title: 'Preencha todos os campos obrigatório',
                    type: 'error',
                    timer:3000
                })
            }else{
                var dados= {
                    'colaborador'       : colaborador
                    ,'setor'            : setor

                }
                grava(dados,route,type,origem);
            }
        })

        /**********************gravar insumo **************************************************/
        $(document).on('submit', 'form#cadastro-insumo', function(event){
            event.preventDefault()
            var route = $(this).find('input#route').val();
            var type = $(this).find('input#type').val();
            var origem = $(this).find('#origem').val();

            var data                = $(this).find('input#data').val();
            var id_materiaprima     = $(this).find('select#id_materiaprima').val();
            var qtd                 = $(this).find('input#qtd').val();
            var os                  = $(this).find('input#os').val();

                /********************************************************************************************* */
            if(!data){
                Swal({
                    title: 'Preencha todos os campos obrigatório',
                    type: 'error',
                    timer:3000
                })
            }else{
                var dados= {
                    'data'              : data
                    ,'id_materiaprima'  : id_materiaprima
                    ,'qtd'              : qtd
                    ,'os'               : os

                }
                grava(dados,route,type,origem);
                // console.log(dados);
            }
        })

})
