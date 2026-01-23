/**
 * Sistema de Ayuda para Filament Admin
 * - Tour guiado con Driver.js
 * - Tooltips estáticos con Alpine.js
 */

import { driver } from 'driver.js';
import 'driver.js/dist/driver.css';

// Definición de tours por página
const tours = {
    // Dashboard
    'dashboard': [
        {
            popover: {
                title: '¡Bienvenido a Trama Educativa!',
                description: 'Este es tu panel de administración. Desde aquí puedes gestionar todo el contenido del portal de noticias educativas. Te guiaremos por las principales funciones.',
            }
        },
        {
            element: '.fi-sidebar',
            popover: {
                title: 'Menú de Navegación',
                description: 'Este es el menú principal. Desde aquí accedes a todas las secciones del panel: Artículos, Categorías, Autores y Etiquetas.',
                side: 'right'
            }
        },
        {
            element: '.fi-sidebar-group',
            popover: {
                title: 'Sección Contenido',
                description: 'Aquí encontrarás todo lo relacionado con la gestión de contenido del portal.',
                side: 'right'
            }
        },
        {
            element: 'a[href*="articles"]',
            popover: {
                title: 'Artículos',
                description: 'La sección más importante. Aquí creas, editas y publicas las noticias del portal. Es similar a "Entradas" en WordPress.',
                side: 'right'
            }
        },
        {
            element: 'a[href*="categories"]',
            popover: {
                title: 'Categorías',
                description: 'Organiza tus artículos por temas. Cada artículo debe tener una categoría asignada (ej: Locales, Universidad, Gremiales).',
                side: 'right'
            }
        },
        {
            element: 'a[href*="authors"]',
            popover: {
                title: 'Autores',
                description: 'Gestiona los autores del portal. Puedes agregar foto, biografía y redes sociales de cada autor.',
                side: 'right'
            }
        },
        {
            element: 'a[href*="tags"]',
            popover: {
                title: 'Etiquetas',
                description: 'Las etiquetas son palabras clave que ayudan a clasificar el contenido. Un artículo puede tener múltiples etiquetas.',
                side: 'right'
            }
        },
        {
            element: '.fi-avatar',
            popover: {
                title: 'Tu Perfil',
                description: 'Desde aquí puedes cerrar sesión o ver tu perfil de usuario.',
                side: 'bottom'
            }
        },
        {
            element: '#trama-help-buttons',
            popover: {
                title: 'Ayuda Siempre Disponible',
                description: 'Estos botones de ayuda están disponibles en todas las páginas. "Tour" te guía paso a paso, "Tips" muestra consejos rápidos.',
                side: 'bottom'
            }
        }
    ],

    // Listado de artículos
    'articles': [
        {
            element: '.fi-header-heading',
            popover: {
                title: 'Listado de Artículos',
                description: 'Aquí ves todos los artículos del portal. Puedes ver su estado (Borrador/Publicado), categoría, autor y estadísticas de vistas.',
                side: 'bottom'
            }
        },
        {
            element: '.fi-ta-ctn',
            popover: {
                title: 'Tabla de Artículos',
                description: 'Cada fila es un artículo. Puedes ver la imagen destacada, título, categoría, autor, estado y más información.',
                side: 'top'
            }
        },
        {
            element: '.fi-ac-btn-action, a[href*="create"]',
            popover: {
                title: 'Crear Nuevo Artículo',
                description: 'Haz clic aquí para crear un nuevo artículo. Se abrirá el formulario de edición.',
                side: 'left'
            }
        },
        {
            element: '.fi-ta-search-field',
            popover: {
                title: 'Buscar Artículos',
                description: 'Escribe para buscar artículos por título. Es útil cuando tienes muchos artículos.',
                side: 'bottom'
            }
        },
        {
            element: '.fi-ta-header-cell',
            popover: {
                title: 'Ordenar por Columna',
                description: 'Haz clic en cualquier encabezado de columna para ordenar la tabla. Útil para ver los más recientes o más vistos.',
                side: 'bottom'
            }
        },
        {
            element: '.fi-ta-row',
            popover: {
                title: 'Editar un Artículo',
                description: 'Haz clic en "Editar" en cualquier fila para modificar ese artículo. También puedes ver el artículo publicado con "Ver".',
                side: 'left'
            }
        },
        {
            element: '.fi-pagination',
            popover: {
                title: 'Navegación de Páginas',
                description: 'Si tienes muchos artículos, usa estos controles para navegar entre páginas.',
                side: 'top'
            }
        }
    ],

    // Crear/Editar artículo
    'articles-form': [
        {
            popover: {
                title: 'Editor de Artículo',
                description: 'Este es el formulario para crear o editar artículos. Completa los campos y guarda para publicar.',
            }
        },
        {
            element: '.fi-fo-field-wrp:has(input)',
            popover: {
                title: 'Título del Artículo',
                description: 'Escribe un título claro y atractivo. Este título aparecerá en el portal y en los buscadores.',
                side: 'bottom'
            }
        },
        {
            element: '.fi-fo-rich-editor, .trix-editor, textarea[id*="content"]',
            popover: {
                title: 'Contenido del Artículo',
                description: 'Aquí escribes el cuerpo de la noticia. Puedes dar formato al texto, agregar imágenes, enlaces y más.',
                side: 'top'
            }
        },
        {
            element: '.fi-fo-select',
            popover: {
                title: 'Campos de Selección',
                description: 'Usa los desplegables para seleccionar la categoría, autor y otras opciones del artículo.',
                side: 'bottom'
            }
        },
        {
            element: '.fi-fo-file-upload, [wire\\:model*="image"]',
            popover: {
                title: 'Imagen Destacada',
                description: 'Sube una imagen que represente el artículo. Esta imagen aparecerá en el listado y al compartir en redes.',
                side: 'bottom'
            }
        },
        {
            element: '.fi-ac-btn-action[type="submit"], button[wire\\:click*="save"], .fi-form-actions button',
            popover: {
                title: 'Guardar Artículo',
                description: 'Cuando termines, haz clic aquí para guardar. El artículo se publicará según el estado seleccionado.',
                side: 'left'
            }
        }
    ],

    // Categorías
    'categories': [
        {
            element: '.fi-header-heading',
            popover: {
                title: 'Gestión de Categorías',
                description: 'Las categorías organizan tus artículos por temas. Es importante tener categorías claras para que los lectores encuentren el contenido.',
                side: 'bottom'
            }
        },
        {
            element: '.fi-ac-btn-action, a[href*="create"]',
            popover: {
                title: 'Crear Nueva Categoría',
                description: 'Agrega una nueva categoría cuando necesites clasificar contenido de un tema nuevo.',
                side: 'left'
            }
        },
        {
            element: '.fi-ta-ctn',
            popover: {
                title: 'Lista de Categorías',
                description: 'Aquí ves todas las categorías existentes. Puedes editarlas o eliminarlas (si no tienen artículos asociados).',
                side: 'top'
            }
        },
        {
            element: '.fi-ta-row',
            popover: {
                title: 'Editar Categoría',
                description: 'Haz clic en una categoría para editar su nombre, descripción o imagen.',
                side: 'left'
            }
        }
    ],

    // Autores
    'authors': [
        {
            element: '.fi-header-heading',
            popover: {
                title: 'Gestión de Autores',
                description: 'Aquí administras los autores que escriben para el portal. Cada artículo debe tener un autor asignado.',
                side: 'bottom'
            }
        },
        {
            element: '.fi-ac-btn-action, a[href*="create"]',
            popover: {
                title: 'Agregar Nuevo Autor',
                description: 'Registra un nuevo colaborador del portal. Puedes agregar su foto, biografía y enlaces a redes sociales.',
                side: 'left'
            }
        },
        {
            element: '.fi-ta-ctn',
            popover: {
                title: 'Lista de Autores',
                description: 'Todos los autores registrados aparecen aquí. Puedes ver cuántos artículos tiene cada uno.',
                side: 'top'
            }
        },
        {
            element: '.fi-ta-row',
            popover: {
                title: 'Perfil del Autor',
                description: 'Haz clic para editar la información del autor: nombre, foto, biografía y redes sociales.',
                side: 'left'
            }
        }
    ],

    // Etiquetas
    'tags': [
        {
            element: '.fi-header-heading',
            popover: {
                title: 'Gestión de Etiquetas',
                description: 'Las etiquetas son palabras clave que ayudan a clasificar el contenido. A diferencia de las categorías, un artículo puede tener múltiples etiquetas.',
                side: 'bottom'
            }
        },
        {
            element: '.fi-ac-btn-action, a[href*="create"]',
            popover: {
                title: 'Crear Nueva Etiqueta',
                description: 'Agrega una etiqueta nueva. Las etiquetas ayudan a los lectores a encontrar contenido relacionado.',
                side: 'left'
            }
        },
        {
            element: '.fi-ta-ctn',
            popover: {
                title: 'Lista de Etiquetas',
                description: 'Todas las etiquetas del portal. Puedes ver cuántos artículos usan cada etiqueta.',
                side: 'top'
            }
        },
        {
            element: '.fi-ta-row',
            popover: {
                title: 'Editar Etiqueta',
                description: 'Modifica el nombre de la etiqueta. Los artículos que la usan se actualizarán automáticamente.',
                side: 'left'
            }
        }
    ]
};

// Tips estáticos por página
const tips = {
    'dashboard': [
        { selector: '.fi-sidebar', text: 'Menú principal', type: 'info', position: 'right' },
        { selector: 'a[href*="articles"]', text: 'Gestionar noticias', type: 'action', position: 'right' },
        { selector: 'a[href*="categories"]', text: 'Organizar por temas', type: 'info', position: 'right' },
        { selector: 'a[href*="authors"]', text: 'Redactores del portal', type: 'info', position: 'right' },
        { selector: 'a[href*="tags"]', text: 'Palabras clave', type: 'info', position: 'right' },
        { selector: '.fi-avatar', text: 'Tu cuenta', type: 'info', position: 'left' },
        { selector: '#trama-tour-btn', text: 'Guía paso a paso', type: 'tip', position: 'bottom' },
        { selector: '#trama-tips-btn', text: 'Ver/ocultar ayudas', type: 'tip', position: 'bottom' },
    ],
    'articles': [
        { selector: '.fi-ac-btn-action, a[href*="create"]', text: 'Crear artículo nuevo', type: 'action', position: 'left' },
        { selector: '.fi-ta-search-field', text: 'Buscar por título', type: 'tip', position: 'bottom' },
        { selector: '.fi-ta-header-cell:nth-child(2)', text: 'Ordenar por columna', type: 'tip', position: 'bottom' },
        { selector: '.fi-sidebar-item.fi-active', text: 'Estás aquí', type: 'info', position: 'right' },
        { selector: '.fi-ta-row:first-child', text: 'Clic en Editar para modificar', type: 'tip', position: 'left' },
        { selector: '.fi-ta-row:first-child .fi-badge', text: 'Estado del artículo', type: 'info', position: 'top' },
    ],
    'articles-form': [
        { selector: '.fi-fo-field-wrp:first-child', text: 'Título de la noticia', type: 'info', position: 'right' },
        { selector: '.fi-fo-rich-editor, textarea', text: 'Escribe el contenido aquí', type: 'tip', position: 'top' },
        { selector: '.fi-fo-select:first-of-type', text: 'Selecciona categoría', type: 'info', position: 'right' },
        { selector: '.fi-fo-file-upload', text: 'Imagen destacada', type: 'action', position: 'left' },
        { selector: '.fi-form-actions button', text: 'Guardar cambios', type: 'action', position: 'left' },
    ],
    'categories': [
        { selector: '.fi-ac-btn-action, a[href*="create"]', text: 'Agregar categoría', type: 'action', position: 'left' },
        { selector: '.fi-ta-search-field', text: 'Buscar categorías', type: 'tip', position: 'bottom' },
        { selector: '.fi-ta-row:first-child', text: 'Clic para editar', type: 'tip', position: 'left' },
        { selector: '.fi-sidebar-item.fi-active', text: 'Estás aquí', type: 'info', position: 'right' },
    ],
    'authors': [
        { selector: '.fi-ac-btn-action, a[href*="create"]', text: 'Agregar autor', type: 'action', position: 'left' },
        { selector: '.fi-ta-search-field', text: 'Buscar autores', type: 'tip', position: 'bottom' },
        { selector: '.fi-ta-row:first-child', text: 'Clic para editar perfil', type: 'tip', position: 'left' },
        { selector: '.fi-sidebar-item.fi-active', text: 'Estás aquí', type: 'info', position: 'right' },
    ],
    'tags': [
        { selector: '.fi-ac-btn-action, a[href*="create"]', text: 'Crear etiqueta', type: 'action', position: 'left' },
        { selector: '.fi-ta-search-field', text: 'Buscar etiquetas', type: 'tip', position: 'bottom' },
        { selector: '.fi-ta-row:first-child', text: 'Clic para editar', type: 'tip', position: 'left' },
        { selector: '.fi-sidebar-item.fi-active', text: 'Estás aquí', type: 'info', position: 'right' },
    ]
};

