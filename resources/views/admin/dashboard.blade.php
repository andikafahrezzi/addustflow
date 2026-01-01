@extends('layouts.admin')

@section('title', 'Admin Dashboard')

@section('content')
<div x-data="{ activeTab: 'overview' }">
    <!-- Page Header -->
    <div class="flex items-center justify-between mb-6">
        <div>
            <h1 class="text-3xl font-bold text-gray-800">System Administration</h1>
            <p class="text-gray-600 mt-1">Monitor and manage your entire ERP system</p>
        </div>
        <div class="flex space-x-3">
            <a href="/admin/backups/create" class="flex items-center px-4 py-2 bg-white border border-gray-300 text-gray-700 rounded-lg hover:bg-gray-50 transition">
                <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 8h14M5 8a2 2 0 110-4h14a2 2 0 110 4M5 8v10a2 2 0 002 2h10a2 2 0 002-2V8m-9 4h4"/>
                </svg>
                Create Backup
            </a>
            <a href="/admin/settings" class="flex items-center px-4 py-2 bg-gradient-to-r from-slate-700 to-slate-900 text-white rounded-lg hover:from-slate-800 hover:to-black transition shadow-md">
                <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10.325 4.317c.426-1.756 2.924-1.756 3.35 0a1.724 1.724 0 002.573 1.066c1.543-.94 3.31.826 2.37 2.37a1.724 1.724 0 001.065 2.572c1.756.426 1.756 2.924 0 3.35a1.724 1.724 0 00-1.066 2.573c.94 1.543-.826 3.31-2.37 2.37a1.724 1.724 0 00-2.572 1.065c-.426 1.756-2.924 1.756-3.35 0a1.724 1.724 0 00-2.573-1.066c-1.543.94-3.31-.826-2.37-2.37a1.724 1.724 0 00-1.065-2.572c-1.756-.426-1.756-2.924 0-3.35a1.724 1.724 0 001.066-2.573c-.94-1.543.826-3.31 2.37-2.37.996.608 2.296.07 2.572-1.065z"/>
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"/>
                </svg>
                System Settings
            </a>
        </div>
    </div>

    <!-- System Health Metrics -->
    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6 mb-6">
        <!-- Total Users -->
        <div class="bg-white rounded-xl shadow-sm p-6 border border-gray-100 hover:shadow-md transition">
            <div class="flex items-center justify-between">
                <div>
                    <p class="text-sm font-medium text-gray-600">Total Users</p>
                    <h3 class="text-3xl font-bold text-gray-800 mt-2">1,284</h3>
                    <div class="flex items-center mt-2">
                        <span class="text-green-600 text-sm font-medium">+142</span>
                        <span class="text-gray-500 text-sm ml-2">active now</span>
                    </div>
                </div>
                <div class="w-14 h-14 bg-slate-100 rounded-full flex items-center justify-center">
                    <svg class="w-7 h-7 text-slate-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197M13 7a4 4 0 11-8 0 4 4 0 018 0z"/>
                    </svg>
                </div>
            </div>
        </div>

        <!-- Server Status -->
        <div class="bg-white rounded-xl shadow-sm p-6 border border-gray-100 hover:shadow-md transition">
            <div class="flex items-center justify-between">
                <div>
                    <p class="text-sm font-medium text-gray-600">Server Load</p>
                    <h3 class="text-3xl font-bold text-gray-800 mt-2">28%</h3>
                    <div class="flex items-center mt-2">
                        <span class="text-green-600 text-sm font-medium">Optimal</span>
                        <span class="text-gray-500 text-sm ml-2">performance</span>
                    </div>
                </div>
                <div class="w-14 h-14 bg-green-100 rounded-full flex items-center justify-center">
                    <svg class="w-7 h-7 text-green-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04A12.02 12.02 0 003 9c0 5.591 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.042-.133-2.052-.382-3.016z"/>
                    </svg>
                </div>
            </div>
        </div>

        <!-- Database Size -->
        <div class="bg-white rounded-xl shadow-sm p-6 border border-gray-100 hover:shadow-md transition">
            <div class="flex items-center justify-between">
                <div>
                    <p class="text-sm font-medium text-gray-600">Database Size</p>
                    <h3 class="text-3xl font-bold text-gray-800 mt-2">24.8GB</h3>
                    <div class="flex items-center mt-2">
                        <span class="text-blue-600 text-sm font-medium">+2.3GB</span>
                        <span class="text-gray-500 text-sm ml-2">this month</span>
                    </div>
                </div>
                <div class="w-14 h-14 bg-blue-100 rounded-full flex items-center justify-center">
                    <svg class="w-7 h-7 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 7v10c0 2.21 3.582 4 8 4s8-1.79 8-4V7M4 7c0 2.21 3.582 4 8 4s8-1.79 8-4M4 7c0-2.21 3.582-4 8-4s8 1.79 8 4m0 5c0 2.21-3.582 4-8 4s-8-1.79-8-4"/>
                    </svg>
                </div>
            </div>
        </div>

        <!-- Last Backup -->
        <div class="bg-white rounded-xl shadow-sm p-6 border border-gray-100 hover:shadow-md transition">
            <div class="flex items-center justify-between">
                <div>
                    <p class="text-sm font-medium text-gray-600">Last Backup</p>
                    <h3 class="text-3xl font-bold text-gray-800 mt-2">3h</h3>
                    <div class="flex items-center mt-2">
                        <span class="text-green-600 text-sm font-medium">Success</span>
                        <span class="text-gray-500 text-sm ml-2">ago</span>
                    </div>
                </div>
                <div class="w-14 h-14 bg-purple-100 rounded-full flex items-center justify-center">
                    <svg class="w-7 h-7 text-purple-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 8h14M5 8a2 2 0 110-4h14a2 2 0 110 4M5 8v10a2 2 0 002 2h10a2 2 0 002-2V8m-9 4h4"/>
                    </svg>
                </div>
            </div>
        </div>
    </div>

    <!-- Main Grid -->
    <div class="grid grid-cols-1 lg:grid-cols-3 gap-6 mb-6">
        <!-- System Performance -->
        <div class="lg:col-span-2 bg-white rounded-xl shadow-sm p-6 border border-gray-100">
            <div class="flex items-center justify-between mb-6">
                <h2 class="text-lg font-bold text-gray-800">System Performance</h2>
                <select class="px-3 py-2 border border-gray-300 rounded-lg text-sm focus:outline-none focus:ring-2 focus:ring-slate-500">
                    <option>Last 24 Hours</option>
                    <option>Last 7 Days</option>
                    <option>Last 30 Days</option>
                </select>
            </div>
            
            <div class="space-y-5">
                <div>
                    <div class="flex items-center justify-between mb-2">
                        <div class="flex items-center">
                            <div class="w-3 h-3 bg-green-500 rounded-full mr-2"></div>
                            <span class="text-sm font-medium text-gray-700">CPU Usage</span>
                        </div>
                        <span class="text-sm font-semibold text-gray-800">28%</span>
                    </div>
                    <div class="w-full bg-gray-200 rounded-full h-3">
                        <div class="bg-gradient-to-r from-green-500 to-emerald-500 h-3 rounded-full" style="width: 28%"></div>
                    </div>
                </div>

                <div>
                    <div class="flex items-center justify-between mb-2">
                        <div class="flex items-center">
                            <div class="w-3 h-3 bg-blue-500 rounded-full mr-2"></div>
                            <span class="text-sm font-medium text-gray-700">Memory Usage</span>
                        </div>
                        <span class="text-sm font-semibold text-gray-800">62%</span>
                    </div>
                    <div class="w-full bg-gray-200 rounded-full h-3">
                        <div class="bg-gradient-to-r from-blue-500 to-cyan-500 h-3 rounded-full" style="width: 62%"></div>
                    </div>
                </div>

                <div>
                    <div class="flex items-center justify-between mb-2">
                        <div class="flex items-center">
                            <div class="w-3 h-3 bg-amber-500 rounded-full mr-2"></div>
                            <span class="text-sm font-medium text-gray-700">Disk Usage</span>
                        </div>
                        <span class="text-sm font-semibold text-gray-800">85%</span>
                    </div>
                    <div class="w-full bg-gray-200 rounded-full h-3">
                        <div class="bg-gradient-to-r from-amber-500 to-orange-500 h-3 rounded-full" style="width: 85%"></div>
                    </div>
                </div>

                <div>
                    <div class="flex items-center justify-between mb-2">
                        <div class="flex items-center">
                            <div class="w-3 h-3 bg-purple-500 rounded-full mr-2"></div>
                            <span class="text-sm font-medium text-gray-700">Network Usage</span>
                        </div>
                        <span class="text-sm font-semibold text-gray-800">45%</span>
                    </div>
                    <div class="w-full bg-gray-200 rounded-full h-3">
                        <div class="bg-gradient-to-r from-purple-500 to-pink-500 h-3 rounded-full" style="width: 45%"></div>
                    </div>
                </div>
            </div>

            <div class="mt-6 pt-6 border-t border-gray-200">
                <div class="grid grid-cols-3 gap-4 text-center">
                    <div>
                        <p class="text-2xl font-bold text-gray-800">99.98%</p>
                        <p class="text-xs text-gray-600 mt-1">Uptime</p>
                    </div>
                    <div>
                        <p class="text-2xl font-bold text-green-600">142</p>
                        <p class="text-xs text-gray-600 mt-1">Active Sessions</p>
                    </div>
                    <div>
                        <p class="text-2xl font-bold text-blue-600">2.3s</p>
                        <p class="text-xs text-gray-600 mt-1">Avg Response</p>
                    </div>
                </div>
            </div>
        </div>

        <!-- Quick System Actions -->
        <div class="bg-white rounded-xl shadow-sm p-6 border border-gray-100">
            <h2 class="text-lg font-bold text-gray-800 mb-6">Quick Actions</h2>
            <div class="space-y-3">
                <a href="/admin/users/create" class="flex items-center p-4 bg-gradient-to-r from-slate-700 to-slate-900 text-white rounded-lg hover:from-slate-800 hover:to-black transition shadow-md">
                    <svg class="w-5 h-5 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M18 9v3m0 0v3m0-3h3m-3 0h-3m-2-5a4 4 0 11-8 0 4 4 0 018 0zM3 20a6 6 0 0112 0v1H3v-1z"/>
                    </svg>
                    <span class="font-medium">Create New User</span>
                </a>

                <a href="/admin/backups/create" class="flex items-center p-4 bg-white border-2 border-slate-200 text-slate-700 rounded-lg hover:bg-slate-50 transition">
                    <svg class="w-5 h-5 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 8h14M5 8a2 2 0 110-4h14a2 2 0 110 4M5 8v10a2 2 0 002 2h10a2 2 0 002-2V8m-9 4h4"/>
                    </svg>
                    <span class="font-medium">Create Backup</span>
                </a>

                <a href="/admin/logs" class="flex items-center p-4 bg-white border-2 border-gray-200 text-gray-700 rounded-lg hover:bg-gray-50 transition">
                    <svg class="w-5 h-5 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"/>
                    </svg>
                    <span class="font-medium">View Activity Logs</span>
                </a>

                <a href="/admin/database" class="flex items-center p-4 bg-white border-2 border-gray-200 text-gray-700 rounded-lg hover:bg-gray-50 transition">
                    <svg class="w-5 h-5 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 7v10c0 2.21 3.582 4 8 4s8-1.79 8-4V7M4 7c0 2.21 3.582 4 8 4s8-1.79 8-4M4 7c0-2.21 3.582-4 8-4s8 1.79 8 4m0 5c0 2.21-3.582 4-8 4s-8-1.79-8-4"/>
                    </svg>
                    <span class="font-medium">Database Manager</span>
                </a>
            </div>

            <!-- System Alerts -->
            <div class="mt-6">
                <h3 class="text-sm font-bold text-gray-800 mb-4">System Alerts</h3>
                <div class="space-y-3">
                    <div class="p-3 bg-amber-50 border border-amber-200 rounded-lg">
                        <div class="flex items-start">
                            <svg class="w-5 h-5 text-amber-600 mr-2 flex-shrink-0 mt-0.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z"/>
                            </svg>
                            <div>
                                <p class="text-sm font-medium text-gray-800">Disk Space Warning</p>
                                <p class="text-xs text-gray-600 mt-1">Storage at 85% capacity</p>
                            </div>
                        </div>
                    </div>

                    <div class="p-3 bg-green-50 border border-green-200 rounded-lg">
                        <div class="flex items-start">
                            <svg class="w-5 h-5 text-green-600 mr-2 flex-shrink-0 mt-0.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/>
                            </svg>
                            <div>
                                <p class="text-sm font-medium text-gray-800">All Systems Operational</p>
                                <p class="text-xs text-gray-600 mt-1">No critical issues detected</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- User Activity & Security -->
    <div class="grid grid-cols-1 lg:grid-cols-2 gap-6 mb-6">
        <!-- Recent User Activity -->
        <div class="bg-white rounded-xl shadow-sm border border-gray-100">
            <div class="p-6 border-b border-gray-200">
                <div class="flex items-center justify-between">
                    <h2 class="text-lg font-bold text-gray-800">Recent User Activity</h2>
                    <a href="/admin/logs" class="text-sm text-slate-600 hover:text-slate-700 font-medium">View All</a>
                </div>
            </div>
            <div class="divide-y divide-gray-200">
                <div class="p-4 hover:bg-gray-50 transition">
                    <div class="flex items-start">
                        <div class="w-10 h-10 bg-green-100 rounded-lg flex items-center justify-center flex-shrink-0">
                            <svg class="w-5 h-5 text-green-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 16l-4-4m0 0l4-4m-4 4h14m-5 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h7a3 3 0 013 3v1"/>
                            </svg>
                        </div>
                        <div class="ml-3 flex-1">
                            <p class="text-sm font-medium text-gray-800">User Login</p>
                            <p class="text-xs text-gray-600 mt-1">john.doe@company.com logged in from 192.168.1.100</p>
                            <p class="text-xs text-gray-500 mt-1">2 minutes ago</p>
                        </div>
                    </div>
                </div>

                <div class="p-4 hover:bg-gray-50 transition">
                    <div class="flex items-start">
                        <div class="w-10 h-10 bg-blue-100 rounded-lg flex items-center justify-center flex-shrink-0">
                            <svg class="w-5 h-5 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M18 9v3m0 0v3m0-3h3m-3 0h-3m-2-5a4 4 0 11-8 0 4 4 0 018 0zM3 20a6 6 0 0112 0v1H3v-1z"/>
                            </svg>
                        </div>
                        <div class="ml-3 flex-1">
                            <p class="text-sm font-medium text-gray-800">New User Created</p>
                            <p class="text-xs text-gray-600 mt-1">sarah.miller@company.com added to Finance team</p>
                            <p class="text-xs text-gray-500 mt-1">15 minutes ago</p>
                        </div>
                    </div>
                </div>

                <div class="p-4 hover:bg-gray-50 transition">
                    <div class="flex items-start">
                        <div class="w-10 h-10 bg-purple-100 rounded-lg flex items-center justify-center flex-shrink-0">
                            <svg class="w-5 h-5 text-purple-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10.325 4.317c.426-1.756 2.924-1.756 3.35 0a1.724 1.724 0 002.573 1.066c1.543-.94 3.31.826 2.37 2.37a1.724 1.724 0 001.065 2.572c1.756.426 1.756 2.924 0 3.35a1.724 1.724 0 00-1.066 2.573c.94 1.543-.826 3.31-2.37 2.37a1.724 1.724 0 00-2.572 1.065c-.426 1.756-2.924 1.756-3.35 0a1.724 1.724 0 00-2.573-1.066c-1.543.94-3.31-.826-2.37-2.37a1.724 1.724 0 00-1.065-2.572c-1.756-.426-1.756-2.924 0-3.35a1.724 1.724 0 001.066-2.573c-.94-1.543.826-3.31 2.37-2.37.996.608 2.296.07 2.572-1.065z"/>
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"/>
                            </svg>
                        </div>
                        <div class="ml-3 flex-1">
                            <p class="text-sm font-medium text-gray-800">Settings Updated</p>
                            <p class="text-xs text-gray-600 mt-1">System email configuration changed</p>
                            <p class="text-xs text-gray-500 mt-1">1 hour ago</p>
                        </div>
                    </div>
                </div>

                <div class="p-4 hover:bg-gray-50 transition">
                    <div class="flex items-start">
                        <div class="w-10 h-10 bg-green-100 rounded-lg flex items-center justify-center flex-shrink-0">
                            <svg class="w-5 h-5 text-green-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 8h14M5 8a2 2 0 110-4h14a2 2 0 110 4M5 8v10a2 2 0 002 2h10a2 2 0 002-2V8m-9 4h4"/>
                            </svg>
                        </div>
                        <div class="ml-3 flex-1">
                            <p class="text-sm font-medium text-gray-800">Backup Completed</p>
                            <p class="text-xs text-gray-600 mt-1">Daily automated backup finished successfully</p>
                            <p class="text-xs text-gray-500 mt-1">3 hours ago</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Security & Modules -->
        <div class="space-y-6">
            <!-- Security Status -->
            <div class="bg-white rounded-xl shadow-sm p-6 border border-gray-100">
                <h2 class="text-lg font-bold text-gray-800 mb-4">Security Status</h2>
                <div class="space-y-4">
                    <div class="flex items-center justify-between p-3 bg-green-50 border border-green-200 rounded-lg">
                        <div class="flex items-center">
                            <div class="w-10 h-10 bg-green-500 rounded-full flex items-center justify-center">
                                <svg class="w-5 h-5 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/>
                                </svg>
                            </div>
                            <div class="ml-3">
                                <p class="text-sm font-semibold text-gray-800">Firewall</p>
                                <p class="text-xs text-gray-600">All ports secured</p>
                            </div>
                        </div>
                        <span class="text-xs font-bold text-green-600 bg-white px-3 py-1 rounded-full">Active</span>
                    </div>

                    <div class="flex items-center justify-between p-3 bg-green-50 border border-green-200 rounded-lg">
                        <div class="flex items-center">
                            <div class="w-10 h-10 bg-green-500 rounded-full flex items-center justify-center">
                                <svg class="w-5 h-5 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z"/>
                                </svg>
                            </div>
                            <div class="ml-3">
                                <p class="text-sm font-semibold text-gray-800">2FA Enabled</p>
                                <p class="text-xs text-gray-600">89% users protected</p>
                            </div>
                        </div>
                        <span class="text-xs font-bold text-green-600 bg-white px-3 py-1 rounded-full">89%</span>
                    </div>
                </div>
            </div>

            <!-- Active Modules -->
            <div class="bg-white rounded-xl shadow-sm p-6 border border-gray-100">
                <h2 class="text-lg font-bold text-gray-800 mb-4">Active Modules</h2>
                <div class="grid grid-cols-2 gap-3">
                    <div class="p-3 border-2 border-indigo-200 bg-indigo-50 rounded-lg text-center">
                        <svg class="w-8 h-8 mx-auto text-indigo-600 mb-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5.882V19.24a1.76 1.76 0 01-3.417.592l-2.147-6.15M18 13a3 3 0 100-6M5.436 13.683A4.001 4.001 0 017 6h1.832c4.1 0 7.625-1.234 9.168-3v14c-1.543-1.766-5.067-3-9.168-3H7a3.988 3.988 0 01-1.564-.317z"/>
                        </svg>
                        <p class="text-xs font-semibold text-gray-800">Marketing</p>
                        <p class="text-xs text-green-600 mt-1">Active</p>
                    </div>

                    <div class="p-3 border-2 border-blue-200 bg-blue-50 rounded-lg text-center">
                        <svg class="w-8 h-8 mx-auto text-blue-600 mb-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/>
                        </svg>
                        <p class="text-xs font-semibold text-gray-800">Finance</p>
                        <p class="text-xs text-green-600 mt-1">Active</p>
                    </div>

                    <div class="p-3 border-2 border-orange-200 bg-orange-50 rounded-lg text-center">
                        <svg class="w-8 h-8 mx-auto text-orange-600 mb-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197M13 7a4 4 0 11-8 0 4 4 0 018 0z"/>
                        </svg>
                        <p class="text-xs font-semibold text-gray-800">HR</p>
                        <p class="text-xs text-green-600 mt-1">Active</p>
                    </div>

                    <div class="p-3 border-2 border-emerald-200 bg-emerald-50 rounded-lg text-center">
                        <svg class="w-8 h-8 mx-auto text-emerald-600 mb-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2"/>
                        </svg>
                        <p class="text-xs font-semibold text-gray-800">Manager</p>
                        <p class="text-xs text-green-600 mt-1">Active</p>
                    </div>
                </div>
                <a href="/admin/modules" class="block mt-4 text-center text-sm text-slate-600 hover:text-slate-700 font-medium">
                    Manage Modules →
                </a>
            </div>
        </div>
    </div>

    <!-- Database & Backups Status -->
    <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">
        <!-- Database Tables -->
        <div class="lg:col-span-2 bg-white rounded-xl shadow-sm p-6 border border-gray-100">
            <h2 class="text-lg font-bold text-gray-800 mb-6">Database Overview</h2>
            <div class="overflow-x-auto">
                <table class="w-full">
                    <thead class="bg-gray-50 border-b border-gray-200">
                        <tr>
                            <th class="px-4 py-3 text-left text-xs font-semibold text-gray-600 uppercase">Table Name</th>
                            <th class="px-4 py-3 text-left text-xs font-semibold text-gray-600 uppercase">Records</th>
                            <th class="px-4 py-3 text-left text-xs font-semibold text-gray-600 uppercase">Size</th>
                            <th class="px-4 py-3 text-left text-xs font-semibold text-gray-600 uppercase">Status</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-gray-200">
                        <tr class="hover:bg-gray-50 transition">
                            <td class="px-4 py-3 text-sm font-medium text-gray-800">users</td>
                            <td class="px-4 py-3 text-sm text-gray-600">1,284</td>
                            <td class="px-4 py-3 text-sm text-gray-600">2.4 MB</td>
                            <td class="px-4 py-3">
                                <span class="px-2 py-1 text-xs font-medium bg-green-100 text-green-700 rounded-full">Healthy</span>
                            </td>
                        </tr>
                        <tr class="hover:bg-gray-50 transition">
                            <td class="px-4 py-3 text-sm font-medium text-gray-800">transactions</td>
                            <td class="px-4 py-3 text-sm text-gray-600">45,892</td>
                            <td class="px-4 py-3 text-sm text-gray-600">12.8 MB</td>
                            <td class="px-4 py-3">
                                <span class="px-2 py-1 text-xs font-medium bg-green-100 text-green-700 rounded-full">Healthy</span>
                            </td>
                        </tr>
                        <tr class="hover:bg-gray-50 transition">
                            <td class="px-4 py-3 text-sm font-medium text-gray-800">activity_logs</td>
                            <td class="px-4 py-3 text-sm text-gray-600">128,456</td>
                            <td class="px-4 py-3 text-sm text-gray-600">8.2 MB</td>
                            <td class="px-4 py-3">
                                <span class="px-2 py-1 text-xs font-medium bg-green-100 text-green-700 rounded-full">Healthy</span>
                            </td>
                        </tr>
                        <tr class="hover:bg-gray-50 transition">
                            <td class="px-4 py-3 text-sm font-medium text-gray-800">sessions</td>
                            <td class="px-4 py-3 text-sm text-gray-600">142</td>
                            <td class="px-4 py-3 text-sm text-gray-600">524 KB</td>
                            <td class="px-4 py-3">
                                <span class="px-2 py-1 text-xs font-medium bg-green-100 text-green-700 rounded-full">Healthy</span>
                            </td>
                        </tr>
                        <tr class="hover:bg-gray-50 transition">
                            <td class="px-4 py-3 text-sm font-medium text-gray-800">employees</td>
                            <td class="px-4 py-3 text-sm text-gray-600">94</td>
                            <td class="px-4 py-3 text-sm text-gray-600">1.1 MB</td>
                            <td class="px-4 py-3">
                                <span class="px-2 py-1 text-xs font-medium bg-green-100 text-green-700 rounded-full">Healthy</span>
                            </td>
                        </tr>
                    </tbody>
                </table>
            </div>
            <div class="mt-4 flex items-center justify-between">
                <a href="/admin/database" class="text-sm text-slate-600 hover:text-slate-700 font-medium">View All Tables →</a>
                <button class="px-4 py-2 bg-slate-100 text-slate-700 text-sm font-medium rounded-lg hover:bg-slate-200 transition">
                    Optimize Database
                </button>
            </div>
        </div>

        <!-- Recent Backups -->
        <div class="bg-white rounded-xl shadow-sm p-6 border border-gray-100">
            <div class="flex items-center justify-between mb-6">
                <h2 class="text-lg font-bold text-gray-800">Recent Backups</h2>
                <a href="/admin/backups" class="text-sm text-slate-600 hover:text-slate-700 font-medium">View All</a>
            </div>
            
            <div class="space-y-3">
                <div class="p-3 bg-green-50 border border-green-200 rounded-lg">
                    <div class="flex items-center justify-between mb-2">
                        <span class="text-sm font-semibold text-gray-800">Daily Backup</span>
                        <span class="text-xs text-green-600 font-medium">Success</span>
                    </div>
                    <p class="text-xs text-gray-600">Size: 2.8 GB</p>
                    <p class="text-xs text-gray-500 mt-1">3 hours ago</p>
                </div>

                <div class="p-3 bg-green-50 border border-green-200 rounded-lg">
                    <div class="flex items-center justify-between mb-2">
                        <span class="text-sm font-semibold text-gray-800">Weekly Backup</span>
                        <span class="text-xs text-green-600 font-medium">Success</span>
                    </div>
                    <p class="text-xs text-gray-600">Size: 18.5 GB</p>
                    <p class="text-xs text-gray-500 mt-1">2 days ago</p>
                </div>

                <div class="p-3 bg-blue-50 border border-blue-200 rounded-lg">
                    <div class="flex items-center justify-between mb-2">
                        <span class="text-sm font-semibold text-gray-800">Manual Backup</span>
                        <span class="text-xs text-blue-600 font-medium">Completed</span>
                    </div>
                    <p class="text-xs text-gray-600">Size: 3.2 GB</p>
                    <p class="text-xs text-gray-500 mt-1">5 days ago</p>
                </div>
            </div>

            <button class="w-full mt-4 px-4 py-2 bg-slate-700 text-white text-sm font-medium rounded-lg hover:bg-slate-800 transition">
                Create Manual Backup
            </button>
        </div>
    </div>
</div>
@endsection