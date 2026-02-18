<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\Mail;
use App\Mail\SmartAgroClassificadosMail;

class EnviarSmartAgroClassificados extends Command
{
    protected $signature = 'smartagro:enviar-classificados';

    protected $description = 'Envia email para projetos classificados Smart Agro';

    public function handle()
    {
        $emails = [
            'braz.silva.lucas@escola.pr.gov.br',
            'ramalho.otavio@escola.pr.gov.br',
            'gustavo.mota.filho@escola.pr.gov.br',
            'gabriell02ps@gmail.com',
            'bruno.kay@escola.pr.gov.br',
            'gabriel.paula.silva02@escola.pr.gov.br',
            'joao.pereira.alves05@escola.pr.gov.br',
            'felipe.tratz.silva@escola.pr.gov.br',
        ];

        foreach ($emails as $email) {
            Mail::to($email)->send(new SmartAgroClassificadosMail());
        }

        $this->info('Emails enviados com sucesso.');
    }
}
