
{{--
    Route:      admin.dashboard

    Variables expected from controller:
      $totalServices  (int)
      $totalProjects  (int)
      $totalPosts     (int)
      $totalMessages  (int)
      $unreadMessages (int)
      $recentMessages (Collection of ContactMessage)
      $recentPosts    (Collection of BlogPost)
      $weeklyViews    (array  e.g. ['Mon'=>42, 'Tue'=>78, ...])
--}}

@extends('layouts.admin')

@section('title', 'Dashboard')
@section('page-title', 'Dashboard')

@section('breadcrumb')
    <span class="text-slate-300">/</span>
    <span class="text-slate-500">Overview</span>
@endsection

@section('content')

{{-- ============================================================
     STAT CARDS
============================================================ --}}
<div class="grid grid-cols-1 sm:grid-cols-2 xl:grid-cols-4 gap-5 mb-6">

    {{-- Services --}}
    <div class="rounded-2xl border border-slate-200 bg-white p-5 hover:border-indigo-200 hover:shadow-sm transition-all duration-200">
        <div class="flex items-center justify-between mb-4">
            <div class="flex h-10 w-10 items-center justify-center rounded-xl bg-violet-100">
                <svg class="h-5 w-5 text-violet-600" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.8" aria-hidden="true">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M11.42 15.17L17.25 21A2.652 2.652 0 0021 17.25l-5.877-5.877M11.42 15.17l2.496-3.03c.317-.384.74-.626 1.208-.766M11.42 15.17l-4.655 5.653a2.548 2.548 0 11-3.586-3.586l6.837-5.63m5.108-.233c.55-.164 1.163-.188 1.743-.14a4.5 4.5 0 004.486-6.336l-3.276 3.277a3.004 3.004 0 01-2.25-2.25l3.276-3.276a4.5 4.5 0 00-6.336 4.486c.091 1.076-.071 2.264-.904 2.95l-.102.085m-1.745 1.437L5.909 7.5H4.5L2.25 3.75l1.5-1.5L7.5 4.5v1.409l4.26 4.26m-1.745 1.437l1.745-1.437m6.615 8.206L15.75 15.75M4.867 19.125h.008v.008h-.008v-.008z"/>
                </svg>
            </div>
            <a href="#" class="text-xs font-medium text-indigo-600 hover:text-indigo-800 transition-colors">View all →</a>
        </div>
        <p class="text-xs font-medium text-slate-500 mb-1">Total Services</p>
        <p class="text-3xl font-semibold text-slate-800 font-display">{{ $totalServices ?? 0 }}</p>
        <p class="mt-2 text-xs text-slate-400">Active offerings on your site</p>
    </div>

    {{-- Projects --}}
    <div class="rounded-2xl border border-slate-200 bg-white p-5 hover:border-indigo-200 hover:shadow-sm transition-all duration-200">
        <div class="flex items-center justify-between mb-4">
            <div class="flex h-10 w-10 items-center justify-center rounded-xl bg-blue-100">
                <svg class="h-5 w-5 text-blue-600" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.8" aria-hidden="true">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M6.429 9.75L2.25 12l4.179 2.25m0-4.5l5.571 3 5.571-3m-11.142 0L2.25 7.5 12 2.25l9.75 5.25-4.179 2.25m0 0L21.75 12l-4.179 2.25m0 0l4.179 2.25L12 21.75 2.25 16.5l4.179-2.25m11.142 0l-5.571 3-5.571-3"/>
                </svg>
            </div>
            <a href="#" class="text-xs font-medium text-indigo-600 hover:text-indigo-800 transition-colors">View all →</a>
        </div>
        <p class="text-xs font-medium text-slate-500 mb-1">Total Projects</p>
        <p class="text-3xl font-semibold text-slate-800 font-display">{{ $totalProjects ?? 0 }}</p>
        <p class="mt-2 text-xs text-slate-400">Portfolio projects published</p>
    </div>

    {{-- Blog Posts --}}
    <div class="rounded-2xl border border-slate-200 bg-white p-5 hover:border-indigo-200 hover:shadow-sm transition-all duration-200">
        <div class="flex items-center justify-between mb-4">
            <div class="flex h-10 w-10 items-center justify-center rounded-xl bg-emerald-100">
                <svg class="h-5 w-5 text-emerald-600" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.8" aria-hidden="true">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M12 7.5h1.5m-1.5 3h1.5m-7.5 3h7.5m-7.5 3h7.5m3-9h3.375c.621 0 1.125.504 1.125 1.125V18a2.25 2.25 0 01-2.25 2.25M16.5 7.5V18a2.25 2.25 0 002.25 2.25M16.5 7.5V4.875c0-.621-.504-1.125-1.125-1.125H4.125C3.504 3.75 3 4.254 3 4.875V18a2.25 2.25 0 002.25 2.25h13.5M6 7.5h3v3H6v-3z"/>
                </svg>
            </div>
            <a href="#" class="text-xs font-medium text-indigo-600 hover:text-indigo-800 transition-colors">View all →</a>
        </div>
        <p class="text-xs font-medium text-slate-500 mb-1">Blog Posts</p>
        <p class="text-3xl font-semibold text-slate-800 font-display">{{ $totalPosts ?? 0 }}</p>
        <p class="mt-2 text-xs text-slate-400">Published articles on blog</p>
    </div>

    {{-- Contact Messages --}}
    <div class="rounded-2xl border border-slate-200 bg-white p-5 hover:border-indigo-200 hover:shadow-sm transition-all duration-200">
        <div class="flex items-center justify-between mb-4">
            <div class="flex h-10 w-10 items-center justify-center rounded-xl bg-amber-100">
                <svg class="h-5 w-5 text-amber-600" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.8" aria-hidden="true">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M21.75 6.75v10.5a2.25 2.25 0 01-2.25 2.25h-15a2.25 2.25 0 01-2.25-2.25V6.75m19.5 0A2.25 2.25 0 0019.5 4.5h-15a2.25 2.25 0 00-2.25 2.25m19.5 0v.243a2.25 2.25 0 01-1.07 1.916l-7.5 4.615a2.25 2.25 0 01-2.36 0L3.32 8.91a2.25 2.25 0 01-1.07-1.916V6.75"/>
                </svg>
            </div>
            <a href="#" class="text-xs font-medium text-indigo-600 hover:text-indigo-800 transition-colors">View all →</a>
        </div>
        <p class="text-xs font-medium text-slate-500 mb-1">Contact Messages</p>
        <p class="text-3xl font-semibold text-slate-800 font-display">{{ $totalMessages ?? 0 }}</p>
        @if (($unreadMessages ?? 0) > 0)
            <p class="mt-2 text-xs font-medium text-amber-600">
                {{ $unreadMessages }} unread message{{ $unreadMessages > 1 ? 's' : '' }}
            </p>
        @else
            <p class="mt-2 text-xs text-slate-400">All messages read</p>
        @endif
    </div>

