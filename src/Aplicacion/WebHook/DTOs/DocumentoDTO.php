<?php

namespace Src\Aplicacion\WebHook\DTOs;

use Src\Dominio\WebHook\Enums\EstadoEnum;

class DocumentoDTO {

    private string $id;
    private string $estado;
    
    public function __construct(string $id, string $estado ) {
        $this->id = $id;
        $this->estado = $estado;
    }

    public function getId(): string {
        return $this->id;
    }

    public function getEstado(): string {
        return $this->estado;
    }
}