<?php

namespace App\Exceptions\Api\WebHook;

use Exception;

class DocumentoNotFound extends Exception
{
    public function __construct(string $message = "Documento no encontrado")
    {
        parent::__construct($message);
    }
}
