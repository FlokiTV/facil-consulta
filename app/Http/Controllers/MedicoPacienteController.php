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
        // Validar os dados recebidos na requisição
        $request->validate([
            'medico_id' => 'required|numeric',
            'paciente_id' => 'required|numeric',
        ]);

        // Encontrar o médico pelo ID fornecido
        $medico = Medico::find($id_medico);

        // Verificar se o médico existe
        if (!$medico) {
            return response()->json(['message' => 'Médico não encontrado'], 404);
        }

        // Encontrar o paciente pelo ID fornecido
        $paciente = Paciente::find($request->paciente_id);

        // Verificar se o paciente existe
        if (!$paciente) {
            return response()->json(['message' => 'Paciente não encontrado'], 404);
        }

        // Criar o vínculo entre médico e paciente na tabela medico_paciente
        $medico->pacientes()->attach($paciente->id);

        // Retornar um objeto JSON com os dados do médico e do paciente vinculados
        return response()->json(['medico' => $medico, 'paciente' => $paciente]);
    }
}