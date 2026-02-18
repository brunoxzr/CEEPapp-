<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\SmartAgroController;

/*
|--------------------------------------------------------------------------
| Controllers
|--------------------------------------------------------------------------
*/

// Portal / Público
use App\Http\Controllers\PortalController;
use App\Http\Controllers\NewsController;
use App\Http\Controllers\ProjetoPublicoController;
use App\Http\Controllers\HubRHController;
use App\Http\Controllers\Portal\AprovadoController;
use App\Models\Aprovado;


// Auth
use App\Http\Controllers\Auth\AlunoAuthController;
use App\Http\Controllers\Auth\AdminAuthController;
use App\Http\Controllers\Auth\UnifiedLoginController;

// Aluno
use App\Http\Controllers\AlunoPerfilController;
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
use App\Http\Controllers\AlunoPublicController;
use App\Http\Controllers\PremioController;
use App\Http\Controllers\Admin\PremioAdminController;
use App\Http\Middleware\AdminAuthMiddleware;
use App\Http\Controllers\SitemapPremiosController;
use App\Http\Controllers\AlunoPasswordResetController;
use App\Http\Controllers\SitemapController;
use App\Http\Controllers\SitemapAlunosController;
use App\Http\Controllers\NewsSitemapController;
use App\Http\Controllers\ProfessorAtividadeController;
use App\Http\Controllers\AlunoAtividadeController;
/*
|--------------------------------------------------------------------------
| PORTAL • Aprovados
|--------------------------------------------------------------------------
*/

Route::get('/aprovados', [AprovadoController::class, 'index'])
    ->name('portal.aprovados.index');

/*
|--------------------------------------------------------------------------
| SMART AGRO 2026 — INSCRIÇÕES INTERNAS
|--------------------------------------------------------------------------
*/
Route::get('/selecionados', [SmartAgroController::class, 'selecionados'])
    ->name('smartagro.selecionados');

Route::get('/inscricoes', [SmartAgroController::class, 'index'])
    ->name('smartagro.inscricoes');

Route::post('/inscricoes', [SmartAgroController::class, 'store'])
    ->name('smartagro.inscricoes.store');

/*
|--------------------------------------------------------------------------
| ÁREA DO PROFESSOR — ATIVIDADES (DIÁRIO DE CLASSE)
|--------------------------------------------------------------------------
|
| Middleware:
| - web
| - admin.professor (OBRIGATÓRIO no seu sistema)
| - professor
|
*/
Route::prefix('professor')
    ->middleware(['web', 'professor'])
    ->group(function () {
Route::put(
    '/atividades/disciplina/{disciplina}/{atividade}',
    [ProfessorAtividadeController::class, 'update']
)->name('professor.atividades.update');
// CONFIRMAÇÃO (opcional, se você quiser uma tela)
Route::get('/atividades/disciplina/{disciplina}/delete/{atividade}',
    [ProfessorAtividadeController::class, 'confirmDelete']
)->name('professor.atividades.delete');

// DESTROY
Route::delete('/atividades/disciplina/{disciplina}/{atividade}',
    [ProfessorAtividadeController::class, 'destroy']
)->name('professor.atividades.destroy');

        // ===============================
        // INDEX — matérias
        // ===============================
        Route::get('/atividades', [ProfessorAtividadeController::class, 'materias'])
            ->name('professor.atividades.index');

        // ===============================
        // LISTA DE ATIVIDADES DA DISCIPLINA
        // ===============================
        Route::get('/atividades/disciplina/{disciplina}', [ProfessorAtividadeController::class, 'atividadesDisciplina'])
            ->name('professor.atividades.disciplina');

        // ===============================
        // CREATE
        // ===============================
        Route::get('/atividades/disciplina/{disciplina}/create', [ProfessorAtividadeController::class, 'create'])
            ->name('professor.atividades.create');
        Route::get('/atividades/disciplina/{disciplina}/edit/{atividade}', [ProfessorAtividadeController::class, 'edit'])
            ->name('professor.atividades.edit');

        // ===============================
        // STORE
        // ===============================
        Route::post('/atividades/disciplina/{disciplina}', [ProfessorAtividadeController::class, 'store'])
            ->name('professor.atividades.store');

        // ===============================
        // LANÇAR ATIVIDADE
        // ===============================
        Route::get('/atividades/{atividade}/lancar', [ProfessorAtividadeController::class, 'lancar'])
            ->name('professor.atividades.lancar');

        Route::post('/atividades/{atividade}/salvar', [ProfessorAtividadeController::class, 'salvarLancamento'])
            ->name('professor.atividades.salvar');
    });

