<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\AlunoController;
use App\Http\Controllers\SaebController;
use App\Http\Controllers\Auth\AlunoAuthController;
use App\Http\Controllers\Auth\AdminAuthController;
use App\Http\Controllers\ProtocolController;

/*
|--------------------------------------------------------------------------
| Rotas Públicas
|--------------------------------------------------------------------------
*/
Route::get('/', function () {
    return view('index');
})->name('home');

/* LOGIN ALUNO */
Route::get('/login/aluno', [AlunoAuthController::class, 'showLogin'])->name('aluno.login');
Route::post('/login/aluno', [AlunoAuthController::class, 'login'])->name('aluno.login.submit');

/* LOGIN ADMIN */
Route::get('/login/admin', [AdminAuthController::class, 'showLogin'])->name('admin.login');
Route::post('/login/admin', [AdminAuthController::class, 'login'])->name('admin.login.submit');

/* LOGOUT */
Route::post('/logout', function () {
    session()->flush();
    return redirect('/');
})->name('logout');


/*
|--------------------------------------------------------------------------
| Área do Aluno
|--------------------------------------------------------------------------
*/
Route::prefix('aluno')->group(function () {

    Route::get('/dashboard', [AlunoController::class, 'dashboard'])->name('aluno.dashboard');
    Route::get('/boletim', [AlunoController::class, 'boletim'])->name('aluno.boletim');
    Route::get('/saeb', [SaebController::class, 'alunoResultados'])->name('aluno.saeb');

    // Cronograma Acesso do Aluno
    Route::get('/cronograma', [AlunoController::class, 'cronograma'])->name('aluno.cronograma');
});


/*
|--------------------------------------------------------------------------
| Área do Gestor/Admin
|--------------------------------------------------------------------------
*/
Route::prefix('admin')->group(function () {

    Route::get('/dashboard', [AdminController::class, 'dashboard'])->name('admin.dashboard');


    /*
    |--------------------------------------------------------------------------
    | CRONOGRAMA (CRUD COMPLETO)
    |--------------------------------------------------------------------------
    */
    Route::get('/cronograma', [AdminController::class, 'cronograma'])->name('admin.cronograma');
    Route::post('/cronograma', [AdminController::class, 'storeCronograma'])->name('admin.cronograma.store');

    // *** Correções importantes ***
    Route::get('/cronograma/{id}/edit', [AdminController::class, 'cronogramaEdit'])
        ->name('admin.cronograma.edit');

    Route::put('/cronograma/{id}', [AdminController::class, 'cronogramaUpdate'])
        ->name('admin.cronograma.update');

    Route::delete('/cronograma/{id}', [AdminController::class, 'cronogramaDelete'])
        ->name('admin.cronograma.delete');


    /*
    |--------------------------------------------------------------------------
    | BOLETINS
    |--------------------------------------------------------------------------
    */
    Route::get('/boletins', [AdminController::class, 'boletins'])->name('admin.boletins');
    Route::post('/boletins', [AdminController::class, 'storeBoletim'])->name('admin.boletins.store');


    /*
    |--------------------------------------------------------------------------
    | USUÁRIOS
    |--------------------------------------------------------------------------
    */
    Route::get('/usuarios', [AdminController::class, 'usuarios'])->name('admin.usuarios');
    Route::post('/usuarios', [AdminController::class, 'storeUsuario'])->name('admin.usuarios.store');

    // Editar / Atualizar / Excluir usuário
    Route::get('/usuarios/{tipo}/{id}/edit', [AdminController::class, 'editUsuario'])
        ->name('admin.usuarios.edit');

    Route::put('/usuarios/{tipo}/{id}', [AdminController::class, 'updateUsuario'])
        ->name('admin.usuarios.update');

    Route::delete('/usuarios/{tipo}/{id}', [AdminController::class, 'deleteUsuario'])
        ->name('admin.usuarios.delete');


    /*
    |--------------------------------------------------------------------------
    | SAEB
    |--------------------------------------------------------------------------
    */
    Route::get('/saeb', [SaebController::class, 'index'])->name('admin.saeb');
    Route::post('/saeb/upload', [SaebController::class, 'upload'])->name('admin.saeb.upload');
    Route::post('/saeb/mapear', [SaebController::class, 'mapearAlunos'])->name('admin.saeb.mapear');
});

/* SAEB Protocolo */
Route::get('/admin/saeb/protocolo', [ProtocolController::class, 'protocolo'])
    ->name('admin.saeb.protocolo');

Route::post('/admin/saeb/publicar/{id}', [ProtocolController::class, 'publicar'])
    ->name('admin.saeb.publicar');
