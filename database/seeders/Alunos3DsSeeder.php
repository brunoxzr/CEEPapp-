<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use App\Models\Aluno;

class Alunos3DsSeeder extends Seeder
{
    public function run(): void
    {
        $turma  = '3º DS';
        $escola = 'CEEP';

        $alunos = [
            ['nome' => 'ADRIAN FELIPE DA SILVA', 'dn' => '09/04/2009', 'email' => 'silva.adrian09@escola.pr.gov.br'],
            ['nome' => 'ALEFF GONÇALVES OLIVEIRA', 'dn' => '05/09/2008', 'email' => 'aleff.oliveira@escola.pr.gov.br'],
            ['nome' => 'ALLÍCYA SOPHIE ROSA FORIN', 'dn' => '18/06/2009', 'email' => 'allicya.forin@escola.pr.gov.br'],
            ['nome' => 'ANA CLARA UTRERA MARCHI', 'dn' => '13/01/2009', 'email' => 'ana.utrera.marchi@escola.pr.gov.br'],
            ['nome' => 'ANA MARIA RODRIGUES GOUDINHO', 'dn' => '28/10/2008', 'email' => 'ana.goudinho@escola.pr.gov.br'],
            ['nome' => 'ANTÔNIO CORPA GUIMARÃES GUEDES', 'dn' => '21/10/2008', 'email' => 'antonio.guimaraes.guedes@escola.pr.gov.br'],
            ['nome' => 'BRUNO YUDI KAY', 'dn' => '23/04/2009', 'email' => 'bruno.kay@escola.pr.gov.br'],
            ['nome' => 'DAVI MICAEL NASCIMENTO RODRIGUES', 'dn' => '23/03/2009', 'email' => 'nascimento.rodrigues.davi@escola.pr.gov.br'],
            ['nome' => 'EDUARDO PENEROTTI DIAS', 'dn' => '17/06/2009', 'email' => 'eduardo.penerotti.dias@escola.pr.gov.br'],
            ['nome' => 'EMANUELLY ALVES OLIVEIRA', 'dn' => '20/03/2009', 'email' => 'emanuelly.oliveira20@escola.pr.gov.br'],
            ['nome' => 'EMILLY LOHANNA DE SOUZA PAES', 'dn' => '06/12/2008', 'email' => 'emilly.souza.paes@escola.pr.gov.br'],
            ['nome' => 'EVELLY RODRIGUES LACAL', 'dn' => '09/08/2009', 'email' => 'evelly.lacal@escola.pr.gov.br'],
            ['nome' => 'HELOIZA DOS SANTOS BARBOSA', 'dn' => '15/01/2009', 'email' => 'barbosa.heloiza@escola.pr.gov.br'],
            ['nome' => 'JOÃO PEDRO DE OLIVEIRA CELESTINO', 'dn' => '02/07/2009', 'email' => 'joao.oliveira.celestino@escola.pr.gov.br'],
            ['nome' => 'JOÃO VICTOR SOARES TENÓRIO', 'dn' => '25/02/2008', 'email' => 'tenorio.joao@escola.pr.gov.br'],
            ['nome' => 'JULIA GABRIELLY DOMINGOS IVANCHECZEN', 'dn' => '07/09/2008', 'email' => 'julia.ivancheczen@escola.pr.gov.br'],
            ['nome' => 'KAMILA BIANCA DA SILVA', 'dn' => '28/06/2007', 'email' => 'kamila.bianca.silva@escola.pr.gov.br'],
            ['nome' => 'LARISSA NOMURA SUEIRO', 'dn' => '21/01/2009', 'email' => 'larissa.sueiro@escola.pr.gov.br'],
            ['nome' => 'LEONARDO YAMAHO', 'dn' => '27/09/2009', 'email' => 'leonardo.yamaho@escola.pr.gov.br'],
            ['nome' => 'LEONARDO YUDI VIEIRA MIYAZAWA', 'dn' => '27/03/2009', 'email' => 'leonardo.miyazawa@escola.pr.gov.br'],
            ['nome' => 'LOURENY FARIAS PESSOA', 'dn' => '31/03/2009', 'email' => 'loureny.pessoa@escola.pr.gov.br'],
            ['nome' => 'LUCAS MARTINS SELEPENQUE', 'dn' => '27/10/2009', 'email' => 'lucas.selepenque@escola.pr.gov.br'],
            ['nome' => 'LUIZ HENRIQUE ALMEIDA DOS SANTOS', 'dn' => '13/09/2009', 'email' => 'luiz.almeida.santos13@escola.pr.gov.br'],
            ['nome' => 'MATEUS HENRIQUE BATISTA ROSA', 'dn' => '15/09/2008', 'email' => 'mateus.batista.rosa@escola.pr.gov.br'],
            ['nome' => 'MATHEUS FERREIRA DOS SANTOS SOUZA', 'dn' => '19/09/2008', 'email' => 'matheus.santos.souza19@escola.pr.gov.br'],
            ['nome' => 'PEDRO HENRIQUE FUSCHIANI', 'dn' => '17/11/2008', 'email' => 'pedro.fuschiani@escola.pr.gov.br'],
            ['nome' => 'PEDRO KALYEL GAIOSKI DA SILVA', 'dn' => '09/09/2008', 'email' => 'pedro.gaioski.silva@escola.pr.gov.br'],
            ['nome' => 'RENYAN EMANOEL DA SILVA', 'dn' => '26/10/2009', 'email' => 'renyan.silva@escola.pr.gov.br'],
            ['nome' => 'ROMARIO FONSECA LOPES DA COSTA', 'dn' => '27/05/2009', 'email' => 'c.romario@escola.pr.gov.br'],
            ['nome' => 'VITOR KASUO MURATA', 'dn' => '07/02/2007', 'email' => 'vitor.murata@escola.pr.gov.br'],
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
