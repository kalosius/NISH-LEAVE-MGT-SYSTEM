@extends('layouts.app')

@section('title', 'HR Leave History - Nish Auto Limited')
@section('page-title', 'HR Leave History')

@php
    $isAdmin = true;
@endphp

@section('content')
<div class="space-y-6">
    <!-- Advanced Filters -->
    <div class="bg-white rounded-xl shadow-sm border border-gray-200 p-6">
        <div class="grid grid-cols-1 md:grid-cols-4 gap-4 mb-4">
            <select class="px-4 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent">
                <option>All Departments</option>
                <option>Assembly</option>
                <option>Spare Parts</option>
                <option>Mechanical</option>
            </select>
            
            <select class="px-4 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent">
                <option>All Employees</option>
                <option>John Doe</option>
                <option>Sarah Smith</option>
            </select>
            
            <select class="px-4 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent">
                <option>All Status</option>
                <option>Approved</option>
                <option>Rejected</option>
            </select>
            
            <input type="month" class="px-4 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent">
        </div>
        
        <div class="flex justify-between items-center">
            <button class="bg-blue-600 text-white px-4 py-2 rounded-lg hover:bg-blue-700 transition duration-200 font-medium">
                <i class="fas fa-filter mr-2"></i>Apply Filters
            </button>
            
            <div class="flex space-x-2">
                <button class="bg-green-600 text-white px-4 py-2 rounded-lg hover:bg-green-700 transition duration-200 font-medium">
                    <i class="fas fa-download mr-2"></i>Export Excel
                </button>
                <button class="bg-purple-600 text-white px-4 py-2 rounded-lg hover:bg-purple-700 transition duration-200 font-medium">
                    <i class="fas fa-chart-bar mr-2"></i>Generate Report
                </button>
            </div>
        </div>
    </div>

    <!-- Comprehensive Leave History -->
    <div class="bg-white rounded-xl shadow-sm border border-gray-200 overflow-hidden">
        <div class="overflow-x-auto">
            <table class="w-full">
                <thead class="bg-gray-50">
                    <tr>
                        <th class="px-6 py-4 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Employee & Department</th>
                        <th class="px-6 py-4 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Leave Details</th>
                        <th class="px-6 py-4 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Timeline</th>
                        <th class="px-6 py-4 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Approval Flow</th>
                        <th class="px-6 py-4 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Actions</th>
                    </tr>
                </thead>
                <tbody class="bg-white divide-y divide-gray-200">
                    <tr class="hover:bg-gray-50 transition duration-150">
                        <td class="px-6 py-4">
                            <div class="flex items-center">
                                <div class="w-10 h-10 bg-blue-100 rounded-full flex items-center justify-center mr-3">
                                    <span class="text-blue-600 font-semibold">MA</span>
                                </div>
                                <div>
                                    <div class="text-sm font-medium text-gray-900">Mugisha Andrew</div>
                                    <div class="text-sm text-gray-500">Assembly Department</div>
                                    <div class="text-xs text-gray-400">NISH-EMP-045</div>
                                </div>
                            </div>
                        </td>
                        <td class="px-6 py-4">
                            <div class="flex items-center">
                                <i class="fas fa-umbrella-beach text-blue-500 text-lg mr-3"></i>
                                <div>
                                    <div class="text-sm font-medium text-gray-900">Annual Leave</div>
                                    <div class="text-sm text-gray-500">12 days</div>
                                    <div class="text-xs text-gray-400">Dec 20-31, 2024</div>
                                </div>
                            </div>
                        </td>
                        <td class="px-6 py-4">
                            <div class="text-sm text-gray-900">Applied: Nov 15</div>
                            <div class="text-sm text-green-600">Dept Approved: Nov 16</div>
                            <div class="text-sm text-green-600">HR Approved: Nov 17</div>
                        </td>
                        <td class="px-6 py-4">
                            <div class="flex items-center space-x-2">
                                <span class="px-2 py-1 bg-green-100 text-green-800 text-xs rounded-full">Dept Head ✓</span>
                                <span class="px-2 py-1 bg-green-100 text-green-800 text-xs rounded-full">HR ✓</span>
                            </div>
                        </td>
                        <td class="px-6 py-4">
                            <button class="text-blue-600 hover:text-blue-900 text-sm font-medium">View Details</button>
                        </td>
                    </tr>
                    <!-- More rows... -->
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection