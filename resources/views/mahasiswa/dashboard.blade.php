@extends('layouts.dashboard')

@section('title', 'Mahasiswa Dashboard')
@section('page-title', 'Dashboard')

@section('content')
<!-- Welcome Section -->
<div class="flex flex-col rounded-2xl border border-border p-6 bg-gradient-to-r from-primary to-primary-hover text-white mb-6">
    <h1 class="text-2xl font-bold mb-2">Selamat Datang, {{ auth()->user()->name }}!</h1>
    <p class="text-white/80">{{ $student->major?->name ?? 'No Major' }} • {{ $student->faculty?->name ?? 'No Faculty' }}</p>
    <div class="flex items-center gap-4 mt-4">
        <div class="flex items-center gap-2">
            <i data-lucide="id-card" class="size-5"></i>
            <span>{{ $student->student_id_number }}</span>
        </div>
        <div class="flex items-center gap-2">
            <i data-lucide="calendar" class="size-5"></i>
            <span>Year {{ $student->year }}</span>
        </div>
    </div>
</div>

<!-- Statistics Cards -->
<div class="grid grid-cols-1 sm:grid-cols-2 gap-4 md:gap-6 mb-6 md:mb-8">
    <div class="flex flex-col rounded-2xl border border-border p-5 gap-4 bg-white">
        <div class="flex items-center justify-between">
            <h4 class="font-medium text-secondary">Enrolled Courses</h4>
            <div class="size-11 bg-primary/10 rounded-xl flex items-center justify-center">
                <i data-lucide="book-open" class="size-6 text-primary"></i>
            </div>
        </div>
        <div class="flex flex-col gap-1">
            <h3 class="text-3xl font-bold text-foreground">{{ $stats['total_courses'] }}</h3>
            <p class="text-sm text-secondary">Active courses</p>
        </div>
    </div>

    <div class="flex flex-col rounded-2xl border border-border p-5 gap-4 bg-white">
        <div class="flex items-center justify-between">
            <h4 class="font-medium text-secondary">Attendance Rate</h4>
            <div class="size-11 bg-success-light rounded-xl flex items-center justify-center">
                <i data-lucide="calendar-check" class="size-6 text-success"></i>
            </div>
        </div>
        <div class="flex flex-col gap-1">
            <h3 class="text-3xl font-bold text-foreground">{{ $stats['attendance_rate'] }}%</h3>
            <p class="text-sm text-secondary">Overall attendance</p>
        </div>
    </div>
</div>

<!-- My Courses -->
<div class="flex flex-col rounded-2xl border border-border p-6 gap-4 bg-white">
    <div class="flex items-center justify-between">
        <h3 class="font-bold text-xl text-foreground">My Courses</h3>
    </div>
    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-4">
        @forelse($enrolledClasses as $class)
        <div class="flex flex-col rounded-xl border border-border p-4 hover:ring-1 hover:ring-primary transition-all duration-300">
            <div class="flex items-start justify-between mb-3">
                <div>
                    <h4 class="font-semibold text-foreground">{{ $class->name }}</h4>
                    <p class="text-sm text-secondary">{{ $class->code }}</p>
                </div>
                <span class="px-2 py-1 rounded-full text-xs font-medium bg-primary/10 text-primary">
                    {{ $class->credits }} SKS
                </span>
            </div>
            <div class="flex items-center gap-2 text-sm text-secondary mb-2">
                <i data-lucide="user" class="size-4"></i>
                <span>{{ $class->lecturer?->user?->name ?? 'TBA' }}</span>
            </div>
            <div class="flex items-center gap-2 text-sm text-secondary mb-2">
                <i data-lucide="map-pin" class="size-4"></i>
                <span>{{ $class->room ?? 'TBD' }}</span>
            </div>
            <div class="flex items-center gap-2 text-sm text-secondary">
                <i data-lucide="clock" class="size-4"></i>
                <span>{{ $class->schedule_day ?? 'TBD' }} {{ $class->schedule_time ?? '' }}</span>
            </div>
        </div>
        @empty
        <div class="col-span-full text-center py-12 text-secondary">
            <i data-lucide="book-open" class="size-12 mx-auto mb-2 opacity-50"></i>
            <p>No courses enrolled yet</p>
        </div>
        @endforelse
    </div>
</div>
@endsection
