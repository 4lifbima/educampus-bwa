@extends('layouts.dashboard')

@section('title', 'Students')
@section('page-title', 'Students')

@section('content')
<!-- Page Header -->
<div class="flex flex-col md:flex-row md:items-center md:justify-between gap-4 mb-6 md:mb-8">
    <div>
        <h1 class="text-foreground text-2xl md:text-3xl font-bold mb-1">Student Management</h1>
        <p class="text-secondary text-sm md:text-base">Manage all student records and information</p>
    </div>
    <div class="flex items-center gap-2 md:gap-3">
        <a href="{{ route('admin.students.create') }}" class="flex items-center gap-2 px-6 py-3 bg-primary text-white rounded-full font-semibold hover:bg-primary-hover transition-all duration-300 cursor-pointer">
            <i data-lucide="plus" class="w-5 h-5"></i>
            <span>Add Student</span>
        </a>
    </div>
</div>

<!-- Statistics Cards -->
<div class="grid grid-cols-2 lg:grid-cols-4 gap-4 mb-6">
    <div class="flex flex-col rounded-2xl border border-border p-4 gap-2 bg-white">
        <div class="flex items-center gap-3">
            <div class="size-10 bg-primary/10 rounded-xl flex items-center justify-center">
                <i data-lucide="users" class="size-5 text-primary"></i>
            </div>
            <div>
                <p class="text-2xl font-bold text-foreground">{{ number_format($stats['total']) }}</p>
                <p class="text-xs text-secondary">Total Students</p>
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
                <i data-lucide="pause-circle" class="size-5 text-warning-dark"></i>
            </div>
            <div>
                <p class="text-2xl font-bold text-foreground">{{ number_format($stats['inactive']) }}</p>
                <p class="text-xs text-secondary">Inactive</p>
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
    <form action="{{ route('admin.students.index') }}" method="GET" class="flex flex-col md:flex-row gap-4">
        <div class="flex-1">
            <div class="relative">
                <i data-lucide="search" class="absolute left-4 top-1/2 -translate-y-1/2 size-5 text-secondary"></i>
                <input type="text" name="search" value="{{ request('search') }}" placeholder="Search by name, email, or student ID..." class="w-full pl-12 pr-4 py-3 rounded-2xl ring-1 ring-border focus:ring-2 focus:ring-primary outline-none transition-all duration-300">
            </div>
        </div>
        <select name="faculty" class="px-4 py-3 rounded-2xl ring-1 ring-border focus:ring-2 focus:ring-primary outline-none transition-all duration-300">
            <option value="all">All Faculties</option>
            @foreach($faculties as $faculty)
                <option value="{{ $faculty->id }}" {{ request('faculty') == $faculty->id ? 'selected' : '' }}>{{ $faculty->name }}</option>
            @endforeach
        </select>
        <select name="status" class="px-4 py-3 rounded-2xl ring-1 ring-border focus:ring-2 focus:ring-primary outline-none transition-all duration-300">
            <option value="all">All Status</option>
            <option value="active" {{ request('status') == 'active' ? 'selected' : '' }}>Active</option>
            <option value="inactive" {{ request('status') == 'inactive' ? 'selected' : '' }}>Inactive</option>
            <option value="graduated" {{ request('status') == 'graduated' ? 'selected' : '' }}>Graduated</option>
            <option value="suspended" {{ request('status') == 'suspended' ? 'selected' : '' }}>Suspended</option>
        </select>
        <select name="year" class="px-4 py-3 rounded-2xl ring-1 ring-border focus:ring-2 focus:ring-primary outline-none transition-all duration-300">
            <option value="all">All Years</option>
            @for($i = 1; $i <= 6; $i++)
                <option value="{{ $i }}" {{ request('year') == $i ? 'selected' : '' }}>Year {{ $i }}</option>
            @endfor
        </select>
        <button type="submit" class="px-6 py-3 bg-primary text-white rounded-full font-semibold hover:bg-primary-hover transition-all duration-300 cursor-pointer">
            Filter
        </button>
    </form>
</div>

<!-- Students Table -->
<div class="flex flex-col rounded-2xl border border-border bg-white overflow-hidden">
    <div class="overflow-x-auto">
        <table class="w-full">
            <thead class="bg-muted">
                <tr>
                    <th class="px-6 py-4 text-left font-semibold text-secondary text-sm">Student</th>
                    <th class="px-6 py-4 text-left font-semibold text-secondary text-sm">ID Number</th>
                    <th class="px-6 py-4 text-left font-semibold text-secondary text-sm">Faculty</th>
                    <th class="px-6 py-4 text-left font-semibold text-secondary text-sm">Year</th>
                    <th class="px-6 py-4 text-left font-semibold text-secondary text-sm">Status</th>
                    <th class="px-6 py-4 text-right font-semibold text-secondary text-sm">Actions</th>
                </tr>
            </thead>
            <tbody>
                @forelse($students as $student)
                <tr class="border-b border-border last:border-0 hover:bg-muted/50 transition-all duration-300">
                    <td class="px-6 py-4">
                        <div class="flex items-center gap-3">
                            @if($student->user->profile_photo)
                                <img src="{{ asset($student->user->profile_photo) }}" alt="{{ $student->user->name }}" class="size-10 rounded-full object-cover">
                            @elseif($student->avatar)
                                <img src="{{ asset($student->avatar) }}" alt="{{ $student->user->name }}" class="size-10 rounded-full object-cover">
                            @else
                                <div class="size-10 rounded-full bg-primary flex items-center justify-center">
                                    <span class="text-white font-semibold text-sm">{{ substr($student->user->name, 0, 2) }}</span>
                                </div>
                            @endif
                            <div>
                                <p class="font-medium text-foreground">{{ $student->user->name }}</p>
                                <p class="text-xs text-secondary">{{ $student->user->email }}</p>
                            </div>
                        </div>
                    </td>
                    <td class="px-6 py-4 text-secondary">{{ $student->student_id_number }}</td>
                    <td class="px-6 py-4 text-secondary">{{ $student->faculty?->name ?? 'N/A' }}</td>
                    <td class="px-6 py-4 text-secondary">Year {{ $student->year }}</td>
                    <td class="px-6 py-4">
                        <span class="px-3 py-1 rounded-full text-xs font-medium {{ $student->getStatusBadgeClass() }}">
                            {{ ucfirst($student->status) }}
                        </span>
                    </td>
                    <td class="px-6 py-4">
                        <div class="flex items-center justify-end gap-2">
                            <a href="{{ route('admin.students.edit', $student) }}" class="size-9 flex items-center justify-center rounded-xl ring-1 ring-border hover:ring-primary transition-all duration-300 cursor-pointer">
                                <i data-lucide="edit" class="size-4 text-secondary"></i>
                            </a>
                            <form action="{{ route('admin.students.destroy', $student) }}" method="POST" onsubmit="return confirm('Are you sure you want to delete this student?')">
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
                        <i data-lucide="users" class="size-12 mx-auto mb-2 opacity-50"></i>
                        <p>No students found</p>
                        <a href="{{ route('admin.students.create') }}" class="text-primary font-medium hover:underline mt-2 inline-block">Add your first student</a>
                    </td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>
    
    <!-- Pagination -->
    @if($students->hasPages())
    <div class="px-6 py-4 border-t border-border">
        {{ $students->links() }}
    </div>
    @endif
</div>
@endsection
