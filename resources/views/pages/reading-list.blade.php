@extends('layouts.app')

@section('title', 'Mi Lista de Lectura')

@section('content')
<div class="container-main py-8" x-data="readingListPage()">
    <!-- Header -->
    <header class="mb-8">
        <div class="flex items-center gap-4 mb-4">
            <div class="w-16 h-16 rounded-full bg-trama-red/10 flex items-center justify-center">
                <svg class="w-8 h-8 text-trama-red" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 5a2 2 0 012-2h10a2 2 0 012 2v16l-7-3.5L5 21V5z"/>
                </svg>
            </div>
            <div>
                <h1 class="font-heading text-3xl md:text-4xl font-bold dark:text-white">
                    Mi Lista de Lectura
                </h1>
                <p class="text-gray-600 dark:text-gray-400 mt-1">
                    <span x-text="items.length"></span> <span x-text="items.length === 1 ? 'articulo guardado' : 'articulos guardados'"></span>
                </p>
            </div>
        </div>
        <div class="h-1 rounded-full bg-gradient-to-r from-trama-red to-transparent"></div>
    </header>

    <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">
        <!-- Main Content -->
        <div class="lg:col-span-2">
            <!-- Empty State -->
            <div x-show="items.length === 0" class="news-card p-12 text-center">
                <svg class="w-20 h-20 mx-auto text-gray-300 dark:text-gray-600 mb-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M5 5a2 2 0 012-2h10a2 2 0 012 2v16l-7-3.5L5 21V5z"/>
                </svg>
                <h3 class="font-heading text-xl font-bold dark:text-white mb-2">Tu lista esta vacia</h3>
                <p class="text-gray-600 dark:text-gray-400 mb-6">
                    Guarda articulos para leer mas tarde haciendo clic en el icono de marcador
                    <svg class="w-5 h-5 inline-block mx-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 5a2 2 0 012-2h10a2 2 0 012 2v16l-7-3.5L5 21V5z"/>
                    </svg>
                    en cualquier articulo.
                </p>
                <a href="{{ route('home') }}" class="btn-primary inline-flex items-center gap-2">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"/>
                    </svg>
                    Explorar noticias
                </a>
            </div>

            <!-- Articles List -->
            <div x-show="items.length > 0" class="space-y-4">
                <!-- Clear All Button -->
                <div class="flex justify-end mb-4">
                    <button @click="clearAll()"
                            class="text-sm text-gray-500 hover:text-trama-red transition-colors flex items-center gap-1">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"/>
                        </svg>
                        Vaciar lista
                    </button>
                </div>

                <!-- Article Cards -->
                <template x-for="(item, index) in items" :key="item.slug">
                    <article class="news-card p-4 flex gap-4 group hover:shadow-lg transition-all duration-300">
                        <a :href="'/' + item.slug" class="flex-shrink-0 overflow-hidden rounded-lg">
                            <img :src="item.image"
                                 :alt="item.title"
                                 class="w-32 h-24 md:w-40 md:h-28 object-cover group-hover:scale-110 transition-transform duration-500"
                                 onerror="this.src='https://images.unsplash.com/photo-1503676260728-1c00da094a0b?w=800&h=400&fit=crop'">
                        </a>
                        <div class="flex-1 min-w-0">
                            <div class="flex items-start justify-between gap-2">
                                <span class="text-xs font-semibold uppercase text-trama-red" x-text="item.category"></span>
                                <button @click="removeItem(item.slug)"
                                        class="text-gray-400 hover:text-trama-red transition-colors p-1"
                                        title="Quitar de la lista">
                                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/>
                                    </svg>
                                </button>
                            </div>
                            <h3 class="font-semibold dark:text-white leading-tight mt-1">
                                <a :href="'/' + item.slug" class="hover:text-trama-red transition-colors" x-text="item.title"></a>
                            </h3>
                            <div class="flex items-center gap-3 mt-3 text-xs text-gray-500">
                                <span class="flex items-center gap-1">
                                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"/>
                                    </svg>
                                    Guardado <span x-text="formatDate(item.savedAt)"></span>
                                </span>
                            </div>
                        </div>
                    </article>
                </template>
            </div>
        </div>

        <!-- Sidebar -->
        <aside class="space-y-8">
            <!-- Categories -->
            <div class="bg-white dark:bg-dark-secondary rounded-lg p-6">
                <h3 class="font-heading font-bold text-lg mb-4 dark:text-white flex items-center gap-2">
                    <span class="w-1 h-6 bg-trama-red rounded-full"></span>
                    Secciones
                </h3>
                <div class="space-y-2">
                    @foreach($categories as $cat)
                    <a href="{{ route('category', $cat) }}"
                       class="flex items-center gap-3 p-2 rounded-lg hover:bg-gray-50 dark:hover:bg-dark-accent transition-colors group">
                        <span class="w-3 h-3 rounded-full" style="background-color: {{ $cat->color }}"></span>
                        <span class="dark:text-white group-hover:text-trama-red transition-colors">{{ $cat->name }}</span>
                    </a>
                    @endforeach
                </div>
            </div>

            <!-- Info Card -->
            <div class="bg-gray-50 dark:bg-dark-accent rounded-lg p-6">
                <div class="flex items-start gap-3">
                    <svg class="w-6 h-6 text-trama-red flex-shrink-0 mt-0.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/>
                    </svg>
                    <div>
                        <h4 class="font-semibold dark:text-white mb-1">Almacenamiento local</h4>
                        <p class="text-sm text-gray-600 dark:text-gray-400">
                            Tu lista se guarda en este navegador. Si cambias de dispositivo o borras los datos del navegador, la lista se perdera.
                        </p>
                    </div>
                </div>
            </div>
        </aside>
    </div>
</div>

@push('scripts')
<script>
    Alpine.data('readingListPage', () => ({
        items: [],

        init() {
            this.loadItems();
        },

        loadItems() {
            try {
                this.items = JSON.parse(localStorage.getItem('trama_reading_list')) || [];
                // Sort by savedAt descending (most recent first)
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
</script>
@endpush
@endsection
