@extends('layouts.manager')

@section('title', 'Manager Dashboard')
@section('breadcrumb', 'Overview')

@section('content')
<div x-data="{ activeFilter: 'all' }">
    <!-- Page Header with Action Buttons -->
    <div class="flex items-center justify-between mb-6">
        <div>
            <h1 class="text-3xl font-bold text-gray-800">Manager Dashboard</h1>
            <p class="text-gray-600 mt-1">Monitor team performance and manage operations</p>
        </div>
        <div class="flex space-x-3">
            <a href="/manager/reports/generate" class="flex items-center px-4 py-2 bg-white border border-gray-300 text-gray-700 rounded-lg hover:bg-gray-50 transition">
                <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 10v6m0 0l-3-3m3 3l3-3m2 8H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"/>
                </svg>
                Export Report
            </a>
            <a href="/manager/team/meeting" class="flex items-center px-4 py-2 bg-gradient-to-r from-emerald-500 to-teal-600 text-white rounded-lg hover:from-emerald-600 hover:to-teal-700 transition shadow-md">
                <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"/>
                </svg>
                Schedule Meeting
            </a>
        </div>
    </div>

    <!-- Stats Overview -->
    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6 mb-6">
        <!-- Team Members -->
        <div class="bg-white rounded-xl shadow-sm p-6 border border-gray-100 hover:shadow-md transition">
            <div class="flex items-center justify-between">
                <div>
                    <p class="text-sm font-medium text-gray-600">Team Members</p>
                    <h3 class="text-3xl font-bold text-gray-800 mt-2">24</h3>
                    <div class="flex items-center mt-2">
                        <span class="text-emerald-600 text-sm font-medium">+2</span>
                        <span class="text-gray-500 text-sm ml-2">new this month</span>
                    </div>
                </div>
                <div class="w-14 h-14 bg-emerald-100 rounded-full flex items-center justify-center">
                    <svg class="w-7 h-7 text-emerald-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197M13 7a4 4 0 11-8 0 4 4 0 018 0z"/>
                    </svg>
                </div>
            </div>
        </div>

        <!-- Active Projects -->
        <div class="bg-white rounded-xl shadow-sm p-6 border border-gray-100 hover:shadow-md transition">
            <div class="flex items-center justify-between">
                <div>
                    <p class="text-sm font-medium text-gray-600">Active Projects</p>
                    <h3 class="text-3xl font-bold text-gray-800 mt-2">18</h3>
                    <div class="flex items-center mt-2">
                        <span class="text-blue-600 text-sm font-medium">12</span>
                        <span class="text-gray-500 text-sm ml-2">on track</span>
                    </div>
                </div>
                <div class="w-14 h-14 bg-blue-100 rounded-full flex items-center justify-center">
                    <svg class="w-7 h-7 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2"/>
                    </svg>
                </div>
            </div>
        </div>

        <!-- Pending Approvals -->
        <div class="bg-white rounded-xl shadow-sm p-6 border border-gray-100 hover:shadow-md transition">
            <div class="flex items-center justify-between">
                <div>
                    <p class="text-sm font-medium text-gray-600">Pending Approvals</p>
                    <h3 class="text-3xl font-bold text-gray-800 mt-2">8</h3>
                    <div class="flex items-center mt-2">
                        <span class="text-amber-600 text-sm font-medium">3 urgent</span>
                        <span class="text-gray-500 text-sm ml-2">requests</span>
                    </div>
                </div>
                <div class="w-14 h-14 bg-amber-100 rounded-full flex items-center justify-center">
                    <svg class="w-7 h-7 text-amber-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"/>
                    </svg>
                </div>
            </div>
        </div>

        <!-- Budget Utilization -->
        <div class="bg-white rounded-xl shadow-sm p-6 border border-gray-100 hover:shadow-md transition">
            <div class="flex items-center justify-between">
                <div>
                    <p class="text-sm font-medium text-gray-600">Budget Used</p>
                    <h3 class="text-3xl font-bold text-gray-800 mt-2">72%</h3>
                    <div class="flex items-center mt-2">
                        <span class="text-emerald-600 text-sm font-medium">$185K</span>
                        <span class="text-gray-500 text-sm ml-2">of $250K</span>
                    </div>
                </div>
                <div class="w-14 h-14 bg-teal-100 rounded-full flex items-center justify-center">
                    <svg class="w-7 h-7 text-teal-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 9V7a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2m2 4h10a2 2 0 002-2v-6a2 2 0 00-2-2H9a2 2 0 00-2 2v6a2 2 0 002 2zm7-5a2 2 0 11-4 0 2 2 0 014 0z"/>
                    </svg>
                </div>
            </div>
        </div>
    </div>

    <!-- Main Content Grid -->
    <div class="grid grid-cols-1 lg:grid-cols-3 gap-6 mb-6">
        <!-- Team Performance -->
        <div class="lg:col-span-2 bg-white rounded-xl shadow-sm p-6 border border-gray-100">
            <div class="flex items-center justify-between mb-6">
                <h2 class="text-lg font-bold text-gray-800">Team Performance</h2>
                <select class="px-3 py-2 border border-gray-300 rounded-lg text-sm focus:outline-none focus:ring-2 focus:ring-emerald-500">
                    <option>This Month</option>
                    <option>Last Month</option>
                    <option>Last Quarter</option>
                </select>
            </div>
            
            <div class="space-y-5">
                <div>
                    <div class="flex items-center justify-between mb-2">
                        <div class="flex items-center">
                            <div class="w-8 h-8 bg-indigo-100 rounded-full flex items-center justify-center text-indigo-600 font-semibold text-sm mr-3">
                                MA
                            </div>
                            <div>
                                <p class="text-sm font-semibold text-gray-800">Marketing Team</p>
                                <p class="text-xs text-gray-500">8 members</p>
                            </div>
                        </div>
                        <span class="text-sm font-bold text-emerald-600">94%</span>
                    </div>
                    <div class="w-full bg-gray-200 rounded-full h-2.5">
                        <div class="bg-gradient-to-r from-emerald-500 to-teal-500 h-2.5 rounded-full" style="width: 94%"></div>
                    </div>
                </div>

                <div>
                    <div class="flex items-center justify-between mb-2">
                        <div class="flex items-center">
                            <div class="w-8 h-8 bg-purple-100 rounded-full flex items-center justify-center text-purple-600 font-semibold text-sm mr-3">
                                SA
                            </div>
                            <div>
                                <p class="text-sm font-semibold text-gray-800">Sales Team</p>
                                <p class="text-xs text-gray-500">6 members</p>
                            </div>
                        </div>
                        <span class="text-sm font-bold text-emerald-600">89%</span>
                    </div>
                    <div class="w-full bg-gray-200 rounded-full h-2.5">
                        <div class="bg-gradient-to-r from-purple-500 to-pink-500 h-2.5 rounded-full" style="width: 89%"></div>
                    </div>
                </div>

                <div>
                    <div class="flex items-center justify-between mb-2">
                        <div class="flex items-center">
                            <div class="w-8 h-8 bg-blue-100 rounded-full flex items-center justify-center text-blue-600 font-semibold text-sm mr-3">
                                DE
                            </div>
                            <div>
                                <p class="text-sm font-semibold text-gray-800">Development Team</p>
                                <p class="text-xs text-gray-500">10 members</p>
                            </div>
                        </div>
                        <span class="text-sm font-bold text-emerald-600">92%</span>
                    </div>
                    <div class="w-full bg-gray-200 rounded-full h-2.5">
                        <div class="bg-gradient-to-r from-blue-500 to-cyan-500 h-2.5 rounded-full" style="width: 92%"></div>
                    </div>
                </div>

                <div>
                    <div class="flex items-center justify-between mb-2">
                        <div class="flex items-center">
                            <div class="w-8 h-8 bg-orange-100 rounded-full flex items-center justify-center text-orange-600 font-semibold text-sm mr-3">
                                CS
                            </div>
                            <div>
                                <p class="text-sm font-semibold text-gray-800">Customer Support</p>
                                <p class="text-xs text-gray-500">5 members</p>
                            </div>
                        </div>
                        <span class="text-sm font-bold text-amber-600">78%</span>
                    </div>
                    <div class="w-full bg-gray-200 rounded-full h-2.5">
                        <div class="bg-gradient-to-r from-orange-500 to-amber-500 h-2.5 rounded-full" style="width: 78%"></div>
                    </div>
                </div>
            </div>

            <div class="mt-6 pt-6 border-t border-gray-200">
                <div class="grid grid-cols-3 gap-4 text-center">
                    <div>
                        <p class="text-2xl font-bold text-gray-800">88%</p>
                        <p class="text-xs text-gray-600 mt-1">Avg Performance</p>
                    </div>
                    <div>
                        <p class="text-2xl font-bold text-emerald-600">156</p>
                        <p class="text-xs text-gray-600 mt-1">Tasks Completed</p>
                    </div>
                    <div>
                        <p class="text-2xl font-bold text-blue-600">24</p>
                        <p class="text-xs text-gray-600 mt-1">Active Tasks</p>
                    </div>
                </div>
            </div>
        </div>

        <!-- Pending Approvals Widget -->
        <div class="bg-white rounded-xl shadow-sm p-6 border border-gray-100">
            <div class="flex items-center justify-between mb-6">
                <h2 class="text-lg font-bold text-gray-800">Pending Approvals</h2>
                <span class="px-3 py-1 bg-red-100 text-red-600 text-xs font-bold rounded-full">8</span>
            </div>
            
            <div class="space-y-3">
                <a href="/manager/approvals/1" class="block p-4 bg-red-50 border border-red-200 rounded-lg hover:bg-red-100 transition">
                    <div class="flex items-start justify-between">
                        <div class="flex-1">
                            <p class="text-sm font-semibold text-gray-800">Budget Request</p>
                            <p class="text-xs text-gray-600 mt-1">Marketing Campaign - $15,000</p>
                            <div class="flex items-center mt-2">
                                <span class="text-xs text-red-600 font-medium">Urgent</span>
                                <span class="text-xs text-gray-500 ml-2">• 2h ago</span>
                            </div>
                        </div>
                        <svg class="w-5 h-5 text-red-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/>
                        </svg>
                    </div>
                </a>

                <a href="/manager/approvals/2" class="block p-4 bg-amber-50 border border-amber-200 rounded-lg hover:bg-amber-100 transition">
                    <div class="flex items-start justify-between">
                        <div class="flex-1">
                            <p class="text-sm font-semibold text-gray-800">Leave Request</p>
                            <p class="text-xs text-gray-600 mt-1">John Doe - 3 days</p>
                            <div class="flex items-center mt-2">
                                <span class="text-xs text-amber-600 font-medium">Normal</span>
                                <span class="text-xs text-gray-500 ml-2">• 5h ago</span>
                            </div>
                        </div>
                        <svg class="w-5 h-5 text-amber-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/>
                        </svg>
                    </div>
                </a>

                <a href="/manager/approvals/3" class="block p-4 bg-blue-50 border border-blue-200 rounded-lg hover:bg-blue-100 transition">
                    <div class="flex items-start justify-between">
                        <div class="flex-1">
                            <p class="text-sm font-semibold text-gray-800">Project Proposal</p>
                            <p class="text-xs text-gray-600 mt-1">Mobile App Development</p>
                            <div class="flex items-center mt-2">
                                <span class="text-xs text-blue-600 font-medium">Review</span>
                                <span class="text-xs text-gray-500 ml-2">• 1d ago</span>
                            </div>
                        </div>
                        <svg class="w-5 h-5 text-blue-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/>
                        </svg>
                    </div>
                </a>

                <a href="/manager/approvals/4" class="block p-4 bg-gray-50 border border-gray-200 rounded-lg hover:bg-gray-100 transition">
                    <div class="flex items-start justify-between">
                        <div class="flex-1">
                            <p class="text-sm font-semibold text-gray-800">Expense Report</p>
                            <p class="text-xs text-gray-600 mt-1">Travel & Accommodation</p>
                            <div class="flex items-center mt-2">
                                <span class="text-xs text-gray-600 font-medium">Pending</span>
                                <span class="text-xs text-gray-500 ml-2">• 2d ago</span>
                            </div>
                        </div>
                        <svg class="w-5 h-5 text-gray-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/>
                        </svg>
                    </div>
                </a>
            </div>

            <a href="/manager/approvals" class="block mt-4 text-center text-sm text-emerald-600 hover:text-emerald-700 font-medium">
                View All Approvals →
            </a>
        </div>
    </div>

    <!-- Projects & Calendar -->
    <div class="grid grid-cols-1 lg:grid-cols-2 gap-6">
        <!-- Recent Projects -->
        <div class="bg-white rounded-xl shadow-sm border border-gray-100">
            <div class="p-6 border-b border-gray-200">
                <div class="flex items-center justify-between">
                    <h2 class="text-lg font-bold text-gray-800">Active Projects</h2>
                    <a href="/manager/projects" class="text-sm text-emerald-600 hover:text-emerald-700 font-medium">View All</a>
                </div>
            </div>
            <div class="p-6 space-y-4">
                <div class="p-4 border border-gray-200 rounded-lg hover:border-emerald-300 transition">
                    <div class="flex items-start justify-between mb-3">
                        <div>
                            <h3 class="font-semibold text-gray-800">Website Redesign</h3>
                            <p class="text-xs text-gray-500 mt-1">Due: Dec 31, 2025</p>
                        </div>
                        <span class="px-3 py-1 bg-emerald-100 text-emerald-700 text-xs font-medium rounded-full">On Track</span>
                    </div>
                    <div class="flex items-center justify-between mb-2">
                        <span class="text-sm text-gray-600">Progress</span>
                        <span class="text-sm font-semibold text-gray-800">75%</span>
                    </div>
                    <div class="w-full bg-gray-200 rounded-full h-2">
                        <div class="bg-emerald-500 h-2 rounded-full" style="width: 75%"></div>
                    </div>
                    <div class="flex items-center mt-3">
                        <div class="flex -space-x-2">
                            <div class="w-7 h-7 bg-indigo-500 rounded-full border-2 border-white flex items-center justify-center text-white text-xs font-semibold">JD</div>
                            <div class="w-7 h-7 bg-purple-500 rounded-full border-2 border-white flex items-center justify-center text-white text-xs font-semibold">AS</div>
                            <div class="w-7 h-7 bg-blue-500 rounded-full border-2 border-white flex items-center justify-center text-white text-xs font-semibold">MK</div>
                        </div>
                        <span class="text-xs text-gray-500 ml-3">6 team members</span>
                    </div>
                </div>

                <div class="p-4 border border-gray-200 rounded-lg hover:border-emerald-300 transition">
                    <div class="flex items-start justify-between mb-3">
                        <div>
                            <h3 class="font-semibold text-gray-800">Mobile App Launch</h3>
                            <p class="text-xs text-gray-500 mt-1">Due: Jan 15, 2026</p>
                        </div>
                        <span class="px-3 py-1 bg-blue-100 text-blue-700 text-xs font-medium rounded-full">In Progress</span>
                    </div>
                    <div class="flex items-center justify-between mb-2">
                        <span class="text-sm text-gray-600">Progress</span>
                        <span class="text-sm font-semibold text-gray-800">45%</span>
                    </div>
                    <div class="w-full bg-gray-200 rounded-full h-2">
                        <div class="bg-blue-500 h-2 rounded-full" style="width: 45%"></div>
                    </div>
                    <div class="flex items-center mt-3">
                        <div class="flex -space-x-2">
                            <div class="w-7 h-7 bg-green-500 rounded-full border-2 border-white flex items-center justify-center text-white text-xs font-semibold">RB</div>
                            <div class="w-7 h-7 bg-orange-500 rounded-full border-2 border-white flex items-center justify-center text-white text-xs font-semibold">LM</div>
                        </div>
                        <span class="text-xs text-gray-500 ml-3">4 team members</span>
                    </div>
                </div>

                <div class="p-4 border border-amber-200 bg-amber-50 rounded-lg">
                    <div class="flex items-start justify-between mb-3">
                        <div>
                            <h3 class="font-semibold text-gray-800">Q1 Marketing Campaign</h3>
                            <p class="text-xs text-gray-500 mt-1">Due: Jan 5, 2026</p>
                        </div>
                        <span class="px-3 py-1 bg-amber-200 text-amber-800 text-xs font-medium rounded-full">At Risk</span>
                    </div>
                    <div class="flex items-center justify-between mb-2">
                        <span class="text-sm text-gray-600">Progress</span>
                        <span class="text-sm font-semibold text-gray-800">28%</span>
                    </div>
                    <div class="w-full bg-gray-200 rounded-full h-2">
                        <div class="bg-amber-500 h-2 rounded-full" style="width: 28%"></div>
                    </div>
                    <div class="flex items-center mt-3">
                        <div class="flex -space-x-2">
                            <div class="w-7 h-7 bg-pink-500 rounded-full border-2 border-white flex items-center justify-center text-white text-xs font-semibold">SK</div>
                            <div class="w-7 h-7 bg-teal-500 rounded-full border-2 border-white flex items-center justify-center text-white text-xs font-semibold">DN</div>
                        </div>
                        <span class="text-xs text-gray-500 ml-3">3 team members</span>
                    </div>
                </div>
            </div>
        </div>

        <!-- Upcoming Schedule -->
        <div class="bg-white rounded-xl shadow-sm border border-gray-100">
            <div class="p-6 border-b border-gray-200">
                <div class="flex items-center justify-between">
                    <h2 class="text-lg font-bold text-gray-800">Upcoming Schedule</h2>
                    <a href="/manager/calendar" class="text-sm text-emerald-600 hover:text-emerald-700 font-medium">View Calendar</a>
                </div>
            </div>
            <div class="p-6">
                <!-- Today -->
                <div class="mb-6">
                    <h3 class="text-sm font-bold text-gray-700 mb-3">Today - Dec 30</h3>
                    <div class="space-y-3">
                        <div class="flex items-start p-3 bg-emerald-50 border-l-4 border-emerald-500 rounded-r-lg">
                            <div class="flex-shrink-0 w-12 text-center">
                                <p class="text-xs text-gray-500">09:00</p>
                            </div>
                            <div class="flex-1 ml-3">
                                <p class="text-sm font-semibold text-gray-800">Team Standup Meeting</p>
                                <p class="text-xs text-gray-600 mt-1">With Development Team</p>
                            </div>
                        </div>
                        <div class="flex items-start p-3 bg-blue-50 border-l-4 border-blue-500 rounded-r-lg">
                            <div class="flex-shrink-0 w-12 text-center">
                                <p class="text-xs text-gray-500">14:00</p>
                            </div>
                            <div class="flex-1 ml-3">
                                <p class="text-sm font-semibold text-gray-800">Project Review</p>
                                <p class="text-xs text-gray-600 mt-1">Website Redesign Progress</p>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Tomorrow -->
                <div>
                    <h3 class="text-sm font-bold text-gray-700 mb-3">Tomorrow - Dec 31</h3>
                    <div class="space-y-3">
                        <div class="flex items-start p-3 bg-purple-50 border-l-4 border-purple-500 rounded-r-lg">
                            <div class="flex-shrink-0 w-12 text-center">
                                <p class="text-xs text-gray-500">10:00</p>
                            </div>
                            <div class="flex-1 ml-3">
                                <p class="text-sm font-semibold text-gray-800">Budget Planning</p>
                                <p class="text-xs text-gray-600 mt-1">Q1 2026 Budget Discussion</p>
                            </div>
                        </div>
                        <div class="flex items-start p-3 bg-amber-50 border-l-4 border-amber-500 rounded-r-lg">
                            <div class="flex-shrink-0 w-12 text-center">
                                <p class="text-xs text-gray-500">15:30</p>
                            </div>
                            <div class="flex-1 ml-3">
                                <p class="text-sm font-semibold text-gray-800">Performance Review</p>
                                <p class="text-xs text-gray-600 mt-1">Marketing Team Q4 Results</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection