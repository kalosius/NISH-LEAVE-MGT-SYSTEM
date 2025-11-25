@extends('layouts.app')

@section('title', 'Apply for Leave - Nish Auto Limited')
@section('page-title', 'Apply for Leave')

@section('content')
<div class="max-w-4xl mx-auto">
    <div class="bg-white rounded-xl shadow-sm border border-gray-200 p-6">
        <div class="mb-6">
            <h2 class="text-2xl font-bold text-gray-800">New Leave Application</h2>
            <p class="text-gray-600 mt-2">Fill out the form below to submit your leave request</p>
        </div>

        @if ($errors->any())
            <div class="mb-6 bg-red-50 border border-red-200 rounded-lg p-4">
                <div class="flex items-center">
                    <i class="fas fa-exclamation-circle text-red-500 mr-3"></i>
                    <div>
                        <h4 class="text-sm font-medium text-red-800">Please fix the following errors:</h4>
                        <ul class="mt-2 text-sm text-red-700 list-disc list-inside">
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                </div>
            </div>
        @endif

        @if (session('success'))
            <div class="mb-6 bg-green-50 border border-green-200 rounded-lg p-4">
                <div class="flex items-center">
                    <i class="fas fa-check-circle text-green-500 mr-3"></i>
                    <span class="text-sm font-medium text-green-800">{{ session('success') }}</span>
                </div>
            </div>
        @endif

        <!-- MAKE SURE @csrf IS INCLUDED IN THE FORM -->
        <form action="{{ route('employee.leave.store') }}" method="POST" class="space-y-6" id="leaveForm">
            @csrf <!-- This is crucial -->

            <!-- Leave Type -->
            <div>
                <label class="block text-sm font-medium text-gray-700 mb-2">Leave Type *</label>
                <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-4">
                    @foreach($leaveTypes as $type)
                        @php
                            $balance = $balances[$type->id] ?? null;
                            $balanceText = $balance !== null ? "Balance: {$balance} days" : 'No limit';
                            $color = match($type->name) {
                                'Annual' => 'blue',
                                'Sick' => 'green',
                                'Emergency' => 'purple',
                                'Maternity' => 'pink',
                                'Paternity' => 'blue',
                                default => 'gray'
                            };
                            $icon = match($type->name) {
                                'Annual' => 'fa-umbrella-beach',
                                'Sick' => 'fa-procedures',
                                'Emergency' => 'fa-exclamation-triangle',
                                'Maternity' => 'fa-baby',
                                'Paternity' => 'fa-male',
                                default => 'fa-calendar-alt'
                            };
                        @endphp
                        <label class="flex items-center p-4 border border-gray-300 rounded-lg cursor-pointer hover:bg-{{ $color }}-50 hover:border-{{ $color }}-300 transition duration-200">
                            <input type="radio" name="leave_type_id" value="{{ $type->id }}" 
                                   class="text-{{ $color }}-600 focus:ring-{{ $color }}-500"
                                   required>
                            <div class="ml-3">
                                <i class="fas {{ $icon }} text-{{ $color }}-500 text-lg"></i>
                                <span class="block text-sm font-medium text-gray-700">{{ $type->name }}</span>
                                <span class="text-xs text-gray-500">{{ $balanceText }}</span>
                            </div>
                        </label>
                    @endforeach
                </div>
            </div>

            <!-- Rest of your form remains the same -->
            <!-- Date Range -->
            <div class="grid grid-cols-1 lg:grid-cols-2 gap-6">
                <div>
                    <label for="start_date" class="block text-sm font-medium text-gray-700 mb-2">Start Date *</label>
                    <div class="relative">
                        <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                            <i class="fas fa-calendar-alt text-gray-400"></i>
                        </div>
                        <input type="date" id="start_date" name="start_date" 
                               class="block w-full pl-10 pr-3 py-3 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent transition duration-200"
                               min="{{ date('Y-m-d') }}"
                               value="{{ old('start_date') }}"
                               required>
                    </div>
                </div>
                
                <div>
                    <label for="end_date" class="block text-sm font-medium text-gray-700 mb-2">End Date *</label>
                    <div class="relative">
                        <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                            <i class="fas fa-calendar-alt text-gray-400"></i>
                        </div>
                        <input type="date" id="end_date" name="end_date" 
                               class="block w-full pl-10 pr-3 py-3 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent transition duration-200"
                               min="{{ date('Y-m-d') }}"
                               value="{{ old('end_date') }}"
                               required>
                    </div>
                </div>
            </div>

            <!-- Duration Display -->
            <div class="bg-blue-50 border border-blue-200 rounded-lg p-4">
                <div class="flex items-center justify-between">
                    <div>
                        <p class="text-sm font-medium text-blue-800">Leave Duration</p>
                        <p class="text-2xl font-bold text-blue-600" id="durationDisplay">0 days</p>
                        <p class="text-xs text-blue-600 mt-1" id="dateRangeDisplay"></p>
                    </div>
                    <i class="fas fa-clock text-blue-500 text-2xl"></i>
                </div>
            </div>

            <!-- Reason -->
            <div>
                <label for="reason" class="block text-sm font-medium text-gray-700 mb-2">Reason for Leave *</label>
                <textarea id="reason" name="reason" rows="4" 
                          class="block w-full px-3 py-3 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent transition duration-200"
                          placeholder="Please provide a detailed reason for your leave request..."
                          required>{{ old('reason') }}</textarea>
            </div>

            <!-- Contact Information -->
            <div class="grid grid-cols-1 lg:grid-cols-2 gap-6">
                <div>
                    <label for="contact_number" class="block text-sm font-medium text-gray-700 mb-2">Contact Number *</label>
                    <div class="relative">
                        <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                            <i class="fas fa-phone text-gray-400"></i>
                        </div>
                        <input type="tel" id="contact_number" name="contact_number" 
                               class="block w-full pl-10 pr-3 py-3 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent transition duration-200"
                               placeholder="+255 XXX XXX XXX"
                               value="{{ old('contact_number', Auth::user()->phone ?? '') }}"
                               required>
                    </div>
                </div>
                
                <div>
                    <label for="emergency_contact" class="block text-sm font-medium text-gray-700 mb-2">Emergency Contact</label>
                    <div class="relative">
                        <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                            <i class="fas fa-phone-alt text-gray-400"></i>
                        </div>
                        <input type="tel" id="emergency_contact" name="emergency_contact" 
                               class="block w-full pl-10 pr-3 py-3 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent transition duration-200"
                               placeholder="Emergency contact number"
                               value="{{ old('emergency_contact') }}">
                    </div>
                </div>
            </div>

            <!-- Handover Notes -->
            <div>
                <label for="handover_notes" class="block text-sm font-medium text-gray-700 mb-2">Handover Notes</label>
                <textarea id="handover_notes" name="handover_notes" rows="3" 
                          class="block w-full px-3 py-3 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent transition duration-200"
                          placeholder="Any important information for your replacement...">{{ old('handover_notes') }}</textarea>
            </div>

            <!-- Submit Buttons -->
            <div class="flex flex-col sm:flex-row gap-4 pt-6 border-t border-gray-200">
                <button type="submit" class="flex-1 bg-blue-600 text-white py-3 px-6 rounded-lg hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:ring-offset-2 transition duration-200 font-medium">
                    <i class="fas fa-paper-plane mr-2"></i>Submit Leave Application
                </button>
                <a href="{{ route('employee.leave.history') }}" class="flex-1 bg-gray-200 text-gray-800 py-3 px-6 rounded-lg hover:bg-gray-300 focus:outline-none focus:ring-2 focus:ring-gray-500 focus:ring-offset-2 transition duration-200 font-medium text-center">
                    <i class="fas fa-arrow-left mr-2"></i>Back to History
                </a>
            </div>
        </form>
    </div>
</div>

<script>
document.addEventListener('DOMContentLoaded', function() {
    const startDate = document.getElementById('start_date');
    const endDate = document.getElementById('end_date');
    const durationDisplay = document.getElementById('durationDisplay');
    const dateRangeDisplay = document.getElementById('dateRangeDisplay');

    function calculateDuration() {
        if (!startDate.value || !endDate.value) {
            durationDisplay.textContent = '0 days';
            dateRangeDisplay.textContent = '';
            return;
        }

        const start = new Date(startDate.value);
        const end = new Date(endDate.value);
        
        if (start > end) {
            durationDisplay.textContent = '0 days';
            dateRangeDisplay.textContent = 'Invalid date range';
            return;
        }

        let totalDays = 0;
        let current = new Date(start);
        
        while (current <= end) {
            const day = current.getDay();
            if (day !== 0 && day !== 6) totalDays++; // Skip weekends
            current.setDate(current.getDate() + 1);
        }
        
        durationDisplay.textContent = `${totalDays} day${totalDays !== 1 ? 's' : ''}`;
        
        const options = { weekday: 'short', year: 'numeric', month: 'short', day: 'numeric' };
        dateRangeDisplay.textContent = `${start.toLocaleDateString('en-US', options)} to ${end.toLocaleDateString('en-US', options)}`;
    }

    startDate.addEventListener('change', function() {
        if (startDate.value) {
            endDate.min = startDate.value;
            if (endDate.value && endDate.value < startDate.value) {
                endDate.value = startDate.value;
            }
        }
        calculateDuration();
    });

    endDate.addEventListener('change', calculateDuration);

    // Initial calculation if there are old values
    calculateDuration();
});
</script>
@endsection