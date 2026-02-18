<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use App\Models\Aluno;

class Alunos2EdfSeeder extends Seeder
{
    public function run(): void
    {
        $turma  = '2º EDF';
        $escola = 'CEEP';

        $alunos = [
            ['nome'=>'ANA CLARA MANOEL BENEDITO','dn'=>'04042008','email'=>'ana.manoel.benedito@escola.pr.gov.br'],
            ['nome'=>'ANA CLAUDIA BRAGA DE LIMA','dn'=>'30012009','email'=>'braga.lima.ana@escola.pr.gov.br'],
            ['nome'=>'ARTHUR MIGUEL DE OLIVEIRA','dn'=>'09082010','email'=>'miguel.oliveira.arthur@escola.pr.gov.br'],
            ['nome'=>'BEATRIZ OLIVEIRA DA SILVA','dn'=>'20122010','email'=>'oliveira.silva.beatriz2012@escola.pr.gov.br'],
            ['nome'=>'ELOAH GUADAHIM SILVERIO','dn'=>'30112009','email'=>'eloah.silverio@escola.pr.gov.br'],
            ['nome'=>'ELOISA MARTINS SATZKE','dn'=>'18012010','email'=>'eloisa.satzke@escola.pr.gov.br'],
            ['nome'=>'EMILY GEOVANNA DE BRITO BRAZ','dn'=>'03082010','email'=>'emily.brito.braz@escola.pr.gov.br'],
            ['nome'=>'EMILY RIBEIRO DE OLIVEIRA','dn'=>'17032009','email'=>'o.emily17@escola.pr.gov.br'],
            ['nome'=>'GIOVANNA VITORIA BENETTI PINTO','dn'=>'13032010','email'=>'giovanna.benetti.pinto@escola.pr.gov.br'],
            ['nome'=>'JOÃO VITOR DIAS BICUDO','dn'=>'02032009','email'=>'bicudo.joao@escola.pr.gov.br'],
            ['nome'=>'KELVIN FELIPE BARBOSA DE OLIVEIRA','dn'=>'14042009','email'=>'kelvin.oliveira@escola.pr.gov.br'],
            ['nome'=>'LAIS FERNANDA DE OLIVEIRA','dn'=>'01092010','email'=>'fernanda.oliveira.lais@escola.pr.gov.br'],
            ['nome'=>'LARISSA SILVA DE ALMEIDA','dn'=>'11052009','email'=>'larissa.almeida11@escola.pr.gov.br'],
            ['nome'=>'LARYSSA PAULO DA SILVA','dn'=>'21062010','email'=>'laryssa.paulo.silva@escola.pr.gov.br'],
            ['nome'=>'LAYS FERNANDA DE ALMEIDA','dn'=>'07122007','email'=>'lays.fernanda.almeida@escola.pr.gov.br'],
            ['nome'=>'LORENA PEREIRA KAWAMURA FONSECA','dn'=>'24112010','email'=>'fonseca.lorena@escola.pr.gov.br'],
            ['nome'=>'MANUELLA FONSECA DE FARIA PAIVA','dn'=>'18052010','email'=>'paiva.manuella@escola.pr.gov.br'],
            ['nome'=>'MARCELA VITORIA DIAMANTINO DA SILVA','dn'=>'17052010','email'=>'marcela.diamantino.silva@escola.pr.gov.br'],
            ['nome'=>'MARIANY CAMARGO SANTANA','dn'=>'27122010','email'=>'santana.mariany@escola.pr.gov.br'],
            ['nome'=>'MATHEUS YUKIO TASHIMA BIGNARDI DE OLIVEIRA','dn'=>'29072009','email'=>'matheus.bignardi.oliveira@escola.pr.gov.br'],
            ['nome'=>'MEIRIELLY VITORIA DOS SANTOS SEBASTIÃO','dn'=>'21122010','email'=>'meirielly.sebastiao@escola.pr.gov.br'],
            ['nome'=>'MICAEL PRESTES DE OLIVEIRA','dn'=>'08052010','email'=>'micael.prestes.oliveira@escola.pr.gov.br'],
            ['nome'=>'NATHALIA CUSTODIO DINIZ','dn'=>'24122010','email'=>'nathalia.diniz@escola.pr.gov.br'],
            ['nome'=>'PAULO HENRIQUE VIETZE JUNIOR','dn'=>'01082010','email'=>'paulo.vietze.junior@escola.pr.gov.br'],
            ['nome'=>'PEDRO HENRIQUE KAMOGAWA BORGES','dn'=>'14112009','email'=>'pedro.kamogawa.borges@escola.pr.gov.br'],
            ['nome'=>'PRISCILA MOURA DIONIZIO','dn'=>'14102008','email'=>'priscila.dionizio@escola.pr.gov.br'],
            ['nome'=>'RIHANNA DA SILVA ESPARZA OKAMURA','dn'=>'04122010','email'=>'rihanna.okamura@escola.pr.gov.br'],
            ['nome'=>'MIRIAN JULIA DOS SANTOS','dn'=>'01062008','email'=>'julia.santos.mirian@escola.pr.gov.br'],
        ];

        foreach ($alunos as $a) {
            Aluno::updateOrCreate(
                ['email' => $a['email']],
                [
                    'nome'   => $a['nome'],
                    'senha'  => Hash::make($a['dn']), // senha = data sem /
                    'escola' => $escola,
                    'turma'  => $turma,
                ]
            );
        }
    }
}
