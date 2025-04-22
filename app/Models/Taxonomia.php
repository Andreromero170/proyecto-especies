<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Taxonomia extends Model
{
    use HasFactory;

    protected $table = 'taxonomias';

    protected $fillable = [
        'reino',
        'filo_division',
        'clase',
        'orden',
        'familia',
        'genero',
        'slug',
    ];

    protected static function boot()
    {
        parent::boot();

        static::creating(function ($taxonomia) {
            $slug            = Str::slug($taxonomia->genero);
            $taxonomia->slug = $slug;

            $countCoincidencias = static::where('slug', 'LIKE', "$slug%")->count();
            if ($countCoincidencias > 0) {
                $taxonomia->slug = "$slug-$countCoincidencias";
            }
        });
    }

    public function especies()
    {
        return $this->hasMany(Especie::class);
    }

    public function getRouteKeyName()
    {
        return 'slug';
    }
}