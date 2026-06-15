@extends('layouts.public')
 
@section('title', $setting?->site_name ?? 'AstraCore')
@section('page-title', 'Home')
@section('meta-description', $setting?->tagline ?? 'We build modern digital experiences for ambitious businesses.')
 
@section('content')
 
{{-- ════════════════════════════════════════════════════════════════
     §1 HERO
════════════════════════════════════════════════════════════════ --}}
<section class="relative min-h-[92vh] flex items-center overflow-hidden bg-[#0b1120]" aria-label="Hero">
 
    {{-- Decorative background --}}
    <div class="absolute inset-0 pointer-events-none" aria-hidden="true">
        {{-- Grid overlay --}}
        <div class="absolute inset-0"
            style="background-image: linear-gradient(rgba(255,255,255,0.025) 1px, transparent 1px), linear-gradient(90deg, rgba(255,255,255,0.025) 1px, transparent 1px); background-size: 48px 48px;"></div>
        {{-- Gradient orbs --}}
        <div class="absolute -top-32 -left-32 h-[600px] w-[600px] rounded-full bg-indigo-600/10 blur-[120px]"></div>
        <div class="absolute top-1/2 right-0 h-[400px] w-[400px] rounded-full bg-violet-600/10 blur-[100px]"></div>
        <div class="absolute bottom-0 left-1/3 h-[300px] w-[300px] rounded-full bg-indigo-500/8 blur-[80px]"></div>
    </div>
 
    <div class="relative z-10 mx-auto max-w-7xl px-4 sm:px-6 lg:px-8 py-24">
        <div class="max-w-3xl">
 
            {{-- Eyebrow badge --}}
            <div class="mb-7 inline-flex items-center gap-2 rounded-full border border-indigo-500/20 bg-indigo-500/10 px-4 py-1.5">
                <span class="h-1.5 w-1.5 rounded-full bg-indigo-400 animate-pulse"></span>
                <span class="text-xs font-semibold tracking-wide text-indigo-300">{{ $setting?->tagline ?? 'Full-Stack Digital Agency' }}</span>
            </div>
 
            {{-- Headline --}}
            <h1 class="mb-6 text-5xl sm:text-6xl lg:text-7xl font-extrabold text-white leading-[1.08] tracking-tight"
                style="font-family:'Syne',sans-serif">
                We Build
                <span class="text-transparent bg-clip-text bg-gradient-to-r from-indigo-400 via-violet-400 to-indigo-300">
                    Digital
                </span>
                <br/>Experiences
            </h1>
 
            {{-- Sub copy --}}
            <p class="mb-10 max-w-xl text-lg text-slate-400 leading-relaxed">
                From strategy to launch — we design, develop and deploy web solutions that help ambitious businesses grow and stand out in a crowded market.
            </p>
 
            {{-- CTAs --}}
            <div class="flex flex-wrap items-center gap-4">
                <a
                    href="{{ url('/projects') }}"
                    class="inline-flex items-center gap-2 rounded-2xl bg-indigo-600 px-6 py-3.5 text-sm font-semibold text-white shadow-lg shadow-indigo-900/40 hover:bg-indigo-500 active:bg-indigo-700 transition-colors"
                >
                    <svg class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2.5" aria-hidden="true">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M6.429 9.75L2.25 12l4.179 2.25m0-4.5l5.571 3 5.571-3m-11.142 0L2.25 7.5 12 2.25l9.75 5.25-4.179 2.25"/>
                    </svg>
                    View Our Work
                </a>
                <a
                    href="{{ url('/contact') }}"
                    class="inline-flex items-center gap-2 rounded-2xl border border-white/15 bg-white/5 px-6 py-3.5 text-sm font-semibold text-white hover:bg-white/10 hover:border-white/25 transition-all"
                >
                    Start a Project
                    <svg class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2" aria-hidden="true">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M13.5 4.5L21 12m0 0l-7.5 7.5M21 12H3"/>
                    </svg>
                </a>
            </div>
 
        </div>
 
        {{-- Floating stat cards --}}
        <div class="mt-16 grid grid-cols-2 sm:grid-cols-4 gap-4 max-w-2xl">
            @foreach ([
                ['50+',  'Projects Delivered'],
                ['98%',  'Client Satisfaction'],
                ['5+',   'Years Experience'],
                ['24/7', 'Support Available'],
            ] as [$num, $label])
            <div class="rounded-2xl border border-white/8 bg-white/5 px-4 py-4 backdrop-blur-sm text-center hover:border-indigo-500/25 hover:bg-indigo-500/8 transition-all">
                <p class="text-2xl font-bold text-white" style="font-family:'Syne',sans-serif">{{ $num }}</p>
                <p class="mt-1 text-[11px] text-slate-400">{{ $label }}</p>
            </div>
            @endforeach
        </div>
 
    </div>
 
    {{-- Scroll indicator --}}
    <div class="absolute bottom-8 left-1/2 -translate-x-1/2 flex flex-col items-center gap-2 text-slate-600 animate-bounce" aria-hidden="true">
        <svg class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.5">
            <path stroke-linecap="round" stroke-linejoin="round" d="M19.5 8.25l-7.5 7.5-7.5-7.5"/>
        </svg>
    </div>
