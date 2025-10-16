<?php

namespace Src\Dominio\WebHook\Interfaces\Repositorios;

use Src\Dominio\WebHook\Entidades\Documento;

interface IDocumentoRepository {

    public function buscarDocumentoPorId(string $id): ?Documento;

    public function actualizarDocumento(Documento $documento): void;
}