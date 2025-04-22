<?php
namespace Database\Seeders;

use App\Models\Especie;
use App\Models\Habitat;
use Illuminate\Database\Seeder;

class EspecieHabitatSeeder extends Seeder
{
    public function run(): void
    {
        $especiesCount = Especie::count();
        $habitatsCount = Habitat::count();

        if ($especiesCount == 0) {
            $this->command->error('No hay especies en la base de datos. Ejecuta primero EspecieSeeder.');
            return;
        }

        if ($habitatsCount == 0) {
            $this->command->error('No hay hábitats en la base de datos. Ejecuta primero HabitatSeeder.');
            return;
        }

        $especies = Especie::all();
        $habitats = Habitat::all();

        $asignacionesEspecificas = [
            'Oso pardo cantábrico' => [
                'Bosque caducifolio atlántico',
                'Hayedo',
                'Robledal',
                'Castañar',
            ],
            'Urogallo cantábrico'  => [
                'Hayedo',
                'Abedular',
                'Robledal',
                'Acebeda',
            ],
            'Lobo ibérico'         => [
                'Bosque caducifolio atlántico',
                'Tojal-brezal',
                'Pastizales de montaña',
                'Matorral de escobas y piornos',
            ],
            'Rebeco cantábrico'    => [
                'Pastizales subalpinos',
                'Roquedos y canchales',
                'Pastizales de montaña',
            ],
            'Tejo'                 => [
                'Hayedo',
                'Robledal',
                'Teixedal',
                'Bosque mixto',
            ],
            'Haya'                 => [
                'Hayedo',
                'Bosque caducifolio atlántico',
            ],
            'Roble carbayo'        => [
                'Robledal',
                'Bosque caducifolio atlántico',
                'Bosque mixto',
            ],
            'Castaño'              => [
                'Castañar',
                'Bosque caducifolio atlántico',
                'Bosque mixto',
            ],
            'Narciso de Asturias'  => [
                'Pastizales de montaña',
                'Pastizales subalpinos',
                'Prados de siega',
            ],
            'Abedul'               => [
                'Abedular',
                'Turberas y tremedales',
                'Bosque caducifolio atlántico',
            ],
            'Acebo'                => [
                'Acebeda',
                'Hayedo',
                'Robledal',
            ],
            'Helecho real'         => [
                'Bosque de ribera',
                'Humedales interiores',
            ],
            'Desmán ibérico'       => [
                'Ríos y arroyos de montaña',
                'Ríos de curso medio',
            ],
            'Nutria europea'       => [
                'Ríos de curso medio',
                'Estuarios y rías',
                'Lagos y lagunas',
            ],
            'Trucha común'         => [
                'Ríos y arroyos de montaña',
                'Ríos de curso medio',
                'Lagos y lagunas',
            ],
            'Salamandra común'     => [
                'Bosque caducifolio atlántico',
                'Hayedo',
                'Ríos y arroyos de montaña',
            ],
            'Tritón jaspeado'      => [
                'Humedales interiores',
                'Lagos y lagunas',
                'Ríos de curso medio',
            ],
            'Águila real'          => [
                'Roquedos y canchales',
                'Pastizales de montaña',
                'Pastizales subalpinos',
            ],
            'Buitre leonado'       => [
                'Roquedos y canchales',
                'Pastizales de montaña',
            ],
            'Lagartija serrana'    => [
                'Roquedos y canchales',
                'Pastizales subalpinos',
            ],
            'Brezo blanco'         => [
                'Tojal-brezal',
                'Matorral de escobas y piornos',
            ],
            'Escoba negra'         => [
                'Tojal-brezal',
                'Matorral de escobas y piornos',
            ],
            'Aliso'                => [
                'Bosque de ribera',
                'Ríos de curso medio',
            ],
            'Sauce blanco'         => [
                'Bosque de ribera',
                'Estuarios y rías',
            ],
            'Junco'                => [
                'Humedales interiores',
                'Turberas y tremedales',
                'Bosque de ribera',
            ],
            'Musgo de turbera'     => [
                'Turberas y tremedales',
                'Humedales interiores',
            ],
            'Libélula de arroyo'   => [
                'Ríos y arroyos de montaña',
                'Ríos de curso medio',
            ],
            'Ciervo volante'       => [
                'Robledal',
                'Castañar',
                'Bosque caducifolio atlántico',
            ],
        ];

        foreach ($especies as $especie) {
            if (array_key_exists($especie->nombre_vernaculo, $asignacionesEspecificas)) {
                $habitatsNombres = $asignacionesEspecificas[$especie->nombre_vernaculo];

                foreach ($habitatsNombres as $habitatNombre) {
                    $habitat = $habitats->where('nombre', $habitatNombre)->first();

                    if ($habitat) {
                        if (! $especie->habitats()->where('habitat_id', $habitat->id)->exists()) {
                            $especie->habitats()->attach($habitat->id);
                        }
                    }
                }
            } else {
                $numHabitats = rand(2, 4);

                if ($especie->tipo == 'flora') {
                    $habitatsAptos = $habitats->filter(function ($habitat) {
                        return in_array($habitat->nombre, [
                            'Bosque caducifolio atlántico', 'Hayedo', 'Robledal', 'Castañar',
                            'Avellaneda', 'Abedular', 'Bosque de ribera', 'Encinar cantábrico',
                            'Alcornocal', 'Bosque mixto', 'Tojal-brezal', 'Matorral de escobas y piornos',
                            'Espinares y zarzales', 'Acebeda', 'Teixedal', 'Prados de siega',
                            'Pastizales de montaña', 'Pastizales subalpinos', 'Turberas y tremedales',
                            'Ríos y arroyos de montaña', 'Ríos de curso medio', 'Humedales interiores',
                            'Setos y linderos', 'Cultivos tradicionales y huertas', 'Prados abandonados y barbechos',
                        ]);
                    });
                } else {
                    $habitatsAptos = $habitats->filter(function ($habitat) {
                        return ! in_array($habitat->nombre, [
                            'Medios urbanos y periurbanos',
                        ]);
                    });
                }

                if ($habitatsAptos->count() >= $numHabitats) {
                    $habitatsAleatorios = $habitatsAptos->random($numHabitats);

                    foreach ($habitatsAleatorios as $habitat) {
                        if (! $especie->habitats()->where('habitat_id', $habitat->id)->exists()) {
                            $especie->habitats()->attach($habitat->id);
                        }
                    }
                } else {
                    foreach ($habitatsAptos as $habitat) {
                        if (! $especie->habitats()->where('habitat_id', $habitat->id)->exists()) {
                            $especie->habitats()->attach($habitat->id);
                        }
                    }
                }
            }
        }

        $this->command->info('Se han creado con éxito las relaciones entre especies y hábitats.');
    }
}