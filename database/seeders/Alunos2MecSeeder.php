<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use App\Models\Aluno;

class Alunos2MecSeeder extends Seeder
{
    public function run(): void
    {
        $turma  = '2º MEC';
        $escola = 'CEEP';

        $alunos = [
            ['nome'=>'ADRIAN BATISTA RIBEIRO','dn'=>'20022009','email'=>'adrian.batista.ribeiro@escola.pr.gov.br'],
            ['nome'=>'ADRIAN FERREIRA PEREIRA','dn'=>'18052009','email'=>'adrian.ferreira.pereira@escola.pr.gov.br'],
            ['nome'=>'ANDERSON DE OLIVEIRA MEDEIROS','dn'=>'07082009','email'=>'oliveira.medeiros.anderson@escola.pr.gov.br'],
            ['nome'=>'ARISTÓTELES PYETRO ANUNCIAÇÃO','dn'=>'14092010','email'=>'aristoteles.anunciacao@escola.pr.gov.br'],
            ['nome'=>'BRENDA DA SILVA OLIVEIRA LOPES','dn'=>'06022008','email'=>'oliveira.lopes.brenda@escola.pr.gov.br'],
            ['nome'=>'BRENO CAETANO DE SALES','dn'=>'25092010','email'=>'breno.sales@escola.pr.gov.br'],
            ['nome'=>'EVELLYM EMANUELI BRITO DA CRUZ','dn'=>'22022008','email'=>'evellym.cruz@escola.pr.gov.br'],
            ['nome'=>'GUILHERME DA COSTA SANTOS','dn'=>'26082010','email'=>'guilherme.costa.santos26@escola.pr.gov.br'],
            ['nome'=>'GUSTAVO HENRIQUE TOMAZ DE ALMEIDA','dn'=>'19122010','email'=>'gustavo.tomaz.almeida@escola.pr.gov.br'],
            ['nome'=>'JOÃO LUCAS DA CRUZ DUARTE DE SOUZA','dn'=>'17042009','email'=>'joao.duarte.souza17@escola.pr.gov.br'],
            ['nome'=>'JOÃO VICTOR DOMINGOS DOS SANTOS','dn'=>'29072008','email'=>'joao.domingos.santos29@escola.pr.gov.br'],
            ['nome'=>'JOSÉ LUIZ DE OLIVEIRA BORGES','dn'=>'25042009','email'=>'oliveira.borges.jose@escola.pr.gov.br'],
            ['nome'=>'KÁSSIO CAROLA DE SOUZA BENEDITO','dn'=>'13042010','email'=>'kassio.benedito@escola.pr.gov.br'],
            ['nome'=>'KAYKI ALEXANDRE NUNES DE ALMEIDA','dn'=>'07082009','email'=>'kayki.almeida@escola.pr.gov.br'],
            ['nome'=>'LEONARDO YUDI YAMAOKA FERREIRA','dn'=>'21102009','email'=>'leonardo.yamaoka.ferreira@escola.pr.gov.br'],
            ['nome'=>'LUAN SOUZA CUSTÓDIO','dn'=>'26092009','email'=>'luan.souza.custodio@escola.pr.gov.br'],
            ['nome'=>'LUCAS GABRIEL LIMA BIGNARDI DOS SANTOS','dn'=>'08112008','email'=>'lucas.bignardi.santos@escola.pr.gov.br'],
            ['nome'=>'LUCAS PEREIRA SENA SATO','dn'=>'05022010','email'=>'lucas.sena.sato@escola.pr.gov.br'],
            ['nome'=>'MARCOS ANTONIO DA SILVA FILHO','dn'=>'06012009','email'=>'marcos.filho06@escola.pr.gov.br'],
            ['nome'=>'MARCOS VINICIUS SILVA OLIVEIRA','dn'=>'09102007','email'=>'oliveira.marcos09@escola.pr.gov.br'],
            ['nome'=>'MATEUS HENRIQUE PINTO GOMES','dn'=>'09072010','email'=>'mateus.pinto.gomes@escola.pr.gov.br'],
            ['nome'=>'MATHEUS AMARO SEBASTIÃO','dn'=>'23102010','email'=>'matheus.amaro.sebastiao@escola.pr.gov.br'],
            ['nome'=>'MATHEUS HENRIQUE DO SANTOS','dn'=>'24072009','email'=>'henrique.santos.matheus2407@escola.pr.gov.br'],
            ['nome'=>'MICAEL DA SILVA SANTOS','dn'=>'26042008','email'=>'micael.silva.santos@escola.pr.gov.br'],
            ['nome'=>'NAYAN NOVAES CUSTODIO','dn'=>'27022009','email'=>'nayan.custodio@escola.pr.gov.br'],
            ['nome'=>'PEDRO HENRIQUE PAES CAMARGO DOS SANTOS','dn'=>'19052009','email'=>'pedro.camargo.santos19@escola.pr.gov.br'],
            ['nome'=>'THARLES MATHEUS MARTINS DE ALMEIDA','dn'=>'19082008','email'=>'almeida.tharles@escola.pr.gov.br'],
            ['nome'=>'THIAGO HIDEYUKI SHIMADA','dn'=>'02092010','email'=>'thiago.shimada@escola.pr.gov.br'],
            ['nome'=>'VICTOR MATHEUS CUSTÓDIO NASCIMENTO','dn'=>'25012008','email'=>'victor.custodio.nascimento@escola.pr.gov.br'],
            ['nome'=>'VINICIUS GABRIEL SILVA DE ARAUJO','dn'=>'23042010','email'=>'vinicius.araujo23@escola.pr.gov.br'],
            ['nome'=>'WILLIAN JUNIOR DA SILVA LOREILHE','dn'=>'19042009','email'=>'willian.loreilhe@escola.pr.gov.br'],
            ['nome'=>'YASMIM DA MOTA MAXIMIANO','dn'=>'12112008','email'=>'yasmim.maximiano@escola.pr.gov.br'],
            ['nome'=>'GUSTAVO PEREIRA DE JESUS','dn'=>'24042009','email'=>'pereira.jesus.gustavo@escola.pr.gov.br'],
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
