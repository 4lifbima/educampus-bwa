@extends('layouts.dashboard')

@section('title', 'Edit Class')
@section('page-title', 'Edit Class')

@section('content')
<div class="flex flex-col md:flex-row md:items-center md:justify-between gap-4 mb-6 md:mb-8">
    <div>
        <h1 class="text-foreground text-2xl md:text-3xl font-bold mb-1">Edit Class</h1>
        <p class="text-secondary text-sm md:text-base">Update class information</p>
    </div>
    <a href="{{ route('admin.classes.index') }}" class="flex items-center gap-2 px-6 py-3 ring-1 ring-border hover:ring-primary rounded-full text-foreground font-semibold transition-all duration-300 cursor-pointer">
        <i data-lucide="arrow-left" class="w-5 h-5"></i>
        <span>Back</span>
    </a>
</div>

<form action="{{ route('admin.classes.update', $class) }}" method="POST">
    @csrf
    @method('PUT')
    
    <div class="flex flex-col rounded-2xl border border-border bg-white overflow-hidden">
        <div class="p-6 md:p-8 border-b border-border">
            <div class="flex items-center gap-3 mb-6">
                <div class="w-12 h-12 bg-primary/10 rounded-xl flex items-center justify-center">
                    <i data-lucide="book-open" class="w-6 h-6 text-primary"></i>
                </div>
                <div>
                    <h3 class="font-bold text-xl text-foreground">Class Information</h3>
                    <p class="text-secondary">Update class details</p>
                </div>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                <div class="space-y-2">
                    <label class="block text-sm font-medium text-foreground">Class Code *</label>
                    <input type="text" name="code" value="{{ old('code', $class->code) }}" class="w-full px-4 py-3 rounded-2xl ring-1 ring-border focus:ring-2 focus:ring-primary outline-none transition-all duration-300" required>
                </div>
                <div class="space-y-2">
                    <label class="block text-sm font-medium text-foreground">Class Name *</label>
                    <input type="text" name="name" value="{{ old('name', $class->name) }}" class="w-full px-4 py-3 rounded-2xl ring-1 ring-border focus:ring-2 focus:ring-primary outline-none transition-all duration-300" required>
                </div>
                <div class="space-y-2">
                    <label class="block text-sm font-medium text-foreground">Lecturer</label>
                    <select name="lecturer_id" class="w-full px-4 py-3 rounded-2xl ring-1 ring-border focus:ring-2 focus:ring-primary outline-none transition-all duration-300">
                        <option value="">Select Lecturer</option>
                        @foreach($lecturers as $lecturer)
                            <option value="{{ $lecturer->id }}" {{ $class->lecturer_id == $lecturer->id ? 'selected' : '' }}>{{ $lecturer->user->name }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="space-y-2">
                    <label class="block text-sm font-medium text-foreground">Room *</label>
                    <input type="text" name="room" value="{{ old('room', $class->room) }}" class="w-full px-4 py-3 rounded-2xl ring-1 ring-border focus:ring-2 focus:ring-primary outline-none transition-all duration-300" required>
                </div>
                <div class="space-y-2">
                    <label class="block text-sm font-medium text-foreground">Schedule Day</label>
                    <select name="schedule_day" class="w-full px-4 py-3 rounded-2xl ring-1 ring-border focus:ring-2 focus:ring-primary outline-none transition-all duration-300">
                        <option value="">Select Day</option>
                        @foreach(['Monday', 'Tuesday', 'Wednesday', 'Thursday', 'Friday', 'Saturday'] as $day)
                            <option value="{{ $day }}" {{ $class->schedule_day == $day ? 'selected' : '' }}>{{ $day }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="space-y-2">
                    <label class="block text-sm font-medium text-foreground">Schedule Time</label>
                    <input type="time" name="schedule_time" value="{{ old('schedule_time', $class->schedule_time) }}" class="w-full px-4 py-3 rounded-2xl ring-1 ring-border focus:ring-2 focus:ring-primary outline-none transition-all duration-300">
                </div>
                <div class="space-y-2">
                    <label class="block text-sm font-medium text-foreground">Capacity</label>
                    <input type="number" name="capacity" value="{{ old('capacity', $class->capacity) }}" min="1" class="w-full px-4 py-3 rounded-2xl ring-1 ring-border focus:ring-2 focus:ring-primary outline-none transition-all duration-300">
                </div>
                <div class="space-y-2">
                    <label class="block text-sm font-medium text-foreground">Credits (SKS)</label>
                    <input type="number" name="credits" value="{{ old('credits', $class->credits) }}" min="1" max="6" class="w-full px-4 py-3 rounded-2xl ring-1 ring-border focus:ring-2 focus:ring-primary outline-none transition-all duration-300">
                </div>
                <div class="space-y-2">
                    <label class="block text-sm font-medium text-foreground">Status *</label>
                    <select name="status" class="w-full px-4 py-3 rounded-2xl ring-1 ring-border focus:ring-2 focus:ring-primary outline-none transition-all duration-300" required>
                        <option value="active" {{ $class->status == 'active' ? 'selected' : '' }}>Active</option>
                        <option value="cancelled" {{ $class->status == 'cancelled' ? 'selected' : '' }}>Cancelled</option>
                        <option value="completed" {{ $class->status == 'completed' ? 'selected' : '' }}>Completed</option>
                    </select>
                </div>
                <div class="space-y-2 md:col-span-2">
                    <label class="block text-sm font-medium text-foreground">Description</label>
                    <textarea name="description" rows="3" class="w-full px-4 py-3 rounded-2xl ring-1 ring-border focus:ring-2 focus:ring-primary outline-none transition-all duration-300">{{ old('description', $class->description) }}</textarea>
                </div>
            </div>
        </div>

        <div class="p-6 md:p-8 flex justify-end gap-4">
            <a href="{{ route('admin.classes.index') }}" class="px-8 py-3 ring-1 ring-border hover:ring-primary rounded-full text-foreground font-semibold transition-all duration-300">Cancel</a>
            <button type="submit" class="flex items-center gap-2 px-8 py-3 bg-primary text-white rounded-full font-semibold hover:bg-primary-hover transition-all duration-300 cursor-pointer">
                <i data-lucide="save" class="w-5 h-5"></i>
                <span>Save Changes</span>
            </button>
        </div>
    </div>
</form>
@endsection
