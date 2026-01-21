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

## Fase 1: Gestión de Usuarios y Contenido (PLANIFICADO)

### 1.1 Sistema de Roles y Permisos
- [ ] Roles predefinidos:
  - **Super Admin**: Acceso total
  - **Editor**: Puede publicar y editar todo
  - **Redactor**: Puede crear y editar sus artículos, enviar a revisión
  - **Colaborador**: Solo puede crear borradores
- [ ] Permisos granulares con Spatie Permission
- [ ] Asignación de roles desde el panel admin

### 1.2 Autenticación Doble Factor (Opcional)
- [ ] 2FA con Google Authenticator / Authy
- [ ] Códigos de recuperación
- [ ] Activación opcional por usuario
- [ ] Obligatorio para Super Admin (configurable)

### 1.3 Log de Actividad
- [ ] Registro automático de acciones (quién hizo qué y cuándo)
- [ ] Historial de cambios en artículos
- [ ] Panel para ver actividad reciente
- [ ] Filtros por usuario, acción, fecha

### 1.4 Flujo Editorial Mejorado
- [ ] Estados de artículo: `borrador` → `revisión` → `publicado` → `archivado`
- [ ] Programar publicación (fecha/hora futura)
- [ ] Notificación cuando un artículo está pendiente de revisión
- [ ] Versionado de artículos (restaurar versiones anteriores)

### 1.5 Editor de Contenido Mejorado
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

### 1.6 Media Library
- [ ] Galería centralizada de imágenes
- [ ] Subida con drag & drop
- [ ] Redimensionado automático (thumbnail, medium, large)
- [ ] Optimización automática (compresión WebP)
- [ ] Metadatos: título, alt text, créditos
- [ ] Búsqueda y filtros en galería
- [ ] **IA Opcional**: Generación automática de alt text con visión IA

---

## Fase 2: SEO Avanzado y API (PLANIFICADO)

### 2.1 SEO Avanzado
- [ ] Meta title/description personalizables por artículo
- [ ] Preview de cómo se ve en Google
- [ ] Preview de cómo se ve en redes sociales
- [ ] Canonical URLs
- [ ] Schema.org markup (Article, NewsArticle, BreadcrumbList)
- [ ] Sitemap XML automático
- [ ] Robots.txt configurable
- [ ] Redirecciones 301 (URLs antiguas)
- [ ] **IA Opcional**: Sugerencias de mejora SEO por artículo

### 2.2 API REST
- [ ] Endpoints públicos:
  - `GET /api/articles` - Listar artículos
  - `GET /api/articles/{slug}` - Detalle de artículo
  - `GET /api/categories` - Listar categorías
  - `GET /api/search?q=` - Búsqueda
- [ ] Autenticación con API tokens (para apps)
- [ ] Rate limiting
- [ ] Documentación con Swagger/OpenAPI
- [ ] Webhooks para integraciones (opcional)

### 2.3 PWA y Notificaciones Push (Opcional)
- [ ] Manifest.json para PWA
- [ ] Service Worker para offline básico
- [ ] Notificaciones push para artículos nuevos
- [ ] Instalación como app en móvil

---

## Módulos Opcionales (Solo se mencionan - No planificados)

Los siguientes módulos están disponibles para implementación futura según necesidad del cliente. No forman parte del desarrollo inicial.

### Newsletter y Comunicación
- Gestión de suscriptores con doble opt-in
- Campañas de email con editor visual
- Templates prediseñados
- Newsletter automático semanal
- Integración con Resend/Mailchimp
- Segmentación por categorías de interés
- **IA Opcional**: Generación de asunto optimizado

### Configuración del Sitio
- Información básica: nombre, descripción, logo, favicon
- Redes sociales (links)
- Configuración de SEO global
- Google Analytics / Tag Manager
- Scripts personalizados (header/footer)
- Editor visual de menús
- Gestión de widgets del sidebar (drag & drop)

### Interacción y Comentarios
- Sistema de comentarios con moderación
- Respuestas anidadas
- Reportar comentario
- Anti-spam (honeypot, rate limiting)
- Migración de reacciones a base de datos
- **IA Opcional**: Detección de comentarios tóxicos/spam

