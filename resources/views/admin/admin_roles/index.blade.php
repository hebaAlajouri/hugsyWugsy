@extends('layouts.admin')

@section('content')
<div class="min-h-screen bg-gradient-to-br from-pink-50 via-rose-50 to-purple-50 py-8">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <!-- Header Section -->
        <div class="text-center mb-8">
            <div class="inline-flex items-center justify-center w-16 h-16 bg-gradient-to-r from-purple-400 to-pink-400 rounded-full mb-4 shadow-lg">
                <svg class="w-8 h-8 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197m13.5-9a2.5 2.5 0 11-5 0 2.5 2.5 0 015 0z"></path>
                </svg>
            </div>
            <h1 class="text-3xl font-bold text-gray-800 mb-2">Manage Admin Roles</h1>
            <p class="text-purple-600 font-medium">Control access and permissions with elegance</p>
            <div class="w-24 h-1 bg-gradient-to-r from-purple-400 to-pink-400 mx-auto rounded-full mt-3"></div>
        </div>

        <!-- Success Message -->
        @if (session('success'))
            <div class="mb-8 bg-emerald-50 border-l-4 border-emerald-400 rounded-r-2xl p-6 shadow-sm animate-pulse">
                <div class="flex items-center">
                    <svg class="w-6 h-6 text-emerald-500 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                    </svg>
                    <p class="text-emerald-800 font-semibold">{{ session('success') }}</p>
                </div>
            </div>
        @endif

        <!-- Add New Role Button -->
        <div class="mb-8 flex justify-center">
            <a href="{{ route('admin.admin_roles.create') }}" 
               class="inline-flex items-center px-8 py-4 bg-gradient-to-r from-pink-500 to-rose-500 hover:from-pink-600 hover:to-rose-600 text-white font-semibold rounded-2xl transition-all duration-300 shadow-lg hover:shadow-xl transform hover:-translate-y-1">
                <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6"></path>
                </svg>
                Add New Admin Role
                <svg class="w-4 h-4 ml-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 7l5 5m0 0l-5 5m5-5H6"></path>
                </svg>
            </a>
        </div>

        <!-- Admin Roles Table Card -->
        <div class="bg-white rounded-3xl shadow-xl border border-pink-100 overflow-hidden">
            <!-- Table Header -->
            <div class="bg-gradient-to-r from-purple-400 via-pink-400 to-rose-400 p-6">
                <h2 class="text-white text-xl font-semibold flex items-center">
                    <svg class="w-6 h-6 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 11H5m14 0a2 2 0 012 2v6a2 2 0 01-2 2H5a2 2 0 01-2-2v-6a2 2 0 012-2m14 0V9a2 2 0 00-2-2M5 11V9a2 2 0 012-2m0 0V5a2 2 0 012-2h6a2 2 0 012 2v2M7 7h10"></path>
                    </svg>
                    Admin Roles Overview
                </h2>
            </div>

            <!-- Table Content -->
            <div class="overflow-x-auto">
                @if($adminRoles->count() > 0)
                    <table class="w-full">
                        <thead class="bg-gradient-to-r from-pink-50 to-purple-50">
                            <tr>
                                <th class="px-6 py-4 text-left">
                                    <div class="flex items-center text-gray-700 font-semibold">
                                        <div class="w-6 h-6 bg-pink-200 rounded-full flex items-center justify-center mr-2">
                                            <span class="text-xs text-pink-700">#</span>
                                        </div>
                                        ID
                                    </div>
                                </th>
                                <th class="px-6 py-4 text-left">
                                    <div class="flex items-center text-gray-700 font-semibold">
                                        <div class="w-6 h-6 bg-purple-200 rounded-full flex items-center justify-center mr-2">
                                            <svg class="w-3 h-3 text-purple-700" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"></path>
                                            </svg>
                                        </div>
                                        User
                                    </div>
                                </th>
                                <th class="px-6 py-4 text-left">
                                    <div class="flex items-center text-gray-700 font-semibold">
                                        <div class="w-6 h-6 bg-rose-200 rounded-full flex items-center justify-center mr-2">
                                            <svg class="w-3 h-3 text-rose-700" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04A12.02 12.02 0 003 9c0 5.591 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.042-.133-2.052-.382-3.016z"></path>
                                            </svg>
                                        </div>
                                        Role
                                    </div>
                                </th>
                                <th class="px-6 py-4 text-left">
                                    <div class="flex items-center text-gray-700 font-semibold">
                                        <div class="w-6 h-6 bg-gradient-to-r from-pink-200 to-purple-200 rounded-full flex items-center justify-center mr-2">
                                            <svg class="w-3 h-3 text-gray-700" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 5v.01M12 12v.01M12 19v.01M12 6a1 1 0 110-2 1 1 0 010 2zm0 7a1 1 0 110-2 1 1 0 010 2zm0 7a1 1 0 110-2 1 1 0 010 2z"></path>
                                            </svg>
                                        </div>
                                        Actions
                                    </div>
                                </th>
                            </tr>
                        </thead>
                        <tbody class="divide-y divide-pink-100">
                            @foreach ($adminRoles as $role)
                                <tr class="hover:bg-gradient-to-r hover:from-pink-25 hover:to-purple-25 transition-all duration-300">
                                    <td class="px-6 py-4">
                                        <div class="flex items-center">
                                            <div class="w-8 h-8 bg-gradient-to-r from-pink-100 to-rose-100 rounded-full flex items-center justify-center">
                                                <span class="text-sm font-semibold text-pink-700">{{ $role->id }}</span>
                                            </div>
                                        </div>
                                    </td>
                                    <td class="px-6 py-4">
                                        <div class="flex items-center">
                                            <div class="w-10 h-10 bg-gradient-to-r from-purple-400 to-pink-400 rounded-full flex items-center justify-center mr-3">
                                                <span class="text-white font-semibold text-sm">
                                                    {{ strtoupper(substr($role->user->name ?? 'D', 0, 1)) }}{{ strtoupper(substr($role->user->name ?? 'U', -1, 1)) }}
                                                </span>
                                            </div>
                                            <div>
                                                <p class="text-gray-900 font-semibold">{{ $role->user->name ?? 'Deleted User' }}</p>
                                                @if($role->user)
                                                    <p class="text-gray-500 text-sm">{{ $role->user->email ?? '' }}</p>
                                                @else
                                                    <p class="text-red-400 text-sm italic">User no longer exists</p>
                                                @endif
                                            </div>
                                        </div>
                                    </td>
                                    <td class="px-6 py-4">
                                        <span class="inline-flex items-center px-4 py-2 rounded-full text-sm font-medium
                                            {{ $role->role === 'admin' ? 'bg-purple-100 text-purple-800' : 
                                               ($role->role === 'super_admin' ? 'bg-pink-100 text-pink-800' : 
                                               'bg-rose-100 text-rose-800') }}">
                                            <svg class="w-3 h-3 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04A12.02 12.02 0 003 9c0 5.591 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.042-.133-2.052-.382-3.016z"></path>
                                            </svg>
                                            {{ ucfirst(str_replace('_', ' ', $role->role)) }}
                                        </span>
                                    </td>
                                    <td class="px-6 py-4">
                                        <div class="flex items-center space-x-3">
                                            <!-- Edit Button -->
                                            <a href="{{ route('admin.admin_roles.edit', $role->id) }}" 
                                               class="inline-flex items-center px-4 py-2 bg-gradient-to-r from-amber-400 to-orange-400 hover:from-amber-500 hover:to-orange-500 text-white text-sm font-medium rounded-xl transition-all duration-300 shadow-md hover:shadow-lg transform hover:-translate-y-0.5">
                                                <svg class="w-4 h-4 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"></path>
                                                </svg>
                                                Edit
                                            </a>
                                            
                                            <!-- Delete Button -->
                                            <form action="{{ route('admin.admin_roles.destroy', $role->id) }}" method="POST" class="inline-block">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" 
                                                        onclick="return confirm('Are you sure you want to delete this admin role? This action cannot be undone.')"
                                                        class="inline-flex items-center px-4 py-2 bg-gradient-to-r from-red-400 to-pink-400 hover:from-red-500 hover:to-pink-500 text-white text-sm font-medium rounded-xl transition-all duration-300 shadow-md hover:shadow-lg transform hover:-translate-y-0.5">
                                                    <svg class="w-4 h-4 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"></path>
                                                    </svg>
                                                    Delete
                                                </button>
                                            </form>
                                        </div>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                @else
                    <!-- Empty State -->
                    <div class="text-center py-16">
                        <div class="inline-flex items-center justify-center w-20 h-20 bg-gradient-to-r from-pink-100 to-purple-100 rounded-full mb-6">
                            <svg class="w-10 h-10 text-pink-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197m13.5-9a2.5 2.5 0 11-5 0 2.5 2.5 0 015 0z"></path>
                            </svg>
                        </div>
                        <h3 class="text-xl font-semibold text-gray-700 mb-2">No Admin Roles Found</h3>
                        <p class="text-gray-500 mb-6">Start by creating your first admin role to manage access permissions.</p>
                        <a href="{{ route('admin.admin_roles.create') }}" 
                           class="inline-flex items-center px-6 py-3 bg-gradient-to-r from-pink-500 to-rose-500 hover:from-pink-600 hover:to-rose-600 text-white font-medium rounded-xl transition-all duration-300 shadow-lg hover:shadow-xl">
                            <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6"></path>
                            </svg>
                            Add First Admin Role
                        </a>
                    </div>
                @endif
            </div>
        </div>

        <!-- Decorative Elements -->
        <div class="fixed top-10 left-10 w-20 h-20 bg-pink-200 rounded-full opacity-20 animate-pulse"></div>
        <div class="fixed top-32 right-20 w-16 h-16 bg-purple-200 rounded-full opacity-20 animate-bounce" style="animation-delay: 1s;"></div>
        <div class="fixed bottom-20 left-20 w-12 h-12 bg-rose-200 rounded-full opacity-20 animate-ping" style="animation-delay: 2s;"></div>
        
        <!-- Floating Crown Icons -->
        <div class="fixed top-1/4 right-1/4 opacity-10">
            <svg class="w-8 h-8 text-purple-400 animate-pulse" fill="currentColor" viewBox="0 0 24 24">
                <path d="M5 16L3 6l5.5 4 4.5-6 4.5 6L23 6l-2 10H5z"/>
            </svg>
        </div>
        <div class="fixed bottom-1/4 left-1/4 opacity-10">
            <svg class="w-6 h-6 text-pink-400 animate-pulse" fill="currentColor" viewBox="0 0 24 24" style="animation-delay: 1.5s;">
                <path d="M5 16L3 6l5.5 4 4.5-6 4.5 6L23 6l-2 10H5z"/>
            </svg>
        </div>
    </div>
</div>

<style>
    @keyframes float {
        0%, 100% { transform: translateY(0px); }
        50% { transform: translateY(-10px); }
    }
    
    .animate-float {
        animation: float 3s ease-in-out infinite;
    }
    
    /* Enhanced hover effects */
    .hover\:from-pink-25:hover {
        background: linear-gradient(to right, #fef7f7, #faf5ff);
    }
    
    /* Custom button hover effects */
    button:hover, a:hover {
        transition: all 0.3s ease;
    }
    
    /* Role badge animations */
    .role-badge {
        transition: all 0.3s ease;
    }
    
    .role-badge:hover {
        transform: scale(1.05);
    }
    
    /* Table row hover effect */
    tbody tr:hover {
        box-shadow: 0 4px 15px rgba(244, 114, 182, 0.1);
    }
</style>
@endsection