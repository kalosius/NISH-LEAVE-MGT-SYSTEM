@extends('layouts.app')

@section('title', 'My Profile - Nish Auto Limited')
@section('page-title', 'My Profile')

@php
    $isAdmin = Auth::user()->isAdmin();
@endphp

@section('content')
<div class="max-w-6xl mx-auto space-y-6">
    <!-- Profile Header -->
    <div class="bg-white rounded-xl shadow-sm border border-gray-200 p-6">
        <div class="flex flex-col lg:flex-row lg:items-center lg:justify-between gap-6">
            <div class="flex items-center space-x-6">
                <!-- Profile Picture -->
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
                
                <!-- User Info -->
                <div class="flex-1">
                    <h1 class="text-2xl font-bold text-gray-800">{{ $user->first_name }} {{ $user->last_name }}</h1>
                    <p class="text-gray-600 mt-1">{{ $user->getRoleName() }}</p>
                    <div class="flex flex-wrap gap-4 mt-3">
                        <div class="flex items-center space-x-2 text-sm text-gray-500">
                            <i class="fas fa-id-card"></i>
                            <span>EMP: {{ $user->employee_id ?? 'N/A' }}</span>
                        </div>
                        <div class="flex items-center space-x-2 text-sm text-gray-500">
                            <i class="fas fa-building"></i>
                            <span>{{ $user->department->name ?? 'No Department' }}</span>
                        </div>
                        <div class="flex items-center space-x-2 text-sm text-gray-500">
                            <i class="fas fa-calendar-alt"></i>
                            <span>Joined: {{ $user->join_date ? $user->join_date->format('M d, Y') : $user->created_at->format('M d, Y') }}</span>
                        </div>
                    </div>
                </div>
            </div>
            
            <!-- Edit Button -->
            <a href="{{ route('users.edit-profile') }}" class="inline-flex items-center space-x-2 bg-blue-600 hover:bg-blue-700 text-white px-6 py-3 rounded-lg transition duration-200 font-medium">
                <i class="fas fa-edit"></i>
                <span>Edit Profile</span>
            </a>
        </div>
    </div>

    <div class="grid grid-cols-1 lg:grid-cols-4 gap-6">
        <!-- Left Column - Personal Information -->
        <div class="lg:col-span-3 space-y-6">
            <!-- Personal Information -->
            <div class="bg-white rounded-xl shadow-sm border border-gray-200 p-6">
                <div class="flex items-center justify-between mb-6">
                    <h3 class="text-lg font-semibold text-gray-800 flex items-center space-x-2">
                        <i class="fas fa-user-circle text-blue-600"></i>
                        <span>Personal Information</span>
                    </h3>
                    <a href="{{ route('users.edit-profile') }}" class="text-blue-600 hover:text-blue-500 text-sm font-medium flex items-center space-x-2">
                        <i class="fas fa-edit"></i>
                        <span>Edit</span>
                    </a>
                </div>
                
                <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                    <div class="space-y-1">
                        <label class="block text-sm font-medium text-gray-700">Full Name</label>
                        <div class="flex items-center space-x-3 p-3 bg-gray-50 rounded-lg border border-gray-200">
                            <i class="fas fa-user text-gray-400"></i>
                            <span class="text-gray-800 font-medium">{{ $user->first_name }} {{ $user->last_name }}</span>
                        </div>
                    </div>
                    
                    <div class="space-y-1">
                        <label class="block text-sm font-medium text-gray-700">Date of Birth</label>
                        <div class="flex items-center space-x-3 p-3 bg-gray-50 rounded-lg border border-gray-200">
                            <i class="fas fa-birthday-cake text-gray-400"></i>
                            <span class="text-gray-800">
                                {{ $user->date_of_birth ? $user->date_of_birth->format('F d, Y') : 'Not set' }}
                            </span>
                        </div>
                    </div>
                    
                    <div class="space-y-1">
                        <label class="block text-sm font-medium text-gray-700">Gender</label>
                        <div class="flex items-center space-x-3 p-3 bg-gray-50 rounded-lg border border-gray-200">
                            <i class="fas fa-venus-mars text-gray-400"></i>
                            <span class="text-gray-800 capitalize">{{ $user->gender ?? 'Not set' }}</span>
                        </div>
                    </div>
                    
                    <div class="space-y-1">
                        <label class="block text-sm font-medium text-gray-700">Phone Number</label>
                        <div class="flex items-center space-x-3 p-3 bg-gray-50 rounded-lg border border-gray-200">
                            <i class="fas fa-phone text-gray-400"></i>
                            <span class="text-gray-800">{{ $user->phone ?? 'Not set' }}</span>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Contact Information -->
            <div class="bg-white rounded-xl shadow-sm border border-gray-200 p-6">
                <div class="flex items-center justify-between mb-6">
                    <h3 class="text-lg font-semibold text-gray-800 flex items-center space-x-2">
                        <i class="fas fa-address-book text-green-600"></i>
                        <span>Contact Information</span>
                    </h3>
                    <a href="{{ route('users.edit-profile') }}" class="text-blue-600 hover:text-blue-500 text-sm font-medium flex items-center space-x-2">
                        <i class="fas fa-edit"></i>
                        <span>Edit</span>
                    </a>
                </div>
                
                <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                    <div class="space-y-1">
                        <label class="block text-sm font-medium text-gray-700">Email Address</label>
                        <div class="flex items-center justify-between p-3 bg-gray-50 rounded-lg border border-gray-200">
                            <div class="flex items-center space-x-3">
                                <i class="fas fa-envelope text-blue-600"></i>
                                <span class="text-gray-800">{{ $user->email }}</span>
                            </div>
                            <span class="px-2 py-1 bg-green-100 text-green-800 text-xs rounded-full font-medium">Verified</span>
                        </div>
                    </div>
                    
                    <div class="space-y-1">
                        <label class="block text-sm font-medium text-gray-700">Phone Number</label>
                        <div class="flex items-center justify-between p-3 bg-gray-50 rounded-lg border border-gray-200">
                            <div class="flex items-center space-x-3">
                                <i class="fas fa-phone text-green-600"></i>
                                <span class="text-gray-800">{{ $user->phone ?? 'Not set' }}</span>
                            </div>
                            <span class="px-2 py-1 {{ $user->phone ? 'bg-green-100 text-green-800' : 'bg-gray-100 text-gray-800' }} text-xs rounded-full font-medium">
                                {{ $user->phone ? 'Verified' : 'Not set' }}
                            </span>
                        </div>
                    </div>
                    
                    <div class="space-y-1 md:col-span-2">
                        <label class="block text-sm font-medium text-gray-700">Address</label>
                        <div class="flex items-center space-x-3 p-3 bg-gray-50 rounded-lg border border-gray-200">
                            <i class="fas fa-map-marker-alt text-purple-600"></i>
                            <span class="text-gray-800">{{ $user->address ?? 'Not set' }}</span>
                        </div>
                    </div>
                    
                    <div class="space-y-1 md:col-span-2">
                        <label class="block text-sm font-medium text-gray-700">Emergency Contact</label>
                        <div class="flex items-center space-x-3 p-3 bg-gray-50 rounded-lg border border-gray-200">
                            <i class="fas fa-phone-alt text-red-600"></i>
                            <span class="text-gray-800">{{ $user->emergency_contact ?? 'Not set' }}</span>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Employment Details -->
            <div class="bg-white rounded-xl shadow-sm border border-gray-200 p-6">
                <div class="flex items-center justify-between mb-6">
                    <h3 class="text-lg font-semibold text-gray-800 flex items-center space-x-2">
                        <i class="fas fa-briefcase text-orange-600"></i>
                        <span>Employment Details</span>
                    </h3>
                    @if($isAdmin)
                    <a href="{{ route('admin.employees') }}" class="text-blue-600 hover:text-blue-500 text-sm font-medium flex items-center space-x-2">
                        <i class="fas fa-edit"></i>
                        <span>Edit</span>
                    </a>
                    @endif
                </div>
                
                <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-4">
                    <div class="space-y-1">
                        <label class="block text-sm font-medium text-gray-700">Employee ID</label>
                        <div class="flex items-center space-x-3 p-3 bg-gray-50 rounded-lg border border-gray-200">
                            <i class="fas fa-id-badge text-gray-400"></i>
                            <span class="text-gray-800 font-mono font-medium">{{ $user->employee_id ?? 'N/A' }}</span>
                        </div>
                    </div>
                    
                    <div class="space-y-1">
                        <label class="block text-sm font-medium text-gray-700">Department</label>
                        <div class="flex items-center space-x-3 p-3 bg-gray-50 rounded-lg border border-gray-200">
                            <i class="fas fa-building text-gray-400"></i>
                            <span class="text-gray-800">{{ $user->department->name ?? 'No Department' }}</span>
                        </div>
                    </div>
                    
                    <div class="space-y-1">
                        <label class="block text-sm font-medium text-gray-700">Position</label>
                        <div class="flex items-center space-x-3 p-3 bg-gray-50 rounded-lg border border-gray-200">
                            <i class="fas fa-briefcase text-gray-400"></i>
                            <span class="text-gray-800">{{ $user->getRoleName() }}</span>
                        </div>
                    </div>
                    
                    <div class="space-y-1">
                        <label class="block text-sm font-medium text-gray-700">Employment Type</label>
                        <div class="flex items-center space-x-3 p-3 bg-gray-50 rounded-lg border border-gray-200">
                            <i class="fas fa-clock text-gray-400"></i>
                            <span class="text-gray-800 capitalize">{{ str_replace('_', ' ', $user->employment_type) }}</span>
                        </div>
                    </div>
                    
                    <div class="space-y-1">
                        <label class="block text-sm font-medium text-gray-700">Join Date</label>
                        <div class="flex items-center space-x-3 p-3 bg-gray-50 rounded-lg border border-gray-200">
                            <i class="fas fa-calendar-plus text-gray-400"></i>
                            <span class="text-gray-800">{{ $user->join_date ? $user->join_date->format('F d, Y') : $user->created_at->format('F d, Y') }}</span>
                        </div>
                    </div>
                    
                    <div class="space-y-1">
                        <label class="block text-sm font-medium text-gray-700">Supervisor</label>
                        <div class="flex items-center space-x-3 p-3 bg-gray-50 rounded-lg border border-gray-200">
                            <i class="fas fa-user-tie text-gray-400"></i>
                            <span class="text-gray-800">
                                @if($user->supervisor)
                                    {{ $user->supervisor->first_name }} {{ $user->supervisor->last_name }}
                                @else
                                    Not assigned
                                @endif
                            </span>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Right Column - Actions -->
        <div class="space-y-6">
            <!-- Quick Actions -->
            <div class="bg-white rounded-xl shadow-sm border border-gray-200 p-6">
                <h3 class="text-lg font-semibold text-gray-800 mb-4 flex items-center space-x-2">
                    <i class="fas fa-bolt text-yellow-600"></i>
                    <span>Quick Actions</span>
                </h3>
                <div class="space-y-3">
                    <a href="{{ route('employee.leave.create') }}" class="w-full flex items-center justify-between p-3 border border-gray-200 rounded-lg hover:bg-green-50 hover:border-green-200 transition duration-200 group">
                        <div class="flex items-center space-x-3">
                            <i class="fas fa-calendar-plus text-green-600 group-hover:text-green-700"></i>
                            <span class="font-medium text-gray-700">Apply Leave</span>
                        </div>
                        <i class="fas fa-chevron-right text-gray-400 group-hover:text-green-600"></i>
                    </a>
                    
                    <a href="{{ route('employee.leave.history') }}" class="w-full flex items-center justify-between p-3 border border-gray-200 rounded-lg hover:bg-blue-50 hover:border-blue-200 transition duration-200 group">
                        <div class="flex items-center space-x-3">
                            <i class="fas fa-history text-blue-600 group-hover:text-blue-700"></i>
                            <span class="font-medium text-gray-700">Leave History</span>
                        </div>
                        <i class="fas fa-chevron-right text-gray-400 group-hover:text-blue-600"></i>
                    </a>
                    
                    <a href="{{ route('employee.team.calendar') }}" class="w-full flex items-center justify-between p-3 border border-gray-200 rounded-lg hover:bg-purple-50 hover:border-purple-200 transition duration-200 group">
                        <div class="flex items-center space-x-3">
                            <i class="fas fa-calendar-alt text-purple-600 group-hover:text-purple-700"></i>
                            <span class="font-medium text-gray-700">Team Calendar</span>
                        </div>
                        <i class="fas fa-chevron-right text-gray-400 group-hover:text-purple-600"></i>
                    </a>
                </div>
            </div>

            <!-- Security Settings -->
            <div class="bg-white rounded-xl shadow-sm border border-gray-200 p-6">
                <h3 class="text-lg font-semibold text-gray-800 mb-4 flex items-center space-x-2">
                    <i class="fas fa-shield-alt text-red-600"></i>
                    <span>Security</span>
                </h3>
                <div class="space-y-3">
                    <a href="{{ route('password.change') }}" class="w-full flex items-center justify-between p-3 border border-gray-200 rounded-lg hover:bg-blue-50 hover:border-blue-200 transition duration-200 group">
                        <div class="flex items-center space-x-3">
                            <i class="fas fa-lock text-blue-600 group-hover:text-blue-700"></i>
                            <span class="font-medium text-gray-700">Change Password</span>
                        </div>
                        <i class="fas fa-chevron-right text-gray-400 group-hover:text-blue-600"></i>
                    </a>
                    
                    <a href="#" class="w-full flex items-center justify-between p-3 border border-gray-200 rounded-lg hover:bg-purple-50 hover:border-purple-200 transition duration-200 group">
                        <div class="flex items-center space-x-3">
                            <i class="fas fa-history text-purple-600 group-hover:text-purple-700"></i>
                            <span class="font-medium text-gray-700">Login History</span>
                        </div>
                        <i class="fas fa-chevron-right text-gray-400 group-hover:text-purple-600"></i>
                    </a>
                </div>
            </div>

            <!-- Status & Stats -->
            <div class="bg-gradient-to-br from-blue-500 to-blue-600 rounded-xl shadow-sm p-6 text-white">
                <h3 class="text-lg font-semibold mb-4">Account Status</h3>
                <div class="space-y-3">
                    <div class="flex items-center justify-between">
                        <span class="text-blue-100">Status</span>
                        <span class="px-2 py-1 bg-green-400 text-white text-xs rounded-full font-medium">Active</span>
                    </div>
                    <div class="flex items-center justify-between">
                        <span class="text-blue-100">Last Login</span>
                        <span class="text-sm">{{ $user->last_login_at ? $user->last_login_at->diffForHumans() : 'Never' }}</span>
                    </div>
                    <div class="flex items-center justify-between">
                        <span class="text-blue-100">Member Since</span>
                        <span class="text-sm">{{ $user->created_at->format('M Y') }}</span>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@push('styles')
<style>
    .profile-section {
        transition: all 0.3s ease;
    }
    
    .profile-section:hover {
        transform: translateY(-2px);
        box-shadow: 0 8px 25px -5px rgba(0, 0, 0, 0.1);
    }
</style>
@endpush

@push('scripts')
<script>
    document.addEventListener('DOMContentLoaded', function() {
        // Smooth hover effects for cards
        const profileSections = document.querySelectorAll('.bg-white.rounded-xl');
        profileSections.forEach(section => {
            section.addEventListener('mouseenter', () => {
                section.style.transform = 'translateY(-2px)';
                section.style.boxShadow = '0 8px 25px -5px rgba(0, 0, 0, 0.1)';
            });
            
            section.addEventListener('mouseleave', () => {
                section.style.transform = 'translateY(0)';
                section.style.boxShadow = '0 1px 3px 0 rgba(0, 0, 0, 0.1)';
            });
        });
    });
</script>
@endpush