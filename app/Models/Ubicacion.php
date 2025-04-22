<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Ubicacion extends Model
{
    use HasFactory;

    protected $table    = 'ubicaciones';
    protected $fillable = ['nombre', 'descripcion'];

    public function especies()
    {
        return $this->belongsToMany(Especie::class, 'especie_ubicacion');
    }
}