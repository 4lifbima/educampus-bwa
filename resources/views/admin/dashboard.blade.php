@extends('layouts.dashboard')

@section('title', 'Admin Dashboard')
@section('page-title', 'Dashboard')

@section('content')
<!-- Statistics Cards -->
<div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-4 md:gap-6 mb-6 md:mb-8">
    <!-- Total Students -->
    <div class="flex flex-col rounded-2xl border border-border p-5 gap-4 bg-white">
        <div class="flex items-center justify-between">
            <h4 class="font-medium text-secondary">Total Students</h4>
            <div class="size-11 bg-accent-blue rounded-xl flex items-center justify-center">
                <i data-lucide="users" class="size-6 text-primary"></i>
            </div>
        </div>
        <div class="flex flex-col gap-1">
            <h3 class="text-3xl font-bold text-foreground">{{ number_format($stats['total_students']) }}</h3>
            <p class="text-sm">
                <span class="text-success font-medium">+{{ $stats['new_students_this_month'] }}</span>
                <span class="text-secondary">this month</span>
            </p>
        </div>
    </div>

    <!-- Total Lecturers -->
    <div class="flex flex-col rounded-2xl border border-border p-5 gap-4 bg-white">
        <div class="flex items-center justify-between">
            <h4 class="font-medium text-secondary">Total Lecturers</h4>
            <div class="size-11 bg-accent-teal rounded-xl flex items-center justify-center">
                <i data-lucide="user-check" class="size-6 text-info-dark"></i>
            </div>
        </div>
        <div class="flex flex-col gap-1">
            <h3 class="text-3xl font-bold text-foreground">{{ number_format($stats['total_lecturers']) }}</h3>
            <p class="text-sm text-secondary">Active teaching staff</p>
        </div>
    </div>

    <!-- Active Classes -->
    <div class="flex flex-col rounded-2xl border border-border p-5 gap-4 bg-white">
        <div class="flex items-center justify-between">
            <h4 class="font-medium text-secondary">Active Classes</h4>
            <div class="size-11 bg-success-light rounded-xl flex items-center justify-center">
                <i data-lucide="book-open" class="size-6 text-success"></i>
            </div>
        </div>
        <div class="flex flex-col gap-1">
            <h3 class="text-3xl font-bold text-foreground">{{ number_format($stats['active_classes']) }}</h3>
            <p class="text-sm text-secondary">Currently running</p>
        </div>
    </div>

    <!-- Today's Attendance -->
    <div class="flex flex-col rounded-2xl border border-border p-5 gap-4 bg-white">
        <div class="flex items-center justify-between">
            <h4 class="font-medium text-secondary">Today's Attendance</h4>
            <div class="size-11 bg-warning-light rounded-xl flex items-center justify-center">
                <i data-lucide="calendar-check" class="size-6 text-warning-dark"></i>
            </div>
        </div>
        <div class="flex flex-col gap-1">
            <h3 class="text-3xl font-bold text-foreground">{{ $stats['today_attendance_percentage'] }}%</h3>
            <p class="text-sm text-secondary">Present today</p>
        </div>
    </div>
</div>

