<?php

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Controllers
|--------------------------------------------------------------------------
*/

// Portal / Público
use App\Http\Controllers\PortalController;
use App\Http\Controllers\NewsController;
use App\Http\Controllers\ProjetoPublicoController;

// Auth
use App\Http\Controllers\Auth\AlunoAuthController;
use App\Http\Controllers\Auth\AdminAuthController;
use App\Http\Controllers\Auth\UnifiedLoginController;

// Aluno
use App\Http\Controllers\AlunoController;
use App\Http\Controllers\SaebController;

// Admin / Gestão
use App\Http\Controllers\AdminController;
use App\Http\Controllers\AdminNewsController;
use App\Http\Controllers\ProtocolController;
use App\Http\Controllers\AdminDiretorController;
use App\Http\Controllers\ProfessorProjetoController;
use App\Http\Controllers\ProfessorRestricaoController;
use App\Http\Controllers\ComunicadoController;
use App\Http\Controllers\CalendarioController;

/*
|--------------------------------------------------------------------------
| ROTAS PÚBLICAS — PORTAL
|--------------------------------------------------------------------------
*/

Route::get('/', [PortalController::class, 'index'])->name('home');
Route::view('/contato', 'portal.contato')->name('portal.contato');

// Institucional
Route::get('/institucional', [PortalController::class, 'institucional'])
    ->name('portal.institucional');
Route::get('/institucional/{slug}', [PortalController::class, 'institucionalShow'])
    ->name('portal.institucional.show');

// Cursos
Route::get('/cursos', fn () => view('cursos.index'))->name('portal.courses');
Route::view('/cursos/desenvolvimento-de-sistemas', 'cursos.desenvolvimento');
Route::view('/cursos/enfermagem', 'cursos.enfermagem');
Route::view('/cursos/mecanica-industrial', 'cursos.mecanica');
Route::view('/cursos/eletrotecnica', 'cursos.eletrotecnica');
Route::view('/cursos/edificacoes', 'cursos.edificacoes');
Route::view('/cursos/agropecuaria', 'cursos.agropecuaria');

// Notícias
Route::get('/noticias', [NewsController::class, 'index'])->name('portal.news.index');
Route::get('/noticias/{slug}', [NewsController::class, 'show'])->name('portal.news.show');

// Projetos Técnicos
Route::get('/projetos', [ProjetoPublicoController::class, 'index'])->name('projetos.index');
Route::get('/projetos/{id}', [ProjetoPublicoController::class, 'show'])->name('projetos.show');

/*
|--------------------------------------------------------------------------
| AUTENTICAÇÃO
|--------------------------------------------------------------------------
*/

// Login Unificado
Route::get('/area-academica', [UnifiedLoginController::class, 'show'])->name('login.unificado');
Route::post('/area-academica', [UnifiedLoginController::class, 'login'])->name('login.unificado.submit');

// Login Separado (Backup)
Route::get('/login/aluno', [AlunoAuthController::class, 'showLogin'])->name('aluno.login');
Route::post('/login/aluno', [AlunoAuthController::class, 'login'])->name('aluno.login.submit');
Route::get('/login/admin', [AdminAuthController::class, 'showLogin'])->name('admin.login');
Route::post('/login/admin', [AdminAuthController::class, 'login'])->name('admin.login.submit');

// Logout
Route::post('/logout', function () {
    session()->flush();
    return redirect('/');
})->name('logout');

/*
|--------------------------------------------------------------------------
| ÁREA DO ALUNO
|--------------------------------------------------------------------------
*/

Route::prefix('aluno')
    ->middleware(['web', 'aluno'])
    ->group(function () {
        Route::get('/dashboard', [AlunoController::class, 'dashboard'])->name('aluno.dashboard');
        Route::get('/boletim', [AlunoController::class, 'boletim'])->name('aluno.boletim');
        Route::get('/saeb', [SaebController::class, 'alunoResultados'])->name('aluno.saeb');
        Route::get('/cronograma', [AlunoController::class, 'cronograma'])->name('aluno.cronograma');
        Route::get('/calendario', [CalendarioController::class, 'indexAluno'])->name('aluno.calendario.index');
        Route::get('/comunicados', [ComunicadoController::class, 'indexAluno'])->name('aluno.comunicados.index');
    });

/*
|--------------------------------------------------------------------------
| ÁREA DO PROFESSOR
|--------------------------------------------------------------------------
*/

Route::prefix('professor')
    ->middleware(['web', 'professor'])
    ->group(function () {
        Route::get('/dashboard', [AdminController::class, 'dashboardProfessor'])->name('professor.dashboard');
        Route::get('/cronograma', [AdminController::class, 'cronogramaProfessor'])->name('professor.cronograma');
        Route::get('/projetos', [ProfessorProjetoController::class, 'index'])->name('professor.projetos.index');
        Route::get('/projetos/create', [ProfessorProjetoController::class, 'create'])->name('professor.projetos.create');
        Route::post('/projetos', [ProfessorProjetoController::class, 'store'])->name('professor.projetos.store');
        Route::get('/projetos/{id}/edit', [ProfessorProjetoController::class, 'edit'])->name('professor.projetos.edit');
        Route::put('/projetos/{id}', [ProfessorProjetoController::class, 'update'])->name('professor.projetos.update');
    });

