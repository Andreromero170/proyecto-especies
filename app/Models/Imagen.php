<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Imagen extends Model
{
    use HasFactory;

    protected $table = 'imagenes';

    protected $fillable = [
        'ruta',
        'es_principal',
        'imageable_type',
        'imageable_id',
    ];

    public function imageable()
    {
        return $this->morphTo();
    }
}