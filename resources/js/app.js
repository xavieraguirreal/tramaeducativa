import './bootstrap';
import Alpine from 'alpinejs';

// Make Alpine available globally
window.Alpine = Alpine;

// ================================
// READING PROGRESS BAR
// ================================
function initReadingProgress() {
    const progressBar = document.querySelector('.reading-progress');
    if (!progressBar) return;

    window.addEventListener('scroll', () => {
        const docHeight = document.documentElement.scrollHeight - window.innerHeight;
        const scrolled = (window.scrollY / docHeight) * 100;
        progressBar.style.width = `${Math.min(scrolled, 100)}%`;
    });
}

// ================================
// SCROLL TO TOP
// ================================
function initScrollToTop() {
    const btn = document.querySelector('.scroll-to-top');
    if (!btn) return;

    window.addEventListener('scroll', () => {
        if (window.scrollY > 500) {
            btn.classList.add('visible');
        } else {
            btn.classList.remove('visible');
        }
    });

    btn.addEventListener('click', () => {
        window.scrollTo({ top: 0, behavior: 'smooth' });
    });
}

// ================================
// TOAST NOTIFICATIONS
// ================================
window.showToast = function(message, duration = 3000) {
    // Remove existing toast
    const existing = document.querySelector('.toast');
    if (existing) existing.remove();

    // Create toast
    const toast = document.createElement('div');
    toast.className = 'toast';
    toast.innerHTML = `
        <svg class="w-5 h-5 text-green-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/>
        </svg>
        <span>${message}</span>
    `;
    document.body.appendChild(toast);

    // Show
    requestAnimationFrame(() => {
        toast.classList.add('show');
    });

    // Hide and remove
    setTimeout(() => {
        toast.classList.remove('show');
        setTimeout(() => toast.remove(), 300);
    }, duration);
};

// ================================
// REACTIONS
// ================================
window.TramaReactions = {
    storageKey: 'trama_reactions',

    getReactions() {
        try {
            return JSON.parse(localStorage.getItem(this.storageKey)) || {};
        } catch {
            return {};
        }
    },

    hasReacted(articleId, reactionType) {
        const reactions = this.getReactions();
        return reactions[articleId]?.includes(reactionType);
    },

    toggleReaction(articleId, reactionType, countEl) {
        const reactions = this.getReactions();
        if (!reactions[articleId]) {
            reactions[articleId] = [];
        }

        const index = reactions[articleId].indexOf(reactionType);
        let delta = 0;

        if (index === -1) {
            reactions[articleId].push(reactionType);
            delta = 1;
            showToast('¡Gracias por tu reaccion!');
        } else {
            reactions[articleId].splice(index, 1);
            delta = -1;
        }

        localStorage.setItem(this.storageKey, JSON.stringify(reactions));

        // Update count display
        if (countEl) {
            const current = parseInt(countEl.textContent) || 0;
            countEl.textContent = Math.max(0, current + delta);
        }

        return delta > 0;
    }
};

// ================================
// READING LIST (BOOKMARKS)
// ================================
window.TramaReadingList = {
    storageKey: 'trama_reading_list',

    getList() {
        try {
            return JSON.parse(localStorage.getItem(this.storageKey)) || [];
        } catch {
            return [];
        }
    },

    isSaved(articleSlug) {
        return this.getList().some(item => item.slug === articleSlug);
    },

    toggle(article) {
        const list = this.getList();
        const index = list.findIndex(item => item.slug === article.slug);

        if (index === -1) {
            list.push({
                slug: article.slug,
                title: article.title,
                image: article.image,
                category: article.category,
                savedAt: new Date().toISOString()
            });
            showToast('Guardado en tu lista de lectura');
        } else {
            list.splice(index, 1);
            showToast('Eliminado de tu lista de lectura');
        }

        localStorage.setItem(this.storageKey, JSON.stringify(list));
        this.updateCounter();
        return index === -1;
    },

    updateCounter() {
        const counter = document.querySelector('.reading-list-counter');
        if (counter) {
            const count = this.getList().length;
            counter.textContent = count;
            counter.style.display = count > 0 ? 'flex' : 'none';
        }
    }
};

