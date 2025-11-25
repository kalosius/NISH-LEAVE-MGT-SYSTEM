@extends('layouts.app')

@section('title', 'Leave Policies - Nish Auto Limited')
@section('page-title', 'Leave Policies')

@section('content')
@auth
    @if(Auth::user()->isHead())
        <div class="max-w-6xl mx-auto">
            <!-- Header -->
            <div class="bg-white rounded-xl shadow-sm border border-gray-200 p-6 mb-6">
                <div class="flex items-center justify-between mb-4">
                    <div>
                        <h1 class="text-2xl font-bold text-gray-800">Leave Policies</h1>
                        <p class="text-gray-600">Company leave policies and guidelines for your department</p>
                    </div>
                    <div class="flex items-center space-x-4">
                        <div class="text-right">
                            <p class="text-sm text-gray-600">Department</p>
                            <p class="font-semibold text-gray-800">{{ $department->name ?? 'Your Department' }}</p>
                        </div>
                        <a href="{{ route('head.dashboard') }}" class="bg-blue-600 text-white px-4 py-2 rounded-lg hover:bg-blue-700 transition duration-200">
                            <i class="fas fa-arrow-left mr-2"></i>Back to Dashboard
                        </a>
                    </div>
                </div>
            </div>

            <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">
                <!-- Main Content -->
                <div class="lg:col-span-2 space-y-6">
                    <!-- Company Leave Policy -->
                    <div class="bg-white rounded-xl shadow-sm border border-gray-200 p-6">
                        <h2 class="text-xl font-semibold text-gray-800 mb-4 flex items-center">
                            <i class="fas fa-building text-blue-600 mr-3"></i>
                            Company Leave Policy
                        </h2>
                        <div class="prose max-w-none">
                            <p class="text-gray-700 mb-4">
                                Nish Auto Limited provides various types of leave to support employee well-being and work-life balance. 
                                All leave requests must be submitted through the online system and approved by the department head.
                            </p>
                            
                            <div class="bg-blue-50 border-l-4 border-blue-500 p-4 mb-4">
                                <p class="text-blue-700 font-medium">Important Notice</p>
                                <p class="text-blue-600 text-sm mt-1">
                                    All leave applications should be submitted at least 3 working days in advance for planned leaves. 
                                    Emergency leaves require immediate notification to the department head.
                                </p>
                            </div>
                        </div>
                    </div>

                    <!-- Leave Types -->
                    <div class="bg-white rounded-xl shadow-sm border border-gray-200 p-6">
                        <h2 class="text-xl font-semibold text-gray-800 mb-6 flex items-center">
                            <i class="fas fa-list-alt text-green-600 mr-3"></i>
                            Available Leave Types
                        </h2>
                        
                        <div class="space-y-4">
                            @foreach($leaveTypes as $leaveType)
                                <div class="border border-gray-200 rounded-lg p-4 hover:shadow-md transition-shadow">
                                    <div class="flex items-center justify-between mb-2">
                                        <h3 class="text-lg font-semibold text-gray-800">{{ $leaveType->name }}</h3>
                                        <span class="px-3 py-1 bg-blue-100 text-blue-800 text-sm rounded-full font-medium">
                                            Max: {{ $leaveType->max_days }} days
                                        </span>
                                    </div>
                                    <p class="text-gray-600 mb-3">{{ $leaveType->description }}</p>
                                    
                                    <div class="grid grid-cols-1 md:grid-cols-3 gap-4 text-sm">
                                        <div class="flex items-center space-x-2">
                                            <i class="fas fa-clock text-gray-400"></i>
                                            <span class="text-gray-600">Advance Notice: 
                                                <span class="font-medium">{{ $leaveType->advance_notice_days ?? '3' }} days</span>
                                            </span>
                                        </div>
                                        <div class="flex items-center space-x-2">
                                            <i class="fas fa-file-alt text-gray-400"></i>
                                            <span class="text-gray-600">Documentation: 
                                                <span class="font-medium">{{ $leaveType->requires_documentation ? 'Required' : 'Not Required' }}</span>
                                            </span>
                                        </div>
                                        <div class="flex items-center space-x-2">
                                            <i class="fas fa-calendar-check text-gray-400"></i>
                                            <span class="text-gray-600">Carry Forward: 
                                                <span class="font-medium">{{ $leaveType->can_carry_forward ? 'Yes' : 'No' }}</span>
                                            </span>
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    </div>

                    <!-- Approval Guidelines -->
                    <div class="bg-white rounded-xl shadow-sm border border-gray-200 p-6">
                        <h2 class="text-xl font-semibold text-gray-800 mb-4 flex items-center">
                            <i class="fas fa-check-circle text-purple-600 mr-3"></i>
                            Approval Guidelines for Department Heads
                        </h2>
                        
                        <div class="space-y-4">
                            <div class="flex items-start space-x-3 p-3 bg-green-50 rounded-lg">
                                <i class="fas fa-check text-green-600 mt-1"></i>
                                <div>
                                    <h4 class="font-semibold text-green-800">When to Approve</h4>
                                    <ul class="text-green-700 text-sm mt-1 space-y-1">
                                        <li>• Sufficient leave balance available</li>
                                        <li>• Adequate advance notice provided</li>
                                        <li>• No critical department activities during requested period</li>
                                        <li>• Proper handover arrangements made</li>
                                    </ul>
                                </div>
                            </div>
                            
                            <div class="flex items-start space-x-3 p-3 bg-red-50 rounded-lg">
                                <i class="fas fa-times text-red-600 mt-1"></i>
                                <div>
                                    <h4 class="font-semibold text-red-800">When to Reject</h4>
                                    <ul class="text-red-700 text-sm mt-1 space-y-1">
                                        <li>• Insufficient staff coverage during peak periods</li>
                                        <li>• Multiple team members requesting same dates</li>
                                        <li>• Critical project deadlines approaching</li>
                                        <li>• Incomplete application or missing information</li>
                                    </ul>
                                </div>
                            </div>
                            
                            <div class="flex items-start space-x-3 p-3 bg-blue-50 rounded-lg">
                                <i class="fas fa-info-circle text-blue-600 mt-1"></i>
                                <div>
                                    <h4 class="font-semibold text-blue-800">Best Practices</h4>
                                    <ul class="text-blue-700 text-sm mt-1 space-y-1">
                                        <li>• Review applications within 24 hours of submission</li>
                                        <li>• Provide clear reasons for rejection</li>
                                        <li>• Consider team workload and project timelines</li>
                                        <li>• Maintain fairness and consistency in approvals</li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Sidebar -->
                <div class="space-y-6">
                    <!-- Quick Stats -->
                    <div class="bg-white rounded-xl shadow-sm border border-gray-200 p-6">
                        <h3 class="text-lg font-semibold text-gray-800 mb-4">Department Statistics</h3>
                        <div class="space-y-3">
                            <div class="flex justify-between items-center p-3 bg-gray-50 rounded-lg">
                                <span class="text-sm text-gray-600">Total Team Members</span>
                                <span class="font-semibold text-gray-800">{{ $teamStats['total_members'] ?? 0 }}</span>
                            </div>
                            <div class="flex justify-between items-center p-3 bg-blue-50 rounded-lg">
                                <span class="text-sm text-gray-600">Pending Approvals</span>
                                <span class="font-semibold text-blue-800">{{ $teamStats['pending_approvals'] ?? 0 }}</span>
                            </div>
                            <div class="flex justify-between items-center p-3 bg-green-50 rounded-lg">
                                <span class="text-sm text-gray-600">Approved This Month</span>
                                <span class="font-semibold text-green-800">{{ $teamStats['approved_this_month'] ?? 0 }}</span>
                            </div>
                            <div class="flex justify-between items-center p-3 bg-red-50 rounded-lg">
                                <span class="text-sm text-gray-600">Rejected This Month</span>
                                <span class="font-semibold text-red-800">{{ $teamStats['rejected_this_month'] ?? 0 }}</span>
                            </div>
                        </div>
                    </div>

                    <!-- Important Contacts -->
                    <div class="bg-white rounded-xl shadow-sm border border-gray-200 p-6">
                        <h3 class="text-lg font-semibold text-gray-800 mb-4">Important Contacts</h3>
                        <div class="space-y-3">
                            <div class="flex items-center space-x-3 p-3 bg-yellow-50 rounded-lg">
                                <i class="fas fa-user-tie text-yellow-600"></i>
                                <div>
                                    <p class="text-sm font-medium text-gray-800">HR Department</p>
                                    <p class="text-xs text-gray-600">hr@nishauto.com</p>
                                </div>
                            </div>
                            <div class="flex items-center space-x-3 p-3 bg-purple-50 rounded-lg">
                                <i class="fas fa-headset text-purple-600"></i>
                                <div>
                                    <p class="text-sm font-medium text-gray-800">IT Support</p>
                                    <p class="text-xs text-gray-600">support@nishauto.com</p>
                                </div>
                            </div>
                            <div class="flex items-center space-x-3 p-3 bg-green-50 rounded-lg">
                                <i class="fas fa-file-contract text-green-600"></i>
                                <div>
                                    <p class="text-sm font-medium text-gray-800">Policy Queries</p>
                                    <p class="text-xs text-gray-600">policies@nishauto.com</p>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Quick Links -->
                    <div class="bg-white rounded-xl shadow-sm border border-gray-200 p-6">
                        <h3 class="text-lg font-semibold text-gray-800 mb-4">Quick Links</h3>
                        <div class="space-y-2">
                            <a href="{{ route('head.leaves.pending') }}" class="flex items-center space-x-2 p-2 text-blue-600 hover:bg-blue-50 rounded-lg transition duration-200">
                                <i class="fas fa-clock w-5"></i>
                                <span>Pending Approvals</span>
                            </a>
                            <a href="{{ route('head.team.members') }}" class="flex items-center space-x-2 p-2 text-green-600 hover:bg-green-50 rounded-lg transition duration-200">
                                <i class="fas fa-users w-5"></i>
                                <span>Team Members</span>
                            </a>
                            <a href="{{ route('head.team.calendar') }}" class="flex items-center space-x-2 p-2 text-purple-600 hover:bg-purple-50 rounded-lg transition duration-200">
                                <i class="fas fa-calendar-alt w-5"></i>
                                <span>Team Calendar</span>
                            </a>
                            <a href="{{ route('head.reports') }}" class="flex items-center space-x-2 p-2 text-orange-600 hover:bg-orange-50 rounded-lg transition duration-200">
                                <i class="fas fa-chart-bar w-5"></i>
                                <span>Leave Reports</span>
                            </a>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Policy Documents -->
            <div class="bg-white rounded-xl shadow-sm border border-gray-200 p-6 mt-6">
                <h2 class="text-xl font-semibold text-gray-800 mb-4 flex items-center">
                    <i class="fas fa-file-pdf text-red-600 mr-3"></i>
                    Policy Documents
                </h2>
                <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-4">
                    <div class="border border-gray-200 rounded-lg p-4 hover:shadow-md transition-shadow">
                        <div class="flex items-center space-x-3 mb-3">
                            <i class="fas fa-file-pdf text-red-500 text-xl"></i>
                            <div>
                                <h4 class="font-semibold text-gray-800">Leave Policy Handbook</h4>
                                <p class="text-sm text-gray-600">PDF • 2.4 MB</p>
                            </div>
                        </div>
                        <button class="w-full bg-red-600 text-white py-2 rounded-lg hover:bg-red-700 transition duration-200 text-sm">
                            <i class="fas fa-download mr-2"></i>Download
                        </button>
                    </div>
                    
                    <div class="border border-gray-200 rounded-lg p-4 hover:shadow-md transition-shadow">
                        <div class="flex items-center space-x-3 mb-3">
                            <i class="fas fa-file-pdf text-red-500 text-xl"></i>
                            <div>
                                <h4 class="font-semibold text-gray-800">Approval Process Guide</h4>
                                <p class="text-sm text-gray-600">PDF • 1.8 MB</p>
                            </div>
                        </div>
                        <button class="w-full bg-red-600 text-white py-2 rounded-lg hover:bg-red-700 transition duration-200 text-sm">
                            <i class="fas fa-download mr-2"></i>Download
                        </button>
                    </div>
                    
                    <div class="border border-gray-200 rounded-lg p-4 hover:shadow-md transition-shadow">
                        <div class="flex items-center space-x-3 mb-3">
                            <i class="fas fa-file-pdf text-red-500 text-xl"></i>
                            <div>
                                <h4 class="font-semibold text-gray-800">Emergency Procedures</h4>
                                <p class="text-sm text-gray-600">PDF • 1.2 MB</p>
                            </div>
                        </div>
                        <button class="w-full bg-red-600 text-white py-2 rounded-lg hover:bg-red-700 transition duration-200 text-sm">
                            <i class="fas fa-download mr-2"></i>Download
                        </button>
                    </div>
                </div>
            </div>
        </div>

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