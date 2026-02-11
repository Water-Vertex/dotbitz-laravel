<footer class="bg-white border-t pt-10 pb-6" style="border-color: #e5e7eb;">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="grid grid-cols-1 md:grid-cols-3 gap-8">

                <!-- Left Column: Logo + Description + Social Icons -->
                <div class="space-y-6">
                    <!-- Logo -->
                    <div class="flex items-center space-x-3">
                        <img src="{{asset('assets/images/logo/dotbitz-logo.png')}}" alt="DotBitz Logo" class="w-32 ">
                    </div>

                    <!-- Description -->
                    <p class="text-gray-600 md:max-w-xs" style="color: #1d1d1d;">
                       DotBitz is an online learning institute dedicated to teaching programming and career-ready skills to students aged 9 and above. We believe that early exposure to technology, combined with the right guidance, can shape confident learners and future professionals.
                    </p>

                    <!-- Social Icons -->
                    <div class="flex space-x-4 pt-2">
                        <a href="#" class="social-icon w-10 h-10 rounded-full flex items-center justify-center"
                           style="background-color: #bae4f0; color: #073a89;">
                            <i class="fab fa-facebook-f"></i>
                        </a>
                        <a href="#" class="social-icon w-10 h-10 rounded-full flex items-center justify-center"
                           style="background-color: #bae4f0; color: #073a89;">
                            <i class="fab fa-twitter"></i>
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
                </div>

                <!-- Center Column: Custom Links -->
                <div>
                    <h3 class="text-lg font-semibold mb-4" style="color: #073a89;">Quick Links</h3>
                    <div class="grid grid-cols-2 gap-4">
                        <div class="space-y-3">
                            <a href="{{route('user.courses')}}" class="footer-link block" style="color: #1d1d1d;">
                                <i class="fas fa-chevron-right mr-2 text-xs" style="color: #ff6500;"></i>
                                All Courses
                            </a>
                            <a href="{{route('user.about')}}" class="footer-link block" style="color: #1d1d1d;">
                                <i class="fas fa-chevron-right mr-2 text-xs" style="color: #ff6500;"></i>
                                About Us
                            </a>
                            <a href="{{route('user.contact')}}" class="footer-link block" style="color: #1d1d1d;">
                                <i class="fas fa-chevron-right mr-2 text-xs" style="color: #ff6500;"></i>
                                Contact Us
                            </a>
                            <a href="{{route('user.faq')}}" class="footer-link block" style="color: #1d1d1d;">
                                <i class="fas fa-chevron-right mr-2 text-xs" style="color: #ff6500;"></i>
                                FAQ
                            </a>
                            <a href="https://portal.dotbitz.com" target="_blank" class="footer-link block" style="color: #1d1d1d;">
                                <i class="fas fa-chevron-right mr-2 text-xs" style="color: #ff6500;"></i>
                                Login
                            </a>
                        </div>
                        <div class="space-y-3">

                        </div>
                    </div>
                </div>

                <!-- Right Column: Newsletter + Contact -->
                <div class="space-y-6">
                    <!-- Newsletter -->
                    <div>
                        <h3 class="text-lg font-semibold mb-4" style="color: #073a89;">Stay Updated</h3>
                        <p class="text-sm mb-3" style="color: #1d1d1d;">
                            Subscribe to our newsletter for course updates and community news.
                        </p>
                        <div class="flex">
                            <input type="email"
                                   placeholder="Your email address"
                                   class="flex-1 px-4 py-3 border rounded-l-lg focus:outline-none focus:ring-2 focus:ring-blue-500"
                                   style="border-color: #bae4f0;">
                            <button class="newsletter-btn text-white font-medium px-5 rounded-r-lg">
                                <i class="fas fa-paper-plane text-[#FFD500]"></i>
                            </button>
                        </div>
                    </div>

                    <!-- Contact Information (Optional - You can add back if needed) -->
                </div>
            </div>

            <!-- Bottom Copyright Bar -->
            <div class="mt-10 pt-6 border-t text-center" style="border-color: #e5e7eb;">
                <div class="flex flex-col md:flex-row justify-between items-center">
                    <p class="text-sm mb-2 md:mb-0" style="color: #1d1d1d;">
                        © {{date('Y')}} DotBitz. All rights reserved.
                    </p>
                    <div class="flex flex-wrap justify-center gap-4 md:gap-6">
                        @php
                            $policies = \App\Models\Policy::all();
                        @endphp
                        @foreach($policies as $policy)
                        <a href="{{route('user.policy',$policy->slug)}}" class="text-sm hover:text-orange-500 transition-colors" style="color: #073a89;">{{$policy->title}}</a>
                        @endforeach
                    </div>
                </div>
            </div>
        </div>
    </footer>
