@extends('layouts.dashboard')

@section('title', 'Classes')
@section('page-title', 'Classes & Schedules')

@section('content')
<!-- Page Header -->
<div class="flex flex-col md:flex-row md:items-center md:justify-between gap-4 mb-6 md:mb-8">
    <div>
        <h1 class="text-foreground text-2xl md:text-3xl font-bold mb-1">Classes & Schedules</h1>
        <p class="text-secondary text-sm md:text-base">Manage all class sessions and schedules</p>
    </div>
    <div class="flex items-center gap-2 md:gap-3">
        <a href="{{ route('admin.classes.create') }}" class="flex items-center gap-2 px-6 py-3 bg-primary text-white rounded-full font-semibold hover:bg-primary-hover transition-all duration-300 cursor-pointer">
            <i data-lucide="plus" class="w-5 h-5"></i>
            <span>Add Class</span>
        </a>
    </div>
</div>

<!-- Statistics Cards -->
<div class="grid grid-cols-2 lg:grid-cols-4 gap-4 mb-6">
    <div class="flex flex-col rounded-2xl border border-border p-4 gap-2 bg-white">
        <div class="flex items-center gap-3">
            <div class="size-10 bg-primary/10 rounded-xl flex items-center justify-center">
                <i data-lucide="book-open" class="size-5 text-primary"></i>
            </div>
            <div>
                <p class="text-2xl font-bold text-foreground">{{ number_format($stats['total']) }}</p>
                <p class="text-xs text-secondary">Total Classes</p>
            </div>
        </div>
    </div>
    <div class="flex flex-col rounded-2xl border border-border p-4 gap-2 bg-white">
        <div class="flex items-center gap-3">
            <div class="size-10 bg-success-light rounded-xl flex items-center justify-center">
                <i data-lucide="check-circle" class="size-5 text-success"></i>
            </div>
            <div>
                <p class="text-2xl font-bold text-foreground">{{ number_format($stats['active']) }}</p>
                <p class="text-xs text-secondary">Active</p>
            </div>
        </div>
    </div>
    <div class="flex flex-col rounded-2xl border border-border p-4 gap-2 bg-white">
        <div class="flex items-center gap-3">
            <div class="size-10 bg-warning-light rounded-xl flex items-center justify-center">
                <i data-lucide="x-circle" class="size-5 text-warning-dark"></i>
            </div>
            <div>
                <p class="text-2xl font-bold text-foreground">{{ number_format($stats['cancelled']) }}</p>
                <p class="text-xs text-secondary">Cancelled</p>
            </div>
        </div>
    </div>
    <div class="flex flex-col rounded-2xl border border-border p-4 gap-2 bg-white">
        <div class="flex items-center gap-3">
            <div class="size-10 bg-gray-100 rounded-xl flex items-center justify-center">
                <i data-lucide="check-check" class="size-5 text-gray-600"></i>
            </div>
            <div>
                <p class="text-2xl font-bold text-foreground">{{ number_format($stats['completed']) }}</p>
                <p class="text-xs text-secondary">Completed</p>
            </div>
        </div>
    </div>
</div>

<!-- Filters -->
<div class="flex flex-col rounded-2xl border border-border p-4 gap-4 bg-white mb-6">
    <form action="{{ route('admin.classes.index') }}" method="GET" class="flex flex-col md:flex-row gap-4">
        <div class="flex-1">
            <div class="relative">
                <i data-lucide="search" class="absolute left-4 top-1/2 -translate-y-1/2 size-5 text-secondary"></i>
                <input type="text" name="search" value="{{ request('search') }}" placeholder="Search by class code, name, or room..." class="w-full pl-12 pr-4 py-3 rounded-2xl ring-1 ring-border focus:ring-2 focus:ring-primary outline-none transition-all duration-300">
            </div>
        </div>
        <select name="status" class="px-4 py-3 rounded-2xl ring-1 ring-border focus:ring-2 focus:ring-primary outline-none transition-all duration-300">
            <option value="all">All Status</option>
            <option value="active" {{ request('status') == 'active' ? 'selected' : '' }}>Active</option>
            <option value="cancelled" {{ request('status') == 'cancelled' ? 'selected' : '' }}>Cancelled</option>
            <option value="completed" {{ request('status') == 'completed' ? 'selected' : '' }}>Completed</option>
        </select>
        <button type="submit" class="px-6 py-3 bg-primary text-white rounded-full font-semibold hover:bg-primary-hover transition-all duration-300 cursor-pointer">
            Filter
        </button>
    </form>
