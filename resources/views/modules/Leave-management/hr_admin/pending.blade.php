@extends('layouts.app')

@section('title', 'HR Pending Approvals - Nish Auto Limited')
@section('page-title', 'HR Pending Approvals')

@php
    $isAdmin = true;
@endphp

@section('content')
<div class="space-y-6">
    <!-- HR Stats -->
    <div class="grid grid-cols-1 md:grid-cols-4 gap-6">
        <div class="bg-white rounded-xl shadow-sm border border-gray-200 p-6">
            <div class="flex items-center justify-between">
                <div>
                    <p class="text-sm font-medium text-gray-600">HR Pending</p>
                    <p class="text-3xl font-bold text-gray-800 mt-2">12</p>
                    <p class="text-xs text-orange-600 mt-1">
                        <i class="fas fa-clock mr-1"></i>Awaiting HR approval
                    </p>
                </div>
                <div class="w-12 h-12 bg-orange-100 rounded-lg flex items-center justify-center">
                    <i class="fas fa-clock text-orange-600 text-xl"></i>
                </div>
            </div>
        </div>
        
        <div class="bg-white rounded-xl shadow-sm border border-gray-200 p-6">
            <div class="flex items-center justify-between">
                <div>
                    <p class="text-sm font-medium text-gray-600">Approved Today</p>
                    <p class="text-3xl font-bold text-gray-800 mt-2">5</p>
                    <p class="text-xs text-green-600 mt-1">
                        <i class="fas fa-check-circle mr-1"></i>HR approved
                    </p>
                </div>
                <div class="w-12 h-12 bg-green-100 rounded-lg flex items-center justify-center">
                    <i class="fas fa-check-circle text-green-600 text-xl"></i>
                </div>
            </div>
        </div>
        
        <div class="bg-white rounded-xl shadow-sm border border-gray-200 p-6">
            <div class="flex items-center justify-between">
                <div>
                    <p class="text-sm font-medium text-gray-600">Departments</p>
                    <p class="text-3xl font-bold text-gray-800 mt-2">8</p>
                    <p class="text-xs text-purple-600 mt-1">
                        <i class="fas fa-building mr-1"></i>Active departments
                    </p>
                </div>
                <div class="w-12 h-12 bg-purple-100 rounded-lg flex items-center justify-center">
                    <i class="fas fa-building text-purple-600 text-xl"></i>
                </div>
            </div>
        </div>
        
        <div class="bg-white rounded-xl shadow-sm border border-gray-200 p-6">
            <div class="flex items-center justify-between">
                <div>
                    <p class="text-sm font-medium text-gray-600">Total Employees</p>
                    <p class="text-3xl font-bold text-gray-800 mt-2">147</p>
                    <p class="text-xs text-blue-600 mt-1">
                        <i class="fas fa-users mr-1"></i>All employees
                    </p>
                </div>
                <div class="w-12 h-12 bg-blue-100 rounded-lg flex items-center justify-center">
                    <i class="fas fa-users text-blue-600 text-xl"></i>
                </div>
            </div>
        </div>
    </div>

    <!-- Filters -->
    <div class="bg-white rounded-xl shadow-sm border border-gray-200 p-6">
        <div class="flex flex-col lg:flex-row lg:items-center lg:justify-between gap-4">
            <div class="flex flex-col sm:flex-row gap-4">
                <select class="px-4 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent">
                    <option>All Departments</option>
                    <option>Assembly</option>
                    <option>Spare Parts</option>
                    <option>Mechanical</option>
                    <option>Electrical</option>
                    <option>Sales & Marketing</option>
                </select>
                
                <select class="px-4 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent">
                    <option>All Leave Types</option>
                    <option>Annual Leave</option>
                    <option>Sick Leave</option>
                    <option>Emergency Leave</option>
                    <option>Maternity Leave</option>
                </select>
                
                <select class="px-4 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent">
                    <option>Priority: All</option>
                    <option>Priority: High</option>
                    <option>Priority: Medium</option>
                    <option>Priority: Low</option>
                </select>
            </div>
            
            <div class="flex space-x-2">
                <button class="bg-blue-600 text-white px-4 py-2 rounded-lg hover:bg-blue-700 transition duration-200 font-medium">
                    <i class="fas fa-filter mr-2"></i>Apply Filters
                </button>
                <button class="bg-gray-200 text-gray-800 px-4 py-2 rounded-lg hover:bg-gray-300 transition duration-200 font-medium">
                    <i class="fas fa-redo mr-2"></i>Reset
                </button>
            </div>
        </div>
    </div>

    <!-- Department-wise Pending Requests -->
    <div class="bg-white rounded-xl shadow-sm border border-gray-200 overflow-hidden">
        <div class="px-6 py-4 border-b border-gray-200 bg-gray-50">
            <h3 class="text-lg font-semibold text-gray-800">Pending HR Approvals by Department</h3>
            <p class="text-sm text-gray-600 mt-1">Leave requests approved by department heads, awaiting HR final approval</p>
        </div>
        
        <div class="divide-y divide-gray-200">
            <!-- Assembly Department -->
            <div class="p-6">
                <div class="flex items-center justify-between mb-4">
                    <h4 class="text-lg font-medium text-gray-900 flex items-center">
                        <i class="fas fa-cogs text-blue-500 mr-2"></i>
                        Assembly Department
                    </h4>
                    <span class="px-3 py-1 bg-blue-100 text-blue-800 text-sm rounded-full font-medium">3 pending</span>
                </div>
                
                <div class="space-y-4">
                    <!-- Request Item 1 -->
                    <div class="flex items-center justify-between p-4 border border-gray-200 rounded-lg hover:bg-gray-50 transition duration-200">
                        <div class="flex items-center space-x-4">
                            <div class="w-12 h-12 bg-blue-100 rounded-full flex items-center justify-center">
                                <span class="text-blue-600 text-sm font-semibold">MA</span>
                            </div>
                            <div>
                                <p class="font-medium text-gray-900">Mugisha Andrew</p>
                                <p class="text-sm text-gray-600">Annual Leave • 5 days</p>
                                <p class="text-xs text-gray-500 mt-1">
                                    <i class="fas fa-user-tie mr-1"></i>Dept Head: John Kamau
                                </p>
                            </div>
                        </div>
                        <div class="text-right">
                            <p class="text-sm text-gray-900">Dec 20 - Dec 24, 2024</p>
                            <p class="text-xs text-green-600">
                                <i class="fas fa-check-circle mr-1"></i>Dept Approved: Dec 10
                            </p>
                        </div>
                        <div class="flex space-x-2">
                            <button class="bg-green-600 text-white px-4 py-2 rounded-lg hover:bg-green-700 transition duration-200 text-sm font-medium">
                                <i class="fas fa-check mr-2"></i>Approve
                            </button>
                            <button class="bg-red-600 text-white px-4 py-2 rounded-lg hover:bg-red-700 transition duration-200 text-sm font-medium">
                                <i class="fas fa-times mr-2"></i>Reject
                            </button>
                            <button class="bg-gray-200 text-gray-800 px-4 py-2 rounded-lg hover:bg-gray-300 transition duration-200 text-sm font-medium">
                                <i class="fas fa-eye mr-2"></i>View
                            </button>
                        </div>
                    </div>

                    <!-- Request Item 2 -->
                    <div class="flex items-center justify-between p-4 border border-gray-200 rounded-lg hover:bg-gray-50 transition duration-200">
                        <div class="flex items-center space-x-4">
                            <div class="w-12 h-12 bg-green-100 rounded-full flex items-center justify-center">
                                <span class="text-green-600 text-sm font-semibold">SS</span>
                            </div>
                            <div>
                                <p class="font-medium text-gray-900">Sarah Smith</p>
                                <p class="text-sm text-gray-600">Sick Leave • 3 days</p>
                                <p class="text-xs text-gray-500 mt-1">
                                    <i class="fas fa-user-tie mr-1"></i>Dept Head: John Kamau
                                </p>
                            </div>
                        </div>
                        <div class="text-right">
                            <p class="text-sm text-gray-900">Dec 18 - Dec 20, 2024</p>
                            <p class="text-xs text-green-600">
                                <i class="fas fa-check-circle mr-1"></i>Dept Approved: Dec 15
                            </p>
                        </div>
                        <div class="flex space-x-2">
                            <button class="bg-green-600 text-white px-4 py-2 rounded-lg hover:bg-green-700 transition duration-200 text-sm font-medium">
                                <i class="fas fa-check mr-2"></i>Approve
                            </button>
                            <button class="bg-red-600 text-white px-4 py-2 rounded-lg hover:bg-red-700 transition duration-200 text-sm font-medium">
                                <i class="fas fa-times mr-2"></i>Reject
                            </button>
                            <button class="bg-gray-200 text-gray-800 px-4 py-2 rounded-lg hover:bg-gray-300 transition duration-200 text-sm font-medium">
                                <i class="fas fa-eye mr-2"></i>View
                            </button>
                        </div>
                    </div>
                </div>
            </div>
            
            <!-- Mechanical Department -->
            <div class="p-6">
                <div class="flex items-center justify-between mb-4">
                    <h4 class="text-lg font-medium text-gray-900 flex items-center">
                        <i class="fas fa-wrench text-orange-500 mr-2"></i>
                        Mechanical Department
                    </h4>
                    <span class="px-3 py-1 bg-orange-100 text-orange-800 text-sm rounded-full font-medium">2 pending</span>
                </div>
                
                <div class="space-y-4">
                    <!-- Request Item -->
                    <div class="flex items-center justify-between p-4 border border-gray-200 rounded-lg hover:bg-gray-50 transition duration-200">
                        <div class="flex items-center space-x-4">
                            <div class="w-12 h-12 bg-purple-100 rounded-full flex items-center justify-center">
                                <span class="text-purple-600 text-sm font-semibold">MJ</span>
                            </div>
                            <div>
                                <p class="font-medium text-gray-900">Mike Johnson</p>
                                <p class="text-sm text-gray-600">Annual Leave • 10 days</p>
                                <p class="text-xs text-gray-500 mt-1">
                                    <i class="fas fa-user-tie mr-1"></i>Dept Head: Robert Chen
                                </p>
                            </div>
                        </div>
                        <div class="text-right">
                            <p class="text-sm text-gray-900">Jan 5 - Jan 14, 2024</p>
                            <p class="text-xs text-green-600">
                                <i class="fas fa-check-circle mr-1"></i>Dept Approved: Dec 12
                            </p>
                        </div>
                        <div class="flex space-x-2">
                            <button class="bg-green-600 text-white px-4 py-2 rounded-lg hover:bg-green-700 transition duration-200 text-sm font-medium">
                                <i class="fas fa-check mr-2"></i>Approve
                            </button>
                            <button class="bg-red-600 text-white px-4 py-2 rounded-lg hover:bg-red-700 transition duration-200 text-sm font-medium">
                                <i class="fas fa-times mr-2"></i>Reject
                            </button>
                            <button class="bg-gray-200 text-gray-800 px-4 py-2 rounded-lg hover:bg-gray-300 transition duration-200 text-sm font-medium">
                                <i class="fas fa-eye mr-2"></i>View
                            </button>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Sales & Marketing Department -->
            <div class="p-6">
                <div class="flex items-center justify-between mb-4">
                    <h4 class="text-lg font-medium text-gray-900 flex items-center">
                        <i class="fas fa-chart-line text-green-500 mr-2"></i>
                        Sales & Marketing
                    </h4>
                    <span class="px-3 py-1 bg-green-100 text-green-800 text-sm rounded-full font-medium">4 pending</span>
                </div>
                
                <div class="space-y-4">
                    <!-- Request Item -->
                    <div class="flex items-center justify-between p-4 border border-gray-200 rounded-lg hover:bg-gray-50 transition duration-200">
                        <div class="flex items-center space-x-4">
                            <div class="w-12 h-12 bg-red-100 rounded-full flex items-center justify-center">
                                <span class="text-red-600 text-sm font-semibold">AL</span>
                            </div>
                            <div>
                                <p class="font-medium text-gray-900">Alice Lopez</p>
                                <p class="text-sm text-gray-600">Maternity Leave • 90 days</p>
                                <p class="text-xs text-gray-500 mt-1">
                                    <i class="fas fa-user-tie mr-1"></i>Dept Head: Maria Garcia
                                </p>
                            </div>
                        </div>
                        <div class="text-right">
                            <p class="text-sm text-gray-900">Mar 1 - May 29, 2024</p>
                            <p class="text-xs text-green-600">
                                <i class="fas fa-check-circle mr-1"></i>Dept Approved: Dec 11
                            </p>
                        </div>
                        <div class="flex space-x-2">
                            <button class="bg-green-600 text-white px-4 py-2 rounded-lg hover:bg-green-700 transition duration-200 text-sm font-medium">
                                <i class="fas fa-check mr-2"></i>Approve
                            </button>
                            <button class="bg-red-600 text-white px-4 py-2 rounded-lg hover:bg-red-700 transition duration-200 text-sm font-medium">
                                <i class="fas fa-times mr-2"></i>Reject
                            </button>
                            <button class="bg-gray-200 text-gray-800 px-4 py-2 rounded-lg hover:bg-gray-300 transition duration-200 text-sm font-medium">
                                <i class="fas fa-eye mr-2"></i>View
                            </button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Quick Actions -->
    <div class="bg-white rounded-xl shadow-sm border border-gray-200 p-6">
        <h3 class="text-lg font-semibold text-gray-800 mb-4">Quick Actions</h3>
        <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
            <button class="flex items-center space-x-3 p-4 border border-gray-200 rounded-lg hover:bg-blue-50 hover:border-blue-200 transition duration-200">
                <div class="w-10 h-10 bg-blue-100 rounded-lg flex items-center justify-center">
                    <i class="fas fa-check-double text-blue-600"></i>
                </div>
                <div class="text-left">
                    <p class="font-medium text-gray-800">Approve All</p>
                    <p class="text-sm text-gray-600">Approve all pending requests</p>
                </div>
            </button>
            
            <button class="flex items-center space-x-3 p-4 border border-gray-200 rounded-lg hover:bg-green-50 hover:border-green-200 transition duration-200">
                <div class="w-10 h-10 bg-green-100 rounded-lg flex items-center justify-center">
                    <i class="fas fa-file-export text-green-600"></i>
                </div>
                <div class="text-left">
                    <p class="font-medium text-gray-800">Export Report</p>
                    <p class="text-sm text-gray-600">Download pending approvals</p>
                </div>
            </button>
            
            <button class="flex items-center space-x-3 p-4 border border-gray-200 rounded-lg hover:bg-purple-50 hover:border-purple-200 transition duration-200">
                <div class="w-10 h-10 bg-purple-100 rounded-lg flex items-center justify-center">
                    <i class="fas fa-envelope text-purple-600"></i>
                </div>
                <div class="text-left">
                    <p class="font-medium text-gray-800">Send Reminders</p>
                    <p class="text-sm text-gray-600">Notify department heads</p>
                </div>
            </button>
        </div>
    </div>
