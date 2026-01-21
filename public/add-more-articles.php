<?php
/**
 * Script to add more demo articles
 * Run once and delete after use
 */

require __DIR__.'/../vendor/autoload.php';

$app = require_once __DIR__.'/../bootstrap/app.php';
$kernel = $app->make(Illuminate\Contracts\Console\Kernel::class);
$kernel->bootstrap();

use App\Models\Article;
use App\Models\Category;
use App\Models\Author;
use App\Models\Tag;
use Illuminate\Support\Str;

echo "<h1>Agregando nuevos artículos de demo</h1>";
echo "<pre>";

$categories = Category::all()->keyBy('slug');
$authors = Author::all()->keyBy('slug');

$newArticles = [
    // LOCALES
    [
        'title' => 'Inauguran nuevo jardín de infantes en el barrio Autódromo',
        'excerpt' => 'El establecimiento tendrá capacidad para 120 niños y cuenta con instalaciones modernas y espacios verdes.',
        'body' => getJardinBody(),
        'category' => 'locales',
        'author' => 'redaccion',
        'image' => 'https://images.unsplash.com/photo-1503454537195-1dcabb73ffb9?w=800&h=400&fit=crop',
        'hours_ago' => 5,
        'tags' => ['infraestructura', 'nivel-inicial'],
    ],

    // UNIVERSIDAD
    [
        'title' => 'Estudiantes de Ingeniería ganan competencia latinoamericana de robótica',
        'excerpt' => 'El equipo de la UNMdP se impuso entre 45 universidades de 12 países con un robot autónomo.',
        'body' => getRoboticaBody(),
        'category' => 'universidad',
        'author' => 'eugenia-garita',
        'image' => 'https://images.unsplash.com/photo-1485827404703-89b55fcc595e?w=800&h=400&fit=crop',
        'hours_ago' => 8,
        'tags' => ['unmdp', 'tecnologia', 'estudiantes'],
    ],

    // GREMIALES
    [
        'title' => 'Auxiliares de educación reclaman reconocimiento profesional',
        'excerpt' => 'SOEME pide que se reconozca la labor esencial de porteros y auxiliares en el sistema educativo.',
        'body' => getAuxiliaresBody(),
        'category' => 'gremiales',
        'author' => 'aylen-aurellio',
        'image' => 'https://images.unsplash.com/photo-1577962917302-cd874c4e31d2?w=800&h=400&fit=crop',
        'hours_ago' => 6,
        'tags' => ['soeme', 'auxiliares', 'reclamo'],
    ],

    // POLÍTICA EDUCATIVA
    [
        'title' => 'Implementarán programa de alfabetización digital en escuelas primarias',
        'excerpt' => 'El plan incluye entrega de tablets y capacitación docente para integrar tecnología en el aula.',
        'body' => getAlfabetizacionBody(),
        'category' => 'politica-educativa',
        'author' => 'aylen-aurellio',
        'image' => 'https://images.unsplash.com/photo-1509062522246-3755977927d7?w=800&h=400&fit=crop',
        'hours_ago' => 4,
        'tags' => ['tecnologia', 'primaria', 'alfabetizacion'],
    ],

    // CULTURA
    [
        'title' => 'Orquesta escuela cumple 10 años formando músicos en barrios populares',
        'excerpt' => 'Más de 500 niños y jóvenes han pasado por el programa que ofrece formación musical gratuita.',
        'body' => getOrquestaBody(),
        'category' => 'cultura',
        'author' => 'redaccion',
        'image' => 'https://images.unsplash.com/photo-1514320291840-2e0a9bf2a9ae?w=800&h=400&fit=crop',
        'hours_ago' => 12,
        'tags' => ['musica', 'inclusion', 'cultura'],
    ],

    // CIENCIA Y TECNOLOGÍA
    [
        'title' => 'Científicos marplatenses desarrollan bioplástico a partir de algas',
        'excerpt' => 'El material biodegradable podría reemplazar envases plásticos tradicionales en la industria alimenticia.',
        'body' => getBioplasticoBody(),
        'category' => 'ciencia-tecnologia',
        'author' => 'eugenia-garita',
        'image' => 'https://images.unsplash.com/photo-1532187863486-abf9dbad1b69?w=800&h=400&fit=crop',
        'hours_ago' => 10,
        'tags' => ['investigacion', 'sustentabilidad', 'innovacion'],
    ],

    // AMBIENTE
    [
        'title' => 'Estudiantes secundarios lideran campaña de forestación urbana',
        'excerpt' => 'Jóvenes de 10 escuelas plantarán 1000 árboles en espacios públicos durante el próximo mes.',
        'body' => getForestacionBody(),
        'category' => 'ambiente',
        'author' => 'redaccion',
        'image' => 'https://images.unsplash.com/photo-1542601906990-b4d3fb778b09?w=800&h=400&fit=crop',
        'hours_ago' => 7,
        'tags' => ['ambiente', 'estudiantes', 'forestacion'],
    ],

    // COLUMNAS
    [
        'title' => 'Opinión: La educación emocional como asignatura pendiente',
        'excerpt' => 'Reflexiones sobre la necesidad de incorporar el desarrollo socioemocional en las escuelas.',
        'body' => getEmocionalBody(),
        'category' => 'columnas',
        'author' => 'eugenia-garita',
        'image' => 'https://images.unsplash.com/photo-1491438590914-bc09fcaaf77a?w=800&h=400&fit=crop',
        'hours_ago' => 18,
        'tags' => ['opinion', 'educacion-emocional'],
    ],

    // MÁS LOCALES
    [
        'title' => 'Cooperadoras escolares organizan feria de economía social',
        'excerpt' => 'El evento reunirá a más de 50 emprendimientos de familias de la comunidad educativa.',
        'body' => getCooperadorasBody(),
        'category' => 'locales',
        'author' => 'redaccion',
        'image' => 'https://images.unsplash.com/photo-1556742049-0cfed4f6a45d?w=800&h=400&fit=crop',
        'hours_ago' => 3,
        'tags' => ['cooperadoras', 'economia-social', 'comunidad'],
    ],

    // MÁS UNIVERSIDAD
    [
        'title' => 'La Facultad de Humanidades lanza diplomatura en Educación Inclusiva',
        'excerpt' => 'La propuesta busca formar profesionales para trabajar con estudiantes con discapacidad.',
        'body' => getDiplomaturaBody(),
        'category' => 'universidad',
        'author' => 'eugenia-garita',
        'image' => 'https://images.unsplash.com/photo-1524178232363-1fb2b075b655?w=800&h=400&fit=crop',
        'hours_ago' => 15,
        'tags' => ['unmdp', 'inclusion', 'capacitacion'],
    ],
];

