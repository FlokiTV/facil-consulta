<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Paciente;
use App\Models\Validator;

class PacienteController extends Controller
{
    public function store(Request $request)
    {
        $request->validate([
            'nome' => 'required|string|max:100',
            'cpf' => 'required|string|max:20|unique:pacientes',
            'celular' => 'required|string|max:20',
        ]);
        if (!Validator::cpf($request->cpf)) {
            return response()->json(['message' => 'O CPF precisa ser válido'], 400);
        }
        if (!Validator::tel($request->celular)) {
            return response()->json(['message' => 'O celular precisa ser válido'], 400);
        }
        $paciente = Paciente::create([
            'nome' => $request->nome,
            'cpf' => $request->cpf,
            'celular' => $request->celular,
        ]);

        return response()->json($paciente);
    }
    public function update(Request $request, $id_paciente)
    {
        $request->validate([
            'nome' => 'sometimes|string|max:100',
            'celular' => 'sometimes|string|max:20',
        ]);

        $paciente = Paciente::find($id_paciente);

        if (!$paciente) {
            return response()->json(['message' => 'Paciente não encontrado'], 404);
        }
        if ($request->filled('nome')) {
            $paciente->nome = $request->nome;
        }
        if ($request->filled('celular')) {
            $paciente->celular = $request->celular;
        }
        $paciente->save();
        return response()->json($paciente);
    }
}