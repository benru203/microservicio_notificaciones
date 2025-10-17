<?php

namespace Database\Seeders;

use Carbon\Carbon;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Src\Dominio\WebHook\Enums\EstadoEnum;

class DocumentosSeed extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('Documentos')->insert([
            [
                'Id' => 'D5EA10D0-10D8-4DE2-8ED9-4629A7CA2327',
                'Titulo' => 'Contrato de Servicios 2025',
                'Autor' => 'Jhon Doe',
                'Tipo' => 'CONTRATO',
                'Estado' => EstadoEnum::PENDIENTE->value,
                'FechaRegistro' => Carbon::now(),
            ],
        ]);
    }
}
