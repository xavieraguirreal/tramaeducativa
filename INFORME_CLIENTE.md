# TRAMA EDUCATIVA

## Informe Tecnologico del Portal de Noticias

### Cooperativa de Trabajo Minga Ltda.

---

## Resumen Ejecutivo

Trama Educativa es un portal de noticias moderno, rapido y accesible, desarrollado con tecnologias de ultima generacion. Diseñado especificamente para la comunidad educativa de Mar del Plata y la region, ofrece una experiencia de usuario superior en cualquier dispositivo.

---

## Stack Tecnologico

| Componente    | Tecnologia            | Beneficio                             |
| ------------- | --------------------- | ------------------------------------- |
| Backend       | Laravel 11 (PHP 8.2+) | Framework robusto, seguro y escalable |
| Frontend      | Blade + Alpine.js     | Interactividad sin complejidad        |
| Estilos       | Tailwind CSS          | Diseño moderno y responsive           |
| Panel Admin   | Filament 3            | Gestion de contenido intuitiva        |
| Base de Datos | MySQL                 | Confiabilidad y rendimiento           |
| IA            | OpenAI Embeddings     | Busqueda semantica inteligente        |

---

## Funcionalidades Destacadas

### 1. Busqueda Inteligente con IA

- **Busqueda por texto**: Busqueda tradicional por palabras clave
- **Busqueda semantica**: Utiliza Inteligencia Artificial (OpenAI) para encontrar articulos por *significado*, no solo palabras exactas
- Muestra porcentaje de coincidencia para resultados semanticos

### 2. Articulos Relacionados con IA

- Sistema inteligente que sugiere articulos similares basandose en el contenido, no solo en la categoria
- Mejora el tiempo de permanencia y engagement del lector

### 3. Accesibilidad y Experiencia de Usuario

| Funcion              | Descripcion                                                                  |
| -------------------- | ---------------------------------------------------------------------------- |
| Modo Oscuro          | Tema claro/oscuro con memoria de preferencia                                 |
| TTS (Text-to-Speech) | Escuchar articulos en voz alta, seleccion automatica de voz argentina/latina |
| Tamaño de Texto      | Ajuste de tamaño de fuente (A- / A / A+ / A++)                               |
| Barra de Progreso    | Indicador visual de lectura del articulo                                     |
| Lista de Lectura     | Guardar articulos para leer despues (sin registro)                           |

### 4. Engagement e Interaccion

- **Reacciones**: Los lectores pueden reaccionar a las notas (Informativo, Me gusta, Importante, Para pensar)
- **Compartir**: Botones para X (Twitter), Facebook, WhatsApp, LinkedIn y copiar link
- **Ticker de Noticias**: Cinta de noticias destacadas en tiempo real

### 5. Performance y Optimizacion

| Optimizacion         | Impacto                                                 |
| -------------------- | ------------------------------------------------------- |
| Lazy Loading         | Imagenes cargan bajo demanda, pagina inicial mas rapida |
| Page Loader          | Transicion visual suave durante la carga                |
| Cache Inteligente    | Busquedas semanticas cacheadas por 1 hora               |
| Imagenes Responsivas | Adaptadas a cada dispositivo                            |

### 6. SEO y Visibilidad

- **Meta tags optimizados**: Title, description, keywords por pagina
- **Open Graph**: Vista previa enriquecida en Facebook y redes sociales
- **Twitter Cards**: Vista previa optimizada para X
- **URL Canonicas**: Evita contenido duplicado
- **Feed RSS**: Sindicacion de contenido para lectores de noticias
- **Sitemap**: Indexacion eficiente por buscadores

### 7. Panel de Administracion (Filament)

El equipo editorial cuenta con un panel completo para:

- Crear, editar y programar articulos
- Gestionar categorias y etiquetas
- Administrar autores con perfiles y avatares
- Subir y gestionar imagenes
- Ver estadisticas de visualizaciones
- Generar embeddings de IA con un clic

---

## Diseño Responsive

El portal se adapta perfectamente a:

- Escritorio (1920px+)
- Laptop (1024px - 1919px)
- Tablet (768px - 1023px)
- Movil (320px - 767px)

Cada vista esta optimizada para ofrecer la mejor experiencia en su dispositivo.

---

## Seguridad

- Proteccion CSRF en todos los formularios
- Sanitizacion de entradas de usuario
- Headers de seguridad configurados
- Credenciales protegidas en variables de entorno
- Panel admin con autenticacion segura

---

## Integraciones

| Servicio       | Uso                                                         |
| -------------- | ----------------------------------------------------------- |
| OpenAI API     | Embeddings para busqueda semantica y articulos relacionados |
| Web Speech API | Text-to-Speech nativo del navegador (sin costo)             |
| Google Fonts   | Tipografias optimizadas                                     |
| Unsplash       | Imagenes de respaldo                                        |

---

## Metricas de Calidad

- **Tiempo de carga**: < 3 segundos en conexion 4G
- **Mobile-friendly**: 100% compatible con dispositivos moviles
- **Accesibilidad**: Navegacion por teclado, etiquetas ARIA, contraste adecuado

---

## Costo Operativo de IA

| Concepto                            | Costo                                   |
| ----------------------------------- | --------------------------------------- |
| Embeddings (text-embedding-3-small) | ~$0.02 USD / 1 millon de tokens         |
| Estimado mensual (500 articulos)    | < $1 USD                                |
| TTS                                 | Gratuito (usa el navegador del usuario) |

---

## Proximos Pasos Recomendados

1. **Carga de contenido**: Migrar articulos existentes al nuevo portal
2. **Generacion de embeddings**: Ejecutar script para habilitar busqueda IA
3. **Configuracion DNS**: Apuntar dominio definitivo
4. **SSL**: Activar certificado HTTPS
5. **Analytics**: Integrar Google Analytics o similar

---

## Soporte y Mantenimiento

El portal esta diseñado para requerir minimo mantenimiento:

- Actualizaciones de seguridad periodicas
- Backup automatico de base de datos (configurar en hosting)
- Panel admin intuitivo para gestion diaria

---

## Conclusion

Trama Educativa representa un salto tecnologico significativo para la comunicacion de la comunidad educativa marplatense. Combina tecnologias de vanguardia como Inteligencia Artificial con una experiencia de usuario accesible e intuitiva, posicionando al portal como una referencia en medios digitales educativos de la region.

---

*Desarrollado para Cooperativa de Trabajo Minga Ltda.*
*Enero 2026*