// Detectar página actual
function getCurrentPage() {
    const path = window.location.pathname;

    if (path.includes('/articles/create') || path.includes('/articles/') && path.includes('/edit')) {
        return 'articles-form';
    }
    if (path.includes('/articles')) return 'articles';
    if (path.includes('/categories')) return 'categories';
    if (path.includes('/authors')) return 'authors';
    if (path.includes('/tags')) return 'tags';
    if (path.includes('/admin')) return 'dashboard';

    return 'dashboard';
}

// Iniciar tour guiado
function startTour() {
    const page = getCurrentPage();
    const steps = tours[page] || tours['dashboard'];

    // Filtrar solo elementos que existen en la página
    const validSteps = steps.filter(step => {
        if (!step.element) return true;
        return document.querySelector(step.element);
    });

    if (validSteps.length === 0) {
        alert('No hay guía disponible para esta página.');
        return;
    }

    const driverObj = driver({
        showProgress: true,
        animate: true,
        smoothScroll: true,
        allowClose: true,
        stagePadding: 5,
        stageRadius: 5,
        popoverClass: 'trama-tour-popover',
        progressText: 'Paso {{current}} de {{total}}',
        nextBtnText: 'Siguiente',
        prevBtnText: 'Anterior',
        doneBtnText: 'Finalizar',
        steps: validSteps
    });

    driverObj.drive();
}

