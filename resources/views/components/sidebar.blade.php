@php
    $role = auth()->user()->role;
    $currentRoute = request()->route()->getName();
@endphp

<!-- Mobile Close Button (positioned outside sidebar) -->
<button id="sidebar-close-btn" onclick="toggleSidebar()" aria-label="Close sidebar" class="fixed top-5 left-[290px] z-[60] size-11 bg-white rounded-xl p-[10px] items-center justify-center ring-1 ring-border hover:ring-primary transition-all duration-300 cursor-pointer shadow-lg hidden lg:hidden">
    <i data-lucide="x" class="size-6 text-secondary"></i>
</button>

<aside id="sidebar" class="flex flex-col w-[280px] shrink-0 h-screen fixed inset-y-0 left-0 z-50 bg-white border-r border-border transform -translate-x-full lg:translate-x-0 transition-transform duration-300">
    <!-- Top Bar with logo and title -->
    <div class="flex items-center justify-between border-b border-border h-[90px] px-5 gap-3">
        <div class="flex items-center gap-3">
            <div class="w-11 h-9 bg-primary rounded-xl flex items-center justify-center">
                <i data-lucide="graduation-cap" class="w-5 h-5 text-white"></i>
            </div>
            <h1 class="font-semibold text-xl">EduCampus</h1>
        </div>
        <button class="size-11 flex shrink-0 bg-white rounded-xl p-[10px] items-center justify-center ring-1 ring-border hover:ring-primary transition-all duration-300 cursor-pointer" aria-label="Search">
            <i data-lucide="search" class="size-6 text-secondary"></i>
        </button>
    </div>

    <!-- Navigation Menu -->
    <div class="flex flex-col p-5 pb-28 gap-6 overflow-y-auto flex-1">
        <!-- Main Menu Section -->
        <div class="flex flex-col gap-4">
            <h3 class="font-medium text-sm text-secondary">Main Menu</h3>
            <div class="flex flex-col gap-1">
                @if($role === 'admin')
                    <a href="{{ route('admin.dashboard') }}" class="group {{ str_starts_with($currentRoute, 'admin.dashboard') ? 'active' : '' }} cursor-pointer">
                        <div class="flex items-center rounded-xl p-4 gap-3 bg-white group-[.active]:bg-muted group-hover:bg-muted transition-all duration-300">
                            <i data-lucide="layout-dashboard" class="size-6 text-secondary group-[.active]:text-foreground group-hover:text-foreground transition-all duration-300"></i>
                            <span class="font-medium text-secondary group-[.active]:font-semibold group-[.active]:text-foreground group-hover:text-foreground transition-all duration-300">Dashboard</span>
                        </div>
                    </a>
                    <a href="{{ route('admin.students.index') }}" class="group {{ str_starts_with($currentRoute, 'admin.students') ? 'active' : '' }} cursor-pointer">
                        <div class="flex items-center rounded-xl p-4 gap-3 bg-white group-[.active]:bg-muted group-hover:bg-muted transition-all duration-300">
                            <i data-lucide="users" class="size-6 text-secondary group-[.active]:text-foreground group-hover:text-foreground transition-all duration-300"></i>
                            <span class="font-medium text-secondary group-[.active]:font-semibold group-[.active]:text-foreground group-hover:text-foreground transition-all duration-300">Students</span>
                        </div>
                    </a>
                    <a href="{{ route('admin.lecturers.index') }}" class="group {{ str_starts_with($currentRoute, 'admin.lecturers') ? 'active' : '' }} cursor-pointer">
                        <div class="flex items-center rounded-xl p-4 gap-3 bg-white group-[.active]:bg-muted group-hover:bg-muted transition-all duration-300">
                            <i data-lucide="user-check" class="size-6 text-secondary group-[.active]:text-foreground group-hover:text-foreground transition-all duration-300"></i>
                            <span class="font-medium text-secondary group-[.active]:font-semibold group-[.active]:text-foreground group-hover:text-foreground transition-all duration-300">Lecturers</span>
                        </div>
                    </a>
                    <a href="{{ route('admin.classes.index') }}" class="group {{ str_starts_with($currentRoute, 'admin.classes') ? 'active' : '' }} cursor-pointer">
                        <div class="flex items-center rounded-xl p-4 gap-3 bg-white group-[.active]:bg-muted group-hover:bg-muted transition-all duration-300">
                            <i data-lucide="book-open" class="size-6 text-secondary group-[.active]:text-foreground group-hover:text-foreground transition-all duration-300"></i>
                            <span class="font-medium text-secondary group-[.active]:font-semibold group-[.active]:text-foreground group-hover:text-foreground transition-all duration-300">Classes</span>
                        </div>
                    </a>
                @elseif($role === 'dosen')
                    <a href="{{ route('dosen.dashboard') }}" class="group {{ str_starts_with($currentRoute, 'dosen.dashboard') ? 'active' : '' }} cursor-pointer">
                        <div class="flex items-center rounded-xl p-4 gap-3 bg-white group-[.active]:bg-muted group-hover:bg-muted transition-all duration-300">
                            <i data-lucide="layout-dashboard" class="size-6 text-secondary group-[.active]:text-foreground group-hover:text-foreground transition-all duration-300"></i>
                            <span class="font-medium text-secondary group-[.active]:font-semibold group-[.active]:text-foreground group-hover:text-foreground transition-all duration-300">Dashboard</span>
                        </div>
                    </a>
                    <a href="{{ route('dosen.classes.index') }}" class="group {{ str_starts_with($currentRoute, 'dosen.classes') ? 'active' : '' }} cursor-pointer">
                        <div class="flex items-center rounded-xl p-4 gap-3 bg-white group-[.active]:bg-muted group-hover:bg-muted transition-all duration-300">
                            <i data-lucide="book-open" class="size-6 text-secondary group-[.active]:text-foreground group-hover:text-foreground transition-all duration-300"></i>
                            <span class="font-medium text-secondary group-[.active]:font-semibold group-[.active]:text-foreground group-hover:text-foreground transition-all duration-300">My Classes</span>
                        </div>
                    </a>
                    <a href="{{ route('dosen.enrollments.index') }}" class="group {{ str_starts_with($currentRoute, 'dosen.enrollments') ? 'active' : '' }} cursor-pointer">
                        <div class="flex items-center rounded-xl p-4 gap-3 bg-white group-[.active]:bg-muted group-hover:bg-muted transition-all duration-300">
                            <i data-lucide="user-plus" class="size-6 text-secondary group-[.active]:text-foreground group-hover:text-foreground transition-all duration-300"></i>
                            <span class="font-medium text-secondary group-[.active]:font-semibold group-[.active]:text-foreground group-hover:text-foreground transition-all duration-300">Enrollment Requests</span>
                        </div>
                    </a>
                @elseif($role === 'mahasiswa')
                    <a href="{{ route('mahasiswa.dashboard') }}" class="group {{ str_starts_with($currentRoute, 'mahasiswa.dashboard') ? 'active' : '' }} cursor-pointer">
                        <div class="flex items-center rounded-xl p-4 gap-3 bg-white group-[.active]:bg-muted group-hover:bg-muted transition-all duration-300">
                            <i data-lucide="layout-dashboard" class="size-6 text-secondary group-[.active]:text-foreground group-hover:text-foreground transition-all duration-300"></i>
                            <span class="font-medium text-secondary group-[.active]:font-semibold group-[.active]:text-foreground group-hover:text-foreground transition-all duration-300">Dashboard</span>
                        </div>
                    </a>
                    <a href="{{ route('mahasiswa.courses.index') }}" class="group {{ str_starts_with($currentRoute, 'mahasiswa.courses') ? 'active' : '' }} cursor-pointer">
                        <div class="flex items-center rounded-xl p-4 gap-3 bg-white group-[.active]:bg-muted group-hover:bg-muted transition-all duration-300">
                            <i data-lucide="book-open" class="size-6 text-secondary group-[.active]:text-foreground group-hover:text-foreground transition-all duration-300"></i>
                            <span class="font-medium text-secondary group-[.active]:font-semibold group-[.active]:text-foreground group-hover:text-foreground transition-all duration-300">My Courses</span>
                        </div>
                    </a>
                    <a href="{{ route('mahasiswa.enroll.index') }}" class="group {{ str_starts_with($currentRoute, 'mahasiswa.enroll') ? 'active' : '' }} cursor-pointer">
                        <div class="flex items-center rounded-xl p-4 gap-3 bg-white group-[.active]:bg-muted group-hover:bg-muted transition-all duration-300">
                            <i data-lucide="plus-circle" class="size-6 text-secondary group-[.active]:text-foreground group-hover:text-foreground transition-all duration-300"></i>
                            <span class="font-medium text-secondary group-[.active]:font-semibold group-[.active]:text-foreground group-hover:text-foreground transition-all duration-300">Enroll Class</span>
                        </div>
                    </a>
                    <a href="{{ route('mahasiswa.schedule') }}" class="group {{ str_starts_with($currentRoute, 'mahasiswa.schedule') ? 'active' : '' }} cursor-pointer">
                        <div class="flex items-center rounded-xl p-4 gap-3 bg-white group-[.active]:bg-muted group-hover:bg-muted transition-all duration-300">
                            <i data-lucide="calendar" class="size-6 text-secondary group-[.active]:text-foreground group-hover:text-foreground transition-all duration-300"></i>
                            <span class="font-medium text-secondary group-[.active]:font-semibold group-[.active]:text-foreground group-hover:text-foreground transition-all duration-300">Schedule</span>
                        </div>
                    </a>
                @endif
            </div>
        </div>

        <!-- Support Section -->
        <div class="flex flex-col gap-4">
            <h3 class="font-medium text-sm text-secondary">Account</h3>
            <div class="flex flex-col gap-1">
                <a href="{{ route('profile.edit') }}" class="group {{ $currentRoute === 'profile.edit' ? 'active' : '' }} cursor-pointer">
                    <div class="flex items-center rounded-xl p-4 gap-3 bg-white group-[.active]:bg-muted group-hover:bg-muted transition-all duration-300">
                        <i data-lucide="settings" class="size-6 text-secondary group-[.active]:text-foreground group-hover:text-foreground transition-all duration-300"></i>
                        <span class="font-medium text-secondary group-[.active]:font-semibold group-[.active]:text-foreground group-hover:text-foreground transition-all duration-300">Settings</span>
                    </div>
                </a>
                <button type="button" onclick="showLogoutModal()" class="group cursor-pointer w-full text-left">
                    <div class="flex items-center rounded-xl p-4 gap-3 bg-white group-hover:bg-error-light transition-all duration-300">
                        <i data-lucide="log-out" class="size-6 text-secondary group-hover:text-error transition-all duration-300"></i>
                        <span class="font-medium text-secondary group-hover:text-error transition-all duration-300">Logout</span>
                    </div>
                </button>
            </div>
        </div>
    </div>

    <!-- Bottom Help Card -->
    <div class="absolute bottom-0 left-0 w-[280px]">
        <div class="flex items-center justify-between border-t bg-white border-border p-5 gap-3">
            <div class="min-w-0">
                <p class="font-semibold text-foreground">Need help?</p>
                <a href="#" class="cursor-pointer"><span class="text-sm text-secondary hover:text-primary hover:underline transition-all duration-300">Contact support</span></a>
            </div>
            <div class="size-11 bg-primary/10 rounded-xl flex items-center justify-center flex-shrink-0">
                <i data-lucide="message-circle-question" class="size-6 text-primary"></i>
            </div>
        </div>
    </div>