</section>
 
 
{{-- ════════════════════════════════════════════════════════════════
     §2 SERVICES
════════════════════════════════════════════════════════════════ --}}
@if ($services && $services->isNotEmpty())
<section class="py-24 bg-[#0f172a]" aria-labelledby="services-heading">
    <div class="mx-auto max-w-7xl px-4 sm:px-6 lg:px-8">
 
        {{-- Section header --}}
        <div class="mb-14 flex flex-col gap-4 sm:flex-row sm:items-end sm:justify-between">
            <div>
                <p class="mb-2 text-xs font-semibold uppercase tracking-widest text-indigo-400">What we do</p>
                <h2 id="services-heading" class="text-3xl sm:text-4xl font-bold text-white" style="font-family:'Syne',sans-serif">
                    Our Services
                </h2>
            </div>
            <a href="{{ url('/services') }}" class="inline-flex items-center gap-1.5 text-sm font-medium text-indigo-400 hover:text-indigo-300 transition-colors self-start sm:self-auto">
                All services
                <svg class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2" aria-hidden="true"><path stroke-linecap="round" stroke-linejoin="round" d="M13.5 4.5L21 12m0 0l-7.5 7.5M21 12H3"/></svg>
            </a>
        </div>
 
        {{-- Services grid --}}
        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-5">
            @foreach ($services->take(6) as $service)
            <a
                href="{{ url('/services/' . $service->slug) }}"
                class="group relative flex flex-col rounded-2xl border border-white/8 bg-white/3 p-6 hover:border-indigo-500/30 hover:bg-indigo-500/5 transition-all duration-200"
            >
                {{-- Icon --}}
                <div class="mb-5 flex h-12 w-12 items-center justify-center rounded-xl border border-indigo-500/20 bg-indigo-500/10 group-hover:bg-indigo-500/20 transition-colors">
                    @if ($service->icon)
                        <i class="{{ $service->icon }} text-xl text-indigo-400" aria-hidden="true"></i>
                    @else
                        <svg class="h-6 w-6 text-indigo-400" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.8" aria-hidden="true">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M11.42 15.17L17.25 21A2.652 2.652 0 0021 17.25l-5.877-5.877"/>
                        </svg>
                    @endif
                </div>
 
                <h3 class="mb-2 text-base font-semibold text-white group-hover:text-indigo-200 transition-colors">{{ $service->title }}</h3>
                <p class="flex-1 text-sm text-slate-400 leading-relaxed">{{ $service->short_description ?? Str::limit($service->description, 90) }}</p>
 
                <div class="mt-4 flex items-center gap-1 text-xs font-medium text-indigo-400 opacity-0 group-hover:opacity-100 transition-opacity">
                    Learn more
                    <svg class="h-3.5 w-3.5 translate-x-0 group-hover:translate-x-1 transition-transform" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2" aria-hidden="true"><path stroke-linecap="round" stroke-linejoin="round" d="M13.5 4.5L21 12m0 0l-7.5 7.5M21 12H3"/></svg>
                </div>
            </a>
            @endforeach
        </div>
 
    </div>
