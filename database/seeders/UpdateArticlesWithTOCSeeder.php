<?php

namespace Database\Seeders;

use App\Models\Article;
use Illuminate\Database\Seeder;

class UpdateArticlesWithTOCSeeder extends Seeder
{
    public function run(): void
    {
        // Update featured article with structured content
        $article = Article::where('is_featured', true)->first();

        if ($article) {
            $article->body = $this->getFeaturedArticleBody();
            $article->save();
            $this->command->info("Updated article: {$article->title}");
        }

        // Update another article
        $article2 = Article::where('slug', 'like', '%unmdp%')->first();
        if ($article2) {
            $article2->body = $this->getUniversityArticleBody();
            $article2->save();
            $this->command->info("Updated article: {$article2->title}");
        }

        // Update opinion article
        $article3 = Article::where('slug', 'like', '%opinion%')->first();
        if ($article3) {
            $article3->body = $this->getOpinionArticleBody();
            $article3->save();
            $this->command->info("Updated article: {$article3->title}");
        }
    }

    private function getFeaturedArticleBody(): string
    {
        return <<<HTML
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

<p>Las asambleas distritales comenzarán el lunes y se extenderán durante toda la semana. Se espera una alta participación de los docentes, quienes expresan su malestar por la situación salarial.</p>

<h2>Impacto en las escuelas</h2>
<p>De confirmarse las medidas de fuerza, más de 15.000 escuelas bonaerenses podrían verse afectadas. Las familias expresan preocupación por la continuidad del ciclo lectivo, aunque los gremios aseguran que agotarán todas las instancias de diálogo antes de ir al paro.</p>

<p>Desde el Consejo Escolar de General Pueyrredón se hizo un llamado al diálogo y se ofreció mediar entre las partes para encontrar una solución que garantice el derecho a la educación de los estudiantes.</p>
HTML;
    }

    private function getUniversityArticleBody(): string
    {
        return <<<HTML
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
<p>El rector de la UNMdP destacó que "estas carreras representan la apuesta de la universidad por formar profesionales en áreas estratégicas para el desarrollo de nuestra ciudad y la región". Además, adelantó que se están evaluando otras propuestas para los próximos años.</p>
HTML;
    }

    private function getOpinionArticleBody(): string
    {
        return <<<HTML
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
HTML;
    }
}
