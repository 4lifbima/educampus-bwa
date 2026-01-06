@extends('layouts.dashboard')

@section('title', 'Schedule')
@section('page-title', 'My Schedule')

@push('styles')
<style>
    .time-slot {
        min-height: 80px;
        border: 1px solid #F3F4F3;
    }
    .class-block {
        min-height: 76px;
        border-radius: 8px;
        padding: 8px;
        margin: 2px 0;
        cursor: pointer;
        transition: all 0.2s;
    }
    .class-block:hover {
        transform: translateY(-1px);
        box-shadow: 0 4px 12px rgba(0,0,0,0.1);
    }
</style>
@endpush

@section('content')
<div class="flex flex-col md:flex-row md:items-center md:justify-between gap-4 mb-6 md:mb-8">
    <div>
        <h1 class="text-foreground text-2xl md:text-3xl font-bold mb-1">My Schedule</h1>
        <p class="text-secondary text-sm md:text-base">Your weekly class timetable</p>
    </div>
    <div class="flex items-center gap-3">
        <a href="{{ route('mahasiswa.enroll.index') }}" class="flex items-center gap-2 px-6 py-3 bg-primary text-white rounded-full font-semibold hover:bg-primary-hover transition-all duration-300 cursor-pointer">
            <i data-lucide="plus" class="w-5 h-5"></i>
            <span>Enroll Course</span>
        </a>
    </div>
</div>

<!-- Statistics -->
<div class="grid grid-cols-2 lg:grid-cols-4 gap-4 mb-6">
    <div class="flex flex-col rounded-2xl border border-border p-4 gap-2 bg-white">
        <div class="flex items-center gap-3">
            <div class="size-10 bg-primary/10 rounded-xl flex items-center justify-center">
                <i data-lucide="book-open" class="size-5 text-primary"></i>
            </div>
            <div>
                <p class="text-2xl font-bold text-foreground">{{ $totalClasses }}</p>
                <p class="text-xs text-secondary">Total Classes</p>
            </div>
        </div>
    </div>
    <div class="flex flex-col rounded-2xl border border-border p-4 gap-2 bg-white">
        <div class="flex items-center gap-3">
            <div class="size-10 bg-success-light rounded-xl flex items-center justify-center">
                <i data-lucide="clock" class="size-5 text-success"></i>
            </div>
            <div>
                <p class="text-2xl font-bold text-foreground">{{ $totalCredits }}</p>
                <p class="text-xs text-secondary">Total SKS</p>
            </div>
        </div>
    </div>
</div>

<!-- Timetable View -->
<div class="flex flex-col rounded-2xl border border-border bg-white overflow-hidden">
    <div class="p-4 border-b border-border flex items-center justify-between">
        <h3 class="font-bold text-lg text-foreground">Weekly Timetable</h3>
        <div class="flex items-center gap-2">
            <span class="flex items-center gap-1 text-xs text-secondary">
                <span class="w-3 h-3 bg-primary/10 border-l-2 border-primary rounded"></span> Your Classes
            </span>
        </div>
    </div>
    
    <div class="overflow-x-auto">
        <div class="min-w-[800px]">
            <!-- Header Days -->
            <div class="grid grid-cols-7 gap-1 bg-muted p-2">
                <div class="p-3 text-center font-semibold text-secondary text-sm">Time</div>
                @foreach(['Monday', 'Tuesday', 'Wednesday', 'Thursday', 'Friday', 'Saturday'] as $day)
                    <div class="p-3 text-center font-semibold text-foreground text-sm">{{ $day }}</div>
                @endforeach
            </div>
            
            <!-- Time Slots -->
            <div class="space-y-0" id="timetableGrid">
                @php
                    $timeSlots = ['07:00', '08:00', '09:00', '10:00', '11:00', '12:00', '13:00', '14:00', '15:00', '16:00', '17:00'];
                    $days = ['Monday', 'Tuesday', 'Wednesday', 'Thursday', 'Friday', 'Saturday'];
                    $colors = [
                        'primary' => ['bg' => 'bg-primary/10', 'border' => 'border-primary', 'text' => 'text-primary'],
                        'success' => ['bg' => 'bg-success/10', 'border' => 'border-success', 'text' => 'text-success'],
                        'warning' => ['bg' => 'bg-warning/10', 'border' => 'border-warning', 'text' => 'text-warning-dark'],
                        'info' => ['bg' => 'bg-info/10', 'border' => 'border-info', 'text' => 'text-info'],
                        'error' => ['bg' => 'bg-error/10', 'border' => 'border-error', 'text' => 'text-error'],
                    ];
                    $colorKeys = array_keys($colors);
                @endphp
                
                @foreach($timeSlots as $index => $time)
                <div class="grid grid-cols-7 gap-1">
                    <!-- Time Column -->
                    <div class="time-slot flex items-center justify-center bg-muted text-secondary font-medium text-sm">
                        {{ \Carbon\Carbon::parse($time)->format('g:i A') }}
                    </div>
                    
                    <!-- Day Columns -->
                    @foreach($days as $day)
                        <div class="time-slot bg-white relative p-1">
                            @php
                                // Find classes that match this day and start at this time
                                $classesAtSlot = collect();
                                if(isset($scheduleByDayTime[$day])) {
                                    $classesAtSlot = $scheduleByDayTime[$day]->filter(function($class) use ($time) {
                                        if(!$class->schedule_time) return false;
                                        $classHour = \Carbon\Carbon::parse($class->schedule_time)->format('H:00');
                                        return $classHour === $time;
                                    });
                                }
                            @endphp
                            
                            @foreach($classesAtSlot as $classIndex => $class)
                                @php
                                    $colorIndex = crc32($class->code) % count($colorKeys);
                                    $color = $colors[$colorKeys[$colorIndex]];
                                @endphp
                                <div class="class-block {{ $color['bg'] }} border-l-4 {{ $color['border'] }}" onclick="showClassDetail('{{ $class->id }}')">
                                    <div class="text-xs font-bold {{ $color['text'] }} mb-1">{{ $class->code }}</div>
                                    <div class="text-xs text-foreground font-medium truncate">{{ $class->name }}</div>
                                    <div class="text-xs text-secondary">{{ $class->room ?? 'TBD' }}</div>
                                </div>
                            @endforeach
                        </div>
                    @endforeach
                </div>
                @endforeach
            </div>
        </div>
    </div>
</div>

<!-- Class List (Mobile Friendly) -->
<div class="mt-6 flex flex-col rounded-2xl border border-border bg-white overflow-hidden lg:hidden">
    <div class="p-4 border-b border-border">
        <h3 class="font-bold text-lg text-foreground">Class List</h3>
    </div>
    <div class="divide-y divide-border">
        @forelse($allClasses as $class)
        <div class="p-4 hover:bg-muted/50 transition-all duration-300">
            <div class="flex items-start justify-between">
                <div>
                    <h4 class="font-semibold text-foreground">{{ $class->name }}</h4>
                    <p class="text-sm text-secondary">{{ $class->code }}</p>
                </div>
                <span class="px-2 py-1 rounded-full text-xs font-medium bg-primary/10 text-primary">
                    {{ $class->credits }} SKS
                </span>
            </div>
            <div class="mt-2 flex flex-wrap gap-2 text-sm text-secondary">
                <span class="flex items-center gap-1">
                    <i data-lucide="calendar" class="size-3"></i>
                    {{ $class->schedule_day ?? 'TBD' }}
                </span>
                <span class="flex items-center gap-1">
                    <i data-lucide="clock" class="size-3"></i>
                    {{ $class->schedule_time ? \Carbon\Carbon::parse($class->schedule_time)->format('g:i A') : 'TBD' }}
                </span>
                <span class="flex items-center gap-1">
                    <i data-lucide="map-pin" class="size-3"></i>
                    {{ $class->room ?? 'TBD' }}
                </span>
            </div>
            <p class="mt-2 text-sm text-secondary">
                <i data-lucide="user" class="size-3 inline"></i>
                {{ $class->lecturer?->user?->name ?? 'TBA' }}
            </p>
        </div>
        @empty
        <div class="p-8 text-center text-secondary">
            <i data-lucide="calendar" class="size-12 mx-auto mb-2 opacity-50"></i>
            <p>No classes scheduled</p>
        </div>
        @endforelse
    </div>
</div>

<!-- Class Detail Modal -->
<div id="classDetailModal" class="fixed inset-0 bg-black/50 z-50 hidden items-center justify-center p-4">
    <div class="bg-white rounded-2xl max-w-md w-full p-6 shadow-xl">
        <div class="flex items-start justify-between mb-4">
            <div>
                <h3 id="modalClassName" class="text-xl font-bold text-foreground"></h3>
                <p id="modalClassCode" class="text-secondary"></p>
            </div>
            <button onclick="hideClassDetail()" class="size-8 flex items-center justify-center rounded-lg hover:bg-muted transition-all duration-300">
                <i data-lucide="x" class="size-5 text-secondary"></i>
            </button>
        </div>
        <div class="space-y-3">
            <div class="flex items-center gap-3">
                <i data-lucide="user" class="size-5 text-secondary"></i>
                <span id="modalLecturer" class="text-foreground"></span>
            </div>
            <div class="flex items-center gap-3">
                <i data-lucide="calendar" class="size-5 text-secondary"></i>
                <span id="modalSchedule" class="text-foreground"></span>
            </div>
            <div class="flex items-center gap-3">
                <i data-lucide="map-pin" class="size-5 text-secondary"></i>
                <span id="modalRoom" class="text-foreground"></span>
            </div>
            <div class="flex items-center gap-3">
                <i data-lucide="book" class="size-5 text-secondary"></i>
                <span id="modalCredits" class="text-foreground"></span>
            </div>
        </div>
    </div>
</div>

@push('scripts')
<script>
    const classData = @json($allClasses->keyBy('id'));
    
    function showClassDetail(classId) {
        const cls = classData[classId];
        if (!cls) return;
        
        document.getElementById('modalClassName').textContent = cls.name;
        document.getElementById('modalClassCode').textContent = cls.code;
        document.getElementById('modalLecturer').textContent = cls.lecturer?.user?.name || 'TBA';
        document.getElementById('modalSchedule').textContent = (cls.schedule_day || 'TBD') + ' ' + (cls.schedule_time || '');
        document.getElementById('modalRoom').textContent = cls.room || 'TBD';
        document.getElementById('modalCredits').textContent = cls.credits + ' SKS';
        
        document.getElementById('classDetailModal').classList.remove('hidden');
        document.getElementById('classDetailModal').classList.add('flex');
        lucide.createIcons();
    }
    
    function hideClassDetail() {
        document.getElementById('classDetailModal').classList.add('hidden');
        document.getElementById('classDetailModal').classList.remove('flex');
    }
</script>
@endpush
@endsection