</div>{{-- end stat cards --}}


{{-- ============================================================
     MIDDLE ROW — Recent Messages + Weekly Chart
============================================================ --}}
<div class="grid grid-cols-1 lg:grid-cols-2 gap-5 mb-5">

    {{-- Recent Messages --}}
    <div class="rounded-2xl border border-slate-200 bg-white overflow-hidden">
        <div class="flex items-center justify-between px-5 py-4 border-b border-slate-100">
            <h2 class="text-sm font-semibold text-slate-700">Recent Messages</h2>
            <a href="#" class="text-xs font-medium text-indigo-600 hover:text-indigo-800 transition-colors">View all →</a>
        </div>

        @forelse ($recentMessages ?? [] as $message)
            <div class="flex items-start gap-3 px-5 py-3.5 border-b border-slate-50 hover:bg-slate-50/60 transition-colors last:border-0">
                {{-- Unread dot --}}
                <div class="mt-1.5 flex-shrink-0">
                    @if (is_null($message->read_at))
                        <span class="block h-2 w-2 rounded-full bg-indigo-500" title="Unread"></span>
                    @else
                        <span class="block h-2 w-2 rounded-full bg-slate-200" title="Read"></span>
                    @endif
                </div>

                <div class="flex-1 min-w-0">
                    <p class="text-sm font-medium text-slate-700 truncate">{{ $message->name }}</p>
                    <p class="text-xs text-slate-400 truncate">{{ Str::limit($message->message, 55) }}</p>
                </div>

                <div class="flex-shrink-0 text-right">
                    <p class="text-[11px] text-slate-400">{{ $message->created_at->diffForHumans(null, true) }}</p>
                    <a
                        href="#"
                        class="text-[11px] font-medium text-indigo-500 hover:text-indigo-700 transition-colors"
                    >Reply</a>
                </div>
            </div>
        @empty
            <div class="flex flex-col items-center justify-center py-10 text-slate-400">
                <svg class="h-8 w-8 mb-2 text-slate-300" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.5" aria-hidden="true">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M21.75 6.75v10.5a2.25 2.25 0 01-2.25 2.25h-15a2.25 2.25 0 01-2.25-2.25V6.75"/>
                </svg>
                <p class="text-sm">No messages yet</p>
            </div>
        @endforelse
    </div>

    {{-- Weekly Blog Views Chart --}}
    <div class="rounded-2xl border border-slate-200 bg-white overflow-hidden">
        <div class="flex items-center justify-between px-5 py-4 border-b border-slate-100">
            <h2 class="text-sm font-semibold text-slate-700">Blog views — this week</h2>
            <span class="text-xs text-slate-400">Last 7 days</span>
        </div>
        <div class="px-5 py-5">
            {{-- Simple CSS bar chart --}}
            @php
                $days = $weeklyViews ?? ['Mon' => 42, 'Tue' => 78, 'Wed' => 55, 'Thu' => 91, 'Fri' => 67, 'Sat' => 38, 'Sun' => 83];
                $maxViews = max($days) ?: 1;
                $todayKey = now()->format('D');
            @endphp
            <div class="flex items-end gap-2 h-36" role="img" aria-label="Weekly blog views chart">
                @foreach ($days as $day => $views)
                    @php
                        $heightPct = round(($views / $maxViews) * 100);
                        $isToday   = strtolower(substr($day, 0, 3)) === strtolower(substr($todayKey, 0, 3));
                    @endphp
                    <div class="flex flex-1 flex-col items-center gap-1.5" title="{{ $day }}: {{ $views }} views">
                        <span class="text-[10px] text-slate-400">{{ $views }}</span>
                        <div class="w-full rounded-t-md transition-all duration-300 {{ $isToday ? 'bg-indigo-500' : 'bg-slate-200 hover:bg-indigo-300' }}" style="height: {{ $heightPct }}%"></div>
                        <span class="text-[10px] text-slate-400 font-medium {{ $isToday ? 'text-indigo-600' : '' }}">{{ substr($day, 0, 3) }}</span>
                    </div>
                @endforeach
            </div>
            <div class="mt-3 flex items-center gap-4 text-[11px] text-slate-400">
                <span class="flex items-center gap-1.5"><span class="inline-block h-2.5 w-2.5 rounded-sm bg-indigo-500"></span> Today</span>
                <span class="flex items-center gap-1.5"><span class="inline-block h-2.5 w-2.5 rounded-sm bg-slate-200"></span> Previous days</span>
            </div>
        </div>
    </div>

