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

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
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
// Adicionar medico
Route::post('/medicos', [MedicoController::class, 'store']);
// Listar médicos de uma cidade
Route::get('/cidades/{id_cidade}/medicos', [MedicoController::class, 'getByCidade']);
/*
    Pacientes
*/
// Adicionar paciente
Route::post('/pacientes', [PacienteController::class, 'store']);
// Atualizar paciente
Route::post('/pacientes/{id_paciente}', [PacienteController::class, 'update']); // No teste diz POST
Route::put('/pacientes/{id_paciente}', [PacienteController::class, 'update']); // No Postman o teste é com PUT
/*
    Relação MedicoPacientes
*/
// Listar pacientes do médico
Route::get('/medicos/{id_medico}/pacientes', [MedicoPacienteController::class, 'getPacientesVinculados']);
// Vincular paciente e médico
Route::post('/medicos/{id_medico}/pacientes', [MedicoPacienteController::class, 'vincularPaciente']);