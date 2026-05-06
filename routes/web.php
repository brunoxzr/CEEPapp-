<?php

use App\Http\Controllers\Admin\AdminController;
use App\Http\Controllers\Admin\AdminDiretorController;
use App\Http\Controllers\Admin\AdminNewsController;
use App\Http\Controllers\Admin\PremioAdminController;
use App\Http\Controllers\Aluno\AlunoAtividadeController;
use App\Http\Controllers\Aluno\AlunoController;
use App\Http\Controllers\Aluno\AlunoPasswordResetController;
use App\Http\Controllers\Aluno\AlunoPerfilController;
use App\Http\Controllers\Auth\AdminAuthController;
use App\Http\Controllers\Auth\AlunoAuthController;
use App\Http\Controllers\Auth\UnifiedLoginController;
use App\Http\Controllers\CalendarioController;
use App\Http\Controllers\ComunicadoController;
use App\Http\Controllers\Auth\PasswordResetUnificadoController;
use App\Http\Controllers\Portal\AlunoPublicController;
use App\Http\Controllers\Portal\AprovadoController;
use App\Http\Controllers\Portal\HubRHController;
use App\Http\Controllers\Portal\NewsController;
use App\Http\Controllers\Portal\NewsSitemapController;
use App\Http\Controllers\Portal\PortalController;
use App\Http\Controllers\Portal\PremioController;
use App\Http\Controllers\Portal\ProjetoPublicoController;
use App\Http\Controllers\Portal\SitemapAlunosController;
use App\Http\Controllers\Portal\SitemapController;
use App\Http\Controllers\Portal\SitemapPremiosController;
use App\Http\Controllers\Professor\ProfessorAtividadeController;
use App\Http\Controllers\Professor\ProfessorProjetoController;
use App\Http\Controllers\Professor\ProfessorRestricaoController;
use App\Http\Controllers\ProtocolController;
use App\Http\Controllers\SaebController;
use App\Http\Controllers\SmartAgroController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Public portal
|--------------------------------------------------------------------------
*/

Route::get('/', [PortalController::class, 'index'])->name('home');
Route::view('/contato', 'portal.contato')->name('portal.contato');

Route::prefix('legal')->group(function () {
    Route::view('/privacidade', 'legal.privacidade')->name('legal.privacidade');
    Route::view('/termos', 'legal.termos')->name('legal.termos');
    Route::view('/acessibilidade', 'legal.acessibilidade')->name('legal.acessibilidade');
});

Route::get('/institucional', [PortalController::class, 'institucional'])->name('portal.institucional');
Route::get('/institucional/{slug}', [PortalController::class, 'institucionalShow'])->name('portal.institucional.show');

Route::view('/cursos', 'cursos.index')->name('portal.courses');
Route::prefix('cursos')->group(function () {
    Route::view('/desenvolvimento-de-sistemas', 'cursos.desenvolvimento')->name('cursos.desenvolvimento');
    Route::view('/enfermagem', 'cursos.enfermagem')->name('cursos.enfermagem');
    Route::view('/mecanica-industrial', 'cursos.mecanica-industrial')->name('cursos.mecanica-industrial');
    Route::view('/eletrotecnica', 'cursos.eletrotecnica')->name('cursos.eletrotecnica');
    Route::view('/edificacoes', 'cursos.edificacoes')->name('cursos.edificacoes');
    Route::view('/agronegocio', 'cursos.agronegocio')->name('cursos.agronegocio');
    Route::view('/administracao', 'cursos.administracao')->name('cursos.administracao');
    Route::view('/inteligencia-artificial-dados', 'cursos.inteligencia-artificial-dados')->name('cursos.ia-dados');
    Route::view('/seguranca-do-trabalho', 'cursos.seguranca-do-trabalho')->name('cursos.seguranca');
});

Route::get('/noticias', [NewsController::class, 'index'])->name('portal.news.index');
Route::get('/noticias/{slug}', [NewsController::class, 'show'])->name('portal.news.show');

Route::get('/projetos', [ProjetoPublicoController::class, 'index'])->name('projetos.index');
Route::get('/projetos/{id}', [ProjetoPublicoController::class, 'show'])->name('projetos.show');

Route::get('/aprovados', [AprovadoController::class, 'index'])->name('portal.aprovados.index');
Route::get('/premios-e-reconhecimentos', [PremioController::class, 'index'])->name('portal.premios');
Route::get('/premios/{premio}', [PremioController::class, 'show'])->name('portal.premios.show');
Route::get('/perfil/aluno/{slug}', [AlunoPublicController::class, 'show'])->name('aluno.public');
Route::get('/hub-rh', [HubRHController::class, 'index'])->name('hub-rh.index');

