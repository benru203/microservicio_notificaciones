<?php

namespace Src\Aplicacion\ArchivarDocumento\DTOs;

use Src\Dominio\ArchivarDocumento\Enums\EstadoEnum;

class DocumentoDTO {

    private string $id;
    
    public function __construct(string $id ) {
        $this->id = $id;
    }

    public function getId(): string {
        return $this->id;
    }
}