### Estadísticas y Analytics
- Dashboard con métricas en tiempo real
- Gráficos de visitas, artículos más leídos
- Estadísticas por artículo (vistas, tiempo lectura, scroll)
- Exportar reportes (PDF/Excel)

### Radio Trama
- Programación semanal de la radio
- Gestión de programas
- Podcasts/episodios (subir audio)
- Player de radio en vivo (stream externo)
- Feed RSS de podcasts
- **IA Opcional**: Transcripción automática de podcasts

### Gestión de Publicidad (Google AdSense)
- Panel para gestionar espacios publicitarios sin tocar código
- Ubicaciones predefinidas:
  - `ad-home-top`: Banner horizontal en home (después del bento grid)
  - `ad-home-middle`: Banner horizontal entre secciones
  - `ad-sidebar-1`: Cuadrado en sidebar
  - `ad-article-bottom`: Después del contenido del artículo
  - `ad-article-related`: Antes de artículos relacionados
- Configuración por ubicación:
  - Activar/desactivar cada espacio
  - Código AdSense personalizado
  - Tipo de anuncio (horizontal, vertical, cuadrado, responsive)
- Soporte para múltiples proveedores (AdSense, banners propios, HTML personalizado)
- Estadísticas de impresiones (opcional)
- Programar activación/desactivación de anuncios

---

## Funcionalidades IA (Opcionales - VERUMax IA)

Todas las funcionalidades de IA son opcionales y se activan según necesidad:

| Funcionalidad | Descripción | Estado |
|---------------|-------------|--------|
| Búsqueda semántica | Encontrar artículos por significado | ✅ Implementado |
| Artículos relacionados | Sugerencias basadas en contenido | ✅ Implementado |
| Resúmenes automáticos | "Puntos clave" de cada artículo | ✅ Implementado |
| Meta description | Generar descripción SEO | 🔲 Fase 1 |
| Sugerencia de títulos | Alternativas de títulos SEO | 🔲 Fase 1 |
| Sugerencia de tags | Tags relevantes automáticos | 🔲 Fase 1 |
| Alt text de imágenes | Descripción automática de imágenes | 🔲 Fase 1 |
| Análisis SEO | Sugerencias de mejora | 🔲 Fase 2 |
| Detección de spam | Filtrar comentarios tóxicos | 🔲 Opcional |
| Asunto de newsletter | Optimizar subject de emails | 🔲 Opcional |
| Transcripción audio | Texto de podcasts/audio | 🔲 Opcional |

---

## Stack Tecnológico

| Componente | Tecnología |
|------------|------------|
| Framework | Laravel 11 |
| Panel Admin | Filament 3 |
| Permisos | Spatie Laravel-Permission |
| 2FA | Laravel Fortify / Filament Breezy |
| Media | Spatie Laravel-MediaLibrary |
| Actividad | Spatie Laravel-Activitylog |
| SEO | Spatie Laravel-Sitemap |
| Email | Laravel Mail + Resend |
| Gráficos | ApexCharts / Chart.js |
| Editor | TipTap o EditorJS (opcional) |
| IA | OpenAI API (via VERUMax) |

---

## Orden de Implementación

```
Fase 1 (Base) - PLANIFICADO
├── 1.1 Roles y Permisos
├── 1.2 2FA (Opcional)
├── 1.3 Log de Actividad
├── 1.4 Flujo Editorial
├── 1.5 Editor Mejorado
└── 1.6 Media Library

Fase 2 (Avanzado) - PLANIFICADO
├── 2.1 SEO Avanzado
├── 2.2 API REST
└── 2.3 PWA (Opcional)

Módulos Opcionales - SOLO MENCIÓN
├── Newsletter y Comunicación
├── Configuración del Sitio
├── Interacción y Comentarios
├── Estadísticas y Analytics
├── Radio Trama
└── Gestión de Publicidad (AdSense)
```

---

## Notas

- Las Fases 1 y 2 son las planificadas para desarrollo
- Los módulos opcionales se implementan bajo demanda del cliente
- Las funcionalidades de IA se activan según el presupuesto
- El panel Filament permite agregar funcionalidades de forma modular

---

*Plan creado: 21 de Enero de 2026*
*VERUMax - Desarrollo de Software*
