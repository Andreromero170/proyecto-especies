<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Habitat extends Model
{
    use HasFactory;

    protected $table    = 'habitats';
    protected $fillable = ['nombre', 'descripcion'];

    public function especies()
    {
        return $this->belongsToMany(Especie::class, 'especie_habitat');
    }
}