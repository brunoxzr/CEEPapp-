<?php

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Controllers
|--------------------------------------------------------------------------
*/
use App\Http\Controllers\PortalController;
use App\Http\Controllers\NewsController;
use App\Http\Controllers\CourseController;

use App\Http\Controllers\Auth\AlunoAuthController;
use App\Http\Controllers\Auth\AdminAuthController;
use App\Http\Controllers\Auth\UnifiedLoginController;

use App\Http\Controllers\AlunoController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\AdminNewsController;
use App\Http\Controllers\SaebController;
use App\Http\Controllers\ProtocolController;

/*
|--------------------------------------------------------------------------
| ROTAS PÚBLICAS – PORTAL
|--------------------------------------------------------------------------
*/
Route::get('/', [PortalController::class, 'index'])->name('home');

/* Cursos */
Route::get('/cursos', fn () => view('cursos.index'))->name('portal.courses');
Route::get('/cursos/desenvolvimento-de-sistemas', fn () => view('cursos.desenvolvimento'));
Route::get('/cursos/enfermagem', fn () => view('cursos.enfermagem'));
Route::get('/cursos/mecanica-industrial', fn () => view('cursos.mecanica'));
Route::get('/cursos/eletrotecnica', fn () => view('cursos.eletrotecnica'));
Route::get('/cursos/edificacoes', fn () => view('cursos.edificacoes'));
Route::get('/cursos/agropecuaria', fn () => view('cursos.agropecuaria'));

/* Notícias públicas */
Route::get('/noticias', [NewsController::class, 'index'])
    ->name('portal.news.index');

Route::get('/noticias/{slug}', [NewsController::class, 'show'])
    ->name('portal.news.show');

/*
|--------------------------------------------------------------------------
| LOGIN UNIFICADO – ÁREA ACADÊMICA
|--------------------------------------------------------------------------
*/
Route::get('/area-academica', [UnifiedLoginController::class, 'show'])
    ->name('login.unificado');

Route::post('/area-academica', [UnifiedLoginController::class, 'login'])
    ->name('login.unificado.submit');

/*
|--------------------------------------------------------------------------
| LOGIN SEPARADO (se quiser manter)
|--------------------------------------------------------------------------
*/
Route::get('/login/aluno', [AlunoAuthController::class, 'showLogin'])
    ->name('aluno.login');

Route::post('/login/aluno', [AlunoAuthController::class, 'login'])
    ->name('aluno.login.submit');

Route::get('/login/admin', [AdminAuthController::class, 'showLogin'])
    ->name('admin.login');

Route::post('/login/admin', [AdminAuthController::class, 'login'])
    ->name('admin.login.submit');

/*
|--------------------------------------------------------------------------
| LOGOUT
|--------------------------------------------------------------------------
*/
Route::post('/logout', function () {
    session()->flush();
    return redirect('/');
})->name('logout');

/*
|--------------------------------------------------------------------------
| ÁREA DO ALUNO
|--------------------------------------------------------------------------
*/
Route::prefix('aluno')->group(function () {

    Route::get('/dashboard', [AlunoController::class, 'dashboard'])
        ->name('aluno.dashboard');

    Route::get('/boletim', [AlunoController::class, 'boletim'])
        ->name('aluno.boletim');

    Route::get('/saeb', [SaebController::class, 'alunoResultados'])
        ->name('aluno.saeb');

    Route::get('/cronograma', [AlunoController::class, 'cronograma'])
        ->name('aluno.cronograma');
});

/*
|--------------------------------------------------------------------------
| ÁREA ADMIN / GESTOR
|--------------------------------------------------------------------------
*/
Route::prefix('admin')->group(function () {

    Route::get('/dashboard', [AdminController::class, 'dashboard'])
        ->name('admin.dashboard');

    /*
    |-------------------------
    | NOTÍCIAS (ADMIN)
    |-------------------------
    */
    Route::get('/noticias', [AdminNewsController::class, 'index'])
        ->name('admin.news.index');

    Route::get('/noticias/criar', [AdminNewsController::class, 'create'])
        ->name('admin.news.create');

    Route::post('/noticias', [AdminNewsController::class, 'store'])
        ->name('admin.news.store');

    Route::get('/noticias/{id}/editar', [AdminNewsController::class, 'edit'])
        ->name('admin.news.edit');

    Route::put('/noticias/{id}', [AdminNewsController::class, 'update'])
        ->name('admin.news.update');

    Route::delete('/noticias/{id}', [AdminNewsController::class, 'destroy'])
        ->name('admin.news.destroy');

    Route::post('/noticias/upload-imagem', [AdminNewsController::class, 'uploadImage'])
        ->name('admin.news.upload');

    /*
    |-------------------------
    | CRONOGRAMA
    |-------------------------
    */
    Route::get('/cronograma', [AdminController::class, 'cronograma'])
        ->name('admin.cronograma');

    Route::post('/cronograma', [AdminController::class, 'storeCronograma'])
        ->name('admin.cronograma.store');

    Route::get('/cronograma/{id}/edit', [AdminController::class, 'cronogramaEdit'])
        ->name('admin.cronograma.edit');

    Route::put('/cronograma/{id}', [AdminController::class, 'cronogramaUpdate'])
        ->name('admin.cronograma.update');

    Route::delete('/cronograma/{id}', [AdminController::class, 'cronogramaDelete'])
        ->name('admin.cronograma.delete');

    /*
    |-------------------------
    | BOLETINS
    |-------------------------
    */
    Route::get('/boletins', [AdminController::class, 'boletins'])
        ->name('admin.boletins');

    Route::post('/boletins', [AdminController::class, 'storeBoletim'])
        ->name('admin.boletins.store');

    /*
    |-------------------------
    | USUÁRIOS
    |-------------------------
    */
    Route::get('/usuarios', [AdminController::class, 'usuarios'])
        ->name('admin.usuarios');

    Route::post('/usuarios', [AdminController::class, 'storeUsuario'])
        ->name('admin.usuarios.store');

    Route::get('/usuarios/{tipo}/{id}/edit', [AdminController::class, 'editUsuario'])
        ->name('admin.usuarios.edit');

    Route::put('/usuarios/{tipo}/{id}', [AdminController::class, 'updateUsuario'])
        ->name('admin.usuarios.update');

    Route::delete('/usuarios/{tipo}/{id}', [AdminController::class, 'deleteUsuario'])
        ->name('admin.usuarios.delete');

    /*
    |-------------------------
    | SAEB
    |-------------------------
    */
    Route::get('/saeb', [SaebController::class, 'index'])
        ->name('admin.saeb');

    Route::post('/saeb/upload', [SaebController::class, 'upload'])
        ->name('admin.saeb.upload');

    Route::post('/saeb/mapear', [SaebController::class, 'mapearAlunos'])
        ->name('admin.saeb.mapear');

    Route::get('/saeb/protocolo', [ProtocolController::class, 'protocolo'])
        ->name('admin.saeb.protocolo');

    Route::post('/saeb/publicar/{id}', [ProtocolController::class, 'publicar'])
        ->name('admin.saeb.publicar');
});
