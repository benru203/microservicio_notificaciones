<?php

namespace Src\Aplicacion\ArchivarDocumento\Servicios;

use Src\Aplicacion\ArchivarDocumento\DTOs\DocumentoDTO;
use Src\Aplicacion\ArchivarDocumento\Interfaces\Servicios\IDocumentoArchivarService;
use Src\Dominio\ArchivarDocumento\Entidades\Documento;
use Src\Dominio\ArchivarDocumento\Enums\EstadoEnum;
use Src\Dominio\ArchivarDocumento\Interfaces\Repositorios\IDocumentoArchivarRepository;

class DocumentoArchivarService implements IDocumentoArchivarService {

    private IDocumentoArchivarRepository $documentoArchivarRepository;

    public function __construct(IDocumentoArchivarRepository $documentoArchivarRepository) {
        $this->documentoArchivarRepository = $documentoArchivarRepository;
    }

    public function archivarDocumento(DocumentoDTO $documento): void{
        $documentoArchivado = new Documento($documento->getId());
        $documentoArchivado->archivar();
        $this->documentoArchivarRepository->archivarDocumento($documentoArchivado);
    }

    /**
     * Busca los documentos pendientes por archivar.
     *
     * @return Documento[]
     */
    public function buscarDocumentoPendientePorArchivar():array{
        $documentos = $this->documentoArchivarRepository->buscarDocumentoPendientePorArchivar();
        return $documentos;
    }

}