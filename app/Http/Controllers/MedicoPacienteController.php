<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\MedicoPaciente;
use App\Models\Medico;
use App\Models\Paciente;

class MedicoPacienteController extends Controller
{
    // public function getPacientesVinculados($id_medico)
    // {
    //     $medico = Medico::find($id_medico);
    //     if (!$medico) {
    //         return response()->json(['message' => 'Médico não encontrado'], 404);
    //     }

    //     $pacientes = Paciente::join('medico_paciente', 'pacientes.id', '=', 'medico_paciente.paciente_id')
    //         ->join('medicos', 'medico_paciente.medico_id', '=', 'medicos.id')
    //         ->where('medicos.id', $id_medico)
    //         ->select('pacientes.*')
    //         ->get();

    //     return response()->json($pacientes);
    // }
    public function getPacientesVinculados($id_medico)
    {
        $medico = Medico::find($id_medico);
        if (!$medico) {
            return response()->json(['message' => 'Médico não encontrado'], 404);
        }
        $pacientes = $medico->pacientes;
        return response()->json($pacientes);
    }
    public function vincularPaciente(Request $request, $id_medico)
    {
        $request->validate([
            'medico_id' => 'required|numeric',
            'paciente_id' => 'required|numeric',
        ]);

        $medico = Medico::find($id_medico);

        if (!$medico) {
            return response()->json(['message' => 'Médico não encontrado'], 404);
        }

        $paciente = Paciente::find($request->paciente_id);

        if (!$paciente) {
            return response()->json(['message' => 'Paciente não encontrado'], 404);
        }

        $medicoPaciente = MedicoPaciente::create([
            'medico_id' => $medico->id,
            'paciente_id' => $paciente->id,
        ]);

        return response()->json(['medico' => $medico, 'paciente' => $paciente]);
    }
}