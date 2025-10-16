<?php

namespace Src\Dominio\WebHook\Enums;

enum EstadoEnum: string {
    case PENDIENTE = "PENDIENTE";
    case REGISTRADO = "REGISTRADO";
    case VALIDADO = "VALIDADO";
    case ARCHIVADO = "ARCHIVADO";
}