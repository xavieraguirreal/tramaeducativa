# Trama Educativa

Portal de noticias educativas para la Cooperativa de Trabajo Minga Ltda.

## Stack Tecnológico

- **Backend**: Laravel 11
- **Frontend**: Blade + Alpine.js + Tailwind CSS
- **Panel Admin**: Filament 3
- **IA**: OpenAI API (embeddings, GPT-4o-mini)
- **Base de datos**: MySQL

## Funcionalidades Implementadas

### Frontend (Público)
- [x] Diseño Bento Grid responsive
- [x] Modo oscuro/claro
- [x] Búsqueda semántica con IA
- [x] Artículos relacionados con IA
- [x] Resúmenes IA ("Puntos clave")
- [x] Text-to-Speech (TTS)
- [x] Progreso de lectura
- [x] Tabla de contenidos (TOC)
- [x] Sistema de reacciones
- [x] Lista de lectura (guardar para después)
- [x] Compartir en redes sociales
- [x] Feed RSS
- [x] Lazy loading de imágenes
- [x] Espacios para publicidad (AdSense ready)

### Backend (Admin)
- [x] Panel Filament básico
- [x] CRUD de artículos, categorías, autores, tags
- [x] Generación de embeddings

## Documentación

| Archivo | Descripción |
|---------|-------------|
| `PROPUESTA_TRAMA_EDUCATIVA.md` | Propuesta comercial del frontend |
| `PROPUESTA_BACKEND_TRAMA.md` | Propuesta comercial del backend |
| `PLAN_BACKEND.md` | Plan técnico de desarrollo backend |
| `CHANGELOG.md` | Historial de cambios |

## Instalación

```bash
# Clonar repositorio
git clone https://github.com/xavieraguirreal/tramaeducativa.git

# Instalar dependencias
composer install
npm install

# Configurar ambiente
cp .env.example .env
php artisan key:generate

# Migrar base de datos
php artisan migrate

# Compilar assets
npm run build

# Iniciar servidor
php artisan serve
```

## Variables de Entorno

```env
# OpenAI (para búsqueda semántica y resúmenes IA)
OPENAI_API_KEY=sk-xxx
OPENAI_EMBEDDING_MODEL=text-embedding-3-small
```

## Scripts de Mantenimiento

Los siguientes scripts están en `/public/` y deben eliminarse después de usar:

- `generate-ai-summaries.php` - Genera resúmenes IA para artículos existentes
- `add-more-articles.php` - Agrega artículos de demo
- `update-all-articles-toc.php` - Actualiza artículos con estructura HTML para TOC

## Desarrollo

```bash
# Desarrollo con hot reload
npm run dev

# Build para producción
npm run build
```

---

Desarrollado por **VERUMax** - Enero 2026