Route::get('/selecionados', [SmartAgroController::class, 'selecionados'])->name('smartagro.selecionados');
Route::get('/inscricoes', [SmartAgroController::class, 'index'])->name('smartagro.inscricoes');
Route::post('/inscricoes', [SmartAgroController::class, 'store'])
    ->middleware('throttle:10,1')
    ->name('smartagro.inscricoes.store');

Route::get('/sitemap.xml', [SitemapController::class, 'index']);
Route::get('/sitemap-alunos.xml', [SitemapAlunosController::class, 'index']);
Route::get('/sitemap-news.xml', [NewsSitemapController::class, 'index'])->name('sitemap.news');
Route::get('/sitemap-premios.xml', [SitemapPremiosController::class, 'index']);

/*
|--------------------------------------------------------------------------
| Authentication and password reset
|--------------------------------------------------------------------------
*/

Route::middleware('guest')->group(function () {
    Route::get('/area-academica', [UnifiedLoginController::class, 'show'])->name('login.unificado');
    Route::post('/area-academica', [UnifiedLoginController::class, 'login'])
        ->middleware('throttle:5,1')
        ->name('login.unificado.submit');

    Route::get('/login/aluno', [AlunoAuthController::class, 'showLogin'])->name('aluno.login');
    Route::post('/login/aluno', [AlunoAuthController::class, 'login'])
        ->middleware('throttle:5,1')
        ->name('aluno.login.submit');

    Route::get('/login/admin', [AdminAuthController::class, 'showLogin'])->name('admin.login');
    Route::post('/login/admin', [AdminAuthController::class, 'login'])
        ->middleware('throttle:5,1')
        ->name('admin.login.submit');
});

Route::get('/senha/esqueci', [PasswordResetUnificadoController::class, 'solicitar'])->name('senha.esqueci');
Route::post('/senha/esqueci', [PasswordResetUnificadoController::class, 'enviar'])
    ->middleware('throttle:5,1')
    ->name('senha.esqueci.enviar');
Route::get('/senha/email-enviado', [PasswordResetUnificadoController::class, 'enviado'])->name('senha.email.enviado');
Route::get('/senha/redefinir/{token}', [PasswordResetUnificadoController::class, 'formulario'])->name('senha.redefinir.form');
Route::post('/senha/redefinir', [PasswordResetUnificadoController::class, 'redefinir'])
    ->middleware('throttle:5,1')
    ->name('senha.redefinir.salvar');

Route::post('/logout', function (Request $request) {
    $request->session()->flush();
    $request->session()->invalidate();
    $request->session()->regenerateToken();

    return redirect()->route('home');
})->name('logout');

/*
|--------------------------------------------------------------------------
| Student area
|--------------------------------------------------------------------------
*/

Route::middleware(['web', 'aluno'])->group(function () {
    Route::get('/egresso/dashboard', fn () => view('egresso.dashboard'))->name('egresso.dashboard');

    Route::post('/senha/enviar-link', [AlunoPasswordResetController::class, 'sendLink'])
        ->middleware('throttle:3,1')
        ->name('senha.enviar');

    Route::prefix('aluno')->name('aluno.')->group(function () {
        Route::get('/dashboard', [AlunoController::class, 'dashboard'])->name('dashboard');
        Route::get('/boletim', [AlunoController::class, 'boletim'])->name('boletim');
        Route::get('/saeb', [SaebController::class, 'alunoResultados'])->name('saeb');
        Route::get('/cronograma', [AlunoController::class, 'cronograma'])->name('cronograma');
        Route::get('/calendario', [CalendarioController::class, 'indexAluno'])->name('calendario.index');

        Route::get('/perfil', [AlunoPerfilController::class, 'edit'])->name('perfil');
        Route::post('/perfil', [AlunoPerfilController::class, 'update'])->name('perfil.update');
        Route::post('/perfil/remover-foto', [AlunoPerfilController::class, 'removerFoto'])->name('perfil.removerFoto');

        Route::get('/comunicados', [ComunicadoController::class, 'indexAluno'])->name('comunicados.index');
        Route::post('/comunicados/{comunicado}/lido', [ComunicadoController::class, 'marcarLido'])->name('comunicados.lido');
        Route::delete('/comunicados/{comunicado}/lido', [ComunicadoController::class, 'marcarNaoLido'])->name('comunicados.naoLido');

        Route::get('/atividades', [AlunoAtividadeController::class, 'index'])->name('atividades.index');
        Route::get('/atividades/{atividade}', [AlunoAtividadeController::class, 'show'])->name('atividades.show');
        Route::post('/atividades/{atividade}/enviar', [AlunoAtividadeController::class, 'enviar'])
            ->middleware('throttle:10,1')
            ->name('atividades.enviar');

        Route::get('/presidente/chamada', [AlunoController::class, 'chamadaTurma'])->name('presidente.chamada');
        Route::post('/presidente/chamada', [AlunoController::class, 'chamadaTurmaStore'])
            ->middleware('throttle:10,1')
            ->name('presidente.chamada.store');
    });
});

