@extends('layouts.app')

@section('title', 'Department Head Dashboard - Nish Auto Limited')
@section('page-title', 'Department Head Dashboard')

@section('content')
@auth
    @if(Auth::user()->isHead())
        <!-- Welcome Section -->
        <div class="bg-gradient-to-r from-indigo-600 to-indigo-800 rounded-2xl p-6 text-white mb-8 stat-card">
            <div class="flex items-center justify-between">
                <div>
                    <h2 class="text-2xl font-bold mb-2">Welcome back, {{ Auth::user()->name }}!</h2>
                    <p class="text-indigo-100">Department: {{ $department->name ?? 'Your Department' }}</p>
                    <p class="text-indigo-100 mt-1">Team Members: {{ $teamStats['total_members'] ?? 0 }} | Pending Approvals: {{ $teamStats['pending_approvals'] ?? 0 }}</p>
                </div>
                <div class="hidden md:block">
                    <i class="fas fa-users text-4xl text-indigo-300"></i>
                </div>
            </div>
        </div>

        <!-- Quick Stats -->
        <div class="grid grid-cols-1 md:grid-cols-4 gap-6 mb-8">
            <!-- Pending Approvals -->
            <div class="bg-white rounded-xl shadow-sm border border-gray-200 p-6 text-center stat-card">
                <div class="w-16 h-16 bg-yellow-100 rounded-full flex items-center justify-center mx-auto mb-4">
                    <i class="fas fa-clock text-yellow-600 text-2xl"></i>
                </div>
                <h3 class="text-3xl font-bold text-gray-800 mb-2">{{ $teamStats['pending_approvals'] ?? 0 }}</h3>
                <p class="text-gray-600 font-medium">Pending Approvals</p>
                <p class="text-sm text-gray-500 mt-1">Require Your Action</p>
            </div>

            <!-- Team Members -->
            <div class="bg-white rounded-xl shadow-sm border border-gray-200 p-6 text-center stat-card">
                <div class="w-16 h-16 bg-blue-100 rounded-full flex items-center justify-center mx-auto mb-4">
                    <i class="fas fa-users text-blue-600 text-2xl"></i>
                </div>
                <h3 class="text-3xl font-bold text-gray-800 mb-2">{{ $teamStats['total_members'] ?? 0 }}</h3>
                <p class="text-gray-600 font-medium">Team Members</p>
                <p class="text-sm text-gray-500 mt-1">In Your Department</p>
            </div>

            <!-- On Leave Today -->
            <div class="bg-white rounded-xl shadow-sm border border-gray-200 p-6 text-center stat-card">
                <div class="w-16 h-16 bg-red-100 rounded-full flex items-center justify-center mx-auto mb-4">
                    <i class="fas fa-calendar-times text-red-600 text-2xl"></i>
                </div>
                <h3 class="text-3xl font-bold text-gray-800 mb-2">{{ $teamStats['on_leave_today'] ?? 0 }}</h3>
                <p class="text-gray-600 font-medium">On Leave Today</p>
                <p class="text-sm text-gray-500 mt-1">Out of Office</p>
            </div>

            <!-- Approval Rate -->
            <div class="bg-white rounded-xl shadow-sm border border-gray-200 p-6 text-center stat-card">
                <div class="w-16 h-16 bg-green-100 rounded-full flex items-center justify-center mx-auto mb-4">
                    <i class="fas fa-chart-line text-green-600 text-2xl"></i>
                </div>
                <h3 class="text-3xl font-bold text-gray-800 mb-2">{{ $teamStats['approval_rate'] ?? 0 }}%</h3>
                <p class="text-gray-600 font-medium">Approval Rate</p>
                <p class="text-sm text-gray-500 mt-1">Last 30 Days</p>
            </div>
        </div>

        <!-- Main Dashboard Grid -->
        <div class="grid grid-cols-1 lg:grid-cols-3 gap-6 mb-8">
            <!-- Pending Approvals List -->
            <div class="lg:col-span-2 bg-white rounded-xl shadow-sm border border-gray-200 p-6">
                <div class="flex items-center justify-between mb-4">
                    <h3 class="text-lg font-semibold text-gray-800">Pending Approvals</h3>
                    <a href="{{ route('head.leaves.pending') }}" class="text-blue-600 hover:text-blue-500 text-sm font-medium">View All</a>
                </div>
                <div class="space-y-3">
                    @forelse($pendingApprovals as $approval)
                        <div class="flex items-center justify-between p-3 border border-yellow-200 bg-yellow-50 rounded-lg">
                            <div class="flex items-center space-x-3">
                                <div class="w-10 h-10 bg-yellow-100 rounded-full flex items-center justify-center">
                                    <span class="text-yellow-800 font-semibold text-sm">
                                        {{ substr($approval->user->name, 0, 1) }}
                                    </span>
                                </div>
                                <div>
                                    <p class="font-medium text-gray-800">{{ $approval->user->name }}</p>
                                    <p class="text-sm text-gray-600">{{ $approval->leaveType->name }}</p>
                                    <p class="text-xs text-gray-500">
                                        {{ \Carbon\Carbon::parse($approval->start_date)->format('M d') }} - {{ \Carbon\Carbon::parse($approval->end_date)->format('M d, Y') }} ({{ $approval->total_days }} days)
                                    </p>
                                    @if($approval->contact_number)
                                        <p class="text-xs text-gray-500">Contact: {{ $approval->contact_number }}</p>
                                    @endif
                                </div>
                            </div>
                            <div class="flex space-x-2">
                                <form action="{{ route('head.approve', $approval->id) }}" method="POST" class="inline">
                                    @csrf
                                    <button type="submit" class="approve-btn px-3 py-1 bg-green-100 text-green-800 text-xs rounded-full font-medium hover:bg-green-200 transition-colors">
                                        Approve
                                    </button>
                                </form>
                                <button type="button" class="reject-btn px-3 py-1 bg-red-100 text-red-800 text-xs rounded-full font-medium hover:bg-red-200 transition-colors" data-id="{{ $approval->id }}">
                                    Reject
                                </button>
                            </div>
                        </div>
                    @empty
                        <div class="text-center py-4">
                            <i class="fas fa-check-circle text-gray-400 text-2xl mb-2"></i>
                            <p class="text-gray-500 text-sm">No pending approvals</p>
                        </div>
                    @endforelse
                </div>
            </div>

            <!-- Team Leave Overview -->
            <div class="bg-white rounded-xl shadow-sm border border-gray-200 p-6">
                <h3 class="text-lg font-semibold text-gray-800 mb-4">Team Leave Overview</h3>
                <div class="space-y-4">
                    @foreach($teamLeaveOverview as $overview)
                        <div class="flex items-center justify-between">
                            <div class="flex items-center space-x-3">
                                <div class="w-8 h-8 rounded-full bg-blue-100 flex items-center justify-center">
                                    <span class="text-blue-800 text-xs font-semibold">
                                        {{ substr($overview['employee_name'], 0, 1) }}
                                    </span>
                                </div>
                                <span class="text-sm font-medium text-gray-700">{{ $overview['employee_name'] }}</span>
                            </div>
                            <div class="text-right">
                                <span class="text-sm font-medium text-gray-800">{{ $overview['available_days'] }} days</span>
                                <div class="w-24 bg-gray-200 rounded-full h-2 mt-1">
                                    <div class="bg-blue-500 h-2 rounded-full" style="width: {{ $overview['percentage'] }}%"></div>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
        </div>

        <!-- Charts and Analytics -->
        <div class="grid grid-cols-1 lg:grid-cols-2 gap-6 mb-8">
            <!-- Leave Distribution Chart -->
            <div class="bg-white rounded-xl shadow-sm border border-gray-200 p-6">
                <h3 class="text-lg font-semibold text-gray-800 mb-4">Leave Distribution</h3>
                <div class="h-64">
                    <canvas id="leaveDistributionChart"></canvas>
                </div>
            </div>

            <!-- Monthly Trend -->
            <div class="bg-white rounded-xl shadow-sm border border-gray-200 p-6">
                <h3 class="text-lg font-semibold text-gray-800 mb-4">Monthly Leave Trend</h3>
                <div class="h-64">
                    <canvas id="monthlyTrendChart"></canvas>
                </div>
            </div>
        </div>

        <!-- Upcoming Team Leaves -->
        <div class="bg-white rounded-xl shadow-sm border border-gray-200 p-6">
            <div class="flex items-center justify-between mb-4">
                <h3 class="text-lg font-semibold text-gray-800">Upcoming Team Leaves</h3>
                <a href="{{ route('head.team.calendar') }}" class="text-blue-600 hover:text-blue-500 text-sm font-medium">View Calendar</a>
            </div>
            <div class="overflow-x-auto">
                <table class="w-full">
                    <thead>
                        <tr class="border-b border-gray-200">
                            <th class="text-left py-3 text-sm font-medium text-gray-600">Employee</th>
                            <th class="text-left py-3 text-sm font-medium text-gray-600">Leave Type</th>
                            <th class="text-left py-3 text-sm font-medium text-gray-600">Period</th>
                            <th class="text-left py-3 text-sm font-medium text-gray-600">Duration</th>
                            <th class="text-left py-3 text-sm font-medium text-gray-600">Status</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-gray-200">
                        @forelse($upcomingTeamLeaves as $leave)
                            @php
                                $statusColors = [
                                    'approved' => 'green',
                                    'pending' => 'yellow', 
                                    'rejected' => 'red',
                                    'cancelled' => 'gray'
                                ];
                                $color = $statusColors[$leave->status] ?? 'gray';
                            @endphp
                            <tr>
                                <td class="py-4">
                                    <div class="flex items-center space-x-2">
                                        <div class="w-8 h-8 rounded-full bg-blue-100 flex items-center justify-center">
                                            <span class="text-blue-800 text-xs font-semibold">
                                                {{ substr($leave->user->name, 0, 1) }}
                                            </span>
                                        </div>
                                        <span class="font-medium text-gray-800">{{ $leave->user->name }}</span>
                                    </div>
                                </td>
                                <td class="py-4 text-sm text-gray-600">{{ $leave->leaveType->name }}</td>
                                <td class="py-4 text-sm text-gray-600">
                                    {{ \Carbon\Carbon::parse($leave->start_date)->format('M d') }} - {{ \Carbon\Carbon::parse($leave->end_date)->format('M d, Y') }}
                                </td>
                                <td class="py-4 text-sm text-gray-600">{{ $leave->total_days }} days</td>
                                <td class="py-4">
                                    <span class="px-3 py-1 bg-{{ $color }}-100 text-{{ $color }}-800 text-xs rounded-full font-medium">
                                        {{ ucfirst($leave->status) }}
                                    </span>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="5" class="py-4 text-center text-gray-500">
                                    No upcoming leaves for your team
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>

        <!-- Quick Links -->
        <div class="bg-white rounded-xl shadow-sm border border-gray-200 p-6">
            <h3 class="text-lg font-semibold text-gray-800 mb-4">Quick Actions</h3>
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-4">
                <a href="{{ route('head.leaves.pending') }}" class="flex items-center space-x-3 p-4 border border-blue-200 bg-blue-50 rounded-lg hover:bg-blue-100 transition-colors">
                    <div class="w-10 h-10 bg-blue-100 rounded-full flex items-center justify-center">
                        <i class="fas fa-clock text-blue-600"></i>
                    </div>
                    <div>
                        <p class="font-medium text-gray-800">Pending Leaves</p>
                        <p class="text-sm text-gray-600">Manage approvals</p>
                    </div>
                </a>
                
                <a href="{{ route('head.team.calendar') }}" class="flex items-center space-x-3 p-4 border border-green-200 bg-green-50 rounded-lg hover:bg-green-100 transition-colors">
                    <div class="w-10 h-10 bg-green-100 rounded-full flex items-center justify-center">
                        <i class="fas fa-calendar-alt text-green-600"></i>
                    </div>
                    <div>
                        <p class="font-medium text-gray-800">Team Calendar</p>
                        <p class="text-sm text-gray-600">View schedule</p>
                    </div>
                </a>
                
                <a href="{{ route('head.reports') }}" class="flex items-center space-x-3 p-4 border border-purple-200 bg-purple-50 rounded-lg hover:bg-purple-100 transition-colors">
                    <div class="w-10 h-10 bg-purple-100 rounded-full flex items-center justify-center">
                        <i class="fas fa-chart-bar text-purple-600"></i>
                    </div>
                    <div>
                        <p class="font-medium text-gray-800">Reports</p>
                        <p class="text-sm text-gray-600">Analytics & insights</p>
                    </div>
                </a>
                
                <a href="{{ route('head.team.members') }}" class="flex items-center space-x-3 p-4 border border-orange-200 bg-orange-50 rounded-lg hover:bg-orange-100 transition-colors">
                    <div class="w-10 h-10 bg-orange-100 rounded-full flex items-center justify-center">
                        <i class="fas fa-users-cog text-orange-600"></i>
                    </div>
                    <div>
                        <p class="font-medium text-gray-800">Team Management</p>
                        <p class="text-sm text-gray-600">Manage members</p>
                    </div>
                </a>
            </div>
        </div>
    @else
        <!-- Access Denied Message for Non-Department Heads -->
        <div class="bg-red-100 border border-red-400 text-red-700 px-6 py-8 rounded-2xl text-center">
            <div class="flex justify-center mb-4">
                <i class="fas fa-exclamation-triangle text-red-500 text-4xl"></i>
            </div>
            <h2 class="text-2xl font-bold mb-2">Access Denied</h2>
            <p class="text-lg mb-4">This dashboard is for department heads only.</p>
            <p class="text-sm text-red-600 mb-4">Your current role: <strong>{{ Auth::user()->getRoleName() }}</strong></p>
            <div class="flex justify-center space-x-4">
                @if(Auth::user()->isAdmin())
                    <a href="{{ route('admin.dashboard') }}" class="bg-blue-600 text-white px-6 py-2 rounded-lg hover:bg-blue-700 transition duration-200">
                        Go to Admin Dashboard
                    </a>
                @else
                    <a href="{{ route('employee.dashboard') }}" class="bg-blue-600 text-white px-6 py-2 rounded-lg hover:bg-blue-700 transition duration-200">
                        Go to Employee Dashboard
                    </a>
                @endif
                <a href="{{ route('logout') }}" 
                   onclick="event.preventDefault(); document.getElementById('logout-form').submit();"
                   class="bg-gray-600 text-white px-6 py-2 rounded-lg hover:bg-gray-700 transition duration-200">
                    Logout
                </a>
                <form id="logout-form" action="{{ route('logout') }}" method="POST" class="hidden">
                    @csrf
                </form>
            </div>
        </div>
    @endif