$created = 0;
foreach ($newArticles as $data) {
    // Check if article already exists
    $slug = Str::slug($data['title']);
    if (Article::where('slug', $slug)->exists()) {
        echo "⏭ Ya existe: {$data['title']}\n";
        continue;
    }

    $article = Article::create([
        'title' => $data['title'],
        'slug' => $slug,
        'excerpt' => $data['excerpt'],
        'body' => $data['body'],
        'featured_image' => $data['image'],
        'category_id' => $categories[$data['category']]->id,
        'author_id' => $authors[$data['author']]->id,
        'status' => 'published',
        'is_featured' => false,
        'views' => rand(30, 300),
        'published_at' => now()->subHours($data['hours_ago']),
    ]);

    // Attach tags
    if (!empty($data['tags'])) {
        $tagIds = [];
        foreach ($data['tags'] as $tagName) {
            $tag = Tag::firstOrCreate(
                ['slug' => Str::slug($tagName)],
                ['name' => ucfirst(str_replace('-', ' ', $tagName))]
            );
            $tagIds[] = $tag->id;
        }
        $article->tags()->sync($tagIds);
    }

    echo "✓ Creado: {$data['title']}\n";
    $created++;
}

echo "\n¡Listo! Se crearon {$created} artículos nuevos.\n";
echo "\nAhora ejecuta generate-embeddings.php para activar la búsqueda semántica en los nuevos artículos.\n";
echo "\nIMPORTANTE: Elimina este archivo después de usarlo.\n";
echo "</pre>";

// ========================================
// CONTENIDO DE LOS ARTÍCULOS
// ========================================

function getJardinBody(): string {
    return <<<HTML
<p class="lead">El intendente encabezó la inauguración del nuevo Jardín de Infantes N° 945 en el barrio Autódromo, un establecimiento que tendrá capacidad para 120 niños y cuenta con instalaciones modernas y amplios espacios verdes.</p>

<h2>Características del nuevo edificio</h2>
<p>El jardín cuenta con 6 salas equipadas con mobiliario nuevo, baños adaptados para los más pequeños, un salón de usos múltiples y un patio de juegos con piso de seguridad.</p>

<h3>Infraestructura sustentable</h3>
<p>El edificio fue construido con criterios de sustentabilidad: paneles solares para agua caliente, iluminación LED, y un sistema de recolección de agua de lluvia para riego de los espacios verdes.</p>

<h3>Espacios pedagógicos</h3>
<p>Además de las salas tradicionales, el jardín incluye una biblioteca infantil, un atelier de arte y una huerta didáctica donde los niños aprenderán sobre plantas y alimentación saludable.</p>

<h2>Impacto en la comunidad</h2>
<p>El nuevo establecimiento viene a cubrir una demanda histórica del barrio, donde muchas familias debían trasladarse a otras zonas para acceder a la educación inicial.</p>

<h2>Inscripciones</h2>
<p>Las inscripciones estarán abiertas a partir de la próxima semana en el propio establecimiento, de 9 a 12 horas. Se dará prioridad a las familias del barrio.</p>
HTML;
}

