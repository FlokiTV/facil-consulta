<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PacienteController;
use App\Http\Controllers\MedicoPacienteController;
use App\Models\Cidade;
use App\Models\Medico;

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
// Medicos
Route::get('/medicos', function () {
    $medicos = Medico::all();
    return $medicos;
});
Route::get('/cidades/{id_cidade}/medicos', function ($id_cidade) {
    $medicos = Medico::where('cidade_id', $id_cidade)->get();
    return $medicos;
});
Route::get('/medicos/{id_medico}/pacientes', [MedicoPacienteController::class, 'getPacientesVinculados']);
Route::post('/medicos/{id_medico}/pacientes', [MedicoPacienteController::class, 'vincularPaciente']);
// Pacientes
Route::post('/pacientes', [PacienteController::class, 'store']);
Route::put('/pacientes/{id_paciente}', [PacienteController::class, 'update']);