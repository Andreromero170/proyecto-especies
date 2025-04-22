<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Revision extends Model
{
    use HasFactory;

    protected $table    = 'revisiones';
    protected $fillable = [
        'veredicto',
        'comentario_profesor',
        'profesor_id',
        'reviewable_id',
        'reviewable_type'];

    public function reviewable()
    {
        return $this->morphTo();
    }

    public function profesor()
    {
        return $this->belongsTo(User::class, 'profesor_id');
    }
}