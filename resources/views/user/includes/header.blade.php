<header class="sticky-header">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex items-center justify-between h-16">
                <!-- Logo -->
                <div class="flex items-center logo-container">
                    <div class="flex items-center space-x-2">
                        <img src="{{asset('assets/images/logo/dotbitz-logo.png')}}" alt="DotBitz Logo" width="150">
                    </div>
                </div>

                <!-- Desktop Navigation (Center) -->
                <nav class="hidden md:flex items-center space-x-8">
                    <a href="{{route('user.home')}}" class="nav-link font-medium" style="color: #1d1d1d;">Home</a>
                    <a href="{{route('user.courses')}}" class="nav-link font-medium" style="color: #1d1d1d;">Courses</a>
                    <a href="{{route('user.about')}}" class="nav-link font-medium" style="color: #1d1d1d;">About</a>
                    <a href="{{route('user.faq')}}" class="nav-link font-medium" style="color: #1d1d1d;">FAQ</a>
                    <a href="{{route('user.contact')}}" class="nav-link font-medium" style="color: #1d1d1d;">Contact</a>
                </nav>

                <!-- Right Side Buttons -->
                <div class="flex items-center space-x-4 header-buttons">
                    <button class="hidden md:block font-medium px-4 py-2" style="color: #073a89;">
                        Login
                    </button>
                    <button class="open-consultation-modal consultation-btn hidden md:block font-medium px-4 py-2 rounded-lg text-white bg-[#FF6500]">
                        Book Free Consultation
                    </button>
                    
                    <!-- Mobile Menu Button -->
                    <button class="md:hidden p-2" id="mobileMenuButton">
                        <svg class="w-6 h-6" style="color: #073a89;" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16"></path>
                        </svg>
                    </button>
                </div>
            </div>
        </div>
    </header>
    <div class="mobile-menu" id="mobileMenu">
        <div class="p-6 h-full flex flex-col">
            <!-- Mobile Menu Header -->
            <div class="flex justify-between items-center mb-8">
                <img src="{{asset('assets/images/logo/dotbitz-logo.png')}}" alt="DotBitz Logo" width="120">
                <button class="p-2" id="closeMobileMenu">
                    <svg class="w-6 h-6" style="color: #073a89;" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
                    </svg>
                </button>
            </div>
            
            <!-- Mobile Navigation -->
            <nav class="flex-1">
                <div class="space-y-4">
                    <a href="{{route('user.home')}}" class="block py-3 px-4 rounded-lg font-medium text-lg hover:bg-gray-100 transition-colors" style="color: #1d1d1d;">
                        <i class="fas fa-home mr-3" style="color: #0091B9;"></i>
                        Home
                    </a>
                    <a href="{{route('user.courses')}}" class="block py-3 px-4 rounded-lg font-medium text-lg hover:bg-gray-100 transition-colors" style="color: #1d1d1d;">
                        <i class="fas fa-book-open mr-3" style="color: #0091B9;"></i>
                        Courses
                    </a>
                    <a href="{{route('user.about')}}" class="block py-3 px-4 rounded-lg font-medium text-lg hover:bg-gray-100 transition-colors" style="color: #1d1d1d;">
                        <i class="fas fa-info-circle mr-3" style="color: #0091B9;"></i>
                        About
                    </a>
                    <a href="{{route('user.faq')}}" class="block py-3 px-4 rounded-lg font-medium text-lg hover:bg-gray-100 transition-colors" style="color: #1d1d1d;">
                        <i class="fas fa-info-circle mr-3" style="color: #0091B9;"></i>
                        FAQ
                    </a>
                    <a href="{{route('user.contact')}}" class="block py-3 px-4 rounded-lg font-medium text-lg hover:bg-gray-100 transition-colors" style="color: #1d1d1d;">
                        <i class="fas fa-envelope mr-3" style="color: #0091B9;"></i>
                        Contact
                    </a>
                </div>
                
                <!-- Mobile Buttons -->
                <div class="mt-8 space-y-4">
                    <button class="w-full py-3 px-4 rounded-lg font-medium" style="color: #073a89; border: 2px solid #073a89;">
                        Login
                    </button>
                    <button class="open-consultation-modal consultation-button w-full py-3 px-4 rounded-lg font-medium text-white" style="background-color: #FF6500;">
                        Book Free Consultation
                    </button>
                </div>
            </nav>
            
            <!-- Mobile Footer -->
            <div class="pt-6 mt-auto border-t" style="border-color: #e5e7eb;">
                <div class="flex justify-center space-x-4 mb-4">
                    <a href="#" class="social-icon w-10 h-10 rounded-full flex items-center justify-center" 
                       style="background-color: #bae4f0; color: #073a89;">
                        <i class="fab fa-facebook-f"></i>
                    </a>
                    <a href="#" class="social-icon w-10 h-10 rounded-full flex items-center justify-center" 
                       style="background-color: #bae4f0; color: #073a89;">
                        <i class="fab fa-instagram"></i>
                    </a>
                    <a href="#" class="social-icon w-10 h-10 rounded-full flex items-center justify-center" 
                       style="background-color: #bae4f0; color: #073a89;">
                        <i class="fab fa-linkedin-in"></i>
                    </a>
                    <a href="#" class="social-icon w-10 h-10 rounded-full flex items-center justify-center" 
                       style="background-color: #bae4f0; color: #073a89;">
                        <i class="fab fa-youtube"></i>
                    </a>
                </div>
                <p class="text-center text-sm" style="color: #1d1d1d;">
                    © 2024 DotBitz
                </p>
            </div>
        </div>
    </div>