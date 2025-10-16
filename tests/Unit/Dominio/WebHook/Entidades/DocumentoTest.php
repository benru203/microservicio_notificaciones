<?php

use Ramsey\Uuid\Uuid;
use Src\Dominio\WebHook\Entidades\Documento;
use Src\Dominio\WebHook\Enums\EstadoEnum;

test('Se puede crear un documento', function () {
    $id  = Uuid::uuid4()->toString();
    $estado = EstadoEnum::PENDIENTE;
    $documento = new Documento($id, $estado);

    $reflection = new ReflectionClass($documento);

    $idProperty = $reflection->getProperty('id');
    $idProperty->setAccessible(true);
    expect($idProperty->getValue($documento))->toBe($id);

    $estadoProperty = $reflection->getProperty('estado');
    $estadoProperty->setAccessible(true);
    expect($estadoProperty->getValue($documento))->toBe($estado);
});

test('Se puede cambiar el estado del documento', function () {
    $id  = Uuid::uuid4()->toString();
    $estado = EstadoEnum::PENDIENTE;
    $estadoNuevo = EstadoEnum::REGISTRADO;
    $documento = new Documento($id, $estado);

    $reflection = new ReflectionClass($documento);

    $estadoProperty = $reflection->getProperty('estado');
    $estadoProperty->setAccessible(true);
    expect($estadoProperty->getValue($documento))->toBe($estado);

    $documento->cambiarEstado($estadoNuevo);
    expect($estadoProperty->getValue($documento))->toBe($estadoNuevo);
});