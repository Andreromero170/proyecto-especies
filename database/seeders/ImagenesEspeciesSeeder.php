<?php
namespace Database\Seeders;

use App\Models\Especie;
use App\Models\Imagen;
use Illuminate\Database\Seeder;

class ImagenesEspeciesSeeder extends Seeder
{
    public function run(): void
    {
        $especies = Especie::all();

        foreach ($especies as $especie) {
            $nombreArchivo = strtolower(str_replace(' ', '-', $especie->nombre_cientifico));

            $ruta = 'img/especies/' . $especie->tipo . '/' . $nombreArchivo . '.jpg';

            Imagen::create([
                'ruta'           => $ruta,
                'es_principal'   => true,
                'imageable_type' => 'App\\Models\\Especie',
                'imageable_id'   => $especie->id,
            ]);

            $this->command->info("Imagen agregada para: " . $especie->nombre_cientifico);
        }
    }
}