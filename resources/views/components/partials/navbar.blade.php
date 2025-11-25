<!-- Header -->
<header class="bg-white shadow-sm border-b border-gray-200">
    <div class="flex items-center justify-between p-4">
        <div class="flex items-center space-x-4">
            <button id="menuToggle" class="text-gray-500 hover:text-gray-700 md:hidden">
                <i class="fas fa-bars fa-lg"></i>
            </button>
            <h1 class="text-xl font-semibold text-gray-800">@yield('page-title', 'Dashboard')</h1>
        </div>
        
        <div class="flex items-center space-x-4">
            <!-- Notifications -->
            <div class="relative">
                <button class="text-gray-500 hover:text-blue-600 relative">
                    <i class="fas fa-bell fa-lg"></i>
                    <span class="absolute -top-1 -right-1 w-4 h-4 bg-red-500 text-white text-xs rounded-full flex items-center justify-center">
                        @auth
                            {{ Auth::user()->getPendingApprovalsCount() > 0 ? Auth::user()->getPendingApprovalsCount() : '0' }}
                        @else
                            0
                        @endauth
                    </span>
                </button>
            </div>
            
            <div class="hidden md:flex items-center space-x-4">
                @auth
                    @if(Auth::user()->isAdmin())
                        <a href="{{ route('admin.employees.create') }}" class="bg-blue-600 text-white px-4 py-2 rounded-lg hover:bg-blue-700 transition duration-200 text-sm font-medium flex items-center">
                            <i class="fas fa-plus mr-2"></i>New Employee
                        </a>
                    @elseif(Auth::user()->isHead())
                        <a href="{{ route('head.leaves.pending') }}" class="bg-blue-600 text-white px-4 py-2 rounded-lg hover:bg-blue-700 transition duration-200 text-sm font-medium flex items-center">
                            <i class="fas fa-clock mr-2"></i>Pending Approvals
                            @if(Auth::user()->getPendingApprovalsCount() > 0)
                                <span class="ml-2 bg-red-500 text-white text-xs px-2 py-1 rounded-full">
                                    {{ Auth::user()->getPendingApprovalsCount() }}
                                </span>
                            @endif
                        </a>
                    @else
                        <a href="{{ route('employee.leave.create') }}" class="bg-blue-600 text-white px-4 py-2 rounded-lg hover:bg-blue-700 transition duration-200 text-sm font-medium flex items-center">
                            <i class="fas fa-plus mr-2"></i>Apply Leave
                        </a>
                    @endif
                @endauth
    
                <!-- User Profile Dropdown -->
                <div class="relative" x-data="{ open: false }">
                    <button 
                        @click="open = !open"
                        class="flex items-center space-x-3 p-2 rounded-lg hover:bg-gray-100 transition duration-200"
                    >
                        <!-- Profile Picture in Header -->
                        <div class="relative">
                            @auth
                                @if(Auth::user()->profile_picture && Storage::disk('public')->exists(Auth::user()->profile_picture))
                                    <div class="w-8 h-8 bg-blue-100 rounded-full flex items-center justify-center border-2 border-white shadow-sm overflow-hidden">
                                        <img src="{{ Storage::url(Auth::user()->profile_picture) }}" 
                                             alt="Profile Picture" 
                                             class="w-full h-full object-cover">
                                    </div>
                                @else
                                    <div class="w-8 h-8 bg-blue-600 rounded-full flex items-center justify-center border-2 border-white shadow-sm">
                                        <span class="text-white font-semibold text-xs">
                                            {{ strtoupper(substr(Auth::user()->first_name, 0, 1)) }}{{ strtoupper(substr(Auth::user()->last_name, 0, 1)) }}
                                        </span>
                                    </div>
                                @endif
                            @endauth
                        </div>
                        <div class="hidden lg:block text-left">
                            <p class="text-sm font-medium text-gray-800">
                                @auth
                                    {{ Auth::user()->first_name }} {{ Auth::user()->last_name }}
                                @endauth
                            </p>
                            <p class="text-xs text-gray-500">
                                @auth
                                    @if(Auth::user()->isAdmin())
                                        System Administrator
                                    @elseif(Auth::user()->isHead())
                                        {{ Auth::user()->department->name ?? 'Department Head' }}
                                    @else
                                        {{ Auth::user()->department->name ?? 'Employee' }}
                                    @endif
                                @endauth
                            </p>
                        </div>
                        <i class="fas fa-chevron-down text-gray-400 text-xs transition-transform duration-200" 
                           :class="{ 'transform rotate-180': open }"></i>
                    </button>

                    <!-- Dropdown Menu -->
                    <div 
                        x-show="open" 
                        @click.away="open = false"
                        x-transition:enter="transition ease-out duration-200"
                        x-transition:enter-start="opacity-0 scale-95"
                        x-transition:enter-end="opacity-100 scale-100"
                        x-transition:leave="transition ease-in duration-150"
                        x-transition:leave-start="opacity-100 scale-100"
                        x-transition:leave-end="opacity-0 scale-95"
                        class="absolute right-0 mt-2 w-64 bg-white rounded-xl shadow-lg border border-gray-200 py-2 z-50"
                        style="display: none;"
                    >
                        <!-- User Info in Dropdown -->
                        <div class="px-4 py-3 border-b border-gray-100">
                            <div class="flex items-center space-x-3">
                                <!-- Profile Picture in Dropdown -->
                                <div class="relative">
                                    @auth
                                        @if(Auth::user()->profile_picture && Storage::disk('public')->exists(Auth::user()->profile_picture))
                                            <div class="w-12 h-12 bg-blue-100 rounded-full flex items-center justify-center border-2 border-white shadow-md overflow-hidden">
                                                <img src="{{ Storage::url(Auth::user()->profile_picture) }}" 
                                                     alt="Profile Picture" 
                                                     class="w-full h-full object-cover">
                                            </div>
                                        @else
                                            <div class="w-12 h-12 bg-blue-600 rounded-full flex items-center justify-center border-2 border-white shadow-md">
                                                <span class="text-white font-semibold text-base">
                                                    {{ strtoupper(substr(Auth::user()->first_name, 0, 1)) }}{{ strtoupper(substr(Auth::user()->last_name, 0, 1)) }}
                                                </span>
                                            </div>
                                        @endif
                                    @endauth
                                </div>
                                <div class="flex-1 min-w-0">
                                    <p class="text-sm font-medium text-gray-800 truncate">
                                        @auth
                                            {{ Auth::user()->first_name }} {{ Auth::user()->last_name }}
                                        @endauth
                                    </p>
                                    <p class="text-xs text-gray-500 truncate">
                                        @auth
                                            @if(Auth::user()->isAdmin())
                                                System Administrator
                                            @elseif(Auth::user()->isHead())
                                                {{ Auth::user()->department->name ?? 'Department Head' }}
                                            @else
                                                {{ Auth::user()->department->name ?? 'Employee' }}
                                            @endif
                                        @endauth
                                    </p>
                                    <p class="text-xs text-blue-600 font-medium truncate">
                                        @auth
                                            {{ Auth::user()->getRoleName() }}
                                        @endauth
                                    </p>
                                </div>
                            </div>
                        </div>

                        <!-- Dropdown Links -->
                        <div class="py-2">
                            <a href="@auth
                                        @if(Auth::user()->isAdmin())
                                            {{ route('admin.dashboard') }}
                                        @elseif(Auth::user()->isHead())
                                            {{ route('head.dashboard') }}
                                        @else
                                            {{ route('employee.dashboard') }}
                                        @endif
                                    @endauth" 
                               class="flex items-center space-x-3 px-4 py-2 text-sm text-gray-700 hover:bg-gray-50 transition duration-150">
                                <i class="fas fa-tachometer-alt w-5 text-gray-400"></i>
                                <span>Dashboard</span>
                            </a>
                            
                            <a href="{{ route('users.profile') }}" 
                               class="flex items-center space-x-3 px-4 py-2 text-sm text-gray-700 hover:bg-gray-50 transition duration-150">
                                <i class="fas fa-user w-5 text-gray-400"></i>
                                <span>My Profile</span>
                            </a>

                            <a href="{{ route('users.edit-profile') }}" 
                               class="flex items-center space-x-3 px-4 py-2 text-sm text-gray-700 hover:bg-gray-50 transition duration-150">
                                <i class="fas fa-edit w-5 text-gray-400"></i>
                                <span>Edit Profile</span>
                            </a>
                            
                            <a href="@auth
                                        @if(Auth::user()->isAdmin())
                                            {{ route('admin.leaves.history') }}
                                        @elseif(Auth::user()->isHead())
                                            {{ route('head.leaves.history') }}
                                        @else
                                            {{ route('employee.leave.history') }}
                                        @endif
                                    @endauth" 
                               class="flex items-center space-x-3 px-4 py-2 text-sm text-gray-700 hover:bg-gray-50 transition duration-150">
                                <i class="fas fa-history w-5 text-gray-400"></i>
                                <span>Leave History</span>
                            </a>
                            
                            @if(Auth::user()->isAdmin() || Auth::user()->isHead())
                                <a href="@auth
                                            @if(Auth::user()->isAdmin())
                                                {{ route('admin.reports') }}
                                            @else
                                                {{ route('head.reports') }}
                                            @endif
                                        @endauth" 
                                   class="flex items-center space-x-3 px-4 py-2 text-sm text-gray-700 hover:bg-gray-50 transition duration-150">
                                    <i class="fas fa-chart-bar w-5 text-gray-400"></i>
                                    <span>Reports & Analytics</span>
                                </a>
                            @endif
                            
                            <a href="#" 
                               class="flex items-center space-x-3 px-4 py-2 text-sm text-gray-700 hover:bg-gray-50 transition duration-150">
                                <i class="fas fa-cog w-5 text-gray-400"></i>
                                <span>Settings</span>
                            </a>
                        </div>

                        <!-- Logout Section -->
                        <div class="border-t border-gray-100 pt-2">
                            <button type="button" 
                                    data-logout-button
                                    class="flex items-center space-x-3 px-4 py-2 text-sm text-red-600 hover:bg-red-50 transition duration-150 w-full text-left">
                                <i class="fas fa-sign-out-alt w-5"></i>
                                <span>Logout</span>
                            </button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</header>