</div>
@endsection

@push('styles')
<style>
    .approval-item {
        transition: all 0.2s ease;
    }
    
    .approval-item:hover {
        transform: translateY(-1px);
        box-shadow: 0 4px 6px -1px rgba(0, 0, 0, 0.1);
    }
    
    .department-header {
        border-left: 4px solid transparent;
    }
    
    .department-header.assembly {
        border-left-color: #3b82f6;
    }
    
    .department-header.mechanical {
        border-left-color: #f59e0b;
    }
    
    .department-header.sales {
        border-left-color: #10b981;
    }
</style>
@endpush

@push('scripts')
<script>
    document.addEventListener('DOMContentLoaded', function() {
        // Add department-specific styling
        const departmentHeaders = document.querySelectorAll('.p-6');
        departmentHeaders.forEach(header => {
            if (header.querySelector('.fa-cogs')) {
                header.querySelector('h4').classList.add('department-header', 'assembly');
            } else if (header.querySelector('.fa-wrench')) {
                header.querySelector('h4').classList.add('department-header', 'mechanical');
            } else if (header.querySelector('.fa-chart-line')) {
                header.querySelector('h4').classList.add('department-header', 'sales');
            }
        });

        // Add approval/reject functionality
        const approveButtons = document.querySelectorAll('button:contains("Approve")');
        const rejectButtons = document.querySelectorAll('button:contains("Reject")');
        
        approveButtons.forEach(button => {
            button.addEventListener('click', function() {
                const item = this.closest('.flex.items-center.justify-between');
                const employeeName = item.querySelector('.font-medium').textContent;
                if (confirm(`Approve leave request for ${employeeName}?`)) {
                    item.style.opacity = '0.5';
                    setTimeout(() => {
                        item.remove();
                        updatePendingCounts();
                    }, 500);
                }
            });
        });
        
        rejectButtons.forEach(button => {
            button.addEventListener('click', function() {
                const item = this.closest('.flex.items-center.justify-between');
                const employeeName = item.querySelector('.font-medium').textContent;
                if (confirm(`Reject leave request for ${employeeName}?`)) {
                    item.style.opacity = '0.5';
                    setTimeout(() => {
                        item.remove();
                        updatePendingCounts();
                    }, 500);
                }
            });
        });

        function updatePendingCounts() {
            // This would typically update the counts from the server
            console.log('Pending counts updated');
        }

        // Add filter functionality
        const filterButtons = document.querySelectorAll('button:contains("Apply Filters"), button:contains("Reset")');
        filterButtons.forEach(button => {
            button.addEventListener('click', function() {
                const action = this.textContent.includes('Apply') ? 'applied' : 'reset';
                alert(`Filters ${action}. This would filter the pending requests.`);
            });
        });
    });
</script>
@endpush