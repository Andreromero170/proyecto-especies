<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Support\Str;

class Especie extends Model
{
    use HasFactory;

    protected $table = 'especies';

    protected $fillable = [
        'tipo', 'nombre_cientifico', 'nombre_vernaculo', 'slug', 'descripcion',
        'estado', 'taxonomia_id', 'alumno_id'
    ];
    

    public static function boot()
    {
        parent::boot();

        static::creating(function ($especie) {
            // Si no se pasa un slug, generamos uno automáticamente
            if (empty($especie->slug)) {
                $especie->slug = Str::slug($especie->nombre_cientifico);
            }
        });
    }

    public function taxonomia()
    {
        return $this->belongsTo(Taxonomia::class);
    }

    public function alumno()
    {
        return $this->belongsTo(User::class, 'alumno_id');
    }

    public function revisiones()
    {
        return $this->morphMany(Revision::class, 'reviewable');
    }

    public function comentarios()
    {
        return $this->hasMany(Comentario::class);
    }

    public function imagenes()
    {
        return $this->morphMany(Imagen::class, 'imageable');
    }


    public function imagenPrincipal()
    {
        return $this->morphOne(Imagen::class, 'imageable')
                    ->where('es_principal', true);
    }

    public function ubicaciones()
    {
        return $this->belongsToMany(Ubicacion::class, 'especie_ubicacion');
    }

    public function habitats()
    {
        return $this->belongsToMany(Habitat::class, 'especie_habitat');
    }

    public function getRouteKeyName()
    {
        return 'slug';
    }
}