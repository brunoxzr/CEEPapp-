<?php

namespace App\Services;

use App\Models\Admin;
use App\Models\Cronograma;
use App\Models\TurmaDisciplina;
use Illuminate\Support\Facades\DB;

class CronogramaGenerator
{
    private array $dias = ['Segunda','Terça','Quarta','Quinta','Sexta'];

    private array $aulas = [
        1 => ['07:20','08:10'],
        2 => ['08:10','09:00'],
        3 => ['09:10','09:50'],
        4 => ['10:10','11:00'],
        5 => ['11:00','11:40'],
        6 => ['11:40','12:30'],
    ];

    /**
     * Gera cronograma automático
     */
    public function gerar(array $turmas): array
    {
        DB::beginTransaction();

        try {
            $resultado = [];

            foreach ($turmas as $turma) {

                $disciplinas = TurmaDisciplina::with('disciplina')
                    ->where('turma', $turma)
                    ->get();

                foreach ($disciplinas as $td) {

                    $necessarias = $td->carga_horaria;
                    $disciplina  = $td->disciplina;

                    $professores = $disciplina->professores;

                    while ($necessarias > 0) {

                        $alocado = false;

                        foreach ($this->dias as $dia) {
                            foreach ($this->aulas as $num => [$ini,$fim]) {

                                if ($this->slotOcupado($turma, $dia, $num)) {
                                    continue;
                                }

                                foreach ($professores as $prof) {

                                    if (!$prof->podeDarAula($dia, $num)) {
                                        continue;
                                    }

                                    $max = $prof->pivot->carga_horaria_max;
                                    if (!$prof->podeReceberMaisAulas($max)) {
                                        continue;
                                    }

                                    if ($this->professorEmOutroLugar($prof->nome, $dia, $num)) {
                                        continue;
                                    }

                                    // ✅ Aloca
                                    Cronograma::create([
                                        'turma'      => $turma,
                                        'dia_semana' => $dia,
                                        'aula'       => $num,
                                        'inicio'     => $ini,
                                        'fim'        => $fim,
                                        'disciplina' => $disciplina->nome,
                                        'professor'  => $prof->nome,
                                    ]);

                                    $resultado[] = [
                                        'turma' => $turma,
                                        'disciplina' => $disciplina->nome,
                                        'professor' => $prof->nome,
                                        'dia' => $dia,
                                        'aula' => $num,
                                    ];

                                    $necessarias--;
                                    $alocado = true;
                                    break 3;
                                }
                            }
                        }

                        // ❌ não achou slot → deixa buraco
                        if (!$alocado) {
                            break;
                        }
                    }
                }
            }

            DB::commit();
            return $resultado;

        } catch (\Throwable $e) {
            DB::rollBack();
            throw $e;
        }
    }

    // =========================
    // HELPERS
    // =========================

    private function slotOcupado(string $turma, string $dia, int $aula): bool
    {
        return Cronograma::where(compact('turma'))
            ->where('dia_semana', $dia)
            ->where('aula', $aula)
            ->exists();
    }

    private function professorEmOutroLugar(string $nome, string $dia, int $aula): bool
    {
        return Cronograma::where('professor', $nome)
            ->where('dia_semana', $dia)
            ->where('aula', $aula)
            ->exists();
    }
}