// Mostrar/Ocultar tooltips estáticos
let tipsVisible = false;
let tipElements = [];

function toggleTips() {
    if (tipsVisible) {
        hideTips();
    } else {
        showTips();
    }
}

function showTips() {
    const page = getCurrentPage();
    const pageTips = tips[page] || [];

    pageTips.forEach((tip, index) => {
        const element = document.querySelector(tip.selector);
        if (!element) return;

        // Crear tooltip
        const tooltip = document.createElement('div');
        tooltip.className = `trama-tip trama-tip-${tip.type}`;
        tooltip.innerHTML = `
            <span class="trama-tip-icon">${tip.type === 'action' ? '!' : tip.type === 'tip' ? '?' : 'i'}</span>
            <span class="trama-tip-text">${tip.text}</span>
        `;
        tooltip.style.cssText = `
            position: fixed;
            z-index: 9999;
            animation: tramaTipFadeIn 0.3s ease-out;
            animation-delay: ${index * 0.1}s;
            animation-fill-mode: both;
            max-width: 200px;
            white-space: nowrap;
        `;

        document.body.appendChild(tooltip);

        // Posicionar tooltip según la posición especificada
        const rect = element.getBoundingClientRect();
        const tooltipRect = tooltip.getBoundingClientRect();
        const position = tip.position || 'right';
        const padding = 8;

        let top, left;

        switch (position) {
            case 'top':
                top = rect.top - tooltipRect.height - padding;
                left = rect.left + (rect.width / 2) - (tooltipRect.width / 2);
                break;
            case 'bottom':
                top = rect.bottom + padding;
                left = rect.left + (rect.width / 2) - (tooltipRect.width / 2);
                break;
            case 'left':
                top = rect.top + (rect.height / 2) - (tooltipRect.height / 2);
                left = rect.left - tooltipRect.width - padding;
                break;
            case 'right':
            default:
                top = rect.top + (rect.height / 2) - (tooltipRect.height / 2);
                left = rect.right + padding;
                break;
        }

        // Ajustar si se sale de la pantalla
        const viewportWidth = window.innerWidth;
        const viewportHeight = window.innerHeight;

        if (left + tooltipRect.width > viewportWidth - 10) {
            left = rect.left - tooltipRect.width - padding;
        }
        if (left < 10) {
            left = 10;
        }
        if (top + tooltipRect.height > viewportHeight - 10) {
            top = viewportHeight - tooltipRect.height - 10;
        }
        if (top < 10) {
            top = 10;
        }

        tooltip.style.top = `${top}px`;
        tooltip.style.left = `${left}px`;

        tipElements.push(tooltip);

        // Resaltar elemento
        element.classList.add('trama-highlighted');
    });

    tipsVisible = true;
    updateTipsButton();
}

