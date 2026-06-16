@extends('user.layouts.app')

@section('content')
<section class="bg-gradient-to-br from-[#073a89] to-[#0091b9] text-white py-16 relative">
    <div class="container mx-auto px-6">
        <!-- Breadcrumb -->
        <nav class="text-sm mb-6 opacity-90">
            <ol class="flex items-center space-x-2">
                <li>
                    <a href="/" class="hover:text-[#ffd500] transition">Home</a>
                </li>
                <li>/</li>
                <li class="text-[#ffd500] font-semibold">Terms of Service</li>
            </ol>
        </nav>

        <!-- Heading -->
        <h1 class="text-4xl md:text-5xl font-bold mb-4">
            Terms of Service
        </h1>
        <p class="max-w-2xl text-lg opacity-90">
            Please read these terms carefully before using our platform and services.
        </p>
        
        <!-- Effective Date -->
        <div class="mt-6 p-4 bg-white/10 backdrop-blur-sm rounded-lg inline-block">
            <p class="text-sm">
                <span class="font-semibold">Effective Date:</span> February 1, 2026
            </p>
        </div>
    </div>

    <!-- Decorative blur -->
    <div class="absolute top-0 right-0 w-64 h-64 bg-[#ffd500] opacity-10 blur-3xl rounded-full"></div>
</section>

