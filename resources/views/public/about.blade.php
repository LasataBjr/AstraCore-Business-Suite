@extends('layouts.public')

@section('title', 'About Us — AstraCore')

@section('content')

{{-- ═══════════════════════════════════════════════════
     HERO
═══════════════════════════════════════════════════ --}}
<section class="about-hero relative min-h-[60vh] flex items-center overflow-hidden bg-navy-950">

  {{-- Animated grid (matches home) --}}
  <div class="about-hero-grid absolute inset-0 pointer-events-none" aria-hidden="true"></div>

  {{-- Glow --}}
  <div class="absolute inset-0 pointer-events-none">
    <div class="absolute top-1/2 left-1/3 -translate-x-1/2 -translate-y-1/2
                w-[600px] h-[400px] rounded-full bg-navy-500/10 blur-[120px]"></div>
  </div>

  <div class="relative z-10 max-w-7xl mx-auto px-6 lg:px-8 py-32 w-full">
    <div class="max-w-3xl">

      <div class="ah-eyebrow inline-flex items-center gap-2.5 mb-8
                  px-4 py-1.5 rounded-full border border-navy-700/60
                  bg-navy-900/60 backdrop-blur-sm">
        <span class="w-1.5 h-1.5 rounded-full bg-navy-400 animate-pulse"></span>
        <span class="font-mono text-xs tracking-widest text-navy-300 uppercase">Our Story</span>
      </div>

      <h1 class="ah-headline font-display font-bold text-white leading-[1.05] mb-6
                  text-5xl sm:text-6xl lg:text-7xl">
        We Build Digital<br>
        <span class="text-gradient">Infrastructure.</span>
      </h1>

      <p class="ah-sub font-sans text-lg text-slate-400 leading-relaxed max-w-2xl">
        AstraCore is a digital engineering studio that architects, designs, and ships
        products built to last — not just to launch. We've partnered with startups and
        enterprises across four continents to turn ideas into systems that scale.
      </p>

    </div>
  </div>
</section>


{{-- ═══════════════════════════════════════════════════
     WHO WE ARE  (split layout with richer copy)
═══════════════════════════════════════════════════ --}}
<section class="py-28 bg-slate-950">
  <div class="max-w-7xl mx-auto px-6 lg:px-8">

    <div class="grid lg:grid-cols-2 gap-16 items-center">

      {{-- Image column --}}
      <div class="relative">
        <div class="rounded-2xl overflow-hidden aspect-[4/3]">
          <img src="https://images.unsplash.com/photo-1522202176988-66273c2fd55f?w=900&q=80"
               alt="AstraCore team collaborating"
               class="w-full h-full object-cover">
        </div>

        {{-- Floating stat card --}}
        <div class="absolute -bottom-6 -right-6 hidden lg:flex flex-col gap-1
                    bg-navy-900 border border-navy-700 rounded-2xl px-6 py-5 shadow-card-lg">
          <span class="font-display font-bold text-white text-3xl">2016</span>
          <span class="font-sans text-xs text-slate-400">Founded in Kathmandu</span>
        </div>

        {{-- Accent border --}}
        <div class="absolute -top-3 -left-3 w-24 h-24 border-t-2 border-l-2
                    border-navy-500/40 rounded-tl-2xl pointer-events-none"></div>
      </div>

      {{-- Text column --}}
      <div>
        <p class="font-mono text-xs tracking-widest text-navy-400 uppercase mb-4">Who We Are</p>

        <h2 class="font-display font-bold text-white text-4xl lg:text-5xl leading-tight mb-8">
          A Studio That Thinks<br>in Systems
        </h2>

        <div class="space-y-5 font-sans text-slate-400 leading-relaxed">
          <p>
            AstraCore started in 2016 as a two-person consultancy specialising in backend
            architecture. Over eight years we've grown into a full-stack digital studio with
            expertise that spans cloud infrastructure, product design, and growth engineering.
          </p>
          <p>
            What sets us apart isn't just craft — it's how we think. Every engagement starts
            with understanding the constraints: technical debt, team size, timeline, and the
            real business problem hiding behind the feature request.
          </p>
          <p>
            We don't believe in handoffs. Our designers and engineers work in the same room
            (or Figma file), which means what gets designed actually gets built — and what
            gets built actually solves the problem.
          </p>
        </div>

        {{-- Core values chips --}}
        <div class="mt-10 flex flex-wrap gap-2.5">
          @foreach(['Systems Thinking', 'Radical Honesty', 'Ship & Iterate', 'Depth Over Breadth', 'Long-term Partnerships'] as $value)
          <span class="font-mono text-xs text-navy-300 border border-navy-700 bg-navy-900/60
                       rounded-full px-3.5 py-1.5 tracking-wide">
            {{ $value }}
          </span>
          @endforeach
        </div>
      </div>

    </div>
  </div>