</section>
@endif
 
 
{{-- ════════════════════════════════════════════════════════════════
     3 FEATURED PROJECTS
════════════════════════════════════════════════════════════════ --}}
@if ($projects && $projects->isNotEmpty())
<section class="py-24 bg-[#0b1120]" aria-labelledby="projects-heading">
    <div class="mx-auto max-w-7xl px-4 sm:px-6 lg:px-8">
 
        <div class="mb-14 flex flex-col gap-4 sm:flex-row sm:items-end sm:justify-between">
            <div>
                <p class="mb-2 text-xs font-semibold uppercase tracking-widest text-indigo-400">Portfolio</p>
                <h2 id="projects-heading" class="text-3xl sm:text-4xl font-bold text-white" style="font-family:'Syne',sans-serif">
                    Featured Work
                </h2>
            </div>
            <a href="{{ url('/projects') }}" class="inline-flex items-center gap-1.5 text-sm font-medium text-indigo-400 hover:text-indigo-300 transition-colors self-start sm:self-auto">
                View all projects
                <svg class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2" aria-hidden="true"><path stroke-linecap="round" stroke-linejoin="round" d="M13.5 4.5L21 12m0 0l-7.5 7.5M21 12H3"/></svg>
            </a>
        </div>
 
        {{-- Projects masonry-style grid --}}
        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-5">
            @foreach ($projects->take(6) as $project)
            <a
                href="{{ url('/projects/' . $project->slug) }}"
                class="group relative overflow-hidden rounded-2xl border border-white/8 bg-white/3 hover:border-indigo-500/30 transition-all duration-200 {{ $loop->first ? 'sm:row-span-2 sm:col-span-1' : '' }}"
            >
                {{-- Image --}}
                <div class="{{ $loop->first ? 'h-64 sm:h-full min-h-[280px]' : 'h-48' }} overflow-hidden bg-slate-800">
                    @if ($project->featured_image)
                        <img
                            src="{{ Storage::url($project->featured_image) }}"
                            alt="{{ $project->title }}"
                            class="h-full w-full object-cover transition-transform duration-500 group-hover:scale-105"
                            loading="{{ $loop->index < 3 ? 'eager' : 'lazy' }}"
                        />
                    @else
                        <div class="flex h-full w-full items-center justify-center bg-gradient-to-br from-slate-800 to-slate-900">
                            <svg class="h-10 w-10 text-slate-600" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1" aria-hidden="true">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M6.429 9.75L2.25 12l4.179 2.25m0-4.5l5.571 3 5.571-3"/>
                            </svg>
                        </div>
                    @endif
                    {{-- Hover overlay --}}
                    <div class="absolute inset-0 bg-gradient-to-t from-black/70 via-black/20 to-transparent opacity-60 group-hover:opacity-80 transition-opacity"></div>
                </div>
 
                {{-- Info overlay --}}
                <div class="absolute bottom-0 inset-x-0 p-5">
                    @if ($project->category)
                    <span class="mb-2 inline-flex rounded-full bg-indigo-500/20 px-2.5 py-0.5 text-[10px] font-semibold text-indigo-300">{{ $project->category->name }}</span>
                    @endif
                    <h3 class="text-sm font-semibold text-white leading-snug">{{ $project->title }}</h3>
                    @if ($project->client_name)
                    <p class="mt-1 text-xs text-slate-400">{{ $project->client_name }}</p>
                    @endif
                </div>
            </a>
            @endforeach
        </div>
 
    </div>
