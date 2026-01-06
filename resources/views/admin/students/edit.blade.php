@extends('layouts.dashboard')

@section('title', 'Edit Student')
@section('page-title', 'Edit Student')

@section('content')
<div class="flex flex-col md:flex-row md:items-center md:justify-between gap-4 mb-6 md:mb-8">
    <div>
        <h1 class="text-foreground text-2xl md:text-3xl font-bold mb-1">Edit Student</h1>
        <p class="text-secondary text-sm md:text-base">Update student information</p>
    </div>
    <a href="{{ route('admin.students.index') }}" class="flex items-center gap-2 px-6 py-3 ring-1 ring-border hover:ring-primary rounded-full text-foreground font-semibold transition-all duration-300 cursor-pointer">
        <i data-lucide="arrow-left" class="w-5 h-5"></i>
        <span>Back</span>
    </a>
</div>

<form action="{{ route('admin.students.update', $student) }}" method="POST">
    @csrf
    @method('PUT')
    
    <div class="flex flex-col rounded-2xl border border-border bg-white overflow-hidden">
        <!-- Personal Information -->
        <div class="p-6 md:p-8 border-b border-border">
            <div class="flex items-center gap-3 mb-6">
                <div class="w-12 h-12 bg-primary/10 rounded-xl flex items-center justify-center">
                    <i data-lucide="user" class="w-6 h-6 text-primary"></i>
                </div>
                <div>
                    <h3 class="font-bold text-xl text-foreground">Personal Information</h3>
                    <p class="text-secondary">Update student's personal details</p>
                </div>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                @php
                    $nameParts = explode(' ', $student->user->name, 2);
                    $firstName = $nameParts[0] ?? '';
                    $lastName = $nameParts[1] ?? '';
                @endphp
                <div class="space-y-2">
                    <label class="block text-sm font-medium text-foreground">First Name *</label>
                    <input type="text" name="first_name" value="{{ old('first_name', $firstName) }}" class="w-full px-4 py-3 rounded-2xl ring-1 ring-border focus:ring-2 focus:ring-primary outline-none transition-all duration-300" required>
                </div>
                <div class="space-y-2">
                    <label class="block text-sm font-medium text-foreground">Last Name *</label>
                    <input type="text" name="last_name" value="{{ old('last_name', $lastName) }}" class="w-full px-4 py-3 rounded-2xl ring-1 ring-border focus:ring-2 focus:ring-primary outline-none transition-all duration-300" required>
                </div>
                <div class="space-y-2">
                    <label class="block text-sm font-medium text-foreground">Email *</label>
                    <input type="email" name="email" value="{{ old('email', $student->user->email) }}" class="w-full px-4 py-3 rounded-2xl ring-1 ring-border focus:ring-2 focus:ring-primary outline-none transition-all duration-300" required>
                </div>
                <div class="space-y-2">
                    <label class="block text-sm font-medium text-foreground">Phone</label>
                    <input type="tel" name="phone" value="{{ old('phone', $student->user->phone) }}" class="w-full px-4 py-3 rounded-2xl ring-1 ring-border focus:ring-2 focus:ring-primary outline-none transition-all duration-300">
                </div>
                <div class="space-y-2">
                    <label class="block text-sm font-medium text-foreground">Gender</label>
                    <select name="gender" class="w-full px-4 py-3 rounded-2xl ring-1 ring-border focus:ring-2 focus:ring-primary outline-none transition-all duration-300">
                        <option value="male" {{ $student->gender == 'male' ? 'selected' : '' }}>Male</option>
                        <option value="female" {{ $student->gender == 'female' ? 'selected' : '' }}>Female</option>
                        <option value="other" {{ $student->gender == 'other' ? 'selected' : '' }}>Other</option>
                    </select>
                </div>
                <div class="space-y-2">
                    <label class="block text-sm font-medium text-foreground">Birth Date</label>
                    <input type="date" name="birth_date" value="{{ old('birth_date', $student->birth_date?->format('Y-m-d')) }}" class="w-full px-4 py-3 rounded-2xl ring-1 ring-border focus:ring-2 focus:ring-primary outline-none transition-all duration-300">
                </div>
            </div>
        </div>

        <!-- Academic Information -->
        <div class="p-6 md:p-8 border-b border-border">
            <div class="flex items-center gap-3 mb-6">
                <div class="w-12 h-12 bg-primary/10 rounded-xl flex items-center justify-center">
                    <i data-lucide="graduation-cap" class="w-6 h-6 text-primary"></i>
                </div>
                <div>
                    <h3 class="font-bold text-xl text-foreground">Academic Information</h3>
                    <p class="text-secondary">Update academic details</p>
                </div>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                <div class="space-y-2">
                    <label class="block text-sm font-medium text-foreground">Faculty *</label>
                    <select name="faculty_id" class="w-full px-4 py-3 rounded-2xl ring-1 ring-border focus:ring-2 focus:ring-primary outline-none transition-all duration-300" required>
                        @foreach($faculties as $faculty)
                            <option value="{{ $faculty->id }}" {{ $student->faculty_id == $faculty->id ? 'selected' : '' }}>{{ $faculty->name }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="space-y-2">
                    <label class="block text-sm font-medium text-foreground">Major *</label>
                    <select name="major_id" class="w-full px-4 py-3 rounded-2xl ring-1 ring-border focus:ring-2 focus:ring-primary outline-none transition-all duration-300" required>
                        @foreach($faculties as $faculty)
                            @foreach($faculty->majors as $major)
                                <option value="{{ $major->id }}" {{ $student->major_id == $major->id ? 'selected' : '' }}>{{ $major->name }}</option>
                            @endforeach
                        @endforeach
                    </select>
                </div>
                <div class="space-y-2">
                    <label class="block text-sm font-medium text-foreground">Year *</label>
                    <select name="year" class="w-full px-4 py-3 rounded-2xl ring-1 ring-border focus:ring-2 focus:ring-primary outline-none transition-all duration-300" required>
                        @for($i = 1; $i <= 6; $i++)
                            <option value="{{ $i }}" {{ $student->year == $i ? 'selected' : '' }}>Year {{ $i }}</option>
                        @endfor
                    </select>
                </div>
                <div class="space-y-2">
                    <label class="block text-sm font-medium text-foreground">Status *</label>
                    <select name="status" class="w-full px-4 py-3 rounded-2xl ring-1 ring-border focus:ring-2 focus:ring-primary outline-none transition-all duration-300" required>
                        <option value="active" {{ $student->status == 'active' ? 'selected' : '' }}>Active</option>
                        <option value="inactive" {{ $student->status == 'inactive' ? 'selected' : '' }}>Inactive</option>
                        <option value="graduated" {{ $student->status == 'graduated' ? 'selected' : '' }}>Graduated</option>
                        <option value="suspended" {{ $student->status == 'suspended' ? 'selected' : '' }}>Suspended</option>
                    </select>
                </div>
                <div class="space-y-2">
                    <label class="block text-sm font-medium text-foreground">Enrollment Status</label>
                    <select name="enrollment_status" class="w-full px-4 py-3 rounded-2xl ring-1 ring-border focus:ring-2 focus:ring-primary outline-none transition-all duration-300">
                        <option value="full-time" {{ $student->enrollment_status == 'full-time' ? 'selected' : '' }}>Full-time</option>
                        <option value="part-time" {{ $student->enrollment_status == 'part-time' ? 'selected' : '' }}>Part-time</option>
                        <option value="exchange" {{ $student->enrollment_status == 'exchange' ? 'selected' : '' }}>Exchange</option>
                    </select>
                </div>
            </div>
        </div>

        <!-- Submit -->
        <div class="p-6 md:p-8 flex justify-end gap-4">
            <a href="{{ route('admin.students.index') }}" class="px-8 py-3 ring-1 ring-border hover:ring-primary rounded-full text-foreground font-semibold transition-all duration-300">Cancel</a>
            <button type="submit" class="flex items-center gap-2 px-8 py-3 bg-primary text-white rounded-full font-semibold hover:bg-primary-hover transition-all duration-300 cursor-pointer">
                <i data-lucide="save" class="w-5 h-5"></i>
                <span>Save Changes</span>
            </button>
        </div>
    </div>
</form>
@endsection
