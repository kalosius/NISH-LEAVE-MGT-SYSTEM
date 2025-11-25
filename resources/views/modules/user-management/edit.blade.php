@extends('layouts.app')

@section('title', 'Edit Profile - Nish Auto Limited')
@section('page-title', 'Edit Profile')

@php
    $isAdmin = Auth::user()->isAdmin();
@endphp

@section('content')
<div class="max-w-4xl mx-auto space-y-6">
    <!-- Header Section -->
    <div class="bg-white rounded-xl shadow-sm border border-gray-200 p-6">
        <div class="flex flex-col lg:flex-row lg:items-center lg:justify-between gap-4">
            <div>
                <h2 class="text-2xl font-bold text-gray-800">Edit Profile</h2>
                <p class="text-gray-600 mt-1">Update your personal and contact information</p>
            </div>
            
            <div class="flex space-x-3">
                <a href="{{ route('users.profile') }}" class="bg-gray-200 text-gray-800 px-4 py-2 rounded-lg hover:bg-gray-300 transition duration-200 font-medium flex items-center space-x-2">
                    <i class="fas fa-arrow-left"></i>
                    <span>Back to Profile</span>
                </a>
            </div>
        </div>
    </div>

    <!-- Edit Form -->
    <form action="{{ route('users.update-profile') }}" method="POST" enctype="multipart/form-data">
        @csrf
        @method('PUT')
        
        <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">
            <!-- Left Column - Personal Information -->
            <div class="lg:col-span-2 space-y-6">
                <!-- Personal Information Card -->
                <div class="bg-white rounded-xl shadow-sm border border-gray-200 p-6">
                    <h3 class="text-lg font-semibold text-gray-800 mb-4 flex items-center space-x-2">
                        <i class="fas fa-user-circle text-blue-600"></i>
                        <span>Personal Information</span>
                    </h3>
                    
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                        <!-- First Name -->
                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-2">
                                First Name <span class="text-red-500">*</span>
                            </label>
                            <input type="text" name="first_name" class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent transition duration-200" 
                                   value="{{ old('first_name', $user->first_name) }}" required>
                            @error('first_name')
                                <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                            @enderror
                        </div>
                        
                        <!-- Last Name -->
                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-2">
                                Last Name <span class="text-red-500">*</span>
                            </label>
                            <input type="text" name="last_name" class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent transition duration-200" 
                                   value="{{ old('last_name', $user->last_name) }}" required>
                            @error('last_name')
                                <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                            @enderror
                        </div>
                        
                        <!-- Date of Birth -->
                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-2">
                                Date of Birth
                            </label>
                            <input type="date" name="date_of_birth" class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent transition duration-200" 
                                   value="{{ old('date_of_birth', $user->date_of_birth ? $user->date_of_birth->format('Y-m-d') : '') }}">
                            @error('date_of_birth')
                                <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                            @enderror
                        </div>
                        
                        <!-- Gender -->
                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-2">
                                Gender
                            </label>
                            <select name="gender" class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent transition duration-200">
                                <option value="">Select Gender</option>
                                <option value="male" {{ old('gender', $user->gender) == 'male' ? 'selected' : '' }}>Male</option>
                                <option value="female" {{ old('gender', $user->gender) == 'female' ? 'selected' : '' }}>Female</option>
                                <option value="other" {{ old('gender', $user->gender) == 'other' ? 'selected' : '' }}>Other</option>
                            </select>
                            @error('gender')
                                <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                            @enderror
                        </div>
                    </div>
                </div>

                <!-- Contact Information Card -->
                <div class="bg-white rounded-xl shadow-sm border border-gray-200 p-6">
                    <h3 class="text-lg font-semibold text-gray-800 mb-4 flex items-center space-x-2">
                        <i class="fas fa-address-book text-green-600"></i>
                        <span>Contact Information</span>
                    </h3>
                    
                    <div class="space-y-4">
                        <!-- Email -->
                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-2">
                                Email Address <span class="text-red-500">*</span>
                            </label>
                            <input type="email" name="email" class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent transition duration-200" 
                                   value="{{ old('email', $user->email) }}" required>
                            @error('email')
                                <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                            @enderror
                        </div>
                        
                        <!-- Phone -->
                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-2">
                                Phone Number
                            </label>
                            <input type="tel" name="phone" class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent transition duration-200" 
                                   value="{{ old('phone', $user->phone) }}">
                            @error('phone')
                                <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                            @enderror
                        </div>
                        
                        <!-- Address -->
                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-2">
                                Address
                            </label>
                            <textarea name="address" class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent transition duration-200" 
                                      rows="3" placeholder="Enter your full address">{{ old('address', $user->address) }}</textarea>
                            @error('address')
                                <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                            @enderror
                        </div>
                        
                        <!-- Emergency Contact -->
                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-2">
                                Emergency Contact
                            </label>
                            <input type="text" name="emergency_contact" class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent transition duration-200" 
                                   value="{{ old('emergency_contact', $user->emergency_contact) }}" placeholder="Name and phone number">
                            @error('emergency_contact')
                                <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                            @enderror
                        </div>
                    </div>
                </div>
            </div>

            <!-- Right Column - Profile Picture & Actions -->
            <div class="space-y-6">
                <!-- Profile Picture Card -->
                <div class="bg-white rounded-xl shadow-sm border border-gray-200 p-6">
                    <h3 class="text-lg font-semibold text-gray-800 mb-4">Profile Picture</h3>
                    
                    <div class="flex flex-col items-center space-y-4">
                        <div class="relative">
                             @if($user->profile_picture && Storage::disk('public')->exists($user->profile_picture))
                <div class="w-24 h-24 bg-blue-100 rounded-full flex items-center justify-center border-4 border-white shadow-lg overflow-hidden">
                    <img src="{{ Storage::url($user->profile_picture) }}" 
                         alt="Profile Picture" 
                         class="w-full h-full object-cover">
                </div>
            @else
                <div class="w-24 h-24 bg-blue-100 rounded-full flex items-center justify-center border-4 border-white shadow-lg">
                    <span class="text-2xl font-bold text-blue-600">
                        {{ substr($user->first_name, 0, 1) }}{{ substr($user->last_name, 0, 1) }}
                    </span>
                </div>
            @endif
                        </div>
                        
                        <div class="text-center w-full">
                            <input type="file" name="profile_picture" id="profile_picture_input" class="hidden" accept="image/jpeg,image/png,image/gif">
                            <button type="button" class="w-full bg-blue-600 text-white px-4 py-2 rounded-lg hover:bg-blue-700 transition duration-200 font-medium flex items-center justify-center space-x-2 profile-picture-upload">
                                <i class="fas fa-upload"></i>
                                <span>Change Photo</span>
                            </button>
                            <p class="text-xs text-gray-500 mt-2">JPG, PNG or GIF. Max 2MB</p>
                            @error('profile_picture')
                                <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                            @enderror
                            
                           
                        </div>
                    </div>
                </div>

                <!-- Actions Card -->
               <!-- Actions Card -->
