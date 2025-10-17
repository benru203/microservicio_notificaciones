<?php

use App\Models\Repositorios\WebHook\Documento as DocumentoModel; 
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Http\Response;
use Src\Dominio\WebHook\Enums\EstadoEnum;

uses(RefreshDatabase::class);


describe('POST /api/webhook/validar-documento', function () {

    it('responde con un mensaje 422 cuando no se puede validar los datos recibidos', function () {
        DocumentoModel::create(['Id' => '123', 'Estado' => EstadoEnum::PENDIENTE->value]);
        $response = $this->postJson('/api/webhook/validar-documento');
        $response->assertStatus(Response::HTTP_UNPROCESSABLE_ENTITY);
    });

    it('responde con un mensaje 422 cuando nse envian estado invalido', function () {
        DocumentoModel::create(['Id' => '123', 'Estado' => EstadoEnum::PENDIENTE->value]);
        $body = [
            'documentoId' => '123',
            'nuevoEstado' => 'ESTADO_INVALIDO'
        ];
        $response = $this->postJson('/api/webhook/validar-documento', $body);
        $response->assertStatus(Response::HTTP_UNPROCESSABLE_ENTITY);
    });

    it('responde con un mensaje 422 cuando no se envian documentoId invalido', function () {
        DocumentoModel::create(['Id' => '123', 'Estado' => EstadoEnum::PENDIENTE->value]);
        $body = [
            'documentoId' => '',
            'nuevoEstado' => EstadoEnum::VALIDADO->value
        ];
        $response = $this->postJson('/api/webhook/validar-documento', $body);
        $response->assertStatus(Response::HTTP_UNPROCESSABLE_ENTITY);
    });

     it('responde con un mensaje 404 cuando se envian documentoId no existe', function () {
        DocumentoModel::create(['Id' => '123', 'Estado' => EstadoEnum::PENDIENTE->value]);
        $body = [
            'documentoId' => '1234',
            'nuevoEstado' => EstadoEnum::VALIDADO->value
        ];
        $response = $this->postJson('/api/webhook/validar-documento', $body);
        $response->assertStatus(Response::HTTP_NOT_FOUND);
    });

    it('responde con un mensaje de "Documento validado"', function () {
        DocumentoModel::create(['Id' => '123', 'Estado' => EstadoEnum::PENDIENTE->value]);
        $body = [
            'documentoId' => '123',
            'nuevoEstado' => EstadoEnum::VALIDADO->value
        ];
        $response = $this->postJson('/api/webhook/validar-documento', $body);
        $response->assertStatus(Response::HTTP_OK);
        $response->assertJson([
            'mensaje' => 'Documento validado'
        ]);
    });

});
