@extends('layouts.app')

@section('title', 'Admin Dashboard - Nish Auto Limited')
@section('page-title', 'Admin Dashboard')

@php
    $isAdmin = true;
@endphp

@section('content')
<!-- Stats Overview -->
<div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6 mb-8">
    <!-- Total Employees -->
    <div class="stat-card bg-white rounded-xl shadow-sm border border-gray-200 p-6">
        <div class="flex items-center justify-between">
            <div>
                <p class="text-sm font-medium text-gray-600">Total Employees</p>
                <p class="text-3xl font-bold text-gray-800 mt-2">147</p>
                <p class="text-xs text-green-600 mt-1">
                    <i class="fas fa-arrow-up mr-1"></i>12% increase
                </p>
            </div>
            <div class="w-12 h-12 bg-blue-100 rounded-lg flex items-center justify-center">
                <i class="fas fa-users text-blue-600 text-xl"></i>
            </div>
        </div>
    </div>

    <!-- Pending Approvals -->
    <div class="stat-card bg-white rounded-xl shadow-sm border border-gray-200 p-6">
        <div class="flex items-center justify-between">
            <div>
                <p class="text-sm font-medium text-gray-600">Pending Approvals</p>
                <p class="text-3xl font-bold text-gray-800 mt-2">23</p>
                <p class="text-xs text-red-600 mt-1">
                    <i class="fas fa-clock mr-1"></i>Requires attention
                </p>
            </div>
            <div class="w-12 h-12 bg-orange-100 rounded-lg flex items-center justify-center">
                <i class="fas fa-clock text-orange-600 text-xl"></i>
            </div>
        </div>
    </div>

    <!-- On Leave Today -->
    <div class="stat-card bg-white rounded-xl shadow-sm border border-gray-200 p-6">
        <div class="flex items-center justify-between">
            <div>
                <p class="text-sm font-medium text-gray-600">On Leave Today</p>
                <p class="text-3xl font-bold text-gray-800 mt-2">18</p>
                <p class="text-xs text-blue-600 mt-1">
                    <i class="fas fa-calendar mr-1"></i>Across departments
                </p>
            </div>
            <div class="w-12 h-12 bg-green-100 rounded-lg flex items-center justify-center">
                <i class="fas fa-calendar-day text-green-600 text-xl"></i>
            </div>
        </div>
    </div>

    <!-- Leave Utilization -->
    <div class="stat-card bg-white rounded-xl shadow-sm border border-gray-200 p-6">
        <div class="flex items-center justify-between">
            <div>
                <p class="text-sm font-medium text-gray-600">Leave Utilization</p>
                <p class="text-3xl font-bold text-gray-800 mt-2">68%</p>
                <p class="text-xs text-purple-600 mt-1">
                    <i class="fas fa-chart-pie mr-1"></i>Year to date
                </p>
            </div>
            <div class="w-12 h-12 bg-purple-100 rounded-lg flex items-center justify-center">
                <i class="fas fa-chart-pie text-purple-600 text-xl"></i>
            </div>
        </div>
    </div>
</div>

<!-- Charts and Data -->
<div class="grid grid-cols-1 lg:grid-cols-2 gap-6 mb-8">
    <!-- Leave Statistics Chart -->
    <div class="bg-white rounded-xl shadow-sm border border-gray-200 p-6">
        <h3 class="text-lg font-semibold text-gray-800 mb-4">Leave Statistics</h3>
        <div class="h-64">
            <canvas id="leaveChart"></canvas>
        </div>
    </div>

    <!-- Department Distribution -->
    <div class="bg-white rounded-xl shadow-sm border border-gray-200 p-6">
        <h3 class="text-lg font-semibold text-gray-800 mb-4">Department Distribution</h3>
        <div class="h-64">
            <canvas id="departmentChart"></canvas>
        </div>
    </div>
</div>