/*
|--------------------------------------------------------------------------
| ÁREA ADMIN / GESTÃO
|--------------------------------------------------------------------------
*/

Route::prefix('admin')
    ->middleware(['web', 'admin'])
    ->group(function () {

        /*
        |----------------------------------------------------------------------
        | Dashboard
        |----------------------------------------------------------------------
        */
        Route::get('/dashboard', [AdminController::class, 'dashboard'])->name('admin.dashboard');
        Route::get('/diretor/dashboard', [AdminController::class, 'dashboard'])->name('admin.diretor.dashboard');

        /*
        |----------------------------------------------------------------------
        | Notícias
        |----------------------------------------------------------------------
        */
        Route::middleware('permissao:publicar_noticias')->group(function () {
            Route::get('/noticias', [AdminNewsController::class, 'index'])->name('admin.news.index');
            Route::get('/noticias/criar', [AdminNewsController::class, 'create'])->name('admin.news.create');
            Route::post('/noticias', [AdminNewsController::class, 'store'])->name('admin.news.store');
            Route::get('/noticias/{id}/editar', [AdminNewsController::class, 'edit'])->name('admin.news.edit');
            Route::put('/noticias/{id}', [AdminNewsController::class, 'update'])->name('admin.news.update');
            Route::delete('/noticias/{id}', [AdminNewsController::class, 'destroy'])->name('admin.news.destroy');
            Route::post('/noticias/upload-imagem', [AdminNewsController::class, 'uploadImage'])->name('admin.news.upload');
        });

        /*
        |----------------------------------------------------------------------
        | Institucional
        |----------------------------------------------------------------------
        */
        Route::middleware('permissao:gerenciar_usuarios')->group(function () {
            Route::get('/institucional', [AdminController::class, 'institucionalIndex'])->name('admin.institucional.index');
            Route::get('/institucional/criar', [AdminController::class, 'institucionalCreate'])->name('admin.institucional.create');
            Route::post('/institucional', [AdminController::class, 'institucionalStore'])->name('admin.institucional.store');
            Route::get('/institucional/{id}/editar', [AdminController::class, 'institucionalEdit'])->name('admin.institucional.edit');
            Route::put('/institucional/{id}', [AdminController::class, 'institucionalUpdate'])->name('admin.institucional.update');
            Route::delete('/institucional/{id}', [AdminController::class, 'institucionalDestroy'])->name('admin.institucional.destroy');
        });

        /*
        |----------------------------------------------------------------------
        | Cronograma
        |----------------------------------------------------------------------
        */
        Route::middleware('permissao:gerenciar_cronograma')->group(function () {
            Route::get('/cronograma', [AdminController::class, 'cronogramaIndex'])->name('admin.cronograma.index');
            Route::post('/cronograma/gerar', [AdminController::class, 'gerarCronograma'])->name('admin.cronograma.gerar');
            Route::post('/cronograma/salvar', [AdminController::class, 'salvarCronograma'])->name('admin.cronograma.salvar');
            Route::post('/cronograma/drag-save', [AdminController::class, 'cronogramaDragSave'])->name('admin.cronograma.dragSave');
            Route::delete('/cronograma/drag-delete', [AdminController::class, 'cronogramaDragDelete'])->name('admin.cronograma.dragDelete');
            Route::delete('/cronograma/apagar-tudo', [AdminController::class, 'cronogramaApagarTudo'])->name('admin.cronograma.apagarTudo');
        });

        /*
        |----------------------------------------------------------------------
        | Disciplinas
        |----------------------------------------------------------------------
        */
        Route::middleware('permissao:gerenciar_cronograma')->group(function () {
            Route::get('/disciplinas', [AdminController::class, 'disciplinasIndex'])->name('admin.disciplinas.index');
            Route::get('/disciplinas/create', [AdminController::class, 'disciplinasCreate'])->name('admin.disciplinas.create');
            Route::post('/disciplinas', [AdminController::class, 'disciplinasStore'])->name('admin.disciplinas.store');
            Route::get('/disciplinas/{id}/edit', [AdminController::class, 'disciplinasEdit'])->name('admin.disciplinas.edit');
            Route::put('/disciplinas/{id}', [AdminController::class, 'disciplinasUpdate'])->name('admin.disciplinas.update');
            Route::delete('/disciplinas/{id}', [AdminController::class, 'disciplinasDelete'])->name('admin.disciplinas.delete');
        });

        /*
        |----------------------------------------------------------------------
        | Calendário
        |----------------------------------------------------------------------
        */
        Route::get('/calendario', [CalendarioController::class, 'indexAdmin'])->name('admin.calendario.index');
        Route::get('/calendario/create', [CalendarioController::class, 'create'])->name('admin.calendario.create');
        Route::post('/calendario', [CalendarioController::class, 'store'])->name('admin.calendario.store');
        Route::get('/calendario/{id}/edit', [CalendarioController::class, 'edit'])->name('admin.calendario.edit');
        Route::put('/calendario/{id}', [CalendarioController::class, 'update'])->name('admin.calendario.update');
        Route::delete('/calendario/{id}', [CalendarioController::class, 'destroy'])->name('admin.calendario.destroy');

        /*
        |----------------------------------------------------------------------
        | Comunicados
        |----------------------------------------------------------------------
        */
        Route::get('/comunicados', [ComunicadoController::class, 'indexAdmin'])->name('admin.comunicados.index');
        Route::get('/comunicados/create', [ComunicadoController::class, 'create'])->name('admin.comunicados.create');
        Route::post('/comunicados', [ComunicadoController::class, 'store'])->name('admin.comunicados.store');
        Route::get('/comunicados/{id}/edit', [ComunicadoController::class, 'edit'])->name('admin.comunicados.edit');
        Route::put('/comunicados/{id}', [ComunicadoController::class, 'update'])->name('admin.comunicados.update');
        Route::delete('/comunicados/{id}', [ComunicadoController::class, 'destroy'])->name('admin.comunicados.destroy');

        /*
        |----------------------------------------------------------------------
        | Restrições
        |----------------------------------------------------------------------
        */
        Route::get('/restricoes', [ProfessorRestricaoController::class, 'index'])->name('admin.restricoes');
        Route::post('/restricoes', [ProfessorRestricaoController::class, 'store'])->name('admin.restricoes.store');
        Route::delete('/restricoes/{id}', [ProfessorRestricaoController::class, 'destroy'])->name('admin.restricoes.delete');

        /*
        |----------------------------------------------------------------------
        | Boletins / Relatórios
        |----------------------------------------------------------------------
        */
        Route::middleware('permissao:ver_relatorios')->group(function () {
            Route::get('/boletins', [AdminController::class, 'boletins'])->name('admin.boletins');
            Route::post('/boletins', [AdminController::class, 'storeBoletim'])->name('admin.boletins.store');
        });

        /*
        |----------------------------------------------------------------------
        | SAEB
        |----------------------------------------------------------------------
        */
        Route::middleware('permissao:ver_relatorios')->group(function () {
            Route::get('/saeb', [SaebController::class, 'index'])->name('admin.saeb');
            Route::post('/saeb/upload', [SaebController::class, 'upload'])->name('admin.saeb.upload');
            Route::post('/saeb/mapear', [SaebController::class, 'mapearAlunos'])->name('admin.saeb.mapear');
            Route::get('/saeb/protocolo', [ProtocolController::class, 'protocolo'])->name('admin.saeb.protocolo');
            Route::post('/saeb/publicar/{id}', [ProtocolController::class, 'publicar'])->name('admin.saeb.publicar');
        });

        /*
        |----------------------------------------------------------------------
        | Usuários
        |----------------------------------------------------------------------
        */
        Route::middleware('permissao:gerenciar_usuarios')->group(function () {
            Route::get('/usuarios', [AdminController::class, 'usuarios'])->name('admin.usuarios');
            Route::post('/usuarios', [AdminController::class, 'storeUsuario'])->name('admin.usuarios.store');
            Route::get('/usuarios/{tipo}/{id}/edit', [AdminController::class, 'editUsuario'])->name('admin.usuarios.edit');
            Route::put('/usuarios/{tipo}/{id}', [AdminController::class, 'updateUsuario'])->name('admin.usuarios.update');
            Route::delete('/usuarios/{tipo}/{id}', [AdminController::class, 'deleteUsuario'])->name('admin.usuarios.delete');
        });

        /*
        |----------------------------------------------------------------------
        | Professores
        |----------------------------------------------------------------------
        */
        Route::get('/professores', [AdminController::class, 'professoresIndex'])->name('admin.professores');
        Route::get('/professores/create', [AdminController::class, 'createProfessor'])->name('admin.professores.create');
        Route::post('/professores', [AdminController::class, 'storeProfessor'])->name('admin.professores.store');
        Route::get('/professores/{id}/edit', [AdminController::class, 'editarProfessor'])->name('admin.professores.edit');
        Route::post('/professores/{id}/salvar', [AdminController::class, 'salvarProfessor'])->name('admin.professores.salvar');
        Route::delete('/professores/{tipo}/{id}', [AdminController::class, 'deleteUsuario'])->name('admin.professores.delete');

        /*
        |----------------------------------------------------------------------
        | Projetos
        |----------------------------------------------------------------------
        */
        Route::get('/projetos', [AdminController::class, 'projetosIndex'])->name('admin.projetos');

        /*
        |----------------------------------------------------------------------
        | Permissões (Diretor)
        |----------------------------------------------------------------------
        */
        Route::middleware('permissao:gerenciar_usuarios')->group(function () {
            Route::post('/diretor/permissoes/{id}', [AdminDiretorController::class, 'syncPermissoes'])->name('admin.diretor.permissoes');
        });
    });
