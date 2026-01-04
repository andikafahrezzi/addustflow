@extends('layouts.hr')

@section('title', 'HR Dashboard')

@section('content')
<div x-data="{ activeTab: 'overview' }">
    <!-- Page Header -->
    <div class="flex items-center justify-between mb-6">
        <div>
            <h1 class="text-3xl font-bold text-gray-800">HR Dashboard</h1>
            <p class="text-gray-600 mt-1">Manage your workforce and employee engagement</p>
        </div>
        <div class="flex space-x-3">
            <a href="/hr/reports/generate" class="flex items-center px-4 py-2 bg-white border border-gray-300 text-gray-700 rounded-lg hover:bg-gray-50 transition">
                <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 17v-2m3 2v-4m3 4v-6m2 10H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"/>
                </svg>
                HR Report
            </a>
            <a href="{{ route('hr.employees.create') }}" class="flex items-center px-4 py-2 bg-gradient-to-r from-orange-500 to-pink-600 text-white rounded-lg hover:from-orange-600 hover:to-pink-700 transition shadow-md">
                <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"/>
                </svg>
                Add Employee
            </a>
        </div>
    </div>

    <!-- Key HR Metrics -->
    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6 mb-6">
        <!-- Total Employees -->
        <div class="bg-white rounded-xl shadow-sm p-6 border border-gray-100 hover:shadow-md transition">
            <div class="flex items-center justify-between">
                <div>
                    <p class="text-sm font-medium text-gray-600">Total Employees</p>
                    <h3 class="text-3xl font-bold text-gray-800 mt-2">94</h3>
                    <div class="flex items-center mt-2">
                        <span class="text-green-600 text-sm font-medium">+4</span>
                        <span class="text-gray-500 text-sm ml-2">this quarter</span>
                    </div>
                </div>
                <div class="w-14 h-14 bg-orange-100 rounded-full flex items-center justify-center">
                    <svg class="w-7 h-7 text-orange-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197M13 7a4 4 0 11-8 0 4 4 0 018 0z"/>
                    </svg>
                </div>
            </div>
        </div>

        <!-- Present Today -->
        <div class="bg-white rounded-xl shadow-sm p-6 border border-gray-100 hover:shadow-md transition">
            <div class="flex items-center justify-between">
                <div>
                    <p class="text-sm font-medium text-gray-600">Present Today</p>
                    <h3 class="text-3xl font-bold text-gray-800 mt-2">87</h3>
                    <div class="flex items-center mt-2">
                        <span class="text-green-600 text-sm font-medium">92.5%</span>
                        <span class="text-gray-500 text-sm ml-2">attendance</span>
                    </div>
                </div>
                <div class="w-14 h-14 bg-green-100 rounded-full flex items-center justify-center">
                    <svg class="w-7 h-7 text-green-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/>
                    </svg>
                </div>
            </div>
        </div>

        <!-- Active Recruitment -->
        <div class="bg-white rounded-xl shadow-sm p-6 border border-gray-100 hover:shadow-md transition">
            <div class="flex items-center justify-between">
                <div>
                    <p class="text-sm font-medium text-gray-600">Open Positions</p>
                    <h3 class="text-3xl font-bold text-gray-800 mt-2">12</h3>
                    <div class="flex items-center mt-2">
                        <span class="text-blue-600 text-sm font-medium">45</span>
                        <span class="text-gray-500 text-sm ml-2">applicants</span>
                    </div>
                </div>
                <div class="w-14 h-14 bg-blue-100 rounded-full flex items-center justify-center">
                    <svg class="w-7 h-7 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 13.255A23.931 23.931 0 0112 15c-3.183 0-6.22-.62-9-1.745M16 6V4a2 2 0 00-2-2h-4a2 2 0 00-2 2v2m4 6h.01M5 20h14a2 2 0 002-2V8a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"/>
                    </svg>
                </div>
            </div>
        </div>

        <!-- Pending Approvals -->
        <div class="bg-white rounded-xl shadow-sm p-6 border border-gray-100 hover:shadow-md transition">
            <div class="flex items-center justify-between">
                <div>
                    <p class="text-sm font-medium text-gray-600">Pending Requests</p>
                    <h3 class="text-3xl font-bold text-gray-800 mt-2">8</h3>
                    <div class="flex items-center mt-2">
                        <span class="text-amber-600 text-sm font-medium">3 urgent</span>
                        <span class="text-gray-500 text-sm ml-2">items</span>
                    </div>
                </div>
                <div class="w-14 h-14 bg-amber-100 rounded-full flex items-center justify-center">
                    <svg class="w-7 h-7 text-amber-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"/>
                    </svg>
                </div>
            </div>
        </div>
    </div>

    <!-- Main Content Grid -->
    <div class="grid grid-cols-1 lg:grid-cols-3 gap-6 mb-6">
        <!-- Department Distribution -->
        <div class="lg:col-span-2 bg-white rounded-xl shadow-sm p-6 border border-gray-100">
            <div class="flex items-center justify-between mb-6">
                <h2 class="text-lg font-bold text-gray-800">Department Distribution</h2>
                <select class="px-3 py-2 border border-gray-300 rounded-lg text-sm focus:outline-none focus:ring-2 focus:ring-orange-500">
                    <option>All Departments</option>
                    <option>By Headcount</option>
                    <option>By Budget</option>
                </select>
            </div>
            
            <div class="space-y-5">
                <div>
                    <div class="flex items-center justify-between mb-2">
                        <div class="flex items-center">
                            <div class="w-10 h-10 bg-blue-100 rounded-lg flex items-center justify-center mr-3">
                                <svg class="w-5 h-5 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 20l4-16m4 4l4 4-4 4M6 16l-4-4 4-4"/>
                                </svg>
                            </div>
                            <div>
                                <p class="text-sm font-semibold text-gray-800">Engineering</p>
                                <p class="text-xs text-gray-500">Tech & Development</p>
                            </div>
                        </div>
                        <span class="text-sm font-bold text-gray-800">28 employees</span>
                    </div>
                    <div class="w-full bg-gray-200 rounded-full h-3">
                        <div class="bg-gradient-to-r from-blue-500 to-cyan-500 h-3 rounded-full" style="width: 30%"></div>
                    </div>
                </div>

                <div>
                    <div class="flex items-center justify-between mb-2">
                        <div class="flex items-center">
                            <div class="w-10 h-10 bg-purple-100 rounded-lg flex items-center justify-center mr-3">
                                <svg class="w-5 h-5 text-purple-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 11V7a4 4 0 00-8 0v4M5 9h14l1 12H4L5 9z"/>
                                </svg>
                            </div>
                            <div>
                                <p class="text-sm font-semibold text-gray-800">Sales & Marketing</p>
                                <p class="text-xs text-gray-500">Business Development</p>
                            </div>
                        </div>
                        <span class="text-sm font-bold text-gray-800">22 employees</span>
                    </div>
                    <div class="w-full bg-gray-200 rounded-full h-3">
                        <div class="bg-gradient-to-r from-purple-500 to-pink-500 h-3 rounded-full" style="width: 23%"></div>
                    </div>
                </div>

                <div>
                    <div class="flex items-center justify-between mb-2">
                        <div class="flex items-center">
                            <div class="w-10 h-10 bg-green-100 rounded-lg flex items-center justify-center mr-3">
                                <svg class="w-5 h-5 text-green-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z"/>
                                </svg>
                            </div>
                            <div>
                                <p class="text-sm font-semibold text-gray-800">Customer Support</p>
                                <p class="text-xs text-gray-500">Service & Relations</p>
                            </div>
                        </div>
                        <span class="text-sm font-bold text-gray-800">18 employees</span>
                    </div>
                    <div class="w-full bg-gray-200 rounded-full h-3">
                        <div class="bg-gradient-to-r from-green-500 to-emerald-500 h-3 rounded-full" style="width: 19%"></div>
                    </div>
                </div>

                <div>
                    <div class="flex items-center justify-between mb-2">
                        <div class="flex items-center">
                            <div class="w-10 h-10 bg-orange-100 rounded-lg flex items-center justify-center mr-3">
                                <svg class="w-5 h-5 text-orange-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/>
                                </svg>
                            </div>
                            <div>
                                <p class="text-sm font-semibold text-gray-800">Finance & Admin</p>
                                <p class="text-xs text-gray-500">Operations</p>
                            </div>
                        </div>
                        <span class="text-sm font-bold text-gray-800">15 employees</span>
                    </div>
                    <div class="w-full bg-gray-200 rounded-full h-3">
                        <div class="bg-gradient-to-r from-orange-500 to-amber-500 h-3 rounded-full" style="width: 16%"></div>
                    </div>
                </div>

                <div>
                    <div class="flex items-center justify-between mb-2">
                        <div class="flex items-center">
                            <div class="w-10 h-10 bg-pink-100 rounded-lg flex items-center justify-center mr-3">
                                <svg class="w-5 h-5 text-pink-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197M13 7a4 4 0 11-8 0 4 4 0 018 0z"/>
                                </svg>
                            </div>
                            <div>
                                <p class="text-sm font-semibold text-gray-800">Human Resources</p>
                                <p class="text-xs text-gray-500">People & Culture</p>
                            </div>
                        </div>
                        <span class="text-sm font-bold text-gray-800">11 employees</span>
                    </div>
                    <div class="w-full bg-gray-200 rounded-full h-3">
                        <div class="bg-gradient-to-r from-pink-500 to-rose-500 h-3 rounded-full" style="width: 12%"></div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Today's Attendance -->
        <div class="bg-white rounded-xl shadow-sm p-6 border border-gray-100">
            <div class="flex items-center justify-between mb-6">
                <h2 class="text-lg font-bold text-gray-800">Today's Attendance</h2>
                <a href="/hr/attendance" class="text-sm text-orange-600 hover:text-orange-700 font-medium">View All</a>
            </div>
            
            <!-- Attendance Summary Circle -->
            <div class="flex justify-center mb-6">
                <div class="relative w-40 h-40">
                    <svg class="w-full h-full transform -rotate-90">
                        <circle cx="80" cy="80" r="70" stroke="#E5E7EB" stroke-width="12" fill="none"/>
                        <circle cx="80" cy="80" r="70" stroke="#F97316" stroke-width="12" fill="none" stroke-dasharray="440" stroke-dashoffset="33" stroke-linecap="round"/>
                    </svg>
                    <div class="absolute inset-0 flex flex-col items-center justify-center">
                        <span class="text-3xl font-bold text-gray-800">92.5%</span>
                        <span class="text-xs text-gray-500 mt-1">Present</span>
                    </div>
                </div>
            </div>

            <!-- Attendance Breakdown -->
            <div class="space-y-3">
                <div class="flex items-center justify-between p-3 bg-green-50 rounded-lg">
                    <div class="flex items-center">
                        <div class="w-8 h-8 bg-green-500 rounded-full flex items-center justify-center">
                            <svg class="w-4 h-4 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/>
                            </svg>
                        </div>
                        <span class="text-sm font-medium text-gray-700 ml-3">Present</span>
                    </div>
                    <span class="text-sm font-bold text-gray-800">87</span>
                </div>

                <div class="flex items-center justify-between p-3 bg-orange-50 rounded-lg">
                    <div class="flex items-center">
                        <div class="w-8 h-8 bg-orange-500 rounded-full flex items-center justify-center">
                            <svg class="w-4 h-4 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"/>
                            </svg>
                        </div>
                        <span class="text-sm font-medium text-gray-700 ml-3">On Leave</span>
                    </div>
                    <span class="text-sm font-bold text-gray-800">5</span>
                </div>

                <div class="flex items-center justify-between p-3 bg-red-50 rounded-lg">
                    <div class="flex items-center">
                        <div class="w-8 h-8 bg-red-500 rounded-full flex items-center justify-center">
                            <svg class="w-4 h-4 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/>
                            </svg>
                        </div>
                        <span class="text-sm font-medium text-gray-700 ml-3">Absent</span>
                    </div>
                    <span class="text-sm font-bold text-gray-800">2</span>
                </div>
            </div>
        </div>
    </div>

    <!-- Recent Activities & Leave Requests -->
    <div class="grid grid-cols-1 lg:grid-cols-2 gap-6 mb-6">
        <!-- Recent Recruitment -->
        <div class="bg-white rounded-xl shadow-sm border border-gray-100">
            <div class="p-6 border-b border-gray-200">
                <div class="flex items-center justify-between">
                    <h2 class="text-lg font-bold text-gray-800">Recent Applicants</h2>
                    <a href="/hr/recruitment" class="text-sm text-orange-600 hover:text-orange-700 font-medium">View All</a>
                </div>
            </div>
            <div class="divide-y divide-gray-200">
                <div class="p-4 hover:bg-gray-50 transition">
                    <div class="flex items-center justify-between">
                        <div class="flex items-center">
                            <div class="w-12 h-12 bg-gradient-to-br from-blue-500 to-cyan-500 rounded-full flex items-center justify-center text-white font-semibold">
                                SJ
                            </div>
                            <div class="ml-3">
                                <p class="text-sm font-semibold text-gray-800">Sarah Johnson</p>
                                <p class="text-xs text-gray-500 mt-1">Senior Developer</p>
                            </div>
                        </div>
                        <div class="text-right">
                            <span class="px-3 py-1 bg-blue-100 text-blue-700 text-xs font-medium rounded-full">New</span>
                            <p class="text-xs text-gray-500 mt-1">2h ago</p>
                        </div>
                    </div>
                </div>

                <div class="p-4 hover:bg-gray-50 transition">
                    <div class="flex items-center justify-between">
                        <div class="flex items-center">
                            <div class="w-12 h-12 bg-gradient-to-br from-purple-500 to-pink-500 rounded-full flex items-center justify-center text-white font-semibold">
                                MK
                            </div>
                            <div class="ml-3">
                                <p class="text-sm font-semibold text-gray-800">Michael Kim</p>
                                <p class="text-xs text-gray-500 mt-1">Marketing Manager</p>
                            </div>
                        </div>
                        <div class="text-right">
                            <span class="px-3 py-1 bg-green-100 text-green-700 text-xs font-medium rounded-full">Interview</span>
                            <p class="text-xs text-gray-500 mt-1">5h ago</p>
                        </div>
                    </div>
                </div>

                <div class="p-4 hover:bg-gray-50 transition">
                    <div class="flex items-center justify-between">
                        <div class="flex items-center">
                            <div class="w-12 h-12 bg-gradient-to-br from-orange-500 to-amber-500 rounded-full flex items-center justify-center text-white font-semibold">
                                EP
                            </div>
                            <div class="ml-3">
                                <p class="text-sm font-semibold text-gray-800">Emily Parker</p>
                                <p class="text-xs text-gray-500 mt-1">UI/UX Designer</p>
                            </div>
                        </div>
                        <div class="text-right">
                            <span class="px-3 py-1 bg-blue-100 text-blue-700 text-xs font-medium rounded-full">New</span>
                            <p class="text-xs text-gray-500 mt-1">1d ago</p>
                        </div>
                    </div>
                </div>

                <div class="p-4 hover:bg-gray-50 transition">
                    <div class="flex items-center justify-between">
                        <div class="flex items-center">
                            <div class="w-12 h-12 bg-gradient-to-br from-green-500 to-emerald-500 rounded-full flex items-center justify-center text-white font-semibold">
                                DW
                            </div>
                            <div class="ml-3">
                                <p class="text-sm font-semibold text-gray-800">David Wilson</p>
                                <p class="text-xs text-gray-500 mt-1">Data Analyst</p>
                            </div>
                        </div>
                        <div class="text-right">
                            <span class="px-3 py-1 bg-amber-100 text-amber-700 text-xs font-medium rounded-full">Review</span>
                            <p class="text-xs text-gray-500 mt-1">1d ago</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Pending Leave Requests -->
        <div class="bg-white rounded-xl shadow-sm border border-gray-100">
            <div class="p-6 border-b border-gray-200">
                <div class="flex items-center justify-between">
                    <h2 class="text-lg font-bold text-gray-800">Leave Requests</h2>
                    <span class="px-3 py-1 bg-amber-100 text-amber-700 text-xs font-bold rounded-full">8 Pending</span>
                </div>
            </div>
            <div class="divide-y divide-gray-200">
                <a href="/hr/leave/1" class="block p-4 hover:bg-amber-50 transition">
                    <div class="flex items-center justify-between mb-2">
                        <div class="flex items-center">
                            <div class="w-10 h-10 bg-indigo-500 rounded-full flex items-center justify-center text-white font-semibold text-sm">
                                JD
                            </div>
                            <div class="ml-3">
                                <p class="text-sm font-semibold text-gray-800">John Doe</p>
                                <p class="text-xs text-gray-500">Engineering Team</p>
                            </div>
                        </div>
                        <span class="px-2 py-1 bg-amber-100 text-amber-700 text-xs font-medium rounded">Urgent</span>
                    </div>
                    <div class="ml-13">
                        <p class="text-xs text-gray-600">Annual Leave • 3 days</p>
                        <p class="text-xs text-gray-500 mt-1">Jan 5 - Jan 7, 2026</p>
                    </div>
                </a>

                <a href="/hr/leave/2" class="block p-4 hover:bg-blue-50 transition">
                    <div class="flex items-center justify-between mb-2">
                        <div class="flex items-center">
                            <div class="w-10 h-10 bg-purple-500 rounded-full flex items-center justify-center text-white font-semibold text-sm">
                                AS
                            </div>
                            <div class="ml-3">
                                <p class="text-sm font-semibold text-gray-800">Alice Smith</p>
                                <p class="text-xs text-gray-500">Marketing Team</p>
                            </div>
                        </div>
                        <span class="px-2 py-1 bg-blue-100 text-blue-700 text-xs font-medium rounded">Normal</span>
                    </div>
                    <div class="ml-13">
                        <p class="text-xs text-gray-600">Sick Leave • 1 day</p>
                        <p class="text-xs text-gray-500 mt-1">Dec 31, 2025</p>
                    </div>
                </a>

                <a href="/hr/leave/3" class="block p-4 hover:bg-blue-50 transition">
                    <div class="flex items-center justify-between mb-2">
                        <div class="flex items-center">
                            <div class="w-10 h-10 bg-green-500 rounded-full flex items-center justify-center text-white font-semibold text-sm">
                                RB
                            </div>
                            <div class="ml-3">
                                <p class="text-sm font-semibold text-gray-800">Robert Brown</p>
                                <p class="text-xs text-gray-500">Sales Team</p>
                            </div>
                        </div>
                        <span class="px-2 py-1 bg-blue-100 text-blue-700 text-xs font-medium rounded">Normal</span>
                    </div>
                    <div class="ml-13">
                        <p class="text-xs text-gray-600">Personal Leave • 2 days</p>
                        <p class="text-xs text-gray-500 mt-1">Jan 10 - Jan 11, 2026</p>
                    </div>
                </a>

                <a href="/hr/leave/4" class="block p-4 hover:bg-blue-50 transition">
                    <div class="flex items-center justify-between mb-2">
                        <div class="flex items-center">
                            <div class="w-10 h-10 bg-pink-500 rounded-full flex items-center justify-center text-white font-semibold text-sm">
                                MJ
                            </div>
                            <div class="ml-3">
                                <p class="text-sm font-semibold text-gray-800">Maria Johnson</p>
                                <p class="text-xs text-gray-500">Support Team</p>
                            </div>
                        </div>
                        <span class="px-2 py-1 bg-blue-100 text-blue-700 text-xs font-medium rounded">Normal</span>
                    </div>
                    <div class="ml-13">
                        <p class="text-xs text-gray-600">Annual Leave • 5 days</p>
                        <p class="text-xs text-gray-500 mt-1">Jan 15 - Jan 19, 2026</p>
                    </div>
                </a>
            </div>
        </div>
    </div>

    <!-- Upcoming Events & Quick Actions -->
    <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">
        <!-- Upcoming Events & Birthdays -->
        <div class="lg:col-span-2 bg-white rounded-xl shadow-sm p-6 border border-gray-100">
            <h2 class="text-lg font-bold text-gray-800 mb-6">Upcoming Events & Celebrations</h2>
            
            <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                <!-- Birthday Cards -->
                <div class="p-4 bg-gradient-to-br from-pink-50 to-purple-50 border-2 border-pink-200 rounded-lg">
                    <div class="flex items-center mb-3">
                        <div class="w-10 h-10 bg-pink-500 rounded-full flex items-center justify-center">
                            <svg class="w-5 h-5 text-white" fill="currentColor" viewBox="0 0 24 24">
                                <path d="M12 6.042A8.967 8.967 0 006 3.75c-1.052 0-2.062.18-3 .512v14.25A8.987 8.987 0 016 18c2.305 0 4.408.867 6 2.292m0-14.25a8.966 8.966 0 016-2.292c1.052 0 2.062.18 3 .512v14.25A8.987 8.987 0 0018 18a8.967 8.967 0 00-6 2.292m0-14.25v14.25"/>
                            </svg>
                        </div>
                        <div class="ml-3">
                            <p class="text-sm font-bold text-gray-800">🎂 Birthday Today!</p>
                            <p class="text-xs text-gray-600">Emma Wilson</p>
                        </div>
                    </div>
                    <a href="/hr/employees/wish" class="text-xs text-pink-600 hover:text-pink-700 font-medium">Send Wishes →</a>
                </div>

                <div class="p-4 bg-gradient-to-br from-blue-50 to-cyan-50 border-2 border-blue-200 rounded-lg">
                    <div class="flex items-center mb-3">
                        <div class="w-10 h-10 bg-blue-500 rounded-full flex items-center justify-center">
                            <svg class="w-5 h-5 text-white" fill="currentColor" viewBox="0 0 24 24">
                                <path d="M11.645 20.91l-.007-.003-.022-.012a15.247 15.247 0 01-.383-.218 25.18 25.18 0 01-4.244-3.17C4.688 15.36 2.25 12.174 2.25 8.25 2.25 5.322 4.714 3 7.688 3A5.5 5.5 0 0112 5.052 5.5 5.5 0 0116.313 3c2.973 0 5.437 2.322 5.437 5.25 0 3.925-2.438 7.111-4.739 9.256a25.175 25.175 0 01-4.244 3.17 15.247 15.247 0 01-.383.219l-.022.012-.007.004-.003.001a.752.752 0 01-.704 0l-.003-.001z"/>
                            </svg>
                        </div>
                        <div class="ml-3">
                            <p class="text-sm font-bold text-gray-800">Work Anniversary</p>
                            <p class="text-xs text-gray-600">Tom Chen - 5 years</p>
                        </div>
                    </div>
                    <a href="/hr/employees/congratulate" class="text-xs text-blue-600 hover:text-blue-700 font-medium">Congratulate →</a>
                </div>

                <div class="p-4 bg-gradient-to-br from-green-50 to-emerald-50 border-2 border-green-200 rounded-lg">
                    <div class="flex items-center mb-3">
                        <div class="w-10 h-10 bg-green-500 rounded-full flex items-center justify-center">
                            <svg class="w-5 h-5 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.247 18 16.5 18c-1.746 0-3.332.477-4.5 1.253"/>
                            </svg>
                        </div>
                        <div class="ml-3">
                            <p class="text-sm font-bold text-gray-800">Training Session</p>
                            <p class="text-xs text-gray-600">Leadership Skills - Tomorrow</p>
                        </div>
                    </div>
                    <a href="/hr/training/details" class="text-xs text-green-600 hover:text-green-700 font-medium">View Details →</a>
                </div>

                <div class="p-4 bg-gradient-to-br from-amber-50 to-orange-50 border-2 border-amber-200 rounded-lg">
                    <div class="flex items-center mb-3">
                        <div class="w-10 h-10 bg-amber-500 rounded-full flex items-center justify-center">
                            <svg class="w-5 h-5 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"/>
                            </svg>
                        </div>
                        <div class="ml-3">
                            <p class="text-sm font-bold text-gray-800">Company Event</p>
                            <p class="text-xs text-gray-600">Year-End Party - Jan 3</p>
                        </div>
                    </div>
                    <a href="/hr/events/rsvp" class="text-xs text-amber-600 hover:text-amber-700 font-medium">RSVP Now →</a>
                </div>
            </div>
        </div>

        <!-- Quick HR Actions -->
        <div class="bg-white rounded-xl shadow-sm p-6 border border-gray-100">
            <h2 class="text-lg font-bold text-gray-800 mb-6">Quick Actions</h2>
            <div class="space-y-3">
                <a href="{{ route('hr.employees.create') }}" class="flex items-center p-4 bg-gradient-to-r from-orange-500 to-pink-600 text-white rounded-lg hover:from-orange-600 hover:to-pink-700 transition shadow-md">
                    <svg class="w-5 h-5 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M18 9v3m0 0v3m0-3h3m-3 0h-3m-2-5a4 4 0 11-8 0 4 4 0 018 0zM3 20a6 6 0 0112 0v1H3v-1z"/>
                    </svg>
                    <span class="font-medium">Add New Employee</span>
                </a>

                <a href="/hr/recruitment/post" class="flex items-center p-4 bg-white border-2 border-orange-200 text-orange-600 rounded-lg hover:bg-orange-50 transition">
                    <svg class="w-5 h-5 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 13.255A23.931 23.931 0 0112 15c-3.183 0-6.22-.62-9-1.745M16 6V4a2 2 0 00-2-2h-4a2 2 0 00-2 2v2m4 6h.01M5 20h14a2 2 0 002-2V8a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"/>
                    </svg>
                    <span class="font-medium">Post Job Opening</span>
                </a>

                <a href="/hr/payroll/process" class="flex items-center p-4 bg-white border-2 border-gray-200 text-gray-700 rounded-lg hover:bg-gray-50 transition">
                    <svg class="w-5 h-5 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/>
                    </svg>
                    <span class="font-medium">Process Payroll</span>
                </a>

                <a href="/hr/reports/generate" class="flex items-center p-4 bg-white border-2 border-gray-200 text-gray-700 rounded-lg hover:bg-gray-50 transition">
                    <svg class="w-5 h-5 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 17v-2m3 2v-4m3 4v-6m2 10H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"/>
                    </svg>
                    <span class="font-medium">Generate Report</span>
                </a>
            </div>

            <!-- HR Reminders -->
            <div class="mt-6">
                <h3 class="text-sm font-bold text-gray-800 mb-4">Reminders</h3>
                <div class="space-y-3">
                    <div class="p-3 bg-red-50 border border-red-200 rounded-lg">
                        <div class="flex items-start">
                            <svg class="w-5 h-5 text-red-600 mr-2 flex-shrink-0 mt-0.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4m0 4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/>
                            </svg>
                            <div>
                                <p class="text-sm font-medium text-gray-800">3 Leave Requests</p>
                                <p class="text-xs text-gray-600 mt-1">Urgent approval needed</p>
                            </div>
                        </div>
                    </div>

                    <div class="p-3 bg-amber-50 border border-amber-200 rounded-lg">
                        <div class="flex items-start">
                            <svg class="w-5 h-5 text-amber-600 mr-2 flex-shrink-0 mt-0.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"/>
                            </svg>
                            <div>
                                <p class="text-sm font-medium text-gray-800">Performance Reviews</p>
                                <p class="text-xs text-gray-600 mt-1">Q4 reviews due next week</p>
                            </div>
                        </div>
                    </div>

                    <div class="p-3 bg-blue-50 border border-blue-200 rounded-lg">
                        <div class="flex items-start">
                            <svg class="w-5 h-5 text-blue-600 mr-2 flex-shrink-0 mt-0.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z"/>
                            </svg>
                            <div>
                                <p class="text-sm font-medium text-gray-800">New Hires Onboarding</p>
                                <p class="text-xs text-gray-600 mt-1">2 employees start Monday</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection