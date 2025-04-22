<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Comentario extends Model
{
    use HasFactory;

    protected $table = 'comentarios';
    protected $fillable = [
        'texto',
        'ubicacion',
        'alumno_id',
        'especie_id',
    ];

    public function alumno()
    {
        return $this->belongsTo(User::class, 'alumno_id');
    }

    public function especie()
    {
        return $this->belongsTo(Especie::class);
    }

    public function imagenes()
    {
        return $this->morphMany(Imagen::class, 'imageable');
    }

    public function revisiones()
    {
        return $this->morphMany(Revision::class, 'reviewable');
    }
}
