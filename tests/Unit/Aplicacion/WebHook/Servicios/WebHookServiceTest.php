<?php

use Ramsey\Uuid\Uuid;
use Src\Aplicacion\WebHook\DTOs\DocumentoDTO;
use Src\Aplicacion\WebHook\Interfaces\Servicios\IWebHookService;
use Src\Aplicacion\WebHook\Servicios\WebHookService;
use Src\Dominio\WebHook\Entidades\Documento;
use Src\Dominio\WebHook\Enums\EstadoEnum;
use Src\Dominio\WebHook\Interfaces\Repositorios\IDocumentoRepository;

$repositoryMock  = null;
$service = null;

beforeEach(function () {
    $this->repositoryMock  = mock(IDocumentoRepository::class);
    $this->service = new  WebHookService($this->repositoryMock);
});

test('se puede actualizar el estado del documento', function () {
     $id  = Uuid::uuid4()->toString();
    $nuevoEstado = EstadoEnum::VALIDADO;

    $documento = mock(Documento::class);

    $this->repositoryMock
        ->shouldReceive('buscarDocumentoPorId')
        ->once()
        ->with($id)
        ->andReturn($documento);

    $documento
        ->shouldReceive('cambiarEstado')
        ->once()
        ->with($nuevoEstado);

    $this->repositoryMock
        ->shouldReceive('actualizarDocumento')
        ->once()
        ->with($documento);

    $this->service->actualizarEstado(new DocumentoDTO($id, $nuevoEstado->value));

    expect(true)->toBeTrue();
});

test('no se puede actualizar el estado del documento el id no existe', function () {
     $id  = 'invalid-id';

    $this->repositoryMock
        ->shouldReceive('buscarDocumentoPorId')
        ->once()
        ->with($id)
        ->andReturn(null);


    $this->repositoryMock
        ->shouldReceive('actualizarDocumento')
        ->never();

    $documentoDto = new DocumentoDTO($id, EstadoEnum::VALIDADO->value);

    $this->expectException(\Exception::class);
    $this->service->actualizarEstado($documentoDto);
});
