<?php

namespace Src\Aplicacion\ArchivarDocumento\Interfaces\Servicios;

use Src\Aplicacion\ArchivarDocumento\DTOs\DocumentoDTO;

interface IDocumentoArchivarService {

    public function archivarDocumento(DocumentoDTO $documento): void;

    public function buscarDocumentoPendientePorArchivar():array;
}