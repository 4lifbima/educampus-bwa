@extends('layouts.dashboard')

@section('title', 'Edit Profile')
@section('page-title', 'Profile Settings')

@section('content')
<div class="max-w-4xl mx-auto">
    <div class="flex flex-col md:flex-row md:items-center md:justify-between gap-4 mb-6 md:mb-8">
        <div>
            <h1 class="text-foreground text-2xl md:text-3xl font-bold mb-1">Profile Settings</h1>
            <p class="text-secondary text-sm md:text-base">Manage your account information and preferences</p>
        </div>
    </div>

    @if (session('status') === 'profile-updated')
    <div class="mb-6 p-4 rounded-2xl bg-success-light text-success-dark">
        <div class="flex items-center gap-2">
            <i data-lucide="check-circle" class="w-5 h-5"></i>
            <span>Profile updated successfully!</span>
        </div>
    </div>
    @endif

    <!-- Profile Photo & Information -->
    <div class="flex flex-col rounded-2xl border border-border bg-white overflow-hidden mb-6">
        <div class="p-6 md:p-8">
            <div class="flex items-center gap-3 mb-6">
                <div class="w-12 h-12 bg-primary/10 rounded-xl flex items-center justify-center">
                    <i data-lucide="user" class="w-6 h-6 text-primary"></i>
                </div>
                <div>
                    <h3 class="font-bold text-xl text-foreground">Profile Information</h3>
                    <p class="text-secondary">Update your account details and photo</p>
                </div>
            </div>

            <form method="post" action="{{ route('profile.update') }}" enctype="multipart/form-data">
                @csrf
                @method('patch')
                
                <!-- Profile Photo -->
                <div class="flex flex-col sm:flex-row items-center gap-6 mb-8 pb-8 border-b border-border">
                    <div class="relative">
                        @if($user->profile_photo)
                            <img src="{{ asset($user->profile_photo) }}" alt="Profile" class="w-24 h-24 rounded-full object-cover ring-4 ring-border">
                        @else
                            <div class="w-24 h-24 rounded-full bg-primary flex items-center justify-center ring-4 ring-border">
                                <span class="text-white font-bold text-2xl">{{ substr($user->name, 0, 2) }}</span>
                            </div>
                        @endif
                        <label for="profile_photo" class="absolute bottom-0 right-0 w-8 h-8 bg-primary rounded-full flex items-center justify-center cursor-pointer shadow-lg hover:bg-primary-hover transition-all duration-300">
                            <i data-lucide="camera" class="w-4 h-4 text-white"></i>
                        </label>
                    </div>
                    <div class="text-center sm:text-left">
                        <h4 class="font-semibold text-foreground mb-1">Profile Photo</h4>
                        <p class="text-sm text-secondary mb-2">JPG, PNG or WebP. Max 2MB</p>
                        <input type="file" name="profile_photo" id="profile_photo" accept="image/jpeg,image/png,image/webp" class="hidden" onchange="previewPhoto(this)">
                        <label for="profile_photo" class="inline-flex items-center gap-2 px-4 py-2 text-sm font-medium text-primary ring-1 ring-primary rounded-full cursor-pointer hover:bg-primary/10 transition-all duration-300">
                            <i data-lucide="upload" class="w-4 h-4"></i>
                            <span>Change Photo</span>
                        </label>
                        @error('profile_photo')<span class="block text-error text-sm mt-1">{{ $message }}</span>@enderror
                    </div>
                </div>

                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    <div class="space-y-2">
                        <label class="block text-sm font-medium text-foreground">Full Name</label>
                        <input type="text" name="name" value="{{ old('name', $user->name) }}" class="w-full px-4 py-3 rounded-2xl ring-1 ring-border focus:ring-2 focus:ring-primary outline-none transition-all duration-300" required>
                        @error('name')<span class="text-error text-sm">{{ $message }}</span>@enderror
                    </div>
                    <div class="space-y-2">
                        <label class="block text-sm font-medium text-foreground">Email Address</label>
                        <input type="email" name="email" value="{{ old('email', $user->email) }}" class="w-full px-4 py-3 rounded-2xl ring-1 ring-border focus:ring-2 focus:ring-primary outline-none transition-all duration-300" required>
                        @error('email')<span class="text-error text-sm">{{ $message }}</span>@enderror
                    </div>
                    <div class="space-y-2">
                        <label class="block text-sm font-medium text-foreground">Phone Number</label>
                        <input type="tel" name="phone" value="{{ old('phone', $user->phone) }}" class="w-full px-4 py-3 rounded-2xl ring-1 ring-border focus:ring-2 focus:ring-primary outline-none transition-all duration-300" placeholder="+62 812 3456 7890">
                    </div>
                    <div class="space-y-2">
                        <label class="block text-sm font-medium text-foreground">Role</label>
                        <input type="text" value="{{ ucfirst($user->role) }}" class="w-full px-4 py-3 rounded-2xl ring-1 ring-border bg-muted text-secondary cursor-not-allowed" disabled>
                    </div>
                </div>

                <div class="flex justify-end mt-6">
                    <button type="submit" class="flex items-center gap-2 px-8 py-3 bg-primary text-white rounded-full font-semibold hover:bg-primary-hover transition-all duration-300 cursor-pointer">
                        <i data-lucide="save" class="w-5 h-5"></i>
                        <span>Save Changes</span>
                    </button>
                </div>
            </form>
        </div>
    </div>

    <!-- Update Password -->
    <div class="flex flex-col rounded-2xl border border-border bg-white overflow-hidden mb-6">
        <div class="p-6 md:p-8">
            <div class="flex items-center gap-3 mb-6">
                <div class="w-12 h-12 bg-warning-light rounded-xl flex items-center justify-center">
                    <i data-lucide="key" class="w-6 h-6 text-warning-dark"></i>
                </div>
                <div>
                    <h3 class="font-bold text-xl text-foreground">Update Password</h3>
                    <p class="text-secondary">Ensure your account uses a secure password</p>
                </div>
            </div>

            <form method="post" action="{{ route('password.update') }}">
                @csrf
                @method('put')
                
                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    <div class="space-y-2 md:col-span-2">
                        <label class="block text-sm font-medium text-foreground">Current Password</label>
                        <input type="password" name="current_password" class="w-full px-4 py-3 rounded-2xl ring-1 ring-border focus:ring-2 focus:ring-primary outline-none transition-all duration-300">
                        @error('current_password', 'updatePassword')<span class="text-error text-sm">{{ $message }}</span>@enderror
                    </div>
                    <div class="space-y-2">
                        <label class="block text-sm font-medium text-foreground">New Password</label>
                        <input type="password" name="password" class="w-full px-4 py-3 rounded-2xl ring-1 ring-border focus:ring-2 focus:ring-primary outline-none transition-all duration-300">
                        @error('password', 'updatePassword')<span class="text-error text-sm">{{ $message }}</span>@enderror
                    </div>
                    <div class="space-y-2">
                        <label class="block text-sm font-medium text-foreground">Confirm New Password</label>
                        <input type="password" name="password_confirmation" class="w-full px-4 py-3 rounded-2xl ring-1 ring-border focus:ring-2 focus:ring-primary outline-none transition-all duration-300">
                    </div>
                </div>

                <div class="flex justify-end mt-6">
                    <button type="submit" class="flex items-center gap-2 px-8 py-3 bg-warning text-foreground rounded-full font-semibold hover:bg-warning-dark hover:text-white transition-all duration-300 cursor-pointer">
                        <i data-lucide="key" class="w-5 h-5"></i>
                        <span>Update Password</span>
                    </button>
                </div>
            </form>
        </div>
    </div>

    <!-- Delete Account -->
    <div class="flex flex-col rounded-2xl border border-error-light bg-error-lighter overflow-hidden">
        <div class="p-6 md:p-8">
            <div class="flex items-center gap-3 mb-6">
                <div class="w-12 h-12 bg-error-light rounded-xl flex items-center justify-center">
                    <i data-lucide="trash-2" class="w-6 h-6 text-error"></i>
                </div>
                <div>
                    <h3 class="font-bold text-xl text-foreground">Delete Account</h3>
                    <p class="text-secondary">Permanently delete your account and all data</p>
                </div>
            </div>

            <p class="text-secondary mb-6">Once your account is deleted, all of its resources and data will be permanently deleted. Please enter your password to confirm.</p>

            <button onclick="showDeleteModal()" class="flex items-center gap-2 px-8 py-3 bg-error text-white rounded-full font-semibold hover:bg-error-dark transition-all duration-300 cursor-pointer">
                <i data-lucide="trash-2" class="w-5 h-5"></i>
                <span>Delete Account</span>
            </button>
        </div>
    </div>
