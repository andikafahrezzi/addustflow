@extends('layouts.staff')

@section('title', 'Staff Dashboard')

@section('content')
<div x-data="{ showClockOut: false }">
    <!-- Welcome Header -->
    <div class="mb-6">
        <h1 class="text-3xl font-bold text-gray-800">Welcome back, John! 👋</h1>
        <p class="text-gray-600 mt-1">Here's what you need to focus on today</p>
    </div>

    <!-- Quick Stats -->
    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6 mb-6">
        <!-- Pending Tasks -->
        <div class="bg-white rounded-xl shadow-sm p-6 border border-gray-100 hover:shadow-md transition">
            <div class="flex items-center justify-between">
                <div>
                    <p class="text-sm font-medium text-gray-600">Pending Tasks</p>
                    <h3 class="text-3xl font-bold text-gray-800 mt-2">5</h3>
                    <div class="flex items-center mt-2">
                        <span class="text-red-600 text-sm font-medium">2 urgent</span>
                        <span class="text-gray-500 text-sm ml-2">due today</span>
                    </div>
                </div>
                <div class="w-14 h-14 bg-red-100 rounded-full flex items-center justify-center">
                    <svg class="w-7 h-7 text-red-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4m0 4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/>
                    </svg>
                </div>
            </div>
        </div>

        <!-- Completed Today -->
        <div class="bg-white rounded-xl shadow-sm p-6 border border-gray-100 hover:shadow-md transition">
            <div class="flex items-center justify-between">
                <div>
                    <p class="text-sm font-medium text-gray-600">Completed Today</p>
                    <h3 class="text-3xl font-bold text-gray-800 mt-2">3</h3>
                    <div class="flex items-center mt-2">
                        <span class="text-green-600 text-sm font-medium">Great job!</span>
                        <span class="text-gray-500 text-sm ml-2">+2 from yesterday</span>
                    </div>
                </div>
                <div class="w-14 h-14 bg-green-100 rounded-full flex items-center justify-center">
                    <svg class="w-7 h-7 text-green-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/>
                    </svg>
                </div>
            </div>
        </div>

        <!-- Hours This Week -->
        <div class="bg-white rounded-xl shadow-sm p-6 border border-gray-100 hover:shadow-md transition">
            <div class="flex items-center justify-between">
                <div>
                    <p class="text-sm font-medium text-gray-600">Hours This Week</p>
                    <h3 class="text-3xl font-bold text-gray-800 mt-2">32.5h</h3>
                    <div class="flex items-center mt-2">
                        <span class="text-cyan-600 text-sm font-medium">7.5h</span>
                        <span class="text-gray-500 text-sm ml-2">remaining</span>
                    </div>
                </div>
                <div class="w-14 h-14 bg-cyan-100 rounded-full flex items-center justify-center">
                    <svg class="w-7 h-7 text-cyan-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"/>
                    </svg>
                </div>
            </div>
        </div>

        <!-- Leave Balance -->
        <div class="bg-white rounded-xl shadow-sm p-6 border border-gray-100 hover:shadow-md transition">
            <div class="flex items-center justify-between">
                <div>
                    <p class="text-sm font-medium text-gray-600">Leave Balance</p>
                    <h3 class="text-3xl font-bold text-gray-800 mt-2">12</h3>
                    <div class="flex items-center mt-2">
                        <span class="text-blue-600 text-sm font-medium">days</span>
                        <span class="text-gray-500 text-sm ml-2">available</span>
                    </div>
                </div>
                <div class="w-14 h-14 bg-blue-100 rounded-full flex items-center justify-center">
                    <svg class="w-7 h-7 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"/>
                    </svg>
                </div>
            </div>
        </div>
    </div>

    <!-- Main Content Grid -->
    <div class="grid grid-cols-1 lg:grid-cols-3 gap-6 mb-6">
        <!-- My Tasks Today -->
        <div class="lg:col-span-2 bg-white rounded-xl shadow-sm border border-gray-100">
            <div class="p-6 border-b border-gray-200">
                <div class="flex items-center justify-between">
                    <h2 class="text-lg font-bold text-gray-800">My Tasks Today</h2>
                    <a href="/staff/tasks" class="text-sm text-cyan-600 hover:text-cyan-700 font-medium">View All</a>
                </div>
            </div>
            <div class="p-6 space-y-4">
                <!-- Urgent Task -->
                <div class="p-4 border-2 border-red-200 bg-red-50 rounded-lg hover:bg-red-100 transition">
                    <div class="flex items-start">
                        <input type="checkbox" class="mt-1 mr-3 w-5 h-5 text-cyan-600 rounded">
                        <div class="flex-1">
                            <div class="flex items-center justify-between mb-2">
                                <h3 class="font-semibold text-gray-800">Complete Monthly Report</h3>
                                <span class="px-2 py-1 bg-red-200 text-red-800 text-xs font-bold rounded-full">Urgent</span>
                            </div>
                            <p class="text-sm text-gray-600 mb-2">Submit the monthly performance report to manager</p>
                            <div class="flex items-center text-xs text-gray-500">
                                <svg class="w-4 h-4 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"/>
                                </svg>
                                Due: Today, 5:00 PM
                            </div>
                        </div>
                    </div>
                </div>

                <!-- High Priority -->
                <div class="p-4 border-2 border-amber-200 bg-amber-50 rounded-lg hover:bg-amber-100 transition">
                    <div class="flex items-start">
                        <input type="checkbox" class="mt-1 mr-3 w-5 h-5 text-cyan-600 rounded">
                        <div class="flex-1">
                            <div class="flex items-center justify-between mb-2">
                                <h3 class="font-semibold text-gray-800">Review Client Feedback</h3>
                                <span class="px-2 py-1 bg-amber-200 text-amber-800 text-xs font-bold rounded-full">High</span>
                            </div>
                            <p class="text-sm text-gray-600 mb-2">Analyze feedback from recent client meeting</p>
                            <div class="flex items-center text-xs text-gray-500">
                                <svg class="w-4 h-4 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"/>
                                </svg>
                                Due: Today, 6:00 PM
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Normal Tasks -->
                <div class="p-4 border-2 border-blue-200 bg-blue-50 rounded-lg hover:bg-blue-100 transition">
                    <div class="flex items-start">
                        <input type="checkbox" class="mt-1 mr-3 w-5 h-5 text-cyan-600 rounded">
                        <div class="flex-1">
                            <div class="flex items-center justify-between mb-2">
                                <h3 class="font-semibold text-gray-800">Update Project Documentation</h3>
                                <span class="px-2 py-1 bg-blue-200 text-blue-800 text-xs font-bold rounded-full">Normal</span>
                            </div>
                            <p class="text-sm text-gray-600 mb-2">Add new features to project documentation</p>
                            <div class="flex items-center text-xs text-gray-500">
                                <svg class="w-4 h-4 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"/>
                                </svg>
                                Due: Tomorrow, 12:00 PM
                            </div>
                        </div>
                    </div>
                </div>

                <div class="p-4 border-2 border-green-200 bg-green-50 rounded-lg hover:bg-green-100 transition">
                    <div class="flex items-start">
                        <input type="checkbox" class="mt-1 mr-3 w-5 h-5 text-cyan-600 rounded">
                        <div class="flex-1">
                            <div class="flex items-center justify-between mb-2">
                                <h3 class="font-semibold text-gray-800">Team Meeting Preparation</h3>
                                <span class="px-2 py-1 bg-green-200 text-green-800 text-xs font-bold rounded-full">Low</span>
                            </div>
                            <p class="text-sm text-gray-600 mb-2">Prepare slides for weekly team meeting</p>
                            <div class="flex items-center text-xs text-gray-500">
                                <svg class="w-4 h-4 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"/>
                                </svg>
                                Due: Dec 31, 2025
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Right Sidebar -->
        <div class="space-y-6">
            <!-- Quick Actions -->
            <div class="bg-white rounded-xl shadow-sm p-6 border border-gray-100">
                <h2 class="text-lg font-bold text-gray-800 mb-4">Quick Actions</h2>
                <div class="space-y-3">
                    <button @click="showClockOut = !showClockOut" class="w-full flex items-center p-3 bg-gradient-to-r from-red-500 to-pink-600 text-white rounded-lg hover:from-red-600 hover:to-pink-700 transition shadow-md">
                        <svg class="w-5 h-5 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1"/>
                        </svg>
                        <span class="font-medium">Clock Out</span>
                    </button>

                    <a href="/staff/tasks/create" class="flex items-center p-3 bg-white border-2 border-cyan-200 text-cyan-600 rounded-lg hover:bg-cyan-50 transition">
                        <svg class="w-5 h-5 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"/>
                        </svg>
                        <span class="font-medium">Add New Task</span>
                    </a>

                    <a href="/staff/leave/request" class="flex items-center p-3 bg-white border-2 border-gray-200 text-gray-700 rounded-lg hover:bg-gray-50 transition">
                        <svg class="w-5 h-5 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"/>
                        </svg>
                        <span class="font-medium">Request Leave</span>
                    </a>

                    <a href="/staff/expenses/submit" class="flex items-center p-3 bg-white border-2 border-gray-200 text-gray-700 rounded-lg hover:bg-gray-50 transition">
                        <svg class="w-5 h-5 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 9V7a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2m2 4h10a2 2 0 002-2v-6a2 2 0 00-2-2H9a2 2 0 00-2 2v6a2 2 0 002 2zm7-5a2 2 0 11-4 0 2 2 0 014 0z"/>
                        </svg>
                        <span class="font-medium">Submit Expense</span>
                    </a>
                </div>
            </div>

            <!-- Today's Schedule -->
            <div class="bg-white rounded-xl shadow-sm p-6 border border-gray-100">
                <h2 class="text-lg font-bold text-gray-800 mb-4">Today's Schedule</h2>
                <div class="space-y-3">
                    <div class="flex items-start p-3 bg-purple-50 border-l-4 border-purple-500 rounded-r-lg">
                        <div class="flex-shrink-0 w-12 text-center">
                            <p class="text-xs text-gray-500">10:00</p>
                        </div>
                        <div class="flex-1 ml-3">
                            <p class="text-sm font-semibold text-gray-800">Team Standup</p>
                            <p class="text-xs text-gray-600 mt-1">Daily sync with team</p>
                        </div>
                    </div>

                    <div class="flex items-start p-3 bg-blue-50 border-l-4 border-blue-500 rounded-r-lg">
                        <div class="flex-shrink-0 w-12 text-center">
                            <p class="text-xs text-gray-500">14:00</p>
                        </div>
                        <div class="flex-1 ml-3">
                            <p class="text-sm font-semibold text-gray-800">Client Review</p>
                            <p class="text-xs text-gray-600 mt-1">Project milestone review</p>
                        </div>
                    </div>

                    <div class="flex items-start p-3 bg-green-50 border-l-4 border-green-500 rounded-r-lg">
                        <div class="flex-shrink-0 w-12 text-center">
                            <p class="text-xs text-gray-500">16:30</p>
                        </div>
                        <div class="flex-1 ml-3">
                            <p class="text-sm font-semibold text-gray-800">1-on-1 with Manager</p>
                            <p class="text-xs text-gray-600 mt-1">Weekly check-in</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Bottom Section -->
    <div class="grid grid-cols-1 lg:grid-cols-2 gap-6">
        <!-- Recent Activity -->
        <div class="bg-white rounded-xl shadow-sm border border-gray-100">
            <div class="p-6 border-b border-gray-200">
                <h2 class="text-lg font-bold text-gray-800">Recent Activity</h2>
            </div>
            <div class="divide-y divide-gray-200">
                <div class="p-4 hover:bg-gray-50 transition">
                    <div class="flex items-start">
                        <div class="w-10 h-10 bg-green-100 rounded-lg flex items-center justify-center flex-shrink-0">
                            <svg class="w-5 h-5 text-green-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/>
                            </svg>
                        </div>
                        <div class="ml-3 flex-1">
                            <p class="text-sm font-medium text-gray-800">Task Completed</p>
                            <p class="text-xs text-gray-600 mt-1">You completed "Update customer database"</p>
                            <p class="text-xs text-gray-500 mt-1">30 minutes ago</p>
                        </div>
                    </div>
                </div>

                <div class="p-4 hover:bg-gray-50 transition">
                    <div class="flex items-start">
                        <div class="w-10 h-10 bg-blue-100 rounded-lg flex items-center justify-center flex-shrink-0">
                            <svg class="w-5 h-5 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 8h10M7 12h4m1 8l-4-4H5a2 2 0 01-2-2V6a2 2 0 012-2h14a2 2 0 012 2v8a2 2 0 01-2 2h-3l-4 4z"/>
                            </svg>
                        </div>
                        <div class="ml-3 flex-1">
                            <p class="text-sm font-medium text-gray-800">New Comment</p>
                            <p class="text-xs text-gray-600 mt-1">Manager commented on your report</p>
                            <p class="text-xs text-gray-500 mt-1">2 hours ago</p>
                        </div>
                    </div>
                </div>

                <div class="p-4 hover:bg-gray-50 transition">
                    <div class="flex items-start">
                        <div class="w-10 h-10 bg-purple-100 rounded-lg flex items-center justify-center flex-shrink-0">
                            <svg class="w-5 h-5 text-purple-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2"/>
                            </svg>
                        </div>
                        <div class="ml-3 flex-1">
                            <p class="text-sm font-medium text-gray-800">Task Assigned</p>
                            <p class="text-xs text-gray-600 mt-1">New task: "Review client feedback"</p>
                            <p class="text-xs text-gray-500 mt-1">3 hours ago</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Team Members -->
        <div class="bg-white rounded-xl shadow-sm border border-gray-100">
            <div class="p-6 border-b border-gray-200">
                <div class="flex items-center justify-between">
                    <h2 class="text-lg font-bold text-gray-800">My Team</h2>
                    <a href="/staff/team" class="text-sm text-cyan-600 hover:text-cyan-700 font-medium">View All</a>
                </div>
            </div>
            <div class="p-6 space-y-4">
                <div class="flex items-center justify-between p-3 bg-gray-50 rounded-lg">
                    <div class="flex items-center">
                        <div class="w-10 h-10 bg-gradient-to-br from-indigo-500 to-purple-600 rounded-full flex items-center justify-center text-white font-semibold">
                            SM
                        </div>
                        <div class="ml-3">
                            <p class="text-sm font-semibold text-gray-800">Sarah Manager</p>
                            <p class="text-xs text-gray-500">Team Lead</p>
                        </div>
                    </div>
                    <div class="flex items-center">
                        <div class="w-2 h-2 bg-green-500 rounded-full mr-2"></div>
                        <span class="text-xs text-gray-600">Online</span>
                    </div>
                </div>

                <div class="flex items-center justify-between p-3 bg-gray-50 rounded-lg">
                    <div class="flex items-center">
                        <div class="w-10 h-10 bg-gradient-to-br from-green-500 to-emerald-600 rounded-full flex items-center justify-center text-white font-semibold">
                            AD
                        </div>
                        <div class="ml-3">
                            <p class="text-sm font-semibold text-gray-800">Alex Developer</p>
                            <p class="text-xs text-gray-500">Senior Developer</p>
                        </div>
                    </div>
                    <div class="flex items-center">
                        <div class="w-2 h-2 bg-green-500 rounded-full mr-2"></div>
                        <span class="text-xs text-gray-600">Online</span>
                    </div>
                </div>

                <div class="flex items-center justify-between p-3 bg-gray-50 rounded-lg">
                    <div class="flex items-center">
                        <div class="w-10 h-10 bg-gradient-to-br from-pink-500 to-rose-600 rounded-full flex items-center justify-center text-white font-semibold">
                            MK
                        </div>
                        <div class="ml-3">
                            <p class="text-sm font-semibold text-gray-800">Maria Kim</p>
                            <p class="text-xs text-gray-500">Designer</p>
                        </div>
                    </div>
                    <div class="flex items-center">
                        <div class="w-2 h-2 bg-gray-400 rounded-full mr-2"></div>
                        <span class="text-xs text-gray-600">Away</span>
                    </div>
                </div>

                <div class="flex items-center justify-between p-3 bg-gray-50 rounded-lg">
                    <div class="flex items-center">
                        <div class="w-10 h-10 bg-gradient-to-br from-orange-500 to-amber-600 rounded-full flex items-center justify-center text-white font-semibold">
                            TP
                        </div>
                        <div class="ml-3">
                            <p class="text-sm font-semibold text-gray-800">Tom Parker</p>
                            <p class="text-xs text-gray-500">QA Tester</p>
                        </div>
                    </div>
                    <div class="flex items-center">
                        <div class="w-2 h-2 bg-green-500 rounded-full mr-2"></div>
                        <span class="text-xs text-gray-600">Online</span>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Clock Out Modal (Simple) -->
    <div x-show="showClockOut" class="fixed inset-0 bg-black bg-opacity-50 flex items-center justify-center z-50" x-transition>
        <div @click.away="showClockOut = false" class="bg-white rounded-xl p-6 max-w-md mx-4 shadow-2xl">
            <h3 class="text-xl font-bold text-gray-800 mb-4">Clock Out Confirmation</h3>
            <p class="text-gray-600 mb-6">Are you sure you want to clock out? Your total hours today: <span class="font-bold text-cyan-600">6.5 hours</span></p>
            <div class="flex space-x-3">
                <button @click="showClockOut = false" class="flex-1 px-4 py-2 bg-gray-200 text-gray-700 rounded-lg hover:bg-gray-300 transition">
                    Cancel
                </button>
                <button class="flex-1 px-4 py-2 bg-red-600 text-white rounded-lg hover:bg-red-700 transition">
                    Clock Out
                </button>
            </div>
        </div>
    </div>
</div>
@endsection