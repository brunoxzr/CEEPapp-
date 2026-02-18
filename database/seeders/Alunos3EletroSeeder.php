<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use App\Models\Aluno;

class Alunos3EletroSeeder extends Seeder
{
    public function run(): void
    {
        $turma = '3º Eletro';
        $escola = 'CEEP';

        $alunos = [
            ['nome' => 'AMANDA LEMES PRADES', 'dn' => '02/02/2009', 'email' => 'amanda.prades@escola.pr.gov.br'],
            ['nome' => 'FELIPE ANDRADE RODRIGUES', 'dn' => '07/05/2008', 'email' => 'andrade.rodrigues.felipe@escola.pr.gov.br'],
            ['nome' => 'GEAN CARLOS FRANCISCO CLEMENTE', 'dn' => '08/07/2008', 'email' => 'gean.clemente@escola.pr.gov.br'],
            ['nome' => 'HELOISA DA SILVA NASCIMENTO', 'dn' => '14/08/2008', 'email' => 'silva.nascimento.heloisa@escola.pr.gov.br'],
            ['nome' => 'JOÃO LUCAS CANAVERDE FARIAS VALENTIM', 'dn' => '27/01/2009', 'email' => 'joao.farias.valentim@escola.pr.gov.br'],
            ['nome' => 'JULIANA RODRIGUES TOLEDO NEVES', 'dn' => '16/10/2007', 'email' => 'juliana.toledo.neves@escola.pr.gov.br'],
            ['nome' => 'JULLIA GABRIELY NUNES', 'dn' => '23/12/2009', 'email' => 'jullia.nunes@escola.pr.gov.br'],
            ['nome' => 'KAWANY VICTÓRIA DO PRADO SILVA', 'dn' => '03/08/2009', 'email' => 'kawany.prado.silva@escola.pr.gov.br'],
            ['nome' => 'LARA ALVES BORGES', 'dn' => '18/03/2009', 'email' => 'alves.borges.lara@escola.pr.gov.br'],
            ['nome' => 'LUCAS RIBEIRO CASONI DA SILVA', 'dn' => '01/10/2007', 'email' => 'lucas.casoni.silva@escola.pr.gov.br'],
            ['nome' => 'MARIA EDUARDA MOREIRA DA SILVA', 'dn' => '12/12/2009', 'email' => 'maria.moreira.silva12@escola.pr.gov.br'],
            ['nome' => 'MATEUS LUIZ BONIM', 'dn' => '19/06/2009', 'email' => 'mateus.bonim@escola.pr.gov.br'],
            ['nome' => 'NATHÁLIA GONÇALVES DOS SANTOS', 'dn' => '02/05/2008', 'email' => 'goncalves.santos.nathalia@escola.pr.gov.br'],
            ['nome' => 'OTAVIO MIGUEL BERNARDO DE LIMA', 'dn' => '21/11/2007', 'email' => 'bernardo.lima.otavio@escola.pr.gov.br'],
            ['nome' => 'RODINEI KAIK DA SILVA FERREIRA', 'dn' => '26/02/2008', 'email' => 'rodinei.ferreira@escola.pr.gov.br'],
            ['nome' => 'THAUANY MENDONÇA RIBEIRO', 'dn' => '30/03/2009', 'email' => 'r.thauany@escola.pr.gov.br'],
            ['nome' => 'YASMIN FATTORE PROFESSOR DOS SANTOS', 'dn' => '20/12/2008', 'email' => 'yasmin.professor.santos@escola.pr.gov.br'],
        ];

        foreach ($alunos as $a) {
            $senha = str_replace('/', '', $a['dn']); // dd/mm/aaaa -> ddmmaaaa

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