@else
    <!-- Not Authenticated Message -->
    <div class="bg-yellow-100 border border-yellow-400 text-yellow-700 px-6 py-8 rounded-2xl text-center">
        <div class="flex justify-center mb-4">
            <i class="fas fa-exclamation-circle text-yellow-500 text-4xl"></i>
        </div>
        <h2 class="text-2xl font-bold mb-2">Authentication Required</h2>
        <p class="text-lg mb-4">Please log in to access the dashboard.</p>
        <div class="flex justify-center space-x-4">
            <a href="{{ route('login') }}" class="bg-blue-600 text-white px-6 py-2 rounded-lg hover:bg-blue-700 transition duration-200">
                Login
            </a>
        </div>
    </div>
@endauth
@endsection

@push('scripts')
@auth
    @if(Auth::user()->isHead())
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            console.log('Dashboard JavaScript loaded');

            // Get CSRF token safely with multiple fallbacks
            function getCsrfToken() {
                // Method 1: Try meta tag
                let metaTag = document.querySelector('meta[name="csrf-token"]');
                if (metaTag && metaTag.getAttribute('content')) {
                    console.log('CSRF token found in meta tag');
                    return metaTag.getAttribute('content');
                }

                // Method 2: Try from form input
                let csrfInput = document.querySelector('input[name="_token"]');
                if (csrfInput && csrfInput.value) {
                    console.log('CSRF token found in form input');
                    return csrfInput.value;
                }

                // Method 3: Try to find in any form
                let forms = document.querySelectorAll('form');
                for (let form of forms) {
                    let tokenInput = form.querySelector('input[name="_token"]');
                    if (tokenInput && tokenInput.value) {
                        console.log('CSRF token found in form');
                        return tokenInput.value;
                    }
                }

                console.error('CSRF token not found anywhere!');
                return '';
            }

            // Create a hidden CSRF token input if none exists
            function ensureCsrfToken() {
                const existingMeta = document.querySelector('meta[name="csrf-token"]');
                if (!existingMeta) {
                    console.log('Creating CSRF meta tag');
                    const meta = document.createElement('meta');
                    meta.name = 'csrf-token';
                    meta.content = '{{ csrf_token() }}';
                    document.head.appendChild(meta);
                }
                
                // Also add a hidden input in the body as backup
                const existingInput = document.querySelector('input[name="_token"]');
                if (!existingInput) {
                    console.log('Creating CSRF hidden input');
                    const input = document.createElement('input');
                    input.type = 'hidden';
                    input.name = '_token';
                    input.value = '{{ csrf_token() }}';
                    document.body.appendChild(input);
                }
            }

            // Call this function to ensure CSRF token exists
            ensureCsrfToken();

            // Notification function
            function showNotification(message, type) {
                console.log('Showing notification:', type, message);
                // Remove any existing notifications first
                document.querySelectorAll('.custom-notification').forEach(notification => {
                    notification.remove();
                });

                // Create notification element
                const notification = document.createElement('div');
                notification.className = `custom-notification fixed top-4 right-4 p-4 rounded-lg shadow-lg text-white z-50 ${
                    type === 'success' ? 'bg-green-500' : 'bg-red-500'
                }`;
                notification.innerHTML = `
                    <div class="flex items-center space-x-2">
                        <i class="fas ${type === 'success' ? 'fa-check-circle' : 'fa-exclamation-circle'}"></i>
                        <span>${message}</span>
                    </div>
                `;
                
                document.body.appendChild(notification);
                
                // Remove notification after 5 seconds
                setTimeout(() => {
                    if (notification.parentNode) {
                        notification.remove();
                    }
                }, 5000);
            }

            // Approve button functionality
            document.querySelectorAll('.approve-btn').forEach(button => {
                button.addEventListener('click', function(e) {
                    e.preventDefault();
                    console.log('Approve button clicked');
                    
                    if (!confirm('Are you sure you want to approve this leave request?')) {
                        console.log('Approve cancelled by user');
                        return;
                    }

                    const form = this.closest('form');
                    const button = this;
                    const formAction = form.action;
                    const csrfToken = getCsrfToken();
                    
                    console.log('Form action:', formAction);
                    console.log('CSRF Token length:', csrfToken.length);
                    
                    if (!csrfToken) {
                        showNotification('Security token missing. Please refresh the page and try again.', 'error');
                        return;
                    }

                    // Show loading state
                    const originalText = button.innerHTML;
                    button.innerHTML = '<i class="fas fa-spinner fa-spin"></i> Approving...';
                    button.disabled = true;

                    // Create form data manually to ensure CSRF token is included
                    const formData = new FormData();
                    formData.append('_token', csrfToken);
                    formData.append('_method', 'POST');

                    fetch(formAction, {
                        method: 'POST',
                        headers: {
                            'X-Requested-With': 'XMLHttpRequest',
                            'X-CSRF-TOKEN': csrfToken,
                            'Accept': 'application/json'
                        },
                        body: formData
                    })
                    .then(response => {
                        console.log('Response status:', response.status, response.statusText);
                        if (!response.ok) {
                            throw new Error(`HTTP error! status: ${response.status}`);
                        }
                        return response.json();
                    })
                    .then(data => {
                        console.log('Response data:', data);
                        if (data.success) {
                            // Remove the row from the table
                            const row = form.closest('.flex.items-center.justify-between');
                            if (row) {
                                row.style.opacity = '0';
                                setTimeout(() => {
                                    row.remove();
                                    // Show success message
                                    showNotification(data.message, 'success');
                                    
                                    // Update pending approvals count
                                    updatePendingCount(-1);
                                    
                                    // Check if no more pending approvals
                                    checkEmptyState();
                                    
                                    // Update the welcome section count
                                    updateWelcomeSectionCount();
                                }, 300);
                            } else {
                                showNotification(data.message, 'success');
                                // Reload page if row not found
                                setTimeout(() => window.location.reload(), 1000);
                            }
                        } else {
                            showNotification(data.message, 'error');
                            button.innerHTML = originalText;
                            button.disabled = false;
                        }
                    })
                    .catch(error => {
                        console.error('Fetch Error:', error);
                        showNotification('An error occurred while approving the leave request: ' + error.message, 'error');
                        button.innerHTML = originalText;
                        button.disabled = false;
                    });
                });
            });

            // Reject button functionality - FIXED VERSION
            document.querySelectorAll('.reject-btn').forEach(button => {
                button.addEventListener('click', function() {
                    const leaveId = this.getAttribute('data-id');
                    const button = this;
                    const csrfToken = getCsrfToken();
                    
                    console.log('Reject button clicked for leave ID:', leaveId);
                    
                    if (!csrfToken) {
                        showNotification('Security token missing. Please refresh the page and try again.', 'error');
                        return;
                    }

                    const reason = prompt('Please enter reason for rejection:');
                    if (reason !== null && reason.trim() !== '') {
                        console.log('Rejection reason provided:', reason);
                        
                        // Show loading state
                        const originalText = button.innerHTML;
                        button.innerHTML = '<i class="fas fa-spinner fa-spin"></i> Rejecting...';
                        button.disabled = true;

                        // FIXED: Remove _token from JSON body since we're using X-CSRF-TOKEN header
                        fetch(`/head/reject/${leaveId}`, {
                            method: 'POST',
                            headers: {
                                'Content-Type': 'application/json',
                                'X-Requested-With': 'XMLHttpRequest',
                                'X-CSRF-TOKEN': csrfToken,
                                'Accept': 'application/json'
                            },
                            body: JSON.stringify({
                                reason: reason
                                // _token removed from here - using header instead
                            })
                        })
                        .then(response => {
                            console.log('Response status:', response.status, response.statusText);
                            if (!response.ok) {
                                // Handle different HTTP error statuses
                                if (response.status === 422) {
                                    return response.json().then(data => {
                                        throw new Error(data.message || 'Validation failed');
                                    });
                                }
                                throw new Error(`HTTP error! status: ${response.status}`);
                            }
                            return response.json();
                        })
                        .then(data => {
                            console.log('Response data:', data);
                            if (data.success) {
                                // Remove the row from the table
                                const row = button.closest('.flex.items-center.justify-between');
                                if (row) {
                                    row.style.opacity = '0';
                                    setTimeout(() => {
                                        row.remove();
                                        // Show success message
                                        showNotification(data.message, 'success');
                                        
                                        // Update pending approvals count
                                        updatePendingCount(-1);
                                        
                                        // Check if no more pending approvals
                                        checkEmptyState();
                                        
                                        // Update the welcome section count
                                        updateWelcomeSectionCount();
                                    }, 300);
                                } else {
                                    showNotification(data.message, 'success');
                                    // Reload page if row not found
                                    setTimeout(() => window.location.reload(), 1000);
                                }
                            } else {
                                showNotification(data.message, 'error');
                                button.innerHTML = originalText;
                                button.disabled = false;
                            }
                        })
                        .catch(error => {
                            console.error('Fetch Error:', error);
                            showNotification('An error occurred while rejecting the leave request: ' + error.message, 'error');
                            button.innerHTML = originalText;
                            button.disabled = false;
                        });
                    } else {
                        console.log('Rejection cancelled - no reason provided');
                        showNotification('Rejection reason is required.', 'error');
                    }
                });
            });

            // Function to update pending count in quick stats
            function updatePendingCount(change) {
                console.log('Updating pending count by:', change);
                
                // Find the pending approvals count element in quick stats
                const statCards = document.querySelectorAll('.bg-white.rounded-xl');
                statCards.forEach(card => {
                    const text = card.textContent;
                    if (text.includes('Pending Approvals') && text.includes('Require Your Action')) {
                        const countElement = card.querySelector('h3.text-3xl');
                        if (countElement) {
                            const currentCount = parseInt(countElement.textContent) || 0;
                            const newCount = Math.max(0, currentCount + change);
                            countElement.textContent = newCount;
                            console.log('Updated pending count from', currentCount, 'to', newCount);
                        }
                    }
                });
            }

            // Function to update welcome section count
            function updateWelcomeSectionCount() {
                const welcomeSection = document.querySelector('.bg-gradient-to-r.from-indigo-600.to-indigo-800');
                if (welcomeSection) {
                    const pendingText = welcomeSection.textContent.match(/Pending Approvals:\s*(\d+)/);
                    if (pendingText) {
                        const currentCount = parseInt(pendingText[1]) || 0;
                        const newCount = Math.max(0, currentCount - 1);
                        
                        // Update the text content
                        const originalText = welcomeSection.textContent;
                        const updatedText = originalText.replace(
                            /Pending Approvals:\s*\d+/,
                            `Pending Approvals: ${newCount}`
                        );
                        
                        // Find the specific paragraph element and update it
                        const paragraphs = welcomeSection.querySelectorAll('p');
                        paragraphs.forEach(p => {
                            if (p.textContent.includes('Pending Approvals:')) {
                                p.textContent = p.textContent.replace(
                                    /Pending Approvals:\s*\d+/,
                                    `Pending Approvals: ${newCount}`
                                );
                            }
                        });
                        
                        console.log('Updated welcome section pending count to:', newCount);
                    }
                }
            }

            // Check and show empty state if no pending approvals left
            function checkEmptyState() {
                const pendingRows = document.querySelectorAll('.flex.items-center.justify-between.p-3.border.border-yellow-200.bg-yellow-50.rounded-lg');
                console.log('Current pending rows count:', pendingRows.length);
                
                if (pendingRows.length === 0) {
                    console.log('No pending approvals left, showing empty state');
                    const container = document.querySelector('.space-y-3');
                    if (container && !container.querySelector('.text-center')) {
                        // Remove any existing empty state messages first
                        container.querySelectorAll('.text-center').forEach(el => el.remove());
                        
                        const emptyDiv = document.createElement('div');
                        emptyDiv.className = 'text-center py-4';
                        emptyDiv.innerHTML = `
                            <i class="fas fa-check-circle text-gray-400 text-2xl mb-2"></i>
                            <p class="text-gray-500 text-sm">No pending approvals</p>
                        `;
                        container.appendChild(emptyDiv);
                    }
                } else {
                    console.log('Still have pending approvals:', pendingRows.length);
                    // Remove empty state if it exists and we have approvals
                    const container = document.querySelector('.space-y-3');
                    if (container) {
                        container.querySelectorAll('.text-center').forEach(el => el.remove());
                    }
                }
            }

            // Add click handlers for better debugging
            document.addEventListener('click', function(e) {
                if (e.target.classList.contains('approve-btn') || e.target.classList.contains('reject-btn')) {
                    console.log('Button clicked:', e.target.className);
                }
            });

            // Initialize empty state check on page load
            checkEmptyState();

            // Charts initialization (your existing chart code)
            const leaveDistributionCtx = document.getElementById('leaveDistributionChart');
            if (leaveDistributionCtx) {
                try {
                    const leaveDistributionChart = new Chart(leaveDistributionCtx.getContext('2d'), {
                        type: 'doughnut',
                        data: {
                            labels: ['Annual', 'Sick', 'Emergency', 'Maternity', 'Paternity', 'Other'],
                            datasets: [{
                                data: [35, 20, 15, 10, 8, 12],
                                backgroundColor: [
                                    '#3b82f6', '#10b981', '#f59e0b', '#8b5cf6', '#06b6d4', '#6b7280'
                                ],
                                borderWidth: 0
                            }]
                        },
                        options: {
                            responsive: true,
                            maintainAspectRatio: false,
                            plugins: {
                                legend: {
                                    position: 'bottom'
                                }
                            }
                        }
                    });
                    console.log('Leave distribution chart initialized');
                } catch (error) {
                    console.error('Error initializing leave distribution chart:', error);
                }
            }

            const monthlyTrendCtx = document.getElementById('monthlyTrendChart');
            if (monthlyTrendCtx) {
                try {
                    const monthlyTrendChart = new Chart(monthlyTrendCtx.getContext('2d'), {
                        type: 'line',
                        data: {
                            labels: ['Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun', 'Jul', 'Aug', 'Sep', 'Oct', 'Nov', 'Dec'],
                            datasets: [{
                                label: 'Leaves Taken',
                                data: [12, 19, 15, 22, 18, 25, 30, 27, 20, 18, 22, 15],
                                borderColor: '#3b82f6',
                                backgroundColor: 'rgba(59, 130, 246, 0.1)',
                                tension: 0.4,
                                fill: true
                            }]
                        },
                        options: {
                            responsive: true,
                            maintainAspectRatio: false,
                            scales: {
                                y: {
                                    beginAtZero: true
                                }
                            }
                        }
                    });
                    console.log('Monthly trend chart initialized');
                } catch (error) {
                    console.error('Error initializing monthly trend chart:', error);
                }
            }

            // Debug: Log all approve and reject buttons
            console.log('Approve buttons found:', document.querySelectorAll('.approve-btn').length);
            console.log('Reject buttons found:', document.querySelectorAll('.reject-btn').length);
            console.log('Forms found:', document.querySelectorAll('form').length);
            
            // Debug: Log all forms and their actions
            document.querySelectorAll('form').forEach((form, index) => {
                console.log(`Form ${index}:`, form.action);
            });

        });
    </script>
    @endif
@endauth
@endpush