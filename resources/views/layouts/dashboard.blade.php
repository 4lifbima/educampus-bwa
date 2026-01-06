<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>EduCampus - @yield('title', 'Dashboard')</title>
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
            --color-card-grey: var(--card-grey);
            --color-card-message: var(--card-message);
            --color-accent-blue: var(--accent-blue);
            --color-accent-teal: var(--accent-teal);
            --color-accent-sky: var(--accent-sky);
            --color-success: var(--success);
            --color-success-light: var(--success-light);
            --color-success-dark: var(--success-dark);
            --color-error: var(--error);
            --color-error-light: var(--error-light);
            --color-error-lighter: var(--error-lighter);
            --color-error-dark: var(--error-dark);
            --color-warning: var(--warning);
            --color-warning-light: var(--warning-light);
            --color-warning-dark: var(--warning-dark);
            --color-info: var(--info);
            --color-info-light: var(--info-light);
            --color-info-dark: var(--info-dark);
            --color-alert: var(--alert);
            --color-alert-light: var(--alert-light);
            --color-alert-dark: var(--alert-dark);
            --color-gray-50: var(--gray-50);
            --color-gray-100: var(--gray-100);
            --color-gray-200: var(--gray-200);
            --color-gray-500: var(--gray-500);
            --color-gray-600: var(--gray-600);
            --color-gray-700: var(--gray-700);
            --font-sans: var(--font-sans);
            --radius-card: 24px;
            --radius-button: 50px;
            --radius-icon: 12px;
            --radius-xl: 16px;
            --radius-2xl: 20px;
            --radius-3xl: 24px;
        }
        :root {
            --primary: #165DFF;
            --primary-hover: #0E4BD9;
            --foreground: #080C1A;
            --secondary: #6A7686;
            --muted: #EFF2F7;
            --border: #F3F4F3;
            --card-grey: #F1F3F6;
            --card-message: #C9E6FC;
            --accent-blue: #C9E6FC;
            --accent-teal: #82D9D7;
            --accent-sky: #DBEAFE;
            --success: #30B22D;
            --success-light: #DCFCE7;
            --success-dark: #166534;
            --error: #ED6B60;
            --error-light: #FEE2E2;
            --error-lighter: #FEF2F2;
            --error-dark: #991B1B;
            --warning: #FED71F;
            --warning-light: #FEF9C3;
            --warning-dark: #854D0E;
            --info: #165DFF;
            --info-light: #DBEAFE;
            --info-dark: #1E40AF;
            --alert: #F97316;
            --alert-light: #FFEDD5;
            --alert-dark: #9A3412;
            --gray-50: #F9FAFB;
            --gray-100: #F1F3F6;
            --gray-200: #E5E7EB;
            --gray-500: #6A7686;
            --gray-600: #4B5563;
            --gray-700: #374151;
            --font-sans: 'Lexend Deca', sans-serif;
        }
        select {
            @apply appearance-none bg-no-repeat cursor-pointer;
            background-image: url("data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' width='16' height='16' viewBox='0 0 24 24' fill='none' stroke='%236B7280' stroke-width='2' stroke-linecap='round' stroke-linejoin='round'%3E%3Cpath d='m6 9 6 6 6-6'/%3E%3C/svg%3E");
            background-position: right 10px center;
            padding-right: 40px;
        }
        .scrollbar-hide::-webkit-scrollbar { display: none; }
        .scrollbar-hide { -ms-overflow-style: none; scrollbar-width: none; }
    </style>
    @stack('styles')
</head>
<body class="font-sans bg-white min-h-screen overflow-x-hidden">

<!-- Mobile Overlay -->
<div id="sidebar-overlay" class="fixed inset-0 bg-black/80 z-40 lg:hidden hidden" onclick="toggleSidebar()"></div>

<div class="flex h-screen max-h-screen flex-1 bg-muted overflow-hidden">
    <!-- SIDEBAR -->
    @include('components.sidebar')

    <!-- MAIN CONTENT -->
    <main class="flex-1 lg:ml-[280px] flex flex-col bg-white min-h-screen overflow-x-hidden">
        <!-- Top Header Bar -->
        @include('components.header')

        <!-- Page Content Area -->
        <div class="flex-1 overflow-y-auto p-5 md:p-8">
            @yield('content')
        </div>
    </main>
</div>

<!-- Toast Notifications -->
@if(session('success'))
<div id="toast-success" class="fixed top-4 right-4 bg-success text-white px-4 py-3 rounded-xl z-50 font-medium shadow-lg">
    {{ session('success') }}
</div>
<script>setTimeout(() => document.getElementById('toast-success').remove(), 3000);</script>
@endif

@if(session('error'))
<div id="toast-error" class="fixed top-4 right-4 bg-error text-white px-4 py-3 rounded-xl z-50 font-medium shadow-lg">
    {{ session('error') }}
</div>
<script>setTimeout(() => document.getElementById('toast-error').remove(), 5000);</script>
@endif

<script>
document.addEventListener('DOMContentLoaded', function() {
    lucide.createIcons();
});

function toggleSidebar() {
    const sidebar = document.getElementById('sidebar');
    const overlay = document.getElementById('sidebar-overlay');
    const closeBtn = document.getElementById('sidebar-close-btn');
    
    if (sidebar.classList.contains('-translate-x-full')) {
        // Open sidebar
        sidebar.classList.remove('-translate-x-full');
        overlay.classList.remove('hidden');
        if (closeBtn) {
            closeBtn.classList.remove('hidden');
            closeBtn.classList.add('flex');
        }
    } else {
        // Close sidebar
        sidebar.classList.add('-translate-x-full');
        overlay.classList.add('hidden');
        if (closeBtn) {
            closeBtn.classList.add('hidden');
            closeBtn.classList.remove('flex');
        }
    }
    document.body.classList.toggle('overflow-hidden');
    lucide.createIcons();
}
</script>
@stack('scripts')
</body>
</html>
