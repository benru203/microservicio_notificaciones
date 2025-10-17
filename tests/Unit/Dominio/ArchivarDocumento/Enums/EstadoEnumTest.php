<?php

use Src\Dominio\WebHook\Enums\EstadoEnum;

test('se espera que los valores del enum de estado sean correctos', function () {
    expect(EstadoEnum::PENDIENTE->value)->toBe('PENDIENTE');
    expect(EstadoEnum::REGISTRADO->value)->toBe('REGISTRADO');
    expect(EstadoEnum::VALIDADO->value)->toBe('VALIDADO');
    expect(EstadoEnum::ARCHIVADO->value)->toBe('ARCHIVADO');
});

test('se puede crear un enum de estado desde un string', function(){
    $estadoString = 'PENDIENTE';
    $estado = EstadoEnum::from($estadoString);
    expect($estado)->toBe(EstadoEnum::PENDIENTE);
});

test('lanza excepción cuando el string es inválido', function () {
    EstadoEnum::from('INVALIDO_NO_EXISTE');
})->throws(\ValueError::class);