<?php
namespace Database\Seeders;

use App\Models\Habitat;
use Illuminate\Database\Seeder;

class HabitatSeeder extends Seeder
{
    public function run(): void
    {
        $habitats = [
            [
                'nombre'      => 'Bosque caducifolio atlántico',
                'descripcion' => 'Formación boscosa dominada por especies de hoja caduca adaptadas al clima húmedo atlántico. Caracterizada por robles, hayas, castaños y abedules, con un sotobosque rico en helechos, musgos y plantas herbáceas. Alberga gran diversidad de fauna como corzo, jabalí y numerosas aves forestales.',
            ],
            [
                'nombre'      => 'Hayedo',
                'descripcion' => 'Bosque dominado por hayas (Fagus sylvatica), con escaso sotobosque debido a la densa sombra que proyectan. El suelo suele estar cubierto de hojarasca y el interior presenta un aspecto majestuoso, especialmente en otoño. Importante para especies como pito negro, corzo y pequeños mamíferos.',
            ],
            [
                'nombre'      => 'Robledal',
                'descripcion' => 'Bosque dominado por diferentes especies de robles (principalmente Quercus robur y Quercus petraea en Asturias). Posee un rico sotobosque y sustenta una elevada biodiversidad. Estos bosques son refugio para numerosas especies de aves, mamíferos e invertebrados, incluidos insectos saproxílicos.',
            ],
            [
                'nombre'      => 'Castañar',
                'descripcion' => 'Bosque dominado por castaños (Castanea sativa), en su mayoría de origen antrópico por su valor económico tradicional. Alberga una rica biodiversidad y tiene gran importancia cultural en Asturias. Muchos son centenarios y forman espacios de gran valor ecológico.',
            ],
            [
                'nombre'      => 'Avellaneda',
                'descripcion' => 'Formación dominada por avellanos (Corylus avellana), generalmente en forma de bosquetes o en linderos de otros bosques. Importante para pequeños mamíferos y aves, sus frutos son un recurso alimenticio esencial para muchas especies.',
            ],
            [
                'nombre'      => 'Abedular',
                'descripcion' => 'Bosque dominado por abedules (Betula alba/pendula), a menudo presente en zonas de recolonización o tras perturbaciones. Su característica corteza blanca y aspecto luminoso contrasta con otros bosques. Importante para aves como el camachuelo común y diversos insectos.',
            ],
            [
                'nombre'      => 'Bosque de ribera',
                'descripcion' => 'Formación boscosa que crece junto a ríos y arroyos, dominada por alisos (Alnus glutinosa), fresnos (Fraxinus excelsior), sauces (Salix sp.) y chopos (Populus sp.). Fundamental como corredor ecológico y para especies como la nutria, martín pescador y numerosos anfibios.',
            ],
            [
                'nombre'      => 'Encinar cantábrico',
                'descripcion' => 'Bosque perennifolio dominado por encinas (Quercus ilex) adaptado a condiciones especiales como suelos calizos o laderas secas. Poco común en Asturias pero de gran interés ecológico. Alberga especies típicamente mediterráneas en un entorno atlántico.',
            ],
            [
                'nombre'      => 'Alcornocal',
                'descripcion' => 'Bosque dominado por alcornoques (Quercus suber), muy localizado en zonas de influencia mediterránea del suroccidente asturiano. Representa un hábitat relicto de gran interés biogeográfico, con especies vegetales y animales poco comunes en la región.',
            ],
            [
                'nombre'      => 'Bosque mixto',
                'descripcion' => 'Formación boscosa con presencia simultánea de diversas especies arbóreas (robles, fresnos, arces, tilos, castaños, etc.) sin claro dominio de ninguna. Suele presentar gran biodiversidad por la variedad de nichos ecológicos que ofrece.',
            ],
            [
                'nombre'      => 'Tojal-brezal',
                'descripcion' => 'Matorral dominado por tojos (Ulex europaeus) y diversas especies de brezos (Erica sp., Calluna vulgaris). Aparece tras la degradación de bosques o en zonas de suelos pobres. Importante para reptiles, algunas aves como la curruca rabilarga y polinizadores.',
            ],
            [
                'nombre'      => 'Matorral de escobas y piornos',
                'descripcion' => 'Formación arbustiva dominada por leguminosas como escobas (Cytisus sp.) y piornos (Genista sp.), típica de zonas montañosas. Fija nitrógeno en el suelo y es clave en procesos de sucesión ecológica. Proporciona refugio y alimento a numerosas especies.',
            ],
            [
                'nombre'      => 'Espinares y zarzales',
                'descripcion' => 'Formaciones arbustivas densas dominadas por especies espinosas como zarzas (Rubus sp.), espinos (Crataegus sp.) y rosales silvestres (Rosa sp.). Importantes para nidificación de pequeñas aves y como fuente de alimento (bayas) para muchas especies.',
            ],
            [
                'nombre'      => 'Acebeda',
                'descripcion' => 'Bosquetes dominados por acebos (Ilex aquifolium), de gran valor ecológico por ofrecer refugio y alimento invernal a numerosas especies. Sus bayas son importantes para aves como zorzales y mirlos durante el invierno.',
            ],
            [
                'nombre'      => 'Teixedal',
                'descripcion' => 'Bosquete dominado por tejos (Taxus baccata), árbol longevo y de crecimiento lento. Muy localizado en Asturias, forma hábitats de extraordinario valor ecológico y cultural. A pesar de su toxicidad, sus frutos son consumidos por algunas aves.',
            ],
            [
                'nombre'      => 'Prados de siega',
                'descripcion' => 'Formaciones herbáceas seminaturales mantenidas por la acción humana (siega y abonado) para obtención de heno. Albergan gran diversidad florística y son importantes para insectos polinizadores, pequeños mamíferos y aves como la tarabilla común.',
            ],
            [
                'nombre'      => 'Pastizales de montaña',
                'descripcion' => 'Formaciones herbáceas naturales o seminaturales situadas por encima del límite del bosque o en zonas deforestadas de montaña. Importante para herbívoros como rebecos y caballos salvajes (asturcones), así como para insectos y aves rapaces.',
            ],
            [
                'nombre'      => 'Pastizales subalpinos',
                'descripcion' => 'Formaciones herbáceas situadas en las zonas más altas de las montañas asturianas, adaptadas a condiciones climáticas extremas. Presentan especies especializadas y son el hábitat del rebeco cantábrico y aves como el acentor alpino y la perdiz pardilla.',
            ],
            [
                'nombre'      => 'Turberas y tremedales',
                'descripcion' => 'Humedales ácidos caracterizados por la acumulación de materia orgánica (turba) y presencia de esfagnos y otras plantas especializadas. Hábitat de gran interés con flora y fauna muy específica, incluidas plantas carnívoras como Drosera rotundifolia.',
            ],
            [
                'nombre'      => 'Ríos y arroyos de montaña',
                'descripcion' => 'Cursos fluviales de aguas rápidas, frías y bien oxigenadas que discurren por fuertes pendientes. Característicos por fondos pedregosos y especies adaptadas a la corriente como la trucha común, el mirlo acuático y el desmán ibérico.',
            ],
            [
                'nombre'      => 'Ríos de curso medio',
                'descripcion' => 'Tramos fluviales con caudal más regular y velocidad moderada. Presentan mayor diversidad de microhábitats y especies que los tramos altos. Importantes para especies como salmón atlántico, nutria y diversas aves acuáticas.',
            ],
            [
                'nombre'      => 'Estuarios y rías',
                'descripcion' => 'Zonas de transición entre los ríos y el mar, con mezcla de agua dulce y salada e influencia de las mareas. Presentan diversos subhábitats como marismas, fangales y bancos de arena. Cruciales para aves migratorias, peces y moluscos.',
            ],
            [
                'nombre'      => 'Lagos y lagunas',
                'descripcion' => 'Masas de agua dulce estancada, principalmente de origen glaciar en Asturias. Albergan comunidades específicas de plantas acuáticas, invertebrados, anfibios y aves acuáticas. Los más representativos son los Lagos de Covadonga y los de Somiedo.',
            ],
            [
                'nombre'      => 'Playas y sistemas dunares',
                'descripcion' => 'Depósitos de arena en la costa con vegetación especializada adaptada a la salinidad, sequedad y movilidad del sustrato. Importantes para aves limícolas, plantas psammófilas y diversos invertebrados especializados.',
            ],
            [
                'nombre'      => 'Acantilados costeros',
                'descripcion' => 'Formaciones rocosas verticales o subverticales en contacto con el mar, sometidas a la acción del oleaje y la salinidad. Albergan comunidades vegetales halófilas y son importantes para la nidificación de aves marinas como el cormorán moñudo.',
            ],
            [
                'nombre'      => 'Rasas costeras',
                'descripcion' => 'Plataformas de abrasión marina elevadas por movimientos tectónicos, características del litoral asturiano. Presentan una vegetación adaptada a suelos delgados y vientos marinos. Importantes para flora especializada y algunas aves costeras.',
            ],
            [
                'nombre'      => 'Marismas y fangales costeros',
                'descripcion' => 'Zonas húmedas costeras inundadas periódicamente por las mareas, con sedimentos finos y vegetación halófila. Cruciales para aves limícolas, peces y diversos invertebrados. Actúan como zonas de alimentación, refugio y reproducción.',
            ],
            [
                'nombre'      => 'Cuevas y sistemas kársticos',
                'descripcion' => 'Formaciones subterráneas en terrenos calizos con condiciones ambientales estables y ausencia de luz. Albergan fauna especializada como murciélagos y diversos invertebrados cavernícolas, algunos endémicos. En Asturias existen numerosos sistemas kársticos de importancia.',
            ],
            [
                'nombre'      => 'Roquedos y canchales',
                'descripcion' => 'Afloramientos rocosos y acumulaciones de bloques producto de la erosión, con vegetación especializada en fisuras y repisas. Importantes para especies rupícolas como águila real, buitre leonado, treparriscos y diversas plantas saxícolas.',
            ],
            [
                'nombre'      => 'Fondos marinos rocosos',
                'descripcion' => 'Sustratos duros sumergidos en el mar que albergan comunidades diversas de algas, invertebrados y peces. Forman ecosistemas complejos como bosques de algas y arrecifes. Son el hábitat de especies como el pulpo común y la lubina.',
            ],
            [
                'nombre'      => 'Setos y linderos',
                'descripcion' => 'Formaciones lineales de arbustos y pequeños árboles que separan parcelas agrícolas. Actúan como refugio de biodiversidad y corredores ecológicos en paisajes humanizados. Importantes para aves, pequeños mamíferos e insectos polinizadores.',
            ],
            [
                'nombre'      => 'Cultivos tradicionales y huertas',
                'descripcion' => 'Zonas de cultivo a pequeña escala, generalmente con métodos tradicionales y baja intensidad. Pueden albergar una interesante biodiversidad asociada, especialmente insectos polinizadores, aves como el jilguero y pequeños mamíferos.',
            ],
            [
                'nombre'      => 'Prados abandonados y barbechos',
                'descripcion' => 'Zonas anteriormente cultivadas o segadas que han sido abandonadas y se encuentran en proceso de sucesión ecológica. Importante para muchas especies pioneras, insectos y como zona de caza para aves rapaces y mamíferos carnívoros.',
            ],
            [
                'nombre'      => 'Medios urbanos y periurbanos',
                'descripcion' => 'Hábitats antropizados donde algunas especies se han adaptado a convivir con los humanos. Parques, jardines y edificaciones pueden albergar especies como vencejos, golondrinas, murciélagos urbanos y diversa flora ruderal.',
            ],
            [
                'nombre'      => 'Humedales interiores',
                'descripcion' => 'Zonas encharcadas permanente o temporalmente, como pequeñas lagunas, charcas y zonas pantanosas. Fundamentales para anfibios, plantas hidrófilas, libélulas y otros invertebrados acuáticos.',
            ],
        ];

        foreach ($habitats as $habitat) {
            Habitat::create($habitat);
        }
    }
}