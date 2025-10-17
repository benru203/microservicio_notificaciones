<?php

namespace Src\Dominio\ArchivarDocumento\Entidades;

use Src\Dominio\ArchivarDocumento\Enums\EstadoEnum;

class Documento {

    private string $id;
    private EstadoEnum $estado;
    
    public function __construct(string $id ) {
        $this->id = $id;
    }

    public function getId(): string {
        return $this->id;
    }

    public function getEstado(): EstadoEnum {
        return $this->estado;
    }

    public function archivar(): void {
        $this->estado = EstadoEnum::ARCHIVADO;
    }
}