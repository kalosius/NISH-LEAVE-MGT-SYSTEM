@extends('layouts.app')

@section('title', 'Change Password - Nish Auto Limited')
@section('page-title', 'Change Password')

@section('content')
<div class="max-w-md mx-auto">
    <div class="bg-white rounded-xl shadow-sm border border-gray-200 p-6">
        <h2 class="text-xl font-bold text-gray-800 mb-2">Change Password</h2>
        <p class="text-gray-600 mb-6">Update your password to keep your account secure</p>

        @if ($errors->any())
            <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded mb-4">
                <ul class="list-disc list-inside">
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        @if (session('success'))
            <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded mb-4">
                {{ session('success') }}
            </div>
        @endif

        <form action="{{ route('password.update') }}" method="POST">
            @csrf
            
            <div class="space-y-4">
                <!-- Current Password -->
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-2">
                        Current Password <span class="text-red-500">*</span>
                    </label>
                    <input type="password" name="current_password" 
                           class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent transition duration-200"
                           required autocomplete="current-password">
                    @error('current_password')
                        <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                    @enderror
                </div>

                <!-- New Password -->
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-2">
                        New Password <span class="text-red-500">*</span>
                    </label>
                    <input type="password" name="new_password" 
                           class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent transition duration-200"
                           required autocomplete="new-password">
                    @error('new_password')
                        <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                    @enderror
                </div>

                <!-- Confirm New Password -->
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-2">
                        Confirm New Password <span class="text-red-500">*</span>
                    </label>
                    <input type="password" name="new_password_confirmation" 
                           class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent transition duration-200"
                           required autocomplete="new-password">
                </div>
            </div>

            <div class="flex space-x-3 mt-6">
                <a href="{{ route('users.profile') }}" 
                   class="flex-1 bg-gray-200 text-gray-800 px-4 py-3 rounded-lg hover:bg-gray-300 transition duration-200 font-medium text-center">
                    Cancel
                </a>
                <button type="submit" 
                        class="flex-1 bg-blue-600 text-white px-4 py-3 rounded-lg hover:bg-blue-700 transition duration-200 font-medium">
                    Update Password
                </button>
            </div>
        </form>
    </div>

    <!-- Password Requirements -->
    <div class="bg-blue-50 rounded-xl border border-blue-200 p-4 mt-4">
        <h3 class="text-sm font-semibold text-blue-800 mb-2">Password Requirements</h3>
        <ul class="text-xs text-blue-700 space-y-1">
            <li>• Minimum 8 characters long</li>
            <li>• Use a combination of letters, numbers, and symbols</li>
            <li>• Avoid using easily guessable information</li>
        </ul>
    </div>
</div>
@endsection