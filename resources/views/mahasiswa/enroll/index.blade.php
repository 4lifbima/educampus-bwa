@extends('layouts.dashboard')

@section('title', 'Enroll Course')
@section('page-title', 'Enroll Course')

@section('content')
<div class="flex flex-col md:flex-row md:items-center md:justify-between gap-4 mb-6 md:mb-8">
    <div>
        <h1 class="text-foreground text-2xl md:text-3xl font-bold mb-1">Available Courses</h1>
        <p class="text-secondary text-sm md:text-base">Browse and enroll in available courses</p>
    </div>
    <a href="{{ route('mahasiswa.courses.index') }}" class="flex items-center gap-2 px-6 py-3 ring-1 ring-border hover:ring-primary rounded-full text-foreground font-semibold transition-all duration-300 cursor-pointer">
        <i data-lucide="arrow-left" class="w-5 h-5"></i>
        <span>My Courses</span>
    </a>
</div>

<!-- Available Course Cards -->
<div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-4">
    @forelse($availableClasses as $class)
    <div class="flex flex-col rounded-2xl border border-border p-5 bg-white hover:ring-1 hover:ring-primary transition-all duration-300">
        <div class="flex items-start justify-between mb-4">
            <div>
                <h3 class="font-bold text-lg text-foreground">{{ $class->name }}</h3>
                <p class="text-secondary text-sm">{{ $class->code }}</p>
            </div>
            <span class="px-3 py-1 rounded-full text-xs font-medium bg-primary/10 text-primary">
                {{ $class->credits }} SKS
            </span>
        </div>

        <div class="space-y-2 mb-4">
            <div class="flex items-center gap-2 text-sm text-secondary">
                <i data-lucide="user" class="size-4"></i>
                <span>{{ $class->lecturer?->user?->name ?? 'TBA' }}</span>
            </div>
            <div class="flex items-center gap-2 text-sm text-secondary">
                <i data-lucide="map-pin" class="size-4"></i>
                <span>{{ $class->room ?? 'TBD' }}</span>
            </div>
            <div class="flex items-center gap-2 text-sm text-secondary">
                <i data-lucide="clock" class="size-4"></i>
                <span>{{ $class->schedule_day ?? 'TBD' }} {{ $class->schedule_time ?? '' }}</span>
            </div>
            <div class="flex items-center gap-2 text-sm text-secondary">
                <i data-lucide="users" class="size-4"></i>
                <span>{{ $class->students_count }}/{{ $class->capacity ?? '∞' }} students</span>
            </div>
        </div>

        @if($class->description)
        <p class="text-sm text-secondary mb-4 line-clamp-2">{{ $class->description }}</p>
        @endif

        <button type="button" 
            onclick="showEnrollModal('{{ $class->id }}', '{{ addslashes($class->name) }}', '{{ $class->code }}', '{{ addslashes($class->lecturer?->user?->name ?? 'TBA') }}', '{{ $class->credits }}')" 
            class="w-full py-3 bg-primary text-white rounded-full font-semibold hover:bg-primary-hover transition-all duration-300 cursor-pointer mt-auto">
            Request Enrollment
        </button>
    </div>
    @empty
    <div class="col-span-full flex flex-col items-center justify-center py-16 text-secondary">
        <i data-lucide="search" class="size-16 mb-4 opacity-50"></i>
        <p class="text-lg font-medium mb-2">No available courses</p>
        <p class="text-sm">All courses are either full or you're already enrolled</p>
    </div>
    @endforelse
</div>

