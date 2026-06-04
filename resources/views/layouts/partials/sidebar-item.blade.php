{{--
    Sidebar Nav Item Sub-Partial "{{ route($route) }}
    Path: resources/views/layouts/partials/sidebar-item.blade.php

    Variables passed in:
      $route  - named route string
      $label  - display text
      $icon   - SVG path d="" value (heroicon outline)
      $badge  - (int) optional badge count, 0 = hidden {{ route($route) }}
--}}

@php
    $isActive = request()->routeIs($route) || request()->routeIs($route . '.*'); // Active if current route matches or is a sub-route
@endphp

<a
    href="#"
    title="{{ $label }}"
    @class([ 
        'relative flex items-center gap-3 rounded-xl px-3 py-2 text-sm font-medium transition-all duration-150 mb-0.5 group',
        'bg-indigo-500/15 text-indigo-300 ring-1 ring-indigo-500/20' => $isActive,
        'text-slate-400 hover:bg-white/5 hover:text-slate-200'       => ! $isActive,
    ])
>
    {{-- Icon --}}
    <svg
        @class([
            'h-[18px] w-[18px] flex-shrink-0 transition-colors',
            'text-indigo-400'                         => $isActive,
            'text-slate-500 group-hover:text-slate-300' => ! $isActive,
        ])
        fill="none"
        viewBox="0 0 24 24"
        stroke="currentColor"
        stroke-width="1.8"
        aria-hidden="true"
    >
        <path stroke-linecap="round" stroke-linejoin="round" d="{{ $icon }}" />
    </svg>

    {{-- Label (hidden when sidebar is collapsed) --}}
    <span
        x-show="!sidebarCollapsed"
        x-transition:enter="transition-opacity duration-150"
        x-transition:enter-start="opacity-0"
        x-transition:enter-end="opacity-100"
        class="flex-1 truncate"
    >{{ $label }}</span>

    {{-- Badge count --}}
    @if (($badge ?? 0) > 0)
        <span
            x-show="!sidebarCollapsed"
            @class([
                'ml-auto flex h-5 min-w-[20px] items-center justify-center rounded-full px-1.5 text-[10px] font-semibold',
                'bg-indigo-500/30 text-indigo-200' => $isActive,
                'bg-slate-700 text-slate-300'      => ! $isActive,
            ])
        >{{ $badge }}</span>

        {{-- Collapsed state: small dot indicator --}}
        <span
            x-show="sidebarCollapsed"
            class="absolute right-2 top-2 h-1.5 w-1.5 rounded-full bg-indigo-400"
        ></span>
    @endif
</a>