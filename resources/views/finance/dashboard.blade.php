@extends('layouts.finance')

@section('title', 'Finance Dashboard')

@section('content')
<div x-data="{ activeView: 'overview' }">
    <!-- Page Header -->
    <div class="flex items-center justify-between mb-6">
        <div>
            <h1 class="text-3xl font-bold text-gray-800">Financial Overview</h1>
            <p class="text-gray-600 mt-1">Track your financial performance and cash flow</p>
        </div>
        <div class="flex space-x-3">
            <a href="/finance/reports/download" class="flex items-center px-4 py-2 bg-white border border-gray-300 text-gray-700 rounded-lg hover:bg-gray-50 transition">
                <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16v1a3 3 0 003 3h10a3 3 0 003-3v-1m-4-4l-4 4m0 0l-4-4m4 4V4"/>
                </svg>
                Download Report
            </a>
            <a href="/finance/transactions/new" class="flex items-center px-4 py-2 bg-gradient-to-r from-blue-600 to-blue-800 text-white rounded-lg hover:from-blue-700 hover:to-blue-900 transition shadow-md">
                <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"/>
                </svg>
                New Transaction
            </a>
        </div>
    </div>

    <!-- Key Financial Metrics -->
    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6 mb-6">
        <!-- Total Revenue -->
        <div class="bg-white rounded-xl shadow-sm p-6 border border-gray-100 hover:shadow-md transition">
            <div class="flex items-center justify-between">
                <div>
                    <p class="text-sm font-medium text-gray-600">Total Revenue</p>
                    <h3 class="text-3xl font-bold text-gray-800 mt-2">$485.2K</h3>
                    <div class="flex items-center mt-2">
                        <span class="text-green-600 text-sm font-medium">+15.3%</span>
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

        <!-- Total Expenses -->
        <div class="bg-white rounded-xl shadow-sm p-6 border border-gray-100 hover:shadow-md transition">
            <div class="flex items-center justify-between">
                <div>
                    <p class="text-sm font-medium text-gray-600">Total Expenses</p>
                    <h3 class="text-3xl font-bold text-gray-800 mt-2">$312.8K</h3>
                    <div class="flex items-center mt-2">
                        <span class="text-red-600 text-sm font-medium">+8.1%</span>
                        <span class="text-gray-500 text-sm ml-2">vs last month</span>
                    </div>
                </div>
                <div class="w-14 h-14 bg-red-100 rounded-full flex items-center justify-center">
                    <svg class="w-7 h-7 text-red-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 17h8m0 0V9m0 8l-8-8-4 4-6-6"/>
                    </svg>
                </div>
            </div>
        </div>

        <!-- Net Profit -->
        <div class="bg-white rounded-xl shadow-sm p-6 border border-gray-100 hover:shadow-md transition">
            <div class="flex items-center justify-between">
                <div>
                    <p class="text-sm font-medium text-gray-600">Net Profit</p>
                    <h3 class="text-3xl font-bold text-gray-800 mt-2">$172.4K</h3>
                    <div class="flex items-center mt-2">
                        <span class="text-green-600 text-sm font-medium">+24.7%</span>
                        <span class="text-gray-500 text-sm ml-2">vs last month</span>
                    </div>
                </div>
                <div class="w-14 h-14 bg-blue-100 rounded-full flex items-center justify-center">
                    <svg class="w-7 h-7 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/>
                    </svg>
                </div>
            </div>
        </div>

        <!-- Cash Balance -->
        <div class="bg-white rounded-xl shadow-sm p-6 border border-gray-100 hover:shadow-md transition">
            <div class="flex items-center justify-between">
                <div>
                    <p class="text-sm font-medium text-gray-600">Cash Balance</p>
                    <h3 class="text-3xl font-bold text-gray-800 mt-2">$856.9K</h3>
                    <div class="flex items-center mt-2">
                        <span class="text-blue-600 text-sm font-medium">Available</span>
                        <span class="text-gray-500 text-sm ml-2">across accounts</span>
                    </div>
                </div>
                <div class="w-14 h-14 bg-purple-100 rounded-full flex items-center justify-center">
                    <svg class="w-7 h-7 text-purple-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 9V7a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2m2 4h10a2 2 0 002-2v-6a2 2 0 00-2-2H9a2 2 0 00-2 2v6a2 2 0 002 2zm7-5a2 2 0 11-4 0 2 2 0 014 0z"/>
                    </svg>
                </div>
            </div>
        </div>
    </div>

    <!-- Charts & Analytics -->
    <div class="grid grid-cols-1 lg:grid-cols-3 gap-6 mb-6">
        <!-- Revenue vs Expenses -->
        <div class="lg:col-span-2 bg-white rounded-xl shadow-sm p-6 border border-gray-100">
            <div class="flex items-center justify-between mb-6">
                <h2 class="text-lg font-bold text-gray-800">Revenue vs Expenses</h2>
                <div class="flex space-x-2">
                    <button @click="activeView = 'overview'" :class="activeView === 'overview' ? 'bg-blue-100 text-blue-600' : 'text-gray-600 hover:bg-gray-100'" class="px-4 py-2 rounded-lg text-sm font-medium transition">
                        Monthly
                    </button>
                    <button @click="activeView = 'quarterly'" :class="activeView === 'quarterly' ? 'bg-blue-100 text-blue-600' : 'text-gray-600 hover:bg-gray-100'" class="px-4 py-2 rounded-lg text-sm font-medium transition">
                        Quarterly
                    </button>
                </div>
            </div>
            
            <!-- Simplified Chart -->
            <div class="space-y-6">
                <div class="flex items-end justify-between h-48 border-b border-gray-200 pb-2">
                    <div class="flex flex-col items-center flex-1">
                        <div class="w-full flex items-end justify-center space-x-1 h-40">
                            <div class="w-8 bg-green-500 rounded-t" style="height: 75%"></div>
                            <div class="w-8 bg-red-400 rounded-t" style="height: 55%"></div>
                        </div>
                        <span class="text-xs text-gray-600 mt-2">Jul</span>
                    </div>
                    <div class="flex flex-col items-center flex-1">
                        <div class="w-full flex items-end justify-center space-x-1 h-40">
                            <div class="w-8 bg-green-500 rounded-t" style="height: 82%"></div>
                            <div class="w-8 bg-red-400 rounded-t" style="height: 58%"></div>
                        </div>
                        <span class="text-xs text-gray-600 mt-2">Aug</span>
                    </div>
                    <div class="flex flex-col items-center flex-1">
                        <div class="w-full flex items-end justify-center space-x-1 h-40">
                            <div class="w-8 bg-green-500 rounded-t" style="height: 68%"></div>
                            <div class="w-8 bg-red-400 rounded-t" style="height: 62%"></div>
                        </div>
                        <span class="text-xs text-gray-600 mt-2">Sep</span>
                    </div>
                    <div class="flex flex-col items-center flex-1">
                        <div class="w-full flex items-end justify-center space-x-1 h-40">
                            <div class="w-8 bg-green-500 rounded-t" style="height: 88%"></div>
                            <div class="w-8 bg-red-400 rounded-t" style="height: 65%"></div>
                        </div>
                        <span class="text-xs text-gray-600 mt-2">Oct</span>
                    </div>
                    <div class="flex flex-col items-center flex-1">
                        <div class="w-full flex items-end justify-center space-x-1 h-40">
                            <div class="w-8 bg-green-500 rounded-t" style="height: 92%"></div>
                            <div class="w-8 bg-red-400 rounded-t" style="height: 70%"></div>
                        </div>
                        <span class="text-xs text-gray-600 mt-2">Nov</span>
                    </div>
                    <div class="flex flex-col items-center flex-1">
                        <div class="w-full flex items-end justify-center space-x-1 h-40">
                            <div class="w-8 bg-green-500 rounded-t" style="height: 95%"></div>
                            <div class="w-8 bg-red-400 rounded-t" style="height: 68%"></div>
                        </div>
                        <span class="text-xs text-gray-600 mt-2 font-semibold">Dec</span>
                    </div>
                </div>
                
                <div class="flex items-center justify-center space-x-6">
                    <div class="flex items-center">
                        <div class="w-4 h-4 bg-green-500 rounded mr-2"></div>
                        <span class="text-sm text-gray-700">Revenue</span>
                    </div>
                    <div class="flex items-center">
                        <div class="w-4 h-4 bg-red-400 rounded mr-2"></div>
                        <span class="text-sm text-gray-700">Expenses</span>
                    </div>
                </div>
            </div>
        </div>

        <!-- Expense Breakdown -->
        <div class="bg-white rounded-xl shadow-sm p-6 border border-gray-100">
            <h2 class="text-lg font-bold text-gray-800 mb-6">Expense Breakdown</h2>
            
            <div class="space-y-4">
                <div>
                    <div class="flex items-center justify-between mb-2">
                        <span class="text-sm font-medium text-gray-700">Payroll</span>
                        <span class="text-sm font-semibold text-gray-800">$145K</span>
                    </div>
                    <div class="flex items-center">
                        <div class="w-full bg-gray-200 rounded-full h-2.5 flex-1">
                            <div class="bg-blue-600 h-2.5 rounded-full" style="width: 46%"></div>
                        </div>
                        <span class="text-xs text-gray-600 ml-2 w-10 text-right">46%</span>
                    </div>
                </div>

                <div>
                    <div class="flex items-center justify-between mb-2">
                        <span class="text-sm font-medium text-gray-700">Operations</span>
                        <span class="text-sm font-semibold text-gray-800">$89K</span>
                    </div>
                    <div class="flex items-center">
                        <div class="w-full bg-gray-200 rounded-full h-2.5 flex-1">
                            <div class="bg-purple-600 h-2.5 rounded-full" style="width: 28%"></div>
                        </div>
                        <span class="text-xs text-gray-600 ml-2 w-10 text-right">28%</span>
                    </div>
                </div>

                <div>
                    <div class="flex items-center justify-between mb-2">
                        <span class="text-sm font-medium text-gray-700">Marketing</span>
                        <span class="text-sm font-semibold text-gray-800">$48K</span>
                    </div>
                    <div class="flex items-center">
                        <div class="w-full bg-gray-200 rounded-full h-2.5 flex-1">
                            <div class="bg-indigo-600 h-2.5 rounded-full" style="width: 15%"></div>
                        </div>
                        <span class="text-xs text-gray-600 ml-2 w-10 text-right">15%</span>
                    </div>
                </div>

                <div>
                    <div class="flex items-center justify-between mb-2">
                        <span class="text-sm font-medium text-gray-700">Technology</span>
                        <span class="text-sm font-semibold text-gray-800">$31K</span>
                    </div>
                    <div class="flex items-center">
                        <div class="w-full bg-gray-200 rounded-full h-2.5 flex-1">
                            <div class="bg-cyan-600 h-2.5 rounded-full" style="width: 11%"></div>
                        </div>
                        <span class="text-xs text-gray-600 ml-2 w-10 text-right">11%</span>
                    </div>
                </div>
            </div>

            <div class="mt-6 pt-6 border-t border-gray-200">
                <div class="text-center">
                    <p class="text-sm text-gray-600">Total Monthly Expenses</p>
                    <p class="text-2xl font-bold text-gray-800 mt-1">$312.8K</p>
                </div>
            </div>
        </div>
    </div>

    <!-- Recent Transactions & Outstanding Invoices -->
    <div class="grid grid-cols-1 lg:grid-cols-2 gap-6 mb-6">
        <!-- Recent Transactions -->
        <div class="bg-white rounded-xl shadow-sm border border-gray-100">
            <div class="p-6 border-b border-gray-200">
                <div class="flex items-center justify-between">
                    <h2 class="text-lg font-bold text-gray-800">Recent Transactions</h2>
                    <a href="/finance/transactions" class="text-sm text-blue-600 hover:text-blue-700 font-medium">View All</a>
                </div>
            </div>
            <div class="divide-y divide-gray-200">
                <div class="p-4 hover:bg-gray-50 transition">
                    <div class="flex items-center justify-between">
                        <div class="flex items-center">
                            <div class="w-10 h-10 bg-green-100 rounded-lg flex items-center justify-center">
                                <svg class="w-5 h-5 text-green-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"/>
                                </svg>
                            </div>
                            <div class="ml-3">
                                <p class="text-sm font-semibold text-gray-800">Payment Received</p>
                                <p class="text-xs text-gray-500 mt-1">Tech Corp - INV-2025-345</p>
                            </div>
                        </div>
                        <div class="text-right">
                            <p class="text-sm font-bold text-green-600">+$12,500</p>
                            <p class="text-xs text-gray-500 mt-1">2h ago</p>
                        </div>
                    </div>
                </div>

                <div class="p-4 hover:bg-gray-50 transition">
                    <div class="flex items-center justify-between">
                        <div class="flex items-center">
                            <div class="w-10 h-10 bg-red-100 rounded-lg flex items-center justify-center">
                                <svg class="w-5 h-5 text-red-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20 12H4"/>
                                </svg>
                            </div>
                            <div class="ml-3">
                                <p class="text-sm font-semibold text-gray-800">Office Rent Payment</p>
                                <p class="text-xs text-gray-500 mt-1">Monthly rent - December</p>
                            </div>
                        </div>
                        <div class="text-right">
                            <p class="text-sm font-bold text-red-600">-$8,500</p>
                            <p class="text-xs text-gray-500 mt-1">5h ago</p>
                        </div>
                    </div>
                </div>

                <div class="p-4 hover:bg-gray-50 transition">
                    <div class="flex items-center justify-between">
                        <div class="flex items-center">
                            <div class="w-10 h-10 bg-green-100 rounded-lg flex items-center justify-center">
                                <svg class="w-5 h-5 text-green-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"/>
                                </svg>
                            </div>
                            <div class="ml-3">
                                <p class="text-sm font-semibold text-gray-800">Client Payment</p>
                                <p class="text-xs text-gray-500 mt-1">Startup Inc - INV-2025-342</p>
                            </div>
                        </div>
                        <div class="text-right">
                            <p class="text-sm font-bold text-green-600">+$8,200</p>
                            <p class="text-xs text-gray-500 mt-1">1d ago</p>
                        </div>
                    </div>
                </div>

                <div class="p-4 hover:bg-gray-50 transition">
                    <div class="flex items-center justify-between">
                        <div class="flex items-center">
                            <div class="w-10 h-10 bg-red-100 rounded-lg flex items-center justify-center">
                                <svg class="w-5 h-5 text-red-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20 12H4"/>
                                </svg>
                            </div>
                            <div class="ml-3">
                                <p class="text-sm font-semibold text-gray-800">Software Subscription</p>
                                <p class="text-xs text-gray-500 mt-1">Cloud Services - Monthly</p>
                            </div>
                        </div>
                        <div class="text-right">
                            <p class="text-sm font-bold text-red-600">-$2,450</p>
                            <p class="text-xs text-gray-500 mt-1">1d ago</p>
                        </div>
                    </div>
                </div>

                <div class="p-4 hover:bg-gray-50 transition">
                    <div class="flex items-center justify-between">
                        <div class="flex items-center">
                            <div class="w-10 h-10 bg-red-100 rounded-lg flex items-center justify-center">
                                <svg class="w-5 h-5 text-red-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20 12H4"/>
                                </svg>
                            </div>
                            <div class="ml-3">
                                <p class="text-sm font-semibold text-gray-800">Marketing Expenses</p>
                                <p class="text-xs text-gray-500 mt-1">Ad Campaign - Social Media</p>
                            </div>
                        </div>
                        <div class="text-right">
                            <p class="text-sm font-bold text-red-600">-$5,800</p>
                            <p class="text-xs text-gray-500 mt-1">2d ago</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Outstanding Invoices -->
        <div class="bg-white rounded-xl shadow-sm border border-gray-100">
            <div class="p-6 border-b border-gray-200">
                <div class="flex items-center justify-between">
                    <h2 class="text-lg font-bold text-gray-800">Outstanding Invoices</h2>
                    <span class="px-3 py-1 bg-amber-100 text-amber-700 text-xs font-bold rounded-full">8 Pending</span>
                </div>
            </div>
            <div class="divide-y divide-gray-200">
                <a href="/finance/invoices/1" class="block p-4 hover:bg-red-50 transition border-l-4 border-red-500">
                    <div class="flex items-center justify-between mb-2">
                        <div>
                            <p class="text-sm font-semibold text-gray-800">INV-2025-345</p>
                            <p class="text-xs text-gray-500 mt-1">Global Solutions Ltd</p>
                        </div>
                        <span class="px-2 py-1 bg-red-100 text-red-700 text-xs font-medium rounded">Overdue</span>
                    </div>
                    <div class="flex items-center justify-between">
                        <span class="text-lg font-bold text-gray-800">$5,200</span>
                        <span class="text-xs text-red-600 font-medium">2 days overdue</span>
                    </div>
                </a>

                <a href="/finance/invoices/2" class="block p-4 hover:bg-amber-50 transition border-l-4 border-amber-500">
                    <div class="flex items-center justify-between mb-2">
                        <div>
                            <p class="text-sm font-semibold text-gray-800">INV-2025-348</p>
                            <p class="text-xs text-gray-500 mt-1">Digital Media Co</p>
                        </div>
                        <span class="px-2 py-1 bg-amber-100 text-amber-700 text-xs font-medium rounded">Due Soon</span>
                    </div>
                    <div class="flex items-center justify-between">
                        <span class="text-lg font-bold text-gray-800">$3,800</span>
                        <span class="text-xs text-amber-600 font-medium">Due in 3 days</span>
                    </div>
                </a>

                <a href="/finance/invoices/3" class="block p-4 hover:bg-blue-50 transition border-l-4 border-blue-500">
                    <div class="flex items-center justify-between mb-2">
                        <div>
                            <p class="text-sm font-semibold text-gray-800">INV-2025-350</p>
                            <p class="text-xs text-gray-500 mt-1">Innovation Labs</p>
                        </div>
                        <span class="px-2 py-1 bg-blue-100 text-blue-700 text-xs font-medium rounded">Pending</span>
                    </div>
                    <div class="flex items-center justify-between">
                        <span class="text-lg font-bold text-gray-800">$12,500</span>
                        <span class="text-xs text-blue-600 font-medium">Due in 15 days</span>
                    </div>
                </a>

                <a href="/finance/invoices/4" class="block p-4 hover:bg-blue-50 transition border-l-4 border-blue-500">
                    <div class="flex items-center justify-between mb-2">
                        <div>
                            <p class="text-sm font-semibold text-gray-800">INV-2025-351</p>
                            <p class="text-xs text-gray-500 mt-1">Enterprise Systems</p>
                        </div>
                        <span class="px-2 py-1 bg-blue-100 text-blue-700 text-xs font-medium rounded">Pending</span>
                    </div>
                    <div class="flex items-center justify-between">
                        <span class="text-lg font-bold text-gray-800">$8,950</span>
                        <span class="text-xs text-blue-600 font-medium">Due in 20 days</span>
                    </div>
                </a>

                <a href="/finance/invoices/5" class="block p-4 hover:bg-blue-50 transition border-l-4 border-blue-500">
                    <div class="flex items-center justify-between mb-2">
                        <div>
                            <p class="text-sm font-semibold text-gray-800">INV-2025-352</p>
                            <p class="text-xs text-gray-500 mt-1">Tech Innovations Inc</p>
                        </div>
                        <span class="px-2 py-1 bg-blue-100 text-blue-700 text-xs font-medium rounded">Pending</span>
                    </div>
                    <div class="flex items-center justify-between">
                        <span class="text-lg font-bold text-gray-800">$6,400</span>
                        <span class="text-xs text-blue-600 font-medium">Due in 25 days</span>
                    </div>
                </a>
            </div>
        </div>
    </div>

    <!-- Account Summary & Quick Actions -->
    <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">
        <!-- Bank Accounts Summary -->
        <div class="lg:col-span-2 bg-white rounded-xl shadow-sm p-6 border border-gray-100">
            <h2 class="text-lg font-bold text-gray-800 mb-6">Bank Accounts</h2>
            <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                <div class="p-5 bg-gradient-to-br from-blue-500 to-blue-700 rounded-lg text-white shadow-md">
                    <div class="flex items-center justify-between mb-3">
                        <span class="text-sm font-medium opacity-90">Primary Account</span>
                        <svg class="w-8 h-8 opacity-80" fill="currentColor" viewBox="0 0 24 24">
                            <path d="M4 4h16a2 2 0 012 2v12a2 2 0 01-2 2H4a2 2 0 01-2-2V6a2 2 0 012-2zm0 2v3h16V6H4zm0 5v7h16v-7H4z"/>
                        </svg>
                    </div>
                    <p class="text-2xl font-bold mb-1">$645,800</p>
                    <p class="text-xs opacity-75">**** **** **** 4589</p>
                </div>

                <div class="p-5 bg-gradient-to-br from-purple-500 to-purple-700 rounded-lg text-white shadow-md">
                    <div class="flex items-center justify-between mb-3">
                        <span class="text-sm font-medium opacity-90">Savings Account</span>
                        <svg class="w-8 h-8 opacity-80" fill="currentColor" viewBox="0 0 24 24">
                            <path d="M4 4h16a2 2 0 012 2v12a2 2 0 01-2 2H4a2 2 0 01-2-2V6a2 2 0 012-2zm0 2v3h16V6H4zm0 5v7h16v-7H4z"/>
                        </svg>
                    </div>
                    <p class="text-2xl font-bold mb-1">$211,100</p>
                    <p class="text-xs opacity-75">**** **** **** 7823</p>
                </div>

                <div class="p-5 border-2 border-dashed border-gray-300 rounded-lg hover:border-blue-400 hover:bg-blue-50 transition cursor-pointer">
                    <a href="/finance/accounts/add" class="flex flex-col items-center justify-center h-full text-gray-500 hover:text-blue-600">
                        <svg class="w-10 h-10 mb-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"/>
                        </svg>
                        <span class="text-sm font-medium">Add Account</span>
                    </a>
                </div>

                <div class="p-5 bg-gradient-to-br from-gray-700 to-gray-900 rounded-lg text-white shadow-md">
                    <div class="flex items-center justify-between mb-3">
                        <span class="text-sm font-medium opacity-90">Petty Cash</span>
                        <svg class="w-8 h-8 opacity-80" fill="currentColor" viewBox="0 0 24 24">
                            <path d="M12 2C6.48 2 2 6.48 2 12s4.48 10 10 10 10-4.48 10-10S17.52 2 12 2zm0 18c-4.41 0-8-3.59-8-8s3.59-8 8-8 8 3.59 8 8-3.59 8-8 8zm.31-8.86c-1.77-.45-2.34-.94-2.34-1.67 0-.84.79-1.43 2.1-1.43 1.38 0 1.9.66 1.94 1.64h1.71c-.05-1.34-.87-2.57-2.49-2.97V5H10.9v1.69c-1.51.32-2.72 1.3-2.72 2.81 0 1.79 1.49 2.69 3.66 3.21 1.95.46 2.34 1.15 2.34 1.87 0 .53-.39 1.39-2.1 1.39-1.6 0-2.23-.72-2.32-1.64H8.04c.1 1.7 1.36 2.66 2.86 2.97V19h2.34v-1.67c1.52-.29 2.72-1.16 2.73-2.77-.01-2.2-1.9-2.96-3.66-3.42z"/>
                        </svg>
                    </div>
                    <p class="text-2xl font-bold mb-1">$5,000</p>
                    <p class="text-xs opacity-75">Office expenses</p>
                </div>
            </div>
        </div>

        <!-- Quick Financial Actions -->
        <div class="bg-white rounded-xl shadow-sm p-6 border border-gray-100">
            <h2 class="text-lg font-bold text-gray-800 mb-6">Quick Actions</h2>
            <div class="space-y-3">
                <a href="/finance/invoices/create" class="flex items-center p-4 bg-gradient-to-r from-blue-600 to-blue-800 text-white rounded-lg hover:from-blue-700 hover:to-blue-900 transition shadow-md">
                    <svg class="w-5 h-5 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"/>
                    </svg>
                    <span class="font-medium">Create Invoice</span>
                </a>

                <a href="/finance/expenses/record" class="flex items-center p-4 bg-white border-2 border-blue-200 text-blue-600 rounded-lg hover:bg-blue-50 transition">
                    <svg class="w-5 h-5 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 9V7a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2m2 4h10a2 2 0 002-2v-6a2 2 0 00-2-2H9a2 2 0 00-2 2v6a2 2 0 002 2zm7-5a2 2 0 11-4 0 2 2 0 014 0z"/>
                    </svg>
                    <span class="font-medium">Record Expense</span>
                </a>

                <a href="/finance/reports/profit-loss" class="flex items-center p-4 bg-white border-2 border-gray-200 text-gray-700 rounded-lg hover:bg-gray-50 transition">
                    <svg class="w-5 h-5 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 17v-2m3 2v-4m3 4v-6m2 10H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"/>
                    </svg>
                    <span class="font-medium">P&L Statement</span>
                </a>

                <a href="/finance/reconciliation" class="flex items-center p-4 bg-white border-2 border-gray-200 text-gray-700 rounded-lg hover:bg-gray-50 transition">
                    <svg class="w-5 h-5 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2m-6 9l2 2 4-4"/>
                    </svg>
                    <span class="font-medium">Reconciliation</span>
                </a>
            </div>

            <!-- Financial Alerts -->
            <div class="mt-6">
                <h3 class="text-sm font-bold text-gray-800 mb-4">Financial Alerts</h3>
                <div class="space-y-3">
                    <div class="p-3 bg-red-50 border border-red-200 rounded-lg">
                        <div class="flex items-start">
                            <svg class="w-5 h-5 text-red-600 mr-2 flex-shrink-0 mt-0.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4m0 4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/>
                            </svg>
                            <div>
                                <p class="text-sm font-medium text-gray-800">1 Overdue Invoice</p>
                                <p class="text-xs text-gray-600 mt-1">Requires immediate attention</p>
                            </div>
                        </div>
                    </div>

                    <div class="p-3 bg-amber-50 border border-amber-200 rounded-lg">
                        <div class="flex items-start">
                            <svg class="w-5 h-5 text-amber-600 mr-2 flex-shrink-0 mt-0.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"/>
                            </svg>
                            <div>
                                <p class="text-sm font-medium text-gray-800">Budget Review Due</p>
                                <p class="text-xs text-gray-600 mt-1">Q1 2026 planning pending</p>
                            </div>
                        </div>
                    </div>

                    <div class="p-3 bg-blue-50 border border-blue-200 rounded-lg">
                        <div class="flex items-start">
                            <svg class="w-5 h-5 text-blue-600 mr-2 flex-shrink-0 mt-0.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/>
                            </svg>
                            <div>
                                <p class="text-sm font-medium text-gray-800">Tax Filing Reminder</p>
                                <p class="text-xs text-gray-600 mt-1">Due in 15 days</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection