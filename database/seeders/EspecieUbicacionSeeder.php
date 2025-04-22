<?php
namespace Database\Seeders;

use App\Models\Especie;
use App\Models\Ubicacion;
use Illuminate\Database\Seeder;

class EspecieUbicacionSeeder extends Seeder
{
    public function run(): void
    {
        $especiesCount    = Especie::count();
        $ubicacionesCount = Ubicacion::count();

        if ($especiesCount == 0) {
            $this->command->error('No hay especies en la base de datos. Ejecuta primero EspecieSeeder.');
            return;
        }

        if ($ubicacionesCount == 0) {
            $this->command->error('No hay ubicaciones en la base de datos. Ejecuta primero UbicacionSeeder.');
            return;
        }

        $especies    = Especie::all();
        $ubicaciones = Ubicacion::all();

        $asignacionesEspecificas = [
            'Oso pardo cantábrico' => [
                'Parque Natural de Somiedo',
                'Parque Natural de Redes',
                'Parque Natural de Ponga',
                'Reserva Natural Integral de Muniellos',
            ],
            'Urogallo cantábrico'  => [
                'Parque Natural de Redes',
                'Parque Natural de Somiedo',
                'Parque Nacional de Picos de Europa',
                'Reserva Natural Integral de Muniellos',
            ],
            'Lobo ibérico'         => [
                'Parque Natural de Somiedo',
                'Valle del Navia',
                'Sierra del Sueve',
                'Parque Natural de Las Ubiñas-La Mesa',
            ],
            'Rebeco cantábrico'    => [
                'Parque Nacional de Picos de Europa',
                'Parque Natural de Somiedo',
                'Parque Natural de Las Ubiñas-La Mesa',
            ],
            'Tejo'                 => [
                'Parque Nacional de Picos de Europa',
                'Parque Natural de Redes',
                'Bosque de Peloño',
            ],
            'Haya'                 => [
                'Hayedo de Montegrande',
                'Parque Natural de Redes',
                'Bosque de Peloño',
                'Parque Natural de Somiedo',
            ],
            'Roble carbayo'        => [
                'Reserva Natural Integral de Muniellos',
                'Parque Natural de Redes',
                'Valle del Nalón',
                'Valle de Teverga',
            ],
            'Narciso de Asturias'  => [
                'Parque Nacional de Picos de Europa',
                'Lagos de Covadonga',
            ],
            'Castaño'              => [
                'Valle del Nalón',
                'Valle de Teverga',
                'Parque Natural de Las Ubiñas-La Mesa',
                'Valle del Navia',
            ],
            'Desmán ibérico'       => [
                'Redes Fluviales del Narcea-Nalón',
                'Parque Natural de Redes',
                'Desfiladero de Las Xanas',
            ],
            'Nutria europea'       => [
                'Ría del Eo',
                'Ría de Villaviciosa',
                'Redes Fluviales del Narcea-Nalón',
            ],
            'Salamandra común'     => [
                'Bosque de Muniellos',
                'Hayedo de Montegrande',
                'Parque Natural de Somiedo',
            ],
            'Águila real'          => [
                'Parque Nacional de Picos de Europa',
                'Parque Natural de Somiedo',
                'Desfiladero de Los Beyos',
            ],
            'Buitre leonado'       => [
                'Parque Nacional de Picos de Europa',
                'Desfiladero de Los Beyos',
                'Parque Natural de Las Ubiñas-La Mesa',
            ],
        ];

        foreach ($especies as $especie) {
            if (array_key_exists($especie->nombre_vernaculo, $asignacionesEspecificas)) {
                $ubicacionesNombres = $asignacionesEspecificas[$especie->nombre_vernaculo];

                foreach ($ubicacionesNombres as $ubicacionNombre) {
                    $ubicacion = $ubicaciones->where('nombre', $ubicacionNombre)->first();

                    if ($ubicacion) {
                        if (! $especie->ubicaciones()->where('ubicacion_id', $ubicacion->id)->exists()) {
                            $especie->ubicaciones()->attach($ubicacion->id);
                        }
                    }
                }
            } else {
                $numUbicaciones = rand(2, 4);

                $ubicacionesAleatorias = $ubicaciones->random($numUbicaciones);

                foreach ($ubicacionesAleatorias as $ubicacion) {
                    if (! $especie->ubicaciones()->where('ubicacion_id', $ubicacion->id)->exists()) {
                        $especie->ubicaciones()->attach($ubicacion->id);
                    }
                }
            }
        }

        $this->command->info('Se han creado con éxito las relaciones entre especies y ubicaciones.');
    }
}