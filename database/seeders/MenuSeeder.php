<?php

namespace Database\Seeders;

use App\Models\menu;
use Illuminate\Database\Seeder;

class MenuSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        menu::truncate();
        $menus=[
            [
                'ordem'         =>'01.000'
                , 'descricao'   =>'Cadastro'
                , 'tipo'        =>'Título'
                , 'rota'        =>''
                , 'icone'       =>''
            ],
            [
                'ordem'         =>'01.001'
                , 'descricao'   =>'Produto'
                , 'tipo'        =>'Link'
                , 'rota'        =>'produto.listAll'
                , 'icone'       =>'fas fa-cubes'
            ],
            [
                'ordem'         =>'01.002'
                , 'descricao'   =>'Matéria Prima'
                , 'tipo'        =>'Link'
                , 'rota'        =>'materiaprima.listAll'
                , 'icone'       =>'fas fa-boxes'
            ],
            [
                'ordem'         =>'01.003'
                , 'descricao'   =>'Cliente'
                , 'tipo'        =>'Link'
                , 'rota'        =>'cliente.listAll'
                , 'icone'       =>'far fa-address-cardc'
            ],
            [
                'ordem'         =>'01.004'
                , 'descricao'   =>'Colaborador'
                , 'tipo'        =>'Link'
                , 'rota'        =>'colaborador.listAll'
                , 'icone'       =>'fas fa-users'
            ],

            [
                'ordem'         =>'02.000'
                , 'descricao'   =>'Movimentos'
                , 'tipo'        =>'Título'
                , 'rota'        =>''
                , 'icone'       =>''
            ],
            [
                'ordem'         =>'02.001'
                , 'descricao'   =>'Entrada MP'
                , 'tipo'        =>'Link'
                , 'rota'        =>'entradamp.listAll'
                , 'icone'       =>'fas fa-book'
            ],
            [
                'ordem'         =>'02.002'
                , 'descricao'   =>'Cadastro OS'
                , 'tipo'        =>'Link'
                , 'rota'        =>'cadastroos.listAll'
                , 'icone'       =>'fas fa-book'
            ],
            [
                'ordem'         =>'02.003'
                , 'descricao'   =>'Insumos'
                , 'tipo'        =>'Link'
                , 'rota'        =>'insumo.listAll'
                , 'icone'       =>'fas fa-paperclip'
            ],
            [
                'ordem'         =>'03.000'
                , 'descricao'   =>'Apontamentos'
                , 'tipo'        =>'Título'
                , 'rota'        =>''
                , 'icone'       =>''
            ],
            [
            'ordem'         =>'03.001'
            , 'descricao'   =>'Horas'
            , 'tipo'        =>'Link'
            , 'rota'        =>'apontamento.listAll'
            , 'icone'       =>'far fa-clipboard'
            ],
        ];
        menu::insert($menus);
    }

}
