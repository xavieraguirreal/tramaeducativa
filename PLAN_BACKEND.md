# Plan de Desarrollo Backend - Trama Educativa

## Estado Actual

### Ya implementado:
- [x] Modelos: Article, Category, Author, Tag
- [x] Búsqueda semántica con IA (embeddings)
- [x] Artículos relacionados con IA
- [x] Resúmenes IA automáticos ("Puntos clave")
- [x] Sistema de reacciones (localStorage)
- [x] Lista de lectura (localStorage)
- [x] TTS básico (navegador)
- [x] Feed RSS
- [x] Panel Filament básico

---

## Fase 1: Gestión de Usuarios y Contenido

### 1.1 Sistema de Roles y Permisos
- [ ] Roles predefinidos:
  - **Super Admin**: Acceso total
  - **Editor**: Puede publicar y editar todo
  - **Redactor**: Puede crear y editar sus artículos, enviar a revisión
  - **Colaborador**: Solo puede crear borradores
- [ ] Permisos granulares con Spatie Permission
- [ ] Asignación de roles desde el panel admin

### 1.2 Log de Actividad
- [ ] Registro automático de acciones (quién hizo qué y cuándo)
- [ ] Historial de cambios en artículos
- [ ] Panel para ver actividad reciente
- [ ] Filtros por usuario, acción, fecha

### 1.3 Flujo Editorial Mejorado
- [ ] Estados de artículo: `borrador` → `revisión` → `publicado` → `archivado`
- [ ] Programar publicación (fecha/hora futura)
- [ ] Notificación cuando un artículo está pendiente de revisión
- [ ] Versionado de artículos (restaurar versiones anteriores)

### 1.4 Editor de Contenido Mejorado
- [ ] Editor de bloques estilo Notion/Gutenberg (opcional)
- [ ] Bloques disponibles:
  - Párrafo, Encabezados (H2, H3, H4)
  - Imagen con caption
  - Cita/Blockquote
  - Lista (ordenada/desordenada)
  - Video embebido (YouTube, Vimeo)
  - Audio embebido
  - Separador
  - Llamada a la acción (CTA)
- [ ] Vista previa en tiempo real
- [ ] Autoguardado de borradores

### 1.5 Media Library
- [ ] Galería centralizada de imágenes
- [ ] Subida con drag & drop
- [ ] Redimensionado automático (thumbnail, medium, large)
- [ ] Optimización automática (compresión WebP)
- [ ] Metadatos: título, alt text, créditos
- [ ] Búsqueda y filtros en galería
- [ ] **IA Opcional**: Generación automática de alt text con visión IA

---

## Fase 2: Newsletter y Configuración

### 2.1 Sistema de Newsletter
- [ ] Gestión de suscriptores
- [ ] Doble opt-in (confirmación por email)
- [ ] Importar/exportar suscriptores (CSV)
- [ ] Segmentación por categorías de interés
- [ ] Estadísticas: suscripciones, bajas, tasa de apertura

### 2.2 Campañas de Email
- [ ] Crear campañas con editor visual
- [ ] Templates prediseñados
- [ ] Programar envíos
- [ ] Newsletter automático semanal con artículos destacados
- [ ] **IA Opcional**: Generación de asunto de email optimizado

### 2.3 Integración de Email
- [ ] Resend (recomendado, económico)
- [ ] Mailchimp (alternativa)
- [ ] SMTP genérico

### 2.4 Configuración General del Sitio
- [ ] Información básica: nombre, descripción, logo, favicon
- [ ] Redes sociales (links)
- [ ] Configuración de SEO global (meta por defecto)
- [ ] Google Analytics / Tag Manager
- [ ] Scripts personalizados (header/footer)

### 2.5 Gestión de Menús
- [ ] Editor visual de menús
- [ ] Menú principal (header)
- [ ] Menú footer
- [ ] Menú móvil
- [ ] Soporte para mega-menú (opcional)

### 2.6 Widgets y Sidebar
- [ ] Gestión de widgets del sidebar
- [ ] Widgets disponibles:
  - Artículos más leídos
  - Categorías
  - Tags populares
  - Newsletter
  - Banner/Publicidad
  - HTML personalizado
  - Redes sociales
- [ ] Ordenar widgets con drag & drop

---

## Fase 3: Interacción y Estadísticas

### 3.1 Sistema de Comentarios
- [ ] Comentarios en artículos
- [ ] Moderación: aprobar antes de publicar (configurable)
- [ ] Respuestas anidadas (1 nivel)
- [ ] Reportar comentario
- [ ] Notificación al autor cuando comentan su artículo
- [ ] Anti-spam básico (honeypot, rate limiting)
- [ ] **IA Opcional**: Detección de comentarios tóxicos/spam

### 3.2 Sistema de Reacciones (migrar a DB)
- [ ] Migrar reacciones de localStorage a base de datos
- [ ] Conteo real de reacciones por artículo
- [ ] Prevención de votos múltiples (fingerprint/cookie)
- [ ] Estadísticas de engagement

### 3.3 Dashboard de Estadísticas
- [ ] Métricas en tiempo real:
  - Visitas hoy/semana/mes
  - Artículos publicados
  - Comentarios pendientes
  - Suscriptores nuevos
