<div class="flex items-center justify-between w-full h-[90px] shrink-0 border-b border-border bg-white px-5 md:px-8">
    <!-- Mobile hamburger -->
    <button onclick="toggleSidebar()" aria-label="Open menu" class="lg:hidden size-11 flex items-center justify-center rounded-xl ring-1 ring-border hover:ring-primary transition-all duration-300 cursor-pointer">
        <i data-lucide="menu" class="size-6 text-foreground"></i>
    </button>
    
    <!-- Page title (shown on desktop) -->
    <h2 class="hidden lg:block font-bold text-2xl text-foreground">@yield('page-title', 'Dashboard')</h2>
    
    <!-- Right actions -->
    <div class="flex items-center gap-3">
        <button class="size-11 flex items-center justify-center rounded-xl ring-1 ring-border hover:ring-primary transition-all duration-300 cursor-pointer relative" aria-label="Notifications">
            <i data-lucide="bell" class="size-6 text-secondary"></i>
            <span class="absolute -top-1 -right-1 h-5 px-1.5 rounded-full bg-error text-white text-xs font-medium flex items-center justify-center">3</span>
        </button>
        <div class="hidden md:flex items-center gap-3 pl-3 border-l border-border">
            <div class="text-right">
                <p class="font-semibold text-foreground text-sm">{{ auth()->user()->name }}</p>
                <p class="text-secondary text-xs">{{ ucfirst(auth()->user()->role) }}</p>
            </div>
            @if(auth()->user()->avatar)
                <img src="{{ auth()->user()->avatar }}" alt="Profile" class="size-11 rounded-full object-cover ring-2 ring-border">
            @else
                <div class="size-11 rounded-full bg-primary flex items-center justify-center ring-2 ring-border">
                    <span class="text-white font-semibold text-sm">{{ substr(auth()->user()->name, 0, 2) }}</span>
                </div>
            @endif
        </div>
    </div>
</div>