<!-- Enrollment Confirmation Modal -->
<div id="enrollModal" class="fixed inset-0 bg-black/50 z-[100] hidden items-center justify-center p-4 backdrop-blur-sm">
    <div class="bg-white rounded-3xl max-w-md w-full shadow-2xl overflow-hidden transform transition-all duration-300 scale-95" id="enrollModalContent">
        <!-- Modal Header -->
        <div class="bg-gradient-to-r from-primary to-primary-hover p-6">
            <div class="flex items-center gap-4">
                <div class="w-14 h-14 bg-white/20 backdrop-blur rounded-2xl flex items-center justify-center">
                    <i data-lucide="book-plus" class="w-7 h-7 text-white"></i>
                </div>
                <div>
                    <h3 class="text-xl font-bold text-white">Enroll in Course</h3>
                    <p class="text-white/80 text-sm">Confirm your enrollment request</p>
                </div>
            </div>
        </div>
        
        <!-- Modal Body -->
        <div class="p-6">
            <div class="bg-muted rounded-2xl p-4 mb-6">
                <h4 id="modalCourseName" class="font-bold text-lg text-foreground mb-1"></h4>
                <p id="modalCourseCode" class="text-secondary text-sm mb-3"></p>
                <div class="flex flex-wrap gap-3">
                    <span class="flex items-center gap-2 text-sm text-secondary">
                        <i data-lucide="user" class="size-4 text-primary"></i>
                        <span id="modalLecturer"></span>
                    </span>
                    <span class="flex items-center gap-2 text-sm text-secondary">
                        <i data-lucide="book" class="size-4 text-primary"></i>
                        <span id="modalCredits"></span> SKS
                    </span>
                </div>
            </div>
            
            <div class="flex items-start gap-3 p-4 bg-info-light rounded-2xl mb-6">
                <i data-lucide="info" class="size-5 text-info flex-shrink-0 mt-0.5"></i>
                <p class="text-sm text-info-dark">Your enrollment request will be sent to the lecturer for approval. You'll be notified once it's approved.</p>
            </div>

            <!-- Action Buttons -->
            <div class="flex gap-3">
                <button type="button" onclick="hideEnrollModal()" class="flex-1 py-3 px-6 ring-1 ring-border hover:ring-primary rounded-full font-semibold text-foreground transition-all duration-300 cursor-pointer">
                    Cancel
                </button>
                <form id="enrollForm" action="{{ route('mahasiswa.enroll.store') }}" method="POST" class="flex-1">
                    @csrf
                    <input type="hidden" name="class_room_id" id="enrollClassId">
                    <button type="submit" class="w-full py-3 px-6 bg-primary text-white rounded-full font-semibold hover:bg-primary-hover transition-all duration-300 cursor-pointer flex items-center justify-center gap-2">
                        <i data-lucide="check" class="size-5"></i>
                        <span>Confirm</span>
                    </button>
                </form>
            </div>
        </div>
    </div>
</div>

@push('scripts')
<script>
function showEnrollModal(classId, className, classCode, lecturer, credits) {
    document.getElementById('enrollClassId').value = classId;
    document.getElementById('modalCourseName').textContent = className;
    document.getElementById('modalCourseCode').textContent = classCode;
    document.getElementById('modalLecturer').textContent = lecturer;
    document.getElementById('modalCredits').textContent = credits;
    
    const modal = document.getElementById('enrollModal');
    const content = document.getElementById('enrollModalContent');
    
    modal.classList.remove('hidden');
    modal.classList.add('flex');
    
    // Animate in
    setTimeout(() => {
        content.classList.remove('scale-95');
        content.classList.add('scale-100');
    }, 10);
    
    lucide.createIcons();
}

function hideEnrollModal() {
    const modal = document.getElementById('enrollModal');
    const content = document.getElementById('enrollModalContent');
    
    content.classList.remove('scale-100');
    content.classList.add('scale-95');
    
    setTimeout(() => {
        modal.classList.add('hidden');
        modal.classList.remove('flex');
    }, 200);
}

// Close modal when clicking outside
document.getElementById('enrollModal').addEventListener('click', function(e) {
    if (e.target === this) {
        hideEnrollModal();
    }
});

// Close modal with Escape key
document.addEventListener('keydown', function(e) {
    if (e.key === 'Escape') {
        hideEnrollModal();
    }
});
</script>
@endpush
@endsection
