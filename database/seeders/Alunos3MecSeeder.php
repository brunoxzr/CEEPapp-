<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use App\Models\Aluno;

class Alunos3MecSeeder extends Seeder
{
    public function run(): void
    {
        $turma  = '3º MEC';
        $escola = 'CEEP';

        $alunos = [
            ['nome' => 'ADMILSON GUSTAVO BORGES DA SILVA', 'dn' => '28/04/2009', 'email' => 'admilson.borges.silva@escola.pr.gov.br'],
            ['nome' => 'AILTON MICHEL ALVES DE PAULA', 'dn' => '11/10/2008', 'email' => 'ailton.paula@escola.pr.gov.br'],
            ['nome' => 'CARLOS DANIEL NEVES FERREIRA', 'dn' => '04/12/2008', 'email' => 'carlos.neves.ferreira@escola.pr.gov.br'],
            ['nome' => 'ENZO GABRIEL PRAXEDES', 'dn' => '29/06/2009', 'email' => 'enzo.praxedes@escola.pr.gov.br'],
            ['nome' => 'FELIPE DA SILVA AYALA', 'dn' => '20/03/2009', 'email' => 'ayala.felipe@escola.pr.gov.br'],
            ['nome' => 'JOÃO EDUARDO ESPIRITO SANTO', 'dn' => '15/05/2008', 'email' => 'joao.santo15@escola.pr.gov.br'],
            ['nome' => 'JOÃO FELIPE JULIO CAMARGO', 'dn' => '13/05/2008', 'email' => 'joao.julio.camargo@escola.pr.gov.br'],
            ['nome' => 'JOÃO HENRIQUE DE SOUZA', 'dn' => '09/02/2008', 'email' => 'joao.henrique.souza09@escola.pr.gov.br'],
            ['nome' => 'JOÃO VITOR ALVES RODRIGUES', 'dn' => '18/02/2009', 'email' => 'r.joao18@escola.pr.gov.br'],
            ['nome' => 'KAUÃ GABRIEL MENEZES RAMOS', 'dn' => '09/09/2008', 'email' => 'kaua.menezes.ramos@escola.pr.gov.br'],
            ['nome' => 'KESLEY BRASIL DOS SANTOS', 'dn' => '17/09/2008', 'email' => 'kesley.brasil.santos@escola.pr.gov.br'],
            ['nome' => 'LUIZ FELIPE JESUS PEREIRA DOS SANTOS', 'dn' => '02/08/2009', 'email' => 'pereira.santos.luiz0208@escola.pr.gov.br'],
            ['nome' => 'MARIA GABRIELLY ALMEIDA DOMINGOS', 'dn' => '22/06/2009', 'email' => 'maria.almeida.domingos@escola.pr.gov.br'],
            ['nome' => 'PEDRO HENRIQUE MARÇAL DE OLIVEIRA MACHADO', 'dn' => '23/04/2009', 'email' => 'oliveira.machado.pedro@escola.pr.gov.br'],
            ['nome' => 'PEDRO HENRIQUE SILVA LEITE', 'dn' => '27/02/2008', 'email' => 'pedro.leite27@escola.pr.gov.br'],
            ['nome' => 'RAFAEL ANTONIO DA SILVA', 'dn' => '07/05/2008', 'email' => 'rafael.antonio.silva07@escola.pr.gov.br'],
        ];

        foreach ($alunos as $a) {
            $senha = str_replace('/', '', $a['dn']); // senha sem /

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