function hideTips() {
    tipElements.forEach(tip => tip.remove());
    tipElements = [];

    document.querySelectorAll('.trama-highlighted').forEach(el => {
        el.classList.remove('trama-highlighted');
    });

    tipsVisible = false;
    updateTipsButton();
}

function updateTipsButton() {
    const btn = document.getElementById('trama-tips-btn');
    if (btn) {
        btn.classList.toggle('active', tipsVisible);
    }
}

// Crear botones de ayuda
function createHelpButtons() {
    // Verificar si ya existen
    if (document.getElementById('trama-help-buttons')) return;

    const container = document.createElement('div');
    container.id = 'trama-help-buttons';
    container.innerHTML = `
        <button id="trama-tour-btn" class="trama-help-btn" title="Iniciar Tour Guiado">
            <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                <circle cx="12" cy="12" r="10"></circle>
                <polygon points="10 8 16 12 10 16 10 8"></polygon>
            </svg>
            <span>Tour</span>
        </button>
        <button id="trama-tips-btn" class="trama-help-btn" title="Mostrar/Ocultar Tips">
            <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                <path d="M9 18h6"></path>
                <path d="M10 22h4"></path>
                <path d="M15.09 14c.18-.98.65-1.74 1.41-2.5A4.65 4.65 0 0 0 18 8 6 6 0 0 0 6 8c0 1 .23 2.23 1.5 3.5A4.61 4.61 0 0 1 8.91 14"></path>
            </svg>
            <span>Tips</span>
        </button>
    `;

    // Insertar en el header de Filament
    const header = document.querySelector('header nav, .fi-topbar nav, header');
    if (header) {
        header.appendChild(container);
    } else {
        // Fallback: insertar en body
        container.style.position = 'fixed';
        container.style.top = '10px';
        container.style.right = '80px';
        document.body.appendChild(container);
    }

    // Event listeners
    document.getElementById('trama-tour-btn').addEventListener('click', startTour);
    document.getElementById('trama-tips-btn').addEventListener('click', toggleTips);
}

