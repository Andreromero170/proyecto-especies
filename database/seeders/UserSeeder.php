<?php
namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    public function run(): void
    {
        $usuarios = [
            [
                'nombre'    => 'Yudith',
                'apellidos' => 'Lorenzo González',
                'email'     => 'yudithlg@educastur.es',
                'password'  => Hash::make('12345678'),
                'rol'       => 'alumno',
            ],
            [
                'nombre'    => 'Miryam',
                'apellidos' => 'García López',
                'email'     => 'miryamgl@educastur.es',
                'password'  => Hash::make('12345678'),
                'rol'       => 'alumno',
            ],
            [
                'nombre'    => 'Encarna',
                'apellidos' => 'González Martínez',
                'email'     => 'encarnagm@educastur.es',
                'password'  => Hash::make('12345678'),
                'rol'       => 'profesor',
            ],
            [
                'nombre'    => 'Lara',
                'apellidos' => 'Fernández Díaz',
                'email'     => 'larafd@educastur.es',
                'password'  => Hash::make('12345678'),
                'rol'       => 'admin',
            ],
        ];

        foreach ($usuarios as $usuario) {
            $codigo_usuario = User::generarCodigoUnico($usuario['nombre'], $usuario['apellidos']);

            User::create([
                'nombre'         => $usuario['nombre'],
                'apellidos'      => $usuario['apellidos'],
                'codigo_usuario' => $codigo_usuario,
                'email'          => $usuario['email'],
                'password'       => $usuario['password'],
                'rol'            => $usuario['rol'],
            ]);
        }
    }
}