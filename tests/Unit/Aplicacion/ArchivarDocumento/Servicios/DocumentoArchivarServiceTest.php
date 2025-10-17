<?php

use Ramsey\Uuid\Uuid;
use Src\Aplicacion\ArchivarDocumento\DTOs\DocumentoDTO;
use Src\Aplicacion\ArchivarDocumento\Servicios\DocumentoArchivarService;
use Src\Dominio\ArchivarDocumento\Entidades\Documento;
use Src\Dominio\ArchivarDocumento\Enums\EstadoEnum;
use Src\Dominio\ArchivarDocumento\Interfaces\Repositorios\IDocumentoArchivarRepository;

$repositoryMock  = null;
$service = null;

beforeEach(function () {
    $this->repositoryMock  = mock(IDocumentoArchivarRepository::class);
    $this->service = new  DocumentoArchivarService($this->repositoryMock);
});

test('buscar documentos por archivar', function () {
    $documento = mock(Documento::class);
    $this->repositoryMock
        ->shouldReceive('buscarDocumentoPendientePorArchivar')
        ->once()
        ->andReturn([$documento]);

    $this->service->buscarDocumentoPendientePorArchivar();

    expect(true)->toBeTrue();
});

test('actualiza el estado del documento', function () {
    $id = '123'; // valor real UUID
    $dto = new DocumentoDTO($id);
    
    $this->repositoryMock
        ->shouldReceive('archivarDocumento')
        ->once()
        ->with(Mockery::on(function ($documento) use ($id) {
            return $documento instanceof Documento && $documento->getId() === $id;
        }));

    $this->service->archivarDocumento($dto);

    expect(true)->toBeTrue();
});