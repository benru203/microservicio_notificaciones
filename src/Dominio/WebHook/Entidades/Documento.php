<?php

namespace Src\Dominio\WebHook\Entidades;

use Src\Dominio\WebHook\Enums\EstadoEnum;

class Documento {

    private string $id;
    private EstadoEnum $estado;
    
    public function __construct(string $id, EstadoEnum $estado ) {
        $this->id = $id;
        $this->estado = $estado;
    }

    public function getId(): string {
        return $this->id;
    }

    public function getEstado(): EstadoEnum {
        return $this->estado;
    }

    public function cambiarEstado(EstadoEnum $estado): void {
        $this->estado = $estado;
    }
}