function getRoboticaBody(): string {
    return <<<HTML
<p class="lead">El equipo de robótica de la Facultad de Ingeniería de la UNMdP se consagró campeón en la Competencia Latinoamericana de Robótica Autónoma, imponiéndose entre 45 universidades de 12 países.</p>

<h2>El robot ganador</h2>
<p>El robot, bautizado "Marea", fue diseñado completamente por estudiantes durante 8 meses de trabajo. Utiliza sensores LIDAR, cámaras y algoritmos de inteligencia artificial para navegar de forma autónoma.</p>

<h3>Desafíos superados</h3>
<p>Durante la competencia, Marea debió superar pruebas de navegación en laberintos, reconocimiento de objetos, manipulación de elementos y toma de decisiones en tiempo real.</p>

<h3>Tecnología utilizada</h3>
<p>El equipo utilizó ROS (Robot Operating System) y desarrolló sus propios algoritmos de machine learning para el reconocimiento de patrones. El hardware fue impreso en 3D en los laboratorios de la facultad.</p>

<h2>El equipo</h2>
<p>El grupo está conformado por 8 estudiantes de Ingeniería en Computación, Electrónica y Mecánica. Fueron guiados por docentes del Laboratorio de Robótica.</p>

<h2>Reconocimiento internacional</h2>
<p>El triunfo posiciona a la UNMdP como referente en robótica en la región. El equipo fue invitado a participar en la competencia mundial que se realizará en Japón el próximo año.</p>
HTML;
}

function getAuxiliaresBody(): string {
    return <<<HTML
<p class="lead">El Sindicato de Obreros y Empleados de la Educación (SOEME) realizó una jornada de visibilización para reclamar el reconocimiento profesional de auxiliares y porteros escolares.</p>

<h2>El reclamo</h2>
<p>Los trabajadores piden que se reconozca su labor como parte esencial del proceso educativo, más allá de las tareas de limpieza y mantenimiento.</p>

<h3>Funciones actuales</h3>
<p>Los auxiliares de educación realizan múltiples tareas: reciben a los estudiantes, colaboran en emergencias, mantienen la seguridad del edificio, y muchas veces contienen emocionalmente a los chicos.</p>

<h3>Capacitación</h3>
<p>SOEME reclama que se ofrezcan cursos de capacitación reconocidos oficialmente y que se valore la formación que muchos auxiliares tienen en primeros auxilios, prevención de violencia y atención a la diversidad.</p>

<h2>Propuesta al gobierno</h2>
<p>El sindicato presentó un proyecto para crear la figura del "Asistente Educativo", con un escalafón propio y posibilidades de carrera.</p>

<h2>Apoyo de la comunidad</h2>
<p>Docentes, directivos y familias expresaron su apoyo al reclamo, reconociendo la importancia del trabajo de los auxiliares en el funcionamiento diario de las escuelas.</p>
HTML;
}

function getAlfabetizacionBody(): string {
    return <<<HTML
<p class="lead">El gobierno provincial anunció la implementación de un programa de alfabetización digital que llegará a todas las escuelas primarias del distrito durante el próximo ciclo lectivo.</p>

<h2>Componentes del programa</h2>
<p>El plan tiene tres ejes principales: equipamiento, capacitación y contenidos digitales adaptados al currículum.</p>

<h3>Entrega de dispositivos</h3>
<p>Cada escuela recibirá un set de 30 tablets con contenidos educativos preinstalados. Los dispositivos quedarán en las escuelas para uso compartido de todos los grados.</p>

<h3>Capacitación docente</h3>
<p>Se realizarán 40 horas de capacitación para docentes, con certificación oficial. Los cursos abordarán herramientas digitales, programación básica y uso pedagógico de la tecnología.</p>

<h3>Plataforma educativa</h3>
<p>Se desarrolló una plataforma propia con recursos didácticos, juegos educativos y actividades interactivas alineadas con los contenidos curriculares de cada grado.</p>

<h2>Objetivos</h2>
<p>El programa busca reducir la brecha digital y preparar a los estudiantes para un mundo cada vez más tecnológico, sin descuidar las habilidades fundamentales de lectoescritura y matemática.</p>

<h2>Implementación</h2>
<p>La implementación será gradual, comenzando por las escuelas de contextos más vulnerables donde el acceso a tecnología es más limitado.</p>
HTML;
}

