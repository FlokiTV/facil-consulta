<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Cidade;

class CidadeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $cidades = [
            [
                'id' => 1,
                'nome' => 'Pelotas',
                'estado' => 'Rio Grande do Sul',
            ],
            [
                'id' => 2,
                'nome' => 'São Paulo',
                'estado' => 'São Paulo',
            ],
            [
                'id' => 3,
                'nome' => 'Curitiba',
                'estado' => 'Paraná',
            ]
        ];

        foreach ($cidades as $cidadeData) {
            Cidade::create($cidadeData);
        }
    }
}