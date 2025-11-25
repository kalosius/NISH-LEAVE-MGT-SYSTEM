@extends('layouts.app')

@section('title', 'Pending Leave Approvals - Nish Auto Limited')
@section('page-title', 'Pending Leave Approvals')

@section('content')
@auth
    @if(Auth::user()->isHead())
        <div class="bg-white rounded-xl shadow-sm border border-gray-200 p-6">
            <div class="flex items-center justify-between mb-6">
                <h1 class="text-2xl font-bold text-gray-800">Pending Leave Approvals</h1>
                <a href="{{ route('head.dashboard') }}" class="bg-blue-600 text-white px-4 py-2 rounded-lg hover:bg-blue-700 transition duration-200">
                    <i class="fas fa-arrow-left mr-2"></i>Back to Dashboard
                </a>
            </div>

            @if($pendingLeaves->count() > 0)
                <div class="overflow-x-auto">
                    <table class="w-full">
                        <thead>
                            <tr class="border-b border-gray-200">
                                <th class="text-left py-3 text-sm font-medium text-gray-600">Employee</th>
                                <th class="text-left py-3 text-sm font-medium text-gray-600">Leave Type</th>
                                <th class="text-left py-3 text-sm font-medium text-gray-600">Period</th>
                                <th class="text-left py-3 text-sm font-medium text-gray-600">Duration</th>
                                <th class="text-left py-3 text-sm font-medium text-gray-600">Contact</th>
                                <th class="text-left py-3 text-sm font-medium text-gray-600">Applied On</th>
                                <th class="text-left py-3 text-sm font-medium text-gray-600">Actions</th>
                            </tr>
                        </thead>
                        <tbody class="divide-y divide-gray-200">
                            @foreach($pendingLeaves as $leave)
                                <tr class="hover:bg-gray-50">
                                    <td class="py-4">
                                        <div class="flex items-center space-x-3">
                                            <div class="w-10 h-10 bg-blue-100 rounded-full flex items-center justify-center">
                                                <span class="text-blue-800 font-semibold text-sm">
                                                    {{ substr($leave->user->name, 0, 1) }}
                                                </span>
                                            </div>
                                            <div>
                                                <p class="font-medium text-gray-800">{{ $leave->user->name }}</p>
                                                <p class="text-sm text-gray-600">{{ $leave->user->designation ?? 'Employee' }}</p>
                                            </div>
                                        </div>
                                    </td>
                                    <td class="py-4">
                                        <span class="px-3 py-1 bg-blue-100 text-blue-800 text-xs rounded-full font-medium">
                                            {{ $leave->leaveType->name }}
                                        </span>
                                    </td>
                                    <td class="py-4 text-sm text-gray-600">
                                        <div>{{ \Carbon\Carbon::parse($leave->start_date)->format('M d, Y') }}</div>
                                        <div>to</div>
                                        <div>{{ \Carbon\Carbon::parse($leave->end_date)->format('M d, Y') }}</div>
                                    </td>
                                    <td class="py-4 text-sm text-gray-600">
                                        <span class="font-medium">{{ $leave->total_days }} day(s)</span>
                                    </td>
                                    <td class="py-4 text-sm text-gray-600">
                                        @if($leave->contact_number)
                                            {{ $leave->contact_number }}
                                        @else
                                            <span class="text-gray-400">Not provided</span>
                                        @endif
                                    </td>
                                    <td class="py-4 text-sm text-gray-600">
                                        {{ \Carbon\Carbon::parse($leave->created_at)->format('M d, Y') }}
                                    </td>
                                    <td class="py-4">
                                        <div class="flex space-x-2">
                                            <form action="{{ route('head.approve', $leave->id) }}" method="POST" class="inline">
                                                @csrf
                                                <button type="submit" 
                                                        class="approve-btn px-4 py-2 bg-green-600 text-white text-sm rounded-lg hover:bg-green-700 transition-colors">
                                                    <i class="fas fa-check mr-1"></i>Approve
                                                </button>
                                            </form>
                                            <button type="button" 
                                                    class="reject-btn px-4 py-2 bg-red-600 text-white text-sm rounded-lg hover:bg-red-700 transition-colors"
                                                    data-id="{{ $leave->id }}">
                                                <i class="fas fa-times mr-1"></i>Reject
                                            </button>
                                            <a href="{{ route('head.leave.details', $leave->id) }}" 
                                               class="px-4 py-2 bg-blue-600 text-white text-sm rounded-lg hover:bg-blue-700 transition-colors">
                                                <i class="fas fa-eye mr-1"></i>View
                                            </a>
                                        </div>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>

                <div class="mt-6">
                    {{ $pendingLeaves->links() }}
                </div>
            @else
                <div class="text-center py-12">
                    <i class="fas fa-check-circle text-green-500 text-5xl mb-4"></i>
                    <h3 class="text-xl font-semibold text-gray-700 mb-2">No Pending Approvals</h3>
                    <p class="text-gray-500 mb-6">All leave requests have been processed.</p>
                    <a href="{{ route('head.dashboard') }}" class="bg-blue-600 text-white px-6 py-2 rounded-lg hover:bg-blue-700 transition duration-200">
                        Return to Dashboard
                    </a>
                </div>
            @endif
        </div>

        <!-- Include the same JavaScript for approval/rejection functionality -->
        @push('scripts')
        <script>
            document.addEventListener('DOMContentLoaded', function() {
                // Use the same CSRF token and notification functions from dashboard
                function getCsrfToken() {
                    const metaTag = document.querySelector('meta[name="csrf-token"]');
                    return metaTag ? metaTag.getAttribute('content') : '';
                }

                function showNotification(message, type) {
                    const notification = document.createElement('div');
                    notification.className = `fixed top-4 right-4 p-4 rounded-lg shadow-lg text-white z-50 ${
                        type === 'success' ? 'bg-green-500' : 'bg-red-500'
                    }`;
                    notification.innerHTML = `
                        <div class="flex items-center space-x-2">
                            <i class="fas ${type === 'success' ? 'fa-check-circle' : 'fa-exclamation-circle'}"></i>
                            <span>${message}</span>
                        </div>
                    `;
                    document.body.appendChild(notification);
                    setTimeout(() => notification.remove(), 5000);
                }

                // Approve button functionality
                document.querySelectorAll('.approve-btn').forEach(button => {
                    button.addEventListener('click', function(e) {
                        e.preventDefault();
                        
                        if (!confirm('Are you sure you want to approve this leave request?')) {
                            return;
                        }

                        const form = this.closest('form');
                        const button = this;
                        const originalText = button.innerHTML;
                        
                        button.innerHTML = '<i class="fas fa-spinner fa-spin"></i> Approving...';
                        button.disabled = true;

                        fetch(form.action, {
                            method: 'POST',
                            headers: {
                                'X-Requested-With': 'XMLHttpRequest',
                                'X-CSRF-TOKEN': getCsrfToken(),
                                'Accept': 'application/json'
                            },
                            body: new FormData(form)
                        })
                        .then(response => response.json())
                        .then(data => {
                            if (data.success) {
                                showNotification(data.message, 'success');
                                // Remove the table row
                                const row = form.closest('tr');
                                row.style.opacity = '0';
                                setTimeout(() => row.remove(), 300);
                                
                                // Check if table is empty now
                                if (document.querySelectorAll('tbody tr').length === 0) {
                                    location.reload();
                                }
                            } else {
                                showNotification(data.message, 'error');
                                button.innerHTML = originalText;
                                button.disabled = false;
                            }
                        })
                        .catch(error => {
                            showNotification('An error occurred while approving the leave request.', 'error');
                            button.innerHTML = originalText;
                            button.disabled = false;
                        });
                    });
                });

                // Reject button functionality
                document.querySelectorAll('.reject-btn').forEach(button => {
                    button.addEventListener('click', function() {
                        const leaveId = this.getAttribute('data-id');
                        const button = this;
                        const originalText = button.innerHTML;
                        
                        const reason = prompt('Please enter reason for rejection:');
                        if (reason !== null && reason.trim() !== '') {
                            button.innerHTML = '<i class="fas fa-spinner fa-spin"></i> Rejecting...';
                            button.disabled = true;

                            fetch(`/head/reject/${leaveId}`, {
                                method: 'POST',
                                headers: {
                                    'Content-Type': 'application/json',
                                    'X-Requested-With': 'XMLHttpRequest',
                                    'X-CSRF-TOKEN': getCsrfToken(),
                                    'Accept': 'application/json'
                                },
                                body: JSON.stringify({ reason: reason })
                            })
                            .then(response => response.json())
                            .then(data => {
                                if (data.success) {
                                    showNotification(data.message, 'success');
                                    // Remove the table row
                                    const row = button.closest('tr');
                                    row.style.opacity = '0';
                                    setTimeout(() => row.remove(), 300);
                                    
                                    // Check if table is empty now
                                    if (document.querySelectorAll('tbody tr').length === 0) {
                                        location.reload();
                                    }
                                } else {
                                    showNotification(data.message, 'error');
                                    button.innerHTML = originalText;
                                    button.disabled = false;
                                }
                            })
                            .catch(error => {
                                showNotification('An error occurred while rejecting the leave request.', 'error');
                                button.innerHTML = originalText;
                                button.disabled = false;
                            });
                        }
                    });
                });
            });
        </script>
        @endpush

    @else
        <!-- Access Denied Message -->
        <div class="bg-red-100 border border-red-400 text-red-700 px-6 py-8 rounded-2xl text-center">
            <h2 class="text-2xl font-bold mb-2">Access Denied</h2>
            <p class="text-lg mb-4">This page is for department heads only.</p>
        </div>
    @endif
@else
    <!-- Not Authenticated Message -->
    <div class="bg-yellow-100 border border-yellow-400 text-yellow-700 px-6 py-8 rounded-2xl text-center">
        <h2 class="text-2xl font-bold mb-2">Authentication Required</h2>
        <p class="text-lg mb-4">Please log in to access this page.</p>
    </div>
@endauth
@endsection