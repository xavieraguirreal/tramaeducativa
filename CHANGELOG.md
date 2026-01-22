# Changelog

Historial de cambios del proyecto Trama Educativa.

---

## [2026-01-21]

### Agregado
- **Resúmenes IA ("Puntos clave")**: Generación automática de bullet points para cada artículo usando GPT-4o-mini
- **Espacios publicitarios**: Placeholders para Google AdSense en home y artículos
  - `ad-home-top`: Banner horizontal después del bento grid
  - `ad-home-middle`: Banner horizontal entre secciones
  - `ad-sidebar-1`: Cuadrado en sidebar
  - `ad-article-bottom`: Después del contenido del artículo
  - `ad-article-related`: Antes de artículos relacionados
- **Iconos SVG en categorías**: Reemplazo de letras por iconos representativos (Heroicons)
- **Documentación backend**: `PLAN_BACKEND.md` y `PROPUESTA_BACKEND_TRAMA.md`
- **Módulo de publicidad** agregado al plan backend como opcional

### Modificado
- **Animación de reacciones**: Cambio de confetti a emoji flotante
- **Diseño "Puntos clave"**: Estilo más limpio sin etiqueta "Beta"
- **Home mejorada**: Más artículos (12 en lugar de 6) y secciones por categoría
- **Propuesta actualizada**: Addendum con resúmenes IA y precios actualizados

---

## [2026-01-20]

### Agregado
- **Table of Contents (TOC)**: Índice lateral en artículos con scroll spy
- **Soporte HTML en artículos**: Headings, listas, blockquotes, etc.
- **Artículos de demo**: 10 nuevos artículos con contenido estructurado
- **Scripts de actualización**: Para generar TOC y embeddings

### Modificado
- **Meta tags corregidos**: Acentos en región, política, educación
- **Imagen OG por defecto**: og-default.jpg para compartir en redes

---

## [2026-01-19]

### Agregado
- **Feed RSS**: Sindicación de contenido
- **Búsqueda semántica**: Con OpenAI embeddings
- **Artículos relacionados con IA**: Sugerencias basadas en similitud de contenido
- **Page loader**: Animación de carga con logo
- **Lazy loading**: Carga diferida de imágenes
- **TTS mejorado**: Selección automática de voz española/latina

---

## [2026-01-18]

### Agregado
- **Diseño Bento Grid**: Layout modular para home
- **Modo oscuro/claro**: Con persistencia en localStorage
- **Text-to-Speech básico**: Lectura de artículos con Web Speech API
- **Progreso de lectura**: Barra indicadora de scroll
- **Sistema de reacciones**: Informativo, Me gusta, Importante, Para pensar
- **Lista de lectura**: Guardar artículos para después
- **Compartir**: Twitter, Facebook, WhatsApp, LinkedIn, copiar link

---

## Roadmap

### Fase 1 - Backend (Planificado)
- [ ] Sistema de roles y permisos
- [ ] Autenticación 2FA (opcional)
- [ ] Log de actividad
- [ ] Flujo editorial (borrador → revisión → publicado)
- [ ] Editor de bloques mejorado
- [ ] Media Library con optimización

### Fase 2 - Backend (Planificado)
- [ ] SEO avanzado con previews
- [ ] API REST
- [ ] PWA (opcional)

### Módulos Opcionales
- [ ] Newsletter y email marketing
- [ ] Sistema de comentarios
- [ ] Dashboard de estadísticas
- [ ] Radio Trama (podcasts)
- [ ] Gestión de publicidad (AdSense)

---

*Mantenido por VERUMax*
