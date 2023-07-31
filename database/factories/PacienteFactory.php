<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;
/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Paciente>
 */
class PacienteFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'nome' => fake()->name,
            'cpf' => random_int(100, 999).".".random_int(100, 999).".".random_int(100, 999)."-".random_int(10, 99),
            'celular' => "(11) 0 ".random_int(1234,9999)."-".random_int(1234,9999),
        ];
    }
}
