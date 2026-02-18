<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use App\Models\Aluno;

class Alunos3AgroSeeder extends Seeder
{
    public function run(): void
    {
        $turma  = '3º Agro';
        $escola = 'CEEP';

        $alunos = [
            ['nome' => 'ÁGATHA NICOLY DE SOUZA', 'dn' => '29/03/2009', 'email' => 'nicoly.souza.agatha@escola.pr.gov.br'],
            ['nome' => 'ALLYN SALES DOMINGUES FILHO', 'dn' => '17/02/2009', 'email' => 'allyn.filho@escola.pr.gov.br'],
            ['nome' => 'ANA LAURA FRAGATTI ARAUJO', 'dn' => '14/05/2008', 'email' => 'ana.fragatti.araujo@escola.pr.gov.br'],
            ['nome' => 'ANTHONY DE OLIVEIRA BIZARRIA BRANCO', 'dn' => '28/07/2008', 'email' => 'anthony.branco@escola.pr.gov.br'],
            ['nome' => 'AUGUSTO PEREIRA GOUVEIA', 'dn' => '03/02/2008', 'email' => 'augusto.gouveia@escola.pr.gov.br'],
            ['nome' => 'BEATRIZ FERNANDES DE QUEIROZ', 'dn' => '31/01/2008', 'email' => 'beatriz.fernandes.queiroz@escola.pr.gov.br'],
            ['nome' => 'CAIO HARUKI ONOHARA', 'dn' => '05/04/2009', 'email' => 'caio.onohara@escola.pr.gov.br'],
            ['nome' => 'CAMILA GOMES NEVES', 'dn' => '04/06/2009', 'email' => 'gomes.neves.camila@escola.pr.gov.br'],
            ['nome' => 'CARLOS DANIEL DA SILVA PEREIRA', 'dn' => '16/01/2008', 'email' => 'c.pereira16@escola.pr.gov.br'],
            ['nome' => 'CHRISTOFER NICOLAS MENENGOLO', 'dn' => '21/04/2009', 'email' => 'christofer.menengolo@escola.pr.gov.br'],
            ['nome' => 'EMANUELY LUIZ DE ANDRADE', 'dn' => '31/10/2007', 'email' => 'andrade.emanuely@escola.pr.gov.br'],
            ['nome' => 'GABRIEL HENRIQUE FAVERO DA SILVA', 'dn' => '13/06/2008', 'email' => 'gabriel.favero.silva@escola.pr.gov.br'],
            ['nome' => 'GABRIELLY GUADAGUINI', 'dn' => '21/10/2008', 'email' => 'gabrielly.guadaguini@escola.pr.gov.br'],
            ['nome' => 'GUILHERME KANUFRE GOMES', 'dn' => '30/09/2008', 'email' => 'guilherme.kanufre.gomes@escola.pr.gov.br'],
            ['nome' => 'GUSTAVO FARIAS GONÇALVES', 'dn' => '09/05/2009', 'email' => 'gustavo.farias.goncalves@escola.pr.gov.br'],
            ['nome' => 'GUSTAVO NEMOTO RODRIGUES', 'dn' => '21/09/2008', 'email' => 'gustavo.nemoto.rodrigues@escola.pr.gov.br'],
            ['nome' => 'HEYTOR ALVES', 'dn' => '17/02/2009', 'email' => 'heytor.alves@escola.pr.gov.br'],
            ['nome' => 'HUGO SHIMOTE LIMA', 'dn' => '30/09/2008', 'email' => 'hugo.shimote.lima@escola.pr.gov.br'],
            ['nome' => 'ISABELLI DO PRADO FERREIRA SANTOS', 'dn' => '27/06/2009', 'email' => 'isabelli.ferreira.santos@escola.pr.gov.br'],
            ['nome' => 'JEFFERSON MATEUS DA CONCEIÇÃO FULAN', 'dn' => '26/01/2009', 'email' => 'jefferson.fulan@escola.pr.gov.br'],
            ['nome' => 'JOÃO MIGUEL DE OLIVEIRA LIMA', 'dn' => '12/02/2009', 'email' => 'joao.oliveira.lima12@escola.pr.gov.br'],
            ['nome' => 'JOICE KEROLLAYNE DA SILVA LOREILHE', 'dn' => '28/04/2008', 'email' => 'joice.loreilhe@escola.pr.gov.br'],
            ['nome' => 'JULYA HELLOIZA QUEIRÓZ GOMES', 'dn' => '07/11/2008', 'email' => 'g.julya@escola.pr.gov.br'],
            ['nome' => 'KAIC MARTINS NICACIO YUHARA', 'dn' => '27/08/2007', 'email' => 'kaic.yuhara@escola.pr.gov.br'],
            ['nome' => 'LORENAH DOS SANTOS PROENÇA LEMES', 'dn' => '17/06/2009', 'email' => 'lorenah.lemes@escola.pr.gov.br'],
            ['nome' => 'MAÍSA PORTELA BARBOSA SILVA', 'dn' => '10/06/2009', 'email' => 'barbosa.silva.maisa@escola.pr.gov.br'],
            ['nome' => 'MARIA EDUARDA DA SILVA MACHADO', 'dn' => '03/12/2008', 'email' => 'machado.maria03@escola.pr.gov.br'],
            ['nome' => 'MATHEUS MASSAKI CHIYODA', 'dn' => '07/02/2008', 'email' => 'matheus.chiyoda@escola.pr.gov.br'],
            ['nome' => 'MIKAELLY COSMO DE SOUZA SILVA', 'dn' => '13/09/2008', 'email' => 'mikaelly.souza.silva@escola.pr.gov.br'],
            ['nome' => 'NATÁLIA GOMES DA SILVA', 'dn' => '27/10/2009', 'email' => 'natalia.silva27@escola.pr.gov.br'],
            ['nome' => 'NICOLY FERREIRA NUNES', 'dn' => '01/03/2009', 'email' => 'nicoly.ferreira.nunes@escola.pr.gov.br'],
            ['nome' => 'PEDRO HENRIQUE FERREIRA DE FARIAS', 'dn' => '08/12/2008', 'email' => 'ferreira.farias.pedro@escola.pr.gov.br'],
            ['nome' => 'SAMYRA MAYUMI ANDRADE MIAMOTO', 'dn' => '26/09/2009', 'email' => 'samyra.miamoto@escola.pr.gov.br'],
            ['nome' => 'TAINA SHATIKO TASHIRO', 'dn' => '05/11/2009', 'email' => 'tashiro.taina@escola.pr.gov.br'],
            ['nome' => 'VITOR GABRIEL OLIVEIRA MOURA', 'dn' => '18/06/2008', 'email' => 'vitor.moura18@escola.pr.gov.br'],
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
