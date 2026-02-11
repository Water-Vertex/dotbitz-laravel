<header class="sticky-header bg-white border-b border-gray-200 sticky top-0 z-50">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="flex items-center justify-between h-16">
            <!-- Left: Logo + Categories Dropdown -->
            <div class="flex items-center space-x-6 lg:space-x-8">
                <!-- Logo -->
                <a href="{{route('user.home')}}" class="flex items-center">
                    <img src="{{asset('assets/images/logo/dotbitz-logo.png')}}" alt="DotBitz Logo" width="130" class="h-auto">
                </a>

                <!-- Desktop Categories Dropdown (Udemy-style) -->
                <div class="hidden lg:block relative group">
                    <button class="flex items-center space-x-1 text-gray-800 hover:text-[#073a89] font-medium text-sm py-2 px-3 rounded-md hover:bg-gray-50 transition-colors">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h7"></path>
                        </svg>
                        <span>Categories</span>
                        <svg class="w-3 h-3 ml-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"></path>
                        </svg>
                    </button>

                    <!-- Mega Menu Dropdown -->
                    <div class="absolute left-0 top-full mt-1 w-80 bg-white rounded-lg shadow-xl border border-gray-200 p-4 opacity-0 invisible group-hover:opacity-100 group-hover:visible transition-all duration-200 z-50">
                        <div class="grid grid-cols-2 gap-4">
                            <a href="#" class="flex items-center space-x-3 p-3 rounded-lg hover:bg-blue-50 transition-colors">
                                <div class="w-8 h-8 rounded-lg bg-blue-100 flex items-center justify-center">
                                    <i class="fas fa-laptop-code text-blue-600 text-sm"></i>
                                </div>
                                <div>
                                    <div class="font-medium text-gray-800">Web Development</div>
                                    <div class="text-xs text-gray-500 mt-0.5">HTML, CSS, JavaScript, React</div>
                                </div>
                            </a>
                            <a href="#" class="flex items-center space-x-3 p-3 rounded-lg hover:bg-blue-50 transition-colors">
                                <div class="w-8 h-8 rounded-lg bg-green-100 flex items-center justify-center">
                                    <i class="fas fa-chart-line text-green-600 text-sm"></i>
                                </div>
                                <div>
                                    <div class="font-medium text-gray-800">Data Science</div>
                                    <div class="text-xs text-gray-500 mt-0.5">Python, ML, AI, Analytics</div>
                                </div>
                            </a>
                            <a href="#" class="flex items-center space-x-3 p-3 rounded-lg hover:bg-blue-50 transition-colors">
                                <div class="w-8 h-8 rounded-lg bg-purple-100 flex items-center justify-center">
                                    <i class="fas fa-paint-brush text-purple-600 text-sm"></i>
                                </div>
                                <div>
                                    <div class="font-medium text-gray-800">UI/UX Design</div>
                                    <div class="text-xs text-gray-500 mt-0.5">Figma, Adobe XD, Prototyping</div>
                                </div>
                            </a>
                            <a href="#" class="flex items-center space-x-3 p-3 rounded-lg hover:bg-blue-50 transition-colors">
                                <div class="w-8 h-8 rounded-lg bg-orange-100 flex items-center justify-center">
                                    <i class="fas fa-mobile-alt text-orange-600 text-sm"></i>
                                </div>
                                <div>
                                    <div class="font-medium text-gray-800">Mobile Dev</div>
                                    <div class="text-xs text-gray-500 mt-0.5">Flutter, React Native, Swift</div>
                                </div>
                            </a>
                        </div>
                        <div class="mt-4 pt-4 border-t border-gray-100">
                            <a href="{{route('user.courses')}}" class="text-sm font-medium text-[#073a89] hover:text-[#062b66] flex items-center justify-center">
                                View all categories
                                <svg class="w-4 h-4 ml-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path>
                                </svg>
                            </a>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Center: Search Bar (Udemy-style) -->
            <div class="hidden lg:block flex-1 max-w-2xl mx-8">
                <div class="relative">
                    <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                        <svg class="h-5 w-5 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path>
                        </svg>
                    </div>
                    <input type="text"
                           class="block w-full pl-10 pr-4 py-2.5 border border-gray-300 rounded-lg bg-gray-50 focus:outline-none focus:ring-2 focus:ring-[#0091B9]/20 focus:border-[#0091B9] focus:bg-white transition-colors"
                           placeholder="Search for courses...">
                </div>
            </div>

            <!-- Right: Action Buttons -->
            <div class="flex items-center space-x-4">
                <!-- Become Instructor Link (Coursera-style) -->
                <a href="#" class="hidden lg:block text-sm font-medium text-gray-700 hover:text-[#073a89] px-3 py-2 hover:bg-gray-50 rounded-md transition-colors">
                    Teach on DotBitz
                </a>

                <!-- Cart Icon -->
                <button class="hidden lg:block relative p-2 text-gray-600 hover:text-[#073a89] hover:bg-gray-50 rounded-md transition-colors">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 3h2l.4 2M7 13h10l4-8H5.4M7 13L5.4 5M7 13l-2.293 2.293c-.63.63-.184 1.707.707 1.707H17m0 0a2 2 0 100 4 2 2 0 000-4zm-8 2a2 2 0 11-4 0 2 2 0 014 0z"></path>
                    </svg>
                    <span class="absolute -top-1 -right-1 bg-[#FF6500] text-white text-xs rounded-full w-4 h-4 flex items-center justify-center">3</span>
                </button>

                <!-- Notifications -->
                <button class="hidden lg:block p-2 text-gray-600 hover:text-[#073a89] hover:bg-gray-50 rounded-md transition-colors relative">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 17h5l-1.405-1.405A2.032 2.032 0 0118 14.158V11a6.002 6.002 0 00-4-5.659V5a2 2 0 10-4 0v.341C7.67 6.165 6 8.388 6 11v3.159c0 .538-.214 1.055-.595 1.436L4 17h5m6 0v1a3 3 0 11-6 0v-1m6 0H9"></path>
                    </svg>
                    <span class="absolute top-1 right-1 w-2 h-2 bg-red-500 rounded-full"></span>
                </button>

                <!-- Login/Register Buttons (Udemy-style) -->
                <div class="hidden md:flex items-center space-x-3">
                    <a href="https://portal.dotbitz.com" target="_blank"
                       class="text-sm font-semibold text-[#073a89] hover:text-[#062b66] px-4 py-2 border border-transparent rounded-md hover:bg-blue-50 transition-colors">
                        Log in
                    </a>
                    <button class="open-consultation-modal text-sm font-semibold text-white bg-[#FF6500] hover:bg-[#e55a00] px-4 py-2 rounded-md transition-colors shadow-sm">
                        Sign up
                    </button>
                </div>

                <!-- User Profile Dropdown Placeholder -->
                <div class="hidden md:block">
                    <button class="flex items-center space-x-2 p-1 hover:bg-gray-50 rounded-full transition-colors">
                        <div class="w-8 h-8 rounded-full bg-gradient-to-r from-[#0091B9] to-[#FF6500] flex items-center justify-center">
                            <span class="text-white font-semibold text-sm">U</span>
                        </div>
                    </button>
                </div>

                <!-- Mobile Menu Button -->
                <button class="md:hidden p-2 text-gray-600 hover:text-[#073a89] hover:bg-gray-100 rounded-md transition-colors" id="mobileMenuButton">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16"></path>
                    </svg>
                </button>
            </div>
        </div>
    </div>
