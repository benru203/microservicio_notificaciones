<?php

namespace Src\Aplicacion\WebHook\Servicios;

use Exception;
use Src\Aplicacion\WebHook\DTOs\DocumentoDTO;
use Src\Aplicacion\WebHook\Interfaces\Servicios\IWebHookService;
use Src\Dominio\WebHook\Enums\EstadoEnum;
use Src\Dominio\WebHook\Interfaces\Repositorios\IDocumentoRepository;

class WebHookService implements IWebHookService {

    private IDocumentoRepository $documentoRepository;

    public function __construct(IDocumentoRepository $documentoRepository) {
        $this->documentoRepository = $documentoRepository;
    }

    public function actualizarEstado(DocumentoDTO $documentoDto): void {
        $documento = $this->documentoRepository->buscarDocumentoPorId($documentoDto->getId());
        if ($documento === null) {
            throw new Exception("No se pudo encontrar el documento con id {$documentoDto->getId()}");
        }
        $documento->cambiarEstado(EstadoEnum::from($documentoDto->getEstado()));
        $this->documentoRepository->actualizarDocumento($documento);
    }
}