@extends('layouts.app')

@section('title', 'Role Management - Nish Auto Limited')
@section('page-title', 'User Management - Roles')

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
                    <h2 class="text-xl font-bold text-gray-800">Role Management</h2>
                    <p class="text-gray-600 mt-1">Manage user roles and permissions across the system</p>
                </div>
                <div class="flex space-x-3 mt-4 md:mt-0">
                    <button class="flex items-center space-x-2 px-4 py-2 border border-gray-300 rounded-lg hover:bg-gray-50 transition duration-200">
                        <i class="fas fa-download text-gray-600"></i>
                        <span class="text-sm font-medium text-gray-700">Export</span>
                    </button>
                    <button class="flex items-center space-x-2 px-4 py-2 bg-blue-600 text-white rounded-lg hover:bg-blue-700 transition duration-200">
                        <i class="fas fa-plus"></i>
                        <span class="text-sm font-medium">Add New Role</span>
                    </button>
                </div>
            </div>
        </div>

        <!-- Roles Grid -->
        <div class="grid grid-cols-1 md:grid-cols-2 xl:grid-cols-3 gap-6 mb-6">
            <!-- Admin Role Card -->
            <div class="bg-white rounded-xl shadow-sm border border-gray-200 p-6">
                <div class="flex items-start justify-between mb-4">
                    <div>
                        <h3 class="text-lg font-semibold text-gray-800">Administrator</h3>
                        <p class="text-sm text-gray-600 mt-1">Full system access</p>
                    </div>
                    <div class="w-10 h-10 bg-red-100 rounded-lg flex items-center justify-center">
                        <i class="fas fa-crown text-red-600"></i>
                    </div>
                </div>
                <div class="mb-4">
                    <span class="inline-block px-3 py-1 bg-red-100 text-red-800 text-xs rounded-full font-medium">
                        12 Users
                    </span>
                </div>
                <p class="text-sm text-gray-600 mb-4">Complete access to all system features and administrative functions</p>
                <div class="flex space-x-2">
                    <button class="flex-1 bg-blue-600 hover:bg-blue-700 text-white px-3 py-2 rounded-lg text-sm font-medium transition duration-200">
                        Manage
                    </button>
                    <button class="px-3 py-2 border border-gray-300 rounded-lg hover:bg-gray-50 transition duration-200">
                        <i class="fas fa-ellipsis-v text-gray-600"></i>
                    </button>
                </div>
            </div>

            <!-- Manager Role Card -->
            <div class="bg-white rounded-xl shadow-sm border border-gray-200 p-6">
                <div class="flex items-start justify-between mb-4">
                    <div>
                        <h3 class="text-lg font-semibold text-gray-800">Manager</h3>
                        <p class="text-sm text-gray-600 mt-1">Department management</p>
                    </div>
                    <div class="w-10 h-10 bg-blue-100 rounded-lg flex items-center justify-center">
                        <i class="fas fa-user-tie text-blue-600"></i>
                    </div>
                </div>
                <div class="mb-4">
                    <span class="inline-block px-3 py-1 bg-blue-100 text-blue-800 text-xs rounded-full font-medium">
                        8 Users
                    </span>
                </div>
                <p class="text-sm text-gray-600 mb-4">Can manage team members and approve leave requests within department</p>
                <div class="flex space-x-2">
                    <button class="flex-1 bg-blue-600 hover:bg-blue-700 text-white px-3 py-2 rounded-lg text-sm font-medium transition duration-200">
                        Manage
                    </button>
                    <button class="px-3 py-2 border border-gray-300 rounded-lg hover:bg-gray-50 transition duration-200">
                        <i class="fas fa-ellipsis-v text-gray-600"></i>
                    </button>
                </div>
            </div>

            <!-- Supervisor Role Card -->
            <div class="bg-white rounded-xl shadow-sm border border-gray-200 p-6">
                <div class="flex items-start justify-between mb-4">
                    <div>
                        <h3 class="text-lg font-semibold text-gray-800">Supervisor</h3>
                        <p class="text-sm text-gray-600 mt-1">Team supervision</p>
                    </div>
                    <div class="w-10 h-10 bg-green-100 rounded-lg flex items-center justify-center">
                        <i class="fas fa-user-check text-green-600"></i>
                    </div>
                </div>
                <div class="mb-4">
                    <span class="inline-block px-3 py-1 bg-green-100 text-green-800 text-xs rounded-full font-medium">
                        15 Users
                    </span>
                </div>
                <p class="text-sm text-gray-600 mb-4">Can view team data and make preliminary approvals</p>
                <div class="flex space-x-2">
                    <button class="flex-1 bg-blue-600 hover:bg-blue-700 text-white px-3 py-2 rounded-lg text-sm font-medium transition duration-200">
                        Manage
                    </button>
                    <button class="px-3 py-2 border border-gray-300 rounded-lg hover:bg-gray-50 transition duration-200">
                        <i class="fas fa-ellipsis-v text-gray-600"></i>
                    </button>
                </div>
            </div>

            <!-- Employee Role Card -->
            <div class="bg-white rounded-xl shadow-sm border border-gray-200 p-6">
                <div class="flex items-start justify-between mb-4">
                    <div>
                        <h3 class="text-lg font-semibold text-gray-800">Employee</h3>
                        <p class="text-sm text-gray-600 mt-1">Standard user access</p>
                    </div>
                    <div class="w-10 h-10 bg-purple-100 rounded-lg flex items-center justify-center">
                        <i class="fas fa-user text-purple-600"></i>
                    </div>
                </div>
                <div class="mb-4">
                    <span class="inline-block px-3 py-1 bg-purple-100 text-purple-800 text-xs rounded-full font-medium">
                        112 Users
                    </span>
                </div>
                <p class="text-sm text-gray-600 mb-4">Basic access to request leaves and view personal data</p>
                <div class="flex space-x-2">
                    <button class="flex-1 bg-blue-600 hover:bg-blue-700 text-white px-3 py-2 rounded-lg text-sm font-medium transition duration-200">
                        Manage
                    </button>
                    <button class="px-3 py-2 border border-gray-300 rounded-lg hover:bg-gray-50 transition duration-200">
                        <i class="fas fa-ellipsis-v text-gray-600"></i>
                    </button>
                </div>
            </div>

            <!-- HR Role Card -->
            <div class="bg-white rounded-xl shadow-sm border border-gray-200 p-6">
                <div class="flex items-start justify-between mb-4">
                    <div>
                        <h3 class="text-lg font-semibold text-gray-800">HR Manager</h3>
                        <p class="text-sm text-gray-600 mt-1">Human resources</p>
                    </div>
                    <div class="w-10 h-10 bg-orange-100 rounded-lg flex items-center justify-center">
                        <i class="fas fa-users-cog text-orange-600"></i>
                    </div>
                </div>
                <div class="mb-4">
                    <span class="inline-block px-3 py-1 bg-orange-100 text-orange-800 text-xs rounded-full font-medium">
                        5 Users
                    </span>
                </div>
                <p class="text-sm text-gray-600 mb-4">Access to employee data and HR management functions</p>
                <div class="flex space-x-2">
                    <button class="flex-1 bg-blue-600 hover:bg-blue-700 text-white px-3 py-2 rounded-lg text-sm font-medium transition duration-200">
                        Manage
                    </button>
                    <button class="px-3 py-2 border border-gray-300 rounded-lg hover:bg-gray-50 transition duration-200">
                        <i class="fas fa-ellipsis-v text-gray-600"></i>
                    </button>
                </div>
            </div>

            <!-- Add New Role Card -->
            <div class="bg-white rounded-xl shadow-sm border-2 border-dashed border-gray-300 p-6 flex flex-col items-center justify-center hover:border-blue-400 hover:bg-blue-50 transition duration-200 cursor-pointer">
                <div class="w-16 h-16 bg-blue-100 rounded-full flex items-center justify-center mb-4">
                    <i class="fas fa-plus text-blue-600 text-2xl"></i>
                </div>
                <h3 class="text-lg font-semibold text-gray-800 mb-2">Add New Role</h3>
                <p class="text-sm text-gray-600 text-center">Create a custom role with specific permissions</p>
            </div>
        </div>

        <!-- Permissions Table -->
        <div class="bg-white rounded-xl shadow-sm border border-gray-200 p-6">
            <div class="flex items-center justify-between mb-6">
                <h3 class="text-lg font-semibold text-gray-800">Role Permissions Matrix</h3>
                <button class="flex items-center space-x-2 px-4 py-2 border border-gray-300 rounded-lg hover:bg-gray-50 transition duration-200">
                    <i class="fas fa-sync-alt text-gray-600"></i>
                    <span class="text-sm font-medium text-gray-700">Refresh</span>
                </button>
            </div>

            <div class="overflow-x-auto">
                <table class="w-full">
                    <thead>
                        <tr class="bg-gray-50 border-b border-gray-200">
                            <th class="py-3 px-4 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Permission</th>
                            <th class="py-3 px-4 text-center text-xs font-medium text-gray-500 uppercase tracking-wider">Admin</th>
                            <th class="py-3 px-4 text-center text-xs font-medium text-gray-500 uppercase tracking-wider">Manager</th>
                            <th class="py-3 px-4 text-center text-xs font-medium text-gray-500 uppercase tracking-wider">Supervisor</th>
                            <th class="py-3 px-4 text-center text-xs font-medium text-gray-500 uppercase tracking-wider">HR</th>
                            <th class="py-3 px-4 text-center text-xs font-medium text-gray-500 uppercase tracking-wider">Employee</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-gray-200">
                        <!-- User Management -->
                        <tr>
                            <td class="py-3 px-4 font-medium text-gray-800">User Management</td>
                            <td class="py-3 px-4 text-center">
                                <i class="fas fa-check-circle text-green-500"></i>
                            </td>
                            <td class="py-3 px-4 text-center">
                                <i class="fas fa-times-circle text-red-400"></i>
                            </td>
                            <td class="py-3 px-4 text-center">
                                <i class="fas fa-times-circle text-red-400"></i>
                            </td>
                            <td class="py-3 px-4 text-center">
                                <i class="fas fa-check-circle text-green-500"></i>
                            </td>
                            <td class="py-3 px-4 text-center">
                                <i class="fas fa-times-circle text-red-400"></i>
                            </td>
                        </tr>
                        
                        <!-- Leave Approval -->
                        <tr>
                            <td class="py-3 px-4 font-medium text-gray-800">Leave Approval</td>
                            <td class="py-3 px-4 text-center">
                                <i class="fas fa-check-circle text-green-500"></i>
                            </td>
                            <td class="py-3 px-4 text-center">
                                <i class="fas fa-check-circle text-green-500"></i>
                            </td>
                            <td class="py-3 px-4 text-center">
                                <i class="fas fa-check-circle text-green-500"></i>
                            </td>
                            <td class="py-3 px-4 text-center">
                                <i class="fas fa-check-circle text-green-500"></i>
                            </td>
                            <td class="py-3 px-4 text-center">
                                <i class="fas fa-times-circle text-red-400"></i>
                            </td>
                        </tr>
                        
                        <!-- Reports Access -->
                        <tr>
                            <td class="py-3 px-4 font-medium text-gray-800">Reports Access</td>
                            <td class="py-3 px-4 text-center">
                                <i class="fas fa-check-circle text-green-500"></i>
                            </td>
                            <td class="py-3 px-4 text-center">
                                <i class="fas fa-check-circle text-green-500"></i>
                            </td>
                            <td class="py-3 px-4 text-center">
                                <i class="fas fa-check-circle text-green-500"></i>
                            </td>
                            <td class="py-3 px-4 text-center">
                                <i class="fas fa-check-circle text-green-500"></i>
                            </td>
                            <td class="py-3 px-4 text-center">
                                <i class="fas fa-times-circle text-red-400"></i>
                            </td>
                        </tr>
                        
                        <!-- System Settings -->
                        <tr>
                            <td class="py-3 px-4 font-medium text-gray-800">System Settings</td>
                            <td class="py-3 px-4 text-center">
                                <i class="fas fa-check-circle text-green-500"></i>
                            </td>
                            <td class="py-3 px-4 text-center">
                                <i class="fas fa-times-circle text-red-400"></i>
                            </td>
                            <td class="py-3 px-4 text-center">
                                <i class="fas fa-times-circle text-red-400"></i>
                            </td>
                            <td class="py-3 px-4 text-center">
                                <i class="fas fa-times-circle text-red-400"></i>
                            </td>
                            <td class="py-3 px-4 text-center">
                                <i class="fas fa-times-circle text-red-400"></i>
                            </td>
                        </tr>
                        
                        <!-- Data Export -->
                        <tr>
                            <td class="py-3 px-4 font-medium text-gray-800">Data Export</td>
                            <td class="py-3 px-4 text-center">
                                <i class="fas fa-check-circle text-green-500"></i>
                            </td>
                            <td class="py-3 px-4 text-center">
                                <i class="fas fa-check-circle text-green-500"></i>
                            </td>
                            <td class="py-3 px-4 text-center">
                                <i class="fas fa-times-circle text-red-400"></i>
                            </td>
                            <td class="py-3 px-4 text-center">
                                <i class="fas fa-check-circle text-green-500"></i>
                            </td>
                            <td class="py-3 px-4 text-center">
                                <i class="fas fa-times-circle text-red-400"></i>
                            </td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    <!-- Sidebar -->
    <div class="lg:col-span-1">
        <!-- Quick Stats -->
        <div class="bg-white rounded-xl shadow-sm border border-gray-200 p-6 mb-6">
            <h3 class="text-lg font-semibold text-gray-800 mb-4">Role Statistics</h3>
            <div class="space-y-4">
                <div class="flex items-center justify-between">
                    <span class="text-sm text-gray-600">Total Roles</span>
                    <span class="text-lg font-bold text-gray-800">6</span>
                </div>
                <div class="flex items-center justify-between">
                    <span class="text-sm text-gray-600">Active Users</span>
                    <span class="text-lg font-bold text-gray-800">152</span>
                </div>
                <div class="flex items-center justify-between">
                    <span class="text-sm text-gray-600">Last Updated</span>
                    <span class="text-sm font-medium text-gray-800">2 hours ago</span>
                </div>
            </div>
        </div>

        <!-- Quick Actions -->
        <div class="bg-white rounded-xl shadow-sm border border-gray-200 p-6">
            <h3 class="text-lg font-semibold text-gray-800 mb-4">Quick Actions</h3>
            <div class="space-y-3">
                <button class="w-full flex items-center space-x-3 p-3 border border-gray-200 rounded-lg hover:bg-blue-50 hover:border-blue-200 transition duration-200">
                    <i class="fas fa-user-shield text-blue-600"></i>
                    <span class="text-sm font-medium text-gray-700">Permission Templates</span>
                </button>
                <button class="w-full flex items-center space-x-3 p-3 border border-gray-200 rounded-lg hover:bg-green-50 hover:border-green-200 transition duration-200">
                    <i class="fas fa-file-export text-green-600"></i>
                    <span class="text-sm font-medium text-gray-700">Export Role Matrix</span>
                </button>
                <button class="w-full flex items-center space-x-3 p-3 border border-gray-200 rounded-lg hover:bg-purple-50 hover:border-purple-200 transition duration-200">
                    <i class="fas fa-history text-purple-600"></i>
                    <span class="text-sm font-medium text-gray-700">Audit Log</span>
                </button>
                <button class="w-full flex items-center space-x-3 p-3 border border-gray-200 rounded-lg hover:bg-orange-50 hover:border-orange-200 transition duration-200">
                    <i class="fas fa-trash-alt text-orange-600"></i>
                    <span class="text-sm font-medium text-gray-700">Archived Roles</span>
                </button>
            </div>
        </div>
    </div>
</div>
@endsection

@push('scripts')
<script>
    document.addEventListener('DOMContentLoaded', function() {
        // Add role card click handler
        document.querySelectorAll('.role-card').forEach(card => {
            card.addEventListener('click', function() {
                const roleName = this.querySelector('h3').textContent;
                // Navigate to role detail page or open modal
                console.log('Selected role:', roleName);
            });
        });

        // Add new role card handler
        document.querySelector('.border-dashed').addEventListener('click', function() {
            // Open create role modal or navigate to create page
            console.log('Create new role clicked');
        });
    });
</script>
@endpush