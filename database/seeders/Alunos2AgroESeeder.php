<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use App\Models\Aluno;

class Alunos2AgroESeeder extends Seeder
{
    public function run(): void
    {
        $turma  = '2º Agro E';
        $escola = 'CEEP';

        $alunos = [
            ['nome' => 'ADRIAN FLAVIO SANTOS DE JESUS', 'dn' => '01/08/2009', 'email' => 'adrian.jesus01@escola.pr.gov.br'],
            ['nome' => 'DONALD KASSINOFE DA SILVA', 'dn' => '10/11/2009', 'email' => 'donald.silva@escola.pr.gov.br'],
            ['nome' => 'GILSON FARIAS DOS SANTOS JUNIOR', 'dn' => '17/10/2009', 'email' => 'junior.gilson17@escola.pr.gov.br'],
            ['nome' => 'GUSTAVO DE ALMEIDA LIMA', 'dn' => '06/05/2009', 'email' => 'gustavo.almeida.lima06@escola.pr.gov.br'],
            ['nome' => 'JACOB BARBOSA DA SILVA', 'dn' => '18/10/2009', 'email' => 'jacob.silva@escola.pr.gov.br'],
            ['nome' => 'MATEUS HENRIQUE DE SOUZA LOPES', 'dn' => '06/04/2008', 'email' => 'souza.lopes.mateus@escola.pr.gov.br'],
            ['nome' => 'MICHEL DA SILVA SANTOS', 'dn' => '26/04/2008', 'email' => 'michel.santos26@escola.pr.gov.br'],
            ['nome' => 'MIZAEL FELIPE MONTEIRO MARQUES', 'dn' => '13/05/2009', 'email' => 'mizael.marques@escola.pr.gov.br'],
            ['nome' => 'NATHALLY KAWANNY RODRIGUES OLIVEIRA', 'dn' => '14/11/2009', 'email' => 'nathally.rodrigues.oliveira@escola.pr.gov.br'],
            ['nome' => 'NICOLAS FABRICIO DA SILVA', 'dn' => '09/06/2009', 'email' => 'fabricio.silva.nicolas@escola.pr.gov.br'],
            ['nome' => 'VICTOR GABRIEL APARECIDO BUENO', 'dn' => '30/10/2008', 'email' => 'victor.aparecido.bueno@escola.pr.gov.br'],
            ['nome' => 'VICTOR GABRIEL DE MORAIS SILVA', 'dn' => '05/01/2008', 'email' => 'morais.silva.victor@escola.pr.gov.br'],
            ['nome' => 'VITOR BARBOSA DA CRUZ', 'dn' => '24/12/2009', 'email' => 'vitor.barbosa.cruz@escola.pr.gov.br'],
            ['nome' => 'WESLEY SOARES KASSINOFE DA SILVA', 'dn' => '04/10/2008', 'email' => 'wesley.kassinofe.silva@escola.pr.gov.br'],
        ];

        foreach ($alunos as $a) {
            $senha = str_replace('/', '', $a['dn']); // sem /

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