</div>

<!-- Delete Account Modal -->
<div id="deleteModal" class="fixed inset-0 bg-black/50 z-[100] hidden items-center justify-center p-4">
    <div class="bg-white rounded-2xl max-w-md w-full p-6">
        <h3 class="text-xl font-bold text-foreground mb-4">Are you sure?</h3>
        <p class="text-secondary mb-6">This action cannot be undone. All your data will be permanently deleted.</p>
        
        <form method="post" action="{{ route('profile.destroy') }}">
            @csrf
            @method('delete')
            
            <div class="space-y-2 mb-6">
                <label class="block text-sm font-medium text-foreground">Enter your password to confirm</label>
                <input type="password" name="password" class="w-full px-4 py-3 rounded-2xl ring-1 ring-border focus:ring-2 focus:ring-primary outline-none transition-all duration-300" required>
            </div>
            
            <div class="flex justify-end gap-3">
                <button type="button" onclick="hideDeleteModal()" class="px-6 py-3 ring-1 ring-border hover:ring-primary rounded-full font-semibold transition-all duration-300">Cancel</button>
                <button type="submit" class="px-6 py-3 bg-error text-white rounded-full font-semibold hover:bg-error-dark transition-all duration-300">Delete Account</button>
            </div>
        </form>
    </div>
</div>

@push('scripts')
<script>
function showDeleteModal() {
    document.getElementById('deleteModal').classList.remove('hidden');
    document.getElementById('deleteModal').classList.add('flex');
}
function hideDeleteModal() {
    document.getElementById('deleteModal').classList.add('hidden');
    document.getElementById('deleteModal').classList.remove('flex');
}
function previewPhoto(input) {
    if (input.files && input.files[0]) {
        // Update the preview after form submit
        const formData = new FormData(input.form);
        // You could add instant preview here if needed
    }
}
</script>
@endpush
@endsection
