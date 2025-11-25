@extends('layouts.app')

@section('title', 'Reports - Nish Auto Limited')
@section('page-title', 'Reports & Analytics')

@php
    $isAdmin = true;
@endphp

@section('content')
<!-- Report Filters -->
<div class="bg-white rounded-xl shadow-sm border border-gray-200 p-6 mb-6">
    <h3 class="text-lg font-semibold text-gray-800 mb-4">Report Filters</h3>
    <div class="grid grid-cols-1 md:grid-cols-4 gap-4">
        <!-- Date Range -->
        <div>
            <label class="block text-sm font-medium text-gray-700 mb-1">Date Range</label>
            <select class="w-full border border-gray-300 rounded-lg px-3 py-2 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500">
                <option>Last 7 days</option>
                <option>Last 30 days</option>
                <option>Last 3 months</option>
                <option>Last 6 months</option>
                <option>Year to date</option>
                <option>Custom range</option>
            </select>
        </div>
        
        <!-- Department -->
        <div>
            <label class="block text-sm font-medium text-gray-700 mb-1">Department</label>
            <select class="w-full border border-gray-300 rounded-lg px-3 py-2 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500">
                <option>All Departments</option>
                <option>Assembly</option>
                <option>Spare Parts</option>
                <option>Mechanical</option>
                <option>Electrical</option>
                <option>Sales</option>
            </select>
        </div>
        
        <!-- Report Type -->
        <div>
            <label class="block text-sm font-medium text-gray-700 mb-1">Report Type</label>
            <select class="w-full border border-gray-300 rounded-lg px-3 py-2 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500">
                <option>Leave Summary</option>
                <option>Attendance</option>
                <option>Department Analysis</option>
                <option>Employee Utilization</option>
                <option>Leave Trends</option>
            </select>
        </div>
        
        <!-- Action Buttons -->
        <div class="flex items-end space-x-3">
            <button class="flex-1 bg-blue-600 hover:bg-blue-700 text-white px-4 py-2 rounded-lg transition duration-200 font-medium">
                Generate Report
            </button>
            <button class="px-4 py-2 border border-gray-300 rounded-lg hover:bg-gray-50 transition duration-200">
                <i class="fas fa-download text-gray-600"></i>
            </button>
        </div>
    </div>
</div>

<!-- Report Summary Cards -->
<div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6 mb-8">
    <!-- Total Leave Days -->
    <div class="stat-card bg-white rounded-xl shadow-sm border border-gray-200 p-6">
        <div class="flex items-center justify-between">
            <div>
                <p class="text-sm font-medium text-gray-600">Total Leave Days</p>
                <p class="text-3xl font-bold text-gray-800 mt-2">1,247</p>
                <p class="text-xs text-blue-600 mt-1">
                    <i class="fas fa-calendar-alt mr-1"></i>This period
                </p>
            </div>
            <div class="w-12 h-12 bg-blue-100 rounded-lg flex items-center justify-center">
                <i class="fas fa-calendar-check text-blue-600 text-xl"></i>
            </div>
        </div>
    </div>

    <!-- Average Leave Duration -->
    <div class="stat-card bg-white rounded-xl shadow-sm border border-gray-200 p-6">
        <div class="flex items-center justify-between">
            <div>
                <p class="text-sm font-medium text-gray-600">Avg. Leave Duration</p>
                <p class="text-3xl font-bold text-gray-800 mt-2">3.2</p>
                <p class="text-xs text-green-600 mt-1">
                    <i class="fas fa-clock mr-1"></i>Days per request
                </p>
            </div>
            <div class="w-12 h-12 bg-green-100 rounded-lg flex items-center justify-center">
                <i class="fas fa-hourglass-half text-green-600 text-xl"></i>
            </div>
        </div>
    </div>

    <!-- Most Common Leave Type -->
    <div class="stat-card bg-white rounded-xl shadow-sm border border-gray-200 p-6">
        <div class="flex items-center justify-between">
            <div>
                <p class="text-sm font-medium text-gray-600">Most Common Type</p>
                <p class="text-3xl font-bold text-gray-800 mt-2">Sick</p>
                <p class="text-xs text-purple-600 mt-1">
                    <i class="fas fa-stethoscope mr-1"></i>42% of all leaves
                </p>
            </div>
            <div class="w-12 h-12 bg-purple-100 rounded-lg flex items-center justify-center">
                <i class="fas fa-stethoscope text-purple-600 text-xl"></i>
            </div>
        </div>
    </div>

    <!-- Approval Rate -->
    <div class="stat-card bg-white rounded-xl shadow-sm border border-gray-200 p-6">
        <div class="flex items-center justify-between">
            <div>
                <p class="text-sm font-medium text-gray-600">Approval Rate</p>
                <p class="text-3xl font-bold text-gray-800 mt-2">89%</p>
                <p class="text-xs text-orange-600 mt-1">
                    <i class="fas fa-check-circle mr-1"></i>Of all requests
                </p>
            </div>
            <div class="w-12 h-12 bg-orange-100 rounded-lg flex items-center justify-center">
                <i class="fas fa-check-circle text-orange-600 text-xl"></i>
            </div>
        </div>
    </div>
