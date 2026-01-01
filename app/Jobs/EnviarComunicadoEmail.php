<?php

namespace App\Jobs;

use App\Models\Comunicado;
use App\Mail\ComunicadoMail;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Mail;

class EnviarComunicadoEmail implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    public function __construct(
        public string $email,
        public int $comunicadoId
    ) {}

    public function handle(): void
    {
        $comunicado = Comunicado::find($this->comunicadoId);

        if (!$comunicado) {
            return;
        }

        Mail::to($this->email)
            ->send(new ComunicadoMail($comunicado));
    }
}