</aside>

<!-- Logout Confirmation Modal -->
<div id="logoutModal" class="fixed inset-0 bg-black/50 z-[100] hidden items-center justify-center p-4">
    <div class="bg-white rounded-2xl max-w-sm w-full p-6 shadow-xl">
        <div class="flex items-center gap-3 mb-4">
            <div class="w-12 h-12 bg-error-light rounded-xl flex items-center justify-center">
                <i data-lucide="log-out" class="w-6 h-6 text-error"></i>
            </div>
            <div>
                <h3 class="text-xl font-bold text-foreground">Logout</h3>
                <p class="text-secondary text-sm">Are you sure you want to leave?</p>
            </div>
        </div>
        <p class="text-secondary mb-6">You will be logged out of your account and redirected to the login page.</p>
        
        <div class="flex justify-end gap-3">
            <button type="button" onclick="hideLogoutModal()" class="px-6 py-3 ring-1 ring-border hover:ring-primary rounded-full font-semibold transition-all duration-300 cursor-pointer">Cancel</button>
            <form method="POST" action="{{ route('logout') }}" class="inline">
                @csrf
                <button type="submit" class="px-6 py-3 bg-error text-white rounded-full font-semibold hover:bg-error-dark transition-all duration-300 cursor-pointer">Logout</button>
            </form>
        </div>
    </div>
</div>

<script>
function showLogoutModal() {
    document.getElementById('logoutModal').classList.remove('hidden');
    document.getElementById('logoutModal').classList.add('flex');
}
function hideLogoutModal() {
    document.getElementById('logoutModal').classList.add('hidden');
    document.getElementById('logoutModal').classList.remove('flex');
}
</script>
