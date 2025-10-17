<?php

namespace App\Models\Repositorios\WebHook;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Documento extends Model
{
    use HasFactory;
    
    protected $table = 'Documentos';

    protected $primaryKey = 'Id';

    protected $fillable = [
        'Id',
        'Estado'
    ];

    public $incrementing = false;

    public $timestamps = false;

    protected $keyType = 'string';
}
