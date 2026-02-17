
<header class="bg-white border-b border-gray-200 sticky top-0 z-50 shadow-sm">

  <div class="container mx-auto px-4 py-3 flex items-center justify-between">
    <!-- Left: Hamburger (Mobile) -->
    <div class="md:hidden">
      <button id="menuToggle" class="text-gray-600 focus:outline-none focus:ring-2 focus:ring-indigo-500">
        <span class="material-icons">menu</span>
      </button>
    </div>

    <!-- Center: Logo -->
    <div class="flex-1 flex justify-center md:justify-start">
      <a href="{{ route('user.home') }}" wire:navigate>
        <img src="{{asset('assets/images/logo/dotbitz-logo.png')}}" alt="Logo" class="h-10">
      </a>
    </div>

    <!-- Desktop Navigation Menu -->
    <nav class="hidden md:flex items-center space-x-6 ml-6">
      <a href="{{ route('user.home') }}" wire:navigate class="text-sm text-gray-700 hover:text-indigo-600 font-medium">Home</a>
      <a href="{{ route('user.about') }}" wire:navigate class="text-sm text-gray-700 hover:text-indigo-600 font-medium">About</a>
      <a href="{{ route('user.courses') }}" wire:navigate class="text-sm text-gray-700 hover:text-indigo-600 font-medium">Courses</a>


      <!-- Search Bar (Desktop) -->
      <div class="relative w-96">
        <input type="text" placeholder="Search for anything" class="w-full pl-10 pr-4 py-2 border border-gray-300 rounded-full bg-gray-100 focus:outline-none focus:ring-2 focus:ring-indigo-500 text-sm">
        <span class="material-icons absolute left-3 top-1/2 transform -translate-y-1/2 text-gray-500 text-base">search</span>
      </div>

      <a href="{{ route('user.faq') }}" wire:navigate class="text-sm text-gray-700 hover:text-indigo-600 font-medium">FAQs</a>
      <a href="{{route('user.contact')}}" class="text-sm text-gray-700 hover:text-indigo-600 font-medium px-4">Contact</a>
    </nav>

    <!-- Right Buttons -->
    <div class="hidden md:flex items-center space-x-4">

       <a href="https://portal.dotbitz.com" target="_blank" class="hidden md:block font-medium px-4 py-2" style="color: #073a89;">
                        Login
                    </a>
                    <button class="open-consultation-modal consultation-btn hidden md:block font-medium px-4 py-2 rounded-lg text-white bg-[#FF6500]">
                        Book Free Consultation
                    </button>
    </div>

    <!-- Right: Mobile Search & Cart -->
    <div class="flex items-center space-x-4 md:hidden">
      <button id="searchToggle" class="text-gray-600">
        <span class="material-icons">search</span>
      </button>

    </div>
  </div>

  <!-- Mobile Menu Drawer -->
  <div id="mobileMenu" class="fixed top-0 left-0 w-72 h-full bg-white shadow-lg transform -translate-x-full transition-transform duration-300 z-50 md:hidden overflow-y-auto">
    <div class="p-4 border-b border-gray-300 flex items-center justify-between">
      <div>

        <button class="open-consultation-modal consultation-btn font-medium px-4 py-2 rounded-lg text-white bg-[#FF6500]">
            Book Free Consultation
        </button>
      </div>
      <button id="closeMenu" class="text-gray-600">
        <span class="material-icons">close</span>
      </button>
    </div>
    <nav class="p-4">
      <h3 class="text-xs font-bold text-gray-500 uppercase mb-2">Explore by Goal</h3>
      <ul class="space-y-2 mb-4">
        <li><a href="{{route('user.home')}}" class="flex justify-between items-center text-sm text-gray-700 hover:text-indigo-600">Home<span class="material-icons text-xs">chevron_right</span></a></li>
        <li><a href="{{route('user.about')}}" class="flex justify-between items-center text-sm text-gray-700 hover:text-indigo-600">About<span class="material-icons text-xs">chevron_right</span></a></li>
        <li><a href="{{route('user.courses')}}" class="flex justify-between items-center text-sm text-gray-700 hover:text-indigo-600">Courses <span class="material-icons text-xs">chevron_right</span></a></li>
        <li><a href="{{route('user.faq')}}" class="flex justify-between items-center text-sm text-gray-700 hover:text-indigo-600">FAQs <span class="material-icons text-xs">chevron_right</span></a></li>
        <li><a href="{{route('user.contact')}}" class="flex justify-between items-center text-sm text-gray-700 hover:text-indigo-600">Contact <span class="material-icons text-xs">chevron_right</span></a></li>
      </ul>

      <h3 class="text-xs font-bold text-gray-500 uppercase mb-2">Portal Access</h3>
      <ul class="space-y-2">
        <li><a href="https://portal.dotbitz.com" target="_blank" class="flex justify-between items-center text-sm text-gray-700 hover:text-indigo-600">Login<span class="material-icons text-xs">chevron_right</span></a></li>
        <li><a href="https://portal.dotbitz.com/student/registration" target="_blank" class="flex justify-between items-center text-sm text-gray-700 hover:text-indigo-600">Enroll Now<span class="material-icons text-xs">chevron_right</span></a></li>
      </ul>
    </nav>
  </div>
  <!-- Add this right after the mobile menu drawer in your header -->
<!-- Mobile Search Drawer -->
<div id="mobileSearch" class="fixed top-0 left-0 w-full h-20 bg-white shadow-md transform -translate-y-full transition-transform duration-300 z-50 md:hidden flex items-center px-4">
  <div class="relative w-full">
    <input type="text" placeholder="Search for anything" class="w-full pl-10 pr-4 py-2 border border-gray-300 rounded-full bg-gray-100 focus:outline-none focus:ring-2 focus:ring-indigo-500 text-sm">
    <span class="material-icons absolute left-3 top-1/2 transform -translate-y-1/2 text-gray-500 text-base">search</span>
  </div>
  <button id="closeSearch" class="ml-4 text-gray-600">
    <span class="material-icons">close</span>
  </button>
</div>

<!-- Update your overlay div to include search functionality -->
<div id="overlay" class="fixed inset-0 hidden z-40 md:hidden bg-black bg-opacity-20 backdrop-blur-sm"></div>

  <!-- Overlay -->
  {{-- <div id="overlay" class="fixed inset-0 hidden z-40 md:hidden"></div> --}}




  </script>
  <style>
    #overlay {
  background-color: rgba(0, 0, 0, 0.2); /* Light black with opacity */
  backdrop-filter: blur(2px);
  -webkit-backdrop-filter: blur(2px);
  }
  </style>
</header>






