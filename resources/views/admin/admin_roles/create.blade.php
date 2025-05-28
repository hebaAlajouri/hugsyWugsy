@extends('layouts.admin')

@section('content')
<div class="min-h-screen bg-gradient-to-br from-pink-50 via-purple-50 to-rose-50 py-8">
    <div class="max-w-2xl mx-auto px-4">
        <!-- Header Section -->
        <div class="text-center mb-8">
            <div class="inline-flex items-center justify-center w-16 h-16 bg-gradient-to-r from-rose-400 to-pink-500 rounded-full mb-4 shadow-lg float-animation">
                <svg class="w-8 h-8 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6"></path>
                </svg>
            </div>
            <h2 class="text-3xl font-bold bg-gradient-to-r from-rose-600 to-pink-600 bg-clip-text text-transparent mb-2">
                Add Admin Role
            </h2>
            <p class="text-gray-600 text-sm">Create new administrative permissions with style</p>
        </div>

        <!-- Main Form Card -->
        <div class="bg-white/80 backdrop-blur-sm rounded-3xl shadow-xl border border-rose-100 overflow-hidden">
            <!-- Decorative Header -->
            <div class="h-2 bg-gradient-to-r from-rose-300 via-pink-300 to-purple-300"></div>
            
            <form action="{{ route('admin.admin_roles.store') }}" method="POST" class="p-8">
                @csrf
                
                <!-- User Selection -->
                <div class="mb-8">
                    <label for="user_id" class="block text-sm font-semibold text-gray-700 mb-3">
                        <span class="flex items-center">
                            <svg class="w-5 h-5 text-rose-500 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"></path>
                            </svg>
                            Select User
                        </span>
                    </label>
                    <div class="relative">
                        <select name="user_id" id="user_id" 
                                class="w-full px-4 py-4 bg-gradient-to-r from-rose-50 to-pink-50 border-2 border-rose-200 rounded-2xl focus:outline-none focus:ring-4 focus:ring-rose-200 focus:border-rose-400 transition-all duration-300 appearance-none text-gray-700 font-medium" 
                                required>
                            <option value="" disabled selected class="text-gray-400">Choose a user...</option>
                            @foreach ($users as $user)
                                <option value="{{ $user->id }}">{{ $user->name }}</option>
                            @endforeach
                        </select>
                        <div class="absolute inset-y-0 right-0 flex items-center px-4 pointer-events-none">
                            <svg class="w-5 h-5 text-rose-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"></path>
                            </svg>
                        </div>
                    </div>
                </div>

                <!-- Role Input -->
                <div class="mb-10">
                    <label for="role" class="block text-sm font-semibold text-gray-700 mb-3">
                        <span class="flex items-center">
                            <svg class="w-5 h-5 text-pink-500 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04A12.02 12.02 0 003 9c0 5.591 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.042-.133-2.052-.382-3.016z"></path>
                            </svg>
                            Role Name
                        </span>
                    </label>
                    <div class="relative">
                        <input type="text" 
                               name="role" 
                               id="role"
                               placeholder="Enter role name (e.g., admin, moderator, editor)"
                               class="w-full px-4 py-4 bg-gradient-to-r from-pink-50 to-purple-50 border-2 border-pink-200 rounded-2xl focus:outline-none focus:ring-4 focus:ring-pink-200 focus:border-pink-400 transition-all duration-300 text-gray-700 font-medium placeholder-gray-400" 
                               required>
                        <div class="absolute inset-y-0 right-0 flex items-center px-4 pointer-events-none">
                            <svg class="w-5 h-5 text-pink-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15.232 5.232l3.536 3.536m-2.036-5.036a2.5 2.5 0 113.536 3.536L6.5 21.036H3v-3.572L16.732 3.732z"></path>
                            </svg>
                        </div>
                    </div>
                    <!-- Role Suggestions -->
                    <div class="mt-3 flex flex-wrap gap-2">
                        <span class="text-xs text-gray-500 mr-2">Quick suggestions:</span>
                        <button type="button" onclick="fillRole('admin')" class="px-3 py-1 bg-rose-100 text-rose-600 rounded-full text-xs hover:bg-rose-200 transition-colors duration-200">Admin</button>
                        <button type="button" onclick="fillRole('moderator')" class="px-3 py-1 bg-pink-100 text-pink-600 rounded-full text-xs hover:bg-pink-200 transition-colors duration-200">Moderator</button>
                        <button type="button" onclick="fillRole('editor')" class="px-3 py-1 bg-purple-100 text-purple-600 rounded-full text-xs hover:bg-purple-200 transition-colors duration-200">Editor</button>
                    </div>
                </div>

                <!-- Submit Button -->
                <div class="flex justify-center">
                    <button type="submit" 
                            class="group relative px-8 py-4 bg-gradient-to-r from-rose-500 to-pink-600 text-white font-semibold rounded-2xl shadow-lg hover:shadow-xl transform hover:-translate-y-1 transition-all duration-300 focus:outline-none focus:ring-4 focus:ring-rose-200">
                        <span class="flex items-center">
                            <svg class="w-5 h-5 mr-2 group-hover:scale-110 transition-transform duration-300" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
                            </svg>
                            Save Role
                        </span>
                        <!-- Button shine effect -->
                        <div class="absolute inset-0 rounded-2xl opacity-0 group-hover:opacity-100 bg-gradient-to-r from-white/20 to-transparent transition-opacity duration-300"></div>
                    </button>
                </div>
            </form>

            <!-- Decorative Footer -->
            <div class="h-1 bg-gradient-to-r from-purple-300 via-pink-300 to-rose-300"></div>
        </div>

        <!-- Help Card -->
        <div class="mt-6 bg-white/60 backdrop-blur-sm rounded-2xl p-6 border border-pink-100">
            <div class="flex items-start space-x-3">
                <div class="flex-shrink-0">
                    <svg class="w-6 h-6 text-pink-400 mt-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                    </svg>
                </div>
                <div>
                    <h3 class="text-sm font-semibold text-gray-700 mb-1">Role Guidelines</h3>
                    <p class="text-xs text-gray-600">Choose meaningful role names that reflect the user's permissions and responsibilities within your system.</p>
                </div>
            </div>
        </div>

        <!-- Decorative Elements -->
        <div class="absolute top-20 left-10 w-20 h-20 bg-rose-200 rounded-full opacity-20 blur-xl"></div>
        <div class="absolute top-40 right-20 w-32 h-32 bg-pink-200 rounded-full opacity-20 blur-xl"></div>
        <div class="absolute bottom-20 left-1/3 w-24 h-24 bg-purple-200 rounded-full opacity-20 blur-xl"></div>
    </div>
</div>

<script>
    function fillRole(role) {
        document.getElementById('role').value = role;
        document.getElementById('role').focus();
    }
</script>

<style>
    /* Custom animations */
    @keyframes float {
        0%, 100% { transform: translateY(0px); }
        50% { transform: translateY(-10px); }
    }
    
    .float-animation {
        animation: float 6s ease-in-out infinite;
    }
    
    /* Custom scrollbar */
    select::-webkit-scrollbar {
        width: 8px;
    }
    
    select::-webkit-scrollbar-track {
        background: #fdf2f8;
        border-radius: 4px;
    }
    
    select::-webkit-scrollbar-thumb {
        background: linear-gradient(to bottom, #f43f5e, #ec4899);
        border-radius: 4px;
    }
    
    select::-webkit-scrollbar-thumb:hover {
        background: linear-gradient(to bottom, #e11d48, #db2777);
    }

    /* Input focus glow */
    input:focus, select:focus {
        box-shadow: 0 0 0 4px rgba(244, 63, 94, 0.1);
    }
</style>
@endsection