</div>{{-- end middle row --}}


{{-- ============================================================
     RECENT BLOG POSTS TABLE
============================================================ --}}
<div class="rounded-2xl border border-slate-200 bg-white overflow-hidden">
    <div class="flex items-center justify-between px-5 py-4 border-b border-slate-100">
        <h2 class="text-sm font-semibold text-slate-700">Recent Blog Posts</h2>
        <a href="#" class="inline-flex items-center gap-1.5 rounded-lg bg-indigo-600 px-3 py-1.5 text-xs font-medium text-white hover:bg-indigo-700 transition-colors">
            <svg class="h-3.5 w-3.5" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2.5" aria-hidden="true">
                <path stroke-linecap="round" stroke-linejoin="round" d="M12 4.5v15m7.5-7.5h-15"/>
            </svg>
            New Post
        </a>
    </div>

    <div class="overflow-x-auto">
        <table class="min-w-full divide-y divide-slate-100">
            <thead>
                <tr class="bg-slate-50/80">
                    <th scope="col" class="px-5 py-3 text-left text-[11px] font-semibold uppercase tracking-wider text-slate-500">Title</th>
                    <th scope="col" class="px-5 py-3 text-left text-[11px] font-semibold uppercase tracking-wider text-slate-500">Category</th>
                    <th scope="col" class="px-5 py-3 text-left text-[11px] font-semibold uppercase tracking-wider text-slate-500">Author</th>
                    <th scope="col" class="px-5 py-3 text-left text-[11px] font-semibold uppercase tracking-wider text-slate-500">Status</th>
                    <th scope="col" class="px-5 py-3 text-left text-[11px] font-semibold uppercase tracking-wider text-slate-500">Date</th>
                    <th scope="col" class="px-5 py-3 text-right text-[11px] font-semibold uppercase tracking-wider text-slate-500">Actions</th>
                </tr>
            </thead>
            <tbody class="divide-y divide-slate-100">
                @forelse ($recentPosts ?? [] as $post)
                    <tr class="hover:bg-slate-50/60 transition-colors">
                        <td class="px-5 py-3.5 text-sm font-medium text-slate-700 max-w-[220px]">
                            <span class="truncate block">{{ $post->title }}</span>
                        </td>
                        <td class="px-5 py-3.5 text-xs text-slate-500">
                            {{ $post->category->name ?? '—' }}
                        </td>
                        <td class="px-5 py-3.5 text-xs text-slate-500">
                            {{ $post->author->name ?? '—' }}
                        </td>
                        <td class="px-5 py-3.5">
                            @php
                                $statusMap = [
                                    'published' => 'bg-emerald-100 text-emerald-700',
                                    'draft'     => 'bg-slate-100 text-slate-600',
                                    'archived'  => 'bg-amber-100 text-amber-700',
                                ];
                                $statusClass = $statusMap[$post->status] ?? 'bg-slate-100 text-slate-500';
                            @endphp
                            <span class="inline-flex items-center rounded-full px-2.5 py-0.5 text-[11px] font-semibold {{ $statusClass }} capitalize">
                                {{ $post->status }}
                            </span>
                        </td>
                        <td class="px-5 py-3.5 text-xs text-slate-400 whitespace-nowrap">
                            {{ optional($post->published_at ?? $post->created_at)->format('M j, Y') }}
                        </td>
                        <td class="px-5 py-3.5 text-right">
                            <div class="flex items-center justify-end gap-2">
                                <a
                                    href="#"
                                    class="inline-flex items-center gap-1 rounded-lg border border-slate-200 bg-white px-2.5 py-1 text-[11px] font-medium text-slate-600 hover:border-indigo-300 hover:text-indigo-700 transition-all"
                                >
                                    <svg class="h-3 w-3" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2" aria-hidden="true">
                                        <path stroke-linecap="round" stroke-linejoin="round" d="M16.862 4.487l1.687-1.688a1.875 1.875 0 112.652 2.652L10.582 16.07a4.5 4.5 0 01-1.897 1.13L6 18l.8-2.685a4.5 4.5 0 011.13-1.897l8.932-8.931zm0 0L19.5 7.125"/>
                                    </svg>
                                    Edit
                                </a>
                                <form method="POST" action="#" onsubmit="return confirm('Delete this post?')">
                                    @csrf
                                    @method('DELETE')
                                    <button
                                        type="submit"
                                        class="inline-flex items-center gap-1 rounded-lg border border-slate-200 bg-white px-2.5 py-1 text-[11px] font-medium text-red-500 hover:border-red-200 hover:bg-red-50 hover:text-red-700 transition-all"
                                    >
                                        <svg class="h-3 w-3" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2" aria-hidden="true">
                                            <path stroke-linecap="round" stroke-linejoin="round" d="M14.74 9l-.346 9m-4.788 0L9.26 9m9.968-3.21c.342.052.682.107 1.022.166m-1.022-.165L18.16 19.673a2.25 2.25 0 01-2.244 2.077H8.084a2.25 2.25 0 01-2.244-2.077L4.772 5.79m14.456 0a48.108 48.108 0 00-3.478-.397m-12 .562c.34-.059.68-.114 1.022-.165m0 0a48.11 48.11 0 013.478-.397m7.5 0v-.916c0-1.18-.91-2.164-2.09-2.201a51.964 51.964 0 00-3.32 0c-1.18.037-2.09 1.022-2.09 2.201v.916m7.5 0a48.667 48.667 0 00-7.5 0"/>
                                        </svg>
                                        Delete
                                    </button>
                                </form>
                            </div>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="6" class="px-5 py-10 text-center">
                            <div class="flex flex-col items-center gap-2 text-slate-400">
                                <svg class="h-8 w-8 text-slate-300" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.5" aria-hidden="true">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M12 7.5h1.5m-1.5 3h1.5m-7.5 3h7.5m-7.5 3h7.5"/>
                                </svg>
                                <p class="text-sm">No blog posts yet</p>
                                <a href="#" class="text-xs font-medium text-indigo-600 hover:text-indigo-800 transition-colors">Create your first post →</a>
                            </div>
                        </td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>{{-- end recent posts --}}

@endsection