// ================================
// FLOATING EMOJI EFFECT
// ================================
window.createFloatingEmoji = function(element) {
    const emojiEl = element.querySelector('.emoji');
    if (!emojiEl) return;

    const emoji = emojiEl.textContent.trim();
    const rect = element.getBoundingClientRect();

    // Create 3 floating emojis with slight variations
    for (let i = 0; i < 3; i++) {
        const floater = document.createElement('div');
        floater.className = 'floating-emoji';
        floater.textContent = emoji;
        floater.style.cssText = `
            position: fixed;
            left: ${rect.left + rect.width / 2 + (i - 1) * 20}px;
            top: ${rect.top}px;
            font-size: 1.5rem;
            pointer-events: none;
            z-index: 9999;
        `;
        document.body.appendChild(floater);

        // Animate floating up and fading
        floater.animate([
            { transform: 'translateY(0) scale(1)', opacity: 1 },
            { transform: `translateY(-80px) scale(${1.2 - i * 0.1})`, opacity: 0 }
        ], {
            duration: 700 + i * 100,
            delay: i * 50,
            easing: 'cubic-bezier(0.25, 0.46, 0.45, 0.94)'
        }).onfinish = () => floater.remove();
    }
};

// ================================
// ALPINE.JS DATA COMPONENTS
// ================================
Alpine.data('reactions', (articleId, initialCounts = {}) => ({
    counts: initialCounts,

    init() {
        // Check saved reactions and update UI
        document.querySelectorAll(`[data-reaction-article="${articleId}"]`).forEach(btn => {
            const type = btn.dataset.reactionType;
            if (TramaReactions.hasReacted(articleId, type)) {
                btn.classList.add('active');
            }
        });
    },

    react(type, event) {
        const btn = event.currentTarget;
        const countEl = btn.querySelector('.count');
        const isAdding = TramaReactions.toggleReaction(articleId, type, countEl);

        btn.classList.toggle('active', isAdding);

        if (isAdding) {
            btn.classList.add('pop');
            createFloatingEmoji(btn);
            setTimeout(() => btn.classList.remove('pop'), 300);
        }
    }
}));

Alpine.data('bookmark', (article) => ({
    saved: false,

    init() {
        this.saved = TramaReadingList.isSaved(article.slug);
    },

    toggle() {
        this.saved = TramaReadingList.toggle(article);
    }
}));

Alpine.data('readingListPage', () => ({
    items: [],

    init() {
        this.loadItems();
    },

    loadItems() {
        try {
            this.items = JSON.parse(localStorage.getItem('trama_reading_list')) || [];
            this.items.sort((a, b) => new Date(b.savedAt) - new Date(a.savedAt));
        } catch {
            this.items = [];
        }
    },

    removeItem(slug) {
        this.items = this.items.filter(item => item.slug !== slug);
        localStorage.setItem('trama_reading_list', JSON.stringify(this.items));
        showToast('Articulo eliminado de tu lista');
        TramaReadingList.updateCounter();
    },

    clearAll() {
        if (confirm('¿Seguro que quieres vaciar toda tu lista de lectura?')) {
            this.items = [];
            localStorage.setItem('trama_reading_list', JSON.stringify([]));
            showToast('Lista de lectura vaciada');
            TramaReadingList.updateCounter();
        }
    },

    formatDate(dateString) {
        const date = new Date(dateString);
        const now = new Date();
        const diffMs = now - date;
        const diffMins = Math.floor(diffMs / 60000);
        const diffHours = Math.floor(diffMs / 3600000);
        const diffDays = Math.floor(diffMs / 86400000);

        if (diffMins < 1) return 'hace un momento';
        if (diffMins < 60) return `hace ${diffMins} min`;
        if (diffHours < 24) return `hace ${diffHours}h`;
        if (diffDays < 7) return `hace ${diffDays} dias`;

        return date.toLocaleDateString('es-AR', { day: 'numeric', month: 'short' });
    }
}));

// ================================
// BROKEN IMAGE HANDLER & SKELETON
// ================================
const FALLBACK_IMAGE = 'https://images.unsplash.com/photo-1503676260728-1c00da094a0b?w=800&h=400&fit=crop';

function handleImages() {
    document.querySelectorAll('img').forEach(img => {
        if (img.dataset.imageHandled) return;
        img.dataset.imageHandled = 'true';

        // Add lazy loading
        if (!img.hasAttribute('loading')) {
            img.setAttribute('loading', 'lazy');
        }

        // Add skeleton class to parent if it's a card image
        const parent = img.parentElement;
        if (parent && (parent.tagName === 'A' || parent.classList.contains('overflow-hidden'))) {
            parent.classList.add('img-skeleton');
        }

        // Handle load event
        img.addEventListener('load', function() {
            if (parent && parent.classList.contains('img-skeleton')) {
                parent.classList.add('loaded');
            }
        });

        // Handle error event
        img.addEventListener('error', function() {
            if (this.src !== FALLBACK_IMAGE) {
                this.src = FALLBACK_IMAGE;
            }
            if (parent && parent.classList.contains('img-skeleton')) {
                parent.classList.add('loaded');
            }
        });

        // Check if already loaded (cached)
        if (img.complete) {
            if (img.naturalHeight === 0 && img.src !== FALLBACK_IMAGE) {
                img.src = FALLBACK_IMAGE;
            }
            if (parent && parent.classList.contains('img-skeleton')) {
                parent.classList.add('loaded');
            }
        }
    });
}