</section>


{{-- ═══════════════════════════════════════════════════
     STATS BAR
═══════════════════════════════════════════════════ --}}
<section class="py-20 bg-navy-900 border-y border-navy-800">
  <div class="max-w-7xl mx-auto px-6 lg:px-8">
    <div class="grid grid-cols-2 lg:grid-cols-4 gap-10">
      @foreach([
        ['50+',  'Projects Shipped',    'Across SaaS, fintech, healthtech, and e-commerce.'],
        ['25+',  'Clients Worldwide',   'From Kathmandu to New York.'],
        ['8+',   'Years in Practice',   'Since 2016 — no sign of slowing down.'],
        ['100%', 'Client Retention',    'Every client who finished a project came back.'],
      ] as [$num, $label, $sub])
      <div class="stat-item">
        <div class="font-display font-bold text-4xl lg:text-5xl text-white mb-1">{{ $num }}</div>
        <div class="font-sans font-semibold text-slate-300 text-sm mb-1">{{ $label }}</div>
        <div class="font-sans text-xs text-slate-600 leading-snug">{{ $sub }}</div>
      </div>
      @endforeach
    </div>
  </div>
</section>


{{-- ═══════════════════════════════════════════════════
     MISSION & VISION  (side-by-side with icon accents)
═══════════════════════════════════════════════════ --}}
<section class="py-28 bg-slate-950">
  <div class="max-w-7xl mx-auto px-6 lg:px-8">

    <div class="text-center mb-16">
      <p class="font-mono text-xs tracking-widest text-navy-400 uppercase mb-3">What Drives Us</p>
      <h2 class="font-display font-bold text-white text-4xl lg:text-5xl">Purpose & Direction</h2>
    </div>

    <div class="grid md:grid-cols-2 gap-6">

      {{-- Mission --}}
      <div class="mv-card relative p-10 rounded-2xl border border-navy-800 bg-navy-900/40
                  overflow-hidden group hover:border-navy-600 transition-all duration-300">
        <div class="absolute top-0 right-0 w-32 h-32 bg-navy-500/5
                    rounded-full -translate-y-1/2 translate-x-1/2 blur-2xl
                    group-hover:bg-navy-500/10 transition-colors duration-300"></div>

        <div class="w-12 h-12 rounded-xl bg-navy-800 border border-navy-700
                    flex items-center justify-center mb-7">
          <svg class="w-5 h-5 text-navy-400" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.5">
            <path stroke-linecap="round" stroke-linejoin="round"
                  d="M15.59 14.37a6 6 0 01-5.84 7.38v-4.8m5.84-2.58a14.98 14.98 0 006.16-12.12A14.98 14.98 0 009.631 8.41m5.96 5.96a14.926 14.926 0 01-5.841 2.58m-.119-8.54a6 6 0 00-7.381 5.84h4.8m2.581-5.84a14.927 14.927 0 00-2.58 5.84m2.699 2.7c-.103.021-.207.041-.311.06a15.09 15.09 0 01-2.448-2.448 14.9 14.9 0 01.06-.312m-2.24 2.39a4.493 4.493 0 00-1.757 4.306 4.493 4.493 0 004.306-1.758M16.5 9a1.5 1.5 0 11-3 0 1.5 1.5 0 013 0z"/>
          </svg>
        </div>

        <h3 class="font-display font-bold text-white text-2xl mb-4">Our Mission</h3>
        <p class="font-sans text-slate-400 leading-relaxed">
          To partner with ambitious builders and help them ship digital products that work
          at scale — with clarity, performance, and architecture decisions that don't need
          to be re-made in six months.
        </p>
        <p class="font-sans text-slate-500 text-sm leading-relaxed mt-4">
          We measure success not at launch, but one year later — in system uptime,
          user retention, and whether our clients' engineers enjoy maintaining what we built.
        </p>
      </div>

      {{-- Vision --}}
      <div class="mv-card relative p-10 rounded-2xl border border-navy-800 bg-navy-900/40
                  overflow-hidden group hover:border-navy-600 transition-all duration-300">
        <div class="absolute top-0 right-0 w-32 h-32 bg-navy-500/5
                    rounded-full -translate-y-1/2 translate-x-1/2 blur-2xl
                    group-hover:bg-navy-500/10 transition-colors duration-300"></div>

        <div class="w-12 h-12 rounded-xl bg-navy-800 border border-navy-700
                    flex items-center justify-center mb-7">
          <svg class="w-5 h-5 text-navy-400" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.5">
            <path stroke-linecap="round" stroke-linejoin="round"
                  d="M2.036 12.322a1.012 1.012 0 010-.639C3.423 7.51 7.36 4.5 12 4.5c4.638 0 8.573 3.007 9.963 7.178.07.207.07.431 0 .639C20.577 16.49 16.64 19.5 12 19.5c-4.638 0-8.573-3.007-9.963-7.178z"/>
            <path stroke-linecap="round" stroke-linejoin="round" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"/>
          </svg>
        </div>

        <h3 class="font-display font-bold text-white text-2xl mb-4">Our Vision</h3>
        <p class="font-sans text-slate-400 leading-relaxed">
          To become the studio that engineering-led companies trust to turn ambiguity into
          architecture — a global partner known not for the volume of projects shipped,
          but for the depth of problems solved.
        </p>
        <p class="font-sans text-slate-500 text-sm leading-relaxed mt-4">
          We want to look back in 2030 and point to products still running in production,
          teams still growing, and systems that didn't need to be rewritten.
        </p>
      </div>

    </div>
  </div>
