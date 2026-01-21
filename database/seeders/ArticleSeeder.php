<?php

namespace Database\Seeders;

use App\Models\Article;
use App\Models\Category;
use App\Models\Author;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

class ArticleSeeder extends Seeder
{
    public function run(): void
    {
        $articles = [
            // LOCALES
            [
                'title' => 'El Consejo Escolar aprueba plan de obras para 15 escuelas del distrito',
                'excerpt' => 'Las obras de refaccion comenzaran en febrero y se espera que esten listas antes del inicio del ciclo lectivo 2026.',
                'body' => $this->generateBody('El Consejo Escolar de General Pueyrredon aprobo por unanimidad el plan de obras que contempla la refaccion de 15 establecimientos educativos del distrito. Las tareas incluyen reparacion de techos, sistemas electricos y sanitarios.

Las escuelas beneficiadas se encuentran en distintos barrios de la ciudad, con especial atencion a las zonas mas vulnerables. El presidente del Consejo Escolar destaco que "es fundamental garantizar que los chicos puedan comenzar las clases en edificios seguros y en condiciones".

El presupuesto asignado supera los 500 millones de pesos y se financiara con fondos provinciales y municipales. Se preve la contratacion de mano de obra local para dinamizar la economia de los barrios.'),
                'category' => 'locales',
                'author' => 'aylen-aurellio',
                'is_featured' => false,
                'image' => 'https://images.unsplash.com/photo-1580582932707-520aed937b7b?w=800&h=400&fit=crop',
                'hours_ago' => 3,
            ],
            [
                'title' => 'Docentes bonaerenses en alerta por nuevas paritarias: exigen recomposicion salarial',
                'excerpt' => 'Los gremios docentes mantienen el estado de alerta tras las ultimas propuestas del gobierno provincial.',
                'body' => $this->generateBody('Los principales gremios docentes de la provincia de Buenos Aires mantienen el estado de alerta y movilizacion tras considerar insuficiente la ultima propuesta salarial del gobierno provincial.

SUTEBA, UDOCBA y FEB coincidieron en rechazar el ofrecimiento que no alcanza a cubrir la perdida del poder adquisitivo acumulada. "Necesitamos una recomposicion real, no parches que se diluyen con la inflacion", senalo el secretario general de SUTEBA Mar del Plata.

Para la proxima semana se convoco a un plenario provincial donde se definiran las medidas de fuerza. No se descarta un paro de 48 horas si el gobierno no mejora la oferta.'),
                'category' => 'gremiales',
                'author' => 'aylen-aurellio',
                'is_featured' => true,
                'image' => 'https://images.unsplash.com/photo-1503676260728-1c00da094a0b?w=800&h=400&fit=crop',
                'hours_ago' => 2,
            ],
            // UNIVERSIDAD
            [
                'title' => 'La UNMdP abre inscripcion para nuevas carreras en 2026',
                'excerpt' => 'Se incorporan tres nuevas tecnicaturas orientadas a tecnologia y economia social.',
                'body' => $this->generateBody('La Universidad Nacional de Mar del Plata anuncio la apertura de inscripciones para tres nuevas carreras que se dictaran a partir del ciclo lectivo 2026.

Las nuevas propuestas academicas incluyen una Tecnicatura en Desarrollo de Software, una Tecnicatura en Economia Social y Solidaria, y una Licenciatura en Ciencia de Datos. Todas fueron aprobadas por el Consejo Superior y responden a demandas del mercado laboral regional.

El rector de la UNMdP destaco que "estas carreras representan la apuesta de la universidad por formar profesionales en areas estrategicas para el desarrollo de nuestra ciudad y la region".'),
                'category' => 'universidad',
                'author' => 'eugenia-garita',
                'is_featured' => false,
                'image' => 'https://images.unsplash.com/photo-1523050854058-8df90110c9f1?w=800&h=400&fit=crop',
                'hours_ago' => 4,
            ],
            [
                'title' => 'Investigadores de la UNMdP desarrollan sistema de monitoreo ambiental con IA',
                'excerpt' => 'El proyecto permitira detectar contaminacion en tiempo real en la costa marplatense.',
                'body' => $this->generateBody('Un equipo de investigadores de la Facultad de Ingenieria de la UNMdP desarrollo un innovador sistema de monitoreo ambiental que utiliza inteligencia artificial para detectar niveles de contaminacion en tiempo real.

El sistema, que ya esta siendo probado en la zona costera, utiliza sensores IoT y algoritmos de machine learning para analizar la calidad del agua y el aire. Los datos se transmiten a una plataforma web accesible para la comunidad.

El proyecto fue financiado por el CONICET y cuenta con el apoyo del municipio de General Pueyrredon. Se espera que este operativo al 100% para la temporada de verano.'),
                'category' => 'ciencia-tecnologia',
                'author' => 'redaccion',
                'is_featured' => false,
                'image' => 'https://images.unsplash.com/photo-1532094349884-543bc11b234d?w=800&h=400&fit=crop',
                'hours_ago' => 8,
            ],
            // GREMIALES
            [
                'title' => 'SUTEBA Mar del Plata convoca a asamblea provincial para definir plan de lucha',
                'excerpt' => 'El encuentro se realizara el proximo jueves en el local sindical.',
                'body' => $this->generateBody('La seccion Mar del Plata de SUTEBA convoco a una asamblea abierta para el proximo jueves donde se definira el plan de lucha en el marco del conflicto salarial con el gobierno provincial.

Se espera la participacion de delegados de todas las escuelas del distrito y representantes de otras secciones de la costa atlantica. El orden del dia incluye el analisis de la situacion salarial, el estado de las escuelas y la defensa del sistema educativo publico.

"Es momento de que los y las docentes nos expresemos y decidamos juntos los pasos a seguir", convoco la secretaria general de la seccion local.'),
                'category' => 'gremiales',
                'author' => 'aylen-aurellio',
                'is_featured' => false,
                'image' => 'https://images.unsplash.com/photo-1529390079861-591de354faf5?w=800&h=400&fit=crop',
                'hours_ago' => 5,
            ],
            [
                'title' => 'ADUM reclama por condiciones edilicias en facultades de la UNMdP',
                'excerpt' => 'El gremio docente universitario presento un informe detallando las deficiencias.',
                'body' => $this->generateBody('La Asociacion de Docentes de la Universidad de Mar del Plata (ADUM) presento ante el Rectorado un informe detallado sobre las condiciones edilicias de las distintas facultades, reclamando acciones urgentes.

El documento senala problemas de calefaccion, filtraciones, falta de mantenimiento en sanitarios y deficiencias en el sistema electrico de varios edificios. "No podemos dictar clases en estas condiciones", advirtio la secretaria general de ADUM.

La universidad informo que esta trabajando en un plan de obras pero los recursos presupuestarios son limitados debido a los recortes del gobierno nacional.'),
                'category' => 'gremiales',
                'author' => 'eugenia-garita',
                'is_featured' => false,
                'image' => 'https://images.unsplash.com/photo-1434030216411-0b793f4b4173?w=800&h=400&fit=crop',
                'hours_ago' => 12,
            ],
            // CULTURA
            [
                'title' => 'Festival de cine independiente llega a Mar del Plata con entrada libre',
                'excerpt' => 'Durante cinco dias se proyectaran peliculas de realizadores locales y nacionales.',
                'body' => $this->generateBody('La ciudad de Mar del Plata sera sede de un nuevo Festival de Cine Independiente que se desarrollara durante cinco dias en distintas sedes culturales con entrada libre y gratuita.

La programacion incluye largometrajes, cortometrajes y documentales de realizadores locales, regionales y nacionales. Ademas habra charlas con directores, talleres de formacion y un concurso para jovenes cineastas.

El festival cuenta con el apoyo del Instituto Cultural de la Provincia de Buenos Aires y la Secretaria de Cultura local. Las proyecciones se realizaran en el Teatro Colon, el Museo MAR y espacios culturales barriales.'),
                'category' => 'cultura',
                'author' => 'redaccion',
                'is_featured' => false,
                'image' => 'https://images.unsplash.com/photo-1489599849927-2ee91cede3ba?w=800&h=400&fit=crop',
                'hours_ago' => 6,
            ],
            [
                'title' => 'Biblioteca Popular del Puerto celebra 50 anos con actividades para toda la familia',
                'excerpt' => 'El aniversario se festejara con una semana de eventos culturales y educativos.',
                'body' => $this->generateBody('La Biblioteca Popular del Puerto cumple 50 anos de vida institucional y lo celebrara con una semana de actividades culturales abiertas a toda la comunidad.

El programa incluye talleres de lectura para ninos, charlas con escritores locales, proyecciones de peliculas, muestras de arte y un festival de musica. Tambien se inaugurara una nueva sala de lectura infantil.

"Cincuenta anos trabajando por la cultura y la educacion de nuestro barrio es motivo de gran orgullo", senalo la presidenta de la biblioteca. La institucion atiende a mas de 200 socios y ofrece servicios gratuitos de prestamo de libros y acceso a internet.'),
                'category' => 'cultura',
                'author' => 'redaccion',
                'is_featured' => false,
                'image' => 'https://images.unsplash.com/photo-1507003211169-0a1dd7228f2d?w=800&h=400&fit=crop',
                'hours_ago' => 10,
            ],
            // POLITICA EDUCATIVA
            [
                'title' => 'Provincia anuncia cambios en el calendario escolar 2026',
                'excerpt' => 'El ciclo lectivo comenzara el 2 de marzo y tendra 190 dias de clase efectivos.',
                'body' => $this->generateBody('La Direccion General de Cultura y Educacion de la Provincia de Buenos Aires dio a conocer el calendario escolar para el ciclo lectivo 2026, que presenta algunas modificaciones respecto al ano anterior.

El inicio de clases esta previsto para el 2 de marzo y la finalizacion para el 17 de diciembre, sumando un total de 190 dias de clase efectivos. Se incorporan dos jornadas institucionales adicionales para capacitacion docente.

El receso de invierno se extendera del 13 al 24 de julio. Los examenes de febrero y marzo se realizaran del 17 al 28 de febrero.'),
                'category' => 'politica-educativa',
                'author' => 'aylen-aurellio',
                'is_featured' => false,
                'image' => 'https://images.unsplash.com/photo-1577896851231-70ef18881754?w=800&h=400&fit=crop',
                'hours_ago' => 7,
            ],
            [
                'title' => 'Nacion recorta fondos para comedores escolares: preocupacion en Mar del Plata',
                'excerpt' => 'El ajuste afectaria a mas de 50 mil estudiantes que reciben almuerzo en las escuelas.',
                'body' => $this->generateBody('El recorte presupuestario anunciado por el gobierno nacional afectara directamente a los comedores escolares de todo el pais. En Mar del Plata, mas de 50 mil estudiantes podrian ver reducidas las raciones alimentarias.

Autoridades educativas locales expresaron su preocupacion y reclaman al gobierno provincial que cubra la diferencia. "El derecho a la alimentacion de nuestros estudiantes no puede estar en juego", manifesto la inspectora jefe distrital.

Organizaciones sociales y gremios docentes convocaron a una movilizacion en defensa de los comedores escolares para el proximo viernes frente a la Municipalidad.'),
                'category' => 'politica-educativa',
                'author' => 'aylen-aurellio',
                'is_featured' => false,
                'image' => 'https://images.unsplash.com/photo-1567521464027-f127ff144326?w=800&h=400&fit=crop',
                'hours_ago' => 9,
            ],
            // AMBIENTE
            [
                'title' => 'Escuelas marplatenses se suman al programa de separacion de residuos',
                'excerpt' => 'Ya son 45 los establecimientos que implementan la separacion en origen.',
                'body' => $this->generateBody('El programa de educacion ambiental del municipio sigue sumando escuelas. Ya son 45 los establecimientos educativos de Mar del Plata que implementan la separacion de residuos en origen.

El programa incluye capacitaciones para docentes y estudiantes, provision de contenedores diferenciados y visitas a la planta de reciclaje municipal. Los alumnos participan activamente como "promotores ambientales" en sus comunidades.

"La educacion ambiental desde temprana edad es fundamental para construir una ciudad mas sustentable", destaco la coordinadora del programa. Se espera sumar 20 escuelas mas durante este ano.'),
                'category' => 'ambiente',
                'author' => 'redaccion',
                'is_featured' => false,
                'image' => 'https://images.unsplash.com/photo-1532996122724-e3c354a0b15b?w=800&h=400&fit=crop',
                'hours_ago' => 14,
            ],
            // COLUMNAS
            [
                'title' => 'Opinion: El futuro de la educacion publica esta en juego',
                'excerpt' => 'Reflexiones sobre el momento critico que atraviesa el sistema educativo argentino.',
                'body' => $this->generateBody('Estamos viviendo un momento critico para la educacion publica argentina. Los recortes presupuestarios, el deterioro salarial docente y el abandono de la infraestructura escolar configuran un panorama preocupante.

Sin embargo, la comunidad educativa sigue resistiendo y proponiendo alternativas. Docentes, estudiantes y familias se organizan para defender un derecho que no puede ser mercantilizado.

Es necesario que toda la sociedad comprenda que invertir en educacion no es un gasto sino una inversion en el futuro. La educacion publica es la herramienta mas poderosa para construir una sociedad mas justa e igualitaria.

La historia de nuestro pais demuestra que los avances sociales siempre estuvieron ligados a la expansion del sistema educativo. No podemos permitir que se retroceda en conquistas que costaron decadas conseguir.'),
                'category' => 'columnas',
                'author' => 'aylen-aurellio',
                'is_featured' => false,
                'image' => 'https://images.unsplash.com/photo-1456513080510-7bf3a84b82f8?w=800&h=400&fit=crop',
                'hours_ago' => 24,
            ],
        ];

        $categories = Category::all()->keyBy('slug');
        $authors = Author::all()->keyBy('slug');

        foreach ($articles as $data) {
            Article::create([
                'title' => $data['title'],
                'slug' => Str::slug($data['title']),
                'excerpt' => $data['excerpt'],
                'body' => $data['body'],
                'featured_image' => $data['image'],
                'category_id' => $categories[$data['category']]->id,
                'author_id' => $authors[$data['author']]->id,
                'status' => 'published',
                'is_featured' => $data['is_featured'],
                'views' => rand(50, 500),
                'published_at' => now()->subHours($data['hours_ago']),
            ]);
        }
    }

    private function generateBody(string $content): string
    {
        return $content;
    }

    /**
     * Generate article body with HTML headings for TOC
     */
    private function generateStructuredBody(string $title, array $sections): string
    {
        $html = "<p class=\"lead\">{$sections['intro']}</p>\n\n";

        foreach ($sections['content'] as $section) {
            $html .= "<h2>{$section['title']}</h2>\n";
            $html .= "<p>{$section['body']}</p>\n\n";

            if (isset($section['subsections'])) {
                foreach ($section['subsections'] as $sub) {
                    $html .= "<h3>{$sub['title']}</h3>\n";
                    $html .= "<p>{$sub['body']}</p>\n\n";
                }
            }
        }

        if (isset($sections['conclusion'])) {
            $html .= "<h2>Conclusión</h2>\n";
            $html .= "<p>{$sections['conclusion']}</p>\n";
        }

        return $html;
    }
}