Route::prefix('professor')
    ->middleware(['web', 'professor'])
    ->group(function () {

        /*
        |--------------------------------------------------------------------------
        | 1️⃣ INDEX — MATÉRIAS QUE O PROFESSOR DÁ
        |--------------------------------------------------------------------------
        | GET /professor/atividades
        */
        Route::get('/atividades', [ProfessorAtividadeController::class, 'materias'])
            ->name('professor.atividades.index');

        /*
        |--------------------------------------------------------------------------
        | 2️⃣ DISCIPLINA — ATIVIDADES DA MATÉRIA
        |--------------------------------------------------------------------------
        | GET /professor/atividades/disciplina/{disciplina}
        */
        Route::get('/atividades/disciplina/{disciplina}', [ProfessorAtividadeController::class, 'atividadesDisciplina'])
            ->name('professor.atividades.disciplina');

        /*
        |--------------------------------------------------------------------------
        | 3️⃣ LANÇAMENTO — LISTA DE ALUNOS DA TURMA
        |--------------------------------------------------------------------------
        | GET /professor/atividades/{atividade}/lancar
        */
        Route::get('/atividades/{atividade}/lancar', [ProfessorAtividadeController::class, 'lancar'])
            ->name('professor.atividades.lancar');

        /*
        |--------------------------------------------------------------------------
        | 4️⃣ SALVAR — CHECKLIST FEZ / NÃO FEZ
        |--------------------------------------------------------------------------
        | POST /professor/atividades/{atividade}/salvar
        */
        Route::post('/atividades/{atividade}/salvar', [ProfessorAtividadeController::class, 'salvarLancamento'])
            ->name('professor.atividades.salvar');

    });


Route::get('/sitemap-news.xml', [NewsSitemapController::class, 'index'])
    ->name('sitemap.news');


Route::get('/sitemap.xml', [SitemapController::class, 'index']);
Route::get('/sitemap-alunos.xml', [SitemapAlunosController::class, 'index']);

Route::get('/sitemap-premios.xml', [SitemapPremiosController::class, 'index']);

Route::get('/senha/email-enviado', function () {
    return view('auth.senha-email-enviado');
})->name('senha.email.enviado');

// enviar e-mail
Route::post('/senha/enviar-link', [AlunoPasswordResetController::class, 'sendLink'])
    ->name('senha.enviar');

// formulário de redefinição
Route::get('/senha/redefinir/{token}', [AlunoPasswordResetController::class, 'showResetForm'])
    ->name('senha.form');

// salvar nova senha
Route::post('/senha/redefinir', [AlunoPasswordResetController::class, 'reset'])
    ->name('senha.reset');

Route::get('/admin/cronograma/export/excel',
  [AdminController::class, 'exportExcel']
)->name('admin.cronograma.export.excel');

Route::post('/aluno/perfil/remover-foto', [AlunoPerfilController::class, 'removerFoto'])
    ->name('aluno.perfil.removerFoto');

Route::get('/sitemap-premios.xml', [SitemapPremiosController::class, 'index']);