// Agregar estilos
function addStyles() {
    if (document.getElementById('trama-help-styles')) return;

    const style = document.createElement('style');
    style.id = 'trama-help-styles';
    style.textContent = `
        /* Contenedor de botones */
        #trama-help-buttons {
            display: flex;
            gap: 8px;
            margin-left: auto;
            margin-right: 16px;
        }

        /* Botones de ayuda */
        .trama-help-btn {
            display: flex;
            align-items: center;
            gap: 6px;
            padding: 8px 12px;
            border: none;
            border-radius: 8px;
            background: linear-gradient(135deg, #f59e0b 0%, #d97706 100%);
            color: white;
            font-size: 13px;
            font-weight: 500;
            cursor: pointer;
            transition: all 0.2s ease;
            box-shadow: 0 2px 4px rgba(0,0,0,0.1);
        }

        .trama-help-btn:hover {
            transform: translateY(-1px);
            box-shadow: 0 4px 8px rgba(0,0,0,0.15);
        }

        .trama-help-btn.active {
            background: linear-gradient(135deg, #3b82f6 0%, #1d4ed8 100%);
        }

        #trama-tips-btn {
            background: linear-gradient(135deg, #3b82f6 0%, #1d4ed8 100%);
        }

        #trama-tips-btn:hover {
            background: linear-gradient(135deg, #60a5fa 0%, #3b82f6 100%);
        }

        #trama-tips-btn.active {
            background: linear-gradient(135deg, #10b981 0%, #059669 100%);
        }

        /* Tooltips estáticos */
        .trama-tip {
            display: flex;
            align-items: center;
            gap: 8px;
            padding: 8px 12px;
            border-radius: 8px;
            font-size: 13px;
            font-weight: 500;
            box-shadow: 0 4px 12px rgba(0,0,0,0.15);
            pointer-events: none;
        }

        .trama-tip-info {
            background: linear-gradient(135deg, #3b82f6 0%, #1d4ed8 100%);
            color: white;
        }

        .trama-tip-action {
            background: linear-gradient(135deg, #f59e0b 0%, #d97706 100%);
            color: white;
        }

        .trama-tip-tip {
            background: linear-gradient(135deg, #10b981 0%, #059669 100%);
            color: white;
        }

        .trama-tip-icon {
            display: flex;
            align-items: center;
            justify-content: center;
            width: 20px;
            height: 20px;
            border-radius: 50%;
            background: rgba(255,255,255,0.2);
            font-size: 12px;
            font-weight: bold;
        }

        /* Elemento resaltado */
        .trama-highlighted {
            position: relative;
            outline: 3px solid #3b82f6 !important;
            outline-offset: 2px;
            border-radius: 4px;
            animation: tramaPulse 2s infinite;
        }

        /* Animaciones */
        @keyframes tramaTipFadeIn {
            from {
                opacity: 0;
                transform: translateX(-10px);
            }
            to {
                opacity: 1;
                transform: translateX(0);
            }
        }

        @keyframes tramaPulse {
            0%, 100% {
                outline-color: #3b82f6;
            }
            50% {
                outline-color: #60a5fa;
            }
        }

        /* Override Driver.js styles */
        .trama-tour-popover {
            background: white !important;
            border-radius: 12px !important;
            box-shadow: 0 10px 40px rgba(0,0,0,0.2) !important;
        }

        .trama-tour-popover .driver-popover-title {
            font-size: 16px !important;
            font-weight: 600 !important;
            color: #1f2937 !important;
        }

        .trama-tour-popover .driver-popover-description {
            color: #6b7280 !important;
        }

        .trama-tour-popover .driver-popover-progress-text {
            color: #9ca3af !important;
        }

        .trama-tour-popover button {
            border-radius: 6px !important;
        }

        /* Dark mode support */
        .dark .trama-help-btn {
            box-shadow: 0 2px 4px rgba(0,0,0,0.3);
        }

        .dark .trama-tip {
            box-shadow: 0 4px 12px rgba(0,0,0,0.3);
        }
    `;

    document.head.appendChild(style);
}

// Inicializar cuando el DOM esté listo
function init() {
    // Solo ejecutar en páginas del admin
    if (!window.location.pathname.includes('/admin')) return;

    addStyles();

    // Esperar a que Filament cargue completamente
    const observer = new MutationObserver((mutations, obs) => {
        const header = document.querySelector('header nav, .fi-topbar nav, header');
        if (header) {
            createHelpButtons();
            obs.disconnect();
        }
    });

    observer.observe(document.body, {
        childList: true,
        subtree: true
    });

    // Fallback si el observer no detecta cambios
    setTimeout(() => {
        createHelpButtons();
    }, 2000);

    // Re-crear botones en navegación de Livewire
    document.addEventListener('livewire:navigated', () => {
        setTimeout(createHelpButtons, 500);
        if (tipsVisible) {
            hideTips();
        }
    });
}

// Ejecutar al cargar
if (document.readyState === 'loading') {
    document.addEventListener('DOMContentLoaded', init);
} else {
    init();
}

// Exportar funciones para uso externo
window.TramaHelp = {
    startTour,
    showTips,
    hideTips,
    toggleTips
};
