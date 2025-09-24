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

// Login Aluno
Route::get('/login/aluno', [AlunoAuthController::class, 'showLogin'])->name('aluno.login');
Route::post('/login/aluno', [AlunoAuthController::class, 'login'])->name('aluno.login.submit');

// Login Admin
Route::get('/login/admin', [AdminAuthController::class, 'showLogin'])->name('admin.login');
Route::post('/login/admin', [AdminAuthController::class, 'login'])->name('admin.login.submit');

// Logout (aluno e admin)
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
});

/*
|--------------------------------------------------------------------------
| Área do Gestor/Admin
|--------------------------------------------------------------------------
*/
Route::prefix('admin')->group(function () {
    Route::get('/dashboard', [AdminController::class, 'dashboard'])->name('admin.dashboard');

    // Cronograma
    Route::get('/cronograma', [AdminController::class, 'cronograma'])->name('admin.cronograma');
    Route::post('/cronograma', [AdminController::class, 'storeCronograma'])->name('admin.cronograma.store');

    // Boletins
    Route::get('/boletins', [AdminController::class, 'boletins'])->name('admin.boletins');
    Route::post('/boletins', [AdminController::class, 'storeBoletim'])->name('admin.boletins.store');

    // Usuários (listar + criar)
    Route::get('/usuarios', [AdminController::class, 'usuarios'])->name('admin.usuarios');
    Route::post('/usuarios', [AdminController::class, 'storeUsuario'])->name('admin.usuarios.store');

    // Usuários (editar/excluir)
    Route::get('/usuarios/{tipo}/{id}/edit', [AdminController::class, 'editUsuario'])->name('admin.usuarios.edit');
    Route::put('/usuarios/{tipo}/{id}', [AdminController::class, 'updateUsuario'])->name('admin.usuarios.update');
    Route::delete('/usuarios/{tipo}/{id}', [AdminController::class, 'deleteUsuario'])->name('admin.usuarios.delete');

    // Alunos (CRUD direto — opcional)
    Route::get('/alunos/create', [AdminController::class, 'createAluno'])->name('admin.alunos.create');
    Route::post('/alunos', [AdminController::class, 'storeAluno'])->name('admin.alunos.store');

    // SAEB
    Route::get('/saeb', [SaebController::class, 'index'])->name('admin.saeb');
    Route::post('/saeb/upload', [SaebController::class, 'upload'])->name('admin.saeb.upload');
    Route::post('/saeb/mapear', [SaebController::class, 'mapearAlunos'])->name('admin.saeb.mapear');

});
Route::get('/admin/saeb/protocolo', [ProtocolController::class, 'protocolo'])->name('admin.saeb.protocolo');
Route::post('/admin/saeb/publicar/{id}', [ProtocolController::class, 'publicar'])->name('admin.saeb.publicar');
