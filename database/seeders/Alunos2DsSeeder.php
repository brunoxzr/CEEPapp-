<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use App\Models\Aluno;

class Alunos2DsSeeder extends Seeder
{
    public function run(): void
    {
        $turma  = '2º DS';
        $escola = 'CEEP';

        $alunos = [
            ['nome' => 'ANTHONY BICHACO SANTOS', 'dn' => '20/04/2010', 'email' => 'anthony.bichaco.santos@escola.pr.gov.br'],
            ['nome' => 'ANTONIO APARECIDO SANTANA JUNIOR', 'dn' => '20/04/2010', 'email' => 'antonio.santana.junior@escola.pr.gov.br'],
            ['nome' => 'EMANUELLY FRANCINE SILVA', 'dn' => '07/08/2010', 'email' => 'emanuelly.francine.silva@escola.pr.gov.br'],
            ['nome' => 'FELIPE AKIO TELES MARUYAMA', 'dn' => '28/04/2009', 'email' => 'felipe.maruyama@escola.pr.gov.br'],
            ['nome' => 'FELIPE CARNEIRO TRATZ DA SILVA', 'dn' => '22/04/2010', 'email' => 'felipe.tratz.silva@escola.pr.gov.br'],
            ['nome' => 'GABRIEL DE PAULA SILVA', 'dn' => '02/05/2010', 'email' => 'gabriel.paula.silva02@escola.pr.gov.br'],
            ['nome' => 'GABRIEL MARTINS ARGENTINO', 'dn' => '25/09/2010', 'email' => 'gabriel.argentino@escola.pr.gov.br'],
            ['nome' => 'GUILHERME CREVELARO SALCEDO', 'dn' => '16/04/2010', 'email' => 'guilherme.salcedo@escola.pr.gov.br'],
            ['nome' => 'JOÃO LUCAS PEREIRA ALVES', 'dn' => '05/08/2010', 'email' => 'joao.pereira.alves05@escola.pr.gov.br'],
            ['nome' => 'JOÃO VITOR RIBEIRO DE OLIVEIRA', 'dn' => '20/09/2010', 'email' => 'joao.ribeiro.oliveira20@escola.pr.gov.br'],
            ['nome' => 'JOSE VICTOR RIBEIRO ALVES', 'dn' => '08/04/2009', 'email' => 'jose.alves08@escola.pr.gov.br'],
            ['nome' => 'JULIO DE FARIA SANTOS ESTEVES', 'dn' => '10/08/2009', 'email' => 'julio.esteves@escola.pr.gov.br'],
            ['nome' => 'KARINE YUMI MORITA', 'dn' => '15/09/2010', 'email' => 'karine.morita@escola.pr.gov.br'],
            ['nome' => 'KAUAN SANTANA RODRIGUES', 'dn' => '10/11/2010', 'email' => 'kauan.santana.rodrigues@escola.pr.gov.br'],
            ['nome' => 'KAUANY NUNES DE CAMPOS', 'dn' => '11/03/2010', 'email' => 'kauany.nunes.campos@escola.pr.gov.br'],
            ['nome' => 'KAWAN NEWTON PEREIRA', 'dn' => '15/07/2010', 'email' => 'kawan.newton.pereira@escola.pr.gov.br'],
            ['nome' => 'LUCAS GABRIEL PEREIRA DA SILVA', 'dn' => '01/03/2010', 'email' => 'pereira.silva.lucas0103@escola.pr.gov.br'],
            ['nome' => 'LUCAS LIMA BRAZ DA SILVA', 'dn' => '13/11/2010', 'email' => 'braz.silva.lucas@escola.pr.gov.br'],
            ['nome' => 'MARIA CLARA TOMAZ VIEIRA', 'dn' => '26/06/2010', 'email' => 'maria.tomaz.vieira@escola.pr.gov.br'],
            ['nome' => 'MATHEUS DA SILVA SOUZA', 'dn' => '03/06/2010', 'email' => 'matheus.silva.souza03@escola.pr.gov.br'],
            ['nome' => 'PEDRO HENRIQUE DA SILVA PROENÇA LEMES', 'dn' => '15/06/2010', 'email' => 'pedro.proenca.lemes@escola.pr.gov.br'],
            ['nome' => 'PEDRO HENRIQUE RAIMUNDO', 'dn' => '17/10/2010', 'email' => 'pedro.henrique.raimundo@escola.pr.gov.br'],
            ['nome' => 'PRISCILLA ALEXANDRE GONÇALVES', 'dn' => '12/12/2010', 'email' => 'goncalves.priscilla@escola.pr.gov.br'],
            ['nome' => 'RAFAELA SILVA ODELON', 'dn' => '30/11/2010', 'email' => 'rafaela.odelon@escola.pr.gov.br'],
            ['nome' => 'RAKELLY SOARES DA SILVA', 'dn' => '29/10/2008', 'email' => 'rakelly.soares.silva@escola.pr.gov.br'],
            ['nome' => 'VICTOR KARLAYO SIMÃO ESTORARI', 'dn' => '10/09/2009', 'email' => 'victor.estorari@escola.pr.gov.br'],
            ['nome' => 'VINICIUS HIDEKI OGASAWARA', 'dn' => '15/04/2010', 'email' => 'ogasawara.vinicius@escola.pr.gov.br'],
            ['nome' => 'VINÍCIUS SANTOS CASASOLA', 'dn' => '22/12/2010', 'email' => 'vinicius.casasola@escola.pr.gov.br'],
            ['nome' => 'VINICIUS YUDI TODA SILVA', 'dn' => '16/10/2010', 'email' => 'vinicius.toda.silva@escola.pr.gov.br'],
            ['nome' => 'WESLLEY PEDRO BRASIL', 'dn' => '15/07/2010', 'email' => 'brasil.weslley@escola.pr.gov.br'],
        ];

        foreach ($alunos as $a) {
            $senha = str_replace('/', '', $a['dn']);

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
