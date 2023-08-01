<?php

namespace App\Http\Controllers;

use App\Models\Cidade;
use App\Models\Medico;
use Illuminate\Http\Request;

class MedicoController extends Controller
{
    public function all()
    {
        $medicos = Medico::all();
        return response()->json($medicos);
    }
    public function store(Request $request)
    {
        $request->validate([
            'nome' => 'required|string|max:100',
            'especialidade' => 'required|string|max:100',
            'cidade_id' => 'required|exists:cidades,id',
        ]);
        $cidade = Cidade::find($request->cidade_id);

        if (!$cidade) {
            return response()->json(['message' => 'Cidade não encontrada'], 404);
        }

        $medico = Medico::create([
            'nome' => $request->nome,
            'especialidade' => $request->especialidade,
            'cidade_id' => $request->cidade_id,
        ]);

        return response()->json($medico);
    }
    public function getByCidade(Request $request, $cidade_id)
    {
        $cidade = Cidade::find($cidade_id);

        if (!$cidade) {
            return response()->json(['message' => 'Cidade não encontrada'], 404);
        }

        $medicos = Medico::where('cidade_id', $cidade_id)->get();
        return response()->json($medicos);
    }
}