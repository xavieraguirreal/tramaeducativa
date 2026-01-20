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
// CONFETTI EFFECT
// ================================
window.createConfetti = function(element) {
    const colors = ['#C84347', '#059669', '#2563EB', '#DB2777', '#F59E0B'];
    const rect = element.getBoundingClientRect();

    for (let i = 0; i < 12; i++) {
        const confetti = document.createElement('div');
        confetti.className = 'confetti';
        confetti.style.cssText = `
            left: ${rect.left + rect.width / 2}px;
            top: ${rect.top + rect.height / 2}px;
            width: 8px;
            height: 8px;
            background: ${colors[Math.floor(Math.random() * colors.length)]};
            border-radius: ${Math.random() > 0.5 ? '50%' : '0'};
            transform: translate(${(Math.random() - 0.5) * 100}px, 0);
        `;
        document.body.appendChild(confetti);

        // Animate
        confetti.animate([
            { transform: `translate(${(Math.random() - 0.5) * 100}px, 0) rotate(0deg)`, opacity: 1 },
            { transform: `translate(${(Math.random() - 0.5) * 150}px, ${100 + Math.random() * 50}px) rotate(${Math.random() * 720}deg)`, opacity: 0 }
        ], {
            duration: 800 + Math.random() * 400,
            easing: 'cubic-bezier(0.25, 0.46, 0.45, 0.94)'
        }).onfinish = () => confetti.remove();
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
            createConfetti(btn);
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

// ================================
// BROKEN IMAGE HANDLER
// ================================
const FALLBACK_IMAGE = 'https://images.unsplash.com/photo-1503676260728-1c00da094a0b?w=800&h=400&fit=crop';

function handleBrokenImages() {
    document.querySelectorAll('img').forEach(img => {
        if (!img.dataset.fallbackSet) {
            img.dataset.fallbackSet = 'true';
            img.addEventListener('error', function() {
                if (this.src !== FALLBACK_IMAGE) {
                    this.src = FALLBACK_IMAGE;
                }
            });
            // Check if image is already broken (cached error)
            if (img.complete && img.naturalHeight === 0 && img.src !== FALLBACK_IMAGE) {
                img.src = FALLBACK_IMAGE;
            }
        }
    });
}

// ================================
// INITIALIZE
// ================================
document.addEventListener('DOMContentLoaded', () => {
    initReadingProgress();
    initScrollToTop();
    TramaReadingList.updateCounter();
    handleBrokenImages();
});

// Also handle dynamically loaded images
const observer = new MutationObserver(() => handleBrokenImages());
observer.observe(document.body, { childList: true, subtree: true });

// Initialize Alpine
Alpine.start();
