<?php
namespace Database\Seeders;

use App\Models\Ubicacion;
use Illuminate\Database\Seeder;

class UbicacionSeeder extends Seeder
{
    public function run(): void
    {
        $ubicaciones = [
            [
                'nombre'      => 'Parque Natural de Somiedo',
                'descripcion' => 'Primer espacio protegido de Asturias declarado Parque Natural en 1988. Contiene una gran variedad de ecosistemas y es Reserva de la Biosfera. Destacan sus lagos glaciares y la presencia de oso pardo cantábrico.',
            ],
            [
                'nombre'      => 'Parque Natural de Redes',
                'descripcion' => 'Ubicado en el sureste de Asturias, entre los concejos de Caso y Sobrescobio. Declarado Parque Natural en 1996 y Reserva de la Biosfera en 2001. Es una zona montañosa con bosques bien conservados y una importante población de especies protegidas.',
            ],
            [
                'nombre'      => 'Parque Natural de Ponga',
                'descripcion' => 'Declarado en 2003, este parque natural se caracteriza por sus abruptos relieves, profundos desfiladeros y extensos bosques de hayas y robles. Posee una rica biodiversidad y es parte del corredor del oso pardo.',
            ],
            [
                'nombre'      => 'Parque Natural de Las Ubiñas-La Mesa',
                'descripcion' => 'El más reciente de los parques naturales asturianos, declarado en 2006. Situado en la zona sur-central de Asturias, destaca por sus paisajes kársticos, macizos montañosos y bosques caducifolios.',
            ],
            [
                'nombre'      => 'Parque Nacional de Picos de Europa',
                'descripcion' => 'Primer parque nacional español, creado en 1918. Con cumbres que superan los 2.600 metros, es el mayor macizo calcáreo de la Europa Atlántica. Alberga especies emblemáticas como el urogallo, el oso pardo y el lobo ibérico.',
            ],
            [
                'nombre'      => 'Reserva Natural Integral de Muniellos',
                'descripcion' => 'El mayor robledal de España y uno de los mejor conservados de Europa. De acceso restringido (solo 20 personas al día), es un espacio de extraordinario valor ecológico ubicado en los concejos de Cangas del Narcea e Ibias.',
            ],
            [
                'nombre'      => 'Reserva Natural Parcial de Barayo',
                'descripcion' => 'Situada entre los concejos de Valdés y Navia, esta pequeña reserva incluye una de las playas más salvajes de Asturias, un estuario, dunas y acantilados. Es un importante refugio para aves migratorias.',
            ],
            [
                'nombre'      => 'Paisaje Protegido de Cabo Peñas',
                'descripcion' => 'Situado en el concejo de Gozón, comprende una franja costera de acantilados y pequeñas calas. Es un importante punto para la observación de aves marinas y migratorias.',
            ],
            [
                'nombre'      => 'Paisaje Protegido del Cuera',
                'descripcion' => 'Sierra litoral situada en el oriente de Asturias que forma una barrera montañosa paralela al mar Cantábrico. Destaca por sus formaciones kársticas y pastizales de alta montaña.',
            ],
            [
                'nombre'      => 'Paisaje Protegido de las Cuencas Mineras',
                'descripcion' => 'Zona que comprende un paisaje transformado por la actividad minera histórica. Incluye bosques, valles y elementos patrimoniales industriales en los concejos de Mieres, San Martín del Rey Aurelio, Laviana y Langreo.',
            ],
            [
                'nombre'      => 'Sierra del Sueve',
                'descripcion' => 'Macizo montañoso costero que se eleva cerca del mar Cantábrico. Conocido por albergar una pequeña población de caballos salvajes (asturcones) y por sus extensos bosques de hayas y acebos.',
            ],
            [
                'nombre'      => 'Valle del Nalón',
                'descripcion' => 'Principal cuenca fluvial del centro de Asturias que atraviesa importantes zonas industriales y mineras. Sus riberas albergan bosques de galería bien conservados y una fauna fluvial diversa.',
            ],
            [
                'nombre'      => 'Valle del Navia',
                'descripcion' => 'Importante valle fluvial del occidente asturiano. El río Navia, represado en varios puntos, crea embalses como el de Grandas de Salime. La zona conserva bosques atlánticos y cultivos tradicionales.',
            ],
            [
                'nombre'      => 'Desfiladero de Las Xanas',
                'descripcion' => 'Estrecha garganta caliza situada en el concejo de Santo Adriano. Con paredes verticales de hasta 500 metros, es un importante destino para senderismo y escalada.',
            ],
            [
                'nombre'      => 'Desfiladero de Los Beyos',
                'descripcion' => 'Profunda garganta excavada por el río Sella entre Asturias y León. Sus impresionantes paredes verticales crean un paisaje espectacular entre los Picos de Europa y el Parque Natural de Ponga.',
            ],
            [
                'nombre'      => 'Ría de Villaviciosa',
                'descripcion' => 'Estuario de gran valor ecológico en la costa central de Asturias. Declarada Reserva Natural Parcial, es un humedal importante para aves acuáticas y migratorias, con marismas y diversas comunidades vegetales.',
            ],
            [
                'nombre'      => 'Ría del Eo',
                'descripcion' => 'Estuario que forma la frontera entre Asturias y Galicia. Declarada Reserva Natural Parcial y Humedal RAMSAR, es un importante punto para la avifauna y contiene bosques de ribera y extensas marismas.',
            ],
            [
                'nombre'      => 'Costa oriental asturiana',
                'descripcion' => 'Tramo costero entre Ribadesella y Llanes, caracterizado por sus espectaculares acantilados, pequeñas calas y playas como la de Gulpiyuri (playa interior). Importante zona kárstica con numerosas cuevas.',
            ],
            [
                'nombre'      => 'Costa central asturiana',
                'descripcion' => 'Zona costera que incluye el cabo de Peñas y playas emblemáticas como Salinas y San Lorenzo. Combina acantilados con extensas playas de arena y pequeños puertos pesqueros tradicionales.',
            ],
            [
                'nombre'      => 'Costa occidental asturiana',
                'descripcion' => 'Tramo costero más salvaje y menos urbanizado, desde Cudillero hasta Tapia de Casariego. Destacan playas como Cadavedo, Barayo y Penarronda, así como acantilados y pequeñas calas.',
            ],
            [
                'nombre'      => 'Playa de Rodiles',
                'descripcion' => 'Una de las playas más extensas y populares de Asturias, situada en la desembocadura de la ría de Villaviciosa. Combina zona de marisma con un extenso arenal y dunas protegidas.',
            ],
            [
                'nombre'      => 'Lagos de Covadonga',
                'descripcion' => 'Lagos glaciares Enol y Ercina, situados en el macizo occidental de los Picos de Europa. Rodeados de pastos alpinos y bosques de haya, constituyen uno de los paisajes más emblemáticos de Asturias.',
            ],
            [
                'nombre'      => 'Lagos de Somiedo',
                'descripcion' => 'Conjunto de lagos de origen glaciar (Lago del Valle, Calabazosa, Cerveriz, La Cueva) situados en el Parque Natural de Somiedo. Representan el conjunto lacustre más importante de Asturias.',
            ],
            [
                'nombre'      => 'Bosque de Muniellos',
                'descripcion' => 'Mayor robledal de España y uno de los mejor conservados de Europa. Alberga una extraordinaria biodiversidad, con más de 1.500 especies de invertebrados y unas 200 especies de vertebrados.',
            ],
            [
                'nombre'      => 'Monte Naranco',
                'descripcion' => 'Elevación situada al norte de Oviedo, conocida por sus monumentos prerrománicos (Santa María del Naranco y San Miguel de Lillo) y por ser una importante área recreativa y de valor ecológico para la ciudad.',
            ],
            [
                'nombre'      => 'Hayedo de Montegrande',
                'descripcion' => 'Situado en el concejo de Teverga, es uno de los hayedos más extensos y mejor conservados de Asturias. Sus hayas centenarias crean un bosque de aspecto mágico, especialmente en otoño.',
            ],
            [
                'nombre'      => 'Bosque de Peloño',
                'descripcion' => 'Ubicado en el concejo de Ponga, es un extenso hayedo maduro considerado uno de los mejor conservados de la cordillera Cantábrica. Importante refugio para especies como el oso pardo y el urogallo.',
            ],
            [
                'nombre'      => 'Senda Costera del Cantábrico',
                'descripcion' => 'Ruta que recorre el litoral asturiano, atravesando acantilados, playas, pueblos pesqueros y ensenadas. Permite conocer la diversidad de ecosistemas costeros de la región.',
            ],
            [
                'nombre'      => 'Valle de Teverga',
                'descripcion' => 'Valle montañoso en el sur de Asturias, conocido por sus bosques, la Senda del Oso y las cuevas prehistóricas de Huerta. Forma parte del Parque Natural de Las Ubiñas-La Mesa.',
            ],
            [
                'nombre'      => 'Redes Fluviales del Narcea-Nalón',
                'descripcion' => 'Principal sistema fluvial de Asturias, con ríos salmoneros que atraviesan diversos ecosistemas desde la alta montaña hasta la costa. Importantes para especies como el salmón atlántico y la nutria.',
            ],
        ];

        foreach ($ubicaciones as $ubicacion) {
            Ubicacion::create($ubicacion);
        }
    }
}