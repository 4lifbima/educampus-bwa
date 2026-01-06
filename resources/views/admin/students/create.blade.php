@extends('layouts.dashboard')

@section('title', 'Add Student')
@section('page-title', 'Add Student')

@section('content')
<!-- Page Header -->
<div class="flex flex-col md:flex-row md:items-center md:justify-between gap-4 mb-6 md:mb-8">
    <div>
        <h1 class="text-foreground text-2xl md:text-3xl font-bold mb-1">Add New Student</h1>
        <p class="text-secondary text-sm md:text-base">Complete the form below to register a new student</p>
    </div>
    <div class="flex items-center gap-2 md:gap-3 ml-auto md:ml-0">
        <a href="{{ route('admin.students.index') }}" class="flex items-center gap-2 px-6 py-3 ring-1 ring-border hover:ring-primary rounded-full text-foreground font-semibold transition-all duration-300 cursor-pointer">
            <i data-lucide="x" class="w-5 h-5"></i>
            <span>Cancel</span>
        </a>
    </div>
</div>

<!-- Form Container -->
<form action="{{ route('admin.students.store') }}" method="POST">
    @csrf
    
    <div class="flex flex-col rounded-2xl border border-border bg-white overflow-hidden">
        <!-- Personal Information -->
        <div class="p-6 md:p-8 border-b border-border">
            <div class="flex items-center gap-3 mb-6">
                <div class="w-12 h-12 bg-primary/10 rounded-xl flex items-center justify-center">
                    <i data-lucide="user" class="w-6 h-6 text-primary"></i>
                </div>
                <div>
                    <h3 class="font-bold text-xl text-foreground">Personal Information</h3>
                    <p class="text-secondary">Enter the student's basic personal details</p>
                </div>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                <div class="space-y-2">
                    <label class="block text-sm font-medium text-foreground">First Name *</label>
                    <input type="text" name="first_name" value="{{ old('first_name') }}" class="w-full px-4 py-3 rounded-2xl ring-1 ring-border focus:ring-2 focus:ring-primary outline-none transition-all duration-300 @error('first_name') ring-error @enderror" placeholder="Enter first name" required>
                    @error('first_name')<span class="text-error text-sm">{{ $message }}</span>@enderror
                </div>
                <div class="space-y-2">
                    <label class="block text-sm font-medium text-foreground">Last Name *</label>
                    <input type="text" name="last_name" value="{{ old('last_name') }}" class="w-full px-4 py-3 rounded-2xl ring-1 ring-border focus:ring-2 focus:ring-primary outline-none transition-all duration-300 @error('last_name') ring-error @enderror" placeholder="Enter last name" required>
                    @error('last_name')<span class="text-error text-sm">{{ $message }}</span>@enderror
                </div>
                <div class="space-y-2">
                    <label class="block text-sm font-medium text-foreground">Email *</label>
                    <input type="email" name="email" value="{{ old('email') }}" class="w-full px-4 py-3 rounded-2xl ring-1 ring-border focus:ring-2 focus:ring-primary outline-none transition-all duration-300 @error('email') ring-error @enderror" placeholder="student@university.edu" required>
                    @error('email')<span class="text-error text-sm">{{ $message }}</span>@enderror
                </div>
                <div class="space-y-2">
                    <label class="block text-sm font-medium text-foreground">Student ID *</label>
                    <input type="text" name="student_id_number" value="{{ old('student_id_number') }}" class="w-full px-4 py-3 rounded-2xl ring-1 ring-border focus:ring-2 focus:ring-primary outline-none transition-all duration-300 @error('student_id_number') ring-error @enderror" placeholder="e.g., STU2024001" required>
                    @error('student_id_number')<span class="text-error text-sm">{{ $message }}</span>@enderror
                </div>
                <div class="space-y-2">
                    <label class="block text-sm font-medium text-foreground">Gender *</label>
                    <select name="gender" class="w-full px-4 py-3 rounded-2xl ring-1 ring-border focus:ring-2 focus:ring-primary outline-none transition-all duration-300" required>
                        <option value="">Select gender</option>
                        <option value="male" {{ old('gender') == 'male' ? 'selected' : '' }}>Male</option>
                        <option value="female" {{ old('gender') == 'female' ? 'selected' : '' }}>Female</option>
                        <option value="other" {{ old('gender') == 'other' ? 'selected' : '' }}>Other</option>
                    </select>
                </div>
                <div class="space-y-2">
                    <label class="block text-sm font-medium text-foreground">Date of Birth *</label>
                    <input type="date" name="birth_date" value="{{ old('birth_date') }}" class="w-full px-4 py-3 rounded-2xl ring-1 ring-border focus:ring-2 focus:ring-primary outline-none transition-all duration-300" required>
                </div>
                <div class="space-y-2">
                    <label class="block text-sm font-medium text-foreground">Phone Number</label>
                    <input type="tel" name="phone" value="{{ old('phone') }}" class="w-full px-4 py-3 rounded-2xl ring-1 ring-border focus:ring-2 focus:ring-primary outline-none transition-all duration-300" placeholder="+62 812 3456 7890">
                </div>
                <div class="space-y-2">
                    <label class="block text-sm font-medium text-foreground">Nationality</label>
                    <input type="text" name="nationality" value="{{ old('nationality') }}" class="w-full px-4 py-3 rounded-2xl ring-1 ring-border focus:ring-2 focus:ring-primary outline-none transition-all duration-300" placeholder="Enter nationality">
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
                    <p class="text-secondary">Enter the student's academic and enrollment details</p>
                </div>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                <div class="space-y-2">
                    <label class="block text-sm font-medium text-foreground">Faculty *</label>
                    <select name="faculty_id" id="faculty_id" class="w-full px-4 py-3 rounded-2xl ring-1 ring-border focus:ring-2 focus:ring-primary outline-none transition-all duration-300" required>
                        <option value="">Select faculty</option>
                        @foreach($faculties as $faculty)
                            <option value="{{ $faculty->id }}" {{ old('faculty_id') == $faculty->id ? 'selected' : '' }}>{{ $faculty->name }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="space-y-2">
                    <label class="block text-sm font-medium text-foreground">Major *</label>
                    <select name="major_id" id="major_id" class="w-full px-4 py-3 rounded-2xl ring-1 ring-border focus:ring-2 focus:ring-primary outline-none transition-all duration-300" required>
                        <option value="">Select major</option>
                        @foreach($faculties as $faculty)
                            @foreach($faculty->majors as $major)
                                <option value="{{ $major->id }}" data-faculty="{{ $faculty->id }}" {{ old('major_id') == $major->id ? 'selected' : '' }}>{{ $major->name }}</option>
                            @endforeach
                        @endforeach
                    </select>
                </div>
                <div class="space-y-2">
                    <label class="block text-sm font-medium text-foreground">Academic Year *</label>
                    <select name="year" class="w-full px-4 py-3 rounded-2xl ring-1 ring-border focus:ring-2 focus:ring-primary outline-none transition-all duration-300" required>
                        <option value="">Select year</option>
                        @for($i = 1; $i <= 6; $i++)
                            <option value="{{ $i }}" {{ old('year') == $i ? 'selected' : '' }}>Year {{ $i }}</option>
                        @endfor
                    </select>
                </div>
                <div class="space-y-2">
                    <label class="block text-sm font-medium text-foreground">Enrollment Status</label>
                    <select name="enrollment_status" class="w-full px-4 py-3 rounded-2xl ring-1 ring-border focus:ring-2 focus:ring-primary outline-none transition-all duration-300">
                        <option value="full-time" {{ old('enrollment_status') == 'full-time' ? 'selected' : '' }}>Full-time</option>
                        <option value="part-time" {{ old('enrollment_status') == 'part-time' ? 'selected' : '' }}>Part-time</option>
                        <option value="exchange" {{ old('enrollment_status') == 'exchange' ? 'selected' : '' }}>Exchange Student</option>
                    </select>
                </div>
                <div class="space-y-2">
                    <label class="block text-sm font-medium text-foreground">Enrollment Date</label>
                    <input type="date" name="enrollment_date" value="{{ old('enrollment_date', date('Y-m-d')) }}" class="w-full px-4 py-3 rounded-2xl ring-1 ring-border focus:ring-2 focus:ring-primary outline-none transition-all duration-300">
                </div>
            </div>
        </div>

        <!-- Guardian Information -->
        <div class="p-6 md:p-8 border-b border-border">
            <div class="flex items-center gap-3 mb-6">
                <div class="w-12 h-12 bg-primary/10 rounded-xl flex items-center justify-center">
                    <i data-lucide="phone" class="w-6 h-6 text-primary"></i>
                </div>
                <div>
                    <h3 class="font-bold text-xl text-foreground">Guardian Information</h3>
                    <p class="text-secondary">Enter guardian and emergency contact details</p>
                </div>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                <div class="space-y-2">
                    <label class="block text-sm font-medium text-foreground">Guardian Name</label>
                    <input type="text" name="guardian_name" value="{{ old('guardian_name') }}" class="w-full px-4 py-3 rounded-2xl ring-1 ring-border focus:ring-2 focus:ring-primary outline-none transition-all duration-300" placeholder="Enter guardian name">
                </div>
                <div class="space-y-2">
                    <label class="block text-sm font-medium text-foreground">Relationship</label>
                    <select name="guardian_relationship" class="w-full px-4 py-3 rounded-2xl ring-1 ring-border focus:ring-2 focus:ring-primary outline-none transition-all duration-300">
                        <option value="">Select relationship</option>
                        <option value="father" {{ old('guardian_relationship') == 'father' ? 'selected' : '' }}>Father</option>
                        <option value="mother" {{ old('guardian_relationship') == 'mother' ? 'selected' : '' }}>Mother</option>
                        <option value="guardian" {{ old('guardian_relationship') == 'guardian' ? 'selected' : '' }}>Guardian</option>
                        <option value="other" {{ old('guardian_relationship') == 'other' ? 'selected' : '' }}>Other</option>
                    </select>
                </div>
                <div class="space-y-2">
                    <label class="block text-sm font-medium text-foreground">Guardian Phone</label>
                    <input type="tel" name="guardian_phone" value="{{ old('guardian_phone') }}" class="w-full px-4 py-3 rounded-2xl ring-1 ring-border focus:ring-2 focus:ring-primary outline-none transition-all duration-300" placeholder="+62 812 3456 7890">
                </div>
                <div class="space-y-2">
                    <label class="block text-sm font-medium text-foreground">Guardian Email</label>
                    <input type="email" name="guardian_email" value="{{ old('guardian_email') }}" class="w-full px-4 py-3 rounded-2xl ring-1 ring-border focus:ring-2 focus:ring-primary outline-none transition-all duration-300" placeholder="guardian@email.com">
                </div>
                <div class="space-y-2 md:col-span-2">
                    <label class="block text-sm font-medium text-foreground">Address</label>
                    <textarea name="address" rows="3" class="w-full px-4 py-3 rounded-2xl ring-1 ring-border focus:ring-2 focus:ring-primary outline-none transition-all duration-300" placeholder="Enter full address">{{ old('address') }}</textarea>
                </div>
            </div>
        </div>

        <!-- Submit -->
        <div class="p-6 md:p-8 flex justify-end gap-4">
            <a href="{{ route('admin.students.index') }}" class="px-8 py-3 ring-1 ring-border hover:ring-primary rounded-full text-foreground font-semibold transition-all duration-300 cursor-pointer">
                Cancel
            </a>
            <button type="submit" class="flex items-center gap-2 px-8 py-3 bg-success text-white rounded-full font-semibold hover:bg-success-dark transition-all duration-300 cursor-pointer">
                <i data-lucide="check" class="w-5 h-5"></i>
                <span>Submit</span>
            </button>
        </div>
    </div>
</form>

@push('scripts')
<script>
document.getElementById('faculty_id').addEventListener('change', function() {
    const facultyId = this.value;
    const majorSelect = document.getElementById('major_id');
    const options = majorSelect.querySelectorAll('option[data-faculty]');
    
    options.forEach(option => {
        if (option.dataset.faculty === facultyId || facultyId === '') {
            option.style.display = '';
        } else {
            option.style.display = 'none';
        }
    });
    
    majorSelect.value = '';
});
</script>
@endpush
@endsection
