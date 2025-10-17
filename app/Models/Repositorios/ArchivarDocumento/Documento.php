<?php

namespace App\Models\Repositorios\ArchivarDocumento;

use Illuminate\Database\Eloquent\Model;

class Documento extends Model
{
    
    protected $table = 'Documentos';

    protected $primaryKey = 'Id';

    protected $fillable = [
        'Id',
        'Estado',
        'FechaRegistro'
    ];

    public $casts = [
        'FechaRegistro' => 'datetime',
    ];

    public $incrementing = false;

    public $timestamps = false;

    protected $keyType = 'string';
}