- [ ] Gráficos:
  - Visitas por día (últimos 30 días)
  - Artículos más leídos
  - Categorías más populares
  - Fuentes de tráfico (si hay Analytics)
- [ ] Exportar reportes (PDF/Excel)

### 3.4 Estadísticas por Artículo
- [ ] Vistas totales y únicas
- [ ] Tiempo promedio de lectura
- [ ] Porcentaje de scroll (hasta dónde leen)
- [ ] Reacciones y comentarios
- [ ] Compartidos por red social

---

## Fase 4: SEO Avanzado, Radio y API

### 4.1 SEO Avanzado
- [ ] Meta title/description personalizables por artículo
- [ ] Preview de cómo se ve en Google
- [ ] Preview de cómo se ve en redes sociales
- [ ] Canonical URLs
- [ ] Schema.org markup (Article, NewsArticle, BreadcrumbList)
- [ ] Sitemap XML automático
- [ ] Robots.txt configurable
- [ ] Redirecciones 301 (URLs antiguas)
- [ ] **IA Opcional**: Sugerencias de mejora SEO por artículo

### 4.2 Radio Trama (si aplica)
- [ ] Programación semanal de la radio
- [ ] Gestión de programas
- [ ] Podcasts/episodios (subir audio)
- [ ] Player de radio en vivo (stream externo)
- [ ] Feed RSS de podcasts
- [ ] **IA Opcional**: Transcripción automática de podcasts

### 4.3 API REST
- [ ] Endpoints públicos:
  - `GET /api/articles` - Listar artículos
  - `GET /api/articles/{slug}` - Detalle de artículo
  - `GET /api/categories` - Listar categorías
  - `GET /api/search?q=` - Búsqueda
- [ ] Autenticación con API tokens (para apps)
- [ ] Rate limiting
- [ ] Documentación con Swagger/OpenAPI
- [ ] Webhooks para integraciones (opcional)

### 4.4 PWA y Notificaciones Push (opcional)
- [ ] Manifest.json para PWA
- [ ] Service Worker para offline básico
- [ ] Notificaciones push para artículos nuevos
- [ ] Instalación como app en móvil

---

## Funcionalidades IA (Opcionales - VERUMax IA)

Todas las funcionalidades de IA son opcionales y se activan según necesidad:

| Funcionalidad | Descripción | Estado |
|---------------|-------------|--------|
| Búsqueda semántica | Encontrar artículos por significado | ✅ Implementado |
| Artículos relacionados | Sugerencias basadas en contenido | ✅ Implementado |
| Resúmenes automáticos | "Puntos clave" de cada artículo | ✅ Implementado |
| Meta description | Generar descripción SEO | 🔲 Pendiente |
| Sugerencia de títulos | Alternativas de títulos SEO | 🔲 Pendiente |
| Sugerencia de tags | Tags relevantes automáticos | 🔲 Pendiente |
| Alt text de imágenes | Descripción automática de imágenes | 🔲 Pendiente |
| Detección de spam | Filtrar comentarios tóxicos | 🔲 Pendiente |
| Asunto de newsletter | Optimizar subject de emails | 🔲 Pendiente |
| Análisis SEO | Sugerencias de mejora | 🔲 Pendiente |
| Transcripción audio | Texto de podcasts/audio | 🔲 Pendiente |

---

## Stack Tecnológico

| Componente | Tecnología |
|------------|------------|
| Framework | Laravel 11 |
| Panel Admin | Filament 3 |
| Permisos | Spatie Laravel-Permission |
| Media | Spatie Laravel-MediaLibrary |
| Actividad | Spatie Laravel-Activitylog |
| SEO | Spatie Laravel-Sitemap |
| Email | Laravel Mail + Resend |
| Gráficos | ApexCharts / Chart.js |
| Editor | TipTap o EditorJS (opcional) |
| IA | OpenAI API (via VERUMax) |

---

## Orden de Implementación Sugerido

```
Fase 1 (Base)
├── 1.1 Roles y Permisos
├── 1.2 Log de Actividad
├── 1.3 Flujo Editorial
├── 1.4 Editor Mejorado
└── 1.5 Media Library

Fase 2 (Comunicación)
├── 2.1 Newsletter - Suscriptores
├── 2.2 Newsletter - Campañas
├── 2.3 Integración Email
├── 2.4 Configuración Sitio
├── 2.5 Gestión Menús
└── 2.6 Widgets Sidebar

Fase 3 (Engagement)
├── 3.1 Comentarios
├── 3.2 Reacciones (DB)
├── 3.3 Dashboard Stats
└── 3.4 Stats por Artículo

Fase 4 (Avanzado)
├── 4.1 SEO Avanzado
├── 4.2 Radio Trama
├── 4.3 API REST
└── 4.4 PWA (opcional)
```

---

## Notas

- Cada fase puede implementarse de forma independiente
- Las funcionalidades de IA se activan según el presupuesto del cliente
- El panel Filament permite agregar funcionalidades de forma modular
- Se recomienda implementar las fases en orden para evitar dependencias rotas

---

*Plan creado: 21 de Enero de 2026*
*VERUMax - Desarrollo de Software*
