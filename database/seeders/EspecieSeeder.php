<?php
namespace Database\Seeders;

use App\Models\Especie;
use App\Models\Taxonomia;
use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

class EspecieSeeder extends Seeder
{
    public function run(): void
    {
        if (Taxonomia::count() === 0) {
            $this->command->error('No hay taxonomías en la base de datos. Ejecuta primero el TaxonomiaSeeder.');
            return;
        }

        $alumnosIds = User::where('rol', 'alumno')->whereIn('id', [1, 2])->pluck('id')->toArray();
        if (empty($alumnosIds)) {
            $this->command->error('No hay usuarios con rol de alumno y IDs 1 o 2. Las especies requieren un alumno_id.');
            return;
        }

        $especiesFlora = [
            [
                'tipo'              => 'flora',
                'nombre_cientifico' => 'Taxus baccata',
                'nombre_vernaculo'  => 'Tejo',
                'descripcion'       => 'Árbol perennifolio que puede alcanzar los 20 metros de altura, de crecimiento lento y gran longevidad (algunos ejemplares superan los 1.000 años). Su madera es muy apreciada por su dureza y elasticidad. En Asturias forma pequeños bosquetes llamados "teixedales", considerados espacios sagrados en la cultura tradicional. Todas sus partes son tóxicas excepto el arilo rojo que rodea la semilla.',
                'genero_taxonomia'  => 'Taxus',
                'estado'            => 'aprobada',
            ],
            [
                'tipo'              => 'flora',
                'nombre_cientifico' => 'Quercus robur',
                'nombre_vernaculo'  => 'Roble carbayo',
                'descripcion'       => 'Árbol caducifolio de gran porte que puede alcanzar los 40 metros de altura. Sus hojas tienen lóbulos redondeados y sus bellotas crecen sobre largos pedúnculos. Es una especie emblemática de los bosques atlánticos asturianos y proporciona cobijo y alimento a numerosas especies animales. Su madera es muy valorada para construcción y tonelería.',
                'genero_taxonomia'  => 'Quercus',
                'estado'            => 'aprobada',
            ],
            [
                'tipo'              => 'flora',
                'nombre_cientifico' => 'Quercus petraea',
                'nombre_vernaculo'  => 'Roble albar',
                'descripcion'       => 'Árbol caducifolio similar al carbayo pero con hojas de pecíolo más largo y bellotas sésiles o con pedúnculo muy corto. En Asturias aparece en zonas más altas y secas que el carbayo, formando bosques mixtos con hayas y abedules. Su madera es similar a la del carbayo y tradicionalmente se ha usado para construcción y leña.',
                'genero_taxonomia'  => 'Quercus',
                'estado'            => 'pendiente',
            ],
            [
                'tipo'              => 'flora',
                'nombre_cientifico' => 'Quercus pyrenaica',
                'nombre_vernaculo'  => 'Rebollo',
                'descripcion'       => 'Árbol caducifolio que puede alcanzar los 25 metros, con hojas profundamente lobuladas y cubiertas de un denso tomento que les da un aspecto aterciopelado. En Asturias aparece principalmente en el sur y occidente, en zonas de transición entre los climas atlántico y mediterráneo. Sus bellotas son importantes para la alimentación de la fauna silvestre.',
                'genero_taxonomia'  => 'Quercus',
                'estado'            => 'aprobada',
            ],
            [
                'tipo'              => 'flora',
                'nombre_cientifico' => 'Quercus ilex',
                'nombre_vernaculo'  => 'Encina',
                'descripcion'       => 'Árbol perennifolio que puede alcanzar los 25 metros de altura. Sus hojas son coriáceas, de color verde oscuro por el haz y blanquecinas por el envés. En Asturias forma pequeños encinares en zonas con suelos calizos y condiciones más secas, principalmente en la zona centro-oriental. Es un árbol longevo que puede vivir varios siglos.',
                'genero_taxonomia'  => 'Quercus',
                'estado'            => 'pendiente',
            ],
            [
                'tipo'              => 'flora',
                'nombre_cientifico' => 'Fagus sylvatica',
                'nombre_vernaculo'  => 'Haya',
                'descripcion'       => 'Árbol caducifolio que puede alcanzar los 40 metros de altura. Su corteza es lisa y grisácea, y sus hojas son ovales con el borde ondulado. Los hayedos asturianos tienen gran importancia ecológica y forman espectaculares bosques, especialmente hermosos en otoño cuando sus hojas adquieren tonalidades doradas y cobrizas. Sus frutos, los hayucos, son importantes para la fauna silvestre.',
                'genero_taxonomia'  => 'Fagus',
                'estado'            => 'aprobada',
            ],
            [
                'tipo'              => 'flora',
                'nombre_cientifico' => 'Castanea sativa',
                'nombre_vernaculo'  => 'Castaño',
                'descripcion'       => 'Árbol caducifolio que puede alcanzar los 35 metros de altura. Introducido por los romanos, se ha naturalizado por toda Asturias y forma parte esencial de su paisaje y cultura. Su fruto, la castaña, ha sido un alimento básico en la dieta tradicional asturiana. Muchos ejemplares centenarios presentan troncos huecos que sirven de refugio a diversas especies animales.',
                'genero_taxonomia'  => 'Castanea',
                'estado'            => 'aprobada',
            ],
            [
                'tipo'              => 'flora',
                'nombre_cientifico' => 'Betula alba',
                'nombre_vernaculo'  => 'Abedul',
                'descripcion'       => 'Árbol caducifolio que puede alcanzar los 25 metros de altura, inconfundible por su corteza blanca que se desprende en láminas horizontales. En Asturias es común en zonas de montaña, bordes de bosques y áreas quemadas o taladas, siendo una especie pionera en la recolonización forestal. Su savia se ha utilizado tradicionalmente con fines medicinales.',
                'genero_taxonomia'  => 'Betula',
                'estado'            => 'aprobada',
            ],
            [
                'tipo'              => 'flora',
                'nombre_cientifico' => 'Acer pseudoplatanus',
                'nombre_vernaculo'  => 'Falso plátano',
                'descripcion'       => 'Árbol caducifolio que puede alcanzar los 30 metros de altura. Sus hojas son grandes, palmeadas y con cinco lóbulos dentados. En Asturias aparece como especie acompañante en bosques mixtos y hayedos, especialmente en suelos frescos y profundos. Sus frutos alados (sámaras) giran como hélices al caer, facilitando su dispersión por el viento.',
                'genero_taxonomia'  => 'Acer',
                'estado'            => 'pendiente',
            ],
            [
                'tipo'              => 'flora',
                'nombre_cientifico' => 'Corylus avellana',
                'nombre_vernaculo'  => 'Avellano',
                'descripcion'       => 'Arbusto o pequeño árbol caducifolio que raramente supera los 8 metros de altura. En Asturias es muy común en bosques mixtos, riberas y setos. Sus frutos, las avellanas, han sido un recurso alimenticio tradicional. Sus ramas flexibles se han utilizado para hacer cestos y otros útiles. Es una de las primeras especies en florecer al final del invierno.',
                'genero_taxonomia'  => 'Corylus',
                'estado'            => 'aprobada',
            ],
            [
                'tipo'              => 'flora',
                'nombre_cientifico' => 'Fraxinus excelsior',
                'nombre_vernaculo'  => 'Fresno común',
                'descripcion'       => 'Árbol caducifolio que puede alcanzar los 40 metros de altura. Sus hojas son compuestas, con 7-13 foliolos dentados. En Asturias es común en bosques de ribera y prados húmedos. Sus ramas se han usado tradicionalmente como forraje para el ganado y su madera, muy elástica, para fabricar mangos de herramientas y piezas de carros.',
                'genero_taxonomia'  => 'Fraxinus',
                'estado'            => 'aprobada',
            ],
            [
                'tipo'              => 'flora',
                'nombre_cientifico' => 'Salix alba',
                'nombre_vernaculo'  => 'Sauce blanco',
                'descripcion'       => 'Árbol caducifolio que puede alcanzar los 25 metros de altura. Su nombre hace referencia al color blanquecino del envés de sus hojas y sus jóvenes ramillas. En Asturias es común en las orillas de ríos y zonas húmedas. Sus ramas flexibles se han utilizado tradicionalmente para cestería y su corteza tiene propiedades medicinales similares a la aspirina.',
                'genero_taxonomia'  => 'Salix',
                'estado'            => 'aprobada',
            ],
            [
                'tipo'              => 'flora',
                'nombre_cientifico' => 'Genista hispanica',
                'nombre_vernaculo'  => 'Tojo',
                'descripcion'       => 'Arbusto espinoso de hasta 1 metro de altura cubierto de abundantes flores amarillas en primavera. En Asturias es común en matorrales, claros de bosque y zonas de montaña con suelos pobres y secos. Ha sido tradicionalmente utilizado como cama para el ganado, que una vez descompuesta servía como abono para los cultivos.',
                'genero_taxonomia'  => 'Genista',
                'estado'            => 'pendiente',
            ],
            [
                'tipo'              => 'flora',
                'nombre_cientifico' => 'Ulex europaeus',
                'nombre_vernaculo'  => 'Escoba negra',
                'descripcion'       => 'Arbusto espinoso que puede alcanzar los 2 metros de altura, con flores amarillas muy abundantes. En Asturias forma extensos matorrales en zonas degradadas y bordes de bosques. Sus flores son una importante fuente de néctar para las abejas y tradicionalmente se ha usado como combustible para hornos de pan.',
                'genero_taxonomia'  => 'Ulex',
                'estado'            => 'aprobada',
            ],
            [
                'tipo'              => 'flora',
                'nombre_cientifico' => 'Erica arborea',
                'nombre_vernaculo'  => 'Brezo blanco',
                'descripcion'       => 'Arbusto perennifolio que puede alcanzar los 4 metros de altura. Sus flores son pequeñas, blancas o rosadas, agrupadas en racimos. En Asturias forma parte de los brezales de montaña y suele aparecer tras la degradación de bosques. La madera de su cepa, muy dura y resistente al calor, se ha utilizado tradicionalmente para fabricar pipas de fumar.',
                'genero_taxonomia'  => 'Erica',
                'estado'            => 'aprobada',
            ],
            [
                'tipo'              => 'flora',
                'nombre_cientifico' => 'Ilex aquifolium',
                'nombre_vernaculo'  => 'Acebo',
                'descripcion'       => 'Arbusto o pequeño árbol perennifolio que puede alcanzar los 10 metros de altura. Sus hojas son coriáceas, brillantes y con bordes espinosos, y sus frutos son bayas rojas que persisten durante el invierno. En Asturias aparece como sotobosque en hayedos y robledales. Está protegido por su importancia como refugio y alimento invernal para la fauna.',
                'genero_taxonomia'  => 'Ilex',
                'estado'            => 'aprobada',
            ],
            [
                'tipo'              => 'flora',
                'nombre_cientifico' => 'Sorbus aucuparia',
                'nombre_vernaculo'  => 'Serbal de cazadores',
                'descripcion'       => 'Árbol caducifolio que puede alcanzar los 15 metros de altura. Sus hojas son compuestas y sus frutos son pequeñas bayas de color rojo anaranjado que permanecen en el árbol durante el invierno. En Asturias aparece en bosques de montaña, principalmente en la cordillera Cantábrica. Sus frutos son importantes para la alimentación de aves.',
                'genero_taxonomia'  => 'Sorbus',
                'estado'            => 'pendiente',
            ],
            [
                'tipo'              => 'flora',
                'nombre_cientifico' => 'Prunus spinosa',
                'nombre_vernaculo'  => 'Endrino',
                'descripcion'       => 'Arbusto espinoso caducifolio que raramente supera los 4 metros de altura. Sus flores blancas aparecen antes que las hojas, y sus frutos son drupas de color azul oscuro, las endrinas. En Asturias es común en setos, orlas forestales y zonas de matorral. Sus frutos, muy astringentes, se utilizan para elaborar pacharán.',
                'genero_taxonomia'  => 'Prunus',
                'estado'            => 'aprobada',
            ],
            [
                'tipo'              => 'flora',
                'nombre_cientifico' => 'Narcissus asturiensis',
                'nombre_vernaculo'  => 'Narciso de Asturias',
                'descripcion'       => 'Pequeña planta bulbosa endémica de la Cordillera Cantábrica y Montes de León. Sus flores son solitarias, de color amarillo y con una corona más oscura. En Asturias aparece en pastizales y claros de bosque de zonas montañosas. Es una de las primeras plantas en florecer al final del invierno, a veces incluso con nieve.',
                'genero_taxonomia'  => 'Narcissus',
                'estado'            => 'aprobada',
            ],
            [
                'tipo'              => 'flora',
                'nombre_cientifico' => 'Osmunda regalis',
                'nombre_vernaculo'  => 'Helecho real',
                'descripcion'       => 'Helecho de gran tamaño que puede alcanzar los 2 metros de altura. Sus frondes son bipinnadas y de aspecto muy elegante. En Asturias crece en lugares húmedos y sombríos, principalmente cerca de cursos de agua. Es uno de los helechos más antiguos y primitivos, considerado un fósil viviente por haber persistido casi sin cambios durante millones de años.',
                'genero_taxonomia'  => 'Osmunda',
                'estado'            => 'pendiente',
            ],
            [
                'tipo'              => 'flora',
                'nombre_cientifico' => 'Alnus glutinosa',
                'nombre_vernaculo'  => 'Aliso',
                'descripcion'       => 'Árbol caducifolio que puede alcanzar los 25 metros de altura. Sus hojas son redondeadas y pegajosas al tacto. En Asturias es muy común en las riberas de los ríos, donde sus raíces ayudan a fijar los márgenes. Su madera es muy resistente a la humedad y ha sido tradicionalmente utilizada para pilares de puentes y construcciones acuáticas.',
                'genero_taxonomia'  => 'Alnus',
                'estado'            => 'aprobada',
            ],
            [
                'tipo'              => 'flora',
                'nombre_cientifico' => 'Sphagnum palustre',
                'nombre_vernaculo'  => 'Musgo de turbera',
                'descripcion'       => 'Musgo característico de turberas y zonas pantanosas. Forma densas almohadillas esponjosas de color verde, amarillento o rojizo. En Asturias aparece en zonas de montaña con alta humedad. Tiene una enorme capacidad de absorción de agua (hasta 20 veces su peso seco) y contribuye a la formación de turba, un tipo de combustible fósil.',
                'genero_taxonomia'  => 'Sphagnum',
                'estado'            => 'aprobada',
            ],
            [
                'tipo'              => 'flora',
                'nombre_cientifico' => 'Thymus praecox',
                'nombre_vernaculo'  => 'Tomillo rastrero',
                'descripcion'       => 'Pequeña mata aromática de carácter rastrero. Sus hojas son diminutas y sus flores, de color rosa o púrpura, aparecen en pequeños grupos terminales. En Asturias crece en zonas rocosas de montaña, principalmente en terrenos calizos. Sus aceites esenciales le confieren propiedades medicinales, especialmente para afecciones respiratorias.',
                'genero_taxonomia'  => 'Thymus',
                'estado'            => 'pendiente',
            ],
            [
                'tipo'              => 'flora',
                'nombre_cientifico' => 'Rubus idaeus',
                'nombre_vernaculo'  => 'Frambueso',
                'descripcion'       => 'Arbusto caducifolio espinoso que puede alcanzar los 2 metros de altura. Sus tallos están cubiertos de pequeñas espinas y sus frutos, las frambuesas, son agregados de pequeñas drupas rojas. En Asturias crece en claros de bosque y zonas de montaña. Sus frutos son muy apreciados tanto por humanos como por la fauna silvestre.',
                'genero_taxonomia'  => 'Rubus',
                'estado'            => 'aprobada',
            ],
            [
                'tipo'              => 'flora',
                'nombre_cientifico' => 'Juncus effusus',
                'nombre_vernaculo'  => 'Junco',
                'descripcion'       => 'Planta perenne de tallos cilíndricos y huecos que puede alcanzar 1 metro de altura. Crece formando densas matas en zonas húmedas. En Asturias es común en prados encharcados, bordes de lagos y zonas pantanosas. Sus tallos se han utilizado tradicionalmente para cestería, asientos de sillas y techumbres de construcciones rurales.',
                'genero_taxonomia'  => 'Juncus',
                'estado'            => 'aprobada',
            ],
        ];

        $especiesFauna = [
            [
                'tipo'              => 'fauna',
                'nombre_cientifico' => 'Ursus arctos cantabricus',
                'nombre_vernaculo'  => 'Oso pardo cantábrico',
                'descripcion'       => 'Subespecie del oso pardo que habita en la Cordillera Cantábrica. De tamaño medio dentro de los osos pardos, los machos pueden alcanzar los 180 kg. En Asturias ocupa principalmente zonas montañosas con bosques caducifolios. Es omnívoro, con predominio de materia vegetal en su dieta. Símbolo de la fauna asturiana, está en peligro de extinción.',
                'genero_taxonomia'  => 'Ursus',
                'estado'            => 'aprobada',
            ],
            [
                'tipo'              => 'fauna',
                'nombre_cientifico' => 'Capreolus capreolus',
                'nombre_vernaculo'  => 'Corzo',
                'descripcion'       => 'Pequeño cérvido muy común en los bosques asturianos. Los machos poseen pequeñas cuernas ramificadas que renuevan anualmente. Es muy adaptable y puede encontrarse desde bosques caducifolios hasta zonas de matorral, siempre que dispongan de suficiente cobertura vegetal. Herbívoro, se alimenta principalmente de brotes tiernos y hojas.',
                'genero_taxonomia'  => 'Capreolus',
                'estado'            => 'aprobada',
            ],
            [
                'tipo'              => 'fauna',
                'nombre_cientifico' => 'Canis lupus signatus',
                'nombre_vernaculo'  => 'Lobo ibérico',
                'descripcion'       => 'Subespecie de lobo endémica de la península ibérica. De menor tamaño que otras subespecies europeas, destaca por su coloración característica. En Asturias habita principalmente en el suroccidente, en zonas de montaña con alternancia de bosques y zonas abiertas. Depredador y carroñero, su dieta incluye ungulados silvestres, ganado y pequeños mamíferos.',
                'genero_taxonomia'  => 'Canis',
                'estado'            => 'aprobada',
            ],
            [
                'tipo'              => 'fauna',
                'nombre_cientifico' => 'Lutra lutra',
                'nombre_vernaculo'  => 'Nutria europea',
                'descripcion'       => 'Mamífero semiacuático perfectamente adaptado a la vida en el agua, con un cuerpo alargado y extremidades palmeadas. En Asturias está presente en la mayoría de los ríos en buen estado de conservación. Se alimenta principalmente de peces, aunque también consume anfibios, crustáceos y ocasionalmente pequeñas aves acuáticas.',
                'genero_taxonomia'  => 'Lutra',
                'estado'            => 'pendiente',
            ],
            [
                'tipo'              => 'fauna',
                'nombre_cientifico' => 'Mustela erminea',
                'nombre_vernaculo'  => 'Armiño',
                'descripcion'       => 'Pequeño carnívoro de la familia de los mustélidos. De cuerpo muy alargado y extremidades cortas. En invierno su pelaje se vuelve completamente blanco excepto la punta de la cola que permanece negra, mientras que en verano es marrón por encima y blanco por debajo. En Asturias habita zonas montañosas, principalmente por encima de los 1000 metros.',
                'genero_taxonomia'  => 'Mustela',
                'estado'            => 'aprobada',
            ],
            [
                'tipo'              => 'fauna',
                'nombre_cientifico' => 'Rupicapra pyrenaica parva',
                'nombre_vernaculo'  => 'Rebeco cantábrico',
                'descripcion'       => 'Subespecie de rebeco propia de la Cordillera Cantábrica. Bóvido de tamaño medio adaptado a la vida en zonas escarpadas de montaña. Ambos sexos poseen cuernos en forma de gancho. En Asturias habita principalmente en los Picos de Europa y otras zonas montañosas, donde se desplaza con sorprendente agilidad por terrenos rocosos y pendientes pronunciadas.',
                'genero_taxonomia'  => 'Rupicapra',
                'estado'            => 'aprobada',
            ],
            [
                'tipo'              => 'fauna',
                'nombre_cientifico' => 'Tetrao urogallus cantabricus',
                'nombre_vernaculo'  => 'Urogallo cantábrico',
                'descripcion'       => 'Subespecie endémica de la Cordillera Cantábrica, en grave peligro de extinción. Ave galliforme de gran tamaño con marcado dimorfismo sexual: los machos son mucho mayores y de color negro azulado, mientras que las hembras son pardas. En Asturias habita hayedos y abedulares maduros. Emblemático por su espectacular cortejo o "canto".',
                'genero_taxonomia'  => 'Tetrao',
                'estado'            => 'aprobada',
            ],
            [
                'tipo'              => 'fauna',
                'nombre_cientifico' => 'Aquila chrysaetos',
                'nombre_vernaculo'  => 'Águila real',
                'descripcion'       => 'Una de las rapaces más grandes y poderosas de la península ibérica. De color pardo oscuro con destellos dorados en la nuca y el cuello. En Asturias nidifica en zonas montañosas, construyendo grandes nidos en cortados rocosos. Depredador versátil, caza desde conejos hasta crías de ungulados y otras aves de tamaño medio.',
                'genero_taxonomia'  => 'Aquila',
                'estado'            => 'pendiente',
            ],
            [
                'tipo'              => 'fauna',
                'nombre_cientifico' => 'Gyps fulvus',
                'nombre_vernaculo'  => 'Buitre leonado',
                'descripcion'       => 'Gran ave rapaz carroñera que puede superar los 2,5 metros de envergadura. De plumaje mayoritariamente leonado, contrasta con las plumas de vuelo negras. En Asturias nidifica en cortados rocosos, formando colonias. Estrictamente carroñero, se alimenta de los cadáveres de grandes y medianos mamíferos que localiza planeando durante horas.',
                'genero_taxonomia'  => 'Gyps',
                'estado'            => 'aprobada',
            ],
            [
                'tipo'              => 'fauna',
                'nombre_cientifico' => 'Pyrrhocorax pyrrhocorax',
                'nombre_vernaculo'  => 'Chova piquirroja',
                'descripcion'       => 'Córvido de tamaño medio y plumaje completamente negro con brillos metálicos. Destaca por su pico largo y curvado de color rojo y sus patas del mismo color. En Asturias habita zonas montañosas, nidificando en cuevas, grietas y edificios abandonados. Muy sociable, forma bandos que realizan acrobacias aéreas. Se alimenta principalmente de insectos que encuentra en pastizales.',
                'genero_taxonomia'  => 'Pyrrhocorax',
                'estado'            => 'aprobada',
            ],
            [
                'tipo'              => 'fauna',
                'nombre_cientifico' => 'Dryocopus martius',
                'nombre_vernaculo'  => 'Pito negro',
                'descripcion'       => 'El mayor de los pájaros carpinteros europeos, de plumaje completamente negro excepto una mancha roja en la cabeza (completa en machos, solo en la nuca en hembras). En Asturias habita bosques maduros, principalmente hayedos. Se alimenta de insectos xilófagos que extrae de la madera con su potente pico. Sus nidos excavados en árboles son posteriormente utilizados por otras especies.',
                'genero_taxonomia'  => 'Dryocopus',
                'estado'            => 'pendiente',
            ],
            [
                'tipo'              => 'fauna',
                'nombre_cientifico' => 'Turdus merula',
                'nombre_vernaculo'  => 'Mirlo común',
                'descripcion'       => 'Ave de tamaño medio con marcado dimorfismo sexual: los machos son completamente negros con el pico amarillo anaranjado, mientras que las hembras son pardas. En Asturias es muy común en todo tipo de hábitats, desde bosques hasta jardines urbanos. Su canto melódico es uno de los más reconocibles. Se alimenta principalmente de lombrices e insectos, complementados con frutos.',
                'genero_taxonomia'  => 'Turdus',
                'estado'            => 'aprobada',
            ],
            [
                'tipo'              => 'fauna',
                'nombre_cientifico' => 'Salamandra salamandra bernardezi',
                'nombre_vernaculo'  => 'Salamandra común',
                'descripcion'       => 'Anfibio urodelo inconfundible por su coloración negra con manchas amarillas. La subespecie bernardezi, endémica del norte peninsular, se caracteriza por ser ovovivípara y presentar patrones de coloración muy variables. En Asturias habita bosques húmedos y se reproduce en arroyos de aguas limpias. De hábitos nocturnos, se alimenta de pequeños invertebrados.',
                'genero_taxonomia'  => 'Salamandra',
                'estado'            => 'aprobada',
            ],
            [
                'tipo'              => 'fauna',
                'nombre_cientifico' => 'Rana iberica',
                'nombre_vernaculo'  => 'Rana patilarga',
                'descripcion'       => 'Pequeño anfibio endémico de la península ibérica. De color pardo rojizo con manchas oscuras y una línea clara en el labio superior. Como su nombre indica, posee patas posteriores proporcionalmente muy largas. En Asturias habita arroyos de aguas frías, rápidas y bien oxigenadas, principalmente en zonas montañosas y bosques caducifolios.',
                'genero_taxonomia'  => 'Rana',
                'estado'            => 'pendiente',
            ],
            [
                'tipo'              => 'fauna',
                'nombre_cientifico' => 'Triturus marmoratus',
                'nombre_vernaculo'  => 'Tritón jaspeado',
                'descripcion'       => 'Anfibio urodelo de tamaño medio caracterizado por su coloración verde con manchas oscuras formando un patrón marmóreo. Los machos desarrollan una prominente cresta dorsal durante la época de cría. En Asturias habita charcas, abrevaderos y pequeños cursos de agua tranquila, a menudo en zonas de prados y bosques. Se alimenta de pequeños invertebrados acuáticos.',
                'genero_taxonomia'  => 'Triturus',
                'estado'            => 'aprobada',
            ],
            [
                'tipo'              => 'fauna',
                'nombre_cientifico' => 'Salmo trutta',
                'nombre_vernaculo'  => 'Trucha común',
                'descripcion'       => 'Pez salmónido de agua dulce ampliamente distribuido por los ríos asturianos. De cuerpo fusiforme y coloración variable, generalmente pardusca con manchas negras y rojas. Habita ríos y arroyos de aguas frías, limpias y bien oxigenadas. Depredador voraz, se alimenta principalmente de invertebrados acuáticos, aunque los ejemplares mayores pueden cazar pequeños peces e incluso micromamíferos.',
                'genero_taxonomia'  => 'Salmo',
                'estado'            => 'aprobada',
            ],
            [
                'tipo'              => 'fauna',
                'nombre_cientifico' => 'Elona quimperiana',
                'nombre_vernaculo'  => 'Caracol de Quimper',
                'descripcion'       => 'Caracol terrestre endémico del norte de la península ibérica y oeste de Francia. Su concha es aplanada, de color pardo y con un patrón de manchas más oscuras. En Asturias habita zonas húmedas y sombrías de bosques caducifolios, a menudo escondido bajo piedras, troncos o entre la hojarasca. Se alimenta principalmente de materia vegetal en descomposición y hongos.',
                'genero_taxonomia'  => 'Elona',
                'estado'            => 'pendiente',
            ],
            [
                'tipo'              => 'fauna',
                'nombre_cientifico' => 'Galemys pyrenaicus',
                'nombre_vernaculo'  => 'Desmán ibérico',
                'descripcion'       => 'Pequeño mamífero insectívoro semiacuático endémico de la península ibérica. De aspecto similar a un topo con una característica trompa aplanada y móvil. En Asturias habita ríos y arroyos de montaña con aguas frías, limpias y bien oxigenadas. Se alimenta principalmente de larvas de insectos acuáticos que captura buceando con gran agilidad. Es una especie amenazada por la alteración de su hábitat.',
                'genero_taxonomia'  => 'Galemys',
                'estado'            => 'aprobada',
            ],
            [
                'tipo'              => 'fauna',
                'nombre_cientifico' => 'Lucanus cervus',
                'nombre_vernaculo'  => 'Ciervo volante',
                'descripcion'       => 'El mayor escarabajo de Europa, con machos que pueden superar los 8 cm incluyendo sus características "astas" (mandíbulas hipertrofiadas). En Asturias habita bosques caducifolios maduros, principalmente robledales y castañares. Las larvas se desarrollan durante varios años en madera muerta, contribuyendo a su descomposición. Los adultos se alimentan de savia y frutas maduras. Está protegido a nivel europeo.',
                'genero_taxonomia'  => 'Lucanus',
                'estado'            => 'aprobada',
            ],
            [
                'tipo'              => 'fauna',
                'nombre_cientifico' => 'Erebia palarica',
                'nombre_vernaculo'  => 'Mariposa de montaña cantábrica',
                'descripcion'       => 'Mariposa endémica de la Cordillera Cantábrica. De tamaño medio y coloración pardo oscura con una banda anaranjada que contiene ocelos negros. En Asturias habita pastizales de montaña por encima de los 1000 metros. Los adultos vuelan en verano, alimentándose del néctar de diversas flores. Las orugas se alimentan de gramíneas y hibernan hasta la primavera siguiente.',
                'genero_taxonomia'  => 'Erebia',
                'estado'            => 'pendiente',
            ],
            [
                'tipo'              => 'fauna',
                'nombre_cientifico' => 'Iberolacerta monticola',
                'nombre_vernaculo'  => 'Lagartija serrana',
                'descripcion'       => 'Pequeño reptil endémico del noroeste peninsular. De coloración variable, generalmente grisácea o pardusca con manchas negras. En Asturias habita zonas rocosas de montaña, principalmente por encima de los 1000 metros. De hábitos diurnos, se alimenta de pequeños artrópodos. Es una especie bien adaptada a las condiciones de alta montaña, que puede estar activa incluso con temperaturas bastante bajas.',
                'genero_taxonomia'  => 'Iberolacerta',
                'estado'            => 'aprobada',
            ],
            [
                'tipo'              => 'fauna',
                'nombre_cientifico' => 'Rhinolophus ferrumequinum',
                'nombre_vernaculo'  => 'Murciélago grande de herradura',
                'descripcion'       => 'El mayor de los murciélagos de herradura europeos, caracterizado por la estructura nasal en forma de herradura. De pelaje pardo, más oscuro en el dorso que en el vientre. En Asturias se refugia en cuevas, minas abandonadas y desvanes de edificios rurales. Caza principalmente escarabajos y mariposas nocturnas en zonas de bosque y prados con setos. Es una especie amenazada por la pérdida de refugios y el uso de pesticidas.',
                'genero_taxonomia'  => 'Rhinolophus',
                'estado'            => 'aprobada',
            ],
            [
                'tipo'              => 'fauna',
                'nombre_cientifico' => 'Sciurus vulgaris',
                'nombre_vernaculo'  => 'Ardilla común',
                'descripcion'       => 'Pequeño roedor arborícola inconfundible por su larga cola peluda y penachos en las orejas. La población asturiana pertenece a la subespecie alpinus, de color pardo rojizo. Habita todo tipo de bosques, aunque prefiere los de coníferas. Gran trepadora, se alimenta principalmente de frutos forestales (piñones, bellotas, hayucos, avellanas) que almacena para el invierno. Construye nidos esféricos de ramas en las copas de los árboles.',
                'genero_taxonomia'  => 'Sciurus',
                'estado'            => 'aprobada',
            ],
            [
                'tipo'              => 'fauna',
                'nombre_cientifico' => 'Cordulegaster boltonii',
                'nombre_vernaculo'  => 'Libélula de arroyo',
                'descripcion'       => 'Gran libélula de hasta 8 cm de envergadura alar. De coloración negra con bandas amarillas en el abdomen, ojos verdes y alas transparentes. En Asturias habita arroyos y pequeños ríos de aguas limpias y oxigenadas, donde las larvas se desarrollan durante varios años. Los adultos son excelentes voladores que cazan otros insectos al vuelo. Es un buen indicador de la calidad del agua.',
                'genero_taxonomia'  => 'Cordulegaster',
                'estado'            => 'pendiente',
            ],
            [
                'tipo'              => 'fauna',
                'nombre_cientifico' => 'Prunella collaris',
                'nombre_vernaculo'  => 'Acentor alpino',
                'descripcion'       => 'Ave de tamaño pequeño-medio característica de la alta montaña. De plumaje principalmente grisáceo con flancos rojizos y un característico diseño blanco y negro en la garganta. En Asturias habita las zonas altas de la Cordillera Cantábrica, por encima del límite del bosque. Se alimenta principalmente de insectos en verano y semillas en invierno. A diferencia de la mayoría de aves de montaña, no migra, descendiendo simplemente a zonas más bajas en invierno.',
                'genero_taxonomia'  => 'Prunella',
                'estado'            => 'aprobada',
            ],
        ];

        $especies = array_merge($especiesFlora, $especiesFauna);

        foreach ($especies as $especie) {
            $taxonomia = Taxonomia::where('genero', $especie['genero_taxonomia'])->first();

            if (! $taxonomia) {
                $this->command->error("No se encontró taxonomía para el género: {$especie['genero_taxonomia']}");
                continue;
            }

            $slug = Str::slug($especie['nombre_vernaculo']);

            $count = Especie::where('slug', 'LIKE', "{$slug}%")->count();
            if ($count > 0) {
                $slug = "{$slug}-{$count}";
            }

            $alumnoId = $alumnosIds[array_rand($alumnosIds)];

            Especie::create([
                'tipo'              => $especie['tipo'],
                'nombre_cientifico' => $especie['nombre_cientifico'],
                'nombre_vernaculo'  => $especie['nombre_vernaculo'],
                'slug'              => $slug,
                'descripcion'       => $especie['descripcion'],
                'estado'            => $especie['estado'],
                'taxonomia_id'      => $taxonomia->id,
                'alumno_id'         => $alumnoId,
            ]);
        }

        $this->command->info('Se han insertado con éxito 50 especies (25 flora y 25 fauna) autóctonas de Asturias.');
    }
}
