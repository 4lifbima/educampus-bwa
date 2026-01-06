@extends('layouts.dashboard')

@section('title', 'Edit Lecturer')
@section('page-title', 'Edit Lecturer')

@section('content')
<div class="flex flex-col md:flex-row md:items-center md:justify-between gap-4 mb-6 md:mb-8">
    <div>
        <h1 class="text-foreground text-2xl md:text-3xl font-bold mb-1">Edit Lecturer</h1>
        <p class="text-secondary text-sm md:text-base">Update lecturer information</p>
    </div>
    <a href="{{ route('admin.lecturers.index') }}" class="flex items-center gap-2 px-6 py-3 ring-1 ring-border hover:ring-primary rounded-full text-foreground font-semibold transition-all duration-300 cursor-pointer">
        <i data-lucide="arrow-left" class="w-5 h-5"></i>
        <span>Back</span>
    </a>
</div>

<form action="{{ route('admin.lecturers.update', $lecturer) }}" method="POST">
    @csrf
    @method('PUT')
    
    <div class="flex flex-col rounded-2xl border border-border bg-white overflow-hidden">
        <div class="p-6 md:p-8 border-b border-border">
            <div class="flex items-center gap-3 mb-6">
                <div class="w-12 h-12 bg-primary/10 rounded-xl flex items-center justify-center">
                    <i data-lucide="user-check" class="w-6 h-6 text-primary"></i>
                </div>
                <div>
                    <h3 class="font-bold text-xl text-foreground">Lecturer Information</h3>
                    <p class="text-secondary">Update lecturer details</p>
                </div>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                <div class="space-y-2">
                    <label class="block text-sm font-medium text-foreground">Full Name *</label>
                    <input type="text" name="name" value="{{ old('name', $lecturer->user->name) }}" class="w-full px-4 py-3 rounded-2xl ring-1 ring-border focus:ring-2 focus:ring-primary outline-none transition-all duration-300" required>
                </div>
                <div class="space-y-2">
                    <label class="block text-sm font-medium text-foreground">Email *</label>
                    <input type="email" name="email" value="{{ old('email', $lecturer->user->email) }}" class="w-full px-4 py-3 rounded-2xl ring-1 ring-border focus:ring-2 focus:ring-primary outline-none transition-all duration-300" required>
                </div>
                <div class="space-y-2">
                    <label class="block text-sm font-medium text-foreground">Department *</label>
                    <input type="text" name="department" value="{{ old('department', $lecturer->department) }}" class="w-full px-4 py-3 rounded-2xl ring-1 ring-border focus:ring-2 focus:ring-primary outline-none transition-all duration-300" required>
                </div>
                <div class="space-y-2">
                    <label class="block text-sm font-medium text-foreground">Phone</label>
                    <input type="tel" name="phone" value="{{ old('phone', $lecturer->user->phone) }}" class="w-full px-4 py-3 rounded-2xl ring-1 ring-border focus:ring-2 focus:ring-primary outline-none transition-all duration-300">
                </div>
                <div class="space-y-2">
                    <label class="block text-sm font-medium text-foreground">Experience (Years)</label>
                    <input type="number" name="experience_years" value="{{ old('experience_years', $lecturer->experience_years) }}" min="0" class="w-full px-4 py-3 rounded-2xl ring-1 ring-border focus:ring-2 focus:ring-primary outline-none transition-all duration-300">
                </div>
                <div class="space-y-2">
                    <label class="block text-sm font-medium text-foreground">Status *</label>
                    <select name="status" class="w-full px-4 py-3 rounded-2xl ring-1 ring-border focus:ring-2 focus:ring-primary outline-none transition-all duration-300" required>
                        <option value="active" {{ $lecturer->status == 'active' ? 'selected' : '' }}>Active</option>
                        <option value="on_leave" {{ $lecturer->status == 'on_leave' ? 'selected' : '' }}>On Leave</option>
                        <option value="inactive" {{ $lecturer->status == 'inactive' ? 'selected' : '' }}>Inactive</option>
                    </select>
                </div>
                <div class="space-y-2">
                    <label class="block text-sm font-medium text-foreground">Specialization</label>
                    <input type="text" name="specialization" value="{{ old('specialization', $lecturer->specialization) }}" class="w-full px-4 py-3 rounded-2xl ring-1 ring-border focus:ring-2 focus:ring-primary outline-none transition-all duration-300">
                </div>
                <div class="space-y-2 md:col-span-2">
                    <label class="block text-sm font-medium text-foreground">Bio</label>
                    <textarea name="bio" rows="3" class="w-full px-4 py-3 rounded-2xl ring-1 ring-border focus:ring-2 focus:ring-primary outline-none transition-all duration-300">{{ old('bio', $lecturer->bio) }}</textarea>
                </div>
            </div>
        </div>

        <div class="p-6 md:p-8 flex justify-end gap-4">
            <a href="{{ route('admin.lecturers.index') }}" class="px-8 py-3 ring-1 ring-border hover:ring-primary rounded-full text-foreground font-semibold transition-all duration-300">Cancel</a>
            <button type="submit" class="flex items-center gap-2 px-8 py-3 bg-primary text-white rounded-full font-semibold hover:bg-primary-hover transition-all duration-300 cursor-pointer">
                <i data-lucide="save" class="w-5 h-5"></i>
                <span>Save Changes</span>
            </button>
        </div>
    </div>
</form>
@endsection