</div>

<!-- Charts and Visualizations -->
<div class="grid grid-cols-1 lg:grid-cols-2 gap-6 mb-8">
    <!-- Leave Trends Over Time -->
    <div class="bg-white rounded-xl shadow-sm border border-gray-200 p-6">
        <div class="flex items-center justify-between mb-4">
            <h3 class="text-lg font-semibold text-gray-800">Leave Trends Over Time</h3>
            <div class="flex space-x-2">
                <button class="px-3 py-1 text-xs bg-blue-100 text-blue-700 rounded-lg font-medium">Monthly</button>
                <button class="px-3 py-1 text-xs bg-gray-100 text-gray-700 rounded-lg font-medium">Quarterly</button>
                <button class="px-3 py-1 text-xs bg-gray-100 text-gray-700 rounded-lg font-medium">Yearly</button>
            </div>
        </div>
        <div class="h-64">
            <canvas id="trendsChart"></canvas>
        </div>
    </div>

    <!-- Leave Type Distribution -->
    <div class="bg-white rounded-xl shadow-sm border border-gray-200 p-6">
        <h3 class="text-lg font-semibold text-gray-800 mb-4">Leave Type Distribution</h3>
        <div class="h-64">
            <canvas id="leaveTypeChart"></canvas>
        </div>
    </div>
</div>

<!-- Detailed Reports Table -->
<div class="bg-white rounded-xl shadow-sm border border-gray-200 p-6 mb-8">
    <div class="flex items-center justify-between mb-4">
        <h3 class="text-lg font-semibold text-gray-800">Detailed Leave Report</h3>
        <div class="flex space-x-3">
            <button class="flex items-center space-x-2 px-4 py-2 border border-gray-300 rounded-lg hover:bg-gray-50 transition duration-200">
                <i class="fas fa-file-export text-gray-600"></i>
                <span class="text-sm font-medium text-gray-700">Export</span>
            </button>
            <button class="flex items-center space-x-2 px-4 py-2 bg-blue-600 text-white rounded-lg hover:bg-blue-700 transition duration-200">
                <i class="fas fa-print"></i>
                <span class="text-sm font-medium">Print</span>
            </button>
        </div>
    </div>
    
    <div class="overflow-x-auto">
        <table class="w-full">
            <thead>
                <tr class="bg-gray-50 border-b border-gray-200">
                    <th class="py-3 px-4 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Employee</th>
                    <th class="py-3 px-4 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Department</th>
                    <th class="py-3 px-4 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Leave Type</th>
                    <th class="py-3 px-4 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Duration</th>
                    <th class="py-3 px-4 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Status</th>
                    <th class="py-3 px-4 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Date</th>
                </tr>
            </thead>
            <tbody class="divide-y divide-gray-200">
                <!-- Table Row -->
                <tr class="hover:bg-gray-50 transition duration-150">
                    <td class="py-3 px-4">
                        <div class="flex items-center">
                            <div class="w-8 h-8 bg-blue-100 rounded-full flex items-center justify-center mr-3">
                                <span class="text-blue-600 text-sm font-semibold">JD</span>
                            </div>
                            <span class="text-sm font-medium text-gray-800">John Doe</span>
                        </div>
                    </td>
                    <td class="py-3 px-4 text-sm text-gray-700">Assembly</td>
                    <td class="py-3 px-4 text-sm text-gray-700">Sick Leave</td>
                    <td class="py-3 px-4 text-sm text-gray-700">3 days</td>
                    <td class="py-3 px-4">
                        <span class="px-2 py-1 text-xs bg-green-100 text-green-800 rounded-full font-medium">Approved</span>
                    </td>
                    <td class="py-3 px-4 text-sm text-gray-700">15-18 Dec 2023</td>
                </tr>
                
                <!-- More table rows would go here -->
                
            </tbody>
        </table>
    </div>
    
    <!-- Pagination -->
    <div class="flex items-center justify-between mt-6">
        <div class="text-sm text-gray-700">
            Showing <span class="font-medium">1</span> to <span class="font-medium">10</span> of <span class="font-medium">97</span> results
        </div>
        <div class="flex space-x-2">
            <button class="px-3 py-1 border border-gray-300 rounded-lg text-sm font-medium text-gray-700 hover:bg-gray-50 transition duration-150">
                Previous
            </button>
            <button class="px-3 py-1 border border-gray-300 bg-blue-600 text-white rounded-lg text-sm font-medium">
                1
            </button>
            <button class="px-3 py-1 border border-gray-300 rounded-lg text-sm font-medium text-gray-700 hover:bg-gray-50 transition duration-150">
                2
            </button>
            <button class="px-3 py-1 border border-gray-300 rounded-lg text-sm font-medium text-gray-700 hover:bg-gray-50 transition duration-150">
                3
            </button>
            <button class="px-3 py-1 border border-gray-300 rounded-lg text-sm font-medium text-gray-700 hover:bg-gray-50 transition duration-150">
                Next
            </button>
        </div>
    </div>
