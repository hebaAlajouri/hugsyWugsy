<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Dashboard - HugsyWugsy</title>
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
                  
                </div>
                
                <nav class="space-y-2 flex-1 overflow-y-auto sidebar-scroll">
                    <a href="{{ route('admin.users.index') }}" class="flex items-center px-4 py-3 text-pink-700 bg-gradient-to-r from-pink-100 to-rose-100 rounded-2xl shadow-md border border-pink-200">
                        <i class="fas fa-home mr-3 text-pink-500"></i>
                        <span class="font-medium">Dashboard ✨</span>
                    </a>
                    <a href="{{ route('admin.users.index') }}" class="flex items-center px-4 py-3 text-gray-600 hover:text-pink-600 hover:bg-gradient-to-r hover:from-pink-50 hover:to-rose-50 rounded-2xl transition-all duration-200 group">
                        <i class="fas fa-users mr-3 group-hover:text-pink-500"></i>
                        <span class="font-medium">Manage Users 👥</span>
                    </a>
                    <a href="#" class="flex items-center px-4 py-3 text-gray-600 hover:text-pink-600 hover:bg-gradient-to-r hover:from-pink-50 hover:to-rose-50 rounded-2xl transition-all duration-200 group">
                        <i class="fas fa-shopping-cart mr-3 group-hover:text-pink-500"></i>
                        <span class="font-medium">Manage Orders 🛒</span>
                    </a>
                    <a href="#" class="flex items-center px-4 py-3 text-gray-600 hover:text-pink-600 hover:bg-gradient-to-r hover:from-pink-50 hover:to-rose-50 rounded-2xl transition-all duration-200 group">
                        <i class="fas fa-list mr-3 group-hover:text-pink-500"></i>
                        <span class="font-medium">Order Items 📝</span>
                    </a>
                    <a href="#" class="flex items-center px-4 py-3 text-gray-600 hover:text-pink-600 hover:bg-gradient-to-r hover:from-pink-50 hover:to-rose-50 rounded-2xl transition-all duration-200 group">
                        <i class="fas fa-box mr-3 group-hover:text-pink-500"></i>
                        <span class="font-medium">Manage Products 📦</span>
                    </a>
                    <a href="#" class="flex items-center px-4 py-3 text-gray-600 hover:text-pink-600 hover:bg-gradient-to-r hover:from-pink-50 hover:to-rose-50 rounded-2xl transition-all duration-200 group">
                        <i class="fas fa-heart mr-3 group-hover:text-pink-500"></i>
                        <span class="font-medium">Manage Wishlists 💕</span>
                    </a>
                    <a href="#" class="flex items-center px-4 py-3 text-gray-600 hover:text-pink-600 hover:bg-gradient-to-r hover:from-pink-50 hover:to-rose-50 rounded-2xl transition-all duration-200 group">
                        <i class="fas fa-palette mr-3 group-hover:text-pink-500"></i>
                        <span class="font-medium">Customizations 🎨</span>
                    </a>
                    <a href="#" class="flex items-center px-4 py-3 text-gray-600 hover:text-pink-600 hover:bg-gradient-to-r hover:from-pink-50 hover:to-rose-50 rounded-2xl transition-all duration-200 group">
                        <i class="fas fa-gift mr-3 group-hover:text-pink-500"></i>
                        <span class="font-medium">Gift Cards 🎁</span>
                    </a>
                    <a href="#" class="flex items-center px-4 py-3 text-gray-600 hover:text-pink-600 hover:bg-gradient-to-r hover:from-pink-50 hover:to-rose-50 rounded-2xl transition-all duration-200 group">
                        <i class="fas fa-certificate mr-3 group-hover:text-pink-500"></i>
                        <span class="font-medium">Certificates 🏆</span>
                    </a>
                    <a href="#" class="flex items-center px-4 py-3 text-gray-600 hover:text-pink-600 hover:bg-gradient-to-r hover:from-pink-50 hover:to-rose-50 rounded-2xl transition-all duration-200 group">
                        <i class="fas fa-user-shield mr-3 group-hover:text-pink-500"></i>
                        <span class="font-medium">Admin Roles 👑</span>
                    </a>
                    <a href="#" class="flex items-center px-4 py-3 text-gray-600 hover:text-pink-600 hover:bg-gradient-to-r hover:from-pink-50 hover:to-rose-50 rounded-2xl transition-all duration-200 group">
                        <i class="fas fa-envelope mr-3 group-hover:text-pink-500"></i>
                        <span class="font-medium">Messages 💌</span>
                    </a>
                    <a href="#" class="flex items-center px-4 py-3 text-gray-600 hover:text-pink-600 hover:bg-gradient-to-r hover:from-pink-50 hover:to-rose-50 rounded-2xl transition-all duration-200 group">
                        <i class="fas fa-cog mr-3 group-hover:text-pink-500"></i>
                        <span class="font-medium">Settings ⚙️</span>
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
                                Dashboard ✨
                            </h1>
                            <p class="text-gray-600 text-sm lg:text-base">Welcome back, gorgeous! Here's what's happening with your store 💕</p>
                        </div>
                    </div>
                
               
                </div>
            </header>

            <!-- Dashboard Content -->
            <main class="p-4 lg:p-6 overflow-y-auto h-full">
                <!-- Stats Cards -->
                <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-4 lg:gap-6 mb-6 lg:mb-8">
                    <div class="bg-white/70 backdrop-blur-md rounded-3xl shadow-xl p-4 lg:p-6 border border-pink-100 card-hover">
                        <div class="flex items-center justify-between">
                            <div>
                                <p class="text-gray-600 text-sm font-medium">Total Cuties 👥</p>
                                <p class="text-2xl lg:text-3xl font-bold bg-gradient-to-r from-pink-600 to-rose-600 bg-clip-text text-transparent">1,245</p>
                                <p class="text-green-600 text-sm mt-1 flex items-center">
                                    <i class="fas fa-arrow-up mr-1"></i>
                                    +12% from last month ✨
                                </p>
                            </div>
                            <div class="bg-gradient-to-br from-pink-100 to-rose-100 p-3 rounded-2xl shadow-md">
                                <i class="fas fa-users text-pink-500 text-xl"></i>
                            </div>
                        </div>
                    </div>

                    <div class="bg-white/70 backdrop-blur-md rounded-3xl shadow-xl p-4 lg:p-6 border border-pink-100 card-hover">
                        <div class="flex items-center justify-between">
                            <div>
                                <p class="text-gray-600 text-sm font-medium">Sweet Orders 🛒</p>
                                <p class="text-2xl lg:text-3xl font-bold bg-gradient-to-r from-green-500 to-emerald-500 bg-clip-text text-transparent">856</p>
                                <p class="text-green-600 text-sm mt-1 flex items-center">
                                    <i class="fas fa-arrow-up mr-1"></i>
                                    +8% from last month 💖
                                </p>
                            </div>
                            <div class="bg-gradient-to-br from-green-100 to-emerald-100 p-3 rounded-2xl shadow-md">
                                <i class="fas fa-shopping-cart text-green-500 text-xl"></i>
                            </div>
                        </div>
                    </div>

                    <div class="bg-white/70 backdrop-blur-md rounded-3xl shadow-xl p-4 lg:p-6 border border-pink-100 card-hover">
                        <div class="flex items-center justify-between">
                            <div>
                                <p class="text-gray-600 text-sm font-medium">Adorable Products 📦</p>
                                <p class="text-2xl lg:text-3xl font-bold bg-gradient-to-r from-purple-500 to-violet-500 bg-clip-text text-transparent">234</p>
                                <p class="text-blue-600 text-sm mt-1 flex items-center">
                                    <i class="fas fa-arrow-up mr-1"></i>
                                    +5 new this week 🌟
                                </p>
                            </div>
                            <div class="bg-gradient-to-br from-purple-100 to-violet-100 p-3 rounded-2xl shadow-md">
                                <i class="fas fa-box text-purple-500 text-xl"></i>
                            </div>
                        </div>
                    </div>

                    <div class="bg-white/70 backdrop-blur-md rounded-3xl shadow-xl p-4 lg:p-6 border border-pink-100 card-hover">
                        <div class="flex items-center justify-between">
                            <div>
                                <p class="text-gray-600 text-sm font-medium">Sparkly Revenue ✨</p>
                                <p class="text-2xl lg:text-3xl font-bold bg-gradient-to-r from-yellow-500 to-orange-500 bg-clip-text text-transparent">$48,592</p>
                                <p class="text-green-600 text-sm mt-1 flex items-center">
                                    <i class="fas fa-arrow-up mr-1"></i>
                                    +23% from last month 🎉
                                </p>
                            </div>
                            <div class="bg-gradient-to-br from-yellow-100 to-orange-100 p-3 rounded-2xl shadow-md">
                                <i class="fas fa-dollar-sign text-yellow-500 text-xl sparkle"></i>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Quick Actions & Recent Activity -->
                <div class="grid grid-cols-1 lg:grid-cols-2 gap-4 lg:gap-6 mb-6 lg:mb-8">
                    <!-- Quick Actions -->
                    <div class="bg-white/70 backdrop-blur-md rounded-3xl shadow-xl p-4 lg:p-6 border border-pink-100 card-hover">
                        <h3 class="text-lg font-bold bg-gradient-to-r from-pink-600 to-rose-600 bg-clip-text text-transparent mb-4 flex items-center">
                            Quick Actions ⚡
                            <span class="sparkle ml-2">✨</span>
                        </h3>
                        <div class="grid grid-cols-1 sm:grid-cols-2 gap-3 lg:gap-4">
                            <a href="#" class="flex items-center p-3 lg:p-4 bg-gradient-to-r from-pink-50 to-rose-50 rounded-2xl hover:from-pink-100 hover:to-rose-100 transition-all duration-300 shadow-md hover:shadow-lg group">
                                <i class="fas fa-plus text-pink-500 mr-3 group-hover:scale-110 transition-transform"></i>
                                <span class="text-gray-700 font-medium text-sm lg:text-base">Add Product 🎀</span>
                            </a>
                            <a href="#" class="flex items-center p-3 lg:p-4 bg-gradient-to-r from-blue-50 to-cyan-50 rounded-2xl hover:from-blue-100 hover:to-cyan-100 transition-all duration-300 shadow-md hover:shadow-lg group">
                                <i class="fas fa-eye text-blue-500 mr-3 group-hover:scale-110 transition-transform"></i>
                                <span class="text-gray-700 font-medium text-sm lg:text-base">View Orders 👀</span>
                            </a>
                            <a href="#" class="flex items-center p-3 lg:p-4 bg-gradient-to-r from-green-50 to-emerald-50 rounded-2xl hover:from-green-100 hover:to-emerald-100 transition-all duration-300 shadow-md hover:shadow-lg group">
                                <i class="fas fa-user-plus text-green-500 mr-3 group-hover:scale-110 transition-transform"></i>
                                <span class="text-gray-700 font-medium text-sm lg:text-base">Add User 👤</span>
                            </a>
                            <a href="#" class="flex items-center p-3 lg:p-4 bg-gradient-to-r from-purple-50 to-violet-50 rounded-2xl hover:from-purple-100 hover:to-violet-100 transition-all duration-300 shadow-md hover:shadow-lg group">
                                <i class="fas fa-envelope text-purple-500 mr-3 group-hover:scale-110 transition-transform"></i>
                                <span class="text-gray-700 font-medium text-sm lg:text-base">Messages 💌</span>
                            </a>
                        </div>
                    </div>

                    <!-- Recent Activity -->
              
                </div>

                <!-- System Status -->
                <div class="bg-white/70 backdrop-blur-md rounded-3xl shadow-xl p-4 lg:p-6 border border-pink-100 card-hover">
                    <h3 class="text-lg font-bold bg-gradient-to-r from-pink-600 to-rose-600 bg-clip-text text-transparent mb-4 flex items-center">
                        System Status 🔧
                        <span class="sparkle ml-2">⚡</span>
                    </h3>
                    <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                        <div class="text-center p-4 bg-gradient-to-r from-green-50 to-emerald-50 rounded-2xl">
                            <div class="bg-gradient-to-br from-green-100 to-emerald-100 w-16 h-16 rounded-full flex items-center justify-center mx-auto mb-3 shadow-md">
                                <i class="fas fa-server text-green-600 text-2xl"></i>
                            </div>
                            <h4 class="font-semibold text-gray-800">Server Status</h4>
                            <p class="text-green-600 font-medium">Online ✅</p>
                            <p class="text-gray-600 text-sm">All systems operational</p>
                        </div>
                        <div class="text-center p-4 bg-gradient-to-r from-blue-50 to-cyan-50 rounded-2xl">
                            <div class="bg-gradient-to-br from-blue-100 to-cyan-100 w-16 h-16 rounded-full flex items-center justify-center mx-auto mb-3 shadow-md">
                                <i class="fas fa-database text-blue-600 text-2xl"></i>
                            </div>
                            <h4 class="font-semibold text-gray-800">Database</h4>
                            <p class="text-blue-600 font-medium">Connected 🔗</p>
                            <p class="text-gray-600 text-sm">Response time: 45ms</p>
                        </div>
                        <div class="text-center p-4 bg-gradient-to-r from-purple-50 to-violet-50 rounded-2xl">
                            <div class="bg-gradient-to-br from-purple-100 to-violet-100 w-16 h-16 rounded-full flex items-center justify-center mx-auto mb-3 shadow-md">
                                <i class="fas fa-cloud text-purple-600 text-2xl"></i>
                            </div>
                            <h4 class="font-semibold text-gray-800">Storage</h4>
                            <p class="text-purple-600 font-medium">78% Used 📊</p>
                            <p class="text-gray-600 text-sm">2.1GB of 2.7GB</p>
                        </div>
                    </div>
                </div>
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
</body>
</html>