// ================================
// TEXT-TO-SPEECH PLAYER
// ================================
Alpine.data('ttsPlayer', () => ({
    isPlaying: false,
    isPaused: false,
    progress: 0,
    progressText: '',
    utterance: null,
    textChunks: [],
    currentChunk: 0,
    selectedVoice: null,

    init() {
        // Check if speech synthesis is available
        if (!('speechSynthesis' in window)) {
            this.$el.style.display = 'none';
            return;
        }

        // Load voices
        this.loadVoices();

        // Voices may load async
        if (window.speechSynthesis.onvoiceschanged !== undefined) {
            window.speechSynthesis.onvoiceschanged = () => this.loadVoices();
        }
    },

    loadVoices() {
        const allVoices = window.speechSynthesis.getVoices();
        this.selectedVoice = this.findBestVoice(allVoices);
    },

    findBestVoice(voices) {
        // Priority: Argentina > Latin America > Spain > Any Spanish
        // Prefer female voices

        const spanishVoices = voices.filter(v => v.lang.startsWith('es'));
        if (spanishVoices.length === 0) return voices[0] || null;

        // Check for female indicators in voice name
        const isFemale = (name) => {
            const femaleNames = ['female', 'femenin', 'mujer', 'woman', 'sabina', 'helena', 'laura', 'lucia', 'monica', 'paulina', 'maria', 'carmen', 'rosa', 'ana', 'elena', 'sofia', 'isabella'];
            return femaleNames.some(f => name.toLowerCase().includes(f));
        };

        // 1. Try Argentina female
        let voice = spanishVoices.find(v => v.lang === 'es-AR' && isFemale(v.name));
        if (voice) return voice;

        // 2. Try Argentina any
        voice = spanishVoices.find(v => v.lang === 'es-AR');
        if (voice) return voice;

        // 3. Try Latin American female (MX, CO, CL, PE, etc.)
        const latinLangs = ['es-MX', 'es-CO', 'es-CL', 'es-PE', 'es-VE', 'es-419', 'es-US'];
        voice = spanishVoices.find(v => latinLangs.includes(v.lang) && isFemale(v.name));
        if (voice) return voice;

        // 4. Try Latin American any
        voice = spanishVoices.find(v => latinLangs.includes(v.lang));
        if (voice) return voice;

        // 5. Try any Spanish female
        voice = spanishVoices.find(v => isFemale(v.name));
        if (voice) return voice;

        // 6. Any Spanish voice
        return spanishVoices[0];
    },

    getArticleText() {
        const content = document.getElementById('article-content');
        if (!content) return '';
        return content.innerText || content.textContent;
    },

    togglePlay() {
        if (this.isPlaying) {
            this.pause();
        } else if (this.isPaused) {
            this.resume();
        } else {
            this.play();
        }
    },

    play() {
        const text = this.getArticleText();
        if (!text) return;

        // Cancel any ongoing speech
        window.speechSynthesis.cancel();

        // Split text into chunks (speech synthesis has limits)
        this.textChunks = this.splitText(text, 200);
        this.currentChunk = 0;
        this.speakChunk();
    },

    splitText(text, maxWords) {
        const words = text.split(/\s+/);
        const chunks = [];
        for (let i = 0; i < words.length; i += maxWords) {
            chunks.push(words.slice(i, i + maxWords).join(' '));
        }
        return chunks;
    },

    speakChunk() {
        if (this.currentChunk >= this.textChunks.length) {
            this.stop();
            return;
        }

        this.utterance = new SpeechSynthesisUtterance(this.textChunks[this.currentChunk]);
        this.utterance.lang = 'es-AR';
        this.utterance.rate = 1;
        this.utterance.pitch = 1;

        // Use best voice found
        if (this.selectedVoice) {
            this.utterance.voice = this.selectedVoice;
        }

        this.utterance.onstart = () => {
            this.isPlaying = true;
            this.isPaused = false;
        };

        this.utterance.onend = () => {
            this.currentChunk++;
            this.updateProgress();
            if (this.currentChunk < this.textChunks.length) {
                this.speakChunk();
            } else {
                this.stop();
            }
        };

        this.utterance.onerror = () => {
            this.stop();
        };

        this.updateProgress();
        window.speechSynthesis.speak(this.utterance);
    },

    pause() {
        window.speechSynthesis.pause();
        this.isPlaying = false;
        this.isPaused = true;
    },

    resume() {
        window.speechSynthesis.resume();
        this.isPlaying = true;
        this.isPaused = false;
    },

    stop() {
        window.speechSynthesis.cancel();
        this.isPlaying = false;
        this.isPaused = false;
        this.progress = 0;
        this.currentChunk = 0;
        this.progressText = '';
    },

    updateProgress() {
        const total = this.textChunks.length;
        const current = this.currentChunk + 1;
        this.progress = (current / total) * 100;
        this.progressText = `${Math.round(this.progress)}%`;
    }
}));

// ================================
// TABLE OF CONTENTS
// ================================
Alpine.data('tableOfContents', () => ({
    headings: [],
    activeId: '',
    tocOpen: false,

    init() {
        this.$nextTick(() => {
            this.extractHeadings();
            this.setupScrollSpy();
        });
    },

    extractHeadings() {
        const content = document.getElementById('article-content');
        if (!content) return;

        const headingElements = content.querySelectorAll('h2, h3');
        this.headings = Array.from(headingElements).map((el, index) => {
            // Ensure heading has an ID
            if (!el.id) {
                el.id = `heading-${index}`;
            }
            return {
                id: el.id,
                text: el.textContent.trim(),
                level: parseInt(el.tagName.charAt(1))
            };
        });

        // Set first heading as active
        if (this.headings.length > 0) {
            this.activeId = this.headings[0].id;
        }
    },

    setupScrollSpy() {
        if (this.headings.length === 0) return;

        const observerOptions = {
            rootMargin: '-80px 0px -70% 0px',
            threshold: 0
        };

        const observer = new IntersectionObserver((entries) => {
            entries.forEach(entry => {
                if (entry.isIntersecting) {
                    this.activeId = entry.target.id;
                }
            });
        }, observerOptions);

        this.headings.forEach(heading => {
            const el = document.getElementById(heading.id);
            if (el) observer.observe(el);
        });
    },

    scrollToHeading(id) {
        const el = document.getElementById(id);
        if (el) {
            const offset = 100;
            const top = el.getBoundingClientRect().top + window.scrollY - offset;
            window.scrollTo({ top, behavior: 'smooth' });
            this.activeId = id;
        }
    }
}));

// ================================
// FONT SIZE ACCESSIBILITY
// ================================
window.TramaAccessibility = {
    storageKey: 'trama_font_size',
    sizes: ['small', 'normal', 'large', 'xlarge'],
    labels: { small: 'A-', normal: 'A', large: 'A+', xlarge: 'A++' },

    getCurrentSize() {
        return localStorage.getItem(this.storageKey) || 'normal';
    },

    setSize(size) {
        // Remove all font size classes
        this.sizes.forEach(s => document.documentElement.classList.remove(`font-size-${s}`));
        // Add new one
        document.documentElement.classList.add(`font-size-${size}`);
        localStorage.setItem(this.storageKey, size);
        this.updateButtons();
    },

    increase() {
        const current = this.getCurrentSize();
        const index = this.sizes.indexOf(current);
        if (index < this.sizes.length - 1) {
            this.setSize(this.sizes[index + 1]);
            showToast(`Tamaño de texto: ${this.labels[this.sizes[index + 1]]}`);
        }
    },

    decrease() {
        const current = this.getCurrentSize();
        const index = this.sizes.indexOf(current);
        if (index > 0) {
            this.setSize(this.sizes[index - 1]);
            showToast(`Tamaño de texto: ${this.labels[this.sizes[index - 1]]}`);
        }
    },

    reset() {
        this.setSize('normal');
        showToast('Tamaño de texto restaurado');
    },

    updateButtons() {
        const current = this.getCurrentSize();
        const index = this.sizes.indexOf(current);

        document.querySelectorAll('[data-font-decrease]').forEach(btn => {
            btn.disabled = index === 0;
            btn.classList.toggle('opacity-50', index === 0);
        });

        document.querySelectorAll('[data-font-increase]').forEach(btn => {
            btn.disabled = index === this.sizes.length - 1;
            btn.classList.toggle('opacity-50', index === this.sizes.length - 1);
        });
    },

    init() {
        const saved = this.getCurrentSize();
        if (saved && saved !== 'normal') {
            document.documentElement.classList.add(`font-size-${saved}`);
        }
        this.updateButtons();
    }
};

// ================================
// INITIALIZE
// ================================
document.addEventListener('DOMContentLoaded', () => {
    initReadingProgress();
    initScrollToTop();
    TramaReadingList.updateCounter();
    handleImages();
    TramaAccessibility.init();
});

// Also handle dynamically loaded images
const observer = new MutationObserver(() => handleImages());
observer.observe(document.body, { childList: true, subtree: true });

// Initialize Alpine
Alpine.start();
