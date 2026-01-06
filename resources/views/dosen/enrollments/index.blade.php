@extends('layouts.dashboard')

@section('title', 'Enrollment Requests')
@section('page-title', 'Enrollment Requests')

@section('content')
<div class="flex flex-col md:flex-row md:items-center md:justify-between gap-4 mb-6 md:mb-8">
    <div>
        <h1 class="text-foreground text-2xl md:text-3xl font-bold mb-1">Enrollment Requests</h1>
        <p class="text-secondary text-sm md:text-base">Approve or reject student enrollment requests</p>
    </div>
</div>

<!-- Stats -->
<div class="flex flex-col rounded-2xl border border-border p-4 bg-white mb-6">
    <div class="flex items-center gap-3">
        <div class="size-10 bg-warning-light rounded-xl flex items-center justify-center">
            <i data-lucide="clock" class="size-5 text-warning-dark"></i>
        </div>
        <div>
            <p class="text-2xl font-bold text-foreground">{{ $pendingRequests->count() }}</p>
            <p class="text-xs text-secondary">Pending Requests</p>
        </div>
    </div>
</div>

<!-- Requests Table -->
<div class="flex flex-col rounded-2xl border border-border bg-white overflow-hidden">
    <div class="overflow-x-auto">
        <table class="w-full">
            <thead class="bg-muted">
                <tr>
                    <th class="px-6 py-4 text-left font-semibold text-secondary text-sm">Student</th>
                    <th class="px-6 py-4 text-left font-semibold text-secondary text-sm">Class</th>
                    <th class="px-6 py-4 text-left font-semibold text-secondary text-sm">Requested At</th>
                    <th class="px-6 py-4 text-right font-semibold text-secondary text-sm">Actions</th>
                </tr>
            </thead>
            <tbody>
                @forelse($pendingRequests as $request)
                <tr class="border-b border-border last:border-0 hover:bg-muted/50 transition-all duration-300">
                    <td class="px-6 py-4">
                        <div class="flex items-center gap-3">
                            <div class="size-10 rounded-full bg-primary flex items-center justify-center">
                                <span class="text-white font-semibold text-sm">{{ substr($request->student_name, 0, 2) }}</span>
                            </div>
                            <div>
                                <p class="font-medium text-foreground">{{ $request->student_name }}</p>
                                <p class="text-xs text-secondary">{{ $request->student_id_number }} • {{ $request->student_email }}</p>
                            </div>
                        </div>
                    </td>
                    <td class="px-6 py-4">
                        <p class="font-medium text-foreground">{{ $request->class_name }}</p>
                        <p class="text-xs text-secondary">{{ $request->class_code }}</p>
                    </td>
                    <td class="px-6 py-4 text-secondary text-sm">
                        {{ \Carbon\Carbon::parse($request->enrolled_at)->diffForHumans() }}
                    </td>
                    <td class="px-6 py-4">
                        <div class="flex items-center justify-end gap-2">
                            <form action="{{ route('dosen.enrollments.approve') }}" method="POST" class="inline">
                                @csrf
                                <input type="hidden" name="student_id" value="{{ $request->student_id }}">
                                <input type="hidden" name="class_room_id" value="{{ $request->class_room_id }}">
                                <button type="submit" class="px-4 py-2 bg-success text-white rounded-full text-sm font-medium hover:bg-success-dark transition-all duration-300 cursor-pointer">
                                    Approve
                                </button>
                            </form>
                            <form action="{{ route('dosen.enrollments.reject') }}" method="POST" class="inline">
                                @csrf
                                <input type="hidden" name="student_id" value="{{ $request->student_id }}">
                                <input type="hidden" name="class_room_id" value="{{ $request->class_room_id }}">
                                <button type="submit" onclick="return confirm('Reject this enrollment?')" class="px-4 py-2 ring-1 ring-error text-error rounded-full text-sm font-medium hover:bg-error hover:text-white transition-all duration-300 cursor-pointer">
                                    Reject
                                </button>
                            </form>
                        </div>
                    </td>
                </tr>
                @empty
                <tr>
                    <td colspan="4" class="px-6 py-12 text-center text-secondary">
                        <i data-lucide="inbox" class="size-12 mx-auto mb-2 opacity-50"></i>
                        <p class="font-medium">No pending requests</p>
                        <p class="text-sm">All enrollment requests have been processed</p>
                    </td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>
@endsection