/*
|--------------------------------------------------------------------------
| ADMIN • Prêmios e Reconhecimentos
|--------------------------------------------------------------------------
*/
Route::prefix('admin')
    ->middleware(['web', AdminAuthMiddleware::class])
    ->group(function () {
                /*
        |--------------------------------------------------------------------------
        | Aprovados
        |--------------------------------------------------------------------------
        */
        Route::middleware('permissao:gerenciar_usuarios')->group(function () {
    Route::get('/aprovados/{id}/edit',
        [AdminController::class, 'aprovadosEdit'])
        ->name('admin.aprovados.edit');

    Route::put('/aprovados/{id}',
        [AdminController::class, 'aprovadosUpdate'])
        ->name('admin.aprovados.update');

            Route::get('/aprovados', [AdminController::class, 'aprovadosIndex'])
                ->name('admin.aprovados.index');

            Route::get('/aprovados/create', [AdminController::class, 'aprovadosCreate'])
                ->name('admin.aprovados.create');

            Route::post('/aprovados', [AdminController::class, 'aprovadosStore'])
                ->name('admin.aprovados.store');

            Route::delete('/aprovados/{id}', [AdminController::class, 'aprovadosDestroy'])
                ->name('admin.aprovados.destroy');
        });

Route::get('/admin/smart-agro/{id}',
    [SmartAgroController::class, 'adminShow'])
    ->name('admin.smartagro.show');

        // LISTAR prêmios
        Route::get('/premios', [PremioAdminController::class, 'index'])
            ->name('admin.premios.index');

        // FORM novo prêmio
        Route::get('/premios/novo', [PremioAdminController::class, 'create'])
            ->name('admin.premios.create');

        // SALVAR novo prêmio
        Route::post('/premios', [PremioAdminController::class, 'store'])
            ->name('admin.premios.store');

        // EDITAR prêmio
        Route::get('/premios/{premio}/editar', [PremioAdminController::class, 'edit'])
            ->name('admin.premios.edit');

        // ATUALIZAR prêmio + alunos
        Route::put('/premios/{premio}', [PremioAdminController::class, 'update'])
            ->name('admin.premios.update');
                    /*
        |--------------------------------------------------------------------------
        | SMART AGRO 2026 — GESTÃO
        |--------------------------------------------------------------------------
        */

        Route::get('/smart-agro', [SmartAgroController::class, 'adminIndex'])
            ->name('admin.smartagro.index');

        Route::post('/smart-agro/{id}/avaliar', [SmartAgroController::class, 'avaliar'])
            ->name('admin.smartagro.avaliar');

        Route::post('/smart-agro/{id}/status/{status}', [SmartAgroController::class, 'alterarStatus'])
            ->name('admin.smartagro.status');

    });

/*
|--------------------------------------------------------------------------
| PORTAL • Prêmios e Reconhecimentos
|--------------------------------------------------------------------------
*/

// LISTA pública
Route::get('/premios-e-reconhecimentos', [PremioController::class, 'index'])
    ->name('portal.premios');
Route::get('/perfil/aluno/{slug}', [AlunoPublicController::class, 'show'])
    ->name('aluno.public');
// SHOW individual
Route::get('/premios/{premio}', [PremioController::class, 'show'])
    ->name('portal.premios.show');
/*
|--------------------------------------------------------------------------
| ROTAS PÚBLICAS — PORTAL
|--------------------------------------------------------------------------
*/
Route::prefix('legal')->group(function () {
    Route::view('/privacidade', 'legal.privacidade')->name('legal.privacidade');
    Route::view('/termos', 'legal.termos')->name('legal.termos');
    Route::view('/acessibilidade', 'legal.acessibilidade')->name('legal.acessibilidade');
});


Route::get('/', [PortalController::class, 'index'])->name('home');
Route::view('/contato', 'portal.contato')->name('portal.contato');

// Institucional
Route::get('/institucional', [PortalController::class, 'institucional'])
    ->name('portal.institucional');
Route::get('/institucional/{slug}', [PortalController::class, 'institucionalShow'])
    ->name('portal.institucional.show');

// Cursos
Route::get('/cursos', fn () => view('cursos.index'))->name('portal.courses');

Route::prefix('cursos')->group(function () {

    // Desenvolvimento de Sistemas
    Route::view(
        '/desenvolvimento-de-sistemas',
        'cursos.desenvolvimento'
    )->name('cursos.desenvolvimento');

    // Enfermagem
    Route::view(
        '/enfermagem',
        'cursos.enfermagem'
    )->name('cursos.enfermagem');

    // Mecânica Industrial
    Route::view(
        '/mecanica-industrial',
        'cursos.mecanica-industrial'
    )->name('cursos.mecanica-industrial');

    // Eletrotécnica
    Route::view(
        '/eletrotecnica',
        'cursos.eletrotecnica'
    )->name('cursos.eletrotecnica');

    // Edificações
    Route::view(
        '/edificacoes',
        'cursos.edificacoes'
    )->name('cursos.edificacoes');

    // Agropecuária
    Route::view(
        '/agronegocio',
        'cursos.agronegocio'
    )->name('cursos.agronegocio');

    // Administração
    Route::view(
        '/administracao',
        'cursos.administracao'
    )->name('cursos.administracao');

    // Inteligência Artificial e Ciência de Dados
    Route::view(
        '/inteligencia-artificial-dados',
        'cursos.inteligencia-artificial-dados'
    )->name('cursos.ia-dados');

    // Segurança do Trabalho
    Route::view(
        '/seguranca-do-trabalho',
        'cursos.seguranca-do-trabalho'
    )->name('cursos.seguranca');

});

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
Route::middleware(['web', 'aluno'])->group(function () {

    Route::get('/egresso/dashboard', function () {
        return view('egresso.dashboard');
    })->name('egresso.dashboard');

});

Route::prefix('aluno')
    ->middleware(['web', 'aluno'])
    ->group(function () {
                /*
        |--------------------------------------------------------------------------
        | ATIVIDADES DO ALUNO
        |--------------------------------------------------------------------------
        */

        // LISTAR atividades
        Route::get('/atividades', [AlunoAtividadeController::class, 'index'])
            ->name('aluno.atividades.index');

        // VER atividade específica
        Route::get('/atividades/{atividade}', [AlunoAtividadeController::class, 'show'])
            ->name('aluno.atividades.show');

        // ENVIAR atividade (link drive)
        Route::post('/atividades/{atividade}/enviar', [AlunoAtividadeController::class, 'enviar'])
            ->name('aluno.atividades.enviar');


        Route::get('/dashboard', [AlunoController::class, 'dashboard'])
            ->name('aluno.dashboard');

        Route::get('/boletim', [AlunoController::class, 'boletim'])
            ->name('aluno.boletim');

        Route::get('/saeb', [SaebController::class, 'alunoResultados'])
            ->name('aluno.saeb');

        Route::get('/cronograma', [AlunoController::class, 'cronograma'])
            ->name('aluno.cronograma');

        Route::get('/calendario', [CalendarioController::class, 'indexAluno'])
            ->name('aluno.calendario.index');

        Route::get('/comunicados', [ComunicadoController::class, 'indexAluno'])
            ->name('aluno.comunicados.index');

        Route::post('/comunicados/{comunicado}/lido', [ComunicadoController::class, 'marcarLido'])
            ->name('aluno.comunicados.lido');

        Route::delete('/comunicados/{comunicado}/lido', [ComunicadoController::class, 'marcarNaoLido'])
            ->name('aluno.comunicados.naoLido');


    });
// PERFIL DO ALUNO
Route::middleware('auth:aluno')->group(function () {
    Route::get('/aluno/perfil', [AlunoPerfilController::class, 'edit']);
    Route::post('/aluno/perfil', [AlunoPerfilController::class, 'update']);
});
Route::middleware(['web', 'aluno'])->prefix('aluno')->name('aluno.')->group(function () {

    Route::get('/dashboard', [AlunoController::class, 'dashboard'])
        ->name('dashboard');

    Route::get('/perfil', [AlunoPerfilController::class, 'edit'])
        ->name('perfil');

    Route::post('/perfil', [AlunoPerfilController::class, 'update'])
        ->name('perfil.update');

});
// HUB DE RH
Route::get('/hub-rh', [HubRHController::class, 'index']);


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
        Route::get('/admin/comunicados/{comunicado}/turma',
    [ComunicadoController::class, 'verLeituraTurma']
)->name('admin.comunicados.turma');



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
