@extends('user.layouts.app')

@section('content')
<!-- Contact Us Hero Section -->
<section class="bg-gradient-to-br from-[#073a89] to-[#0091b9] text-white py-16 relative">
    <div class="container mx-auto px-6">
        <!-- Breadcrumb -->
        <nav class="text-sm mb-4 opacity-90">
            <ol class="flex items-center space-x-2">
                <li>
                    <a href="/" class="hover:text-[#ffd500] transition">Home</a>
                </li>
                <li>/</li>
                <li class="text-[#ffd500] font-semibold">Contact</li>
            </ol>
        </nav>

        <!-- Heading -->
        <h1 class="text-4xl md:text-5xl font-bold mb-4">
            Contact Us
        </h1>
        <p class="max-w-2xl text-lg opacity-90">
            Fill out the form below or reach us through our contact details. We'll get back to you as soon as possible.
        </p>
    </div>
</section>



<!-- Contact Section -->
<section class="py-16 md:py-20 bg-white">
    <div class="container mx-auto px-4 sm:px-6 lg:px-8">
        <!-- Section Header -->
        <div class="text-center max-w-3xl mx-auto mb-12 md:mb-16">
            <h2 class="text-3xl md:text-4xl font-bold text-gray-900 mb-4">
                Get in Touch
            </h2>
            <p class="text-lg text-gray-600">
                Have questions? We're here to help. Send us a message and we'll respond as soon as possible.
            </p>
        </div>

        <div class="max-w-6xl mx-auto">
            <div class="grid grid-cols-1 lg:grid-cols-3 gap-8 lg:gap-12">
                <!-- ================= CONTACT INFO (LEFT) ================= -->
                <div class="lg:col-span-1">
                    <div class="space-y-6">
                        <h3 class="text-2xl font-bold text-gray-900 mb-6">Contact Information</h3>

                        <!-- Contact Cards -->
                        <div class="space-y-6">
                            <!-- Location -->
                            <div class="flex items-start space-x-4 p-4 rounded-xl bg-gray-50 hover:bg-gray-100 transition-colors duration-200">
                                <div class="flex-shrink-0 w-12 h-12 flex items-center justify-center rounded-lg text-white"
                                     style="background-color: #073a89;">
                                    <i class="fas fa-map-marker-alt text-lg"></i>
                                </div>
                                <div>
                                    <h4 class="font-semibold text-gray-800 mb-1">Our Location</h4>
                                    <p class="text-gray-600">Dublin, OH 43016</p>
                                </div>
                            </div>

                            <!-- Email -->
                            <div class="flex items-start space-x-4 p-4 rounded-xl bg-gray-50 hover:bg-gray-100 transition-colors duration-200">
                                <div class="flex-shrink-0 w-12 h-12 flex items-center justify-center rounded-lg text-white"
                                     style="background-color: #073a89;">
                                    <i class="fas fa-envelope text-lg"></i>
                                </div>
                                <div>
                                    <h4 class="font-semibold text-gray-800 mb-1">Email Us</h4>
                                    <p class="text-gray-600">info@dotbitz.com</p>
                                </div>
                            </div>

                            <!-- Phone -->
                            <div class="flex items-start space-x-4 p-4 rounded-xl bg-gray-50 hover:bg-gray-100 transition-colors duration-200">
                                <div class="flex-shrink-0 w-12 h-12 flex items-center justify-center rounded-lg text-white"
                                     style="background-color: #073a89;">
                                    <i class="fas fa-phone-alt text-lg"></i>
                                </div>
                                <div>
                                    <h4 class="font-semibold text-gray-800 mb-1">Call Us</h4>
                                    <p class="text-gray-600">+1 323-888-4554</p>
                                </div>
                            </div>

                            <!-- Hours -->
                            <div class="flex items-start space-x-4 p-4 rounded-xl bg-gray-50 hover:bg-gray-100 transition-colors duration-200">
                                <div class="flex-shrink-0 w-12 h-12 flex items-center justify-center rounded-lg text-white"
                                     style="background-color: #073a89;">
                                    <i class="fas fa-clock text-lg"></i>
                                </div>
                                <div>
                                    <h4 class="font-semibold text-gray-800 mb-1">Business Hours</h4>
                                    <p class="text-gray-600">Mon – Fri: 8:00 AM – 8:00 PM</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- ================= CONTACT FORM (RIGHT) ================= -->
                <div class="lg:col-span-2">
                    <div class="bg-white rounded-2xl p-6 md:p-8 border border-gray-200 shadow-sm">
                        <h3 class="text-2xl font-bold text-gray-900 mb-6">Send a Message</h3>

                        <form action="{{route('contact.store')}}" method="POST" class="space-y-6">
                            @csrf

                            <!-- Two-column layout for name and email -->
                            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                                <!-- Full Name -->
                                <div>
                                    <label for="name" class="block text-gray-700 font-medium mb-2">
                                        Full Name *
                                    </label>
                                    <input type="text" id="name" name="name" required
                                        class="w-full px-4 py-3 rounded-lg border border-gray-300 bg-white
                                               focus:ring-2 focus:ring-[#0091b9] focus:border-transparent
                                               focus:outline-none transition-colors duration-200">

                                </div>

                                <!-- Email -->
                                <div>
                                    <label for="email" class="block text-gray-700 font-medium mb-2">
                                        Email Address *
                                    </label>
                                    <input type="email" id="email" name="email" required
                                        class="w-full px-4 py-3 rounded-lg border border-gray-300 bg-white
                                               focus:ring-2 focus:ring-[#0091b9] focus:border-transparent
                                               focus:outline-none transition-colors duration-200">
                                </div>
                            </div>
                            <div>
                                <label for="phone" class="block text-gray-700 font-medium mb-2">
                                    Phone *
                                </label>
                                <input type="text" id="phone" name="phone" required
                                    class="w-full px-4 py-3 rounded-lg border border-gray-300 bg-white
                                            focus:ring-2 focus:ring-[#0091b9] focus:border-transparent
                                            focus:outline-none transition-colors duration-200">
                            </div>
                            <!-- Message -->
                            <div>
                                <label for="message" class="block text-gray-700 font-medium mb-2">
                                    Your Message *
                                </label>
                                <textarea id="message" name="message" rows="5" required
                                    class="w-full px-4 py-3 rounded-lg border border-gray-300 bg-white
                                           focus:ring-2 focus:ring-[#0091b9] focus:border-transparent
                                           focus:outline-none resize-none transition-colors duration-200"
                                    placeholder="How can we help you?"></textarea>
                            </div>

                            <!-- Submit Button -->
                            <button type="submit"
                                class="w-full md:w-auto px-8 py-4 rounded-lg font-semibold text-white
                                       hover:opacity-90 transition-all duration-300 transform hover:-translate-y-0.5
                                       shadow-lg hover:shadow-xl"
                                style="background:#FF6500;">
                                <i class="fas fa-paper-plane mr-2"></i>
                                Send Message
                            </button>
                        </form>
                    </div>
                </div>
            </div>

            <!-- Map Section -->
            <div class="mt-16">
                <div class="rounded-2xl overflow-hidden shadow-lg border border-gray-200">
                    <iframe
                        src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3447.635874371573!2d-95.61710212378538!3d30.224647974836847!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x8647308c7b51ce47%3A0x986d04e6d3d9eb5e!2s1210%20E%20Hufsmith%20Rd%2C%20Tomball%2C%20TX%2077375%2C%20USA!5e0!3m2!1sen!2s!4v1697719200312!5m2!1sen!2s"
                        width="100%" height="400" class="border-0" allowfullscreen="" loading="lazy"
                        referrerpolicy="no-referrer-when-downgrade"
                        title="Our Location">
                    </iframe>
                </div>
                <div class="text-center mt-4">
                    <p class="text-gray-600 text-sm">
                        Visit us at our office in Dublin, Ohio
                    </p>
                </div>
            </div>
        </div>
    </div>
</section>
@endsection
