@extends('layouts.app')

@section('title', 'Sobre Nosotros')

@section('meta')
<meta name="description" content="Trama Educativa es un medio de comunicacion de la Cooperativa de Trabajo Minga Ltda. Periodismo educativo desde Mar del Plata.">
<meta property="og:title" content="Sobre Nosotros - Trama Educativa">
<meta property="og:description" content="Conoce al equipo detras de Trama Educativa, medio de comunicacion cooperativo.">
<meta property="og:type" content="website">
@endsection

@section('content')
<div class="container-main py-8">
    <!-- Hero -->
    <header class="text-center mb-12">
        <h1 class="font-heading text-4xl md:text-5xl font-bold dark:text-white mb-4">
            Sobre <span class="text-trama-red">Trama Educativa</span>
        </h1>
        <p class="text-xl text-gray-600 dark:text-gray-400 max-w-2xl mx-auto">
            Periodismo educativo desde Mar del Plata, con mirada critica y compromiso social.
        </p>
    </header>

    <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">
        <!-- Main Content -->
        <div class="lg:col-span-2 space-y-8">
            <!-- Quienes Somos -->
            <section class="bg-white dark:bg-dark-secondary rounded-lg p-6 md:p-8">
                <h2 class="font-heading text-2xl font-bold dark:text-white mb-4 flex items-center gap-2">
                    <span class="w-1 h-8 bg-trama-red rounded-full"></span>
                    Quienes Somos
                </h2>
                <div class="prose dark:prose-invert max-w-none text-gray-600 dark:text-gray-300">
                    <p>
                        <strong>Trama Educativa</strong> es un medio de comunicacion especializado en educacion,
                        producido por la <strong>Cooperativa de Trabajo Minga Ltda</strong> desde la ciudad de Mar del Plata.
                    </p>
                    <p>
                        Nacimos con el objetivo de cubrir la actualidad educativa de nuestra ciudad y la region,
                        con una mirada critica y comprometida con la educacion publica y los derechos de la comunidad educativa.
                    </p>
                    <p>
                        Nuestro trabajo se sustenta en los valores del cooperativismo: solidaridad, democracia,
                        igualdad, equidad y compromiso con la comunidad.
                    </p>
                </div>
            </section>

            <!-- Cooperativa Minga -->
            <section class="bg-white dark:bg-dark-secondary rounded-lg p-6 md:p-8">
                <h2 class="font-heading text-2xl font-bold dark:text-white mb-4 flex items-center gap-2">
                    <span class="w-1 h-8 bg-trama-red rounded-full"></span>
                    Cooperativa Minga
                </h2>
                <div class="prose dark:prose-invert max-w-none text-gray-600 dark:text-gray-300">
                    <p>
                        La <strong>Cooperativa de Trabajo Minga Ltda</strong> es una organizacion de trabajadores y trabajadoras
                        de la comunicacion que apuesta por el periodismo independiente y autogestivo.
                    </p>
                    <p>
                        Minga es una palabra de origen quechua que significa "trabajo colectivo en beneficio de la comunidad".
                        Ese espiritu guia nuestro trabajo diario.
                    </p>
                </div>
                <div class="mt-6 p-4 bg-gray-50 dark:bg-dark-accent rounded-lg">
                    <p class="text-sm text-gray-600 dark:text-gray-400">
                        <strong>Datos legales:</strong><br>
                        Cooperativa de Trabajo Minga Ltda<br>
                        Mar del Plata, Buenos Aires, Argentina<br>
                        ISSN en tramite
                    </p>
                </div>
            </section>

            <!-- Radio Trama -->
            <section class="bg-white dark:bg-dark-secondary rounded-lg p-6 md:p-8">
                <h2 class="font-heading text-2xl font-bold dark:text-white mb-4 flex items-center gap-2">
                    <span class="w-1 h-8 bg-trama-red rounded-full"></span>
                    Radio Trama
                </h2>
                <div class="prose dark:prose-invert max-w-none text-gray-600 dark:text-gray-300">
                    <p>
                        Ademas de nuestro portal de noticias, producimos <strong>Radio Trama</strong>,
                        un programa radial que se emite todos los <strong>lunes a las 20:00 hs</strong>
                        por <strong>Radio de la Azotea FM 88.7</strong>.
                    </p>
                    <p>
                        En Radio Trama abordamos la actualidad educativa con entrevistas, analisis y la participacion
                        de docentes, estudiantes y especialistas.
                    </p>
                </div>
            </section>

            <!-- Equipo -->
            <section class="bg-white dark:bg-dark-secondary rounded-lg p-6 md:p-8">
                <h2 class="font-heading text-2xl font-bold dark:text-white mb-6 flex items-center gap-2">
                    <span class="w-1 h-8 bg-trama-red rounded-full"></span>
                    Nuestro Equipo
                </h2>
                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    @foreach($authors as $author)
                    <a href="{{ route('author', $author) }}" class="flex items-center gap-4 p-4 rounded-lg hover:bg-gray-50 dark:hover:bg-dark-accent transition-colors group">
                        <img src="{{ $author->avatar_url }}"
                             alt="{{ $author->name }}"
                             class="w-16 h-16 rounded-full object-cover">
                        <div>
                            <h3 class="font-semibold dark:text-white group-hover:text-trama-red transition-colors">
                                {{ $author->name }}
                            </h3>
                            @if($author->bio)
                            <p class="text-sm text-gray-600 dark:text-gray-400 line-clamp-2">
                                {{ Str::limit($author->bio, 80) }}
                            </p>
                            @endif
                        </div>
                    </a>
                    @endforeach
                </div>
            </section>
        </div>

        <!-- Sidebar -->
        <aside class="space-y-8">
            <!-- Contacto -->
            <div class="bg-white dark:bg-dark-secondary rounded-lg p-6">
                <h3 class="font-heading font-bold text-lg mb-4 dark:text-white flex items-center gap-2">
                    <span class="w-1 h-6 bg-trama-red rounded-full"></span>
                    Contacto
                </h3>
                <div class="space-y-4 text-sm">
                    <a href="mailto:contacto@tramaeducativa.ar" class="flex items-center gap-3 text-gray-600 dark:text-gray-400 hover:text-trama-red transition-colors">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"/>
                        </svg>
                        contacto@tramaeducativa.ar
                    </a>
                    <a href="https://www.facebook.com/TramaEducativaRadio" target="_blank" class="flex items-center gap-3 text-gray-600 dark:text-gray-400 hover:text-trama-red transition-colors">
                        <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 24 24">
                            <path d="M24 12.073c0-6.627-5.373-12-12-12s-12 5.373-12 12c0 5.99 4.388 10.954 10.125 11.854v-8.385H7.078v-3.47h3.047V9.43c0-3.007 1.792-4.669 4.533-4.669 1.312 0 2.686.235 2.686.235v2.953H15.83c-1.491 0-1.956.925-1.956 1.874v2.25h3.328l-.532 3.47h-2.796v8.385C19.612 23.027 24 18.062 24 12.073z"/>
                        </svg>
                        Facebook
                    </a>
                    <a href="https://twitter.com/TramaEducativa" target="_blank" class="flex items-center gap-3 text-gray-600 dark:text-gray-400 hover:text-trama-red transition-colors">
                        <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 24 24">
                            <path d="M18.244 2.25h3.308l-7.227 8.26 8.502 11.24H16.17l-5.214-6.817L4.99 21.75H1.68l7.73-8.835L1.254 2.25H8.08l4.713 6.231zm-1.161 17.52h1.833L7.084 4.126H5.117z"/>
                        </svg>
                        Twitter / X
                    </a>
                    <a href="https://instagram.com/tramaeducativa" target="_blank" class="flex items-center gap-3 text-gray-600 dark:text-gray-400 hover:text-trama-red transition-colors">
                        <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 24 24">
                            <path d="M12.315 2c2.43 0 2.784.013 3.808.06 1.064.049 1.791.218 2.427.465a4.902 4.902 0 011.772 1.153 4.902 4.902 0 011.153 1.772c.247.636.416 1.363.465 2.427.048 1.067.06 1.407.06 4.123v.08c0 2.643-.012 2.987-.06 4.043-.049 1.064-.218 1.791-.465 2.427a4.902 4.902 0 01-1.153 1.772 4.902 4.902 0 01-1.772 1.153c-.636.247-1.363.416-2.427.465-1.067.048-1.407.06-4.123.06h-.08c-2.643 0-2.987-.012-4.043-.06-1.064-.049-1.791-.218-2.427-.465a4.902 4.902 0 01-1.772-1.153 4.902 4.902 0 01-1.153-1.772c-.247-.636-.416-1.363-.465-2.427-.047-1.024-.06-1.379-.06-3.808v-.63c0-2.43.013-2.784.06-3.808.049-1.064.218-1.791.465-2.427a4.902 4.902 0 011.153-1.772A4.902 4.902 0 015.45 2.525c.636-.247 1.363-.416 2.427-.465C8.901 2.013 9.256 2 11.685 2h.63zm-.081 1.802h-.468c-2.456 0-2.784.011-3.807.058-.975.045-1.504.207-1.857.344-.467.182-.8.398-1.15.748-.35.35-.566.683-.748 1.15-.137.353-.3.882-.344 1.857-.047 1.023-.058 1.351-.058 3.807v.468c0 2.456.011 2.784.058 3.807.045.975.207 1.504.344 1.857.182.466.399.8.748 1.15.35.35.683.566 1.15.748.353.137.882.3 1.857.344 1.054.048 1.37.058 4.041.058h.08c2.597 0 2.917-.01 3.96-.058.976-.045 1.505-.207 1.858-.344.466-.182.8-.398 1.15-.748.35-.35.566-.683.748-1.15.137-.353.3-.882.344-1.857.048-1.055.058-1.37.058-4.041v-.08c0-2.597-.01-2.917-.058-3.96-.045-.976-.207-1.505-.344-1.858a3.097 3.097 0 00-.748-1.15 3.098 3.098 0 00-1.15-.748c-.353-.137-.882-.3-1.857-.344-1.023-.047-1.351-.058-3.807-.058zM12 6.865a5.135 5.135 0 110 10.27 5.135 5.135 0 010-10.27zm0 1.802a3.333 3.333 0 100 6.666 3.333 3.333 0 000-6.666zm5.338-3.205a1.2 1.2 0 110 2.4 1.2 1.2 0 010-2.4z"/>
                        </svg>
                        Instagram
                    </a>
                </div>
            </div>

            <!-- Secciones -->
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
        </aside>
    </div>
</div>
@endsection
