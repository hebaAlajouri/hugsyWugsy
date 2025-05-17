@extends('layouts.admin')

@section('header')
    User Details
@endsection

@section('content')
    <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
        <div class="p-6 bg-white border-b border-gray-200">
            <div class="flex justify-between mb-6">
                <h2 class="text-lg font-semibold">User Information</h2>
                <div>
                    <a href="{{ route('admin.users.edit', $user) }}" class="inline-flex items-center px-4 py-2 bg-indigo-600 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-indigo-700 active:bg-indigo-900 focus:outline-none focus:border-indigo-900 focus:ring ring-indigo-300 disabled:opacity-25 transition mr-2">
                        Edit User
                    </a>
                    <a href="{{ route('admin.users.index') }}" class="inline-flex items-center px-4 py-2 bg-gray-300 border border-transparent rounded-md font-semibold text-xs text-gray-700 uppercase tracking-widest hover:bg-gray-400 active:bg-gray-500 focus:outline-none focus:border-gray-500 focus:ring ring-gray-200 disabled:opacity-25 transition">
                        Back to List
                    </a>
                </div>
            </div>

            <div class="bg-gray-50 p-6 rounded-lg shadow-sm">
                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    <div>
                        <div class="mb-4">
                            <h3 class="text-sm font-medium text-gray-500">ID</h3>
                            <p class="mt-1 text-sm text-gray-900">{{ $user->id }}</p>
                        </div>
                        
                        <div class="mb-4">
                            <h3 class="text-sm font-medium text-gray-500">Name</h3>
                            <p class="mt-1 text-sm text-gray-900">{{ $user->name }}</p>
                        </div>
                        
                        <div class="mb-4">
                            <h3 class="text-sm font-medium text-gray-500">Email</h3>
                            <p class="mt-1 text-sm text-gray-900">{{ $user->email }}</p>
                        </div>
                    </div>
                    
                    <div>
                        <div class="mb-4">
                            <h3 class="text-sm font-medium text-gray-500">Role</h3>
                            <p class="mt-1 text-sm text-gray-900">
                                <span class="px-2 py-1 inline-flex text-xs leading-5 font-semibold rounded-full {{ $user->role === 'admin' ? 'bg-green-100 text-green-800' : 'bg-blue-100 text-blue-800' }}">
                                    {{ ucfirst($user->role) }}
                                </span>
                            </p>
                        </div>
                        
                        <div class="mb-4">
                            <h3 class="text-sm font-medium text-gray-500">Email Verified</h3>
                            <p class="mt-1 text-sm text-gray-900">
                                @if ($user->email_verified_at)
                                    <span class="px-2 py-1 inline-flex text-xs leading-5 font-semibold rounded-full bg-green-100 text-green-800">
                                        Yes - {{ $user->email_verified_at->format('M d, Y H:i') }}
                                    </span>
                                @else
                                    <span class="px-2 py-1 inline-flex text-xs leading-5 font-semibold rounded-full bg-red-100 text-red-800">
                                        Not Verified
                                    </span>
                                @endif
                            </p>
                        </div>
                        
                        <div class="mb-4">
                            <h3 class="text-sm font-medium text-gray-500">Created At</h3>
                            <p class="mt-1 text-sm text-gray-900">{{ $user->created_at->format('M d, Y H:i') }}</p>
                        </div>
                        
                        <div class="mb-4">
                            <h3 class="text-sm font-medium text-gray-500">Updated At</h3>
                            <p class="mt-1 text-sm text-gray-900">{{ $user->updated_at->format('M d, Y H:i') }}</p>
                        </div>
                    </div>
                </div>
            </div>
            
            @if(auth()->id() !== $user->id)
                <div class="mt-6">
                    <form action="{{ route('admin.users.destroy', $user) }}" method="POST" onsubmit="return confirm('Are you sure you want to delete this user? This action cannot be undone.');">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="inline-flex items-center px-4 py-2 bg-red-600 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-red-700 active:bg-red-900 focus:outline-none focus:border-red-900 focus:ring ring-red-300 disabled:opacity-25 transition">
                            Delete User
                        </button>
                    </form>
                </div>
            @endif
        </div>
    </div>
@endsection