<section class="py-20 bg-white">
    <div class="container mx-auto px-6 max-w-6xl">
        
        <!-- Introduction -->
        <div class="mb-12 p-8 rounded-2xl">
            <div class="flex items-start">
                <svg class="w-6 h-6 text-[#073a89] mt-1 mr-3 flex-shrink-0" fill="currentColor" viewBox="0 0 20 20">
                    <path fill-rule="evenodd" d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7-4a1 1 0 11-2 0 1 1 0 012 0zM9 9a1 1 0 000 2v3a1 1 0 001 1h1a1 1 0 100-2v-3a1 1 0 00-1-1H9z" clip-rule="evenodd"/>
                </svg>
                <div>
                    <p class="text-gray-700 font-medium">
                        <strong>Welcome to Dotbitz.</strong> These Terms of Service ("Terms") govern your access to and use of the Dotbitz website, applications, and online learning platform, including all courses, content, and services (collectively, the "Services"). By accessing or using Dotbitz, you agree to be bound by these Terms. If you do not agree, please do not use our Services.
                    </p>
                </div>
            </div>
        </div>
        

        <!-- Terms Content -->
        <div class="space-y-12">
            
            <!-- Section 1 -->
            <div class="term-section mb-6">
                <div class="flex items-start mb-6">
                    <div class="flex-shrink-0 w-12 h-12 rounded-lg bg-[#073a89] flex items-center justify-center">
                        <span class="text-white font-bold text-xl">1</span>
                    </div>
                    <div class="ml-6">
                        <h2 class="text-2xl font-bold text-gray-900 mb-2">About Dotbitz</h2>
                        <div class="h-1 w-20 bg-[#073a89] rounded-full"></div>
                    </div>
                </div>
                <div class="bg-gray-50 rounded-xl p-6 border border-gray-200">
                    <p class="text-gray-700">
                        Dotbitz is an online learning platform that provides educational content, digital courses, training materials, and related services. Access to certain content may require registration, subscription, or payment.
                    </p>
                </div>
            </div>

            <!-- Section 2 -->
            <div class="term-section mb-6">
                <div class="flex items-start mb-6">
                    <div class="flex-shrink-0 w-12 h-12 rounded-lg bg-[#0091b9] flex items-center justify-center">
                        <span class="text-white font-bold text-xl">2</span>
                    </div>
                    <div class="ml-6">
                        <h2 class="text-2xl font-bold text-gray-900 mb-2">Eligibility & Account Registration</h2>
                        <div class="h-1 w-20 bg-[#0091b9] rounded-full"></div>
                    </div>
                </div>
                <div class="bg-gray-50 rounded-xl p-6 border border-gray-200">
                    <p class="text-gray-700 mb-4">To use certain features of Dotbitz, you must create an account. By registering, you represent that:</p>
                    <ul class="space-y-3">
                        <li class="flex items-start">
                            <div class="flex-shrink-0 mt-1">
                                <div class="w-2 h-2 bg-[#073a89] rounded-full"></div>
                            </div>
                            <span class="ml-3 text-gray-700">You are at least 18 years old or have parental/guardian consent</span>
                        </li>
                        <li class="flex items-start">
                            <div class="flex-shrink-0 mt-1">
                                <div class="w-2 h-2 bg-[#073a89] rounded-full"></div>
                            </div>
                            <span class="ml-3 text-gray-700">The information you provide is accurate, current, and complete</span>
                        </li>
                        <li class="flex items-start">
                            <div class="flex-shrink-0 mt-1">
                                <div class="w-2 h-2 bg-[#073a89] rounded-full"></div>
                            </div>
                            <span class="ml-3 text-gray-700">You will maintain the confidentiality of your account credentials</span>
                        </li>
                    </ul>
                    <div class="mt-6 p-4 bg-blue-50 rounded-lg border border-blue-100">
                        <p class="text-gray-700">
                            <strong>Important:</strong> You are responsible for all activities conducted through your account. Please notify us immediately of any unauthorized use.
                        </p>
                    </div>
                </div>
            </div>

            <!-- Section 3 -->
            <div class="term-section mb-6">
                <div class="flex items-start mb-6">
                    <div class="flex-shrink-0 w-12 h-12 rounded-lg bg-[#073a89] flex items-center justify-center">
                        <span class="text-white font-bold text-xl">3</span>
                    </div>
                    <div class="ml-6">
                        <h2 class="text-2xl font-bold text-gray-900 mb-2">Use of the Platform</h2>
                        <div class="h-1 w-20 bg-[#073a89] rounded-full"></div>
                    </div>
                </div>
                <div class="bg-gray-50 rounded-xl p-6 border border-gray-200">
                    <p class="text-gray-700 mb-4">You agree to use Dotbitz only for lawful, educational purposes. You must not:</p>
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-4 mb-6">
                        <div class="flex items-start p-3 bg-white rounded-lg">
                            <div class="flex-shrink-0 mt-1">
                                <svg class="w-5 h-5 text-red-500" fill="currentColor" viewBox="0 0 20 20">
                                    <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zM8.707 7.293a1 1 0 00-1.414 1.414L8.586 10l-1.293 1.293a1 1 0 101.414 1.414L10 11.414l1.293 1.293a1 1 0 001.414-1.414L11.414 10l1.293-1.293a1 1 0 00-1.414-1.414L10 8.586 8.707 7.293z" clip-rule="evenodd"/>
                                </svg>
                            </div>
                            <span class="ml-2 text-gray-700">Share, resell, or redistribute course content without authorization</span>
                        </div>
                        <div class="flex items-start p-3 bg-white rounded-lg">
                            <div class="flex-shrink-0 mt-1">
                                <svg class="w-5 h-5 text-red-500" fill="currentColor" viewBox="0 0 20 20">
                                    <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zM8.707 7.293a1 1 0 00-1.414 1.414L8.586 10l-1.293 1.293a1 1 0 101.414 1.414L10 11.414l1.293 1.293a1 1 0 001.414-1.414L11.414 10l1.293-1.293a1 1 0 00-1.414-1.414L10 8.586 8.707 7.293z" clip-rule="evenodd"/>
                                </svg>
                            </div>
                            <span class="ml-2 text-gray-700">Copy, record, download, or reproduce content except as permitted</span>
                        </div>
                        <div class="flex items-start p-3 bg-white rounded-lg">
                            <div class="flex-shrink-0 mt-1">
                                <svg class="w-5 h-5 text-red-500" fill="currentColor" viewBox="0 0 20 20">
                                    <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zM8.707 7.293a1 1 0 00-1.414 1.414L8.586 10l-1.293 1.293a1 1 0 101.414 1.414L10 11.414l1.293 1.293a1 1 0 001.414-1.414L11.414 10l1.293-1.293a1 1 0 00-1.414-1.414L10 8.586 8.707 7.293z" clip-rule="evenodd"/>
                                </svg>
                            </div>
                            <span class="ml-2 text-gray-700">Use the platform for fraudulent, harmful, or abusive activities</span>
                        </div>
                        <div class="flex items-start p-3 bg-white rounded-lg">
                            <div class="flex-shrink-0 mt-1">
                                <svg class="w-5 h-5 text-red-500" fill="currentColor" viewBox="0 0 20 20">
                                    <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zM8.707 7.293a1 1 0 00-1.414 1.414L8.586 10l-1.293 1.293a1 1 0 101.414 1.414L10 11.414l1.293 1.293a1 1 0 001.414-1.414L11.414 10l1.293-1.293a1 1 0 00-1.414-1.414L10 8.586 8.707 7.293z" clip-rule="evenodd"/>
                                </svg>
                            </div>
                            <span class="ml-2 text-gray-700">Attempt to disrupt or interfere with platform security or functionality</span>
                        </div>
                    </div>
                    <div class="mt-4 p-4 bg-yellow-50 rounded-lg border border-yellow-100">
                        <p class="text-gray-700 font-medium">
                            We reserve the right to suspend or terminate access for violations of these Terms.
                        </p>
                    </div>
                </div>
            </div>

            <!-- Section 4 -->
            <div class="term-section mb-6">
                <div class="flex items-start mb-6">
                    <div class="flex-shrink-0 w-12 h-12 rounded-lg bg-[#0091b9] flex items-center justify-center">
                        <span class="text-white font-bold text-xl">4</span>
                    </div>
                    <div class="ml-6">
                        <h2 class="text-2xl font-bold text-gray-900 mb-2">Courses, Content & Access</h2>
                        <div class="h-1 w-20 bg-[#0091b9] rounded-full"></div>
                    </div>
                </div>
                <div class="bg-gray-50 rounded-xl p-6 border border-gray-200">
                    <ul class="space-y-4">
                        <li class="flex items-start">
                            <div class="flex-shrink-0 mt-1">
                                <div class="w-2 h-2 bg-[#073a89] rounded-full"></div>
                            </div>
                            <span class="ml-3 text-gray-700">Course content may be updated, modified, or removed at any time</span>
                        </li>
                        <li class="flex items-start">
                            <div class="flex-shrink-0 mt-1">
                                <div class="w-2 h-2 bg-[#073a89] rounded-full"></div>
                            </div>
                            <span class="ml-3 text-gray-700">Access to courses may be time-limited or subscription-based</span>
                        </li>
                        <li class="flex items-start">
                            <div class="flex-shrink-0 mt-1">
                                <div class="w-2 h-2 bg-[#073a89] rounded-full"></div>
                            </div>
                            <span class="ml-3 text-gray-700">We do not guarantee that all courses will be available indefinitely</span>
                        </li>
                        <li class="flex items-start">
                            <div class="flex-shrink-0 mt-1">
                                <div class="w-2 h-2 bg-[#073a89] rounded-full"></div>
                            </div>
                            <span class="ml-3 text-gray-700">Course completion certificates (if offered) are provided at our discretion</span>
                        </li>
                    </ul>
                    <div class="mt-6 p-4 bg-blue-50 rounded-lg border border-blue-100">
                        <p class="text-gray-700">
                            <strong>Important Note:</strong> Dotbitz does not guarantee specific learning outcomes, job placement, or certifications unless explicitly stated.
                        </p>
                    </div>
                </div>
            </div>

            <!-- Section 5 -->
            <div class="term-section mb-6">
                <div class="flex items-start mb-6">
                    <div class="flex-shrink-0 w-12 h-12 rounded-lg bg-[#073a89] flex items-center justify-center">
                        <span class="text-white font-bold text-xl">5</span>
                    </div>
                    <div class="ml-6">
                        <h2 class="text-2xl font-bold text-gray-900 mb-2">Payments, Subscriptions & Refunds</h2>
                        <div class="h-1 w-20 bg-[#073a89] rounded-full"></div>
                    </div>
                </div>
                <div class="bg-gray-50 rounded-xl p-6 border border-gray-200">
                    <ul class="space-y-4">
                        <li class="flex items-start">
                            <div class="flex-shrink-0 mt-1">
                                <svg class="w-5 h-5 text-green-500" fill="currentColor" viewBox="0 0 20 20">
                                    <path fill-rule="evenodd" d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z" clip-rule="evenodd"/>
                                </svg>
                            </div>
                            <span class="ml-3 text-gray-700">Prices are listed in U.S. Dollars (USD) unless otherwise stated</span>
                        </li>
                        <li class="flex items-start">
                            <div class="flex-shrink-0 mt-1">
                                <svg class="w-5 h-5 text-green-500" fill="currentColor" viewBox="0 0 20 20">
                                    <path fill-rule="evenodd" d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z" clip-rule="evenodd"/>
                                </svg>
                            </div>
                            <span class="ml-3 text-gray-700">Payments are processed securely through third-party payment providers</span>
                        </li>
                        <li class="flex items-start">
                            <div class="flex-shrink-0 mt-1">
                                <svg class="w-5 h-5 text-green-500" fill="currentColor" viewBox="0 0 20 20">
                                    <path fill-rule="evenodd" d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z" clip-rule="evenodd"/>
                                </svg>
                            </div>
                            <span class="ml-3 text-gray-700">Dotbitz does not store your payment information</span>
                        </li>
                        <li class="flex items-start">
                            <div class="flex-shrink-0 mt-1">
                                <svg class="w-5 h-5 text-green-500" fill="currentColor" viewBox="0 0 20 20">
                                    <path fill-rule="evenodd" d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z" clip-rule="evenodd"/>
                                </svg>
                            </div>
                            <span class="ml-3 text-gray-700">Subscription terms, renewal, and refund policies will be disclosed at checkout</span>
                        </li>
                    </ul>
                    <div class="mt-6 p-4 bg-yellow-50 rounded-lg border border-yellow-100">
                        <p class="text-gray-700 font-medium">
                            Failure to complete payment may result in restricted access to content.
                        </p>
                    </div>
                </div>
            </div>

            <!-- Section 6 -->
            <div class="term-section mb-6">
                <div class="flex items-start mb-6">
                    <div class="flex-shrink-0 w-12 h-12 rounded-lg bg-[#0091b9] flex items-center justify-center">
                        <span class="text-white font-bold text-xl">6</span>
                    </div>
                    <div class="ml-6">
                        <h2 class="text-2xl font-bold text-gray-900 mb-2">Intellectual Property</h2>
                        <div class="h-1 w-20 bg-[#0091b9] rounded-full"></div>
                    </div>
                </div>
                <div class="bg-gray-50 rounded-xl p-6 border border-gray-200">
                    <p class="text-gray-700 mb-4">
                        All content on Dotbitz—including videos, text, graphics, logos, software, and course materials—is owned by or licensed to Dotbitz and protected by intellectual property laws.
                    </p>
                    <div class="mt-4 p-4 bg-blue-50 rounded-lg">
                        <p class="text-gray-700 font-medium">
                            You are granted a limited, non-transferable, non-exclusive license to access course content for personal, non-commercial use only.
                        </p>
                    </div>
                </div>
            </div>

            <!-- Section 7 -->
            <div class="term-section mb-6">
                <div class="flex items-start mb-6">
                    <div class="flex-shrink-0 w-12 h-12 rounded-lg bg-[#073a89] flex items-center justify-center">
                        <span class="text-white font-bold text-xl">7</span>
                    </div>
                    <div class="ml-6">
                        <h2 class="text-2xl font-bold text-gray-900 mb-2">User Content & Feedback</h2>
                        <div class="h-1 w-20 bg-[#073a89] rounded-full"></div>
                    </div>
                </div>
                <div class="bg-gray-50 rounded-xl p-6 border border-gray-200">
                    <p class="text-gray-700 mb-4">
                        If you submit reviews, feedback, assignments, or other content to Dotbitz, you grant us a worldwide, royalty-free license to use, reproduce, and display such content for platform and business purposes.
                    </p>
                    <div class="mt-4 p-4 bg-green-50 rounded-lg border border-green-100">
                        <p class="text-gray-700">
                            You confirm that your submissions do not violate third-party rights or applicable laws.
                        </p>
                    </div>
                </div>
            </div>

            <!-- Section 8 -->
            <div class="term-section mb-6">
                <div class="flex items-start mb-6">
                    <div class="flex-shrink-0 w-12 h-12 rounded-lg bg-[#0091b9] flex items-center justify-center">
                        <span class="text-white font-bold text-xl">8</span>
                    </div>
                    <div class="ml-6">
                        <h2 class="text-2xl font-bold text-gray-900 mb-2">Third-Party Tools & Links</h2>
                        <div class="h-1 w-20 bg-[#0091b9] rounded-full"></div>
                    </div>
                </div>
                <div class="bg-gray-50 rounded-xl p-6 border border-gray-200">
                    <p class="text-gray-700">
                        Dotbitz may integrate or link to third-party services or tools. We are not responsible for the availability, content, or practices of third-party platforms. Use of third-party services is at your own risk.
                    </p>
                </div>
            </div>

            <!-- Section 9 -->
            <div class="term-section mb-6">
                <div class="flex items-start mb-6">
                    <div class="flex-shrink-0 w-12 h-12 rounded-lg bg-[#073a89] flex items-center justify-center">
                        <span class="text-white font-bold text-xl">9</span>
                    </div>
                    <div class="ml-6">
                        <h2 class="text-2xl font-bold text-gray-900 mb-2">Disclaimers</h2>
                        <div class="h-1 w-20 bg-[#073a89] rounded-full"></div>
                    </div>
                </div>
                <div class="bg-gray-50 rounded-xl p-6 border border-gray-200">
                    <div class="p-4 bg-red-50 rounded-lg border border-red-100 mb-4">
                        <p class="text-gray-700 font-medium">
                            Dotbitz provides educational content for informational purposes only. Our Services are provided "as is" and "as available."
                        </p>
                    </div>
                    <p class="text-gray-700">
                        We make no warranties regarding accuracy, completeness, or suitability of content for any purpose.
                    </p>
                </div>
            </div>

            <!-- Section 10 -->
            <div class="term-section mb-6">
                <div class="flex items-start mb-6">
                    <div class="flex-shrink-0 w-12 h-12 rounded-lg bg-[#0091b9] flex items-center justify-center">
                        <span class="text-white font-bold text-xl">10</span>
                    </div>
                    <div class="ml-6">
                        <h2 class="text-2xl font-bold text-gray-900 mb-2">Limitation of Liability</h2>
                        <div class="h-1 w-20 bg-[#0091b9] rounded-full"></div>
                    </div>
                </div>
                <div class="bg-gray-50 rounded-xl p-6 border border-gray-200">
                    <p class="text-gray-700 mb-4">
                        To the maximum extent permitted by law, Dotbitz shall not be liable for any indirect, incidental, special, or consequential damages arising from your use of the platform or inability to access Services.
                    </p>
                    <div class="mt-4 p-4 bg-yellow-50 rounded-lg">
                        <p class="text-gray-700 font-medium">
                            Our total liability shall not exceed the amount paid by you to Dotbitz in the preceding twelve (12) months.
                        </p>
                    </div>
                </div>
            </div>

            <!-- Section 11 -->
            <div class="term-section mb-6">
                <div class="flex items-start mb-6">
                    <div class="flex-shrink-0 w-12 h-12 rounded-lg bg-[#073a89] flex items-center justify-center">
                        <span class="text-white font-bold text-xl">11</span>
                    </div>
                    <div class="ml-6">
                        <h2 class="text-2xl font-bold text-gray-900 mb-2">Termination</h2>
                        <div class="h-1 w-20 bg-[#073a89] rounded-full"></div>
                    </div>
                </div>
                <div class="bg-gray-50 rounded-xl p-6 border border-gray-200">
                    <p class="text-gray-700 mb-4">
                        We may suspend or terminate your account or access to the Services at any time, without notice, if you violate these Terms or engage in conduct harmful to Dotbitz or other users.
                    </p>
                    <div class="mt-4 p-4 bg-red-50 rounded-lg">
                        <p class="text-gray-700 font-medium">
                            Upon termination, your right to access course content will cease.
                        </p>
                    </div>
                </div>
            </div>

            <!-- Section 12 -->
            <div class="term-section mb-6">
                <div class="flex items-start mb-6">
                    <div class="flex-shrink-0 w-12 h-12 rounded-lg bg-[#0091b9] flex items-center justify-center">
                        <span class="text-white font-bold text-xl">12</span>
                    </div>
                    <div class="ml-6">
                        <h2 class="text-2xl font-bold text-gray-900 mb-2">Changes to These Terms</h2>
                        <div class="h-1 w-20 bg-[#0091b9] rounded-full"></div>
                    </div>
                </div>
                <div class="bg-gray-50 rounded-xl p-6 border border-gray-200">
                    <p class="text-gray-700">
                        We reserve the right to update these Terms at any time. Changes will be posted on this page with an updated effective date. Continued use of the Services constitutes acceptance of the revised Terms.
                    </p>
                </div>
            </div>

            <!-- Section 13 -->
            <div class="term-section mb-6">
                <div class="flex items-start mb-6">
                    <div class="flex-shrink-0 w-12 h-12 rounded-lg bg-[#073a89] flex items-center justify-center">
                        <span class="text-white font-bold text-xl">13</span>
                    </div>
                    <div class="ml-6">
                        <h2 class="text-2xl font-bold text-gray-900 mb-2">Governing Law & Jurisdiction</h2>
                        <div class="h-1 w-20 bg-[#073a89] rounded-full"></div>
                    </div>
                </div>
                <div class="bg-gray-50 rounded-xl p-6 border border-gray-200">
                    <p class="text-gray-700">
                        These Terms shall be governed by and construed in accordance with the laws of the State of Ohio, without regard to conflict of law principles. Any disputes arising under these Terms shall be subject to the exclusive jurisdiction of the state and federal courts located in Ohio.
                    </p>
                </div>
            </div>
            
        </div>
    </div>
</section>
<!-- Contact Section -->
<section class="py-16 bg-gray-50">
    <div class="container mx-auto px-6 max-w-6xl">
        <div class="bg-white rounded-2xl shadow-lg p-8 md:p-12 text-center">
            <h2 class="text-3xl font-bold text-gray-900 mb-4">Questions About Our Terms of Service?</h2>
            <p class="text-gray-600 mb-8 max-w-2xl mx-auto">
                If you have any questions about how we handle your data or want to exercise your privacy rights, our team is here to help.
            </p>
            <div class="flex flex-col sm:flex-row gap-4 justify-center">
                <a href="{{ route('user.contact') }}" 
                   class="px-8 py-3 rounded-lg font-semibold transition-all duration-300"
                   style="background: #073a89; color: white; hover:opacity-90;">
                    Contact Our Terms of Service
                </a>
                <a href="mailto:privacy@dotbitz.com" 
                   class="px-8 py-3 rounded-lg font-semibold border-2 border-[#073a89] text-[#073a89] hover:bg-[#073a89] hover:text-white transition-all duration-300">
                    Email: info@dotbitz.com
                </a>
            </div>
            <p class="text-sm text-gray-500 mt-6">
                Last updated: {{ date('F d, Y') }}
            </p>
        </div>
    </div>
</section>
@endsection

@section('scripts')
<script>
    // Smooth scroll for navigation if needed
    document.addEventListener('DOMContentLoaded', function() {
        // Add intersection observer for section highlighting if needed
        const sections = document.querySelectorAll('.term-section');
        
        const observer = new IntersectionObserver((entries) => {
            entries.forEach(entry => {
                if (entry.isIntersecting) {
                    entry.target.classList.add('section-visible');
                }
            });
        }, { threshold: 0.1 });
        
        sections.forEach(section => {
            observer.observe(section);
        });
    });
</script>

<style>
.term-section {
    @apply transition-all duration-500;
}

.section-visible {
    @apply opacity-100;
}

/* Custom scrollbar for better readability */
::-webkit-scrollbar {
    width: 8px;
}

::-webkit-scrollbar-track {
    background: #f1f1f1;
}

::-webkit-scrollbar-thumb {
    background: #073a89;
    border-radius: 4px;
}

::-webkit-scrollbar-thumb:hover {
    background: #052a68;
}
</style>
@endsection
