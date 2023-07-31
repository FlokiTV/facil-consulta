<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\MedicoPaciente;
use App\Models\Medico;
use App\Models\Paciente;

class MedicoPacienteController extends Controller
{
    // O método vincularPaciente continua aqui, como implementado anteriormente

    public function getPacientesVinculados($id_medico)
    {
        $medico = Medico::find($id_medico);
        if (!$medico) {
            return response()->json(['message' => 'Médico não encontrado'], 404);
        }

        $pacientes = Paciente::join('medico_paciente', 'pacientes.id', '=', 'medico_paciente.paciente_id')
            ->join('medicos', 'medico_paciente.medico_id', '=', 'medicos.id')
            ->where('medicos.id', $id_medico)
            ->select('pacientes.*')
            ->get();

        return response()->json($pacientes);
    }
}