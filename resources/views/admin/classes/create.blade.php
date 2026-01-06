@extends('layouts.dashboard')

@section('title', 'Add Class')
@section('page-title', 'Add Class')

@section('content')
<div class="flex flex-col md:flex-row md:items-center md:justify-between gap-4 mb-6 md:mb-8">
    <div>
        <h1 class="text-foreground text-2xl md:text-3xl font-bold mb-1">Add New Class</h1>
        <p class="text-secondary text-sm md:text-base">Create a new class session</p>
    </div>
    <a href="{{ route('admin.classes.index') }}" class="flex items-center gap-2 px-6 py-3 ring-1 ring-border hover:ring-primary rounded-full text-foreground font-semibold transition-all duration-300 cursor-pointer">
        <i data-lucide="x" class="w-5 h-5"></i>
        <span>Cancel</span>
    </a>
</div>

<form action="{{ route('admin.classes.store') }}" method="POST">
    @csrf
    
    <div class="flex flex-col rounded-2xl border border-border bg-white overflow-hidden">
        <div class="p-6 md:p-8 border-b border-border">
            <div class="flex items-center gap-3 mb-6">
                <div class="w-12 h-12 bg-primary/10 rounded-xl flex items-center justify-center">
                    <i data-lucide="book-open" class="w-6 h-6 text-primary"></i>
                </div>
                <div>
                    <h3 class="font-bold text-xl text-foreground">Class Information</h3>
                    <p class="text-secondary">Enter class details and schedule</p>
                </div>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                <div class="space-y-2">
                    <label class="block text-sm font-medium text-foreground">Class Code *</label>
                    <input type="text" name="code" value="{{ old('code') }}" class="w-full px-4 py-3 rounded-2xl ring-1 ring-border focus:ring-2 focus:ring-primary outline-none transition-all duration-300" placeholder="CS101" required>
                </div>
                <div class="space-y-2">
                    <label class="block text-sm font-medium text-foreground">Class Name *</label>
                    <input type="text" name="name" value="{{ old('name') }}" class="w-full px-4 py-3 rounded-2xl ring-1 ring-border focus:ring-2 focus:ring-primary outline-none transition-all duration-300" placeholder="Introduction to Computer Science" required>
                </div>
                <div class="space-y-2">
                    <label class="block text-sm font-medium text-foreground">Lecturer</label>
                    <select name="lecturer_id" class="w-full px-4 py-3 rounded-2xl ring-1 ring-border focus:ring-2 focus:ring-primary outline-none transition-all duration-300">
                        <option value="">Select Lecturer</option>
                        @foreach($lecturers as $lecturer)
                            <option value="{{ $lecturer->id }}">{{ $lecturer->user->name }} ({{ $lecturer->department }})</option>
                        @endforeach
                    </select>
                </div>
                <div class="space-y-2">
                    <label class="block text-sm font-medium text-foreground">Room *</label>
                    <input type="text" name="room" value="{{ old('room') }}" class="w-full px-4 py-3 rounded-2xl ring-1 ring-border focus:ring-2 focus:ring-primary outline-none transition-all duration-300" placeholder="Room A101" required>
                </div>
                <div class="space-y-2">
                    <label class="block text-sm font-medium text-foreground">Schedule Day</label>
                    <select name="schedule_day" class="w-full px-4 py-3 rounded-2xl ring-1 ring-border focus:ring-2 focus:ring-primary outline-none transition-all duration-300">
                        <option value="">Select Day</option>
                        <option value="Monday">Monday</option>
                        <option value="Tuesday">Tuesday</option>
                        <option value="Wednesday">Wednesday</option>
                        <option value="Thursday">Thursday</option>
                        <option value="Friday">Friday</option>
                        <option value="Saturday">Saturday</option>
                    </select>
                </div>
                <div class="space-y-2">
                    <label class="block text-sm font-medium text-foreground">Schedule Time</label>
                    <input type="time" name="schedule_time" value="{{ old('schedule_time') }}" class="w-full px-4 py-3 rounded-2xl ring-1 ring-border focus:ring-2 focus:ring-primary outline-none transition-all duration-300">
                </div>
                <div class="space-y-2">
                    <label class="block text-sm font-medium text-foreground">Capacity</label>
                    <input type="number" name="capacity" value="{{ old('capacity', 30) }}" min="1" class="w-full px-4 py-3 rounded-2xl ring-1 ring-border focus:ring-2 focus:ring-primary outline-none transition-all duration-300">
                </div>
                <div class="space-y-2">
                    <label class="block text-sm font-medium text-foreground">Credits (SKS)</label>
                    <input type="number" name="credits" value="{{ old('credits', 3) }}" min="1" max="6" class="w-full px-4 py-3 rounded-2xl ring-1 ring-border focus:ring-2 focus:ring-primary outline-none transition-all duration-300">
                </div>
                <div class="space-y-2 md:col-span-2">
                    <label class="block text-sm font-medium text-foreground">Description</label>
                    <textarea name="description" rows="3" class="w-full px-4 py-3 rounded-2xl ring-1 ring-border focus:ring-2 focus:ring-primary outline-none transition-all duration-300" placeholder="Class description...">{{ old('description') }}</textarea>
                </div>
            </div>
        </div>

        <div class="p-6 md:p-8 flex justify-end gap-4">
            <a href="{{ route('admin.classes.index') }}" class="px-8 py-3 ring-1 ring-border hover:ring-primary rounded-full text-foreground font-semibold transition-all duration-300">Cancel</a>
            <button type="submit" class="flex items-center gap-2 px-8 py-3 bg-success text-white rounded-full font-semibold hover:bg-success-dark transition-all duration-300 cursor-pointer">
                <i data-lucide="check" class="w-5 h-5"></i>
                <span>Create Class</span>
            </button>
        </div>
    </div>
</form>
@endsection