</div>

<!-- Department Comparison -->
<div class="bg-white rounded-xl shadow-sm border border-gray-200 p-6">
    <h3 class="text-lg font-semibold text-gray-800 mb-4">Department Comparison</h3>
    <div class="h-64">
        <canvas id="departmentComparisonChart"></canvas>
    </div>
</div>
@endsection

@push('scripts')
<script>
    document.addEventListener('DOMContentLoaded', function() {
        // Leave Trends Chart
        const trendsCtx = document.getElementById('trendsChart').getContext('2d');
        const trendsChart = new Chart(trendsCtx, {
            type: 'line',
            data: {
                labels: ['Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun', 'Jul', 'Aug', 'Sep', 'Oct', 'Nov', 'Dec'],
                datasets: [{
                    label: 'Leave Requests',
                    data: [45, 52, 38, 64, 55, 70, 65, 59, 48, 62, 58, 71],
                    backgroundColor: 'rgba(59, 130, 246, 0.1)',
                    borderColor: '#3B82F6',
                    borderWidth: 2,
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

        // Leave Type Distribution Chart
        const leaveTypeCtx = document.getElementById('leaveTypeChart').getContext('2d');
        const leaveTypeChart = new Chart(leaveTypeCtx, {
            type: 'pie',
            data: {
                labels: ['Sick Leave', 'Vacation', 'Personal', 'Maternity', 'Paternity', 'Other'],
                datasets: [{
                    data: [42, 28, 12, 8, 5, 5],
                    backgroundColor: [
                        '#3B82F6',
                        '#10B981',
                        '#F59E0B',
                        '#EF4444',
                        '#8B5CF6',
                        '#6B7280'
                    ]
                }]
            },
            options: {
                responsive: true,
                maintainAspectRatio: false
            }
        });

        // Department Comparison Chart
        const deptCompCtx = document.getElementById('departmentComparisonChart').getContext('2d');
        const deptCompChart = new Chart(deptCompCtx, {
            type: 'bar',
            data: {
                labels: ['Assembly', 'Spare Parts', 'Mechanical', 'Electrical', 'Sales'],
                datasets: [{
                    label: 'Leave Days',
                    data: [320, 240, 180, 120, 80],
                    backgroundColor: '#3B82F6',
                    borderColor: '#3B82F6',
                    borderWidth: 1
                }, {
                    label: 'Avg. Duration',
                    data: [3.5, 2.8, 4.2, 3.1, 2.5],
                    backgroundColor: '#10B981',
                    borderColor: '#10B981',
                    borderWidth: 1,
                    type: 'line',
                    yAxisID: 'y1'
                }]
            },
            options: {
                responsive: true,
                maintainAspectRatio: false,
                scales: {
                    y: {
                        beginAtZero: true,
                        title: {
                            display: true,
                            text: 'Total Leave Days'
                        }
                    },
                    y1: {
                        beginAtZero: true,
                        position: 'right',
                        title: {
                            display: true,
                            text: 'Average Duration (Days)'
                        },
                        grid: {
                            drawOnChartArea: false
                        }
                    }
                }
            }
        });
    });
</script>
@endpush