<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use App\Models\Aluno;

class Alunos3EdfSeeder extends Seeder
{
    public function run(): void
    {
        $turma  = '3º EDF';
        $escola = 'CEEP';

        $alunos = [
            ['nome' => 'AGATHA ARIELLY DA COSTA SILVA', 'dn' => '28/07/2009', 'email' => 'costa.silva.agatha@escola.pr.gov.br'],
            ['nome' => 'AMANDA CRISTINA DE SOUZA', 'dn' => '16/11/2009', 'email' => 'souza.amanda16@escola.pr.gov.br'],
            ['nome' => 'ANA HELENA ROSSIERI DOS SANTOS', 'dn' => '15/12/2009', 'email' => 'ana.rossieri.santos@escola.pr.gov.br'],
            ['nome' => 'ANA LETICIA BUENO TERRENAS', 'dn' => '20/06/2009', 'email' => 'ana.terrenas@escola.pr.gov.br'],
            ['nome' => 'DANIEL OLIVEIRA', 'dn' => '14/11/2009', 'email' => 'd.oliveira14@escola.pr.gov.br'],
            ['nome' => 'EMANUELLY GALDINO', 'dn' => '25/08/2008', 'email' => 'emanuelly.galdino@escola.pr.gov.br'],
            ['nome' => 'EUSTÁQUIO MATEUS REIS PINTO', 'dn' => '01/12/2008', 'email' => 'eustaquio.pinto@escola.pr.gov.br'],
            ['nome' => 'GABRIELLA MATIAS MEIRA', 'dn' => '15/06/2009', 'email' => 'meira.gabriella@escola.pr.gov.br'],
            ['nome' => 'GABRIELLY DE CAMPOS CUSTODIO', 'dn' => '01/05/2008', 'email' => 'gabrielly.custodio@escola.pr.gov.br'],
            ['nome' => 'HIGOR ÂNGELO PEREIRA DE SOUZA', 'dn' => '01/10/2008', 'email' => 'higor.pereira.souza@escola.pr.gov.br'],
            ['nome' => 'ISABELLA CARVALHO DE OLIVEIRA', 'dn' => '09/04/2009', 'email' => 'isabella.carvalho.oliveira@escola.pr.gov.br'],
            ['nome' => 'ISABELY CRISTINA CAMPOS ALEXANDRE', 'dn' => '21/08/2008', 'email' => 'isabely.alexandre@escola.pr.gov.br'],
            ['nome' => 'JOÃO GUILHERME RAMALHO DE ANDRADE', 'dn' => '02/06/2009', 'email' => 'ramalho.andrade@escola.pr.gov.br'],
            ['nome' => 'JULIELLY RODRIGUES ALEXANDRE', 'dn' => '13/06/2009', 'email' => 'julielly.alexandre@escola.pr.gov.br'],
            ['nome' => 'KAREN VITÓRIA DA SILVA MAI', 'dn' => '12/05/2008', 'email' => 'karen.mai@escola.pr.gov.br'],
            ['nome' => 'LARA IPANEMA GRANADO', 'dn' => '23/05/2009', 'email' => 'lara.granado@escola.pr.gov.br'],
            ['nome' => 'MARCIA RODRIGUES BORGES', 'dn' => '04/08/2008', 'email' => 'marcia.rodrigues.borges@escola.pr.gov.br'],
            ['nome' => 'MARIA EDUARDA SIMÕES ANTUNES', 'dn' => '26/06/2009', 'email' => 'maria.simoes.antunes@escola.pr.gov.br'],
            ['nome' => 'MELISSA AYNA MIYASE NOMURA', 'dn' => '15/01/2009', 'email' => 'melissa.nomura@escola.pr.gov.br'],
            ['nome' => 'MIKAELA APARECIDA FRANCISCO DOS SANTOS', 'dn' => '20/10/2009', 'email' => 'mikaela.francisco.santos@escola.pr.gov.br'],
            ['nome' => 'NATHALIA GABRIELY ARAUJO DA SILVA', 'dn' => '14/12/2009', 'email' => 'nathalia.araujo.silva@escola.pr.gov.br'],
            ['nome' => 'NÍCOLAS RODRIGUES DE PAULA', 'dn' => '12/05/2009', 'email' => 'nicolas.rodrigues.paula@escola.pr.gov.br'],
            ['nome' => 'NICOLY DA SILVA FERREIRA', 'dn' => '14/05/2009', 'email' => 'ferreira.nicoly14@escola.pr.gov.br'],
            ['nome' => 'RAPHAELY VALENTINE DA SILVA SENA', 'dn' => '08/11/2009', 'email' => 'raphaely.sena@escola.pr.gov.br'],
            ['nome' => 'VINICIUS GABRIEL MACHADO DE LIMA', 'dn' => '13/05/2008', 'email' => 'l.vinicius13@escola.pr.gov.br'],
        ];

        foreach ($alunos as $a) {
            $senha = str_replace('/', '', $a['dn']); // senha SEM /

            Aluno::updateOrCreate(
                ['email' => $a['email']],
                [
                    'nome'   => $a['nome'],
                    'senha'  => Hash::make($senha),
                    'escola' => $escola,
                    'turma'  => $turma,
                ]
            );
        }
    }
}
