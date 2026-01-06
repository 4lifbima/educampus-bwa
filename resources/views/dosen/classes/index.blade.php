@extends('layouts.dashboard')

@section('title', 'My Classes')
@section('page-title', 'My Classes')

@section('content')
<div class="flex flex-col md:flex-row md:items-center md:justify-between gap-4 mb-6 md:mb-8">
    <div>
        <h1 class="text-foreground text-2xl md:text-3xl font-bold mb-1">My Classes</h1>
        <p class="text-secondary text-sm md:text-base">Manage your assigned classes</p>
    </div>
    <a href="{{ route('dosen.classes.create') }}" class="flex items-center gap-2 px-6 py-3 bg-primary text-white rounded-full font-semibold hover:bg-primary-hover transition-all duration-300 cursor-pointer">
        <i data-lucide="plus" class="w-5 h-5"></i>
        <span>Add Class</span>
    </a>
</div>

<!-- Stats -->
<div class="grid grid-cols-2 lg:grid-cols-4 gap-4 mb-6">
    <div class="flex flex-col rounded-2xl border border-border p-4 gap-2 bg-white">
        <div class="flex items-center gap-3">
            <div class="size-10 bg-primary/10 rounded-xl flex items-center justify-center">
                <i data-lucide="book-open" class="size-5 text-primary"></i>
            </div>
            <div>
                <p class="text-2xl font-bold text-foreground">{{ $classes->count() }}</p>
                <p class="text-xs text-secondary">Total Classes</p>
            </div>
        </div>
    </div>
    <div class="flex flex-col rounded-2xl border border-border p-4 gap-2 bg-white">
        <div class="flex items-center gap-3">
            <div class="size-10 bg-success-light rounded-xl flex items-center justify-center">
                <i data-lucide="users" class="size-5 text-success"></i>
            </div>
            <div>
                <p class="text-2xl font-bold text-foreground">{{ $classes->sum('students_count') }}</p>
                <p class="text-xs text-secondary">Total Students</p>
            </div>
        </div>
    </div>
</div>

<!-- Class Cards -->
<div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-4">
    @forelse($classes as $class)
    <div class="flex flex-col rounded-2xl border border-border p-5 bg-white hover:ring-1 hover:ring-primary transition-all duration-300">
        <div class="flex items-start justify-between mb-4">
            <div>
                <h3 class="font-bold text-lg text-foreground">{{ $class->name }}</h3>
                <p class="text-secondary text-sm">{{ $class->code }}</p>
            </div>
            <span class="px-3 py-1 rounded-full text-xs font-medium {{ $class->getStatusBadgeClass() }}">
                {{ ucfirst($class->status) }}
            </span>
        </div>

        <div class="space-y-2 mb-4">
            <div class="flex items-center gap-2 text-sm text-secondary">
                <i data-lucide="map-pin" class="size-4"></i>
                <span>{{ $class->room ?? 'TBD' }}</span>
            </div>
            <div class="flex items-center gap-2 text-sm text-secondary">
                <i data-lucide="clock" class="size-4"></i>
                <span>{{ $class->schedule_day ?? 'TBD' }} {{ $class->schedule_time ?? '' }}</span>
            </div>
            <div class="flex items-center gap-2 text-sm text-secondary">
                <i data-lucide="users" class="size-4"></i>
                <span>{{ $class->students_count }}/{{ $class->capacity ?? '∞' }} students</span>
            </div>
        </div>

        <div class="flex items-center justify-between pt-4 border-t border-border mt-auto">
            <span class="text-sm font-medium text-primary">{{ $class->credits }} SKS</span>
            <div class="flex items-center gap-2">
                <a href="{{ route('dosen.classes.edit', $class) }}" class="size-9 flex items-center justify-center rounded-xl ring-1 ring-border hover:ring-primary hover:bg-primary/10 transition-all duration-300">
                    <i data-lucide="pencil" class="size-4 text-secondary hover:text-primary"></i>
                </a>
                <a href="{{ route('dosen.classes.show', $class) }}" class="size-9 flex items-center justify-center rounded-xl ring-1 ring-border hover:ring-primary hover:bg-primary/10 transition-all duration-300">
                    <i data-lucide="eye" class="size-4 text-secondary hover:text-primary"></i>
                </a>
            </div>
        </div>
    </div>
    @empty
    <div class="col-span-full flex flex-col items-center justify-center py-16 text-secondary">
        <i data-lucide="book-open" class="size-16 mb-4 opacity-50"></i>
        <p class="text-lg font-medium mb-2">No classes yet</p>
        <p class="text-sm mb-4">Create your first class</p>
        <a href="{{ route('dosen.classes.create') }}" class="px-6 py-3 bg-primary text-white rounded-full font-semibold hover:bg-primary-hover transition-all duration-300">
            Add New Class
        </a>
    </div>
    @endforelse
</div>
@endsection
