<?php

namespace Src\Dominio\ArchivarDocumento\Interfaces\Repositorios;

use Src\Dominio\ArchivarDocumento\Entidades\Documento;

interface IDocumentoArchivarRepository {

    /**
     * Busca los documentos pendientes por archivar.
     *
     * @return Documento[]
     */
    public function buscarDocumentoPendientePorArchivar():array;

    public function archivarDocumento(Documento $documento): void;
}