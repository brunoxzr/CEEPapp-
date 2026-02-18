<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use App\Models\Aluno;

class Alunos2AgroASeeder extends Seeder
{
    public function run(): void
    {
        $turma  = '2º Agro A';
        $escola = 'CEEP';

        $alunos = [
            ['nome' => 'ANA CLARA BUENO CARNEIRO', 'dn' => '11/04/2010', 'email' => 'bueno.carneiro@escola.pr.gov.br'],
            ['nome' => 'CHRYSTIAN GABRIEL CUSTODIO FRANCISCO', 'dn' => '09/04/2009', 'email' => 'chrystian.francisco@escola.pr.gov.br'],
            ['nome' => 'CIBELY VITÓRIA DE OLICINO', 'dn' => '25/03/2010', 'email' => 'cibely.olicino@escola.pr.gov.br'],
            ['nome' => 'DIOGO EMANUEL LAVRE DA SILVA', 'dn' => '22/05/2009', 'email' => 'diogo.lavre.silva@escola.pr.gov.br'],
            ['nome' => 'DOUGLAS DEODÉRIO', 'dn' => '06/04/2010', 'email' => 'douglas.deoderio@escola.pr.gov.br'],
            ['nome' => 'EMANUEL DE SOUZA MACHADO', 'dn' => '09/09/2009', 'email' => 'emanuel.souza.machado@escola.pr.gov.br'],
            ['nome' => 'EMANUELLY RAMOS DE SOUZA', 'dn' => '19/05/2010', 'email' => 'ramos.souza.emanuelly@escola.pr.gov.br'],
            ['nome' => 'ÉRICK TAMAKI MARCELINO', 'dn' => '16/03/2010', 'email' => 'marcelino.erick@escola.pr.gov.br'],
            ['nome' => 'FILIPE MARTINS BORGES', 'dn' => '22/05/2010', 'email' => 'borges.filipe@escola.pr.gov.br'],
            ['nome' => 'GIOVANNA HASSELMANN PESSOA LIMA', 'dn' => '29/03/2010', 'email' => 'giovanna.pessoa.lima@escola.pr.gov.br'],
            ['nome' => 'GUILHERME DELMONICO DE OLIVEIRA', 'dn' => '11/01/2010', 'email' => 'guilherme.delmonico.oliveira@escola.pr.gov.br'],
            ['nome' => 'ISABELY FERREIRA SOARES', 'dn' => '18/01/2010', 'email' => 'isabely.ferreira.soares@escola.pr.gov.br'],
            ['nome' => 'JEMIMA ISABELLY MENDES DO CARMO GAIOSKI', 'dn' => '11/09/2010', 'email' => 'jemima.gaioski@escola.pr.gov.br'],
            ['nome' => 'JOSÉ GUILHERME DE OLIVEIRA BARBOSA', 'dn' => '24/08/2009', 'email' => 'barbosa.jose24@escola.pr.gov.br'],
            ['nome' => 'KAUÊ FELIPHE MELO DA CRUZ LIMA', 'dn' => '10/10/2009', 'email' => 'kaue.cruz.lima@escola.pr.gov.br'],
            ['nome' => 'KEMILLY GABRIELLY BUENO DO PRADO', 'dn' => '13/06/2010', 'email' => 'prado.kemilly@escola.pr.gov.br'],
            ['nome' => 'LEANDRO DA SILVA CARNEIRO', 'dn' => '15/08/2009', 'email' => 'leandro.carneiro15@escola.pr.gov.br'],
            ['nome' => 'LEONARDO LUIZ DA SILVA', 'dn' => '15/12/2008', 'email' => 'leonardo.luiz.silva15@escola.pr.gov.br'],
            ['nome' => 'LORENA DOS SANTOS RODRIGUES', 'dn' => '15/05/2010', 'email' => 'lorena.santos.rodrigues@escola.pr.gov.br'],
            ['nome' => 'LUANA FELICIANO XAVIER', 'dn' => '08/09/2008', 'email' => 'luana.feliciano.xavier@escola.pr.gov.br'],
            ['nome' => 'LUCAS GUALBERTO DOS SANTOS', 'dn' => '23/07/2010', 'email' => 'lucas.gualberto.santos@escola.pr.gov.br'],
            ['nome' => 'LUIS GUSTAVO CORDEIRO', 'dn' => '18/03/2010', 'email' => 'gustavo.cordeiro.luis@escola.pr.gov.br'],
            ['nome' => 'LUIZ HENRIQUE VIEIRA LOURENÇO', 'dn' => '04/10/2010', 'email' => 'luiz.vieira.lourenco@escola.pr.gov.br'],
            ['nome' => 'MARIA EDUARDA MORAIS BORGES', 'dn' => '19/06/2009', 'email' => 'maria.morais.borges@escola.pr.gov.br'],
            ['nome' => 'MARIA JÚLIA CORDEIRO SENA', 'dn' => '08/03/2010', 'email' => 'maria.cordeiro.sena@escola.pr.gov.br'],
            ['nome' => 'MARIA VITÓRIA FLÂMIA', 'dn' => '31/08/2010', 'email' => 'maria.flamia@escola.pr.gov.br'],
            ['nome' => 'MURILO RODRIGUES DE PAULA', 'dn' => '13/11/2010', 'email' => 'murilo.rodrigues.paula@escola.pr.gov.br'],
            ['nome' => 'OTÁVIO HIDEKI MANESCO RAMALHO', 'dn' => '03/07/2010', 'email' => 'ramalho.otavio@escola.pr.gov.br'],
            ['nome' => 'PABLO GUILHERME CORREA DA SILVA', 'dn' => '15/04/2008', 'email' => 'pablo.correa.silva@escola.pr.gov.br'],
            ['nome' => 'THIERRY VINÍCIUS DA SILVA TRINDADE', 'dn' => '04/01/2008', 'email' => 'thierry.trindade@escola.pr.gov.br'],
            ['nome' => 'YASMIM LAFAIANI MARTINS NASCIMENTO', 'dn' => '02/07/2010', 'email' => 'yasmim.martins.nascimento@escola.pr.gov.br'],
            ['nome' => 'YASMIN DA COSTA FRANCISCO', 'dn' => '19/09/2009', 'email' => 'yasmin.costa.francisco@escola.pr.gov.br'],
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