</header>

<!-- Overlay -->
<div class="overlay fixed inset-0 bg-black/50 z-40 hidden" id="overlay"></div>

<!-- Mobile Menu (Coursera-style) -->
<div class="mobile-menu fixed inset-y-0 right-0 w-80 bg-white z-50 transform translate-x-full transition-transform duration-300 shadow-2xl" id="mobileMenu">
    <div class="h-full flex flex-col">
        <!-- Mobile Header -->
        <div class="flex items-center justify-between p-6 border-b border-gray-200">
            <img src="{{asset('assets/images/logo/dotbitz-logo.png')}}" alt="DotBitz Logo" width="110">
            <button class="p-2 hover:bg-gray-100 rounded-md transition-colors" id="closeMobileMenu">
                <svg class="w-5 h-5 text-gray-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
                </svg>
            </button>
        </div>

        <!-- Mobile Search -->
        <div class="p-4 border-b border-gray-200">
            <div class="relative">
                <input type="text"
                       class="w-full pl-10 pr-4 py-2.5 border border-gray-300 rounded-lg bg-gray-50 focus:outline-none focus:ring-2 focus:ring-[#0091B9]/20 focus:border-[#0091B9] focus:bg-white transition-colors"
                       placeholder="Search courses...">
                <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                    <svg class="h-5 w-5 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path>
                    </svg>
                </div>
            </div>
        </div>

        <!-- Mobile Navigation -->
        <div class="flex-1 overflow-y-auto">
            <div class="p-4">
                <!-- User Info -->
                <div class="flex items-center space-x-3 p-3 mb-4 bg-gray-50 rounded-lg">
                    <div class="w-10 h-10 rounded-full bg-gradient-to-r from-[#0091B9] to-[#FF6500] flex items-center justify-center">
                        <span class="text-white font-semibold">U</span>
                    </div>
                    <div>
                        <div class="font-medium text-gray-800">Welcome!</div>
                        <div class="text-sm text-gray-500">Sign in to your account</div>
                    </div>
                </div>

                <!-- Navigation Links -->
                <nav class="space-y-1">
                    <a href="{{route('user.home')}}" class="flex items-center justify-between p-3 rounded-lg hover:bg-gray-50 transition-colors">
                        <div class="flex items-center space-x-3">
                            <div class="w-8 h-8 rounded-md bg-blue-100 flex items-center justify-center">
                                <i class="fas fa-home text-blue-600 text-sm"></i>
                            </div>
                            <span class="font-medium text-gray-800">Home</span>
                        </div>
                        <svg class="w-4 h-4 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path>
                        </svg>
                    </a>

                    <a href="{{route('user.courses')}}" class="flex items-center justify-between p-3 rounded-lg hover:bg-gray-50 transition-colors">
                        <div class="flex items-center space-x-3">
                            <div class="w-8 h-8 rounded-md bg-green-100 flex items-center justify-center">
                                <i class="fas fa-graduation-cap text-green-600 text-sm"></i>
                            </div>
                            <span class="font-medium text-gray-800">Browse Courses</span>
                        </div>
                        <svg class="w-4 h-4 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path>
                        </svg>
                    </a>

                    <div class="ml-11 pl-4 border-l border-gray-200 space-y-1">
                        <a href="#" class="block py-2 text-sm text-gray-600 hover:text-[#073a89]">Web Development</a>
                        <a href="#" class="block py-2 text-sm text-gray-600 hover:text-[#073a89]">Data Science</a>
                        <a href="#" class="block py-2 text-sm text-gray-600 hover:text-[#073a89]">UI/UX Design</a>
                    </div>

                    <a href="#" class="flex items-center justify-between p-3 rounded-lg hover:bg-gray-50 transition-colors">
                        <div class="flex items-center space-x-3">
                            <div class="w-8 h-8 rounded-md bg-purple-100 flex items-center justify-center">
                                <i class="fas fa-chalkboard-teacher text-purple-600 text-sm"></i>
                            </div>
                            <span class="font-medium text-gray-800">Teach on DotBitz</span>
                        </div>
                        <svg class="w-4 h-4 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path>
                        </svg>
                    </a>

                    <a href="{{route('user.about')}}" class="flex items-center justify-between p-3 rounded-lg hover:bg-gray-50 transition-colors">
                        <div class="flex items-center space-x-3">
                            <div class="w-8 h-8 rounded-md bg-orange-100 flex items-center justify-center">
                                <i class="fas fa-info-circle text-orange-600 text-sm"></i>
                            </div>
                            <span class="font-medium text-gray-800">About Us</span>
                        </div>
                        <svg class="w-4 h-4 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path>
                        </svg>
                    </a>

                    <a href="{{route('user.contact')}}" class="flex items-center justify-between p-3 rounded-lg hover:bg-gray-50 transition-colors">
                        <div class="flex items-center space-x-3">
                            <div class="w-8 h-8 rounded-md bg-cyan-100 flex items-center justify-center">
                                <i class="fas fa-headset text-cyan-600 text-sm"></i>
                            </div>
                            <span class="font-medium text-gray-800">Support</span>
                        </div>
                        <svg class="w-4 h-4 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path>
                        </svg>
                    </a>
                </nav>

                <!-- Mobile Action Buttons -->
                <div class="mt-6 space-y-3">
                    <a href="https://portal.dotbitz.com" target="_blank"
                       class="block w-full text-center py-2.5 px-4 border-2 border-[#073a89] text-[#073a89] font-semibold rounded-lg hover:bg-[#073a89] hover:text-white transition-colors">
                        Log in
                    </a>
                    <button class="open-consultation-modal block w-full text-center py-2.5 px-4 bg-[#FF6500] text-white font-semibold rounded-lg hover:bg-[#e55a00] transition-colors">
                        Sign up
                    </button>
                </div>
            </div>
        </div>

        <!-- Mobile Footer -->
        <div class="p-4 border-t border-gray-200">
            <div class="flex justify-center space-x-4 mb-3">
                <a href="#" class="w-8 h-8 rounded-full bg-gray-100 flex items-center justify-center text-gray-600 hover:bg-blue-100 hover:text-[#073a89] transition-colors">
                    <i class="fab fa-facebook-f text-sm"></i>
                </a>
                <a href="#" class="w-8 h-8 rounded-full bg-gray-100 flex items-center justify-center text-gray-600 hover:bg-pink-100 hover:text-pink-600 transition-colors">
                    <i class="fab fa-instagram text-sm"></i>
                </a>
                <a href="#" class="w-8 h-8 rounded-full bg-gray-100 flex items-center justify-center text-gray-600 hover:bg-blue-50 hover:text-blue-600 transition-colors">
                    <i class="fab fa-linkedin-in text-sm"></i>
                </a>
                <a href="#" class="w-8 h-8 rounded-full bg-gray-100 flex items-center justify-center text-gray-600 hover:bg-red-100 hover:text-red-600 transition-colors">
                    <i class="fab fa-youtube text-sm"></i>
                </a>
            </div>
            <p class="text-center text-xs text-gray-500">
                © 2024 DotBitz Learning Platform
            </p>
        </div>
    </div>
</div>