</section>


{{-- ═══════════════════════════════════════════════════
     HOW WE WORK  (process, real sequence so numbered)
═══════════════════════════════════════════════════ --}}
<section class="py-28 bg-navy-950">
  <div class="max-w-7xl mx-auto px-6 lg:px-8">

    <div class="text-center mb-16">
      <p class="font-mono text-xs tracking-widest text-navy-400 uppercase mb-3">Our Process</p>
      <h2 class="font-display font-bold text-white text-4xl lg:text-5xl">How We Engage</h2>
    </div>

    <div class="grid md:grid-cols-2 lg:grid-cols-4 gap-6">
      @foreach([
        ['01', 'Discovery',      'We dig into your business constraints, technical context, and user needs before proposing anything.'],
        ['02', 'Architecture',   'We map out the right system design, tech stack, and delivery plan — then get explicit sign-off before building.'],
        ['03', 'Build & Iterate','We work in short cycles with real deliverables. You always know what is shipped and what is next.'],
        ['04', 'Handoff & Scale','We document thoroughly, train your team, and stay on as a long-term partner — not a one-time vendor.'],
      ] as [$step, $title, $desc])
      <div class="process-card group p-7 rounded-2xl border border-navy-800 bg-navy-900/30
                  hover:border-navy-600 hover:bg-navy-900/60 transition-all duration-300">
        <div class="font-mono text-navy-600 text-xs tracking-widest mb-5
                    group-hover:text-navy-400 transition-colors duration-300">
          {{ $step }}
        </div>
        <h3 class="font-display font-semibold text-white text-lg mb-3">{{ $title }}</h3>
        <p class="font-sans text-slate-500 text-sm leading-relaxed">{{ $desc }}</p>
      </div>
      @endforeach
    </div>

  </div>
</section>


