@extends('layouts.dashboard')

@section('title', 'Lecturers')
@section('page-title', 'Lecturers')

@section('content')
<!-- Page Header -->
<div class="flex flex-col md:flex-row md:items-center md:justify-between gap-4 mb-6 md:mb-8">
    <div>
        <h1 class="text-foreground text-2xl md:text-3xl font-bold mb-1">Lecturer Management</h1>
        <p class="text-secondary text-sm md:text-base">Manage all lecturer records and information</p>
    </div>
    <div class="flex items-center gap-2 md:gap-3">
        <a href="{{ route('admin.lecturers.create') }}" class="flex items-center gap-2 px-6 py-3 bg-primary text-white rounded-full font-semibold hover:bg-primary-hover transition-all duration-300 cursor-pointer">
            <i data-lucide="plus" class="w-5 h-5"></i>
            <span>Add Lecturer</span>
        </a>
    </div>
</div>

<!-- Statistics Cards -->
<div class="grid grid-cols-2 lg:grid-cols-4 gap-4 mb-6">
    <div class="flex flex-col rounded-2xl border border-border p-4 gap-2 bg-white">
        <div class="flex items-center gap-3">
            <div class="size-10 bg-primary/10 rounded-xl flex items-center justify-center">
                <i data-lucide="user-check" class="size-5 text-primary"></i>
            </div>
            <div>
                <p class="text-2xl font-bold text-foreground">{{ number_format($stats['total']) }}</p>
                <p class="text-xs text-secondary">Total Lecturers</p>
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
                <i data-lucide="clock" class="size-5 text-warning-dark"></i>
            </div>
            <div>
                <p class="text-2xl font-bold text-foreground">{{ number_format($stats['on_leave']) }}</p>
                <p class="text-xs text-secondary">On Leave</p>
            </div>
        </div>
    </div>
    <div class="flex flex-col rounded-2xl border border-border p-4 gap-2 bg-white">
        <div class="flex items-center gap-3">
            <div class="size-10 bg-info-light rounded-xl flex items-center justify-center">
                <i data-lucide="trending-up" class="size-5 text-info"></i>
            </div>
            <div>
                <p class="text-2xl font-bold text-foreground">{{ number_format($stats['new_this_month']) }}</p>
                <p class="text-xs text-secondary">New This Month</p>
            </div>
        </div>
    </div>
</div>

<!-- Filters -->
<div class="flex flex-col rounded-2xl border border-border p-4 gap-4 bg-white mb-6">
    <form action="{{ route('admin.lecturers.index') }}" method="GET" class="flex flex-col md:flex-row gap-4">
        <div class="flex-1">
            <div class="relative">
                <i data-lucide="search" class="absolute left-4 top-1/2 -translate-y-1/2 size-5 text-secondary"></i>
                <input type="text" name="search" value="{{ request('search') }}" placeholder="Search by name, email, or department..." class="w-full pl-12 pr-4 py-3 rounded-2xl ring-1 ring-border focus:ring-2 focus:ring-primary outline-none transition-all duration-300">
            </div>
        </div>
        <select name="department" class="px-4 py-3 rounded-2xl ring-1 ring-border focus:ring-2 focus:ring-primary outline-none transition-all duration-300">
            <option value="all">All Departments</option>
            @foreach($departments as $dept)
                <option value="{{ $dept }}" {{ request('department') == $dept ? 'selected' : '' }}>{{ $dept }}</option>
            @endforeach
        </select>
        <select name="status" class="px-4 py-3 rounded-2xl ring-1 ring-border focus:ring-2 focus:ring-primary outline-none transition-all duration-300">
            <option value="all">All Status</option>
            <option value="active" {{ request('status') == 'active' ? 'selected' : '' }}>Active</option>
            <option value="on_leave" {{ request('status') == 'on_leave' ? 'selected' : '' }}>On Leave</option>
            <option value="inactive" {{ request('status') == 'inactive' ? 'selected' : '' }}>Inactive</option>
        </select>
        <button type="submit" class="px-6 py-3 bg-primary text-white rounded-full font-semibold hover:bg-primary-hover transition-all duration-300 cursor-pointer">
            Filter
        </button>
    </form>
</div>

<!-- Lecturers Table -->
<div class="flex flex-col rounded-2xl border border-border bg-white overflow-hidden">
    <div class="overflow-x-auto">
        <table class="w-full">
            <thead class="bg-muted">
                <tr>
                    <th class="px-6 py-4 text-left font-semibold text-secondary text-sm">Lecturer</th>
                    <th class="px-6 py-4 text-left font-semibold text-secondary text-sm">ID Number</th>
                    <th class="px-6 py-4 text-left font-semibold text-secondary text-sm">Department</th>
                    <th class="px-6 py-4 text-left font-semibold text-secondary text-sm">Experience</th>
                    <th class="px-6 py-4 text-left font-semibold text-secondary text-sm">Status</th>
                    <th class="px-6 py-4 text-right font-semibold text-secondary text-sm">Actions</th>
                </tr>
            </thead>
            <tbody>
                @forelse($lecturers as $lecturer)
                <tr class="border-b border-border last:border-0 hover:bg-muted/50 transition-all duration-300">
                    <td class="px-6 py-4">
                        <div class="flex items-center gap-3">
                            @if($lecturer->user->profile_photo)
                                <img src="{{ asset($lecturer->user->profile_photo) }}" alt="{{ $lecturer->user->name }}" class="size-10 rounded-full object-cover">
                            @elseif($lecturer->avatar)
                                <img src="{{ asset($lecturer->avatar) }}" alt="{{ $lecturer->user->name }}" class="size-10 rounded-full object-cover">
                            @else
                                <div class="size-10 rounded-full bg-success flex items-center justify-center">
                                    <span class="text-white font-semibold text-sm">{{ substr($lecturer->user->name, 0, 2) }}</span>
                                </div>
                            @endif
                            <div>
                                <p class="font-medium text-foreground">{{ $lecturer->user->name }}</p>
                                <p class="text-xs text-secondary">{{ $lecturer->user->email }}</p>
                            </div>
                        </div>
                    </td>
                    <td class="px-6 py-4 text-secondary">{{ $lecturer->lecturer_id_number }}</td>
                    <td class="px-6 py-4 text-secondary">{{ $lecturer->department }}</td>
                    <td class="px-6 py-4 text-secondary">{{ $lecturer->experience_years }} years</td>
                    <td class="px-6 py-4">
                        <span class="px-3 py-1 rounded-full text-xs font-medium {{ $lecturer->getStatusBadgeClass() }}">
                            {{ $lecturer->getFormattedStatus() }}
                        </span>
                    </td>
                    <td class="px-6 py-4">
                        <div class="flex items-center justify-end gap-2">
                            <a href="{{ route('admin.lecturers.edit', $lecturer) }}" class="size-9 flex items-center justify-center rounded-xl ring-1 ring-border hover:ring-primary transition-all duration-300 cursor-pointer">
                                <i data-lucide="edit" class="size-4 text-secondary"></i>
                            </a>
                            <form action="{{ route('admin.lecturers.destroy', $lecturer) }}" method="POST" onsubmit="return confirm('Are you sure?')">
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
                    <td colspan="6" class="px-6 py-12 text-center text-secondary">
                        <i data-lucide="user-check" class="size-12 mx-auto mb-2 opacity-50"></i>
                        <p>No lecturers found</p>
                    </td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>
    
    @if($lecturers->hasPages())
    <div class="px-6 py-4 border-t border-border">
        {{ $lecturers->links() }}
    </div>
    @endif
</div>
@endsection
