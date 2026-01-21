@props([
    'type' => 'horizontal', // horizontal, vertical, square, in-article
    'id' => null,
    'class' => ''
])

@php
$sizes = [
    'horizontal' => 'w-full h-24 md:h-28', // 728x90 leaderboard
    'vertical' => 'w-full h-64 md:h-80', // 300x600 half page
    'square' => 'w-full h-64', // 300x250 medium rectangle
    'in-article' => 'w-full h-24 md:h-32', // in-article responsive
    'banner-top' => 'w-full h-20 md:h-24', // top banner
];
$sizeClass = $sizes[$type] ?? $sizes['horizontal'];
@endphp

{{--
    INSTRUCCIONES PARA ADSENSE:
    1. Reemplazar el contenido de este div con el código de AdSense
    2. Mantener el contenedor externo para el espaciado
    3. Ejemplo de código AdSense:
    <ins class="adsbygoogle"
         style="display:block"
         data-ad-client="ca-pub-XXXXXXX"
         data-ad-slot="XXXXXXX"
         data-ad-format="auto"
         data-full-width-responsive="true"></ins>
    <script>(adsbygoogle = window.adsbygoogle || []).push({});</script>
--}}

<div {{ $attributes->merge(['class' => 'ad-container my-4 ' . $class]) }} @if($id) id="{{ $id }}" @endif>
    {{-- Placeholder - Reemplazar con código AdSense real --}}
    <div class="ad-placeholder {{ $sizeClass }} bg-gradient-to-br from-gray-100 to-gray-200 dark:from-gray-800 dark:to-gray-700 rounded-lg flex items-center justify-center border-2 border-dashed border-gray-300 dark:border-gray-600">
        <div class="text-center text-gray-400 dark:text-gray-500">
            <svg class="w-8 h-8 mx-auto mb-2 opacity-50" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M11 3.055A9.001 9.001 0 1020.945 13H11V3.055z"/>
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M20.488 9H15V3.512A9.025 9.025 0 0120.488 9z"/>
            </svg>
            <span class="text-xs font-medium uppercase tracking-wider">Espacio publicitario</span>
        </div>
    </div>
</div>
