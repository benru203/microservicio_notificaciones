<?php

use Ramsey\Uuid\Uuid;
use Src\Dominio\ArchivarDocumento\Entidades\Documento;
use Src\Dominio\ArchivarDocumento\Enums\EstadoEnum;

test('Se puede crear un documento', function () {
    $id  = Uuid::uuid4()->toString();
    $documento = new Documento($id);

    $reflection = new ReflectionClass($documento);

    $idProperty = $reflection->getProperty('id');
    $idProperty->setAccessible(true);
    expect($idProperty->getValue($documento))->toBe($id);
});

test('Se puede archivar el documento', function () {
    $id  = Uuid::uuid4()->toString();
    $documento = new Documento($id);
    $reflection = new ReflectionClass($documento);
    $estadoProperty = $reflection->getProperty('estado');
    $documento->archivar();
    expect($estadoProperty->getValue($documento))->toBe(EstadoEnum::ARCHIVADO);
});