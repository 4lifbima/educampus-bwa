@extends('layouts.dashboard')

@section('title', 'My Courses')
@section('page-title', 'My Courses')

@section('content')
<div class="flex flex-col md:flex-row md:items-center md:justify-between gap-4 mb-6 md:mb-8">
    <div>
        <h1 class="text-foreground text-2xl md:text-3xl font-bold mb-1">My Courses</h1>
        <p class="text-secondary text-sm md:text-base">View your enrolled courses and their status</p>
    </div>
    <a href="{{ route('mahasiswa.enroll.index') }}" class="flex items-center gap-2 px-6 py-3 bg-primary text-white rounded-full font-semibold hover:bg-primary-hover transition-all duration-300 cursor-pointer">
        <i data-lucide="plus" class="w-5 h-5"></i>
        <span>Enroll New Course</span>
    </a>
</div>

<!-- Course Cards -->
<div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-4">
    @forelse($enrolledCourses as $course)
    <div class="flex flex-col rounded-2xl border border-border p-5 bg-white hover:ring-1 hover:ring-primary transition-all duration-300">
        <div class="flex items-start justify-between mb-4">
            <div>
                <h3 class="font-bold text-lg text-foreground">{{ $course->name }}</h3>
                <p class="text-secondary text-sm">{{ $course->code }}</p>
            </div>
            @php
                $status = $course->pivot->status;
                $statusClass = match($status) {
                    'approved' => 'bg-success-light text-success-dark',
                    'pending' => 'bg-warning-light text-warning-dark',
                    'rejected' => 'bg-error-light text-error-dark',
                    default => 'bg-gray-100 text-gray-600'
                };
            @endphp
            <span class="px-3 py-1 rounded-full text-xs font-medium {{ $statusClass }}">
                {{ ucfirst($status) }}
            </span>
        </div>

        <div class="space-y-2 mb-4">
            <div class="flex items-center gap-2 text-sm text-secondary">
                <i data-lucide="user" class="size-4"></i>
                <span>{{ $course->lecturer?->user?->name ?? 'TBA' }}</span>
            </div>
            <div class="flex items-center gap-2 text-sm text-secondary">
                <i data-lucide="map-pin" class="size-4"></i>
                <span>{{ $course->room ?? 'TBD' }}</span>
            </div>
            <div class="flex items-center gap-2 text-sm text-secondary">
                <i data-lucide="clock" class="size-4"></i>
                <span>{{ $course->schedule_day ?? 'TBD' }} {{ $course->schedule_time ?? '' }}</span>
            </div>
        </div>

        <div class="flex items-center justify-between pt-4 border-t border-border">
            <span class="text-sm font-medium text-primary">{{ $course->credits }} SKS</span>
            @if($course->pivot->grade)
                <span class="text-sm font-bold text-foreground">Grade: {{ $course->pivot->grade }}</span>
            @endif
        </div>

        @if($status === 'pending')
        <form action="{{ route('mahasiswa.enroll.cancel', $course->id) }}" method="POST" class="mt-4">
            @csrf
            @method('DELETE')
            <button type="submit" onclick="return confirm('Cancel this enrollment request?')" class="w-full py-2 text-sm text-error ring-1 ring-error rounded-full hover:bg-error hover:text-white transition-all duration-300">
                Cancel Request
            </button>
        </form>
        @endif
    </div>
    @empty
    <div class="col-span-full flex flex-col items-center justify-center py-16 text-secondary">
        <i data-lucide="book-open" class="size-16 mb-4 opacity-50"></i>
        <p class="text-lg font-medium mb-2">No courses enrolled yet</p>
        <p class="text-sm mb-4">Start by enrolling in a course</p>
        <a href="{{ route('mahasiswa.enroll.index') }}" class="px-6 py-3 bg-primary text-white rounded-full font-semibold hover:bg-primary-hover transition-all duration-300">
            Browse Available Courses
        </a>
    </div>
    @endforelse
</div>
@endsection