/*
|--------------------------------------------------------------------------
| Teacher area
|--------------------------------------------------------------------------
*/

Route::prefix('professor')
    ->middleware(['web', 'professor'])
    ->name('professor.')
    ->group(function () {
        Route::get('/dashboard', [AdminController::class, 'dashboardProfessor'])->name('dashboard');
        Route::get('/cronograma', [AdminController::class, 'cronogramaProfessor'])->name('cronograma');

        Route::get('/projetos', [ProfessorProjetoController::class, 'index'])->name('projetos.index');
        Route::get('/projetos/create', [ProfessorProjetoController::class, 'create'])->name('projetos.create');
        Route::post('/projetos', [ProfessorProjetoController::class, 'store'])->name('projetos.store');
        Route::get('/projetos/{id}/edit', [ProfessorProjetoController::class, 'edit'])->name('projetos.edit');
        Route::put('/projetos/{id}', [ProfessorProjetoController::class, 'update'])->name('projetos.update');

        Route::get('/atividades', [ProfessorAtividadeController::class, 'materias'])->name('atividades.index');
        Route::get('/atividades/disciplina/{disciplina}', [ProfessorAtividadeController::class, 'atividadesDisciplina'])->name('atividades.disciplina');
        Route::get('/atividades/disciplina/{disciplina}/create', [ProfessorAtividadeController::class, 'create'])->name('atividades.create');
        Route::post('/atividades/disciplina/{disciplina}', [ProfessorAtividadeController::class, 'store'])->name('atividades.store');
        Route::get('/atividades/disciplina/{disciplina}/edit/{atividade}', [ProfessorAtividadeController::class, 'edit'])->name('atividades.edit');
        Route::put('/atividades/disciplina/{disciplina}/{atividade}', [ProfessorAtividadeController::class, 'update'])->name('atividades.update');
        Route::get('/atividades/disciplina/{disciplina}/delete/{atividade}', [ProfessorAtividadeController::class, 'confirmDelete'])->name('atividades.delete');
        Route::delete('/atividades/disciplina/{disciplina}/{atividade}', [ProfessorAtividadeController::class, 'destroy'])->name('atividades.destroy');
        Route::get('/atividades/{atividade}/lancar', [ProfessorAtividadeController::class, 'lancar'])->name('atividades.lancar');
        Route::post('/atividades/{atividade}/salvar', [ProfessorAtividadeController::class, 'salvarLancamento'])->name('atividades.salvar');
    });

/*
|--------------------------------------------------------------------------
| Admin area
|--------------------------------------------------------------------------
*/

