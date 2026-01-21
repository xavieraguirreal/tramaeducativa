{{--
Skeleton Loader Wrapper
Usage:
<x-skeleton-loader>
    <x-slot name="skeleton">
        <!-- skeleton content -->
    </x-slot>
    <!-- real content -->
</x-skeleton-loader>
--}}
@props(['delay' => 300])

<div x-data="{ loaded: false }"
     x-init="setTimeout(() => loaded = true, {{ $delay }})"
     class="relative">

    {{-- Skeleton (shows while loading) --}}
    <div x-show="!loaded"
         x-transition:leave="transition ease-in duration-200"
         x-transition:leave-start="opacity-100"
         x-transition:leave-end="opacity-0">
        {{ $skeleton }}
    </div>

    {{-- Real Content (shows after load) --}}
    <div x-show="loaded"
         x-transition:enter="transition ease-out duration-300"
         x-transition:enter-start="opacity-0"
         x-transition:enter-end="opacity-100"
         x-cloak>
        {{ $slot }}
    </div>
</div>