<!-- Quick Actions and Recent Activity -->
<div class="grid grid-cols-1 lg:grid-cols-2 gap-6 mb-6">
    <!-- Quick Actions -->
    <div class="flex flex-col rounded-2xl border border-border p-6 gap-4 bg-white">
        <h3 class="font-bold text-xl text-foreground">Quick Actions</h3>
        <div class="grid grid-cols-2 gap-3">
            <a href="{{ route('admin.students.create') }}" class="flex flex-col items-center gap-2 p-4 rounded-xl bg-muted hover:bg-primary/10 transition-all duration-300 cursor-pointer">
                <div class="size-12 bg-primary rounded-xl flex items-center justify-center">
                    <i data-lucide="user-plus" class="size-6 text-white"></i>
                </div>
                <span class="font-medium text-sm text-foreground text-center">Add Student</span>
            </a>
            <a href="{{ route('admin.lecturers.create') }}" class="flex flex-col items-center gap-2 p-4 rounded-xl bg-muted hover:bg-primary/10 transition-all duration-300 cursor-pointer">
                <div class="size-12 bg-success rounded-xl flex items-center justify-center">
                    <i data-lucide="user-check" class="size-6 text-white"></i>
                </div>
                <span class="font-medium text-sm text-foreground text-center">Add Lecturer</span>
            </a>
            <a href="{{ route('admin.classes.create') }}" class="flex flex-col items-center gap-2 p-4 rounded-xl bg-muted hover:bg-primary/10 transition-all duration-300 cursor-pointer">
                <div class="size-12 bg-warning rounded-xl flex items-center justify-center">
                    <i data-lucide="book-open" class="size-6 text-white"></i>
                </div>
                <span class="font-medium text-sm text-foreground text-center">Add Class</span>
            </a>
            <a href="{{ route('admin.students.index') }}" class="flex flex-col items-center gap-2 p-4 rounded-xl bg-muted hover:bg-primary/10 transition-all duration-300 cursor-pointer">
                <div class="size-12 bg-info rounded-xl flex items-center justify-center">
                    <i data-lucide="bar-chart-3" class="size-6 text-white"></i>
                </div>
                <span class="font-medium text-sm text-foreground text-center">View Reports</span>
            </a>
        </div>
    </div>

    <!-- Recent Activity -->
    <div class="flex flex-col rounded-2xl border border-border p-6 gap-4 bg-white">
        <div class="flex items-center justify-between">
            <h3 class="font-bold text-xl text-foreground">Recent Activity</h3>
            <a href="#" class="text-primary text-sm font-medium hover:underline">View All</a>
        </div>
        <div class="flex flex-col gap-3">
            @forelse($recentActivities as $activity)
            <div class="flex items-center gap-3 p-3 rounded-xl bg-muted/50">
                <div class="size-10 bg-primary/10 rounded-xl flex items-center justify-center flex-shrink-0">
                    <i data-lucide="user-plus" class="size-5 text-primary"></i>
                </div>
                <div class="flex-1 min-w-0">
                    <p class="font-medium text-foreground text-sm truncate">{{ $activity['title'] }}</p>
                    <p class="text-xs text-secondary">{{ $activity['time'] }}</p>
                </div>
                <span class="px-2 py-1 rounded-full text-xs font-medium {{ $activity['status_class'] }}">{{ $activity['status'] }}</span>
            </div>
            @empty
            <div class="text-center py-8 text-secondary">
                <i data-lucide="inbox" class="size-12 mx-auto mb-2 opacity-50"></i>
                <p>No recent activity</p>
            </div>
            @endforelse
        </div>
    </div>
</div>

<!-- Upcoming Schedules -->
<div class="flex flex-col rounded-2xl border border-border p-6 gap-4 bg-white">
    <div class="flex items-center justify-between">
        <h3 class="font-bold text-xl text-foreground">Upcoming Schedules</h3>
        <a href="{{ route('admin.classes.index') }}" class="text-primary text-sm font-medium hover:underline">View All</a>
    </div>
    <div class="overflow-x-auto">
        <table class="w-full">
            <thead>
                <tr class="text-left border-b border-border">
                    <th class="pb-3 font-semibold text-secondary text-sm">Class</th>
                    <th class="pb-3 font-semibold text-secondary text-sm">Lecturer</th>
                    <th class="pb-3 font-semibold text-secondary text-sm">Room</th>
                    <th class="pb-3 font-semibold text-secondary text-sm">Schedule</th>
                </tr>
            </thead>
            <tbody>
                @forelse($upcomingSchedules as $schedule)
                <tr class="border-b border-border last:border-0">
                    <td class="py-3">
                        <p class="font-medium text-foreground">{{ $schedule->name }}</p>
                        <p class="text-xs text-secondary">{{ $schedule->code }}</p>
                    </td>
                    <td class="py-3 text-secondary">{{ $schedule->lecturer?->user?->name ?? 'N/A' }}</td>
                    <td class="py-3 text-secondary">{{ $schedule->room ?? 'TBD' }}</td>
                    <td class="py-3">
                        <span class="px-2 py-1 rounded-full text-xs font-medium bg-primary/10 text-primary">
                            {{ $schedule->schedule_day }} {{ $schedule->schedule_time }}
                        </span>
                    </td>
                </tr>
                @empty
                <tr>
                    <td colspan="4" class="py-8 text-center text-secondary">No upcoming schedules</td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>
@endsection