function getOrquestaBody(): string {
    return <<<HTML
<p class="lead">La Orquesta Escuela de Mar del Plata celebra una década de trabajo formando músicos en barrios populares. Más de 500 niños y jóvenes han pasado por el programa que ofrece formación musical gratuita.</p>

<h2>Historia del proyecto</h2>
<p>La orquesta nació en 2016 con apenas 20 chicos y 5 instrumentos prestados. Hoy cuenta con 150 integrantes activos y un inventario de más de 80 instrumentos propios.</p>

<h3>Sedes barriales</h3>
<p>El programa funciona en 4 sedes ubicadas en los barrios Las Heras, Libertad, Alto Camet y el Puerto. Cada sede ofrece clases dos veces por semana.</p>

<h3>Instrumentos que se enseñan</h3>
<p>Los estudiantes pueden elegir entre violín, viola, violonchelo, contrabajo, flauta, clarinete y percusión. Los instrumentos son prestados a los alumnos para que practiquen en sus casas.</p>

<h2>Impacto social</h2>
<p>Más allá de la formación musical, el programa ha tenido un impacto significativo en la vida de los participantes: mejora en el rendimiento escolar, desarrollo de habilidades sociales y fortalecimiento de la autoestima.</p>

<h2>Concierto aniversario</h2>
<p>Para celebrar los 10 años, se realizará un gran concierto en el Teatro Colón con la participación de todos los egresados del programa. La entrada será libre y gratuita.</p>
HTML;
}

function getBioplasticoBody(): string {
    return <<<HTML
<p class="lead">Un equipo de investigadores del CONICET y la UNMdP desarrolló un bioplástico a partir de algas marinas que podría revolucionar la industria del packaging alimenticio.</p>

<h2>El descubrimiento</h2>
<p>El material se obtiene a partir de algas pardas que abundan en la costa marplatense. El proceso de producción es más limpio que el plástico convencional y el producto final es 100% biodegradable.</p>

<h3>Propiedades del material</h3>
<p>El bioplástico tiene propiedades similares al polietileno: es flexible, resistente al agua y puede sellarse con calor. Además, es comestible y aporta nutrientes.</p>

<h3>Proceso de producción</h3>
<p>Las algas se cosechan, se secan y se procesan para extraer los polisacáridos que forman la base del material. Luego se mezclan con otros componentes naturales para lograr las propiedades deseadas.</p>

<h2>Aplicaciones</h2>
<p>El material es ideal para envases de alimentos frescos, bolsas de supermercado y packaging de productos orgánicos. Varias empresas locales ya mostraron interés en utilizarlo.</p>

<h2>Próximos pasos</h2>
<p>El equipo está trabajando en escalar la producción y reducir costos. Se estima que en dos años podría estar disponible comercialmente.</p>
HTML;
}

function getForestacionBody(): string {
    return <<<HTML
<p class="lead">Estudiantes de 10 escuelas secundarias de Mar del Plata lideran una campaña de forestación urbana que plantará 1000 árboles nativos en espacios públicos durante el próximo mes.</p>

<h2>El proyecto</h2>
<p>La iniciativa surgió de los centros de estudiantes, preocupados por el cambio climático y la pérdida de espacios verdes en la ciudad.</p>

<h3>Especies seleccionadas</h3>
<p>Se plantarán especies nativas adaptadas al clima local: talas, espinillos, sauces criollos y ceibos. Estas especies requieren menos mantenimiento y favorecen la biodiversidad.</p>

<h3>Lugares de plantación</h3>
<p>Los árboles se plantarán en plazas, bulevares, escuelas y terrenos municipales. Cada escuela "adoptará" una zona y se responsabilizará del cuidado de los ejemplares.</p>

<h2>Capacitación</h2>
<p>Los estudiantes recibieron capacitación del vivero municipal sobre técnicas de plantación y cuidado de árboles. También aprendieron sobre la importancia de los árboles para mitigar el cambio climático.</p>

<h2>Participación comunitaria</h2>
<p>La campaña invita a vecinos y familias a sumarse a las jornadas de plantación que se realizarán los sábados de mayo. No se requiere experiencia previa.</p>

<h2>Meta a futuro</h2>
<p>El objetivo es que la campaña se repita cada año y lograr plantar 10.000 árboles en los próximos 5 años.</p>
HTML;
}

