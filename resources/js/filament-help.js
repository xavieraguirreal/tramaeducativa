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
            element: '[href*="/admin"]',
            popover: {
                title: 'Panel de Administración',
                description: 'Bienvenido al panel de Trama Educativa. Desde aquí puedes gestionar todo el contenido del sitio.',
                side: 'bottom'
            }
        },
        {
            element: 'nav[aria-label="Sidebar"]',
            popover: {
                title: 'Menú Principal',
                description: 'Este es el menú de navegación. Aquí encontrarás todas las secciones: Artículos, Categorías, Autores y Etiquetas.',
                side: 'right'
            }
        },
        {
            element: '[href*="articles"]',
            popover: {
                title: 'Artículos',
                description: 'Gestiona los artículos del portal. Puedes crear, editar, publicar y eliminar notas.',
                side: 'right'
            }
        },
        {
            element: '[href*="categories"]',
            popover: {
                title: 'Categorías',
                description: 'Organiza los artículos en categorías temáticas.',
                side: 'right'
            }
        },
        {
            element: '[href*="authors"]',
            popover: {
                title: 'Autores',
                description: 'Administra los autores y colaboradores del portal.',
                side: 'right'
            }
        },
        {
            element: '[href*="tags"]',
            popover: {
                title: 'Etiquetas',
                description: 'Crea y gestiona etiquetas para clasificar el contenido.',
                side: 'right'
            }
        }
    ],

    // Listado de artículos
    'articles': [
        {
            element: 'h1',
            popover: {
                title: 'Listado de Artículos',
                description: 'Aquí ves todos los artículos del portal. Puedes ordenarlos, filtrarlos y buscar.',
                side: 'bottom'
            }
        },
        {
            element: '[wire\\:click*="create"], a[href*="create"]',
            popover: {
                title: 'Crear Artículo',
                description: 'Haz clic aquí para crear un nuevo artículo.',
                side: 'left'
            }
        },
        {
            element: 'input[type="search"], input[placeholder*="Buscar"]',
            popover: {
                title: 'Buscar',
                description: 'Escribe aquí para buscar artículos por título o contenido.',
                side: 'bottom'
            }
        },
        {
            element: 'table, .fi-ta-table',
            popover: {
                title: 'Tabla de Artículos',
                description: 'Haz clic en cualquier fila para editar el artículo. Las columnas se pueden ordenar haciendo clic en el encabezado.',
                side: 'top'
            }
        }
    ],

    // Crear/Editar artículo
    'articles-form': [
        {
            element: 'input[name*="title"], [wire\\:model*="title"]',
            popover: {
                title: 'Título',
                description: 'El título principal del artículo. Será visible en el listado y en la página del artículo.',
                side: 'bottom'
            }
        },
        {
            element: '[wire\\:model*="category"], select[name*="category"]',
            popover: {
                title: 'Categoría',
                description: 'Selecciona la categoría principal del artículo.',
                side: 'bottom'
            }
        },
        {
            element: '[wire\\:model*="author"], select[name*="author"]',
            popover: {
                title: 'Autor',
                description: 'Selecciona quién escribió este artículo.',
                side: 'bottom'
            }
        },
        {
            element: '[wire\\:model*="content"], .trix-editor, .ql-editor, textarea',
            popover: {
                title: 'Contenido',
                description: 'Escribe aquí el cuerpo del artículo. Puedes usar formato, agregar imágenes y enlaces.',
                side: 'top'
            }
        },
        {
            element: 'button[type="submit"], button[wire\\:click*="save"]',
            popover: {
                title: 'Guardar',
                description: 'Cuando termines, haz clic aquí para guardar los cambios.',
                side: 'left'
            }
        }
    ],

    // Categorías
    'categories': [
        {
            element: 'h1',
            popover: {
                title: 'Categorías',
                description: 'Las categorías organizan los artículos por temas. Cada artículo debe tener una categoría.',
                side: 'bottom'
            }
        },
        {
            element: '[wire\\:click*="create"], a[href*="create"]',
            popover: {
                title: 'Nueva Categoría',
                description: 'Crea una nueva categoría para organizar los artículos.',
                side: 'left'
            }
        }
    ],

    // Autores
    'authors': [
        {
            element: 'h1',
            popover: {
                title: 'Autores',
                description: 'Gestiona los autores del portal. Cada autor puede tener múltiples artículos.',
                side: 'bottom'
            }
        }
    ],

    // Etiquetas
    'tags': [
        {
            element: 'h1',
            popover: {
                title: 'Etiquetas',
                description: 'Las etiquetas permiten clasificar artículos con palabras clave. Un artículo puede tener múltiples etiquetas.',
                side: 'bottom'
            }
        }
    ]
};

// Tips estáticos por página
const tips = {
    'dashboard': [
        { selector: 'nav[aria-label="Sidebar"]', text: 'Menú principal de navegación', type: 'info' },
        { selector: '[href*="articles"]', text: 'Gestión de artículos', type: 'info' },
    ],
    'articles': [
        { selector: '[wire\\:click*="create"], a[href*="create"]', text: 'Crear nuevo artículo', type: 'action' },
        { selector: 'input[type="search"], input[placeholder*="Buscar"]', text: 'Buscar por título o contenido', type: 'tip' },
        { selector: 'th', text: 'Clic para ordenar', type: 'tip' },
    ],
    'categories': [
        { selector: '[wire\\:click*="create"], a[href*="create"]', text: 'Crear nueva categoría', type: 'action' },
    ],
    'authors': [
        { selector: '[wire\\:click*="create"], a[href*="create"]', text: 'Agregar nuevo autor', type: 'action' },
    ],
    'tags': [
        { selector: '[wire\\:click*="create"], a[href*="create"]', text: 'Crear nueva etiqueta', type: 'action' },
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
            position: absolute;
            z-index: 9999;
            animation: tramaTipFadeIn 0.3s ease-out;
            animation-delay: ${index * 0.1}s;
            animation-fill-mode: both;
        `;

        // Posicionar tooltip
        const rect = element.getBoundingClientRect();
        tooltip.style.top = `${rect.top + window.scrollY - 10}px`;
        tooltip.style.left = `${rect.right + window.scrollX + 10}px`;

        document.body.appendChild(tooltip);
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
