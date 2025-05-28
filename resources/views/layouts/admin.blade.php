<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Admin Dashboard') - HugsyWugsy</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <style>
        body { font-family: 'Poppins', sans-serif; }
        .gradient-bg { background: linear-gradient(135deg, #fce7f3 0%, #fed7e2 50%, #fbcfe8 100%); }
        .card-hover { 
            transition: all 0.3s ease; 
            transform: translateZ(0);
        }
        .card-hover:hover { 
            transform: translateY(-5px) translateZ(0); 
            box-shadow: 0 20px 25px -5px rgba(0, 0, 0, 0.1), 0 10px 10px -5px rgba(0, 0, 0, 0.04); 
        }
        .sparkle { animation: sparkle 2s infinite; }
        @keyframes sparkle { 
            0%, 100% { opacity: 1; transform: scale(1); } 
            50% { opacity: 0.7; transform: scale(1.1); } 
        }
        .pulse-pink { animation: pulse-pink 2s infinite; }
        @keyframes pulse-pink { 
            0%, 100% { background-color: #fce7f3; } 
            50% { background-color: #fbcfe8; } 
        }
        .sidebar-scroll {
            scrollbar-width: thin;
            scrollbar-color: #ec4899 #fce7f3;
        }
        .sidebar-scroll::-webkit-scrollbar {
            width: 4px;
        }
        .sidebar-scroll::-webkit-scrollbar-track {
            background: #fce7f3;
        }
        .sidebar-scroll::-webkit-scrollbar-thumb {
            background: #ec4899;
            border-radius: 2px;
        }
        .page-transition {
            animation: slideInUp 0.4s ease-out;
        }
        @keyframes slideInUp {
            from {
                opacity: 0;
                transform: translateY(30px);
            }
            to {
                opacity: 1;
                transform: translateY(0);
            }
        }
        .btn-primary {
            background: linear-gradient(135deg, #ec4899, #f43f5e);
            transition: all 0.3s ease;
        }
        .btn-primary:hover {
            transform: translateY(-2px);
            box-shadow: 0 10px 25px rgba(236, 72, 153, 0.3);
        }
        .btn-secondary {
            background: linear-gradient(135deg, #8b5cf6, #a855f7);
            transition: all 0.3s ease;
        }
        .btn-secondary:hover {
            transform: translateY(-2px);
            box-shadow: 0 10px 25px rgba(139, 92, 246, 0.3);
        }
        .table-row-hover {
            transition: all 0.2s ease;
        }
        .table-row-hover:hover {
            background: linear-gradient(135deg, #fce7f3, #fed7e2);
            transform: translateX(4px);
        }
        @yield('styles')
    </style>
</head>
<body class="gradient-bg min-h-screen">
    <div class="flex h-screen">
        <!-- Mobile Menu Overlay -->
        <div id="mobile-menu-overlay" class="fixed inset-0 bg-black bg-opacity-50 z-40 hidden lg:hidden"></div>
        
        <!-- Sidebar -->
        <div id="sidebar" class="fixed lg:relative w-64 bg-gradient-to-b from-pink-50 to-rose-100 shadow-2xl z-50 transform -translate-x-full lg:translate-x-0 transition-transform duration-300 ease-in-out">
            <div class="p-6 h-full flex flex-col">
                <div class="flex items-center justify-between lg:justify-center mb-8">
                    <h4 class="text-2xl font-bold bg-gradient-to-r from-pink-500 to-rose-500 bg-clip-text text-transparent">
                        HugsyWugsy 💖✨
                    </h4>
                    <button id="close-sidebar" class="lg:hidden text-pink-500 hover:text-pink-700 transition-colors">
                        <i class="fas fa-times text-xl"></i>
                    </button>
                </div>
                
                <nav class="space-y-2 flex-1 overflow-y-auto sidebar-scroll">
                    <a href="{{ route('admin.dashboard') }}" class="flex items-center px-4 py-3 text-gray-600 hover:text-pink-600 hover:bg-gradient-to-r hover:from-pink-50 hover:to-rose-50 rounded-2xl transition-all duration-200 group {{ request()->routeIs('admin.dashboard') ? 'text-pink-700 bg-gradient-to-r from-pink-100 to-rose-100 shadow-md border border-pink-200' : '' }}">
                        <i class="fas fa-home mr-3 {{ request()->routeIs('admin.dashboard') ? 'text-pink-500' : 'group-hover:text-pink-500' }}"></i>
                        <span class="font-medium">Dashboard ✨</span>
                    </a>
                    
                    <a href="{{ route('admin.users.index') }}" class="flex items-center px-4 py-3 text-gray-600 hover:text-pink-600 hover:bg-gradient-to-r hover:from-pink-50 hover:to-rose-50 rounded-2xl transition-all duration-200 group {{ request()->routeIs('admin.users.*') ? 'text-pink-700 bg-gradient-to-r from-pink-100 to-rose-100 shadow-md border border-pink-200' : '' }}">
                        <i class="fas fa-users mr-3 {{ request()->routeIs('admin.users.*') ? 'text-pink-500' : 'group-hover:text-pink-500' }}"></i>
                        <span class="font-medium">Manage Users 👥</span>
                    </a>
                    
                    <a href="{{ route('admin.orders.index') }}" class="flex items-center px-4 py-3 text-gray-600 hover:text-pink-600 hover:bg-gradient-to-r hover:from-pink-50 hover:to-rose-50 rounded-2xl transition-all duration-200 group {{ request()->routeIs('admin.orders.*') ? 'text-pink-700 bg-gradient-to-r from-pink-100 to-rose-100 shadow-md border border-pink-200' : '' }}">
                        <i class="fas fa-shopping-cart mr-3 {{ request()->routeIs('admin.orders.*') ? 'text-pink-500' : 'group-hover:text-pink-500' }}"></i>
                        <span class="font-medium">Manage Orders 🛒</span>
                    </a>
                    
                    <a href="{{ route('admin.order_items.index') }}" class="flex items-center px-4 py-3 text-gray-600 hover:text-pink-600 hover:bg-gradient-to-r hover:from-pink-50 hover:to-rose-50 rounded-2xl transition-all duration-200 group {{ request()->routeIs('admin.order-items.*') ? 'text-pink-700 bg-gradient-to-r from-pink-100 to-rose-100 shadow-md border border-pink-200' : '' }}">
                        <i class="fas fa-list mr-3 {{ request()->routeIs('admin.order-items.*') ? 'text-pink-500' : 'group-hover:text-pink-500' }}"></i>
                        <span class="font-medium">Order Items 📝</span>
                    </a>
                    
                    <a href="{{ route('admin.products.index') }}" class="flex items-center px-4 py-3 text-gray-600 hover:text-pink-600 hover:bg-gradient-to-r hover:from-pink-50 hover:to-rose-50 rounded-2xl transition-all duration-200 group {{ request()->routeIs('admin.products.*') ? 'text-pink-700 bg-gradient-to-r from-pink-100 to-rose-100 shadow-md border border-pink-200' : '' }}">
                        <i class="fas fa-box mr-3 {{ request()->routeIs('admin.products.*') ? 'text-pink-500' : 'group-hover:text-pink-500' }}"></i>
                        <span class="font-medium">Manage Products 📦</span>
                    </a>
                    
                    <a href="{{ route('admin.wishlist.index') }}" class="flex items-center px-4 py-3 text-gray-600 hover:text-pink-600 hover:bg-gradient-to-r hover:from-pink-50 hover:to-rose-50 rounded-2xl transition-all duration-200 group {{ request()->routeIs('admin.wishlists.*') ? 'text-pink-700 bg-gradient-to-r from-pink-100 to-rose-100 shadow-md border border-pink-200' : '' }}">
                        <i class="fas fa-heart mr-3 {{ request()->routeIs('admin.wishlists.*') ? 'text-pink-500' : 'group-hover:text-pink-500' }}"></i>
                        <span class="font-medium">Manage Wishlists 💕</span>
                    </a>
                    
                    <a href="{{ route('admin.customizations.index') }}" class="flex items-center px-4 py-3 text-gray-600 hover:text-pink-600 hover:bg-gradient-to-r hover:from-pink-50 hover:to-rose-50 rounded-2xl transition-all duration-200 group {{ request()->routeIs('admin.customizations.*') ? 'text-pink-700 bg-gradient-to-r from-pink-100 to-rose-100 shadow-md border border-pink-200' : '' }}">
                        <i class="fas fa-palette mr-3 {{ request()->routeIs('admin.customizations.*') ? 'text-pink-500' : 'group-hover:text-pink-500' }}"></i>
                        <span class="font-medium">Customizations 🎨</span>
                    </a>
                    
                 

                    
                    <a href="{{ route('admin.admin_roles.index') }}" class="flex items-center px-4 py-3 text-gray-600 hover:text-pink-600 hover:bg-gradient-to-r hover:from-pink-50 hover:to-rose-50 rounded-2xl transition-all duration-200 group {{ request()->routeIs('admin.admin-roles.*') ? 'text-pink-700 bg-gradient-to-r from-pink-100 to-rose-100 shadow-md border border-pink-200' : '' }}">
                        <i class="fas fa-user-shield mr-3 {{ request()->routeIs('admin.admin-roles.*') ? 'text-pink-500' : 'group-hover:text-pink-500' }}"></i>
                        <span class="font-medium">Admin Roles 👑</span>
                    </a>
                    
                    <a href="{{ route('admin.messages.index') }}" class="flex items-center px-4 py-3 text-gray-600 hover:text-pink-600 hover:bg-gradient-to-r hover:from-pink-50 hover:to-rose-50 rounded-2xl transition-all duration-200 group {{ request()->routeIs('admin.messages.*') ? 'text-pink-700 bg-gradient-to-r from-pink-100 to-rose-100 shadow-md border border-pink-200' : '' }}">
                        <i class="fas fa-envelope mr-3 {{ request()->routeIs('admin.messages.*') ? 'text-pink-500' : 'group-hover:text-pink-500' }}"></i>
                        <span class="font-medium">Messages 💌</span>
                    </a>
             
                </nav>
            </div>
        </div>

        <!-- Main Content -->
        <div class="flex-1 overflow-hidden lg:ml-0">
            <!-- Header -->
            <header class="bg-white/80 backdrop-blur-md shadow-lg border-b border-pink-100">
                <div class="flex items-center justify-between px-4 lg:px-6 py-4">
                    <div class="flex items-center">
                        <button id="mobile-menu-btn" class="lg:hidden mr-4 text-pink-500 hover:text-pink-700 transition-colors">
                            <i class="fas fa-bars text-xl"></i>
                        </button>
                        <div>
                            <h1 class="text-xl lg:text-2xl font-bold bg-gradient-to-r from-pink-600 to-rose-600 bg-clip-text text-transparent">
                                @yield('page-title', 'Dashboard ✨')
                            </h1>
                            <p class="text-gray-600 text-sm lg:text-base">
                                @yield('page-subtitle', 'Welcome back, gorgeous! Here\'s what\'s happening with your store 💕')
                            </p>
                        </div>
                    </div>
                    
                    <!-- Header Actions -->
                    <div class="flex items-center space-x-3">
                        <!-- Notifications -->
                        <div class="relative">
                            <button class="p-2 text-gray-600 hover:text-pink-600 transition-colors relative">
                                <i class="fas fa-bell text-xl"></i>
                                <span class="absolute -top-1 -right-1 bg-gradient-to-r from-pink-500 to-rose-500 text-white text-xs rounded-full h-5 w-5 flex items-center justify-center font-medium">3</span>
                            </button>
                        </div>
                        
                        <!-- Profile -->
                        <div class="flex items-center space-x-2 bg-gradient-to-r from-pink-50 to-rose-50 rounded-2xl px-3 py-2 border border-pink-200">
                            <div class="w-8 h-8 bg-gradient-to-r from-pink-400 to-rose-400 rounded-xl flex items-center justify-center">
                                <i class="fas fa-user text-white text-sm"></i>
                            </div>
                            <span class="text-gray-700 font-medium hidden sm:block">Admin</span>
                        </div>
                    </div>
                </div>
            </header>

            <!-- Main Content Area -->
            <main class="p-4 lg:p-6 overflow-y-auto h-full page-transition">
                <!-- Breadcrumb -->
                <nav class="mb-6" aria-label="Breadcrumb">
                    <ol class="flex items-center space-x-2 text-sm">
                        <li>
                            <a href="{{ route('admin.dashboard') }}" class="text-gray-500 hover:text-pink-600 transition-colors">Home</a>
                        </li>
                        @yield('breadcrumb')
                    </ol>
                </nav>

                <!-- Page Content -->
                @yield('content')
            </main>
        </div>
    </div>

    <script>
        // Mobile menu functionality
        const mobileMenuBtn = document.getElementById('mobile-menu-btn');
        const closeSidebarBtn = document.getElementById('close-sidebar');
        const sidebar = document.getElementById('sidebar');
        const overlay = document.getElementById('mobile-menu-overlay');

        function openSidebar() {
            sidebar.classList.remove('-translate-x-full');
            overlay.classList.remove('hidden');
        }

        function closeSidebar() {
            sidebar.classList.add('-translate-x-full');
            overlay.classList.add('hidden');
        }

        mobileMenuBtn.addEventListener('click', openSidebar);
        closeSidebarBtn.addEventListener('click', closeSidebar);
        overlay.addEventListener('click', closeSidebar);

        // Close sidebar on window resize to desktop
        window.addEventListener('resize', () => {
            if (window.innerWidth >= 1024) {
                closeSidebar();
            }
        });
    </script>

    @yield('scripts')
</body>
</html>