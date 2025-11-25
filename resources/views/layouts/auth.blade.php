<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Leave Management System - @yield('title', 'Authentication')</title>
    
    <!-- Tailwind CSS CDN -->
    <script src="https://cdn.tailwindcss.com"></script>
    
    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    
    <style>
        .auth-background {
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            min-height: 100vh;
        }
        
        .card-shadow {
            box-shadow: 0 20px 25px -5px rgba(0, 0, 0, 0.1), 0 10px 10px -5px rgba(0, 0, 0, 0.04);
        }
        
        .input-focus:focus {
            box-shadow: 0 0 0 3px rgba(102, 126, 234, 0.1);
            border-color: #667eea;
        }
        
        .auth-container {
            min-height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
            padding: 1rem;
        }
    </style>
</head>
<body class="auth-background">
    <div class="auth-container">
        <div class="w-full max-w-md">
           

            <!-- Auth Card -->
            <div class="bg-white rounded-2xl card-shadow p-8">
                <!-- Page Title -->
                <div class="text-center mb-8">
                    <h2 class="text-2xl font-bold text-gray-800">@yield('auth-title', 'Welcome Back')</h2>
                    <p class="text-gray-600 mt-2">@yield('auth-subtitle', 'Please sign in to your account')</p>
                </div>

                <!-- Flash Messages -->
                @if(session('success'))
                <div class="bg-green-50 border border-green-200 rounded-lg p-4 mb-6 flex items-start space-x-3">
                    <div class="flex-shrink-0">
                        <i class="fas fa-check-circle text-green-500 mt-0.5"></i>
                    </div>
                    <div class="flex-1">
                        <p class="text-green-800 text-sm">{{ session('success') }}</p>
                    </div>
                    <button class="flex-shrink-0 text-green-600 hover:text-green-800" onclick="this.parentElement.remove()">
                        <i class="fas fa-times"></i>
                    </button>
                </div>
                @endif

                @if(session('error'))
                <div class="bg-red-50 border border-red-200 rounded-lg p-4 mb-6 flex items-start space-x-3">
                    <div class="flex-shrink-0">
                        <i class="fas fa-exclamation-circle text-red-500 mt-0.5"></i>
                    </div>
                    <div class="flex-1">
                        <p class="text-red-800 text-sm">{{ session('error') }}</p>
                    </div>
                    <button class="flex-shrink-0 text-red-600 hover:text-red-800" onclick="this.parentElement.remove()">
                        <i class="fas fa-times"></i>
                    </button>
                </div>
                @endif

                @if($errors->any())
                <div class="bg-red-50 border border-red-200 rounded-lg p-4 mb-6">
                    <div class="flex items-start space-x-3">
                        <div class="flex-shrink-0">
                            <i class="fas fa-exclamation-triangle text-red-500 mt-0.5"></i>
                        </div>
                        <div class="flex-1">
                            <h4 class="text-red-800 font-medium mb-2">Please fix the following errors:</h4>
                            <ul class="text-red-700 text-sm list-disc list-inside space-y-1">
                                @foreach($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    </div>
                </div>
                @endif

                <!-- Main Content -->
                @yield('auth-content')

                <!-- Footer Links -->
                <div class="text-center mt-8 pt-6 border-t border-gray-200">
                    @yield('auth-links')
                </div>
            </div>

            <!-- Bottom Links -->
            <div class="text-center mt-6">
                @hasSection('bottom-links')
                    @yield('bottom-links')
                @else
                    <p class="text-white/70 text-sm">
                        &copy; {{ date('Y') }} Leave Management System. All rights reserved.
                    </p>
                @endif
            </div>
        </div>
    </div>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            // Auto-hide flash messages after 5 seconds
            setTimeout(() => {
                const flashMessages = document.querySelectorAll('.bg-green-50, .bg-red-50');
                flashMessages.forEach(message => {
                    message.style.opacity = '0';
                    message.style.transition = 'opacity 0.5s ease';
                    setTimeout(() => message.remove(), 500);
                });
            }, 5000);

            // Add focus styles to form inputs
            const inputs = document.querySelectorAll('input, select, textarea');
            inputs.forEach(input => {
                input.classList.add('input-focus');
                
                // Add dynamic label effects
                if (input.value) {
                    input.classList.add('has-value');
                }
                
                input.addEventListener('focus', function() {
                    this.parentElement.classList.add('focused');
                });
                
                input.addEventListener('blur', function() {
                    this.parentElement.classList.remove('focused');
                    if (this.value) {
                        this.classList.add('has-value');
                    } else {
                        this.classList.remove('has-value');
                    }
                });
            });
        });
    </script>

    @stack('scripts')
</body>
</html>