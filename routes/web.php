<?php

use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Route;

use App\Http\Controllers\ProdutoController;
use App\Http\Controllers\ProdutoDetalheController;

use App\Http\Controllers\ClienteController;
use App\Http\Controllers\PedidoController;
use App\Http\Controllers\PedidoProdudoController;







/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/
/*
Route::get('/', function () {
    return 'seja bem vindo.';
});
*/

Route::get('/sobre-nos', [\App\Http\Controllers\SobreNosController::class, 'sobrenos'])->name('site.sobrenos');

Route::get('/contato', [\App\Http\Controllers\ContatoController::class,'contato'])->name('site.contato');
Route::post('/contato',[\App\Http\Controllers\ContatoController::class, 'salvar'])->name('site.contato');

Route::get('/', [\App\Http\controllers\PrincipalController::class,'principal'])->name('site.index');

Route::get('/login/{erro?}', [\App\Http\Controllers\LoginController::class, 'index'])->name('site.login');
// {erro?} recebe um parametro na rota, o que esta no redirect do controller, a interrogação indica que insirir o parametro é opcional, sem ela da erro
Route::post('/login', [\App\Http\Controllers\LoginController::class, 'autenticar'])->name('site.login');

//app
Route::middleware('autenticacao:padrao,visitante')->prefix('/app')->group(function(){
    Route::get('/home', [\App\Http\Controllers\HomeController::class, 'index'])->name('app.home');
    Route::get('/sair',[\App\Http\Controllers\LoginController::class, 'sair'])->name('app.sair'); //ja existe esse controller o LoginController

    Route::get('/fornecedor', [\App\Http\Controllers\FornecedorController::class, 'index'])->name('app.fornecedor');
    Route::get('/fornecedor/listar', [\App\Http\Controllers\FornecedorController::class, 'listar'])->name('app.fornecedor.listar');
    Route::post('/fornecedor/listar', [\App\Http\Controllers\FornecedorController::class, 'listar'])->name('app.fornecedor.listar');
                           //{id} obrigatório
    Route::get('/fornecedor/editar/{id}/{msg?}', [\App\Http\Controllers\FornecedorController::class, 'editar'])->name('app.fornecedor.editar');
    Route::get('/fornecedor/adicionar', [\App\Http\Controllers\FornecedorController::class, 'adicionar'])->name('app.fornecedor.adicionar');
    Route::post('/fornecedor/adicionar', [\App\Http\Controllers\FornecedorController::class, 'adicionar'])->name('app.fornecedor.adicionar');
    Route::get('/fornecedor/excluir/{id}', [\App\Http\Controllers\FornecedorController::class, 'excluir'])->name('app.fornecedor.excluir');
    
    
    Route::resource('produto', ProdutoController::class);
    Route::resource('produto-detalhe', ProdutoDetalheController::class);

    Route::resource('cliente', ClienteController::class);
    Route::resource('pedido', PedidoController::class);
    //Route::resource('pedido-produto', PedidoProdudoController::class);
    Route::get('pedido-produto/create/{pedido}', [\App\Http\Controllers\PedidoProdutoController::class, 'create'])->name('pedido-produto.create');
    Route::post('pedido-produto/store/{pedido}', [\App\Http\Controllers\PedidoProdutoController::class, 'store'])->name('pedido-produto.store');
    Route::delete('pedido-produto.destroy/{pedido}/{produto}', [\App\Http\Controllers\PedidoProdutoController::class, 'destroy'])->name('pedido-produto.destroy');
});


Route::get('/teste/{p1}/{p2}',[\App\Http\Controllers\TesteController::class, 'teste'])->name('teste');





Route::fallback(function(){
    echo 'A rota acessada não existe. <a href="'.route('site.index').'">aqui</a>. para ir a pagina inicial';
});

