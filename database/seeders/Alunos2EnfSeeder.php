<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use App\Models\Aluno;

class Alunos2EnfSeeder extends Seeder
{
    public function run(): void
    {
        $turma  = '2º Enf';
        $escola = 'CEEP';

        $alunos = [
            ['nome'=>'ALICE GABRIELLY DE FREITAS','dn'=>'02052010','email'=>'alice.gabrielly.freitas@escola.pr.gov.br'],
            ['nome'=>'AMANDA ALVES DO NASCIMENTO','dn'=>'25102010','email'=>'amanda.alves.nascimento@escola.pr.gov.br'],
            ['nome'=>'ANA BEATRIZ DA SILVA MARTINS','dn'=>'13092008','email'=>'ana.silva.martins13@escola.pr.gov.br'],
            ['nome'=>'ANNA BEATRIZ CUSTÓDIO','dn'=>'14042010','email'=>'anna.custodio@escola.pr.gov.br'],
            ['nome'=>'BRAYAN KEVIN BIGNARDI DOS SANTOS OLIVEIRA','dn'=>'14012010','email'=>'brayan.oliveira14@escola.pr.gov.br'],
            ['nome'=>'CAMILA TEODORO DA SILVA','dn'=>'20042009','email'=>'camila.teodoro.silva@escola.pr.gov.br'],
            ['nome'=>'EMANUELLA DA SILVA DUARTE','dn'=>'27032010','email'=>'emanuella.duarte@escola.pr.gov.br'],
            ['nome'=>'GIOVANA EMANUELLY DE LIRA DA SILVA','dn'=>'29012010','email'=>'giovana.lira.silva@escola.pr.gov.br'],
            ['nome'=>'GIOVANNA FREITAS ARAUJO','dn'=>'10112009','email'=>'giovanna.freitas.araujo@escola.pr.gov.br'],
            ['nome'=>'GUILHERME CÉSAR DE PAULA','dn'=>'24062009','email'=>'guilherme.cezar.paula@escola.pr.gov.br'],
            ['nome'=>'HELLOISA BEATRIZ SILVA MAXIMO','dn'=>'16122009','email'=>'helloisa.maximo@escola.pr.gov.br'],
            ['nome'=>'INGRID GABRIELLY SILVA','dn'=>'03072010','email'=>'ingrid.gabrielly.silva@escola.pr.gov.br'],
            ['nome'=>'JYOVANNA LORENA RODRIGUES CUSTODIO','dn'=>'20082010','email'=>'jyovanna.custodio@escola.pr.gov.br'],
            ['nome'=>'MANUELA GOMES DO CARMO','dn'=>'22032009','email'=>'manuela.carmo@escola.pr.gov.br'],
            ['nome'=>'MARIANA YUKA TSUDA PEREIRA','dn'=>'25052010','email'=>'mariana.tsuda.pereira@escola.pr.gov.br'],
            ['nome'=>'YASMIM SOARES HENRIQUE','dn'=>'05082009','email'=>'yasmim.henrique@escola.pr.gov.br'],
        ];

        foreach ($alunos as $a) {
            Aluno::updateOrCreate(
                ['email' => $a['email']],
                [
                    'nome'   => $a['nome'],
                    'senha'  => Hash::make($a['dn']), // senha = D/N sem /
                    'escola' => $escola,
                    'turma'  => $turma,
                ]
            );
        }
    }
}
