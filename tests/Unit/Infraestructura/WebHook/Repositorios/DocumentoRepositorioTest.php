<?php

use App\Models\Repositorios\WebHook\Documento as DocumentoModel;
use Dom\Document;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Src\Dominio\WebHook\Entidades\Documento;
use Src\Dominio\WebHook\Enums\EstadoEnum;
use Src\Infraestructura\Repositorios\DocumentoRepository;
use Tests\TestCase;

uses(TestCase::class);

beforeEach(function () {
    $this->repository = new DocumentoRepository();
});


test('buscarDocumentoPorId retorna un Documento cuando existe', function () {
    $id = '123';
    $estado = EstadoEnum::VALIDADO;

    // Mock de Eloquent
   $documentoModel = DocumentoModel::create([
        'Id' => $id,
        'Estado' => $estado->value
    ]);

    $documento = $this->repository->buscarDocumentoPorId($documentoModel->Id);

    expect($documento)->toBeInstanceOf(Documento::class)
        ->and($documento->getId())->toBe($id)
        ->and($documento->getEstado())->toBe(EstadoEnum::VALIDADO);
});

test('buscarDocumentoPorId retorna null cuando no existe', function () {
    $id = '123';
    
    $documento = $this->repository->buscarDocumentoPorId($id);

    expect($documento)->toBeNull();
});

test('actualizarDocumento actualiza el estado del documento', function () {
    $id = '123';
    $estado = EstadoEnum::VALIDADO;

    // Mock de Eloquent
   $documentoModel = DocumentoModel::create([
        'Id' => $id,
        'Estado' => $estado->value
    ]);
    $documentoDto = new Documento($documentoModel->Id, EstadoEnum::PENDIENTE);
    $this->repository->actualizarDocumento($documentoDto);

    $documentoActualizado = DocumentoModel::find($id);

    expect($documentoActualizado)->not->toBeNull()
        ->and($documentoActualizado->Estado)->toBe(EstadoEnum::PENDIENTE->value);
});


afterEach(function () {
    Mockery::close();
});
