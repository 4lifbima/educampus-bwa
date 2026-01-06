<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>EduCampus - Register</title>
    <meta name="description" content="Create your EduCampus account">
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
            --color-error: var(--error);
            --color-error-light: var(--error-light);
            --font-sans: var(--font-sans);
            --radius-card: 24px;
            --radius-button: 50px;
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
            --error: #ED6B60;
            --error-light: #FEE2E2;
            --font-sans: 'Lexend Deca', sans-serif;
        }
    </style>
</head>
<body class="font-sans bg-muted min-h-screen flex items-center justify-center p-4">
    <div class="w-full max-w-md">
        <!-- Logo and Title -->
        <div class="text-center mb-8">
            <div class="w-16 h-12 bg-primary rounded-2xl flex items-center justify-center mx-auto mb-4">
                <i data-lucide="graduation-cap" class="w-8 h-8 text-white"></i>
            </div>
            <h1 class="text-3xl font-bold text-foreground mb-2">Create Account</h1>
            <p class="text-secondary">Join EduCampus today</p>
        </div>

        <!-- Register Form -->
        <div class="bg-white rounded-card p-8 shadow-sm">
            @if ($errors->any())
                <div class="mb-4 p-4 rounded-2xl bg-error-light text-error text-sm">
                    <ul class="list-disc list-inside">
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            <form method="POST" action="{{ route('register') }}">
                @csrf

                <!-- Name -->
                <div class="mb-4">
                    <label for="name" class="block text-sm font-medium text-foreground mb-2">Full Name</label>
                    <div class="relative">
                        <i data-lucide="user" class="absolute left-4 top-1/2 -translate-y-1/2 w-5 h-5 text-secondary"></i>
                        <input type="text" id="name" name="name" value="{{ old('name') }}" 
                            class="w-full pl-12 pr-4 py-3 rounded-2xl ring-1 ring-border focus:ring-2 focus:ring-primary outline-none transition-all duration-300" 
                            placeholder="Enter your full name" required autofocus>
                    </div>
                </div>

                <!-- Email -->
                <div class="mb-4">
                    <label for="email" class="block text-sm font-medium text-foreground mb-2">Email</label>
                    <div class="relative">
                        <i data-lucide="mail" class="absolute left-4 top-1/2 -translate-y-1/2 w-5 h-5 text-secondary"></i>
                        <input type="email" id="email" name="email" value="{{ old('email') }}" 
                            class="w-full pl-12 pr-4 py-3 rounded-2xl ring-1 ring-border focus:ring-2 focus:ring-primary outline-none transition-all duration-300" 
                            placeholder="Enter your email" required>
                    </div>
                </div>

                <!-- Password -->
                <div class="mb-4">
                    <label for="password" class="block text-sm font-medium text-foreground mb-2">Password</label>
                    <div class="relative">
                        <i data-lucide="lock" class="absolute left-4 top-1/2 -translate-y-1/2 w-5 h-5 text-secondary"></i>
                        <input type="password" id="password" name="password" 
                            class="w-full pl-12 pr-12 py-3 rounded-2xl ring-1 ring-border focus:ring-2 focus:ring-primary outline-none transition-all duration-300" 
                            placeholder="Create a password" required>
                        <button type="button" onclick="togglePassword('password', 'eye-icon-1')" class="absolute right-4 top-1/2 -translate-y-1/2 text-secondary hover:text-foreground transition-colors">
                            <i id="eye-icon-1" data-lucide="eye" class="w-5 h-5"></i>
                        </button>
                    </div>
                </div>

                <!-- Confirm Password -->
                <div class="mb-6">
                    <label for="password_confirmation" class="block text-sm font-medium text-foreground mb-2">Confirm Password</label>
                    <div class="relative">
                        <i data-lucide="lock" class="absolute left-4 top-1/2 -translate-y-1/2 w-5 h-5 text-secondary"></i>
                        <input type="password" id="password_confirmation" name="password_confirmation" 
                            class="w-full pl-12 pr-12 py-3 rounded-2xl ring-1 ring-border focus:ring-2 focus:ring-primary outline-none transition-all duration-300" 
                            placeholder="Confirm your password" required>
                        <button type="button" onclick="togglePassword('password_confirmation', 'eye-icon-2')" class="absolute right-4 top-1/2 -translate-y-1/2 text-secondary hover:text-foreground transition-colors">
                            <i id="eye-icon-2" data-lucide="eye" class="w-5 h-5"></i>
                        </button>
                    </div>
                </div>

                <!-- Submit Button -->
                <button type="submit" class="w-full py-3 bg-primary text-white rounded-button font-semibold hover:bg-primary-hover transition-all duration-300 cursor-pointer">
                    Create Account
                </button>
            </form>

            <!-- Login Link -->
            <p class="text-center text-secondary text-sm mt-6">
                Already have an account? 
                <a href="{{ route('login') }}" class="text-primary font-medium hover:underline">Sign In</a>
            </p>
        </div>

        <!-- Info Card -->
        <div class="mt-6 p-4 bg-white rounded-2xl shadow-sm text-center">
            <p class="text-sm text-secondary">
                By creating an account, you agree to our 
                <a href="#" class="text-primary hover:underline">Terms of Service</a> and 
                <a href="#" class="text-primary hover:underline">Privacy Policy</a>
            </p>
        </div>
    </div>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            lucide.createIcons();
        });

        function togglePassword(inputId, iconId) {
            const passwordInput = document.getElementById(inputId);
            const eyeIcon = document.getElementById(iconId);
            
            if (passwordInput.type === 'password') {
                passwordInput.type = 'text';
                eyeIcon.setAttribute('data-lucide', 'eye-off');
            } else {
                passwordInput.type = 'password';
                eyeIcon.setAttribute('data-lucide', 'eye');
            }
            lucide.createIcons();
        }
    </script>
</body>
</html>
