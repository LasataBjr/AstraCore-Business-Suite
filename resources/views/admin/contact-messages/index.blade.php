@extends('layouts.admin')

@section('title', 'Contact Inbox')
@section('page-title', 'Contact Inbox')

@section('breadcrumb')
    <span class="text-slate-300">/</span>
    <span class="text-slate-500">All Messages</span>
@endsection

@section('content')

<div class="grid grid-cols-1 lg:grid-cols-4 gap-5">

    {{-- LEFT SIDEBAR FILTERS --}}
    <div class="lg:col-span-1 bg-white border rounded-2xl p-4 h-fit">

        <h3 class="font-semibold text-slate-700 mb-3">Inbox</h3>

        <div class="space-y-2 text-sm">

            <a href="{{ route('admin.contact-messages.index') }}"
               class="block px-3 py-2 rounded-lg hover:bg-slate-100 {{ !request('status') ? 'bg-slate-100 font-semibold' : '' }}">
                All Messages
            </a>

            <a href="?status=new"
               class="block px-3 py-2 rounded-lg hover:bg-slate-100 {{ request('status')=='new' ? 'bg-indigo-50 text-indigo-700 font-semibold' : '' }}">
                🆕 New
            </a>

            <a href="?status=read"
               class="block px-3 py-2 rounded-lg hover:bg-slate-100 {{ request('status')=='read' ? 'bg-blue-50 text-blue-700 font-semibold' : '' }}">
                👁 Read
            </a>

            <a href="?status=replied"
               class="block px-3 py-2 rounded-lg hover:bg-slate-100 {{ request('status')=='replied' ? 'bg-green-50 text-green-700 font-semibold' : '' }}">
                ✅ Replied
            </a>

            <a href="?status=archived"
               class="block px-3 py-2 rounded-lg hover:bg-slate-100 {{ request('status')=='archived' ? 'bg-slate-200 font-semibold' : '' }}">
                📦 Archived
            </a>

        </div>
    </div>

    {{-- MESSAGE LIST --}}
    <div class="lg:col-span-3 grid grid-cols-1 lg:grid-cols-3 gap-5">

        {{-- LEFT LIST --}}
        <div class="lg:col-span-1 bg-white border rounded-2xl overflow-hidden">

            <div class="p-3 border-b">
                <form>
                    <input type="text"
                           name="search"
                           value="{{ request('search') }}"
                           placeholder="Search messages..."
                           class="w-full text-sm border rounded-lg px-3 py-2">
                </form>
            </div>

            <div class="divide-y max-h-[70vh] overflow-y-auto">

                @foreach($messages as $msg)
                    <a href="?selected={{ $msg->id }}"
                       class="block p-3 hover:bg-slate-50 {{ request('selected')==$msg->id ? 'bg-slate-100' : '' }}">

                        <div class="flex justify-between items-center">
                            <p class="font-semibold text-sm">{{ $msg->name }}</p>

                            <span class="text-[10px] px-2 py-1 rounded-full
                                @if($msg->status=='new') bg-indigo-100 text-indigo-700
                                @elseif($msg->status=='read') bg-blue-100 text-blue-700
                                @elseif($msg->status=='replied') bg-green-100 text-green-700
                                @else bg-slate-200 text-slate-600 @endif">
                                {{ ucfirst($msg->status) }}
                            </span>
                        </div>

                        <p class="text-xs text-slate-500 truncate">
                            {{ $msg->subject }}
                        </p>

                        <p class="text-[11px] text-slate-400">
                            {{ $msg->created_at->diffForHumans() }}
                        </p>
                    </a>
                @endforeach

            </div>
        </div>

        {{-- RIGHT PREVIEW PANEL --}}
        <div class="lg:col-span-2 bg-white border rounded-2xl p-5">

            @php
                $selectedMessage = $messages->where('id', request('selected'))->first();
            @endphp

            @if($selectedMessage)

                <div class="flex justify-between items-start mb-4">
                    <div>
                        <h2 class="text-lg font-bold">{{ $selectedMessage->subject }}</h2>
                        <p class="text-sm text-slate-500">
                            From: {{ $selectedMessage->name }} ({{ $selectedMessage->email }})
                        </p>
                    </div>

                    <div class="flex gap-2">

                        {{-- mark read --}}
                        <form method="POST" action="{{ route('admin.contact-messages.update', $selectedMessage) }}">
                            @csrf
                            @method('PUT')
                            <input type="hidden" name="status" value="read">
                            <button class="text-xs px-3 py-1 bg-blue-100 text-blue-700 rounded-lg">
                                Mark Read
                            </button>
                        </form>

                        {{-- archive --}}
                        <form method="POST" action="{{ route('admin.contact-messages.update', $selectedMessage) }}">
                            @csrf
                            @method('PUT')
                            <input type="hidden" name="status" value="archived">
                            <button class="text-xs px-3 py-1 bg-slate-200 text-slate-700 rounded-lg">
                                Archive
                            </button>
                        </form>

                        {{-- delete --}}
                        <form method="POST"
                              action="{{ route('admin.contact-messages.destroy', $selectedMessage) }}"
                              onsubmit="return confirm('Delete message?')">
                            @csrf
                            @method('DELETE')
                            <button class="text-xs px-3 py-1 bg-red-100 text-red-700 rounded-lg">
                                Delete
                            </button>
                        </form>

                    </div>
                </div>

                <div class="border-t pt-4">
                    <p class="text-sm text-slate-700 whitespace-pre-line">
                        {{ $selectedMessage->message }}
                    </p>
                </div>

            @else
                <div class="text-center text-slate-400 py-20">
                    <p>Select a message to view</p>
                </div>
            @endif

        </div>

    </div>
</div>

@endsection