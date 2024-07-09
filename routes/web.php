<?php

use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('index');
})->name('inicio');

Route::get('/contatos', [App\Http\Controllers\controllerAgenda::class, 'index'])->name('indexContatos');
Route::get('/contatos/novo', [App\Http\Controllers\controllerAgenda::class, 'create'])->name('novoContato');
Route::post('/contatos', [App\Http\Controllers\controllerAgenda::class, 'store'])->name('gravaNovoContato');
Route::get('/contatos/apagar/{id}', [App\Http\Controllers\controllerAgenda::class, 'destroy'])->name('deletaContato');
Route::get('/contatos/editar/{id}', [App\Http\Controllers\controllerAgenda::class, 'edit'])->name('editaContato');
Route::post('/contatos/{id}', [App\Http\Controllers\controllerAgenda::class, 'update'])->name('atualizaContato');
Route::get('/contatos/pesquisa', [App\Http\Controllers\controllerAgenda::class, 'pesquisarContato'])->name('pesquisarContato');
Route::get('/contatos/procurar', [App\Http\Controllers\controllerAgenda::class, 'procurarContato'])->name('procurarContato');