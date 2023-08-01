<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PacienteController;
use App\Http\Controllers\MedicoController;
use App\Http\Controllers\MedicoPacienteController;
use App\Models\Cidade;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});

Route::post('/login', function (Request $request) {
    $credentials = $request->only(['email', 'password']);
    if (!$token = auth()->attempt($credentials)) {
        abort(401, "Unauthorized");
    }
    return response()->json([
        'data' => [
            'token' => $token,
            'token_type' => 'bearer',
            'expires_in' => auth()->factory()->getTTL() * 60
        ]
    ]);
});
// Cidades
Route::get('/cidades', function () {
    $cidades = Cidade::all();
    return $cidades;
});
/*
    Medicos
*/
// Listar médicos
Route::get('/medicos', [MedicoController::class, 'all']);
// Listar médicos de uma cidade
Route::get('/cidades/{id_cidade}/medicos', [MedicoController::class, 'getByCidade']);
// Adicionar medico
Route::middleware('auth:api')->post('/medicos', [MedicoController::class, 'store']);
/*
    Pacientes
*/
// Adicionar paciente
Route::middleware('auth:api')->post('/pacientes', [PacienteController::class, 'store']);
// Atualizar paciente
Route::middleware('auth:api')->post('/pacientes/{id_paciente}', [PacienteController::class, 'update']); // No teste diz POST
Route::middleware('auth:api')->put('/pacientes/{id_paciente}', [PacienteController::class, 'update']); // No Postman o teste é com PUT
/*
    Relação MedicoPacientes
*/
// Listar pacientes do médico
Route::middleware('auth:api')->get('/medicos/{id_medico}/pacientes', [MedicoPacienteController::class, 'getPacientesVinculados']);
// Vincular paciente e médico
Route::middleware('auth:api')->post('/medicos/{id_medico}/pacientes', [MedicoPacienteController::class, 'vincularPaciente']);