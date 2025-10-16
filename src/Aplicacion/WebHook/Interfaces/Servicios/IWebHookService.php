<?php

namespace Src\Aplicacion\WebHook\Interfaces\Servicios;

use Src\Aplicacion\WebHook\DTOs\DocumentoDTO;
use Src\Dominio\WebHook\Entidades\Documento;

interface IWebHookService {

    public function actualizarEstado(DocumentoDTO $documentoDto): void;
}