</section>
@endif
 
 
{{-- ════════════════════════════════════════════════════════════════
     §4 WHY CHOOSE US
════════════════════════════════════════════════════════════════ --}}
<section class="py-24 bg-[#0f172a]" aria-labelledby="why-heading">
    <div class="mx-auto max-w-7xl px-4 sm:px-6 lg:px-8">
        <div class="grid grid-cols-1 lg:grid-cols-2 gap-14 items-center">
 
            {{-- Left: text --}}
            <div>
                <p class="mb-2 text-xs font-semibold uppercase tracking-widest text-indigo-400">Why us</p>
                <h2 id="why-heading" class="mb-6 text-3xl sm:text-4xl font-bold text-white" style="font-family:'Syne',sans-serif">
                    Built for results,<br/>designed for growth
                </h2>
                <p class="mb-8 text-slate-400 leading-relaxed max-w-md">
                    We don't just build websites — we craft strategic digital products that help our clients achieve their business goals, backed by clean code and thoughtful design.
                </p>
 
                <div class="space-y-5">
                    @foreach ([
                        ['Strategy First',      'We understand your goals before writing a single line of code.'],
                        ['Modern Tech Stack',   'Laravel, Tailwind, Vue — fast, secure, and maintainable.'],
                        ['Ongoing Support',     'We are with you after launch — updates, fixes and growth.'],
                        ['Transparent Process', 'Clear milestones, regular updates, no surprises on the bill.'],
                    ] as [$title, $desc])
                    <div class="flex items-start gap-4">
                        <div class="flex h-8 w-8 flex-shrink-0 items-center justify-center rounded-lg bg-indigo-500/15 ring-1 ring-indigo-500/20 mt-0.5">
                            <svg class="h-4 w-4 text-indigo-400" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2.5" aria-hidden="true">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M4.5 12.75l6 6 9-13.5"/>
                            </svg>
                        </div>
                        <div>
                            <p class="text-sm font-semibold text-white">{{ $title }}</p>
                            <p class="mt-0.5 text-sm text-slate-400">{{ $desc }}</p>
                        </div>
                    </div>
                    @endforeach
                </div>
            </div>
 
            {{-- Right: decorative card stack --}}
            <div class="relative hidden lg:block" aria-hidden="true">
                {{-- Background card --}}
                <div class="absolute top-6 left-6 right-0 h-full rounded-2xl border border-indigo-500/10 bg-indigo-500/5"></div>
                {{-- Main card --}}
                <div class="relative rounded-2xl border border-white/10 bg-white/5 p-8 backdrop-blur">
                    <div class="grid grid-cols-2 gap-4">
                        @foreach ([
                            ['bg-indigo-500/15', 'text-indigo-400', 'Design'],
                            ['bg-violet-500/15', 'text-violet-400', 'Development'],
                            ['bg-emerald-500/15','text-emerald-400','Strategy'],
                            ['bg-amber-500/15',  'text-amber-400',  'Support'],
                        ] as [$bg, $text, $label])
                        <div class="flex flex-col items-center justify-center rounded-xl {{ $bg }} p-6 text-center gap-2">
                            <div class="h-2 w-2 rounded-full {{ str_replace('bg-', 'bg-', str_replace('/15','/60',$bg)) }}"></div>
                            <span class="text-sm font-semibold {{ $text }}">{{ $label }}</span>
                        </div>
                        @endforeach
                    </div>
                    {{-- Floating badge --}}
                    <div class="absolute -top-4 -right-4 rounded-xl border border-emerald-500/20 bg-emerald-500/10 px-4 py-2 text-xs font-semibold text-emerald-400 backdrop-blur shadow-lg">
                        ✓ 50+ Happy Clients
                    </div>
                </div>
            </div>
 
        </div>
    </div>
