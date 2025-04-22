<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;
use Spatie\Permission\Traits\HasRoles;
use Illuminate\Support\Str;

class User extends Authenticatable
{
    /** @use HasFactory<\Database\Factories\UserFactory> */
    use HasFactory, Notifiable, HasRoles;
    use HasApiTokens;

    /**
     * The attributes that are mass assignable.
     *
     * @var list<string>
     */
    protected $primaryKey = 'id';
    protected $fillable = [
        'nombre',
        'apellidos',
        'codigo_usuario',
        'email',
        'password',
        'rol'
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var list<string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * Get the attributes that should be cast.
     *
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
        ];
    }

    public function especies()
    {
        return $this->hasMany(Especie::class, 'alumno_id');
    }

    public function revisiones()
    {
        return $this->hasMany(Revision::class, 'profesor_id');
    }

    public function comentarios()
    {
        return $this->hasMany(Comentario::class, 'alumno_id');
    }

    public function getRouteKeyName()
    {
        return 'codigo_usuario';
    }

    public static function generarCodigoUnico($nombre, $apellidos)
    {
        $slug = Str::slug($nombre . '-' . $apellidos, '-');
        $codigo = $slug . '-' . rand(1000, 9999);

        while (User::where('codigo_usuario', $codigo)->exists()) {
            $codigo = $slug . '-' . rand(1000, 9999);
        }
        return $codigo;
    }
}
