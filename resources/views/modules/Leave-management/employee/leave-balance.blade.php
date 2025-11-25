@extends('layouts.app')

@section('title', 'Leave Balance - Nish Auto Limited')
@section('page-title', 'My Leave Balance')

@section('content')
<div class="space-y-6">
    <!-- Header Section -->
    <div class="bg-gradient-to-r from-blue-600 to-blue-800 rounded-2xl p-6 text-white">
        <div class="flex items-center justify-between">
            <div>
                <h2 class="text-2xl font-bold mb-2">Your Leave Balance</h2>
                <p class="text-blue-100">Overview of your available leave days and usage</p>
            </div>
            <div class="hidden md:block">
                <i class="fas fa-chart-pie text-4xl text-blue-300"></i>
            </div>
        </div>
    </div>

    <!-- Quick Stats -->
    <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
        <!-- Total Available -->
        <div class="bg-white rounded-xl shadow-sm border border-gray-200 p-6 text-center">
            <div class="w-16 h-16 bg-green-100 rounded-full flex items-center justify-center mx-auto mb-4">
                <i class="fas fa-calendar-check text-green-600 text-2xl"></i>
            </div>
            <h3 class="text-3xl font-bold text-gray-800 mb-2">{{ $totalAvailable }}</h3>
            <p class="text-gray-600 font-medium">Total Available</p>
            <p class="text-sm text-gray-500 mt-1">Across all leave types</p>
        </div>

        <!-- Used This Year -->
        <div class="bg-white rounded-xl shadow-sm border border-gray-200 p-6 text-center">
            <div class="w-16 h-16 bg-blue-100 rounded-full flex items-center justify-center mx-auto mb-4">
                <i class="fas fa-chart-line text-blue-600 text-2xl"></i>
            </div>
            <h3 class="text-3xl font-bold text-gray-800 mb-2">{{ $totalUsed }}</h3>
            <p class="text-gray-600 font-medium">Days Used</p>
            <p class="text-sm text-gray-500 mt-1">This Year</p>
        </div>

        <!-- Remaining Balance -->
        <div class="bg-white rounded-xl shadow-sm border border-gray-200 p-6 text-center">
            <div class="w-16 h-16 bg-purple-100 rounded-full flex items-center justify-center mx-auto mb-4">
                <i class="fas fa-wallet text-purple-600 text-2xl"></i>
            </div>
            <h3 class="text-3xl font-bold text-gray-800 mb-2">{{ $totalRemaining }}</h3>
            <p class="text-gray-600 font-medium">Remaining</p>
            <p class="text-sm text-gray-500 mt-1">Available for use</p>
        </div>
    </div>

    <!-- Leave Types Breakdown -->
    <div class="grid grid-cols-1 lg:grid-cols-2 gap-6">
        <!-- Leave Types Progress -->
        <div class="bg-white rounded-xl shadow-sm border border-gray-200 p-6">
            <div class="flex items-center justify-between mb-6">
                <h3 class="text-lg font-semibold text-gray-800">Leave Types Breakdown</h3>
                <span class="text-sm text-gray-500">Year {{ date('Y') }}</span>
            </div>
            
            <div class="space-y-6">
                @foreach($leaveBalances as $balance)
                    @php
                        $leaveType = $balance['leave_type'];
                        $used = $balance['used'];
                        $available = $balance['available'];
                        $maxDays = $balance['max_days'];
                        $percentage = $maxDays > 0 ? min(100, ($used / $maxDays) * 100) : 0;
                        
                        $colors = [
                            'Annual' => ['bg' => 'blue', 'icon' => 'umbrella-beach'],
                            'Sick' => ['bg' => 'green', 'icon' => 'procedures'],
                            'Emergency' => ['bg' => 'red', 'icon' => 'exclamation-triangle'],
                            'Maternity' => ['bg' => 'purple', 'icon' => 'baby'],
                            'Paternity' => ['bg' => 'blue', 'icon' => 'male'],
                            'Other' => ['bg' => 'gray', 'icon' => 'calendar-alt']
                        ];
                        $color = $colors[$leaveType->name] ?? $colors['Other'];
                    @endphp
                    
                    <div class="space-y-2">
                        <div class="flex items-center justify-between">
                            <div class="flex items-center space-x-3">
                                <div class="w-10 h-10 bg-{{ $color['bg'] }}-100 rounded-lg flex items-center justify-center">
                                    <i class="fas fa-{{ $color['icon'] }} text-{{ $color['bg'] }}-600"></i>
                                </div>
                                <div>
                                    <span class="font-medium text-gray-800">{{ $leaveType->name }}</span>
                                    <p class="text-sm text-gray-500">{{ $leaveType->description }}</p>
                                </div>
                            </div>
                            <div class="text-right">
                                <span class="font-bold text-gray-800">
                                    {{ $available ?? '∞' }}/{{ $maxDays ?: '∞' }}
                                </span>
                                <p class="text-sm text-gray-500">days</p>
                            </div>
                        </div>
                        @if($maxDays > 0)
                            <div class="w-full bg-gray-200 rounded-full h-3">
                                <div class="bg-{{ $color['bg'] }}-500 h-3 rounded-full progress-bar" style="width: {{ $percentage }}%"></div>
                            </div>
                            <div class="flex justify-between text-xs text-gray-500">
                                <span>Used: {{ $used }} days</span>
                                <span>Available: {{ $available }} days</span>
                            </div>
                        @else
                            <div class="w-full bg-gray-200 rounded-full h-3">
                                <div class="bg-{{ $color['bg'] }}-500 h-3 rounded-full progress-bar" style="width: 100%"></div>
                            </div>
                            <div class="flex justify-between text-xs text-gray-500">
                                <span>Used: {{ $used }} days</span>
                                <span>Unlimited</span>
                            </div>
                        @endif
                    </div>
                @endforeach
            </div>
        </div>

        <!-- Usage Statistics & Projections -->
        <div class="space-y-6">
            <!-- Monthly Usage -->
            <div class="bg-white rounded-xl shadow-sm border border-gray-200 p-6">
                <h3 class="text-lg font-semibold text-gray-800 mb-4">Monthly Usage Trend</h3>
                <div class="h-48 flex items-end space-x-2">
                    @foreach($monthlyUsage as $month)
                        <div class="flex-1 flex flex-col items-center">
                            <div 
                                class="w-full bg-blue-500 rounded-t-lg transition-all duration-500" 
                                style="height: {{ ($month['days'] / max(1, $maxMonthlyUsage)) * 80 }}%"
                                title="{{ $month['month'] }}: {{ $month['days'] }} days"
                            ></div>
                            <span class="text-xs text-gray-500 mt-1">{{ $month['month'] }}</span>
                        </div>
                    @endforeach
                </div>
            </div>

            <!-- Leave Projections -->
            <div class="bg-white rounded-xl shadow-sm border border-gray-200 p-6">
                <h3 class="text-lg font-semibold text-gray-800 mb-4">Year-End Projections</h3>
                <div class="space-y-4">
                    <div class="flex justify-between items-center">
                        <span class="text-gray-600">Projected Annual Leave Balance</span>
                        <span class="font-bold text-green-600">+{{ $projections['annual_balance'] }} days</span>
                    </div>
                    <div class="flex justify-between items-center">
                        <span class="text-gray-600">Estimated Carry Over</span>
                        <span class="font-bold text-blue-600">{{ $projections['carry_over'] }} days</span>
                    </div>
                    <div class="flex justify-between items-center">
                        <span class="text-gray-600">Recommended Usage</span>
                        <span class="font-bold text-orange-600">{{ $projections['recommended_usage'] }} days</span>
                    </div>
                </div>
            </div>

            <!-- Quick Actions -->
            <div class="bg-white rounded-xl shadow-sm border border-gray-200 p-6">
                <h3 class="text-lg font-semibold text-gray-800 mb-4">Quick Actions</h3>
                <div class="space-y-3">
                    <a href="{{ route('employee.leave.create') }}" class="w-full flex items-center justify-between p-3 border border-gray-200 rounded-lg hover:bg-blue-50 hover:border-blue-200 transition duration-200">
                        <div class="flex items-center space-x-3">
                            <i class="fas fa-paper-plane text-blue-600"></i>
                            <span class="font-medium text-gray-700">Apply for Leave</span>
                        </div>
                        <i class="fas fa-chevron-right text-gray-400"></i>
                    </a>
                    
                    <button class="w-full flex items-center justify-between p-3 border border-gray-200 rounded-lg hover:bg-green-50 hover:border-green-200 transition duration-200">
                        <div class="flex items-center space-x-3">
                            <i class="fas fa-download text-green-600"></i>
                            <span class="font-medium text-gray-700">Download Summary</span>
                        </div>
                        <i class="fas fa-chevron-right text-gray-400"></i>
                    </button>
                    
                    <button class="w-full flex items-center justify-between p-3 border border-gray-200 rounded-lg hover:bg-purple-50 hover:border-purple-200 transition duration-200">
                        <div class="flex items-center space-x-3">
                            <i class="fas fa-question-circle text-purple-600"></i>
                            <span class="font-medium text-gray-700">Leave Policy</span>
                        </div>
                        <i class="fas fa-chevron-right text-gray-400"></i>
                    </button>
                </div>
            </div>
        </div>
    </div>

    <!-- Leave History Summary -->
    <div class="bg-white rounded-xl shadow-sm border border-gray-200 p-6">
        <div class="flex items-center justify-between mb-6">
            <h3 class="text-lg font-semibold text-gray-800">Recent Leave Usage</h3>
            <a href="{{ route('employee.leave.history') }}" class="text-blue-600 hover:text-blue-500 text-sm font-medium">
                View Full History
            </a>
        </div>
        
        @if($recentLeaves->count() > 0)
            <div class="overflow-x-auto">
                <table class="w-full">
                    <thead>
                        <tr class="border-b border-gray-200">
                            <th class="text-left py-3 text-sm font-medium text-gray-500">Leave Type</th>
                            <th class="text-left py-3 text-sm font-medium text-gray-500">Period</th>
                            <th class="text-left py-3 text-sm font-medium text-gray-500">Duration</th>
                            <th class="text-left py-3 text-sm font-medium text-gray-500">Status</th>
                            <th class="text-left py-3 text-sm font-medium text-gray-500">Applied On</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-gray-200">
                        @foreach($recentLeaves as $leave)
                            <tr>
                                <td class="py-4">
                                    <div class="flex items-center space-x-2">
                                        <i class="{{ $leave->leaveType->getIconClass() }}"></i>
                                        <span class="font-medium text-gray-800">{{ $leave->leaveType->name }}</span>
                                    </div>
                                </td>
                                <td class="py-4 text-sm text-gray-600">
                                    {{ $leave->start_date->format('M d') }} - {{ $leave->end_date->format('M d, Y') }}
                                </td>
                                <td class="py-4 text-sm text-gray-600">{{ $leave->total_days }} days</td>
                                <td class="py-4">
                                    <span class="px-2 py-1 {{ $leave->getStatusBadgeClass() }} text-xs rounded-full font-medium">
                                        {{ ucfirst($leave->status) }}
                                    </span>
                                </td>
                                <td class="py-4 text-sm text-gray-600">{{ $leave->created_at->format('M d, Y') }}</td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        @else
            <div class="text-center py-8">
                <i class="fas fa-inbox text-gray-400 text-3xl mb-3"></i>
                <p class="text-gray-500">No recent leave requests found.</p>
                <a href="{{ route('employee.leave.create') }}" class="text-blue-600 hover:text-blue-500 text-sm font-medium mt-2 inline-block">
                    Apply for your first leave
                </a>
            </div>
        @endif
    </div>
</div>
@endsection

@push('styles')
<style>
    .progress-bar {
        transition: width 0.5s ease-in-out;
    }
    
    .stat-card {
        transition: all 0.3s ease;
    }
    
    .stat-card:hover {
        transform: translateY(-2px);
        box-shadow: 0 10px 15px -3px rgba(0, 0, 0, 0.1);
    }
</style>
@endpush

@push('scripts')
<script>
    document.addEventListener('DOMContentLoaded', function() {
        // Animate progress bars
        const progressBars = document.querySelectorAll('.progress-bar');
        progressBars.forEach(bar => {
            const width = bar.style.width;
            bar.style.width = '0';
            setTimeout(() => {
                bar.style.width = width;
            }, 100);
        });

        // Add hover effects to stat cards
        const statCards = document.querySelectorAll('.bg-white.rounded-xl');
        statCards.forEach(card => {
            card.addEventListener('mouseenter', function() {
                this.classList.add('shadow-md');
            });
            card.addEventListener('mouseleave', function() {
                this.classList.remove('shadow-md');
            });
        });
    });
</script>
@endpush