<!-- Recent Activity & Quick Actions -->
<div class="grid grid-cols-1 lg:grid-cols-3 gap-6">
    <!-- Recent Leave Requests -->
    <div class="lg:col-span-2 bg-white rounded-xl shadow-sm border border-gray-200 p-6">
        <div class="flex items-center justify-between mb-4">
            <h3 class="text-lg font-semibold text-gray-800">Recent Leave Requests</h3>
            <a href="#" class="text-blue-600 hover:text-blue-500 text-sm font-medium">View All</a>
        </div>
        <div class="space-y-4">
            <!-- Request Item -->
            <div class="flex items-center justify-between p-3 border border-gray-200 rounded-lg">
                <div class="flex items-center space-x-3">
                    <div class="w-8 h-8 bg-blue-100 rounded-full flex items-center justify-center">
                        <span class="text-blue-600 text-sm font-semibold">JD</span>
                    </div>
                    <div>
                        <p class="text-sm font-medium text-gray-800">John Doe</p>
                        <p class="text-xs text-gray-600">Assembly Department</p>
                    </div>
                </div>
                <div class="text-right">
                    <p class="text-sm font-medium text-gray-800">Sick Leave</p>
                    <p class="text-xs text-gray-600">Dec 15 - Dec 18</p>
                </div>
                <span class="px-3 py-1 bg-yellow-100 text-yellow-800 text-xs rounded-full font-medium">Pending</span>
            </div>

            <!-- More request items... -->
        </div>
    </div>

    <!-- Quick Actions -->
    <div class="bg-white rounded-xl shadow-sm border border-gray-200 p-6">
        <h3 class="text-lg font-semibold text-gray-800 mb-4">Quick Actions</h3>
        <div class="space-y-3">
            <button class="w-full flex items-center space-x-3 p-3 border border-gray-200 rounded-lg hover:bg-blue-50 hover:border-blue-200 transition duration-200">
                <i class="fas fa-user-plus text-blue-600"></i>
                <span class="text-sm font-medium text-gray-700">Add New Employee</span>
            </button>
            <button class="w-full flex items-center space-x-3 p-3 border border-gray-200 rounded-lg hover:bg-green-50 hover:border-green-200 transition duration-200">
                <i class="fas fa-file-export text-green-600"></i>
                <span class="text-sm font-medium text-gray-700">Generate Report</span>
            </button>
            <button class="w-full flex items-center space-x-3 p-3 border border-gray-200 rounded-lg hover:bg-purple-50 hover:border-purple-200 transition duration-200">
                <i class="fas fa-cog text-purple-600"></i>
                <span class="text-sm font-medium text-gray-700">System Settings</span>
            </button>
            <button class="w-full flex items-center space-x-3 p-3 border border-gray-200 rounded-lg hover:bg-orange-50 hover:border-orange-200 transition duration-200">
                <i class="fas fa-calendar-alt text-orange-600"></i>
                <span class="text-sm font-medium text-gray-700">Manage Leave Types</span>
            </button>
        </div>
    </div>
</div>
@endsection

@push('scripts')
<script>
    document.addEventListener('DOMContentLoaded', function() {
        // Charts
        const leaveCtx = document.getElementById('leaveChart').getContext('2d');
        const leaveChart = new Chart(leaveCtx, {
            type: 'bar',
            data: {
                labels: ['Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun'],
                datasets: [{
                    label: 'Leave Requests',
                    data: [12, 19, 15, 25, 22, 30],
                    backgroundColor: '#3B82F6',
                    borderColor: '#3B82F6',
                    borderWidth: 1
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

        const deptCtx = document.getElementById('departmentChart').getContext('2d');
        const departmentChart = new Chart(deptCtx, {
            type: 'doughnut',
            data: {
                labels: ['Assembly', 'Spare Parts', 'Mechanical', 'Electrical', 'Sales'],
                datasets: [{
                    data: [35, 25, 20, 12, 8],
                    backgroundColor: [
                        '#3B82F6',
                        '#10B981',
                        '#F59E0B',
                        '#EF4444',
                        '#8B5CF6'
                    ]
                }]
            },
            options: {
                responsive: true,
                maintainAspectRatio: false
            }
        });
    });
</script>
@endpush