</section>
 
 
{{-- ════════════════════════════════════════════════════════════════
     §5 TESTIMONIALS
════════════════════════════════════════════════════════════════ --}}
@if ($testimonials && $testimonials->isNotEmpty())
<section class="py-24 bg-[#0b1120]" aria-labelledby="testimonials-heading">
    <div class="mx-auto max-w-7xl px-4 sm:px-6 lg:px-8">
 
        <div class="mb-14 text-center">
            <p class="mb-2 text-xs font-semibold uppercase tracking-widest text-indigo-400">Client Reviews</p>
            <h2 id="testimonials-heading" class="text-3xl sm:text-4xl font-bold text-white" style="font-family:'Syne',sans-serif">
                What our clients say
            </h2>
        </div>
 
        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-5">
            @foreach ($testimonials->take(6) as $testimonial)
            <div class="flex flex-col rounded-2xl border border-white/8 bg-white/3 p-6 hover:border-indigo-500/20 hover:bg-white/5 transition-all">
 
                {{-- Stars --}}
                <div class="mb-4 flex items-center gap-0.5" aria-label="{{ $testimonial->rating }} out of 5 stars">
                    @for ($i = 1; $i <= 5; $i++)
                    <svg class="h-4 w-4 {{ $i <= $testimonial->rating ? 'text-amber-400' : 'text-slate-700' }}"
                        fill="currentColor" viewBox="0 0 20 20" aria-hidden="true">
                        <path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z"/>
                    </svg>
                    @endfor
                </div>
 
                {{-- Quote --}}
                <blockquote class="flex-1 text-sm text-slate-300 leading-relaxed mb-5 italic">
                    "{{ $testimonial->review }}"
                </blockquote>
 
                {{-- Author --}}
                <div class="flex items-center gap-3 pt-4 border-t border-white/8">
                    <div class="h-9 w-9 flex-shrink-0 overflow-hidden rounded-full bg-indigo-500/20">
                        @if ($testimonial->image)
                            <img src="{{ Storage::url($testimonial->image) }}" alt="{{ $testimonial->client_name }}" class="h-full w-full object-cover"/>
                        @else
                            <div class="flex h-full w-full items-center justify-center text-xs font-bold text-indigo-400">
                                {{ strtoupper(substr($testimonial->client_name, 0, 1)) }}
                            </div>
                        @endif
                    </div>
                    <div>
                        <p class="text-sm font-semibold text-white">{{ $testimonial->client_name }}</p>
                        <p class="text-[11px] text-slate-500">
                            {{ implode(', ', array_filter([$testimonial->designation, $testimonial->company])) }}
                        </p>
                    </div>
                </div>
            </div>
            @endforeach
        </div>
 
    </div>
</section>
@endif
 
 
{{-- ════════════════════════════════════════════════════════════════
     §6 RECENT BLOG POSTS
════════════════════════════════════════════════════════════════ --}}
@if ($recentBlogs && $recentBlogs->isNotEmpty())
<section class="py-24 bg-[#0f172a]" aria-labelledby="blog-heading">
    <div class="mx-auto max-w-7xl px-4 sm:px-6 lg:px-8">
 
        <div class="mb-14 flex flex-col gap-4 sm:flex-row sm:items-end sm:justify-between">
            <div>
                <p class="mb-2 text-xs font-semibold uppercase tracking-widest text-indigo-400">Insights</p>
                <h2 id="blog-heading" class="text-3xl sm:text-4xl font-bold text-white" style="font-family:'Syne',sans-serif">
                    Latest from the Blog
                </h2>
            </div>
            <a href="{{ url('/blog') }}" class="inline-flex items-center gap-1.5 text-sm font-medium text-indigo-400 hover:text-indigo-300 transition-colors self-start sm:self-auto">
                All articles
                <svg class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2" aria-hidden="true"><path stroke-linecap="round" stroke-linejoin="round" d="M13.5 4.5L21 12m0 0l-7.5 7.5M21 12H3"/></svg>
            </a>
        </div>
 
        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-5">
            @foreach ($recentBlogs->take(3) as $post)
            <a
                href="{{ url('/blog/' . $post->slug) }}"
                class="group flex flex-col rounded-2xl border border-white/8 bg-white/3 overflow-hidden hover:border-indigo-500/25 hover:bg-white/5 transition-all duration-200"
            >
                {{-- Cover --}}
                <div class="h-48 overflow-hidden bg-slate-800 flex-shrink-0">
                    @if ($post->featured_image ?? $post->cover_image ?? null)
                        <img
                            src="{{ Storage::url($post->featured_image ?? $post->cover_image) }}"
                            alt="{{ $post->title }}"
                            class="h-full w-full object-cover transition-transform duration-500 group-hover:scale-105"
                            loading="lazy"
                        />
                    @else
                        <div class="flex h-full w-full items-center justify-center bg-gradient-to-br from-indigo-900/50 to-slate-900">
                            <svg class="h-8 w-8 text-indigo-800" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1" aria-hidden="true">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M12 7.5h1.5m-1.5 3h1.5m-7.5 3h7.5m-7.5 3h7.5"/>
                            </svg>
                        </div>
                    @endif
                </div>
 
                {{-- Content --}}
                <div class="flex flex-1 flex-col p-5">
                    {{-- Category + date --}}
                    <div class="mb-3 flex items-center gap-2 text-[11px] text-slate-500">
                        @if ($post->category)
                        <span class="rounded-full bg-indigo-500/10 px-2.5 py-0.5 text-indigo-400 font-medium">{{ $post->category->name }}</span>
                        <span>·</span>
                        @endif
                        <span>{{ $post->published_at ? $post->published_at->format('M j, Y') : $post->created_at->format('M j, Y') }}</span>
                    </div>
 
                    <h3 class="mb-2 text-sm font-semibold text-white leading-snug group-hover:text-indigo-200 transition-colors line-clamp-2">
                        {{ $post->title }}
                    </h3>
 
                    <p class="flex-1 text-xs text-slate-400 leading-relaxed line-clamp-3">
                        {{ $post->excerpt ?? Str::limit(strip_tags($post->content), 110) }}
                    </p>
 
                    {{-- Read more --}}
                    <div class="mt-4 flex items-center gap-1.5 text-xs font-medium text-indigo-400 group-hover:gap-2.5 transition-all">
                        Read article
                        <svg class="h-3.5 w-3.5" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2" aria-hidden="true"><path stroke-linecap="round" stroke-linejoin="round" d="M13.5 4.5L21 12m0 0l-7.5 7.5M21 12H3"/></svg>
                    </div>
                </div>
            </a>
            @endforeach
        </div>
 
    </div>