Route::prefix('admin')
    ->middleware(['web', 'admin'])
    ->name('admin.')
    ->group(function () {
        Route::get('/dashboard', [AdminController::class, 'dashboard'])->name('dashboard');
        Route::get('/diretor/dashboard', [AdminController::class, 'dashboard'])->name('diretor.dashboard');

        Route::middleware('permissao:publicar_noticias')->group(function () {
            Route::get('/noticias', [AdminNewsController::class, 'index'])->name('news.index');
            Route::get('/noticias/criar', [AdminNewsController::class, 'create'])->name('news.create');
            Route::post('/noticias', [AdminNewsController::class, 'store'])->name('news.store');
            Route::get('/noticias/{id}/editar', [AdminNewsController::class, 'edit'])->name('news.edit');
            Route::put('/noticias/{id}', [AdminNewsController::class, 'update'])->name('news.update');
            Route::delete('/noticias/{id}', [AdminNewsController::class, 'destroy'])->name('news.destroy');
            Route::post('/noticias/upload-imagem', [AdminNewsController::class, 'uploadImage'])
                ->middleware('throttle:20,1')
                ->name('news.upload');
        });

        Route::middleware('permissao:gerenciar_usuarios')->group(function () {
            Route::get('/usuarios', [AdminController::class, 'usuarios'])->name('usuarios');
            Route::post('/usuarios', [AdminController::class, 'storeUsuario'])->name('usuarios.store');
            Route::get('/usuarios/{tipo}/{id}/edit', [AdminController::class, 'editUsuario'])->name('usuarios.edit');
            Route::put('/usuarios/{tipo}/{id}', [AdminController::class, 'updateUsuario'])->name('usuarios.update');
            Route::delete('/usuarios/{tipo}/{id}', [AdminController::class, 'deleteUsuario'])->name('usuarios.delete');

            Route::get('/institucional', [AdminController::class, 'institucionalIndex'])->name('institucional.index');
            Route::get('/institucional/criar', [AdminController::class, 'institucionalCreate'])->name('institucional.create');
            Route::post('/institucional', [AdminController::class, 'institucionalStore'])->name('institucional.store');
            Route::get('/institucional/{id}/editar', [AdminController::class, 'institucionalEdit'])->name('institucional.edit');
            Route::put('/institucional/{id}', [AdminController::class, 'institucionalUpdate'])->name('institucional.update');
            Route::delete('/institucional/{id}', [AdminController::class, 'institucionalDestroy'])->name('institucional.destroy');

            Route::get('/aprovados', [AdminController::class, 'aprovadosIndex'])->name('aprovados.index');
            Route::get('/aprovados/create', [AdminController::class, 'aprovadosCreate'])->name('aprovados.create');
            Route::post('/aprovados', [AdminController::class, 'aprovadosStore'])->name('aprovados.store');
            Route::get('/aprovados/{id}/edit', [AdminController::class, 'aprovadosEdit'])->name('aprovados.edit');
            Route::put('/aprovados/{id}', [AdminController::class, 'aprovadosUpdate'])->name('aprovados.update');
            Route::delete('/aprovados/{id}', [AdminController::class, 'aprovadosDestroy'])->name('aprovados.destroy');

            Route::get('/presidentes', [AdminController::class, 'presidentesIndex'])->name('presidentes.index');
            Route::post('/presidentes', [AdminController::class, 'presidentesStore'])->name('presidentes.store');
            Route::delete('/presidentes/{id}', [AdminController::class, 'presidentesDestroy'])->name('presidentes.destroy');
            Route::get('/chamadas-turma', [AdminController::class, 'chamadasTurmaIndex'])->name('chamadas.index');
            Route::get('/chamadas-turma/{id}', [AdminController::class, 'chamadasTurmaShow'])->name('chamadas.show');

            Route::get('/permissoes', [AdminController::class, 'permissoesIndex'])->name('permissoes.index');
            Route::post('/diretor/permissoes/{id}', [AdminDiretorController::class, 'syncPermissoes'])->name('diretor.permissoes');
        });

        Route::middleware('permissao:gerenciar_cronograma')->group(function () {
            Route::get('/cronograma', [AdminController::class, 'cronogramaIndex'])->name('cronograma.index');
            Route::get('/cronograma/export/excel', [AdminController::class, 'exportExcel'])->name('cronograma.export.excel');
            Route::post('/cronograma/gerar', [AdminController::class, 'gerarCronograma'])->name('cronograma.gerar');
            Route::post('/cronograma/salvar', [AdminController::class, 'salvarCronograma'])->name('cronograma.salvar');
            Route::post('/cronograma/drag-save', [AdminController::class, 'cronogramaDragSave'])->name('cronograma.dragSave');
            Route::delete('/cronograma/drag-delete', [AdminController::class, 'cronogramaDragDelete'])->name('cronograma.dragDelete');
            Route::delete('/cronograma/apagar-tudo', [AdminController::class, 'cronogramaApagarTudo'])->name('cronograma.apagarTudo');

            Route::get('/disciplinas', [AdminController::class, 'disciplinasIndex'])->name('disciplinas.index');
            Route::get('/disciplinas/create', [AdminController::class, 'disciplinasCreate'])->name('disciplinas.create');
            Route::post('/disciplinas', [AdminController::class, 'disciplinasStore'])->name('disciplinas.store');
            Route::get('/disciplinas/{id}/edit', [AdminController::class, 'disciplinasEdit'])->name('disciplinas.edit');
            Route::put('/disciplinas/{id}', [AdminController::class, 'disciplinasUpdate'])->name('disciplinas.update');
            Route::delete('/disciplinas/{id}', [AdminController::class, 'disciplinasDelete'])->name('disciplinas.delete');
        });

        Route::get('/calendario', [CalendarioController::class, 'indexAdmin'])->name('calendario.index');
        Route::get('/calendario/create', [CalendarioController::class, 'create'])->name('calendario.create');
        Route::post('/calendario', [CalendarioController::class, 'store'])->name('calendario.store');
        Route::get('/calendario/{id}/edit', [CalendarioController::class, 'edit'])->name('calendario.edit');
        Route::put('/calendario/{id}', [CalendarioController::class, 'update'])->name('calendario.update');
        Route::delete('/calendario/{id}', [CalendarioController::class, 'destroy'])->name('calendario.destroy');

        Route::get('/comunicados', [ComunicadoController::class, 'indexAdmin'])->name('comunicados.index');
        Route::get('/comunicados/create', [ComunicadoController::class, 'create'])->name('comunicados.create');
        Route::post('/comunicados', [ComunicadoController::class, 'store'])->name('comunicados.store');
        Route::get('/comunicados/{id}/edit', [ComunicadoController::class, 'edit'])->name('comunicados.edit');
        Route::put('/comunicados/{id}', [ComunicadoController::class, 'update'])->name('comunicados.update');
        Route::delete('/comunicados/{id}', [ComunicadoController::class, 'destroy'])->name('comunicados.destroy');
        Route::get('/comunicados/{comunicado}/turma', [ComunicadoController::class, 'verLeituraTurma'])->name('comunicados.turma');

        Route::get('/restricoes', [ProfessorRestricaoController::class, 'index'])->name('restricoes');
        Route::post('/restricoes', [ProfessorRestricaoController::class, 'store'])->name('restricoes.store');
        Route::delete('/restricoes/{id}', [ProfessorRestricaoController::class, 'destroy'])->name('restricoes.delete');

        Route::middleware('permissao:ver_relatorios')->group(function () {
            Route::get('/boletins', [AdminController::class, 'boletins'])->name('boletins');
            Route::post('/boletins', [AdminController::class, 'storeBoletim'])->name('boletins.store');
            Route::get('/saeb', [SaebController::class, 'index'])->name('saeb');
            Route::post('/saeb/upload', [SaebController::class, 'upload'])->name('saeb.upload');
            Route::post('/saeb/mapear', [SaebController::class, 'mapearAlunos'])->name('saeb.mapear');
            Route::get('/saeb/protocolo', [ProtocolController::class, 'protocolo'])->name('saeb.protocolo');
            Route::post('/saeb/publicar/{id}', [ProtocolController::class, 'publicar'])->name('saeb.publicar');
        });

        Route::get('/professores', [AdminController::class, 'professoresIndex'])->name('professores');
        Route::get('/professores/create', [AdminController::class, 'createProfessor'])->name('professores.create');
        Route::post('/professores', [AdminController::class, 'storeProfessor'])->name('professores.store');
        Route::get('/professores/{id}/edit', [AdminController::class, 'editarProfessor'])->name('professores.edit');
        Route::post('/professores/{id}/salvar', [AdminController::class, 'salvarProfessor'])->name('professores.salvar');
        Route::delete('/professores/{tipo}/{id}', [AdminController::class, 'deleteUsuario'])->name('professores.delete');

        Route::get('/projetos', [AdminController::class, 'projetosIndex'])->name('projetos');

        Route::get('/premios', [PremioAdminController::class, 'index'])->name('premios.index');
        Route::get('/premios/novo', [PremioAdminController::class, 'create'])->name('premios.create');
        Route::post('/premios', [PremioAdminController::class, 'store'])->name('premios.store');
        Route::get('/premios/{premio}/editar', [PremioAdminController::class, 'edit'])->name('premios.edit');
        Route::put('/premios/{premio}', [PremioAdminController::class, 'update'])->name('premios.update');

        Route::get('/smart-agro', [SmartAgroController::class, 'adminIndex'])->name('smartagro.index');
        Route::get('/smart-agro/{id}', [SmartAgroController::class, 'adminShow'])->name('smartagro.show');
        Route::post('/smart-agro/{id}/avaliar', [SmartAgroController::class, 'avaliar'])->name('smartagro.avaliar');
        Route::post('/smart-agro/{id}/status/{status}', [SmartAgroController::class, 'alterarStatus'])->name('smartagro.status');

    });
