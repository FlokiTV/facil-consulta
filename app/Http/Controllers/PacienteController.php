<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Paciente;

class PacienteController extends Controller
{
    public function store(Request $request)
    {
        $request->validate([
            'nome' => 'required|string|max:100',
            'cpf' => 'required|string|max:20|unique:pacientes',
            'celular' => 'required|string|max:20',
        ]);

        $paciente = Paciente::create([
            'nome' => $request->nome,
            'cpf' => $request->cpf,
            'celular' => $request->celular,
        ]);

        return response()->json($paciente);
    }
}
