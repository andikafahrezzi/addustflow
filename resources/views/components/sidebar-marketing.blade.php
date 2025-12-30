@extends('layouts.marketing')

@section('title', 'Marketing Dashboard')

@section('content')
<div x-data="{ activeTab: 'overview' }">
    <!-- Page Header -->
    <div class="mb-6">
        <h1 class="text-3xl font-bold text-gray-800">Marketing Dashboard</h1>
        <p class="text-gray-600 mt-1">Welcome back! Here's what's happening with your marketing activities.</p>
    </div>

    <!-- Stats Cards -->
    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6 mb-6">
        <!-- Total Leads -->
        <div class="bg-white rounded-xl shadow-sm p-6 border border-gray-100 hover:shadow-md transition">
            <div class="flex items-center justify-between">
                <div>
                    <p class="text-sm font-medium text-gray-600">Total Leads</p>
                    <h3 class="text-3xl font-bold text-gray-800 mt-2">1,284</h3>
                    <div class="flex items-center mt-2">
                        <span class="text-green-600 text-sm font-medium">+12.5%</span>
                        <span class="text-gray-500 text-sm ml-2">vs last month</span>
                    </div>
                </div>
                <div class="w-14 h-14 bg-indigo-100 rounded-full flex items-center justify-center">
                    <svg class="w-7 h-7 text-indigo-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z"/>
                    </svg>
                </div>
            </div>
        </div>

        <!-- Active Campaigns -->
        <div class="bg-white rounded-xl shadow-sm p-6 border border-gray-100 hover:shadow-md transition">
            <div class="flex items-center justify-between">
                <div>
                    <p class="text-sm font-medium text-gray-600">Active Campaigns</p>
                    <h3 class="text-3xl font-bold text-gray-800 mt-2">24</h3>
                    <div class="flex items-center mt-2">
                        <span class="text-green-600 text-sm font-medium">+3</span>
                        <span class="text-gray-500 text-sm ml-2">new this week</span>
                    </div>
                </div>
                <div class="w-14 h-14 bg-purple-100 rounded-full flex items-center justify-center">
                    <svg class="w-7 h-7 text-purple-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5.882V19.24a1.76 1.76 0 01-3.417.592l-2.147-6.15M18 13a3 3 0 100-6M5.436 13.683A4.001 4.001 0 017 6h1.832c4.1 0 7.625-1.234 9.168-3v14c-1.543-1.766-5.067-3-9.168-3H7a3.988 3.988 0 01-1.564-.317z"/>
                    </svg>
                </div>
            </div>
        </div>

        <!-- Conversion Rate -->
        <div class="bg-white rounded-xl shadow-sm p-6 border border-gray-100 hover:shadow-md transition">
            <div class="flex items-center justify-between">
                <div>
                    <p class="text-sm font-medium text-gray-600">Conversion Rate</p>
                    <h3 class="text-3xl font-bold text-gray-800 mt-2">18.2%</h3>
                    <div class="flex items-center mt-2">
                        <span class="text-green-600 text-sm font-medium">+2.3%</span>
                        <span class="text-gray-500 text-sm ml-2">vs last month</span>
                    </div>
                </div>
                <div class="w-14 h-14 bg-green-100 rounded-full flex items-center justify-center">
                    <svg class="w-7 h-7 text-green-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 7h8m0 0v8m0-8l-8 8-4-4-6 6"/>
                    </svg>
                </div>
            </div>
        </div>

        <!-- Revenue Impact -->
        <div class="bg-white rounded-xl shadow-sm p-6 border border-gray-100 hover:shadow-md transition">
            <div class="flex items-center justify-between">
                <div>
                    <p class="text-sm font-medium text-gray-600">Revenue Impact</p>
                    <h3 class="text-3xl font-bold text-gray-800 mt-2">$45.2K</h3>
                    <div class="flex items-center mt-2">
                        <span class="text-green-600 text-sm font-medium">+18.7%</span>
                        <span class="text-gray-500 text-sm ml-2">vs last month</span>
                    </div>
                </div>
                <div class="w-14 h-14 bg-amber-100 rounded-full flex items-center justify-center">
                    <svg class="w-7 h-7 text-amber-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/>
                    </svg>
                </div>
            </div>
        </div>
    </div>

    <!-- Charts & Tables Row -->
    <div class="grid grid-cols-1 lg:grid-cols-3 gap-6 mb-6">
        <!-- Lead Sources Chart -->
        <div class="lg:col-span-2 bg-white rounded-xl shadow-sm p-6 border border-gray-100">
            <div class="flex items-center justify-between mb-6">
                <h2 class="text-lg font-bold text-gray-800">Lead Performance</h2>
                <div class="flex space-x-2">
                    <button @click="activeTab = 'overview'" :class="activeTab === 'overview' ? 'bg-indigo-100 text-indigo-600' : 'text-gray-600 hover:bg-gray-100'" class="px-4 py-2 rounded-lg text-sm font-medium transition">
                        Overview
                    </button>
                    <button @click="activeTab = 'weekly'" :class="activeTab === 'weekly' ? 'bg-indigo-100 text-indigo-600' : 'text-gray-600 hover:bg-gray-100'" class="px-4 py-2 rounded-lg text-sm font-medium transition">
                        Weekly
                    </button>
                </div>
            </div>
            
            <!-- Simple Chart Visualization -->
            <div class="space-y-4">
                <div>
                    <div class="flex items-center justify-between mb-2">
                        <span class="text-sm font-medium text-gray-700">Website</span>
                        <span class="text-sm font-semibold text-gray-800">45%</span>
                    </div>
                    <div class="w-full bg-gray-200 rounded-full h-3">
                        <div class="bg-indigo-600 h-3 rounded-full" style="width: 45%"></div>
                    </div>
                </div>
                <div>
                    <div class="flex items-center justify-between mb-2">
                        <span class="text-sm font-medium text-gray-700">Social Media</span>
                        <span class="text-sm font-semibold text-gray-800">28%</span>
                    </div>
                    <div class="w-full bg-gray-200 rounded-full h-3">
                        <div class="bg-purple-600 h-3 rounded-full" style="width: 28%"></div>
                    </div>
                </div>
                <div>
                    <div class="flex items-center justify-between mb-2">
                        <span class="text-sm font-medium text-gray-700">Email Campaign</span>
                        <span class="text-sm font-semibold text-gray-800">18%</span>
                    </div>
                    <div class="w-full bg-gray-200 rounded-full h-3">
                        <div class="bg-green-600 h-3 rounded-full" style="width: 18%"></div>
                    </div>
                </div>
                <div>
                    <div class="flex items-center justify-between mb-2">
                        <span class="text-sm font-medium text-gray-700">Referral</span>
                        <span class="text-sm font-semibold text-gray-800">9%</span>
                    </div>
                    <div class="w-full bg-gray-200 rounded-full h-3">
                        <div class="bg-amber-600 h-3 rounded-full" style="width: 9%"></div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Top Campaigns -->
        <div class="bg-white rounded-xl shadow-sm p-6 border border-gray-100">
            <h2 class="text-lg font-bold text-gray-800 mb-6">Top Campaigns</h2>
            <div class="space-y-4">
                <div class="flex items-center justify-between p-3 bg-gradient-to-r from-indigo-50 to-purple-50 rounded-lg">
                    <div>
                        <p class="text-sm font-semibold text-gray-800">Summer Sale 2024</p>
                        <p class="text-xs text-gray-600 mt-1">124 conversions</p>
                    </div>
                    <span class="text-xs font-bold text-indigo-600 bg-white px-3 py-1 rounded-full">Active</span>
                </div>
                <div class="flex items-center justify-between p-3 bg-gradient-to-r from-green-50 to-emerald-50 rounded-lg">
                    <div>
                        <p class="text-sm font-semibold text-gray-800">Product Launch</p>
                        <p class="text-xs text-gray-600 mt-1">98 conversions</p>
                    </div>
                    <span class="text-xs font-bold text-green-600 bg-white px-3 py-1 rounded-full">Active</span>
                </div>
                <div class="flex items-center justify-between p-3 bg-gradient-to-r from-amber-50 to-orange-50 rounded-lg">
                    <div>
                        <p class="text-sm font-semibold text-gray-800">Brand Awareness</p>
                        <p class="text-xs text-gray-600 mt-1">87 conversions</p>
                    </div>
                    <span class="text-xs font-bold text-amber-600 bg-white px-3 py-1 rounded-full">Active</span>
                </div>
                <div class="flex items-center justify-between p-3 bg-gray-50 rounded-lg">
                    <div>
                        <p class="text-sm font-semibold text-gray-800">Holiday Special</p>
                        <p class="text-xs text-gray-600 mt-1">156 conversions</p>
                    </div>
                    <span class="text-xs font-bold text-gray-500 bg-white px-3 py-1 rounded-full">Ended</span>
                </div>
            </div>
            <a href="/marketing/campaigns" class="block mt-4 text-center text-sm text-indigo-600 hover:text-indigo-700 font-medium">
                View All Campaigns →
            </a>
        </div>
    </div>

    <!-- Recent Leads & Quick Actions -->
    <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">
        <!-- Recent Leads -->
        <div class="lg:col-span-2 bg-white rounded-xl shadow-sm border border-gray-100">
            <div class="p-6 border-b border-gray-200">
                <div class="flex items-center justify-between">
                    <h2 class="text-lg font-bold text-gray-800">Recent Leads</h2>
                    <a href="/marketing/leads" class="text-sm text-indigo-600 hover:text-indigo-700 font-medium">View All</a>
                </div>
            </div>
            <div class="overflow-x-auto">
                <table class="w-full">
                    <thead class="bg-gray-50 border-b border-gray-200">
                        <tr>
                            <th class="px-6 py-3 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">Name</th>
                            <th class="px-6 py-3 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">Source</th>
                            <th class="px-6 py-3 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">Status</th>
                            <th class="px-6 py-3 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">Score</th>
                            <th class="px-6 py-3 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">Action</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-gray-200">
                        <tr class="hover:bg-gray-50 transition">
                            <td class="px-6 py-4">
                                <div class="flex items-center">
                                    <div class="w-10 h-10 bg-indigo-100 rounded-full flex items-center justify-center text-indigo-600 font-semibold">
                                        AS
                                    </div>
                                    <div class="ml-3">
                                        <p class="text-sm font-medium text-gray-800">Alex Smith</p>
                                        <p class="text-xs text-gray-500">alex@company.com</p>
                                    </div>
                                </div>
                            </td>
                            <td class="px-6 py-4">
                                <span class="px-3 py-1 text-xs font-medium bg-indigo-100 text-indigo-700 rounded-full">Website</span>
                            </td>
                            <td class="px-6 py-4">
                                <span class="px-3 py-1 text-xs font-medium bg-green-100 text-green-700 rounded-full">New</span>
                            </td>
                            <td class="px-6 py-4">
                                <div class="flex items-center">
                                    <div class="text-sm font-semibold text-gray-800">85</div>
                                    <div class="ml-2 text-xs text-gray-500">/100</div>
                                </div>
                            </td>
                            <td class="px-6 py-4">
                                <a href="/marketing/leads/1" class="text-indigo-600 hover:text-indigo-700 text-sm font-medium">View</a>
                            </td>
                        </tr>
                        <tr class="hover:bg-gray-50 transition">
                            <td class="px-6 py-4">
                                <div class="flex items-center">
                                    <div class="w-10 h-10 bg-purple-100 rounded-full flex items-center justify-center text-purple-600 font-semibold">
                                        MJ
                                    </div>
                                    <div class="ml-3">
                                        <p class="text-sm font-medium text-gray-800">Maria Johnson</p>
                                        <p class="text-xs text-gray-500">maria@startup.io</p>
                                    </div>
                                </div>
                            </td>
                            <td class="px-6 py-4">
                                <span class="px-3 py-1 text-xs font-medium bg-purple-100 text-purple-700 rounded-full">Social Media</span>
                            </td>
                            <td class="px-6 py-4">
                                <span class="px-3 py-1 text-xs font-medium bg-amber-100 text-amber-700 rounded-full">Contacted</span>
                            </td>
                            <td class="px-6 py-4">
                                <div class="flex items-center">
                                    <div class="text-sm font-semibold text-gray-800">92</div>
                                    <div class="ml-2 text-xs text-gray-500">/100</div>
                                </div>
                            </td>
                            <td class="px-6 py-4">
                                <a href="/marketing/leads/2" class="text-indigo-600 hover:text-indigo-700 text-sm font-medium">View</a>
                            </td>
                        </tr>
                        <tr class="hover:bg-gray-50 transition">
                            <td class="px-6 py-4">
                                <div class="flex items-center">
                                    <div class="w-10 h-10 bg-green-100 rounded-full flex items-center justify-center text-green-600 font-semibold">
                                        RB
                                    </div>
                                    <div class="ml-3">
                                        <p class="text-sm font-medium text-gray-800">Robert Brown</p>
                                        <p class="text-xs text-gray-500">robert@tech.com</p>
                                    </div>
                                </div>
                            </td>
                            <td class="px-6 py-4">
                                <span class="px-3 py-1 text-xs font-medium bg-green-100 text-green-700 rounded-full">Email</span>
                            </td>
                            <td class="px-6 py-4">
                                <span class="px-3 py-1 text-xs font-medium bg-blue-100 text-blue-700 rounded-full">Qualified</span>
                            </td>
                            <td class="px-6 py-4">
                                <div class="flex items-center">
                                    <div class="text-sm font-semibold text-gray-800">78</div>
                                    <div class="ml-2 text-xs text-gray-500">/100</div>
                                </div>
                            </td>
                            <td class="px-6 py-4">
                                <a href="/marketing/leads/3" class="text-indigo-600 hover:text-indigo-700 text-sm font-medium">View</a>
                            </td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>

        <!-- Quick Actions -->
        <div class="bg-white rounded-xl shadow-sm p-6 border border-gray-100">
            <h2 class="text-lg font-bold text-gray-800 mb-6">Quick Actions</h2>
            <div class="space-y-3">
                <a href="/marketing/campaigns/create" class="flex items-center p-4 bg-gradient-to-r from-indigo-500 to-purple-600 text-white rounded-lg hover:from-indigo-600 hover:to-purple-700 transition shadow-md">
                    <svg class="w-5 h-5 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"/>
                    </svg>
                    <span class="font-medium">Create Campaign</span>
                </a>
                <a href="/marketing/leads/import" class="flex items-center p-4 bg-white border-2 border-indigo-200 text-indigo-600 rounded-lg hover:bg-indigo-50 transition">
                    <svg class="w-5 h-5 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16v1a3 3 0 003 3h10a3 3 0 003-3v-1m-4-8l-4-4m0 0L8 8m4-4v12"/>
                    </svg>
                    <span class="font-medium">Import Leads</span>
                </a>
                <a href="/marketing/reports/generate" class="flex items-center p-4 bg-white border-2 border-gray-200 text-gray-700 rounded-lg hover:bg-gray-50 transition">
                    <svg class="w-5 h-5 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 17v-2m3 2v-4m3 4v-6m2 10H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"/>
                    </svg>
                    <span class="font-medium">Generate Report</span>
                </a>
                <a href="/marketing/analytics" class="flex items-center p-4 bg-white border-2 border-gray-200 text-gray-700 rounded-lg hover:bg-gray-50 transition">
                    <svg class="w-5 h-5 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 19v-6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2a2 2 0 002-2zm0 0V9a2 2 0 012-2h2a2 2 0 012 2v10m-6 0a2 2 0 002 2h2a2 2 0 002-2m0 0V5a2 2 0 012-2h2a2 2 0 012 2v14a2 2 0 01-2 2h-2a2 2 0 01-2-2z"/>
                    </svg>
                    <span class="font-medium">View Analytics</span>
                </a>
            </div>

            <!-- Upcoming Tasks -->
            <div class="mt-8">
                <h3 class="text-sm font-bold text-gray-800 mb-4">Upcoming Tasks</h3>
                <div class="space-y-3">
                    <div class="flex items-start p-3 bg-amber-50 border border-amber-200 rounded-lg">
                        <input type="checkbox" class="mt-1 mr-3 w-4 h-4 text-indigo-600 rounded">
                        <div class="flex-1">
                            <p class="text-sm font-medium text-gray-800">Follow up with high-score leads</p>
                            <p class="text-xs text-gray-600 mt-1">Due: Today, 3:00 PM</p>
                        </div>
                    </div>
                    <div class="flex items-start p-3 bg-blue-50 border border-blue-200 rounded-lg">
                        <input type="checkbox" class="mt-1 mr-3 w-4 h-4 text-indigo-600 rounded">
                        <div class="flex-1">
                            <p class="text-sm font-medium text-gray-800">Review campaign performance</p>
                            <p class="text-xs text-gray-600 mt-1">Due: Tomorrow, 10:00 AM</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection