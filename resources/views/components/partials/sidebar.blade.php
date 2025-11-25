<!-- Sidebar -->
<div id="sidebar" class="sidebar-mobile bg-gradient-to-b from-blue-800 to-blue-900 text-white w-64 md:w-64 fixed md:relative inset-y-0 left-0 transform -translate-x-full md:translate-x-0 transition-transform duration-300 ease-in-out z-50 md:z-auto">
    <div class="flex flex-col h-full">
        <!-- Logo Section with Enhanced Design -->
        <div class="flex items-center justify-between p-6 border-b border-blue-700 bg-blue-900">
            <div class="flex items-center space-x-3">
                <div class="w-10 h-10 bg-white bg-opacity-20 rounded-xl flex items-center justify-center">
                    <i class="fas fa-car text-white text-lg"></i>
                </div>
                <div>
                    <span class="text-xl font-bold bg-gradient-to-r from-white to-blue-200 bg-clip-text text-transparent">Nish Auto</span>
                    <p class="text-xs text-blue-300 mt-1">Leave Management</p>
                </div>
            </div>
            <button id="closeSidebar" class="md:hidden text-white hover:bg-blue-700 w-8 h-8 rounded-lg flex items-center justify-center transition-colors">
                <i class="fas fa-times"></i>
            </button>
        </div>

        <!-- Enhanced Navigation with Better Scroll -->
        <nav class="flex-1 overflow-y-auto no-scrollbar py-4">
            <div class="px-4 space-y-1">
                @auth
                    @if(Auth::user()->isAdmin())
                        <!-- Enhanced Admin Navigation -->
                        <a href="{{ route('admin.dashboard') }}" class="group flex items-center space-x-3 p-3 rounded-xl transition-all duration-200 {{ request()->routeIs('admin.dashboard') ? 'bg-blue-700 shadow-lg transform scale-105' : 'hover:bg-blue-700 hover:shadow-md hover:translate-x-1' }}">
                            <div class="w-8 h-8 rounded-lg bg-blue-600 flex items-center justify-center group-hover:bg-blue-500 transition-colors">
                                <i class="fas fa-tachometer-alt text-white text-sm"></i>
                            </div>
                            <span class="font-medium flex-1">Dashboard</span>
                            <div class="w-2 h-2 rounded-full bg-blue-400 opacity-0 group-hover:opacity-100 transition-opacity"></div>
                        </a>
                        
                        <a href="{{ route('admin.employees') }}" class="group flex items-center space-x-3 p-3 rounded-xl transition-all duration-200 {{ request()->routeIs('admin.employees*') ? 'bg-blue-700 shadow-lg transform scale-105' : 'hover:bg-blue-700 hover:shadow-md hover:translate-x-1' }}">
                            <div class="w-8 h-8 rounded-lg bg-blue-600 flex items-center justify-center group-hover:bg-blue-500 transition-colors">
                                <i class="fas fa-users text-white text-sm"></i>
                            </div>
                            <span class="font-medium flex-1">Employee Management</span>
                            <div class="w-2 h-2 rounded-full bg-blue-400 opacity-0 group-hover:opacity-100 transition-opacity"></div>
                        </a>
                        
                        <a href="{{ route('admin.leaves.pending') }}" class="group flex items-center space-x-3 p-3 rounded-xl transition-all duration-200 {{ request()->routeIs('admin.leaves.pending') ? 'bg-blue-700 shadow-lg transform scale-105' : 'hover:bg-blue-700 hover:shadow-md hover:translate-x-1' }}">
                            <div class="w-8 h-8 rounded-lg bg-blue-600 flex items-center justify-center group-hover:bg-blue-500 transition-colors">
                                <i class="fas fa-calendar-check text-white text-sm"></i>
                            </div>
                            <span class="font-medium flex-1">Leave Approvals</span>
                            <span class="ml-auto bg-red-500 text-white text-xs px-2 py-1 rounded-full animate-pulse">{{ Auth::user()->getPendingApprovalsCount() }}</span>
                        </a>
                        
                        <a href="{{ route('admin.leaves.history') }}" class="group flex items-center space-x-3 p-3 rounded-xl transition-all duration-200 {{ request()->routeIs('admin.leaves.history') ? 'bg-blue-700 shadow-lg transform scale-105' : 'hover:bg-blue-700 hover:shadow-md hover:translate-x-1' }}">
                            <div class="w-8 h-8 rounded-lg bg-blue-600 flex items-center justify-center group-hover:bg-blue-500 transition-colors">
                                <i class="fas fa-history text-white text-sm"></i>
                            </div>
                            <span class="font-medium flex-1">Leave History</span>
                            <div class="w-2 h-2 rounded-full bg-blue-400 opacity-0 group-hover:opacity-100 transition-opacity"></div>
                        </a>
                        
                        <a href="{{ route('admin.reports') }}" class="group flex items-center space-x-3 p-3 rounded-xl transition-all duration-200 {{ request()->routeIs('admin.reports') ? 'bg-blue-700 shadow-lg transform scale-105' : 'hover:bg-blue-700 hover:shadow-md hover:translate-x-1' }}">
                            <div class="w-8 h-8 rounded-lg bg-blue-600 flex items-center justify-center group-hover:bg-blue-500 transition-colors">
                                <i class="fas fa-chart-bar text-white text-sm"></i>
                            </div>
                            <span class="font-medium flex-1">Reports & Analytics</span>
                            <div class="w-2 h-2 rounded-full bg-blue-400 opacity-0 group-hover:opacity-100 transition-opacity"></div>
                        </a>
                        
                        <a href="{{ route('admin.leave.types') }}" class="group flex items-center space-x-3 p-3 rounded-xl transition-all duration-200 {{ request()->routeIs('admin.leave.types') ? 'bg-blue-700 shadow-lg transform scale-105' : 'hover:bg-blue-700 hover:shadow-md hover:translate-x-1' }}">
                            <div class="w-8 h-8 rounded-lg bg-blue-600 flex items-center justify-center group-hover:bg-blue-500 transition-colors">
                                <i class="fas fa-list-alt text-white text-sm"></i>
                            </div>
                            <span class="font-medium flex-1">Leave Types</span>
                            <div class="w-2 h-2 rounded-full bg-blue-400 opacity-0 group-hover:opacity-100 transition-opacity"></div>
                        </a>
                        
                        <a href="{{ route('admin.departments') }}" class="group flex items-center space-x-3 p-3 rounded-xl transition-all duration-200 {{ request()->routeIs('admin.departments') ? 'bg-blue-700 shadow-lg transform scale-105' : 'hover:bg-blue-700 hover:shadow-md hover:translate-x-1' }}">
                            <div class="w-8 h-8 rounded-lg bg-blue-600 flex items-center justify-center group-hover:bg-blue-500 transition-colors">
                                <i class="fas fa-building text-white text-sm"></i>
                            </div>
                            <span class="font-medium flex-1">Departments</span>
                            <div class="w-2 h-2 rounded-full bg-blue-400 opacity-0 group-hover:opacity-100 transition-opacity"></div>
                        </a>
                        
                        <a href="{{ route('admin.roles') }}" class="group flex items-center space-x-3 p-3 rounded-xl transition-all duration-200 {{ request()->routeIs('admin.roles') ? 'bg-blue-700 shadow-lg transform scale-105' : 'hover:bg-blue-700 hover:shadow-md hover:translate-x-1' }}">
                            <div class="w-8 h-8 rounded-lg bg-blue-600 flex items-center justify-center group-hover:bg-blue-500 transition-colors">
                                <i class="fas fa-user-shield text-white text-sm"></i>
                            </div>
                            <span class="font-medium flex-1">Role Management</span>
                            <div class="w-2 h-2 rounded-full bg-blue-400 opacity-0 group-hover:opacity-100 transition-opacity"></div>
                        </a>
                        
                        <a href="{{ route('admin.approval.summary') }}" class="group flex items-center space-x-3 p-3 rounded-xl transition-all duration-200 {{ request()->routeIs('admin.approval.summary') ? 'bg-blue-700 shadow-lg transform scale-105' : 'hover:bg-blue-700 hover:shadow-md hover:translate-x-1' }}">
                            <div class="w-8 h-8 rounded-lg bg-blue-600 flex items-center justify-center group-hover:bg-blue-500 transition-colors">
                                <i class="fas fa-tasks text-white text-sm"></i>
                            </div>
                            <span class="font-medium flex-1">Approval Summary</span>
                            <div class="w-2 h-2 rounded-full bg-blue-400 opacity-0 group-hover:opacity-100 transition-opacity"></div>
                        </a>
                        
                        <a href="{{ route('calendar.index') }}" class="group flex items-center space-x-3 p-3 rounded-xl transition-all duration-200 {{ request()->routeIs('calendar.*') ? 'bg-blue-700 shadow-lg transform scale-105' : 'hover:bg-blue-700 hover:shadow-md hover:translate-x-1' }}">
                            <div class="w-8 h-8 rounded-lg bg-blue-600 flex items-center justify-center group-hover:bg-blue-500 transition-colors">
                                <i class="fas fa-calendar-alt text-white text-sm"></i>
                            </div>
                            <span class="font-medium flex-1">Company Calendar</span>
                            <div class="w-2 h-2 rounded-full bg-blue-400 opacity-0 group-hover:opacity-100 transition-opacity"></div>
                        </a>

                    @elseif(Auth::user()->isHead())
                        <!-- Enhanced Department Head Navigation -->
                        <a href="{{ route('head.dashboard') }}" class="group flex items-center space-x-3 p-3 rounded-xl transition-all duration-200 {{ request()->routeIs('head.dashboard') ? 'bg-blue-700 shadow-lg transform scale-105' : 'hover:bg-blue-700 hover:shadow-md hover:translate-x-1' }}">
                            <div class="w-8 h-8 rounded-lg bg-blue-600 flex items-center justify-center group-hover:bg-blue-500 transition-colors">
                                <i class="fas fa-tachometer-alt text-white text-sm"></i>
                            </div>
                            <span class="font-medium flex-1">Dashboard</span>
                        </a>
                        
                        <a href="{{ route('head.leaves.pending') }}" class="group flex items-center space-x-3 p-3 rounded-xl transition-all duration-200 {{ request()->routeIs('head.leaves.pending') ? 'bg-blue-700 shadow-lg transform scale-105' : 'hover:bg-blue-700 hover:shadow-md hover:translate-x-1' }}">
                            <div class="w-8 h-8 rounded-lg bg-blue-600 flex items-center justify-center group-hover:bg-blue-500 transition-colors">
                                <i class="fas fa-clock text-white text-sm"></i>
                            </div>
                            <span class="font-medium flex-1">Pending Approvals</span>
                            <span class="ml-auto bg-red-500 text-white text-xs px-2 py-1 rounded-full animate-pulse">{{ Auth::user()->getPendingApprovalsCount() }}</span>
                        </a>
                        
                        <a href="{{ route('head.leaves.history') }}" class="group flex items-center space-x-3 p-3 rounded-xl transition-all duration-200 {{ request()->routeIs('head.leaves.history') ? 'bg-blue-700 shadow-lg transform scale-105' : 'hover:bg-blue-700 hover:shadow-md hover:translate-x-1' }}">
                            <div class="w-8 h-8 rounded-lg bg-blue-600 flex items-center justify-center group-hover:bg-blue-500 transition-colors">
                                <i class="fas fa-history text-white text-sm"></i>
                            </div>
                            <span class="font-medium flex-1">Leave History</span>
                        </a>
                        
                        <a href="{{ route('head.team.calendar') }}" class="group flex items-center space-x-3 p-3 rounded-xl transition-all duration-200 {{ request()->routeIs('head.team.calendar') ? 'bg-blue-700 shadow-lg transform scale-105' : 'hover:bg-blue-700 hover:shadow-md hover:translate-x-1' }}">
                            <div class="w-8 h-8 rounded-lg bg-blue-600 flex items-center justify-center group-hover:bg-blue-500 transition-colors">
                                <i class="fas fa-calendar-alt text-white text-sm"></i>
                            </div>
                            <span class="font-medium flex-1">Team Calendar</span>
                        </a>

                        <a href="{{ route('head.reports') }}" class="group flex items-center space-x-3 p-3 rounded-xl transition-all duration-200 {{ request()->routeIs('head.reports') ? 'bg-blue-700 shadow-lg transform scale-105' : 'hover:bg-blue-700 hover:shadow-md hover:translate-x-1' }}">
                            <div class="w-8 h-8 rounded-lg bg-blue-600 flex items-center justify-center group-hover:bg-blue-500 transition-colors">
                                <i class="fas fa-chart-bar text-white text-sm"></i>
                            </div>
                            <span class="font-medium flex-1">Reports & Analytics</span>
                        </a>

                        <a href="{{ route('head.team.members') }}" class="group flex items-center space-x-3 p-3 rounded-xl transition-all duration-200 {{ request()->routeIs('head.team.members') ? 'bg-blue-700 shadow-lg transform scale-105' : 'hover:bg-blue-700 hover:shadow-md hover:translate-x-1' }}">
                            <div class="w-8 h-8 rounded-lg bg-blue-600 flex items-center justify-center group-hover:bg-blue-500 transition-colors">
                                <i class="fas fa-users-cog text-white text-sm"></i>
                            </div>
                            <span class="font-medium flex-1">Team Management</span>
                        </a>

                        <a href="{{ route('head.leave.policies') }}" class="group flex items-center space-x-3 p-3 rounded-xl transition-all duration-200 {{ request()->routeIs('head.leave.policies') ? 'bg-blue-700 shadow-lg transform scale-105' : 'hover:bg-blue-700 hover:shadow-md hover:translate-x-1' }}">
                            <div class="w-8 h-8 rounded-lg bg-blue-600 flex items-center justify-center group-hover:bg-blue-500 transition-colors">
                                <i class="fas fa-list-alt text-white text-sm"></i>
                            </div>
                            <span class="font-medium flex-1">Leave Policies</span>
                        </a>

                        <a href="{{ route('calendar.index') }}" class="group flex items-center space-x-3 p-3 rounded-xl transition-all duration-200 {{ request()->routeIs('calendar.*') ? 'bg-blue-700 shadow-lg transform scale-105' : 'hover:bg-blue-700 hover:shadow-md hover:translate-x-1' }}">
                            <div class="w-8 h-8 rounded-lg bg-blue-600 flex items-center justify-center group-hover:bg-blue-500 transition-colors">
                                <i class="fas fa-calendar text-white text-sm"></i>
                            </div>
                            <span class="font-medium flex-1">Company Calendar</span>
                        </a>

                    @else
                        <!-- Enhanced Employee Navigation -->
                        <a href="{{ route('employee.dashboard') }}" class="group flex items-center space-x-3 p-3 rounded-xl transition-all duration-200 {{ request()->routeIs('employee.dashboard') ? 'bg-blue-700 shadow-lg transform scale-105' : 'hover:bg-blue-700 hover:shadow-md hover:translate-x-1' }}">
                            <div class="w-8 h-8 rounded-lg bg-blue-600 flex items-center justify-center group-hover:bg-blue-500 transition-colors">
                                <i class="fas fa-tachometer-alt text-white text-sm"></i>
                            </div>
                            <span class="font-medium flex-1">Dashboard</span>
                        </a>
                        
                        <a href="{{ route('employee.leave.create') }}" class="group flex items-center space-x-3 p-3 rounded-xl transition-all duration-200 {{ request()->routeIs('employee.leave.create') ? 'bg-blue-700 shadow-lg transform scale-105' : 'hover:bg-blue-700 hover:shadow-md hover:translate-x-1' }}">
                            <div class="w-8 h-8 rounded-lg bg-blue-600 flex items-center justify-center group-hover:bg-blue-500 transition-colors">
                                <i class="fas fa-paper-plane text-white text-sm"></i>
                            </div>
                            <span class="font-medium flex-1">Apply Leave</span>
                        </a>
                        
                        <a href="{{ route('employee.leave.history') }}" class="group flex items-center space-x-3 p-3 rounded-xl transition-all duration-200 {{ request()->routeIs('employee.leave.history') ? 'bg-blue-700 shadow-lg transform scale-105' : 'hover:bg-blue-700 hover:shadow-md hover:translate-x-1' }}">
                            <div class="w-8 h-8 rounded-lg bg-blue-600 flex items-center justify-center group-hover:bg-blue-500 transition-colors">
                                <i class="fas fa-history text-white text-sm"></i>
                            </div>
                            <span class="font-medium flex-1">Leave History</span>
                        </a>
                        
                        <a href="{{ route('employee.leave.balance') }}" class="group flex items-center space-x-3 p-3 rounded-xl transition-all duration-200 {{ request()->routeIs('employee.leave.balance') ? 'bg-blue-700 shadow-lg transform scale-105' : 'hover:bg-blue-700 hover:shadow-md hover:translate-x-1' }}">
                            <div class="w-8 h-8 rounded-lg bg-blue-600 flex items-center justify-center group-hover:bg-blue-500 transition-colors">
                                <i class="fas fa-chart-pie text-white text-sm"></i>
                            </div>
                            <span class="font-medium flex-1">Leave Balance</span>
                        </a>
                        
                        <a href="{{ route('employee.team.calendar') }}" class="group flex items-center space-x-3 p-3 rounded-xl transition-all duration-200 {{ request()->routeIs('employee.team.calendar') ? 'bg-blue-700 shadow-lg transform scale-105' : 'hover:bg-blue-700 hover:shadow-md hover:translate-x-1' }}">
                            <div class="w-8 h-8 rounded-lg bg-blue-600 flex items-center justify-center group-hover:bg-blue-500 transition-colors">
                                <i class="fas fa-calendar-alt text-white text-sm"></i>
                            </div>
                            <span class="font-medium flex-1">Team Calendar</span>
                        </a>
                        
                        <a href="{{ route('employee.profile') }}" class="group flex items-center space-x-3 p-3 rounded-xl transition-all duration-200 {{ request()->routeIs('employee.profile') ? 'bg-blue-700 shadow-lg transform scale-105' : 'hover:bg-blue-700 hover:shadow-md hover:translate-x-1' }}">
                            <div class="w-8 h-8 rounded-lg bg-blue-600 flex items-center justify-center group-hover:bg-blue-500 transition-colors">
                                <i class="fas fa-user text-white text-sm"></i>
                            </div>
                            <span class="font-medium flex-1">Profile</span>
                        </a>
                    @endif
                @endauth
            </div>
        </nav>

        <!-- Enhanced Logout Section -->
        <div class="p-6 border-t border-blue-700 mt-auto bg-blue-850">
            <button type="button" 
                    data-logout-button
                    class="group flex items-center space-x-3 p-3 rounded-xl bg-gradient-to-r from-red-600 to-red-700 hover:from-red-700 hover:to-red-800 transition-all duration-200 text-white w-full text-left shadow-lg hover:shadow-xl transform hover:scale-105">
                <div class="w-8 h-8 rounded-lg bg-red-500 flex items-center justify-center group-hover:bg-red-400 transition-colors">
                    <i class="fas fa-sign-out-alt text-white text-sm"></i>
                </div>
                <span class="font-medium flex-1">Logout</span>
                <i class="fas fa-chevron-right text-red-200 text-xs transform group-hover:translate-x-1 transition-transform"></i>
            </button>
        </div>
    </div>
</div>

<!-- Rest of your styles and scripts remain the same -->
<style>
    /* Hide scrollbar for Chrome, Safari and Opera */
    .no-scrollbar::-webkit-scrollbar {
        display: none;
    }
    
    /* Hide scrollbar for IE, Edge and Firefox */
    .no-scrollbar {
        -ms-overflow-style: none;
        scrollbar-width: none;
    }
    
    /* Custom gradient background */
    .bg-blue-850 {
        background-color: #1e3a8a;
    }
    
    /* Smooth transitions for sidebar */
    #sidebar {
        box-shadow: 0 0 50px rgba(0, 0, 0, 0.1);
    }
</style>

<!-- Enhanced Logout Modal -->
<div id="logoutModal" class="fixed inset-0 bg-black bg-opacity-50 overflow-y-auto h-full w-full z-[60] hidden transition-opacity duration-300">
    <div class="relative top-20 mx-auto p-5 w-96">
        <div class="bg-white rounded-2xl shadow-2xl overflow-hidden transform transition-all duration-300 scale-95">
            <div class="p-6 text-center">
                <!-- Warning Icon -->
                <div class="mx-auto flex items-center justify-center h-16 w-16 rounded-full bg-red-100 mb-4">
                    <i class="fas fa-exclamation-triangle text-red-600 text-2xl"></i>
                </div>
                
                <!-- Modal Content -->
                <h3 class="text-xl font-bold text-gray-900 mb-2">Confirm Logout</h3>
                <div class="px-4 py-3">
                    <p class="text-sm text-gray-600 leading-relaxed">
                        Are you sure you want to logout from your account? You'll need to sign in again to access the system.
                    </p>
                </div>
                
                <!-- Modal Actions -->
                <div class="flex items-center justify-center space-x-3 px-2 py-4">
                    <button id="logoutCancel" 
                            class="px-6 py-3 bg-gray-100 text-gray-700 text-sm font-medium rounded-xl hover:bg-gray-200 transition duration-200 flex items-center space-x-2">
                        <i class="fas fa-times"></i>
                        <span>Cancel</span>
                    </button>
                    <form method="POST" action="{{ route('logout') }}" class="inline">
                        @csrf
                        <button type="submit" 
                                class="px-6 py-3 bg-gradient-to-r from-red-600 to-red-700 text-white text-sm font-medium rounded-xl hover:from-red-700 hover:to-red-800 transition duration-200 flex items-center space-x-2 shadow-lg">
                            <i class="fas fa-sign-out-alt"></i>
                            <span>Yes, Logout</span>
                        </button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
    // Enhanced Sidebar and Modal functionality
    document.addEventListener('DOMContentLoaded', function() {
        const sidebar = document.getElementById('sidebar');
        const logoutModal = document.getElementById('logoutModal');
        const logoutCancel = document.getElementById('logoutCancel');
        const closeSidebar = document.getElementById('closeSidebar');
        
        // Mobile sidebar toggle
        function toggleSidebar() {
            if (sidebar) {
                sidebar.classList.toggle('-translate-x-full');
            }
        }
        
        // Close sidebar on mobile
        if (closeSidebar) {
            closeSidebar.addEventListener('click', toggleSidebar);
        }
        
        // Function to show modal with animation
        function showLogoutModal() {
            if (!logoutModal) return;
            
            logoutModal.classList.remove('hidden');
            // Use setTimeout to ensure the DOM is updated
            setTimeout(() => {
                const modalContent = logoutModal.querySelector('div > div'); // Target the modal content
                if (modalContent) {
                    modalContent.classList.remove('scale-95');
                    modalContent.classList.add('scale-100');
                }
            }, 50);
        }
        
        // Function to hide modal with animation
        function hideLogoutModal() {
            if (!logoutModal) return;
            
            const modalContent = logoutModal.querySelector('div > div'); // Target the modal content
            if (modalContent) {
                modalContent.classList.remove('scale-100');
                modalContent.classList.add('scale-95');
            }
            
            setTimeout(() => {
                logoutModal.classList.add('hidden');
            }, 300);
        }
        
        // Update all logout buttons to use the modal
        const logoutButtons = document.querySelectorAll('[data-logout-button]');
        logoutButtons.forEach(button => {
            button.addEventListener('click', function(e) {
                e.preventDefault();
                showLogoutModal();
            });
        });
        
        // Cancel button event - only add if element exists
        if (logoutCancel) {
            logoutCancel.addEventListener('click', hideLogoutModal);
        }
        
        // Close modal when clicking outside - only add if element exists
        if (logoutModal) {
            logoutModal.addEventListener('click', function(e) {
                if (e.target === logoutModal) {
                    hideLogoutModal();
                }
            });
        }
        
        // Close modal with Escape key
        document.addEventListener('keydown', function(e) {
            if (e.key === 'Escape' && logoutModal && !logoutModal.classList.contains('hidden')) {
                hideLogoutModal();
            }
        });
        
        // Auto-hide sidebar on mobile when clicking outside
        document.addEventListener('click', function(e) {
            if (window.innerWidth < 768 && sidebar && !sidebar.contains(e.target) && !e.target.closest('#openSidebar')) {
                sidebar.classList.add('-translate-x-full');
            }
        });
    });
</script>