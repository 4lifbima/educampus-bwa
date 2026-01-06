<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>EduCampus - Modern Education Platform</title>
    <meta name="description" content="EduCampus - Platform manajemen pendidikan modern untuk mahasiswa, dosen, dan administrator.">
    <link href="https://fonts.googleapis.com/css2?family=Lexend+Deca:wght@100..900&display=swap" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/@tailwindcss/browser@4"></script>
    <script src="https://unpkg.com/lucide@latest/dist/umd/lucide.js"></script>
    <style type="text/tailwindcss">
        @theme inline {
            --color-primary: var(--primary);
            --color-primary-hover: var(--primary-hover);
            --color-foreground: var(--foreground);
            --color-secondary: var(--secondary);
            --color-muted: var(--muted);
            --color-border: var(--border);
            --color-success: var(--success);
            --color-success-light: var(--success-light);
            --font-sans: var(--font-sans);
        }
        :root {
            --primary: #165DFF;
            --primary-hover: #0E4BD9;
            --foreground: #080C1A;
            --secondary: #6A7686;
            --muted: #EFF2F7;
            --border: #F3F4F3;
            --success: #30B22D;
            --success-light: #DCFCE7;
            --font-sans: 'Lexend Deca', sans-serif;
        }
        .hero-gradient {
            background: linear-gradient(135deg, #EFF2F7 0%, #DBEAFE 50%, #E0E7FF 100%);
        }
        .card-hover:hover {
            transform: translateY(-4px);
            box-shadow: 0 20px 40px rgba(22, 93, 255, 0.1);
        }
    </style>
</head>
<body class="font-sans bg-white text-foreground antialiased">
    <!-- Mobile Sidebar Overlay -->
    <div id="sidebar-overlay" class="fixed inset-0 bg-black/50 z-40 hidden lg:hidden" onclick="toggleMobileSidebar()"></div>

    <!-- Mobile Close Button (positioned outside sidebar) -->
    <button id="mobile-close-btn" onclick="toggleMobileSidebar()" aria-label="Close sidebar" class="fixed top-5 left-[290px] z-[60] size-11 bg-white rounded-xl p-[10px] items-center justify-center ring-1 ring-border hover:ring-primary transition-all duration-300 cursor-pointer shadow-lg hidden lg:hidden">
        <i data-lucide="x" class="size-6 text-secondary"></i>
    </button>

    <!-- Mobile Sidebar -->
    <aside id="mobile-sidebar" class="flex flex-col w-[280px] h-screen fixed inset-y-0 left-0 z-50 bg-white border-r border-border transform -translate-x-full transition-transform duration-300 lg:hidden">
        <!-- Top Bar with logo and title -->
        <div class="flex items-center justify-between border-b border-border h-[90px] px-5 gap-3">
            <div class="flex items-center gap-3">
                <div class="w-10 bg-primary rounded-xl flex items-center justify-center">
                    <i data-lucide="graduation-cap" class="w-5 h-5 text-white"></i>
                </div>
                <h1 class="font-semibold text-xl">EduCampus</h1>
            </div>
        </div>

        <!-- Navigation Menu -->
        <div class="flex flex-col p-5 gap-6 overflow-y-auto flex-1">
            <div class="flex flex-col gap-4">
                <h3 class="font-medium text-sm text-secondary">Menu</h3>
                <div class="flex flex-col gap-1">
                    <a href="#features" onclick="toggleMobileSidebar()" class="group cursor-pointer">
                        <div class="flex items-center rounded-xl p-4 gap-3 bg-white hover:bg-muted transition-all duration-300">
                            <i data-lucide="sparkles" class="size-6 text-secondary group-hover:text-foreground transition-all duration-300"></i>
                            <span class="font-medium text-secondary group-hover:text-foreground transition-all duration-300">Features</span>
                        </div>
                    </a>
                    <a href="#roles" onclick="toggleMobileSidebar()" class="group cursor-pointer">
                        <div class="flex items-center rounded-xl p-4 gap-3 bg-white hover:bg-muted transition-all duration-300">
                            <i data-lucide="users" class="size-6 text-secondary group-hover:text-foreground transition-all duration-300"></i>
                            <span class="font-medium text-secondary group-hover:text-foreground transition-all duration-300">Roles</span>
                        </div>
                    </a>
                </div>
            </div>

            <div class="flex flex-col gap-4">
                <h3 class="font-medium text-sm text-secondary">Account</h3>
                <div class="flex flex-col gap-1">
                    @if (Route::has('login'))
                        @auth
                            <a href="{{ url('/dashboard') }}" class="group cursor-pointer">
                                <div class="flex items-center rounded-xl p-4 gap-3 bg-white hover:bg-muted transition-all duration-300">
                                    <i data-lucide="layout-dashboard" class="size-6 text-secondary group-hover:text-foreground transition-all duration-300"></i>
                                    <span class="font-medium text-secondary group-hover:text-foreground transition-all duration-300">Dashboard</span>
                                </div>
                            </a>
                        @else
                            <a href="{{ route('login') }}" class="group cursor-pointer">
                                <div class="flex items-center rounded-xl p-4 gap-3 bg-white hover:bg-muted transition-all duration-300">
                                    <i data-lucide="log-in" class="size-6 text-secondary group-hover:text-foreground transition-all duration-300"></i>
                                    <span class="font-medium text-secondary group-hover:text-foreground transition-all duration-300">Sign In</span>
                                </div>
                            </a>
                            @if (Route::has('register'))
                                <a href="{{ route('register') }}" class="group cursor-pointer">
                                    <div class="flex items-center rounded-xl p-4 gap-3 bg-white hover:bg-muted transition-all duration-300">
                                        <i data-lucide="user-plus" class="size-6 text-secondary group-hover:text-foreground transition-all duration-300"></i>
                                        <span class="font-medium text-secondary group-hover:text-foreground transition-all duration-300">Register</span>
                                    </div>
                                </a>
                            @endif
                        @endauth
                    @endif
                </div>
            </div>
        </div>

        <!-- Bottom -->
        <div class="border-t border-border p-5">
            <div class="flex items-center justify-between gap-3">
                <div>
                    <p class="font-semibold text-foreground">Need help?</p>
                    <a href="#" class="text-sm text-secondary hover:text-primary transition-all duration-300">Contact support</a>
                </div>
                <div class="size-11 bg-primary/10 rounded-xl flex items-center justify-center">
                    <i data-lucide="message-circle-question" class="size-6 text-primary"></i>
                </div>
            </div>
        </div>
    </aside>

    <!-- Navbar -->
    <nav class="fixed top-0 left-0 right-0 z-30 bg-white/80 backdrop-blur-lg border-b border-border">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex items-center justify-between h-20">
                <!-- Logo -->
                <div class="flex items-center gap-3">
                    <div class="w-10 h-8 bg-primary rounded-xl flex items-center justify-center">
                        <i data-lucide="graduation-cap" class="w-5 h-5 text-white"></i>
                    </div>
                    <span class="font-bold text-xl text-foreground">EduCampus</span>
                </div>
                
                <!-- Desktop Menu -->
                <div class="hidden md:flex items-center gap-8">
                    <a href="#features" class="text-secondary hover:text-foreground transition-colors">Features</a>
                    <a href="#roles" class="text-secondary hover:text-foreground transition-colors">Roles</a>
                </div>
                
                <!-- Auth Buttons + Mobile Menu -->
                <div class="flex items-center gap-3">
                    @if (Route::has('login'))
                        @auth
                            <a href="{{ url('/dashboard') }}" class="px-6 py-2.5 bg-primary text-white rounded-full font-semibold hover:bg-primary-hover transition-all duration-300">
                                Dashboard
                            </a>
                        @else
                            <a href="{{ route('login') }}" class="hidden sm:inline-flex px-5 py-2.5 text-secondary hover:text-foreground font-medium transition-colors">
                                Sign In
                            </a>
                            @if (Route::has('register'))
                                <a href="{{ route('register') }}" class="hidden md:inline-flex px-6 py-2.5 bg-primary text-white rounded-full font-semibold hover:bg-primary-hover transition-all duration-300">
                                    Get Started
                                </a>
                            @endif
                        @endauth
                    @endif
                    
                    <!-- Mobile Menu Button (positioned on right) -->
                    <button onclick="toggleMobileSidebar()" class="md:hidden size-11 flex shrink-0 bg-white rounded-xl p-[10px] items-center justify-center ring-1 ring-border hover:ring-primary transition-all duration-300 cursor-pointer">
                        <i data-lucide="menu" class="size-6 text-secondary"></i>
                    </button>
                </div>
            </div>
        </div>
    </nav>

    <!-- Hero Section -->
    <section class="hero-gradient pt-32 pb-20 lg:pt-40 lg:pb-32 overflow-hidden">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="grid lg:grid-cols-2 gap-12 items-center">
                <div class="text-center lg:text-left">
                    <div class="inline-flex items-center gap-2 px-4 py-2 bg-white rounded-full shadow-sm mb-6">
                        <span class="w-2 h-2 bg-success rounded-full animate-pulse"></span>
                        <span class="text-sm font-medium text-secondary">Platform Pendidikan Modern</span>
                    </div>
                    <h1 class="text-4xl sm:text-5xl lg:text-6xl font-bold text-foreground leading-tight mb-6">
                        Transformasi 
                        <span class="text-primary">Pendidikan</span> 
                        Digital
                    </h1>
                    <p class="text-lg text-secondary mb-8 max-w-xl mx-auto lg:mx-0">
                        EduCampus menghadirkan solusi manajemen kampus yang terintegrasi untuk mahasiswa, dosen, dan administrator. Kelola kelas, jadwal, dan administrasi dengan mudah.
                    </p>
                    <div class="flex flex-col sm:flex-row gap-4 justify-center lg:justify-start">
                        <a href="{{ route('register') }}" class="inline-flex items-center justify-center gap-2 px-8 py-4 bg-primary text-white rounded-full font-semibold hover:bg-primary-hover transition-all duration-300 shadow-lg shadow-primary/25">
                            <span>Mulai Sekarang</span>
                            <i data-lucide="arrow-right" class="w-5 h-5"></i>
                        </a>
                        <a href="{{ route('login') }}" class="inline-flex items-center justify-center gap-2 px-8 py-4 bg-white text-foreground rounded-full font-semibold ring-1 ring-border hover:ring-primary transition-all duration-300">
                            <i data-lucide="play-circle" class="w-5 h-5 text-primary"></i>
                            <span>Lihat Demo</span>
                        </a>
                    </div>
                    
                    <!-- Stats -->
                    <div class="grid grid-cols-3 gap-6 mt-12 pt-8 border-t border-border/50">
                        <div>
                            <p class="text-3xl font-bold text-foreground">5K+</p>
                            <p class="text-sm text-secondary">Mahasiswa</p>
                        </div>
                        <div>
                            <p class="text-3xl font-bold text-foreground">200+</p>
                            <p class="text-sm text-secondary">Dosen</p>
                        </div>
                        <div>
                            <p class="text-3xl font-bold text-foreground">500+</p>
                            <p class="text-sm text-secondary">Kelas Aktif</p>
                        </div>
                    </div>
                </div>
                
                <!-- Hero Image -->
                <div class="relative hidden lg:block">
                    <div class="absolute -top-10 -right-10 w-72 h-72 bg-primary/10 rounded-full blur-3xl"></div>
                    <div class="absolute -bottom-10 -left-10 w-72 h-72 bg-success/10 rounded-full blur-3xl"></div>
                    <div class="relative bg-white rounded-3xl shadow-2xl p-6 ring-1 ring-border">
                        <div class="flex items-center gap-3 mb-4">
                            <div class="w-3 h-3 rounded-full bg-red-400"></div>
                            <div class="w-3 h-3 rounded-full bg-yellow-400"></div>
                            <div class="w-3 h-3 rounded-full bg-green-400"></div>
                        </div>
                        <div class="space-y-4">
                            <div class="flex items-center gap-4 p-4 bg-muted rounded-2xl">
                                <div class="w-12 h-12 bg-primary/10 rounded-xl flex items-center justify-center">
                                    <i data-lucide="users" class="w-6 h-6 text-primary"></i>
                                </div>
                                <div>
                                    <p class="font-semibold text-foreground">Student Dashboard</p>
                                    <p class="text-sm text-secondary">Manage your courses</p>
                                </div>
                            </div>
                            <div class="flex items-center gap-4 p-4 bg-success-light rounded-2xl">
                                <div class="w-12 h-12 bg-success/20 rounded-xl flex items-center justify-center">
                                    <i data-lucide="check-circle" class="w-6 h-6 text-success"></i>
                                </div>
                                <div>
                                    <p class="font-semibold text-foreground">Enrollment Approved</p>
                                    <p class="text-sm text-secondary">CS101 - Computer Science</p>
                                </div>
                            </div>
                            <div class="flex items-center gap-4 p-4 bg-muted rounded-2xl">
                                <div class="w-12 h-12 bg-primary/10 rounded-xl flex items-center justify-center">
                                    <i data-lucide="calendar" class="w-6 h-6 text-primary"></i>
                                </div>
                                <div>
                                    <p class="font-semibold text-foreground">Weekly Schedule</p>
                                    <p class="text-sm text-secondary">View your timetable</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Features Section -->
    <section id="features" class="py-20 lg:py-32 bg-white">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="text-center mb-16">
                <span class="inline-block px-4 py-2 bg-primary/10 text-primary rounded-full text-sm font-semibold mb-4">Features</span>
                <h2 class="text-3xl sm:text-4xl font-bold text-foreground mb-4">Fitur Lengkap untuk Kampus Modern</h2>
                <p class="text-lg text-secondary max-w-2xl mx-auto">Semua yang Anda butuhkan untuk mengelola aktivitas akademik dalam satu platform terintegrasi.</p>
            </div>
            
            <div class="grid md:grid-cols-2 lg:grid-cols-3 gap-8">
                <!-- Feature 1 -->
                <div class="card-hover p-8 rounded-3xl bg-white ring-1 ring-border transition-all duration-300">
                    <div class="w-14 h-14 bg-primary/10 rounded-2xl flex items-center justify-center mb-6">
                        <i data-lucide="users" class="w-7 h-7 text-primary"></i>
                    </div>
                    <h3 class="text-xl font-bold text-foreground mb-3">Manajemen Mahasiswa</h3>
                    <p class="text-secondary">Kelola data mahasiswa, pendaftaran kelas, dan monitoring progress akademik secara real-time.</p>
                </div>
                
                <!-- Feature 2 -->
                <div class="card-hover p-8 rounded-3xl bg-white ring-1 ring-border transition-all duration-300">
                    <div class="w-14 h-14 bg-success/10 rounded-2xl flex items-center justify-center mb-6">
                        <i data-lucide="user-check" class="w-7 h-7 text-success"></i>
                    </div>
                    <h3 class="text-xl font-bold text-foreground mb-3">Portal Dosen</h3>
                    <p class="text-secondary">Kelola kelas, approve enrollment, dan pantau kehadiran mahasiswa dengan mudah.</p>
                </div>
                
                <!-- Feature 3 -->
                <div class="card-hover p-8 rounded-3xl bg-white ring-1 ring-border transition-all duration-300">
                    <div class="w-14 h-14 bg-blue-100 rounded-2xl flex items-center justify-center mb-6">
                        <i data-lucide="calendar" class="w-7 h-7 text-blue-600"></i>
                    </div>
                    <h3 class="text-xl font-bold text-foreground mb-3">Jadwal Timetable</h3>
                    <p class="text-secondary">Tampilan jadwal kalender mingguan yang intuitif dan mudah dipahami.</p>
                </div>
                
                <!-- Feature 4 -->
                <div class="card-hover p-8 rounded-3xl bg-white ring-1 ring-border transition-all duration-300">
                    <div class="w-14 h-14 bg-purple-100 rounded-2xl flex items-center justify-center mb-6">
                        <i data-lucide="book-open" class="w-7 h-7 text-purple-600"></i>
                    </div>
                    <h3 class="text-xl font-bold text-foreground mb-3">Enrollment System</h3>
                    <p class="text-secondary">Sistem pendaftaran kelas dengan approval workflow dari dosen pengampu.</p>
                </div>
                
                <!-- Feature 5 -->
                <div class="card-hover p-8 rounded-3xl bg-white ring-1 ring-border transition-all duration-300">
                    <div class="w-14 h-14 bg-orange-100 rounded-2xl flex items-center justify-center mb-6">
                        <i data-lucide="bar-chart-3" class="w-7 h-7 text-orange-600"></i>
                    </div>
                    <h3 class="text-xl font-bold text-foreground mb-3">Dashboard Analytics</h3>
                    <p class="text-secondary">Visualisasi data dan statistik kampus untuk pengambilan keputusan yang tepat.</p>
                </div>
                
                <!-- Feature 6 -->
                <div class="card-hover p-8 rounded-3xl bg-white ring-1 ring-border transition-all duration-300">
                    <div class="w-14 h-14 bg-pink-100 rounded-2xl flex items-center justify-center mb-6">
                        <i data-lucide="shield-check" class="w-7 h-7 text-pink-600"></i>
                    </div>
                    <h3 class="text-xl font-bold text-foreground mb-3">Role-Based Access</h3>
                    <p class="text-secondary">Sistem akses berbasis peran untuk Admin, Dosen, dan Mahasiswa.</p>
                </div>
            </div>
        </div>
    </section>

    <!-- Roles Section -->
    <section id="roles" class="py-20 lg:py-32 bg-muted">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="text-center mb-16">
                <span class="inline-block px-4 py-2 bg-primary/10 text-primary rounded-full text-sm font-semibold mb-4">User Roles</span>
                <h2 class="text-3xl sm:text-4xl font-bold text-foreground mb-4">Satu Platform, Tiga Peran</h2>
                <p class="text-lg text-secondary max-w-2xl mx-auto">Akses yang disesuaikan untuk setiap kebutuhan pengguna.</p>
            </div>
            
            <div class="grid md:grid-cols-3 gap-8">
                <!-- Admin -->
                <div class="bg-white rounded-3xl p-8 shadow-lg ring-1 ring-border">
                    <div class="w-16 h-16 bg-gradient-to-br from-primary to-primary-hover rounded-2xl flex items-center justify-center mb-6 shadow-lg shadow-primary/25">
                        <i data-lucide="shield" class="w-8 h-8 text-white"></i>
                    </div>
                    <h3 class="text-2xl font-bold text-foreground mb-4">Admin</h3>
                    <ul class="space-y-3 text-secondary">
                        <li class="flex items-center gap-3">
                            <i data-lucide="check" class="w-5 h-5 text-success"></i>
                            <span>Kelola semua data</span>
                        </li>
                        <li class="flex items-center gap-3">
                            <i data-lucide="check" class="w-5 h-5 text-success"></i>
                            <span>CRUD Mahasiswa & Dosen</span>
                        </li>
                        <li class="flex items-center gap-3">
                            <i data-lucide="check" class="w-5 h-5 text-success"></i>
                            <span>Manajemen Kelas</span>
                        </li>
                        <li class="flex items-center gap-3">
                            <i data-lucide="check" class="w-5 h-5 text-success"></i>
                            <span>Dashboard Statistics</span>
                        </li>
                    </ul>
                </div>
                
                <!-- Dosen -->
                <div class="bg-white rounded-3xl p-8 shadow-lg ring-1 ring-border relative overflow-hidden">
                    <div class="absolute top-0 right-0 px-4 py-1 bg-primary text-white text-sm font-semibold rounded-bl-2xl">Popular</div>
                    <div class="w-16 h-16 bg-gradient-to-br from-success to-green-600 rounded-2xl flex items-center justify-center mb-6 shadow-lg shadow-success/25">
                        <i data-lucide="user-check" class="w-8 h-8 text-white"></i>
                    </div>
                    <h3 class="text-2xl font-bold text-foreground mb-4">Dosen</h3>
                    <ul class="space-y-3 text-secondary">
                        <li class="flex items-center gap-3">
                            <i data-lucide="check" class="w-5 h-5 text-success"></i>
                            <span>Lihat kelas yang diampu</span>
                        </li>
                        <li class="flex items-center gap-3">
                            <i data-lucide="check" class="w-5 h-5 text-success"></i>
                            <span>Approve enrollment</span>
                        </li>
                        <li class="flex items-center gap-3">
                            <i data-lucide="check" class="w-5 h-5 text-success"></i>
                            <span>Kelola kehadiran</span>
                        </li>
                        <li class="flex items-center gap-3">
                            <i data-lucide="check" class="w-5 h-5 text-success"></i>
                            <span>Beri nilai mahasiswa</span>
                        </li>
                    </ul>
                </div>
                
                <!-- Mahasiswa -->
                <div class="bg-white rounded-3xl p-8 shadow-lg ring-1 ring-border">
                    <div class="w-16 h-16 bg-gradient-to-br from-blue-500 to-blue-700 rounded-2xl flex items-center justify-center mb-6 shadow-lg shadow-blue-500/25">
                        <i data-lucide="user" class="w-8 h-8 text-white"></i>
                    </div>
                    <h3 class="text-2xl font-bold text-foreground mb-4">Mahasiswa</h3>
                    <ul class="space-y-3 text-secondary">
                        <li class="flex items-center gap-3">
                            <i data-lucide="check" class="w-5 h-5 text-success"></i>
                            <span>Daftar ke kelas</span>
                        </li>
                        <li class="flex items-center gap-3">
                            <i data-lucide="check" class="w-5 h-5 text-success"></i>
                            <span>Lihat jadwal mingguan</span>
                        </li>
                        <li class="flex items-center gap-3">
                            <i data-lucide="check" class="w-5 h-5 text-success"></i>
                            <span>Tracking kehadiran</span>
                        </li>
                        <li class="flex items-center gap-3">
                            <i data-lucide="check" class="w-5 h-5 text-success"></i>
                            <span>Lihat nilai</span>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
    </section>

    <!-- CTA Section -->
    <section class="py-20 lg:py-32 bg-gradient-to-br from-primary to-primary-hover relative overflow-hidden">
        <div class="absolute inset-0 opacity-10">
            <div class="absolute top-0 left-0 w-96 h-96 bg-white rounded-full blur-3xl -translate-x-1/2 -translate-y-1/2"></div>
            <div class="absolute bottom-0 right-0 w-96 h-96 bg-white rounded-full blur-3xl translate-x-1/2 translate-y-1/2"></div>
        </div>
        <div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8 text-center relative z-10">
            <h2 class="text-3xl sm:text-4xl lg:text-5xl font-bold text-white mb-6">Siap Memulai Transformasi Digital?</h2>
            <p class="text-xl text-white/80 mb-10 max-w-2xl mx-auto">Bergabung dengan ribuan institusi pendidikan yang telah menggunakan EduCampus.</p>
            <div class="flex flex-col sm:flex-row gap-4 justify-center">
                <a href="{{ route('register') }}" class="inline-flex items-center justify-center gap-2 px-8 py-4 bg-white text-primary rounded-full font-semibold hover:bg-gray-100 transition-all duration-300 shadow-lg">
                    <span>Daftar Gratis</span>
                    <i data-lucide="arrow-right" class="w-5 h-5"></i>
                </a>
                <a href="{{ route('login') }}" class="inline-flex items-center justify-center gap-2 px-8 py-4 bg-transparent text-white rounded-full font-semibold ring-2 ring-white/30 hover:ring-white transition-all duration-300">
                    <span>Masuk ke Akun</span>
                </a>
            </div>
        </div>
    </section>

    <!-- Footer -->
    <footer class="py-12 bg-foreground text-white">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex flex-col md:flex-row items-center justify-between gap-6">
                <div class="flex items-center gap-3">
                    <div class="w-10 h-8 bg-primary rounded-xl flex items-center justify-center">
                        <i data-lucide="graduation-cap" class="w-5 h-5 text-white"></i>
                    </div>
                    <span class="font-bold text-xl">EduCampus</span>
                </div>
                <p class="text-secondary text-sm">© {{ date('Y') }} EduCampus. All rights reserved.</p>
                <div class="flex items-center gap-6">
                    <a href="#" class="text-secondary hover:text-white transition-colors">Privacy</a>
                    <a href="#" class="text-secondary hover:text-white transition-colors">Terms</a>
                    <a href="#" class="text-secondary hover:text-white transition-colors">Contact</a>
                </div>
            </div>
        </div>
    </footer>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            lucide.createIcons();
        });

        function toggleMobileSidebar() {
            const sidebar = document.getElementById('mobile-sidebar');
            const overlay = document.getElementById('sidebar-overlay');
            const closeBtn = document.getElementById('mobile-close-btn');
            
            if (sidebar.classList.contains('-translate-x-full')) {
                // Open sidebar
                sidebar.classList.remove('-translate-x-full');
                sidebar.classList.add('translate-x-0');
                overlay.classList.remove('hidden');
                closeBtn.classList.remove('hidden');
                closeBtn.classList.add('flex');
            } else {
                // Close sidebar
                sidebar.classList.add('-translate-x-full');
                sidebar.classList.remove('translate-x-0');
                overlay.classList.add('hidden');
                closeBtn.classList.add('hidden');
                closeBtn.classList.remove('flex');
            }
            lucide.createIcons();
        }
    </script>
</body>
</html>