<div class="bg-white rounded-xl shadow-sm border border-gray-200 p-6">
    <h3 class="text-lg font-semibold text-gray-800 mb-4">Actions</h3>
    
    <div class="space-y-3">
        <button type="submit" class="w-full bg-blue-600 text-white px-4 py-3 rounded-lg hover:bg-blue-700 transition duration-200 font-medium flex items-center justify-center space-x-2">
            <i class="fas fa-save"></i>
            <span>Save Changes</span>
        </button>
        
        <!-- Change Password Button -->
        <a href="{{ route('password.change') }}" class="w-full bg-green-600 text-white px-4 py-3 rounded-lg hover:bg-green-700 transition duration-200 font-medium flex items-center justify-center space-x-2">
            <i class="fas fa-key"></i>
            <span>Change Password</span>
        </a>
        
        <a href="{{ route('users.profile') }}" class="w-full bg-gray-200 text-gray-800 px-4 py-3 rounded-lg hover:bg-gray-300 transition duration-200 font-medium flex items-center justify-center space-x-2">
            <i class="fas fa-times"></i>
            <span>Cancel</span>
        </a>
    </div>
</div>

                <!-- Current Information -->
                <div class="bg-gray-50 rounded-xl shadow-sm border border-gray-200 p-6">
                    <h3 class="text-lg font-semibold text-gray-800 mb-4">Current Information</h3>
                    
                    <div class="space-y-3 text-sm">
                        <div class="flex justify-between">
                            <span class="text-gray-600">Employee ID:</span>
                            <span class="font-medium">{{ $user->employee_id }}</span>
                        </div>
                        <div class="flex justify-between">
                            <span class="text-gray-600">Department:</span>
                            <span class="font-medium">{{ $user->department->name ?? 'N/A' }}</span>
                        </div>
                        <div class="flex justify-between">
                            <span class="text-gray-600">Position:</span>
                            <span class="font-medium">{{ $user->getRoleName() }}</span>
                        </div>
                        <div class="flex justify-between">
                            <span class="text-gray-600">Join Date:</span>
                            <span class="font-medium">{{ $user->join_date ? $user->join_date->format('M d, Y') : $user->created_at->format('M d, Y') }}</span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </form>
</div>
@endsection

@push('styles')
<style>
    .form-section {
        transition: all 0.3s ease;
    }
    
    .form-input:focus {
        box-shadow: 0 0 0 3px rgba(59, 130, 246, 0.1);
    }
    
    .profile-picture-upload:hover {
        transform: scale(1.05);
    }
</style>
@endpush

@push('scripts')
<script>
    document.addEventListener('DOMContentLoaded', function() {
        const profilePictureInput = document.getElementById('profile_picture_input');
        const uploadButton = document.querySelector('.profile-picture-upload');
        const profilePreview = document.getElementById('profile-preview');
        const removePhotoButton = document.getElementById('remove-photo');

        // Handle upload button click
        if (uploadButton && profilePictureInput) {
            uploadButton.addEventListener('click', function() {
                profilePictureInput.click();
            });
        }

        // Handle file selection and preview
        if (profilePictureInput) {
            profilePictureInput.addEventListener('change', function(e) {
                const file = e.target.files[0];
                if (file) {
                    // Check file size (2MB limit)
                    if (file.size > 2 * 1024 * 1024) {
                        alert('File size must be less than 2MB');
                        this.value = '';
                        return;
                    }
                    
                    // Check file type
                    const validTypes = ['image/jpeg', 'image/png', 'image/gif'];
                    if (!validTypes.includes(file.type)) {
                        alert('Please select a valid image file (JPG, PNG, GIF)');
                        this.value = '';
                        return;
                    }
                    
                    // Preview image
                    const reader = new FileReader();
                    reader.onload = function(e) {
                        profilePreview.innerHTML = `<img src="${e.target.result}" class="w-full h-full rounded-full object-cover" alt="Profile Preview">`;
                    };
                    reader.readAsDataURL(file);
                }
            });
        }

        // Handle remove photo button
        if (removePhotoButton) {
            removePhotoButton.addEventListener('click', function() {
                if (confirm('Are you sure you want to remove your profile picture?')) {
                    // Create a hidden input to indicate photo removal
                    const removeInput = document.createElement('input');
                    removeInput.type = 'hidden';
                    removeInput.name = 'remove_profile_picture';
                    removeInput.value = '1';
                    document.querySelector('form').appendChild(removeInput);
                    
                    // Reset preview to initials
                    const initials = '{{ substr($user->first_name, 0, 1) }}{{ substr($user->last_name, 0, 1) }}';
                    profilePreview.innerHTML = `<div class="w-32 h-32 bg-blue-100 rounded-full flex items-center justify-center border-4 border-white shadow-lg">
                        <span class="text-3xl font-bold text-blue-600">${initials}</span>
                    </div>`;
                    
                    // Hide remove button
                    this.style.display = 'none';
                }
            });
        }

        // Add smooth transitions to form sections
        const formSections = document.querySelectorAll('.bg-white.rounded-xl');
        formSections.forEach(section => {
            section.addEventListener('mouseenter', function() {
                this.style.transform = 'translateY(-2px)';
                this.style.boxShadow = '0 10px 25px -5px rgba(0, 0, 0, 0.1)';
            });
            
            section.addEventListener('mouseleave', function() {
                this.style.transform = 'translateY(0)';
                this.style.boxShadow = '0 1px 3px 0 rgba(0, 0, 0, 0.1)';
            });
        });

        // Real-time validation for required fields
        const requiredFields = document.querySelectorAll('input[required]');
        requiredFields.forEach(field => {
            field.addEventListener('blur', function() {
                if (!this.value.trim()) {
                    this.classList.add('border-red-500');
                } else {
                    this.classList.remove('border-red-500');
                }
            });
        });
    });
</script>
@endpush