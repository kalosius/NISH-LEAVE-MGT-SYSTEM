@extends('layouts.app')

@section('title', 'Dashboard')

@section('content')
<div class="bg-white rounded-lg shadow-sm border border-gray-200 p-6">
    <h2 class="text-2xl font-bold text-gray-800 mb-4">Welcome to Your Dashboard</h2>
    
    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
        <div class="bg-blue-50 border border-blue-200 rounded-lg p-4">
            <h3 class="font-semibold text-blue-800 mb-2">Leave Balance</h3>
            <p class="text-blue-600 text-2xl font-bold">18 days</p>
        </div>
        
        <div class="bg-green-50 border border-green-200 rounded-lg p-4">
            <h3 class="font-semibold text-green-800 mb-2">Pending Requests</h3>
            <p class="text-green-600 text-2xl font-bold">3</p>
        </div>
        
        <div class="bg-purple-50 border border-purple-200 rounded-lg p-4">
            <h3 class="font-semibold text-purple-800 mb-2">Approved This Month</h3>
            <p class="text-purple-600 text-2xl font-bold">5</p>
        </div>
    </div>
</div>
@endsection