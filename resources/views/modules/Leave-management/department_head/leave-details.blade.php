@extends('layouts.app')

@section('title', 'Leave Request Details - Nish Auto Limited')
@section('page-title', 'Leave Request Details')

@section('content')
@auth
    @if(Auth::user()->isHead())
        <div class="max-w-4xl mx-auto">
            <!-- Header -->
            <div class="bg-white rounded-xl shadow-sm border border-gray-200 p-6 mb-6">
                <div class="flex items-center justify-between mb-4">
                    <div>
                        <h1 class="text-2xl font-bold text-gray-800">Leave Request Details</h1>
                        <p class="text-gray-600">Review the complete leave application details</p>
                    </div>
                    <div class="flex space-x-3">
                        <a href="{{ route('head.leaves.pending') }}" class="bg-gray-600 text-white px-4 py-2 rounded-lg hover:bg-gray-700 transition duration-200">
                            <i class="fas fa-arrow-left mr-2"></i>Back to List
                        </a>
                        <a href="{{ route('head.dashboard') }}" class="bg-blue-600 text-white px-4 py-2 rounded-lg hover:bg-blue-700 transition duration-200">
                            <i class="fas fa-home mr-2"></i>Dashboard
                        </a>
                    </div>
                </div>

                <!-- Status Badge -->
                <div class="flex items-center justify-between">
                    <div class="flex items-center space-x-4">
                        <div class="flex items-center space-x-2">
                            <div class="w-12 h-12 bg-blue-100 rounded-full flex items-center justify-center">
                                <span class="text-blue-800 font-semibold text-lg">
                                    {{ substr($leaveRequest->user->name, 0, 1) }}
                                </span>
                            </div>
                            <div>
                                <h2 class="text-lg font-semibold text-gray-800">{{ $leaveRequest->user->name }}</h2>
                                <p class="text-sm text-gray-600">{{ $leaveRequest->user->designation ?? 'Employee' }}</p>
                            </div>
                        </div>
                        <span class="px-3 py-1 bg-blue-100 text-blue-800 text-sm rounded-full font-medium">
                            {{ $leaveRequest->leaveType->name }} Leave
                        </span>
                    </div>
                    <div>
                        @php
                            $statusColors = [
                                'pending' => 'yellow',
                                'approved' => 'green',
                                'rejected' => 'red',
                                'cancelled' => 'gray'
                            ];
                            $color = $statusColors[$leaveRequest->status] ?? 'gray';
                        @endphp
                        <span class="px-4 py-2 bg-{{ $color }}-100 text-{{ $color }}-800 text-sm rounded-full font-medium">
                            {{ ucfirst($leaveRequest->status) }}
                        </span>
                    </div>
                </div>
            </div>

            <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">
                <!-- Left Column - Leave Details -->
                <div class="lg:col-span-2 space-y-6">
                    <!-- Leave Period Card -->
                    <div class="bg-white rounded-xl shadow-sm border border-gray-200 p-6">
                        <h3 class="text-lg font-semibold text-gray-800 mb-4 flex items-center">
                            <i class="fas fa-calendar-alt text-blue-600 mr-2"></i>
                            Leave Period
                        </h3>
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                            <div class="text-center p-4 bg-blue-50 rounded-lg">
                                <p class="text-sm text-gray-600 mb-1">Start Date</p>
                                <p class="text-xl font-bold text-gray-800">
                                    {{ \Carbon\Carbon::parse($leaveRequest->start_date)->format('d M, Y') }}
                                </p>
                                <p class="text-sm text-gray-500">
                                    {{ \Carbon\Carbon::parse($leaveRequest->start_date)->format('l') }}
                                </p>
                            </div>
                            <div class="text-center p-4 bg-green-50 rounded-lg">
                                <p class="text-sm text-gray-600 mb-1">End Date</p>
                                <p class="text-xl font-bold text-gray-800">
                                    {{ \Carbon\Carbon::parse($leaveRequest->end_date)->format('d M, Y') }}
                                </p>
                                <p class="text-sm text-gray-500">
                                    {{ \Carbon\Carbon::parse($leaveRequest->end_date)->format('l') }}
                                </p>
                            </div>
                        </div>
                        <div class="mt-4 text-center">
                            <span class="px-4 py-2 bg-purple-100 text-purple-800 rounded-full text-sm font-medium">
                                Total: {{ $leaveRequest->total_days }} day(s)
                            </span>
                        </div>
                    </div>

                    <!-- Reason & Details Card -->
                    <div class="bg-white rounded-xl shadow-sm border border-gray-200 p-6">
                        <h3 class="text-lg font-semibold text-gray-800 mb-4 flex items-center">
                            <i class="fas fa-file-alt text-green-600 mr-2"></i>
                            Reason & Details
                        </h3>
                        <div class="space-y-4">
                            <div>
                                <label class="block text-sm font-medium text-gray-700 mb-1">Reason for Leave</label>
                                <div class="bg-gray-50 p-4 rounded-lg border border-gray-200">
                                    <p class="text-gray-800">{{ $leaveRequest->reason ?? 'No reason provided' }}</p>
                                </div>
                            </div>
                            
                            @if($leaveRequest->handover_notes)
                            <div>
                                <label class="block text-sm font-medium text-gray-700 mb-1">Handover Notes</label>
                                <div class="bg-gray-50 p-4 rounded-lg border border-gray-200">
                                    <p class="text-gray-800">{{ $leaveRequest->handover_notes }}</p>
                                </div>
                            </div>
                            @endif
                        </div>
                    </div>

                    <!-- Contact Information Card -->
                    <div class="bg-white rounded-xl shadow-sm border border-gray-200 p-6">
                        <h3 class="text-lg font-semibold text-gray-800 mb-4 flex items-center">
                            <i class="fas fa-phone-alt text-red-600 mr-2"></i>
                            Contact Information
                        </h3>
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                            <div class="flex items-center space-x-3 p-3 bg-red-50 rounded-lg">
                                <div class="w-10 h-10 bg-red-100 rounded-full flex items-center justify-center">
                                    <i class="fas fa-phone text-red-600"></i>
                                </div>
                                <div>
                                    <p class="text-sm text-gray-600">Primary Contact</p>
                                    <p class="font-medium text-gray-800">{{ $leaveRequest->contact_number ?? 'Not provided' }}</p>
                                </div>
                            </div>
                            <div class="flex items-center space-x-3 p-3 bg-orange-50 rounded-lg">
                                <div class="w-10 h-10 bg-orange-100 rounded-full flex items-center justify-center">
                                    <i class="fas fa-exclamation-triangle text-orange-600"></i>
                                </div>
                                <div>
                                    <p class="text-sm text-gray-600">Emergency Contact</p>
                                    <p class="font-medium text-gray-800">{{ $leaveRequest->emergency_contact ?? 'Not provided' }}</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Right Column - Actions & Info -->
                <div class="space-y-6">
                    <!-- Quick Actions Card -->
                    @if($leaveRequest->status === 'pending')
                    <div class="bg-white rounded-xl shadow-sm border border-gray-200 p-6">
                        <h3 class="text-lg font-semibold text-gray-800 mb-4 flex items-center">
                            <i class="fas fa-bolt text-yellow-600 mr-2"></i>
                            Quick Actions
                        </h3>
                        <div class="space-y-3">
                            <form action="{{ route('head.approve', $leaveRequest->id) }}" method="POST">
                                @csrf
                                <button type="submit" 
                                        onclick="return confirm('Are you sure you want to approve this leave request?')"
                                        class="w-full bg-green-600 text-white py-3 rounded-lg hover:bg-green-700 transition duration-200 flex items-center justify-center">
                                    <i class="fas fa-check mr-2"></i>Approve Leave
                                </button>
                            </form>
                            
                            <button type="button" 
                                    onclick="showRejectModal()"
                                    class="w-full bg-red-600 text-white py-3 rounded-lg hover:bg-red-700 transition duration-200 flex items-center justify-center">
                                <i class="fas fa-times mr-2"></i>Reject Leave
                            </button>
                        </div>
                    </div>
                    @endif

                    <!-- Leave Type Information -->
                    <div class="bg-white rounded-xl shadow-sm border border-gray-200 p-6">
                        <h3 class="text-lg font-semibold text-gray-800 mb-4 flex items-center">
                            <i class="fas fa-info-circle text-purple-600 mr-2"></i>
                            Leave Type Info
                        </h3>
                        <div class="space-y-3">
                            <div class="flex justify-between items-center p-3 bg-purple-50 rounded-lg">
                                <span class="text-sm text-gray-600">Leave Type</span>
                                <span class="font-medium text-purple-800">{{ $leaveRequest->leaveType->name }}</span>
                            </div>
                            <div class="flex justify-between items-center p-3 bg-purple-50 rounded-lg">
                                <span class="text-sm text-gray-600">Maximum Days</span>
                                <span class="font-medium text-purple-800">{{ $leaveRequest->leaveType->max_days }} days</span>
                            </div>
                            @if($leaveRequest->leaveType->description)
                            <div class="p-3 bg-purple-50 rounded-lg">
                                <span class="text-sm text-gray-600 block mb-1">Description</span>
                                <span class="text-sm text-purple-800">{{ $leaveRequest->leaveType->description }}</span>
                            </div>
                            @endif
                        </div>
                    </div>

                    <!-- Application Timeline -->
                    <div class="bg-white rounded-xl shadow-sm border border-gray-200 p-6">
                        <h3 class="text-lg font-semibold text-gray-800 mb-4 flex items-center">
                            <i class="fas fa-history text-gray-600 mr-2"></i>
                            Timeline
                        </h3>
                        <div class="space-y-4">
                            <div class="flex items-start space-x-3">
                                <div class="w-8 h-8 bg-blue-100 rounded-full flex items-center justify-center mt-1">
                                    <i class="fas fa-paper-plane text-blue-600 text-sm"></i>
                                </div>
                                <div>
                                    <p class="font-medium text-gray-800">Application Submitted</p>
                                    <p class="text-sm text-gray-500">{{ \Carbon\Carbon::parse($leaveRequest->created_at)->format('M d, Y \a\t h:i A') }}</p>
                                </div>
                            </div>
                            
                            @if($leaveRequest->status === 'approved')
                            <div class="flex items-start space-x-3">
                                <div class="w-8 h-8 bg-green-100 rounded-full flex items-center justify-center mt-1">
                                    <i class="fas fa-check text-green-600 text-sm"></i>
                                </div>
                                <div>
                                    <p class="font-medium text-gray-800">Approved</p>
                                    <p class="text-sm text-gray-500">{{ \Carbon\Carbon::parse($leaveRequest->approved_at)->format('M d, Y \a\t h:i A') }}</p>
                                    @if($leaveRequest->head_remarks)
                                    <p class="text-sm text-gray-600 mt-1">Remarks: {{ $leaveRequest->head_remarks }}</p>
                                    @endif
                                </div>
                            </div>
                            @endif

                            @if($leaveRequest->status === 'rejected')
                            <div class="flex items-start space-x-3">
                                <div class="w-8 h-8 bg-red-100 rounded-full flex items-center justify-center mt-1">
                                    <i class="fas fa-times text-red-600 text-sm"></i>
                                </div>
                                <div>
                                    <p class="font-medium text-gray-800">Rejected</p>
                                    <p class="text-sm text-gray-500">{{ \Carbon\Carbon::parse($leaveRequest->approved_at)->format('M d, Y \a\t h:i A') }}</p>
                                    @if($leaveRequest->head_remarks)
                                    <p class="text-sm text-red-600 mt-1">Reason: {{ $leaveRequest->head_remarks }}</p>
                                    @endif
                                </div>
                            </div>
                            @endif
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Reject Modal -->
        @if($leaveRequest->status === 'pending')
        <div id="rejectModal" class="fixed inset-0 bg-black bg-opacity-50 flex items-center justify-center z-50 hidden">
            <div class="bg-white rounded-xl shadow-lg p-6 w-full max-w-md mx-4">
                <h3 class="text-lg font-semibold text-gray-800 mb-4">Reject Leave Request</h3>
                <form id="rejectForm" method="POST">
                    @csrf
                    <div class="mb-4">
                        <label for="rejectReason" class="block text-sm font-medium text-gray-700 mb-2">
                            Reason for Rejection <span class="text-red-500">*</span>
                        </label>
                        <textarea 
                            id="rejectReason" 
                            name="reason" 
                            rows="4" 
                            class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-red-500 focus:border-transparent"
                            placeholder="Please provide a reason for rejecting this leave request..."
                            required
                        ></textarea>
                    </div>
                    <div class="flex space-x-3">
                        <button type="button" onclick="hideRejectModal()" class="flex-1 bg-gray-600 text-white py-2 rounded-lg hover:bg-gray-700 transition duration-200">
                            Cancel
                        </button>
                        <button type="submit" class="flex-1 bg-red-600 text-white py-2 rounded-lg hover:bg-red-700 transition duration-200">
                            Confirm Reject
                        </button>
                    </div>
                </form>
            </div>
        </div>
        @endif

        @push('scripts')
        <script>
            function showRejectModal() {
                const modal = document.getElementById('rejectModal');
                const form = document.getElementById('rejectForm');
                form.action = '/head/reject/{{ $leaveRequest->id }}';
                modal.classList.remove('hidden');
            }

            function hideRejectModal() {
                const modal = document.getElementById('rejectModal');
                modal.classList.add('hidden');
            }

            // Handle reject form submission
            document.getElementById('rejectForm')?.addEventListener('submit', function(e) {
                e.preventDefault();
                
                const form = this;
                const formData = new FormData(form);
                const reason = formData.get('reason');
                
                if (!reason || reason.trim().length < 5) {
                    alert('Please provide a valid reason for rejection (at least 5 characters).');
                    return;
                }

                // Show loading state
                const submitBtn = form.querySelector('button[type="submit"]');
                const originalText = submitBtn.innerHTML;
                submitBtn.innerHTML = '<i class="fas fa-spinner fa-spin mr-2"></i>Rejecting...';
                submitBtn.disabled = true;

                fetch(form.action, {
                    method: 'POST',
                    headers: {
                        'X-Requested-With': 'XMLHttpRequest',
                        'X-CSRF-TOKEN': '{{ csrf_token() }}',
                        'Accept': 'application/json',
                        'Content-Type': 'application/json'
                    },
                    body: JSON.stringify({
                        reason: reason
                    })
                })
                .then(response => response.json())
                .then(data => {
                    if (data.success) {
                        showNotification(data.message, 'success');
                        hideRejectModal();
                        // Reload page to reflect status change
                        setTimeout(() => window.location.reload(), 1500);
                    } else {
                        showNotification(data.message, 'error');
                        submitBtn.innerHTML = originalText;
                        submitBtn.disabled = false;
                    }
                })
                .catch(error => {
                    showNotification('An error occurred while rejecting the leave request.', 'error');
                    submitBtn.innerHTML = originalText;
                    submitBtn.disabled = false;
                });
            });

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

            // Close modal when clicking outside
            document.getElementById('rejectModal')?.addEventListener('click', function(e) {
                if (e.target === this) {
                    hideRejectModal();
                }
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