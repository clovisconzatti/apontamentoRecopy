<?php

use App\Http\Controllers\Auth\usuarioController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\Menu\MenuController;
use App\Http\Controllers\produto\produtoController;
use App\Http\Controllers\cliente\clienteController;
use App\Http\Controllers\cadastroos\cadastroosController;
use App\Http\Controllers\materiaprima\materiaprimaController;
use App\Http\Controllers\apontamento\apontamentoController;
use Illuminate\Support\Facades\Auth;

Auth::routes();
Route::get('/', function () {
    return view('auth/login');
});

Route::group(['middleware' => ['auth']], function () {

    Route::get('/',[HomeController::class,'index'])->name('home');
    Route::get('/home', [HomeController::class, 'index']);


    Route::get('/',[HomeController::class,'index'])->name('home');
    Route::get('/home', [HomeController::class, 'index']);
    Route::get('/public', [HomeController::class, 'index']);

    /********************************** menu ***************************************************************/
    Route::group(['namespace' => 'menu'], function () {
        Route::get('menu',[MenuController::class,'listAllmenu'])->name('menu.listAll');
        Route::get('menu/novo',[MenuController::class,'formAddmenu'])->name('menu.formAddmenu');
        Route::get('menu/editar/{menu}',[MenuController::class,'formEditmenu'])->name('menu.formEditmenu');
        Route::post('menu/store',[MenuController::class,'stroremenu'])->name('menu.store');
        Route::patch('menu/edit/{menu}',[MenuController::class,'edit'])->name('menu.edit');
        Route::delete('menu/destroy/{menu}',[MenuController::class,'destroy'])->name('menu.destroy');

        Route::get('menu/menuUsuario',[MenuController::class,'menuUsuario'])->name('menu.menuUsuario');
        Route::post('menu/disponivel',[MenuController::class,'disponivel'])->name('menu.disponivel');
        Route::post('menu/menuLiberado',[MenuController::class,'menuLiberado'])->name('menu.menuLiberado');

        Route::post('menu/addMenuUsuario',[MenuController::class,'addMenuUsuario'])->name('menu.addMenuUsuario');
        Route::post('menu/removeMenuUsuario',[MenuController::class,'removeMenuUsuario'])->name('menu.removeMenuUsuario');


    });

        /********************************** usuario ***************************************************************/
        Route::group(['namespace' => 'usuario'], function () {
            Route::post('usuario/updateSenha',[usuarioController::class,'updateSenha'])->name('usuario.updateSenha');
        });

        /********************************** produto ***************************************************************/
    Route::group(['namespace' => 'produto'], function () {
        Route::get('produto',[produtoController::class,'listAll'])->name('produto.listAll');
        Route::get('produto/novo',[produtoController::class,'formadd'])->name('produto.add');
        Route::get('produto/editar/{produto}',[produtoController::class,'formEdit'])->name('produto.formEdit');
        Route::post('produto/store',[produtoController::class,'strore'])->name('produto.store');
        Route::patch('produto/edit/{produto}',[produtoController::class,'edit'])->name('produto.edit');
        Route::delete('produto/destroy/{produto}',[produtoController::class,'destroy'])->name('produto.destroy');
    });

    /********************************** cliente ***************************************************************/
    Route::group(['namespace' => 'cliente'], function () {
        Route::get('cliente',[clienteController::class,'listAll'])->name('cliente.listAll');
        Route::get('cliente/novo',[clienteController::class,'formadd'])->name('cliente.add');
        Route::get('cliente/editar/{cliente}',[clienteController::class,'formEdit'])->name('cliente.formEdit');
        Route::post('cliente/store',[clienteController::class,'strore'])->name('cliente.store');
        Route::patch('cliente/edit/{cliente}',[clienteController::class,'edit'])->name('cliente.edit');
        Route::delete('cliente/destroy/{cliente}',[clienteController::class,'destroy'])->name('cliente.destroy');
    });

    /********************************** cadastro os ***************************************************************/
    Route::group(['namespace' => 'cadastroos'], function () {
        Route::get('cadastroos',[cadastroosController::class,'listAll'])->name('cadastroos.listAll');
        Route::get('cadastroos/novo',[cadastroosController::class,'formadd'])->name('cadastroos.add');
        Route::get('cadastroos/editar/{cadastroos}',[cadastroosController::class,'formEdit'])->name('cadastroos.formEdit');
        Route::post('cadastroos/store',[cadastroosController::class,'strore'])->name('cadastroos.store');
        Route::patch('cadastroos/edit/{cadastroos}',[cadastroosController::class,'edit'])->name('cadastroos.edit');
        Route::delete('cadastroos/destroy/{cadastroos}',[cadastroosController::class,'destroy'])->name('cadastroos.destroy');
    });

    /********************************** materia prima ***************************************************************/
    Route::group(['namespace' => 'materiaprima'], function () {
        Route::get('materiaprima',[materiaprimaController::class,'listAll'])->name('materiaprima.listAll');
        Route::get('materiaprima/novo',[materiaprimaController::class,'formadd'])->name('materiaprima.add');
        Route::get('materiaprima/editar/{materiaprima}',[materiaprimaController::class,'formEdit'])->name('materiaprima.formEdit');
        Route::post('materiaprima/store',[materiaprimaController::class,'strore'])->name('materiaprima.store');
        Route::patch('materiaprima/edit/{materiaprima}',[materiaprimaController::class,'edit'])->name('materiaprima.edit');
        Route::delete('materiaprima/destroy/{materiaprima}',[materiaprimaController::class,'destroy'])->name('materiaprima.destroy');
});

/********************************** apontamento ***************************************************************/
Route::group(['namespace' => 'apontamento'], function () {
    Route::get('apontamento',[apontamentoController::class,'listAll'])->name('apontamento.listAll');
    Route::get('apontamento/novo',[apontamentoController::class,'formadd'])->name('apontamento.add');
    Route::get('apontamento/editar/{apontamento}',[apontamentoController::class,'formEdit'])->name('apontamento.formEdit');
    Route::post('apontamento/store',[apontamentoController::class,'strore'])->name('apontamento.store');
    Route::patch('apontamento/edit/{apontamento}',[apontamentoController::class,'edit'])->name('apontamento.edit');
    Route::delete('apontamento/destroy/{apontamento}',[apontamentoController::class,'destroy'])->name('apontamento.destroy');
});

});