{{-- ═══════════════════════════════════════════════════
     TEAM  ──  TeamMember Model (dynamic)
═══════════════════════════════════════════════════ --}}
@if($teamMembers->isNotEmpty())
<section class="py-28 bg-slate-950">
  <div class="max-w-7xl mx-auto px-6 lg:px-8">

    <div class="text-center mb-16">
      <p class="font-mono text-xs tracking-widest text-navy-400 uppercase mb-3">The People</p>
      <h2 class="font-display font-bold text-white text-4xl lg:text-5xl mb-4">Meet the Studio</h2>
      <p class="font-sans text-slate-500 max-w-xl mx-auto">
        Small enough to care about every pixel. Experienced enough to architect for millions of users.
      </p>
    </div>

    <div class="grid sm:grid-cols-2 lg:grid-cols-4 gap-6">
      @foreach($teamMembers as $member)
      <article class="team-card group rounded-2xl border border-navy-800 bg-navy-900/40
                      overflow-hidden hover:border-navy-600 transition-all duration-300
                      hover:-translate-y-1">

        {{-- Portrait --}}
        <div class="relative overflow-hidden aspect-[3/4] bg-navy-800">
          <img src="{{ asset('storage/' . $member->image) }}"
               alt="{{ $member->name }}"
               class="w-full h-full object-cover object-top
                      group-hover:scale-105 transition-transform duration-500">

          {{-- Social overlay --}}
          <div class="absolute inset-0 bg-navy-950/70 opacity-0 group-hover:opacity-100
                      transition-opacity duration-300 flex items-end p-5">
            <div class="flex gap-3">
              @if($member->linkedin)
              <a href="{{ $member->linkedin }}" target="_blank" rel="noopener"
                 class="w-9 h-9 rounded-xl bg-navy-800 border border-navy-600
                        flex items-center justify-center text-navy-300 hover:text-white
                        hover:bg-navy-700 transition-colors duration-150"
                 aria-label="LinkedIn">
                <svg class="w-4 h-4" fill="currentColor" viewBox="0 0 24 24">
                  <path d="M20.447 20.452h-3.554v-5.569c0-1.328-.027-3.037-1.852-3.037-1.853 0-2.136 1.445-2.136 2.939v5.667H9.351V9h3.414v1.561h.046c.477-.9 1.637-1.85 3.37-1.85 3.601 0 4.267 2.37 4.267 5.455v6.286zM5.337 7.433a2.062 2.062 0 01-2.063-2.065 2.064 2.064 0 112.063 2.065zm1.782 13.019H3.555V9h3.564v11.452zM22.225 0H1.771C.792 0 0 .774 0 1.729v20.542C0 23.227.792 24 1.771 24h20.451C23.2 24 24 23.227 24 22.271V1.729C24 .774 23.2 0 22.222 0h.003z"/>
                </svg>
              </a>
              @endif
              @if($member->facebook)
              <a href="{{ $member->facebook }}" target="_blank" rel="noopener"
                 class="w-9 h-9 rounded-xl bg-navy-800 border border-navy-600
                        flex items-center justify-center text-navy-300 hover:text-white
                        hover:bg-navy-700 transition-colors duration-150"
                 aria-label="Facebook">
                <svg class="w-4 h-4" fill="currentColor" viewBox="0 0 24 24">
                  <path d="M24 12.073c0-6.627-5.373-12-12-12s-12 5.373-12 12c0 5.99 4.388 10.954 10.125 11.854v-8.385H7.078v-3.47h3.047V9.43c0-3.007 1.792-4.669 4.533-4.669 1.312 0 2.686.235 2.686.235v2.953H15.83c-1.491 0-1.956.925-1.956 1.874v2.25h3.328l-.532 3.47h-2.796v8.385C19.612 23.027 24 18.062 24 12.073z"/>
                </svg>
              </a>
              @endif
            </div>
          </div>
        </div>

        {{-- Info --}}
        <div class="p-6">
          <h3 class="font-display font-semibold text-white text-lg leading-snug">
            {{ $member->name }}
          </h3>
          <p class="font-mono text-xs text-navy-400 tracking-wide mt-0.5 mb-3">
            {{ $member->designation }}
          </p>
          <p class="font-sans text-slate-500 text-xs leading-relaxed">
            {{ Str::limit($member->bio, 110) }}
          </p>
        </div>

      </article>
      @endforeach
    </div>

  </div>
</section>
@endif


{{-- ═══════════════════════════════════════════════════
     CTA BANNER
═══════════════════════════════════════════════════ --}}
<section class="relative py-32 overflow-hidden bg-navy-900">

  <div class="absolute inset-0 pointer-events-none">
    <div class="absolute top-1/2 left-1/2 -translate-x-1/2 -translate-y-1/2
                w-[700px] h-[350px] rounded-full bg-navy-500/10 blur-[100px]"></div>
  </div>
  <div class="absolute top-0 left-0 right-0 h-px
              bg-gradient-to-r from-transparent via-navy-500/50 to-transparent"></div>

  <div class="relative z-10 max-w-3xl mx-auto px-6 lg:px-8 text-center">

    <p class="font-mono text-xs tracking-widest text-navy-400 uppercase mb-5">Work With Us</p>

    <h2 class="font-display font-bold text-white leading-tight mb-6 text-4xl lg:text-5xl">
      Got a Problem Worth<br>
      <span class="text-gradient">Solving Together?</span>
    </h2>

    <p class="font-sans text-slate-400 text-lg max-w-xl mx-auto mb-12 leading-relaxed">
      We take on a small number of projects at a time so every client gets our full attention.
      Let's talk about yours.
    </p>

    <a href="{{ route('contact') }}"
       class="inline-flex items-center gap-2.5 px-8 py-4 rounded-xl
              bg-navy-500 hover:bg-navy-400 text-white font-sans font-semibold text-base
              transition-all duration-200 shadow-xl shadow-navy-500/30
              hover:shadow-navy-400/40 hover:-translate-y-px">
      Start a Conversation
      <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
        <path stroke-linecap="round" stroke-linejoin="round" d="M17 8l4 4m0 0l-4 4m4-4H3"/>
      </svg>
    </a>

  </div>
</section>

@endsection