</section>
@endif
 
 
{{-- ════════════════════════════════════════════════════════════════
     §7 CTA BANNER
════════════════════════════════════════════════════════════════ --}}
<section class="py-24 bg-[#0b1120]" aria-labelledby="cta-heading">
    <div class="mx-auto max-w-4xl px-4 sm:px-6 lg:px-8 text-center">
 
        {{-- Decorative ring --}}
        <div class="relative inline-block mb-8" aria-hidden="true">
            <div class="absolute inset-0 rounded-full bg-indigo-500/20 blur-xl scale-150"></div>
            <div class="relative flex h-16 w-16 mx-auto items-center justify-center rounded-2xl bg-indigo-600">
                <svg class="h-8 w-8 text-white" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.8">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M21.75 6.75v10.5a2.25 2.25 0 01-2.25 2.25h-15a2.25 2.25 0 01-2.25-2.25V6.75m19.5 0A2.25 2.25 0 0019.5 4.5h-15a2.25 2.25 0 00-2.25 2.25m19.5 0v.243a2.25 2.25 0 01-1.07 1.916l-7.5 4.615a2.25 2.25 0 01-2.36 0L3.32 8.91a2.25 2.25 0 01-1.07-1.916V6.75"/>
                </svg>
            </div>
        </div>
 
        <h2 id="cta-heading" class="mb-5 text-3xl sm:text-5xl font-extrabold text-white leading-tight" style="font-family:'Syne',sans-serif">
            Ready to build something
            <span class="text-transparent bg-clip-text bg-gradient-to-r from-indigo-400 to-violet-400"> great?</span>
        </h2>
 
        <p class="mb-10 text-lg text-slate-400 max-w-xl mx-auto leading-relaxed">
            Tell us about your project and we'll get back to you within 24 hours with a plan.
        </p>
 
        <div class="flex flex-col sm:flex-row items-center justify-center gap-4">
            <a
                href="{{ url('/contact') }}"
                class="inline-flex items-center gap-2 rounded-2xl bg-indigo-600 px-7 py-3.5 text-sm font-semibold text-white shadow-lg shadow-indigo-900/40 hover:bg-indigo-500 active:bg-indigo-700 transition-colors"
            >
                <svg class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2.5" aria-hidden="true"><path stroke-linecap="round" stroke-linejoin="round" d="M12 4.5v15m7.5-7.5h-15"/></svg>
                Start a Project
            </a>
            @if ($setting?->email)
            <a
                href="mailto:{{ $setting->email }}"
                class="inline-flex items-center gap-2 rounded-2xl border border-white/15 bg-white/5 px-7 py-3.5 text-sm font-medium text-white hover:bg-white/10 hover:border-white/25 transition-all"
            >
                {{ $setting->email }}
            </a>
            @endif
        </div>
 
    </div>
</section>
 
@endsection