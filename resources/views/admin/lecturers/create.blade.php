@extends('layouts.dashboard')

@section('title', 'Add Lecturer')
@section('page-title', 'Add Lecturer')

@section('content')
<div class="flex flex-col md:flex-row md:items-center md:justify-between gap-4 mb-6 md:mb-8">
    <div>
        <h1 class="text-foreground text-2xl md:text-3xl font-bold mb-1">Add New Lecturer</h1>
        <p class="text-secondary text-sm md:text-base">Register a new lecturer to the system</p>
    </div>
    <a href="{{ route('admin.lecturers.index') }}" class="flex items-center gap-2 px-6 py-3 ring-1 ring-border hover:ring-primary rounded-full text-foreground font-semibold transition-all duration-300 cursor-pointer">
        <i data-lucide="x" class="w-5 h-5"></i>
        <span>Cancel</span>
    </a>
</div>

<form action="{{ route('admin.lecturers.store') }}" method="POST">
    @csrf
    
    <div class="flex flex-col rounded-2xl border border-border bg-white overflow-hidden">
        <div class="p-6 md:p-8 border-b border-border">
            <div class="flex items-center gap-3 mb-6">
                <div class="w-12 h-12 bg-primary/10 rounded-xl flex items-center justify-center">
                    <i data-lucide="user-check" class="w-6 h-6 text-primary"></i>
                </div>
                <div>
                    <h3 class="font-bold text-xl text-foreground">Lecturer Information</h3>
                    <p class="text-secondary">Enter lecturer details</p>
                </div>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                <div class="space-y-2">
                    <label class="block text-sm font-medium text-foreground">Full Name *</label>
                    <input type="text" name="name" value="{{ old('name') }}" class="w-full px-4 py-3 rounded-2xl ring-1 ring-border focus:ring-2 focus:ring-primary outline-none transition-all duration-300" placeholder="Dr. John Doe" required>
                </div>
                <div class="space-y-2">
                    <label class="block text-sm font-medium text-foreground">Email *</label>
                    <input type="email" name="email" value="{{ old('email') }}" class="w-full px-4 py-3 rounded-2xl ring-1 ring-border focus:ring-2 focus:ring-primary outline-none transition-all duration-300" placeholder="lecturer@educampus.com" required>
                </div>
                <div class="space-y-2">
                    <label class="block text-sm font-medium text-foreground">Lecturer ID *</label>
                    <input type="text" name="lecturer_id_number" value="{{ old('lecturer_id_number') }}" class="w-full px-4 py-3 rounded-2xl ring-1 ring-border focus:ring-2 focus:ring-primary outline-none transition-all duration-300" placeholder="LEC-001" required>
                </div>
                <div class="space-y-2">
                    <label class="block text-sm font-medium text-foreground">Department *</label>
                    <input type="text" name="department" value="{{ old('department') }}" class="w-full px-4 py-3 rounded-2xl ring-1 ring-border focus:ring-2 focus:ring-primary outline-none transition-all duration-300" placeholder="Computer Science" required>
                </div>
                <div class="space-y-2">
                    <label class="block text-sm font-medium text-foreground">Phone</label>
                    <input type="tel" name="phone" value="{{ old('phone') }}" class="w-full px-4 py-3 rounded-2xl ring-1 ring-border focus:ring-2 focus:ring-primary outline-none transition-all duration-300" placeholder="+62 812 3456 7890">
                </div>
                <div class="space-y-2">
                    <label class="block text-sm font-medium text-foreground">Experience (Years)</label>
                    <input type="number" name="experience_years" value="{{ old('experience_years', 0) }}" min="0" class="w-full px-4 py-3 rounded-2xl ring-1 ring-border focus:ring-2 focus:ring-primary outline-none transition-all duration-300">
                </div>
                <div class="space-y-2">
                    <label class="block text-sm font-medium text-foreground">Specialization</label>
                    <input type="text" name="specialization" value="{{ old('specialization') }}" class="w-full px-4 py-3 rounded-2xl ring-1 ring-border focus:ring-2 focus:ring-primary outline-none transition-all duration-300" placeholder="Machine Learning">
                </div>
                <div class="space-y-2">
                    <label class="block text-sm font-medium text-foreground">Status</label>
                    <select name="status" class="w-full px-4 py-3 rounded-2xl ring-1 ring-border focus:ring-2 focus:ring-primary outline-none transition-all duration-300">
                        <option value="active">Active</option>
                        <option value="on_leave">On Leave</option>
                        <option value="inactive">Inactive</option>
                    </select>
                </div>
                <div class="space-y-2 md:col-span-2">
                    <label class="block text-sm font-medium text-foreground">Bio</label>
                    <textarea name="bio" rows="3" class="w-full px-4 py-3 rounded-2xl ring-1 ring-border focus:ring-2 focus:ring-primary outline-none transition-all duration-300" placeholder="Brief biography...">{{ old('bio') }}</textarea>
                </div>
            </div>
        </div>

        <div class="p-6 md:p-8 flex justify-end gap-4">
            <a href="{{ route('admin.lecturers.index') }}" class="px-8 py-3 ring-1 ring-border hover:ring-primary rounded-full text-foreground font-semibold transition-all duration-300">Cancel</a>
            <button type="submit" class="flex items-center gap-2 px-8 py-3 bg-success text-white rounded-full font-semibold hover:bg-success-dark transition-all duration-300 cursor-pointer">
                <i data-lucide="check" class="w-5 h-5"></i>
                <span>Submit</span>
            </button>
        </div>
    </div>
</form>
@endsection
