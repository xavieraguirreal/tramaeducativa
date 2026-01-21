{{-- Skeleton Card for Article Loading --}}
@props(['type' => 'default'])

@if($type === 'featured')
{{-- Featured Article Skeleton (Bento 2x2) --}}
<div class="skeleton-card bento-item bento-featured">
    <div class="skeleton skeleton-image h-full min-h-[450px]"></div>
    <div class="absolute bottom-0 left-0 right-0 p-6 md:p-8 bg-gradient-to-t from-black/90 via-black/40 to-transparent">
        <div class="skeleton skeleton-text w-24 h-6 mb-3"></div>
        <div class="skeleton skeleton-text-lg w-3/4 mb-2"></div>
        <div class="skeleton skeleton-text-lg w-1/2 mb-4"></div>
        <div class="skeleton skeleton-text w-full max-w-md mb-4"></div>
        <div class="flex items-center gap-4">
            <div class="skeleton skeleton-avatar w-6 h-6"></div>
            <div class="skeleton skeleton-text-sm w-24"></div>
            <div class="skeleton skeleton-text-sm w-20"></div>
        </div>
    </div>
</div>

@elseif($type === 'bento')
{{-- Bento Grid Card Skeleton --}}
<div class="skeleton-card bento-item bento-card">
    <div class="skeleton skeleton-image h-40"></div>
    <div class="p-4">
        <div class="skeleton skeleton-text w-3/4 mb-2"></div>
        <div class="skeleton skeleton-text w-full mb-2"></div>
        <div class="skeleton skeleton-text-sm w-2/3 mb-3"></div>
        <div class="flex items-center justify-between">
            <div class="skeleton skeleton-text-sm w-20"></div>
            <div class="skeleton skeleton-text-sm w-12"></div>
        </div>
    </div>
</div>

@elseif($type === 'horizontal')
{{-- Horizontal Card Skeleton --}}
<div class="skeleton-card p-4 flex gap-4">
    <div class="skeleton skeleton-image w-32 h-24 flex-shrink-0"></div>
    <div class="flex-1">
        <div class="skeleton skeleton-text-sm w-20 mb-2"></div>
        <div class="skeleton skeleton-text w-full mb-2"></div>
        <div class="skeleton skeleton-text w-3/4 mb-3"></div>
        <div class="flex items-center gap-3">
            <div class="skeleton skeleton-text-sm w-24"></div>
            <div class="skeleton skeleton-text-sm w-16"></div>
        </div>
    </div>
</div>

@elseif($type === 'list')
{{-- List Item Skeleton --}}
<div class="flex gap-3 items-start">
    <div class="skeleton skeleton-text-lg w-8"></div>
    <div class="flex-1">
        <div class="skeleton skeleton-text w-full mb-2"></div>
        <div class="skeleton skeleton-text-sm w-1/2"></div>
    </div>
</div>

@else
{{-- Default Card Skeleton --}}
<div class="skeleton-card overflow-hidden">
    <div class="skeleton skeleton-image h-48"></div>
    <div class="p-4">
        <div class="skeleton skeleton-text w-3/4 mb-2"></div>
        <div class="skeleton skeleton-text w-full mb-2"></div>
        <div class="skeleton skeleton-text-sm w-2/3 mb-4"></div>
        <div class="flex items-center justify-between pt-4 border-t border-gray-100 dark:border-gray-700">
            <div class="flex items-center gap-2">
                <div class="skeleton skeleton-avatar w-8 h-8"></div>
                <div class="skeleton skeleton-text-sm w-24"></div>
            </div>
            <div class="skeleton skeleton-text-sm w-16"></div>
        </div>
    </div>
</div>
@endif
