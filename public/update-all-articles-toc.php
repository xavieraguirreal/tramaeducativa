<?php
/**
 * Script to update ALL articles with structured content for TOC
 * Run once and delete after use
 */

require __DIR__.'/../vendor/autoload.php';

$app = require_once __DIR__.'/../bootstrap/app.php';
$kernel = $app->make(Illuminate\Contracts\Console\Kernel::class);
$kernel->bootstrap();

use App\Models\Article;

echo "<h1>Actualizando TODOS los artículos con contenido estructurado para TOC</h1>";
echo "<pre>";

$articles = Article::all();
$updated = 0;

foreach ($articles as $article) {
    $newBody = generateStructuredContent($article);
    if ($newBody) {
        $article->body = $newBody;
        $article->save();
        echo "✓ Updated: {$article->title}\n";
        $updated++;
    }
}

echo "\n¡Listo! Se actualizaron {$updated} artículos.\n";
echo "IMPORTANTE: Elimina este archivo después de usarlo.\n";
echo "</pre>";

function generateStructuredContent($article): ?string
{
    $slug = $article->slug;

    // Contenido estructurado para cada artículo
    $contents = [
        'el-consejo-escolar-aprueba-plan-de-obras-para-15-escuelas-del-distrito' => <<<HTML
<p class="lead">El Consejo Escolar de General Pueyrredón aprobó por unanimidad el plan de obras que contempla la refacción de 15 establecimientos educativos del distrito. Las tareas incluyen reparación de techos, sistemas eléctricos y sanitarios.</p>

<h2>Escuelas beneficiadas</h2>
<p>Las escuelas beneficiadas se encuentran en distintos barrios de la ciudad, con especial atención a las zonas más vulnerables. Entre ellas se encuentran establecimientos de los barrios Libertad, Las Heras, Bernardino Rivadavia y el Puerto.</p>

<h3>Zona norte</h3>
<p>En la zona norte se intervendrán 5 escuelas primarias y 2 jardines de infantes. Las obras incluyen principalmente reparación de techos dañados por las últimas tormentas.</p>

<h3>Zona sur</h3>
<p>La zona sur recibirá obras en 4 escuelas, focalizadas en sistemas eléctricos y sanitarios que presentan deficiencias desde hace años.</p>

<h3>Zona oeste</h3>
<p>En el oeste de la ciudad se trabajará en 4 establecimientos, incluyendo una escuela técnica que requiere actualización de sus talleres.</p>

<h2>Presupuesto y financiamiento</h2>
<p>El presupuesto asignado supera los 500 millones de pesos y se financiará con fondos provinciales y municipales. El presidente del Consejo Escolar destacó que "es fundamental garantizar que los chicos puedan comenzar las clases en edificios seguros y en condiciones".</p>

<h2>Cronograma de obras</h2>
<p>Las obras comenzarán en febrero y se prevé que estén finalizadas antes del inicio del ciclo lectivo 2026. Se contratará mano de obra local para dinamizar la economía de los barrios.</p>

<h2>Impacto esperado</h2>
<p>Se estima que más de 8.000 estudiantes se beneficiarán directamente de estas mejoras. Las comunidades educativas expresaron su satisfacción por el plan y se comprometieron a colaborar en el cuidado de las instalaciones.</p>
HTML,

        'docentes-bonaerenses-en-alerta-por-nuevas-paritarias-exigen-recomposicion-salarial' => <<<HTML
<p class="lead">Los principales gremios docentes de la provincia de Buenos Aires mantienen el estado de alerta y movilización tras considerar insuficiente la última propuesta salarial del gobierno provincial. La situación genera preocupación en todo el sector educativo.</p>

<h2>La propuesta del gobierno</h2>
<p>El gobierno provincial presentó una oferta de aumento salarial del 15% en tres tramos, que los gremios consideran insuficiente frente a una inflación acumulada que supera el 40% en lo que va del año. La propuesta incluye además una suma fija no remunerativa que los sindicatos rechazan por no impactar en la jubilación.</p>

<p>El ministro de Economía provincial defendió la propuesta argumentando restricciones presupuestarias, mientras que desde Educación se comprometieron a revisar los números en la próxima mesa paritaria.</p>

<h2>Posición de los gremios</h2>
<p>SUTEBA, UDOCBA y FEB coincidieron en rechazar el ofrecimiento que no alcanza a cubrir la pérdida del poder adquisitivo acumulada. "Necesitamos una recomposición real, no parches que se diluyen con la inflación", señaló el secretario general de SUTEBA Mar del Plata.</p>

<h3>SUTEBA</h3>
<p>El Sindicato Unificado de Trabajadores de la Educación de Buenos Aires manifestó su rechazo contundente y convocó a asambleas en todos los distritos. La conducción provincial anunció que evaluará medidas de fuerza si no hay mejoras sustanciales.</p>

<h3>UDOCBA</h3>
<p>La Unión de Docentes de la Provincia de Buenos Aires también rechazó la propuesta y adelantó que participará del plenario provincial. Su secretario general criticó duramente la política educativa del gobierno.</p>

<h3>FEB</h3>
<p>La Federación de Educadores Bonaerenses sumó su voz de rechazo y destacó que los docentes no pueden seguir perdiendo poder adquisitivo mes a mes.</p>

<h2>Próximas acciones</h2>
<p>Para la próxima semana se convocó a un plenario provincial donde se definirán las medidas de fuerza. No se descarta un paro de 48 horas si el gobierno no mejora la oferta.</p>

<h2>Impacto en las escuelas</h2>
<p>De confirmarse las medidas de fuerza, más de 15.000 escuelas bonaerenses podrían verse afectadas. Las familias expresan preocupación por la continuidad del ciclo lectivo.</p>
HTML,

        'la-unmdp-abre-inscripcion-para-nuevas-carreras-en-2026' => <<<HTML
<p class="lead">La Universidad Nacional de Mar del Plata anunció la apertura de inscripciones para tres nuevas carreras que se dictarán a partir del ciclo lectivo 2026. Las propuestas responden a demandas del mercado laboral regional.</p>

<h2>Las nuevas carreras</h2>
<p>Las nuevas propuestas académicas fueron aprobadas por el Consejo Superior tras un extenso proceso de evaluación que incluyó consultas con el sector productivo y análisis de demanda laboral.</p>

<h3>Tecnicatura en Desarrollo de Software</h3>
<p>Con una duración de 3 años, esta carrera formará profesionales capaces de diseñar, desarrollar y mantener aplicaciones de software. El plan de estudios incluye programación, bases de datos, desarrollo web y metodologías ágiles.</p>

<h3>Tecnicatura en Economía Social y Solidaria</h3>
<p>Orientada a formar profesionales para el sector cooperativo y de la economía social, esta tecnicatura de 3 años abordará gestión de cooperativas, finanzas solidarias y desarrollo local.</p>

<h3>Licenciatura en Ciencia de Datos</h3>
<p>Esta carrera de 5 años formará especialistas en análisis de grandes volúmenes de datos, machine learning y visualización de información. Es la primera de su tipo en la región.</p>

<h2>Requisitos de inscripción</h2>
<p>Los interesados deberán presentar título secundario completo, DNI y completar el formulario de preinscripción online. El período de inscripción se extenderá desde el 1 de noviembre hasta el 15 de diciembre.</p>

<h2>Palabras del rector</h2>
<p>El rector de la UNMdP destacó que "estas carreras representan la apuesta de la universidad por formar profesionales en áreas estratégicas para el desarrollo de nuestra ciudad y la región".</p>
HTML,

        'investigadores-de-la-unmdp-desarrollan-sistema-de-monitoreo-ambiental-con-ia' => <<<HTML
<p class="lead">Un equipo de investigadores de la Facultad de Ingeniería de la UNMdP desarrolló un innovador sistema de monitoreo ambiental que utiliza inteligencia artificial para detectar niveles de contaminación en tiempo real.</p>

<h2>Cómo funciona el sistema</h2>
<p>El sistema utiliza sensores IoT distribuidos en puntos estratégicos de la zona costera que recopilan datos sobre calidad del agua y del aire. Estos datos son procesados por algoritmos de machine learning que pueden detectar anomalías y predecir situaciones de riesgo.</p>

<h3>Sensores IoT</h3>
<p>Se instalaron 25 sensores a lo largo de la costa, desde Punta Mogotes hasta el faro. Cada sensor mide temperatura, pH, oxígeno disuelto, turbidez y presencia de contaminantes específicos.</p>

<h3>Procesamiento con IA</h3>
<p>Los algoritmos de inteligencia artificial analizan los datos en tiempo real y pueden identificar patrones que indican contaminación. El sistema aprende continuamente y mejora sus predicciones con el tiempo.</p>

<h2>Plataforma web</h2>
<p>Los datos se transmiten a una plataforma web accesible para la comunidad donde cualquier ciudadano puede consultar el estado ambiental de cada zona. La información se actualiza cada 15 minutos.</p>

<h2>Financiamiento y apoyo</h2>
<p>El proyecto fue financiado por el CONICET y cuenta con el apoyo del municipio de General Pueyrredón. Se espera que esté operativo al 100% para la temporada de verano.</p>

<h2>Próximos pasos</h2>
<p>El equipo planea expandir la red de sensores a otras zonas de la ciudad y desarrollar una aplicación móvil para alertas en tiempo real.</p>
HTML,

        'suteba-mar-del-plata-convoca-a-asamblea-provincial-para-definir-plan-de-lucha' => <<<HTML
<p class="lead">La sección Mar del Plata de SUTEBA convocó a una asamblea abierta para el próximo jueves donde se definirá el plan de lucha en el marco del conflicto salarial con el gobierno provincial.</p>

<h2>Convocatoria y participantes</h2>
<p>Se espera la participación de delegados de todas las escuelas del distrito y representantes de otras secciones de la costa atlántica. La asamblea se realizará en el local sindical de la calle San Martín.</p>

<h2>Orden del día</h2>
<p>El orden del día incluye varios puntos fundamentales para la organización gremial:</p>

<h3>Situación salarial</h3>
<p>Se analizará en detalle la propuesta del gobierno y se evaluarán las distintas alternativas de respuesta. Los delegados traerán el mandato de sus escuelas.</p>

<h3>Estado de las escuelas</h3>
<p>Se presentará un informe sobre las condiciones edilicias de los establecimientos del distrito, con énfasis en los casos más urgentes.</p>

<h3>Defensa de la educación pública</h3>
<p>Se debatirán estrategias para defender el sistema educativo público frente a los recortes presupuestarios anunciados.</p>

<h2>Mensaje de la conducción</h2>
<p>"Es momento de que los y las docentes nos expresemos y decidamos juntos los pasos a seguir", convocó la secretaria general de la sección local. Se espera una alta participación dado el momento crítico que atraviesa el sector.</p>
HTML,

        'adum-reclama-por-condiciones-edilicias-en-facultades-de-la-unmdp' => <<<HTML
<p class="lead">La Asociación de Docentes de la Universidad de Mar del Plata (ADUM) presentó ante el Rectorado un informe detallado sobre las condiciones edilicias de las distintas facultades, reclamando acciones urgentes.</p>

<h2>Principales problemas detectados</h2>
<p>El documento señala múltiples deficiencias que afectan el normal desarrollo de las actividades académicas en varias facultades de la universidad.</p>

<h3>Calefacción</h3>
<p>Varias facultades presentan sistemas de calefacción obsoletos o fuera de funcionamiento. En invierno, docentes y estudiantes deben dictar y tomar clases con abrigo.</p>

<h3>Filtraciones</h3>
<p>Se detectaron filtraciones en techos de al menos 5 edificios, lo que genera humedad y deterioro de materiales didácticos y equipamiento.</p>

<h3>Sistema eléctrico</h3>
<p>El sistema eléctrico de varios edificios está sobrecargado y presenta riesgos. Se han registrado cortes frecuentes que interrumpen las clases.</p>

<h3>Sanitarios</h3>
<p>Los baños de varias facultades requieren reparaciones urgentes y en algunos casos no hay agua caliente.</p>

<h2>Respuesta de la universidad</h2>
<p>La universidad informó que está trabajando en un plan de obras pero los recursos presupuestarios son limitados debido a los recortes del gobierno nacional. "No podemos dictar clases en estas condiciones", advirtió la secretaria general de ADUM.</p>

<h2>Reclamos al gobierno nacional</h2>
<p>ADUM exige que el gobierno nacional restituya el presupuesto universitario para poder realizar las obras necesarias. Se evalúan medidas de protesta conjuntas con otras universidades.</p>
HTML,

        'festival-de-cine-independiente-llega-a-mar-del-plata-con-entrada-libre' => <<<HTML
<p class="lead">La ciudad de Mar del Plata será sede de un nuevo Festival de Cine Independiente que se desarrollará durante cinco días en distintas sedes culturales con entrada libre y gratuita.</p>

<h2>Programación</h2>
<p>La programación incluye más de 50 obras entre largometrajes, cortometrajes y documentales de realizadores locales, regionales y nacionales.</p>

<h3>Largometrajes</h3>
<p>Se proyectarán 12 largometrajes de ficción, incluyendo óperas primas y segundas películas de directores emergentes. Varios competirán por el premio a Mejor Película.</p>

<h3>Documentales</h3>
<p>La sección documental presenta 8 films que abordan temáticas sociales, ambientales y culturales. Destacan trabajos sobre memoria histórica y problemáticas actuales.</p>

<h3>Cortometrajes</h3>
<p>Más de 30 cortometrajes completan la programación, con una sección especial dedicada a realizadores sub-25.</p>

<h2>Actividades paralelas</h2>
<p>Además de las proyecciones, habrá charlas con directores, talleres de formación audiovisual y un concurso para jóvenes cineastas con premios en equipamiento.</p>

<h2>Sedes</h2>
<p>Las proyecciones se realizarán en el Teatro Colón, el Museo MAR y espacios culturales barriales, acercando el cine a todos los vecinos de la ciudad.</p>

<h2>Apoyo institucional</h2>
<p>El festival cuenta con el apoyo del Instituto Cultural de la Provincia de Buenos Aires, la Secretaría de Cultura local y el INCAA.</p>
HTML,

        'biblioteca-popular-del-puerto-celebra-50-anos-con-actividades-para-toda-la-familia' => <<<HTML
<p class="lead">La Biblioteca Popular del Puerto cumple 50 años de vida institucional y lo celebrará con una semana de actividades culturales abiertas a toda la comunidad.</p>

<h2>Historia de la institución</h2>
<p>Fundada en 1976 por un grupo de vecinos del barrio, la biblioteca ha sido un faro cultural para generaciones de marplatenses. Comenzó con apenas 200 libros donados y hoy cuenta con más de 15.000 ejemplares.</p>

<h2>Programación del aniversario</h2>
<p>La semana de celebración incluye actividades para todas las edades:</p>

<h3>Para los más chicos</h3>
<p>Talleres de lectura, narración de cuentos, títeres y manualidades. Se inaugurará una nueva sala de lectura infantil con mobiliario especialmente diseñado.</p>

<h3>Para jóvenes y adultos</h3>
<p>Charlas con escritores locales, club de lectura abierto, proyecciones de películas basadas en libros y un taller de escritura creativa.</p>

<h3>Festival de música</h3>
<p>El cierre será con un festival de música en vivo con bandas locales en el patio de la biblioteca.</p>

<h2>Servicios que ofrece</h2>
<p>"Cincuenta años trabajando por la cultura y la educación de nuestro barrio es motivo de gran orgullo", señaló la presidenta de la biblioteca. La institución atiende a más de 200 socios y ofrece servicios gratuitos de préstamo de libros, acceso a internet y apoyo escolar.</p>

<h2>Cómo colaborar</h2>
<p>Quienes deseen colaborar pueden acercarse a donar libros, hacerse socios o sumarse como voluntarios. La biblioteca funciona de lunes a viernes de 9 a 19 horas.</p>
HTML,

        'provincia-anuncia-cambios-en-el-calendario-escolar-2026' => <<<HTML
<p class="lead">La Dirección General de Cultura y Educación de la Provincia de Buenos Aires dio a conocer el calendario escolar para el ciclo lectivo 2026, que presenta algunas modificaciones respecto al año anterior.</p>

<h2>Fechas principales</h2>
<p>El ciclo lectivo 2026 tendrá las siguientes fechas clave:</p>

<h3>Inicio y fin de clases</h3>
<p>El inicio de clases está previsto para el 2 de marzo y la finalización para el 17 de diciembre, sumando un total de 190 días de clase efectivos.</p>

<h3>Receso de invierno</h3>
<p>El receso de invierno se extenderá del 13 al 24 de julio, coincidiendo con las vacaciones de invierno en todo el país.</p>

<h3>Exámenes</h3>
<p>Los exámenes de febrero y marzo se realizarán del 17 al 28 de febrero. Las mesas de diciembre serán del 1 al 12 de diciembre.</p>

<h2>Jornadas institucionales</h2>
<p>Se incorporan dos jornadas institucionales adicionales para capacitación docente, que se realizarán en abril y agosto. En estas fechas no habrá clases para los estudiantes.</p>

<h2>Feriados y días no laborables</h2>
<p>El calendario contempla todos los feriados nacionales y provinciales. Se recomienda a las familias consultar el calendario completo en la web de la DGCyE.</p>

<h2>Recomendaciones</h2>
<p>Las autoridades educativas recomiendan a las familias planificar con anticipación las vacaciones y evitar ausencias fuera de los períodos de receso establecidos.</p>
HTML,

        'nacion-recorta-fondos-para-comedores-escolares-preocupacion-en-mar-del-plata' => <<<HTML
<p class="lead">El recorte presupuestario anunciado por el gobierno nacional afectará directamente a los comedores escolares de todo el país. En Mar del Plata, más de 50 mil estudiantes podrían ver reducidas las raciones alimentarias.</p>

<h2>El recorte anunciado</h2>
<p>El gobierno nacional comunicó una reducción del 30% en las partidas destinadas a alimentación escolar. Esta medida forma parte del plan de ajuste fiscal y tendrá impacto inmediato en las escuelas.</p>

<h2>Impacto en Mar del Plata</h2>
<p>En nuestra ciudad, más de 50 mil estudiantes reciben almuerzo o merienda en las escuelas. El recorte obligará a reducir la cantidad o calidad de las raciones.</p>

<h3>Escuelas más afectadas</h3>
<p>Las escuelas de barrios vulnerables, donde el comedor es muchas veces la única comida completa del día para los chicos, serán las más perjudicadas.</p>

<h3>Respuesta de las autoridades locales</h3>
<p>Autoridades educativas locales expresaron su preocupación y reclaman al gobierno provincial que cubra la diferencia. "El derecho a la alimentación de nuestros estudiantes no puede estar en juego", manifestó la inspectora jefe distrital.</p>

<h2>Movilización en defensa de los comedores</h2>
<p>Organizaciones sociales y gremios docentes convocaron a una movilización en defensa de los comedores escolares para el próximo viernes frente a la Municipalidad.</p>

<h2>Alternativas que se evalúan</h2>
<p>Se están evaluando alternativas como aportes municipales, donaciones de empresas y campañas solidarias para sostener el servicio de comedores en el nivel actual.</p>
HTML,

        'escuelas-marplatenses-se-suman-al-programa-de-separacion-de-residuos' => <<<HTML
<p class="lead">El programa de educación ambiental del municipio sigue sumando escuelas. Ya son 45 los establecimientos educativos de Mar del Plata que implementan la separación de residuos en origen.</p>

<h2>En qué consiste el programa</h2>
<p>El programa incluye capacitaciones para docentes y estudiantes, provisión de contenedores diferenciados y visitas a la planta de reciclaje municipal.</p>

<h3>Capacitaciones</h3>
<p>Personal municipal visita las escuelas para capacitar sobre la importancia de separar residuos y cómo hacerlo correctamente. Se trabaja con todos los niveles educativos.</p>

<h3>Contenedores</h3>
<p>Cada escuela recibe contenedores de colores para separar: verde para orgánicos, azul para papel y cartón, amarillo para plásticos y vidrios, y negro para no reciclables.</p>

<h3>Visitas educativas</h3>
<p>Los estudiantes visitan la planta de reciclaje municipal donde pueden ver el proceso completo de tratamiento de residuos y entender la importancia de separar en origen.</p>

<h2>Promotores ambientales</h2>
<p>Los alumnos participan activamente como "promotores ambientales" en sus comunidades, llevando el mensaje a sus familias y vecinos.</p>

<h2>Resultados y metas</h2>
<p>"La educación ambiental desde temprana edad es fundamental para construir una ciudad más sustentable", destacó la coordinadora del programa. Se espera sumar 20 escuelas más durante este año, llegando a 65 establecimientos participantes.</p>

<h2>Cómo sumarse</h2>
<p>Las escuelas interesadas en participar pueden inscribirse a través de la Secretaría de Ambiente del municipio.</p>
HTML,

        'opinion-el-futuro-de-la-educacion-publica-esta-en-juego' => <<<HTML
<p class="lead">Estamos viviendo un momento crítico para la educación pública argentina. Los recortes presupuestarios, el deterioro salarial docente y el abandono de la infraestructura escolar configuran un panorama preocupante que requiere nuestra atención urgente.</p>

<h2>El contexto actual</h2>
<p>Los últimos años han sido particularmente difíciles para el sistema educativo. La combinación de crisis económica, pandemia y ajuste presupuestario ha dejado huellas profundas que tardarán años en revertirse.</p>

<p>Las estadísticas son elocuentes: el presupuesto educativo cayó en términos reales, los salarios docentes perdieron frente a la inflación y miles de escuelas necesitan reparaciones urgentes.</p>

<h2>La resistencia de la comunidad educativa</h2>
<p>Sin embargo, la comunidad educativa sigue resistiendo y proponiendo alternativas. Docentes, estudiantes y familias se organizan para defender un derecho que no puede ser mercantilizado.</p>

<h3>El rol de los docentes</h3>
<p>Los y las docentes son el corazón del sistema educativo. A pesar de las condiciones adversas, siguen trabajando con compromiso y creatividad para garantizar el derecho a la educación de cada estudiante.</p>

<h3>La participación de las familias</h3>
<p>Las familias también juegan un rol fundamental. Las cooperadoras escolares, los consejos de padres y las organizaciones barriales sostienen muchas veces lo que el Estado abandona.</p>

<h2>Una mirada hacia el futuro</h2>
<p>Es necesario que toda la sociedad comprenda que invertir en educación no es un gasto sino una inversión en el futuro. La educación pública es la herramienta más poderosa para construir una sociedad más justa e igualitaria.</p>

<h2>Conclusión</h2>
<p>La historia de nuestro país demuestra que los avances sociales siempre estuvieron ligados a la expansión del sistema educativo. No podemos permitir que se retroceda en conquistas que costaron décadas conseguir. Es hora de defender la educación pública con todas nuestras fuerzas.</p>
HTML,

    ];

    // Check if we have content for this article
    if (isset($contents[$slug])) {
        return $contents[$slug];
    }

    return null;
}