function getEmocionalBody(): string {
    return <<<HTML
<p class="lead">En un mundo cada vez más complejo y demandante, la educación emocional sigue siendo una asignatura pendiente en nuestras escuelas. Es hora de repensar qué significa realmente educar.</p>

<h2>El diagnóstico</h2>
<p>Los índices de ansiedad, depresión y conflictos de convivencia en las escuelas son alarmantes. Sin embargo, el sistema educativo sigue priorizando contenidos cognitivos sobre el desarrollo socioemocional.</p>

<h3>Lo que dicen los datos</h3>
<p>Estudios recientes muestran que el 30% de los adolescentes presenta síntomas de ansiedad y que los conflictos de convivencia se triplicaron en la última década.</p>

<h3>La mirada de los docentes</h3>
<p>Los docentes reconocen la importancia del tema pero señalan que no fueron formados para abordarlo y que el currículum no les deja tiempo para trabajarlo sistemáticamente.</p>

<h2>Experiencias exitosas</h2>
<p>Algunas escuelas han implementado programas de educación emocional con resultados notables: mejora en el clima escolar, reducción del bullying y mejor rendimiento académico.</p>

<h2>Propuestas para avanzar</h2>
<p>Es necesario incorporar la educación emocional en la formación docente, incluirla en el currículum de manera transversal y destinar tiempo específico para su abordaje.</p>

<h2>Conclusión</h2>
<p>Educar no es solo transmitir conocimientos. Es formar personas íntegras, capaces de conocerse, regularse y relacionarse con otros. La educación emocional no es un lujo, es una necesidad urgente.</p>
HTML;
}

function getCooperadorasBody(): string {
    return <<<HTML
<p class="lead">Cooperadoras escolares de toda la ciudad organizan una gran feria de economía social que reunirá a más de 50 emprendimientos de familias de la comunidad educativa.</p>

<h2>El evento</h2>
<p>La feria se realizará el próximo sábado en la Plaza Mitre, de 10 a 18 horas, con entrada libre y gratuita. Habrá música en vivo y actividades para niños.</p>

<h3>Emprendimientos participantes</h3>
<p>Participarán emprendimientos de gastronomía, artesanías, indumentaria, cosmética natural, decoración y más. Todos son llevados adelante por familias de la comunidad educativa.</p>

<h3>Objetivo solidario</h3>
<p>Parte de lo recaudado se destinará a un fondo común para ayudar a escuelas con necesidades urgentes de infraestructura o equipamiento.</p>

<h2>Importancia de las cooperadoras</h2>
<p>Las cooperadoras escolares son fundamentales para el funcionamiento de las escuelas públicas. Sostienen comedores, compran materiales y realizan mejoras edilicias con el esfuerzo de las familias.</p>

<h2>Red de cooperadoras</h2>
<p>Este evento marca el inicio de una red de cooperadoras que buscará articular esfuerzos y compartir experiencias entre distintas escuelas de la ciudad.</p>
HTML;
}

function getDiplomaturaBody(): string {
    return <<<HTML
<p class="lead">La Facultad de Humanidades de la UNMdP lanza una nueva Diplomatura en Educación Inclusiva, orientada a formar profesionales para trabajar con estudiantes con discapacidad en todos los niveles educativos.</p>

<h2>Características de la diplomatura</h2>
<p>El programa tiene una duración de un año y está destinado a docentes, profesionales de la salud y personas interesadas en la temática de inclusión educativa.</p>

<h3>Plan de estudios</h3>
<p>La diplomatura incluye módulos sobre marcos legales, estrategias didácticas, tecnologías de apoyo, trabajo con familias y diseño universal del aprendizaje.</p>

<h3>Modalidad</h3>
<p>Se dictará en modalidad semipresencial, con encuentros mensuales los sábados y actividades virtuales durante la semana. Esto permite que profesionales en actividad puedan cursarla.</p>

<h2>Cuerpo docente</h2>
<p>El equipo docente incluye especialistas en educación especial, psicología, fonoaudiología y terapia ocupacional, tanto de la universidad como de instituciones de la comunidad.</p>

<h2>Articulación con escuelas</h2>
<p>Los estudiantes realizarán prácticas en escuelas de la ciudad que desarrollan proyectos de inclusión, lo que garantiza una formación teórico-práctica.</p>

<h2>Inscripción</h2>
<p>Las inscripciones estarán abiertas durante todo febrero. Se otorgarán becas para docentes de escuelas públicas.</p>
HTML;
}
