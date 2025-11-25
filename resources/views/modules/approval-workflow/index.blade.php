@extends('layouts.app')

@section('title', 'Approval Workflow - Nish Auto Limited')
@section('page-title', 'Approval Workflow')

@php
    $isAdmin = true;
@endphp

@section('content')
<div class="grid grid-cols-1 lg:grid-cols-4 gap-6 mb-6">
    <!-- Main Content -->
    <div class="lg:col-span-3">
        <!-- Header with Actions -->
        <div class="bg-white rounded-xl shadow-sm border border-gray-200 p-6 mb-6">
            <div class="flex flex-col md:flex-row md:items-center justify-between">
                <div>
                    <h2 class="text-xl font-bold text-gray-800">Approval Workflow Management</h2>
                    <p class="text-gray-600 mt-1">Configure and manage leave approval processes</p>
                </div>
                <div class="flex space-x-3 mt-4 md:mt-0">
                    <button class="flex items-center space-x-2 px-4 py-2 border border-gray-300 rounded-lg hover:bg-gray-50 transition duration-200">
                        <i class="fas fa-download text-gray-600"></i>
                        <span class="text-sm font-medium text-gray-700">Export</span>
                    </button>
                    <button class="flex items-center space-x-2 px-4 py-2 bg-blue-600 text-white rounded-lg hover:bg-blue-700 transition duration-200">
                        <i class="fas fa-plus"></i>
                        <span class="text-sm font-medium">New Workflow</span>
                    </button>
                </div>
            </div>
        </div>

        <!-- Workflow Statistics -->
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6 mb-6">
            <!-- Active Workflows -->
            <div class="stat-card bg-white rounded-xl shadow-sm border border-gray-200 p-6">
                <div class="flex items-center justify-between">
                    <div>
                        <p class="text-sm font-medium text-gray-600">Active Workflows</p>
                        <p class="text-3xl font-bold text-gray-800 mt-2">8</p>
                        <p class="text-xs text-green-600 mt-1">
                            <i class="fas fa-play-circle mr-1"></i>Currently running
                        </p>
                    </div>
                    <div class="w-12 h-12 bg-green-100 rounded-lg flex items-center justify-center">
                        <i class="fas fa-play-circle text-green-600 text-xl"></i>
                    </div>
                </div>
            </div>

            <!-- Pending Approvals -->
            <div class="stat-card bg-white rounded-xl shadow-sm border border-gray-200 p-6">
                <div class="flex items-center justify-between">
                    <div>
                        <p class="text-sm font-medium text-gray-600">Pending Approvals</p>
                        <p class="text-3xl font-bold text-gray-800 mt-2">23</p>
                        <p class="text-xs text-orange-600 mt-1">
                            <i class="fas fa-clock mr-1"></i>Awaiting action
                        </p>
                    </div>
                    <div class="w-12 h-12 bg-orange-100 rounded-lg flex items-center justify-center">
                        <i class="fas fa-clock text-orange-600 text-xl"></i>
                    </div>
                </div>
            </div>

            <!-- Avg. Response Time -->
            <div class="stat-card bg-white rounded-xl shadow-sm border border-gray-200 p-6">
                <div class="flex items-center justify-between">
                    <div>
                        <p class="text-sm font-medium text-gray-600">Avg. Response Time</p>
                        <p class="text-3xl font-bold text-gray-800 mt-2">4.2</p>
                        <p class="text-xs text-blue-600 mt-1">
                            <i class="fas fa-stopwatch mr-1"></i>Hours
                        </p>
                    </div>
                    <div class="w-12 h-12 bg-blue-100 rounded-lg flex items-center justify-center">
                        <i class="fas fa-stopwatch text-blue-600 text-xl"></i>
                    </div>
                </div>
            </div>

            <!-- Completion Rate -->
            <div class="stat-card bg-white rounded-xl shadow-sm border border-gray-200 p-6">
                <div class="flex items-center justify-between">
                    <div>
                        <p class="text-sm font-medium text-gray-600">Completion Rate</p>
                        <p class="text-3xl font-bold text-gray-800 mt-2">94%</p>
                        <p class="text-xs text-purple-600 mt-1">
                            <i class="fas fa-chart-line mr-1"></i>This month
                        </p>
                    </div>
                    <div class="w-12 h-12 bg-purple-100 rounded-lg flex items-center justify-center">
                        <i class="fas fa-chart-line text-purple-600 text-xl"></i>
                    </div>
                </div>
            </div>
        </div>

        <!-- Workflow List -->
        <div class="bg-white rounded-xl shadow-sm border border-gray-200 p-6 mb-6">
            <div class="flex items-center justify-between mb-6">
                <h3 class="text-lg font-semibold text-gray-800">Active Workflows</h3>
                <div class="flex space-x-3">
                    <div class="relative">
                        <input type="text" placeholder="Search workflows..." class="pl-10 pr-4 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500">
                        <i class="fas fa-search absolute left-3 top-3 text-gray-400"></i>
                    </div>
                    <select class="border border-gray-300 rounded-lg px-3 py-2 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500">
                        <option>All Departments</option>
                        <option>Assembly</option>
                        <option>Spare Parts</option>
                        <option>Mechanical</option>
                        <option>Electrical</option>
                    </select>
                </div>
            </div>

            <div class="space-y-4">
                <!-- Workflow Item -->
                <div class="flex items-center justify-between p-4 border border-gray-200 rounded-lg hover:bg-gray-50 transition duration-200">
                    <div class="flex items-center space-x-4">
                        <div class="w-12 h-12 bg-blue-100 rounded-lg flex items-center justify-center">
                            <i class="fas fa-cogs text-blue-600"></i>
                        </div>
                        <div>
                            <h4 class="text-sm font-semibold text-gray-800">Standard Leave Approval</h4>
                            <p class="text-xs text-gray-600">2-step approval process for regular leaves</p>
                            <div class="flex items-center space-x-2 mt-1">
                                <span class="px-2 py-1 bg-blue-100 text-blue-800 text-xs rounded-full">Assembly</span>
                                <span class="px-2 py-1 bg-green-100 text-green-800 text-xs rounded-full">Active</span>
                            </div>
                        </div>
                    </div>
                    <div class="text-right">
                        <p class="text-sm font-medium text-gray-800">15 approvals this month</p>
                        <p class="text-xs text-gray-600">Last used: 2 hours ago</p>
                    </div>
                    <div class="flex space-x-2">
                        <button class="p-2 text-blue-600 hover:bg-blue-50 rounded-lg transition duration-200">
                            <i class="fas fa-edit"></i>
                        </button>
                        <button class="p-2 text-green-600 hover:bg-green-50 rounded-lg transition duration-200">
                            <i class="fas fa-play"></i>
                        </button>
                        <button class="p-2 text-gray-600 hover:bg-gray-50 rounded-lg transition duration-200">
                            <i class="fas fa-ellipsis-v"></i>
                        </button>
                    </div>
                </div>

                <!-- Workflow Item -->
                <div class="flex items-center justify-between p-4 border border-gray-200 rounded-lg hover:bg-gray-50 transition duration-200">
                    <div class="flex items-center space-x-4">
                        <div class="w-12 h-12 bg-green-100 rounded-lg flex items-center justify-center">
                            <i class="fas fa-ambulance text-green-600"></i>
                        </div>
                        <div>
                            <h4 class="text-sm font-semibold text-gray-800">Emergency Leave Process</h4>
                            <p class="text-xs text-gray-600">Fast-track approval for urgent cases</p>
                            <div class="flex items-center space-x-2 mt-1">
                                <span class="px-2 py-1 bg-purple-100 text-purple-800 text-xs rounded-full">All Depts</span>
                                <span class="px-2 py-1 bg-green-100 text-green-800 text-xs rounded-full">Active</span>
                            </div>
                        </div>
                    </div>
                    <div class="text-right">
                        <p class="text-sm font-medium text-gray-800">8 approvals this month</p>
                        <p class="text-xs text-gray-600">Last used: 1 day ago</p>
                    </div>
                    <div class="flex space-x-2">
                        <button class="p-2 text-blue-600 hover:bg-blue-50 rounded-lg transition duration-200">
                            <i class="fas fa-edit"></i>
                        </button>
                        <button class="p-2 text-green-600 hover:bg-green-50 rounded-lg transition duration-200">
                            <i class="fas fa-play"></i>
                        </button>
                        <button class="p-2 text-gray-600 hover:bg-gray-50 rounded-lg transition duration-200">
                            <i class="fas fa-ellipsis-v"></i>
                        </button>
                    </div>
                </div>

                <!-- Workflow Item -->
                <div class="flex items-center justify-between p-4 border border-gray-200 rounded-lg hover:bg-gray-50 transition duration-200">
                    <div class="flex items-center space-x-4">
                        <div class="w-12 h-12 bg-orange-100 rounded-lg flex items-center justify-center">
                            <i class="fas fa-calendar-plus text-orange-600"></i>
                        </div>
                        <div>
                            <h4 class="text-sm font-semibold text-gray-800">Extended Leave Process</h4>
                            <p class="text-xs text-gray-600">3-step approval for leaves > 5 days</p>
                            <div class="flex items-center space-x-2 mt-1">
                                <span class="px-2 py-1 bg-red-100 text-red-800 text-xs rounded-full">Mechanical</span>
                                <span class="px-2 py-1 bg-green-100 text-green-800 text-xs rounded-full">Active</span>
                            </div>
                        </div>
                    </div>
                    <div class="text-right">
                        <p class="text-sm font-medium text-gray-800">12 approvals this month</p>
                        <p class="text-xs text-gray-600">Last used: 5 hours ago</p>
                    </div>
                    <div class="flex space-x-2">
                        <button class="p-2 text-blue-600 hover:bg-blue-50 rounded-lg transition duration-200">
                            <i class="fas fa-edit"></i>
                        </button>
                        <button class="p-2 text-green-600 hover:bg-green-50 rounded-lg transition duration-200">
                            <i class="fas fa-play"></i>
                        </button>
                        <button class="p-2 text-gray-600 hover:bg-gray-50 rounded-lg transition duration-200">
                            <i class="fas fa-ellipsis-v"></i>
                        </button>
                    </div>
                </div>

                <!-- Workflow Item -->
                <div class="flex items-center justify-between p-4 border border-gray-200 rounded-lg hover:bg-gray-50 transition duration-200">
                    <div class="flex items-center space-x-4">
                        <div class="w-12 h-12 bg-purple-100 rounded-lg flex items-center justify-center">
                            <i class="fas fa-user-tie text-purple-600"></i>
                        </div>
                        <div>
                            <h4 class="text-sm font-semibold text-gray-800">Managerial Leave Process</h4>
                            <p class="text-xs text-gray-600">Special approval chain for managers</p>
                            <div class="flex items-center space-x-2 mt-1">
                                <span class="px-2 py-1 bg-indigo-100 text-indigo-800 text-xs rounded-full">All Depts</span>
                                <span class="px-2 py-1 bg-green-100 text-green-800 text-xs rounded-full">Active</span>
                            </div>
                        </div>
                    </div>
                    <div class="text-right">
                        <p class="text-sm font-medium text-gray-800">6 approvals this month</p>
                        <p class="text-xs text-gray-600">Last used: 3 days ago</p>
                    </div>
                    <div class="flex space-x-2">
                        <button class="p-2 text-blue-600 hover:bg-blue-50 rounded-lg transition duration-200">
                            <i class="fas fa-edit"></i>
                        </button>
                        <button class="p-2 text-green-600 hover:bg-green-50 rounded-lg transition duration-200">
                            <i class="fas fa-play"></i>
                        </button>
                        <button class="p-2 text-gray-600 hover:bg-gray-50 rounded-lg transition duration-200">
                            <i class="fas fa-ellipsis-v"></i>
                        </button>
                    </div>
                </div>
            </div>
        </div>

        <!-- Workflow Visualization -->
        <div class="bg-white rounded-xl shadow-sm border border-gray-200 p-6">
            <h3 class="text-lg font-semibold text-gray-800 mb-6">Workflow Process Visualization</h3>
            <div class="flex items-center justify-center py-8">
                <div class="relative">
                    <!-- Workflow Steps -->
                    <div class="flex items-center space-x-8">
                        <!-- Step 1 -->
                        <div class="flex flex-col items-center">
                            <div class="w-16 h-16 bg-blue-100 rounded-full flex items-center justify-center mb-2">
                                <i class="fas fa-paper-plane text-blue-600"></i>
                            </div>
                            <span class="text-sm font-medium text-gray-800">Submit</span>
                            <span class="text-xs text-gray-600">Employee</span>
                        </div>
                        
                        <!-- Arrow -->
                        <div class="w-12 h-0.5 bg-gray-300"></div>
                        
                        <!-- Step 2 -->
                        <div class="flex flex-col items-center">
                            <div class="w-16 h-16 bg-green-100 rounded-full flex items-center justify-center mb-2">
                                <i class="fas fa-user-check text-green-600"></i>
                            </div>
                            <span class="text-sm font-medium text-gray-800">Supervisor</span>
                            <span class="text-xs text-gray-600">Level 1</span>
                        </div>
                        
                        <!-- Arrow -->
                        <div class="w-12 h-0.5 bg-gray-300"></div>
                        
                        <!-- Step 3 -->
                        <div class="flex flex-col items-center">
                            <div class="w-16 h-16 bg-orange-100 rounded-full flex items-center justify-center mb-2">
                                <i class="fas fa-user-tie text-orange-600"></i>
                            </div>
                            <span class="text-sm font-medium text-gray-800">Manager</span>
                            <span class="text-xs text-gray-600">Level 2</span>
                        </div>
                        
                        <!-- Arrow -->
                        <div class="w-12 h-0.5 bg-gray-300"></div>
                        
                        <!-- Step 4 -->
                        <div class="flex flex-col items-center">
                            <div class="w-16 h-16 bg-purple-100 rounded-full flex items-center justify-center mb-2">
                                <i class="fas fa-check-double text-purple-600"></i>
                            </div>
                            <span class="text-sm font-medium text-gray-800">Finalize</span>
                            <span class="text-xs text-gray-600">HR</span>
                        </div>
                    </div>
                    
                    <!-- Conditional Path -->
                    <div class="absolute top-0 left-1/2 transform -translate-x-1/2 -translate-y-4">
                        <div class="bg-yellow-100 border border-yellow-300 rounded-lg px-3 py-1">
                            <span class="text-xs font-medium text-yellow-800">Conditional: >5 days</span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Sidebar -->
    <div class="lg:col-span-1">
        <!-- Quick Stats -->
        <div class="bg-white rounded-xl shadow-sm border border-gray-200 p-6 mb-6">
            <h3 class="text-lg font-semibold text-gray-800 mb-4">Workflow Performance</h3>
            <div class="space-y-4">
                <div>
                    <div class="flex items-center justify-between mb-1">
                        <span class="text-sm text-gray-600">Approval Rate</span>
                        <span class="text-sm font-bold text-gray-800">94%</span>
                    </div>
                    <div class="w-full bg-gray-200 rounded-full h-2">
                        <div class="bg-green-600 h-2 rounded-full" style="width: 94%"></div>
                    </div>
                </div>
                <div>
                    <div class="flex items-center justify-between mb-1">
                        <span class="text-sm text-gray-600">Avg. Completion Time</span>
                        <span class="text-sm font-bold text-gray-800">6.2h</span>
                    </div>
                    <div class="w-full bg-gray-200 rounded-full h-2">
                        <div class="bg-blue-600 h-2 rounded-full" style="width: 62%"></div>
                    </div>
                </div>
                <div>
                    <div class="flex items-center justify-between mb-1">
                        <span class="text-sm text-gray-600">Escalation Rate</span>
                        <span class="text-sm font-bold text-gray-800">8%</span>
                    </div>
                    <div class="w-full bg-gray-200 rounded-full h-2">
                        <div class="bg-orange-600 h-2 rounded-full" style="width: 8%"></div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Quick Actions -->
        <div class="bg-white rounded-xl shadow-sm border border-gray-200 p-6 mb-6">
            <h3 class="text-lg font-semibold text-gray-800 mb-4">Quick Actions</h3>
            <div class="space-y-3">
                <button class="w-full flex items-center space-x-3 p-3 border border-gray-200 rounded-lg hover:bg-blue-50 hover:border-blue-200 transition duration-200">
                    <i class="fas fa-sliders-h text-blue-600"></i>
                    <span class="text-sm font-medium text-gray-700">Configure Rules</span>
                </button>
                <button class="w-full flex items-center space-x-3 p-3 border border-gray-200 rounded-lg hover:bg-green-50 hover:border-green-200 transition duration-200">
                    <i class="fas fa-bell text-green-600"></i>
                    <span class="text-sm font-medium text-gray-700">Notification Settings</span>
                </button>
                <button class="w-full flex items-center space-x-3 p-3 border border-gray-200 rounded-lg hover:bg-purple-50 hover:border-purple-200 transition duration-200">
                    <i class="fas fa-history text-purple-600"></i>
                    <span class="text-sm font-medium text-gray-700">Audit Trail</span>
                </button>
                <button class="w-full flex items-center space-x-3 p-3 border border-gray-200 rounded-lg hover:bg-orange-50 hover:border-orange-200 transition duration-200">
                    <i class="fas fa-archive text-orange-600"></i>
                    <span class="text-sm font-medium text-gray-700">Archived Workflows</span>
                </button>
            </div>
        </div>

        <!-- Recent Activities -->
        <div class="bg-white rounded-xl shadow-sm border border-gray-200 p-6">
            <h3 class="text-lg font-semibold text-gray-800 mb-4">Recent Activities</h3>
            <div class="space-y-4">
                <div class="flex items-start space-x-3">
                    <div class="w-8 h-8 bg-green-100 rounded-full flex items-center justify-center mt-1">
                        <i class="fas fa-check text-green-600 text-xs"></i>
                    </div>
                    <div>
                        <p class="text-sm font-medium text-gray-800">Workflow approved</p>
                        <p class="text-xs text-gray-600">Standard Leave - John Doe</p>
                        <p class="text-xs text-gray-500">2 hours ago</p>
                    </div>
                </div>
                <div class="flex items-start space-x-3">
                    <div class="w-8 h-8 bg-blue-100 rounded-full flex items-center justify-center mt-1">
                        <i class="fas fa-plus text-blue-600 text-xs"></i>
                    </div>
                    <div>
                        <p class="text-sm font-medium text-gray-800">New workflow created</p>
                        <p class="text-xs text-gray-600">Emergency Process - HR Dept</p>
                        <p class="text-xs text-gray-500">5 hours ago</p>
                    </div>
                </div>
                <div class="flex items-start space-x-3">
                    <div class="w-8 h-8 bg-orange-100 rounded-full flex items-center justify-center mt-1">
                        <i class="fas fa-clock text-orange-600 text-xs"></i>
                    </div>
                    <div>
                        <p class="text-sm font-medium text-gray-800">Approval pending</p>
                        <p class="text-xs text-gray-600">Extended Leave - Sarah Smith</p>
                        <p class="text-xs text-gray-500">1 day ago</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@push('scripts')
<script>
    document.addEventListener('DOMContentLoaded', function() {
        // Workflow item click handlers
        document.querySelectorAll('.workflow-item').forEach(item => {
            item.addEventListener('click', function() {
                const workflowName = this.querySelector('h4').textContent;
                // Navigate to workflow detail page or open modal
                console.log('Selected workflow:', workflowName);
            });
        });

        // Quick action button handlers
        document.querySelectorAll('.quick-action').forEach(button => {
            button.addEventListener('click', function() {
                const action = this.querySelector('span').textContent;
                console.log('Quick action:', action);
                // Implement respective functionality
            });
        });
    });
</script>
@endpush