</div>

<!-- Classes Table -->
<div class="flex flex-col rounded-2xl border border-border bg-white overflow-hidden">
    <div class="overflow-x-auto">
        <table class="w-full">
            <thead class="bg-muted">
                <tr>
                    <th class="px-6 py-4 text-left font-semibold text-secondary text-sm">Class</th>
                    <th class="px-6 py-4 text-left font-semibold text-secondary text-sm">Lecturer</th>
                    <th class="px-6 py-4 text-left font-semibold text-secondary text-sm">Room</th>
                    <th class="px-6 py-4 text-left font-semibold text-secondary text-sm">Schedule</th>
                    <th class="px-6 py-4 text-left font-semibold text-secondary text-sm">Credits</th>
                    <th class="px-6 py-4 text-left font-semibold text-secondary text-sm">Status</th>
                    <th class="px-6 py-4 text-right font-semibold text-secondary text-sm">Actions</th>
                </tr>
            </thead>
            <tbody>
                @forelse($classes as $class)
                <tr class="border-b border-border last:border-0 hover:bg-muted/50 transition-all duration-300">
                    <td class="px-6 py-4">
                        <div>
                            <p class="font-medium text-foreground">{{ $class->name }}</p>
                            <p class="text-xs text-secondary">{{ $class->code }}</p>
                        </div>
                    </td>
                    <td class="px-6 py-4 text-secondary">{{ $class->lecturer?->user?->name ?? 'Not Assigned' }}</td>
                    <td class="px-6 py-4 text-secondary">{{ $class->room ?? 'TBD' }}</td>
                    <td class="px-6 py-4">
                        @if($class->schedule_day && $class->schedule_time)
                            <span class="px-2 py-1 rounded-full text-xs font-medium bg-primary/10 text-primary">
                                {{ $class->schedule_day }} {{ $class->schedule_time }}
                            </span>
                        @else
                            <span class="text-secondary text-sm">Not scheduled</span>
                        @endif
                    </td>
                    <td class="px-6 py-4 text-secondary">{{ $class->credits }} SKS</td>
                    <td class="px-6 py-4">
                        <span class="px-3 py-1 rounded-full text-xs font-medium {{ $class->getStatusBadgeClass() }}">
                            {{ ucfirst($class->status) }}
                        </span>
                    </td>
                    <td class="px-6 py-4">
                        <div class="flex items-center justify-end gap-2">
                            <a href="{{ route('admin.classes.edit', $class) }}" class="size-9 flex items-center justify-center rounded-xl ring-1 ring-border hover:ring-primary transition-all duration-300 cursor-pointer">
                                <i data-lucide="edit" class="size-4 text-secondary"></i>
                            </a>
                            <form action="{{ route('admin.classes.destroy', $class) }}" method="POST" onsubmit="return confirm('Are you sure?')">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="size-9 flex items-center justify-center rounded-xl ring-1 ring-border hover:ring-error transition-all duration-300 cursor-pointer">
                                    <i data-lucide="trash-2" class="size-4 text-secondary hover:text-error"></i>
                                </button>
                            </form>
                        </div>
                    </td>
                </tr>
                @empty
                <tr>
                    <td colspan="7" class="px-6 py-12 text-center text-secondary">
                        <i data-lucide="book-open" class="size-12 mx-auto mb-2 opacity-50"></i>
                        <p>No classes found</p>
                    </td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>
    
    @if($classes->hasPages())
    <div class="px-6 py-4 border-t border-border">
        {{ $classes->links() }}
    </div>
    @endif
</div>
@endsection
