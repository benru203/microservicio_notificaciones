<?php

use App\Models\Repositorios\ArchivarDocumento\Documento as DocumentoModel;
use Carbon\Carbon;
use PhpParser\Node\Stmt\Foreach_;
use Src\Dominio\ArchivarDocumento\Entidades\Documento;
use Src\Dominio\ArchivarDocumento\Enums\EstadoEnum;
use Src\Infraestructura\ArchivarDocumento\Repositorios\DocumentoArchivarRepository;
use Tests\TestCase;

uses(TestCase::class);

beforeEach(function () {
    $this->repository = new DocumentoArchivarRepository();
});


test('buscar documentos por archivar retorna un array de Documento o un array vacio', function () {
    $id = '123';
    $estado = "VALIDADO";

    // Mock de Eloquent
    DocumentoModel::create([
        'Id' => $id,
        'Estado' => $estado
    ]);

    $documentos = $this->repository->buscarDocumentoPendientePorArchivar();
    expect($documentos)->toBeArray();
    foreach ($documentos as $documento) {        
        expect($documento)->toBeInstanceOf(Documento::class)
            ->and($documento->getId())->toBe($id);
    }
});


test('actualizarDocumento actualiza el estado del documento', function () {
    $id = '123';
    $estado = "PENDIENTE";
    // Mock de Eloquent
   $documentoModel = DocumentoModel::create([
        'Id' => $id,
        'Estado' => $estado,
        'FechaRegistro' => Carbon::now()->subDays(91)
    ]);
    $documento = new Documento($id);
    $documento->archivar();
    $this->repository->archivarDocumento($documento);

    $documentoActualizado = DocumentoModel::find($id);

    expect($documentoActualizado)->not->toBeNull()
        ->and($documentoActualizado->Estado)->toBe(EstadoEnum::ARCHIVADO->value);
}); 


afterEach(function () {
    Mockery::close();
});
