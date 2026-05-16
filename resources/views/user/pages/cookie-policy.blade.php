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
                <li class="text-[#ffd500] font-semibold">Cookie Policy</li>
            </ol>
        </nav>

        <!-- Heading -->
        <h1 class="text-4xl md:text-5xl font-bold mb-4">
            Cookie Policy
        </h1>
        <p class="max-w-2xl text-lg opacity-90">
            Learn how we use cookies and similar technologies to enhance your experience.
        </p>
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
                        This Cookie Policy explains how Dotbitz uses cookies and similar technologies when you visit our website, https://www.dotbitz.com, and use our online learning platform (the "Services"). This policy should be read together with our Privacy Policy.
                    </p>
                </div>
            </div>
        </div>

        <!-- Cookie Policy Content -->
        <div class="space-y-12">
            
            <!-- What Are Cookies Section -->
            <div class="policy-section mb-6">
                <div class="mb-8">
                    <h2 class="text-3xl font-bold text-gray-900 mb-6">What Are Cookies?</h2>
                    <p class="text-gray-600 mb-6">
                        Cookies are small text files that are stored on your device (computer, tablet, or mobile phone) when you visit a website. They help websites function properly, remember user preferences, and improve the overall user experience.
                    </p>
                    
                    <div class="grid md:grid-cols-3 gap-6 mt-8">
                        <div class="text-center p-6 bg-blue-50 rounded-xl">
                            <div class="w-16 h-16 mx-auto mb-4 rounded-full bg-[#073a89] flex items-center justify-center">
                                <svg class="w-8 h-8 text-white" fill="currentColor" viewBox="0 0 20 20">
                                    <path fill-rule="evenodd" d="M3 5a1 1 0 011-1h12a1 1 0 110 2H4a1 1 0 01-1-1zM3 10a1 1 0 011-1h12a1 1 0 110 2H4a1 1 0 01-1-1zM3 15a1 1 0 011-1h12a1 1 0 110 2H4a1 1 0 01-1-1z" clip-rule="evenodd"/>
                                </svg>
                            </div>
                            <h3 class="font-semibold text-gray-900 mb-2">Small Text Files</h3>
                            <p class="text-sm text-gray-600">Tiny files stored on your device</p>
                        </div>
                        
                        <div class="text-center p-6 bg-blue-50 rounded-xl">
                            <div class="w-16 h-16 mx-auto mb-4 rounded-full bg-[#0091b9] flex items-center justify-center">
                                <svg class="w-8 h-8 text-white" fill="currentColor" viewBox="0 0 20 20">
                                    <path fill-rule="evenodd" d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z" clip-rule="evenodd"/>
                                </svg>
                            </div>
                            <h3 class="font-semibold text-gray-900 mb-2">Website Functionality</h3>
                            <p class="text-sm text-gray-600">Help websites work properly</p>
                        </div>
                        
                        <div class="text-center p-6 bg-blue-50 rounded-xl">
                            <div class="w-16 h-16 mx-auto mb-4 rounded-full bg-[#073a89] flex items-center justify-center">
                                <svg class="w-8 h-8 text-white" fill="currentColor" viewBox="0 0 20 20">
                                    <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"/>
                                </svg>
                            </div>
                            <h3 class="font-semibold text-gray-900 mb-2">User Experience</h3>
                            <p class="text-sm text-gray-600">Remember preferences & improve experience</p>
                        </div>
                    </div>
                </div>
            </div>

            <!-- How We Use Cookies Section -->
            <div class="policy-section mb-6">
                <div class="mb-8">
                    <h2 class="text-3xl font-bold text-gray-900 mb-6">How We Use Cookies</h2>
                    <p class="text-gray-600 mb-8">
                        Dotbitz uses cookies to:
                    </p>
                </div>

                <div class="grid md:grid-cols-2 gap-6">
                    <div class="policy-card">
                        <h3 class="text-xl font-semibold text-gray-900 mb-4">Platform Functionality</h3>
                        <ul class="text-gray-600 space-y-3">
                            <li class="flex items-start">
                                <svg class="w-5 h-5 text-[#073a89] mr-2 mt-0.5 flex-shrink-0" fill="currentColor" viewBox="0 0 20 20">
                                    <path fill-rule="evenodd" d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z" clip-rule="evenodd"/>
                                </svg>
                                <span>Enable core website functionality</span>
                            </li>
                            <li class="flex items-start">
                                <svg class="w-5 h-5 text-[#073a89] mr-2 mt-0.5 flex-shrink-0" fill="currentColor" viewBox="0 0 20 20">
                                    <path fill-rule="evenodd" d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z" clip-rule="evenodd"/>
                                </svg>
                                <span>Remember your login details and preferences</span>
                            </li>
                            <li class="flex items-start">
                                <svg class="w-5 h-5 text-[#073a89] mr-2 mt-0.5 flex-shrink-0" fill="currentColor" viewBox="0 0 20 20">
                                    <path fill-rule="evenodd" d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z" clip-rule="evenodd"/>
                                </svg>
                                <span>Improve platform performance and security</span>
                            </li>
                        </ul>
                    </div>

                    <div class="policy-card">
                        <h3 class="text-xl font-semibold text-gray-900 mb-4">User Experience & Analytics</h3>
                        <ul class="text-gray-600 space-y-3">
                            <li class="flex items-start">
                                <svg class="w-5 h-5 text-[#073a89] mr-2 mt-0.5 flex-shrink-0" fill="currentColor" viewBox="0 0 20 20">
                                    <path fill-rule="evenodd" d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z" clip-rule="evenodd"/>
                                </svg>
                                <span>Analyze usage patterns to enhance learning experiences</span>
                            </li>
                            <li class="flex items-start">
                                <svg class="w-5 h-5 text-[#073a89] mr-2 mt-0.5 flex-shrink-0" fill="currentColor" viewBox="0 0 20 20">
                                    <path fill-rule="evenodd" d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z" clip-rule="evenodd"/>
                                </svg>
                                <span>Personalize content and communications</span>
                            </li>
                            <li class="flex items-start">
                                <svg class="w-5 h-5 text-[#073a89] mr-2 mt-0.5 flex-shrink-0" fill="currentColor" viewBox="0 0 20 20">
                                    <path fill-rule="evenodd" d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z" clip-rule="evenodd"/>
                                </svg>
                                <span>Support marketing and promotional efforts (where applicable)</span>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>

            <!-- Types of Cookies Section -->
            <div class="policy-section mb-6">
                <div class="mb-8">
                    <h2 class="text-3xl font-bold text-gray-900 mb-6">Types of Cookies We Use</h2>
                </div>

                <div class="grid md:grid-cols-2 gap-6">
                    <!-- Essential Cookies -->
                    <div class="policy-card">
                        <div class="flex items-start mb-4">
                            <div class="w-10 h-10 rounded-full bg-red-100 flex items-center justify-center mr-4 flex-shrink-0">
                                <svg class="w-5 h-5 text-red-600" fill="currentColor" viewBox="0 0 20 20">
                                    <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zM8.707 7.293a1 1 0 00-1.414 1.414L8.586 10l-1.293 1.293a1 1 0 101.414 1.414L10 11.414l1.293 1.293a1 1 0 001.414-1.414L11.414 10l1.293-1.293a1 1 0 00-1.414-1.414L10 8.586 8.707 7.293z" clip-rule="evenodd"/>
                                </svg>
                            </div>
                            <div>
                                <h3 class="text-xl font-semibold text-gray-900">Essential Cookies</h3>
                                <p class="text-sm text-gray-600 mt-1">Required for basic functionality</p>
                            </div>
                        </div>
                        <div class="text-gray-600 ml-14">
                            <p>These cookies are necessary for the website and learning platform to function properly. They enable features such as account login, security, and access to courses.</p>
                            <div class="mt-3 p-3 bg-gray-100 rounded-lg">
                                <p class="text-sm text-gray-700"><strong>Cannot be disabled:</strong> These cookies are essential and cannot be turned off without affecting platform functionality.</p>
                            </div>
                        </div>
                    </div>

                    <!-- Performance & Analytics Cookies -->
                    <div class="policy-card">
                        <div class="flex items-start mb-4">
                            <div class="w-10 h-10 rounded-full bg-blue-100 flex items-center justify-center mr-4 flex-shrink-0">
                                <svg class="w-5 h-5 text-blue-600" fill="currentColor" viewBox="0 0 20 20">
                                    <path d="M2 11a1 1 0 011-1h2a1 1 0 011 1v5a1 1 0 01-1 1H3a1 1 0 01-1-1v-5zM8 7a1 1 0 011-1h2a1 1 0 011 1v9a1 1 0 01-1 1H9a1 1 0 01-1-1V7zM14 4a1 1 0 011-1h2a1 1 0 011 1v12a1 1 0 01-1 1h-2a1 1 0 01-1-1V4z"/>
                                </svg>
                            </div>
                            <div>
                                <h3 class="text-xl font-semibold text-gray-900">Performance & Analytics Cookies</h3>
                                <p class="text-sm text-gray-600 mt-1">For platform improvement</p>
                            </div>
                        </div>
                        <div class="text-gray-600 ml-14">
                            <p>These cookies collect information about how users interact with our platform (e.g., pages visited, time spent on courses). This data helps us improve performance and user experience.</p>
                            <div class="mt-3 p-3 bg-blue-50 rounded-lg">
                                <p class="text-sm text-gray-700"><strong>Purpose:</strong> Helps us understand usage patterns and improve course delivery.</p>
                            </div>
                        </div>
                    </div>

                    <!-- Functional Cookies -->
                    <div class="policy-card">
                        <div class="flex items-start mb-4">
                            <div class="w-10 h-10 rounded-full bg-green-100 flex items-center justify-center mr-4 flex-shrink-0">
                                <svg class="w-5 h-5 text-green-600" fill="currentColor" viewBox="0 0 20 20">
                                    <path fill-rule="evenodd" d="M11.3 1.046A1 1 0 0112 2v5h4a1 1 0 01.82 1.573l-7 10A1 1 0 018 18v-5H4a1 1 0 01-.82-1.573l7-10a1 1 0 011.12-.38z" clip-rule="evenodd"/>
                                </svg>
                            </div>
                            <div>
                                <h3 class="text-xl font-semibold text-gray-900">Functional Cookies</h3>
                                <p class="text-sm text-gray-600 mt-1">For personalization</p>
                            </div>
                        </div>
                        <div class="text-gray-600 ml-14">
                            <p>These cookies remember your preferences, such as language selection and learning progress, to provide a personalized experience.</p>
                            <div class="mt-3 p-3 bg-green-50 rounded-lg">
                                <p class="text-sm text-gray-700"><strong>Examples:</strong> Language settings, course progress, theme preferences.</p>
                            </div>
                        </div>
                    </div>

                    <!-- Marketing & Advertising Cookies -->
                    <div class="policy-card">
                        <div class="flex items-start mb-4">
                            <div class="w-10 h-10 rounded-full bg-yellow-100 flex items-center justify-center mr-4 flex-shrink-0">
                                <svg class="w-5 h-5 text-yellow-600" fill="currentColor" viewBox="0 0 20 20">
                                    <path d="M10 12a2 2 0 100-4 2 2 0 000 4z"/>
                                    <path fill-rule="evenodd" d="M.458 10C1.732 5.943 5.522 3 10 3s8.268 2.943 9.542 7c-1.274 4.057-5.064 7-9.542 7S1.732 14.057.458 10zM14 10a4 4 0 11-8 0 4 4 0 018 0z" clip-rule="evenodd"/>
                                </svg>
                            </div>
                            <div>
                                <h3 class="text-xl font-semibold text-gray-900">Marketing & Advertising Cookies</h3>
                                <p class="text-sm text-gray-600 mt-1">For relevant content</p>
                            </div>
                        </div>
                        <div class="text-gray-600 ml-14">
                            <p>These cookies may be used to deliver relevant advertisements and measure the effectiveness of marketing campaigns. They may be set by us or by third-party partners.</p>
                            <div class="mt-3 p-3 bg-yellow-50 rounded-lg">
                                <p class="text-sm text-gray-700"><strong>Optional:</strong> You can control these cookies through your browser settings or our cookie consent tool.</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Third-Party Cookies Section -->
            <div class="policy-section mb-6">
                <div class="mb-8">
                    <h2 class="text-3xl font-bold text-gray-900 mb-6">Third-Party Cookies</h2>
                </div>

                <div class="bg-gray-50 rounded-xl p-6 border border-gray-200">
                    <div class="flex items-start">
                        <div class="flex-shrink-0">
                            <div class="w-12 h-12 rounded-lg bg-[#073a89] flex items-center justify-center mr-4">
                                <svg class="w-6 h-6 text-white" fill="currentColor" viewBox="0 0 20 20">
                                    <path d="M13 6a3 3 0 11-6 0 3 3 0 016 0zM18 8a2 2 0 11-4 0 2 2 0 014 0zM14 15a4 4 0 00-8 0v3h8v-3zM6 8a2 2 0 11-4 0 2 2 0 014 0zM16 18v-3a5.972 5.972 0 00-.75-2.906A3.005 3.005 0 0119 15v3h-3zM4.75 12.094A5.973 5.973 0 004 15v3H1v-3a3 3 0 013.75-2.906z"/>
                                </svg>
                            </div>
                        </div>
                        <div>
                            <h3 class="text-xl font-semibold text-gray-900 mb-3">Third-Party Service Providers</h3>
                            <p class="text-gray-600 mb-4">
                                We may allow trusted third-party service providers (such as analytics or payment services) to place cookies on your device to help us operate and improve our Services.
                            </p>
                            <div class="bg-blue-50 p-4 rounded-lg">
                                <p class="text-gray-700">
                                    <strong>Important:</strong> These third parties are responsible for their own cookie and privacy practices. We recommend reviewing their privacy policies for more information.
                                </p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Your Cookie Choices Section -->
            <div class="policy-section mb-6">
                <div class="mb-8">
                    <h2 class="text-3xl font-bold text-gray-900 mb-6">Your Cookie Choices</h2>
                </div>

                <div class="bg-gray-50 rounded-xl p-6 border border-gray-200">
                    <div class="flex flex-col md:flex-row gap-8">
                        <div class="md:w-1/2">
                            <div class="flex items-start mb-4">
                                <div class="w-12 h-12 rounded-lg bg-[#0091b9] flex items-center justify-center mr-4">
                                    <svg class="w-6 h-6 text-white" fill="currentColor" viewBox="0 0 20 20">
                                        <path fill-rule="evenodd" d="M3 17a1 1 0 011-1h12a1 1 0 110 2H4a1 1 0 01-1-1zm3.293-7.707a1 1 0 011.414 0L9 10.586V3a1 1 0 112 0v7.586l1.293-1.293a1 1 0 111.414 1.414l-3 3a1 1 0 01-1.414 0l-3-3a1 1 0 010-1.414z" clip-rule="evenodd"/>
                                    </svg>
                                </div>
                                <div>
                                    <h3 class="text-xl font-semibold text-gray-900">Browser Controls</h3>
                                    <p class="text-gray-600 mt-2">
                                        You can control or disable cookies through your browser settings. Most browsers allow you to view, manage, delete, and block cookies.
                                    </p>
                                </div>
                            </div>
                        </div>
                        
                        <div class="md:w-1/2">
                            <div class="flex items-start mb-4">
                                <div class="w-12 h-12 rounded-lg bg-[#073a89] flex items-center justify-center mr-4">
                                    <svg class="w-6 h-6 text-white" fill="currentColor" viewBox="0 0 20 20">
                                        <path fill-rule="evenodd" d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7-4a1 1 0 11-2 0 1 1 0 012 0zM9 9a1 1 0 000 2v3a1 1 0 001 1h1a1 1 0 100-2v-3a1 1 0 00-1-1H9z" clip-rule="evenodd"/>
                                    </svg>
                                </div>
                                <div>
                                    <h3 class="text-xl font-semibold text-gray-900">Important Note</h3>
                                    <div class="mt-2 p-4 bg-yellow-50 rounded-lg">
                                        <p class="text-gray-700">
                                            <strong>Please note:</strong> Disabling certain cookies may impact the functionality of the Dotbitz platform, including access to courses or account features.
                                        </p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    
                    <div class="mt-6 p-4 bg-blue-50 rounded-lg">
                        <h4 class="font-semibold text-gray-900 mb-2">How to Manage Cookies:</h4>
                        <p class="text-gray-600 mb-3">
                            For more information on managing cookies, visit your browser's help section:
                        </p>
                        <div class="grid grid-cols-2 md:grid-cols-4 gap-3">
                            <a href="https://support.google.com/chrome/answer/95647" target="_blank" class="text-center p-3 bg-white rounded-lg hover:bg-gray-50 transition">
                                <span class="text-sm font-medium text-gray-900">Google Chrome</span>
                            </a>
                            <a href="https://support.mozilla.org/en-US/kb/enable-and-disable-cookies-website-preferences" target="_blank" class="text-center p-3 bg-white rounded-lg hover:bg-gray-50 transition">
                                <span class="text-sm font-medium text-gray-900">Mozilla Firefox</span>
                            </a>
                            <a href="https://support.apple.com/guide/safari/manage-cookies-and-website-data-sfri11471/mac" target="_blank" class="text-center p-3 bg-white rounded-lg hover:bg-gray-50 transition">
                                <span class="text-sm font-medium text-gray-900">Safari</span>
                            </a>
                            <a href="https://support.microsoft.com/en-us/microsoft-edge/delete-cookies-in-microsoft-edge-63947406-40ac-c3b8-57b9-2a946a29ae09" target="_blank" class="text-center p-3 bg-white rounded-lg hover:bg-gray-50 transition">
                                <span class="text-sm font-medium text-gray-900">Microsoft Edge</span>
                            </a>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Updates Section -->
            <div class="policy-section mb-6">
                <div class="mb-8">
                    <h2 class="text-3xl font-bold text-gray-900 mb-6">Updates to This Cookie Policy</h2>
                </div>

                <div class="bg-gray-50 rounded-xl p-6 border border-gray-200">
                    <div class="flex items-start">
                        <div class="flex-shrink-0">
                            <div class="w-12 h-12 rounded-lg bg-[#073a89] flex items-center justify-center mr-4">
                                <svg class="w-6 h-6 text-white" fill="currentColor" viewBox="0 0 20 20">
                                    <path fill-rule="evenodd" d="M12.395 2.553a1 1 0 00-1.45-.385c-.345.23-.614.558-.822.88-.214.33-.403.713-.57 1.116-.334.804-.614 1.768-.84 2.734a31.365 31.365 0 00-.613 3.58 2.64 2.64 0 01-.945-1.067c-.328-.68-.398-1.534-.398-2.654A1 1 0 005.05 6.05 6.981 6.981 0 003 11a7 7 0 1011.95-4.95c-.592-.591-.98-.985-1.348-1.467-.363-.476-.724-1.063-1.207-2.03zM12.12 15.12A3 3 0 017 13s.879.5 2.5.5c0-1 .5-4 1.25-4.5.5 1 .786 1.293 1.371 1.879A2.99 2.99 0 0113 13a2.99 2.99 0 01-.879 2.121z" clip-rule="evenodd"/>
                                </svg>
                            </div>
                        </div>
                        <div>
                            <h3 class="text-xl font-semibold text-gray-900 mb-3">Policy Revisions</h3>
                            <p class="text-gray-600 mb-4">
                                We may update this Cookie Policy from time to time to reflect changes in technology, legal requirements, or our practices. Updates will be posted on this page with a revised effective date.
                            </p>
                            <div class="bg-green-50 p-4 rounded-lg">
                                <p class="text-gray-700">
                                    <strong>Continued Use:</strong> Your continued use of our website or Services after changes are posted constitutes acceptance of the updated Cookie Policy.
                                </p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- Contact Section -->
<section class="py-16 bg-gray-50">
    <div class="container mx-auto px-6 max-w-6xl">
        <div class="bg-white rounded-2xl shadow-lg p-8 md:p-12">
            <div class="text-center mb-8">
                <div class="w-20 h-20 mx-auto mb-6 rounded-full bg-gradient-to-r from-[#073a89] to-[#0091b9] flex items-center justify-center">
                    <svg class="w-10 h-10 text-white" fill="currentColor" viewBox="0 0 20 20">
                        <path fill-rule="evenodd" d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-8-3a1 1 0 00-.867.5 1 1 0 11-1.731-1A3 3 0 0113 8a3.001 3.001 0 01-2 2.83V11a1 1 0 11-2 0v-1a1 1 0 011-1 1 1 0 100-2zm0 8a1 1 0 100-2 1 1 0 000 2z" clip-rule="evenodd"/>
                    </svg>
                </div>
                <h2 class="text-3xl font-bold text-gray-900 mb-4">Questions About Cookies?</h2>
                <p class="text-gray-600 mb-8 max-w-2xl mx-auto">
                    If you have any questions about this Cookie Policy or how we use cookies, please don't hesitate to contact us.
                </p>
            </div>
            
            <div class="flex flex-col sm:flex-row gap-4 justify-center">
                <a href="mailto:info@dotbitz.com" 
                   class="inline-flex items-center justify-center px-8 py-3 rounded-lg font-semibold transition-all duration-300"
                   style="background: #073a89; color: white;">
                    <svg class="w-5 h-5 mr-2" fill="currentColor" viewBox="0 0 20 20">
                        <path d="M2.003 5.884L10 9.882l7.997-3.998A2 2 0 0016 4H4a2 2 0 00-1.997 1.884z"/>
                        <path d="M18 8.118l-8 4-8-4V14a2 2 0 002 2h12a2 2 0 002-2V8.118z"/>
                    </svg>
                    Email: info@dotbitz.com
                </a>
                <a href="{{ route('user.contact') }}" 
                   class="inline-flex items-center justify-center px-8 py-3 rounded-lg font-semibold border-2 border-[#073a89] text-[#073a89] hover:bg-[#073a89] hover:text-white transition-all duration-300">
                    <svg class="w-5 h-5 mr-2" fill="currentColor" viewBox="0 0 20 20">
                        <path fill-rule="evenodd" d="M18 5v8a2 2 0 01-2 2h-5l-5 4v-4H4a2 2 0 01-2-2V5a2 2 0 012-2h12a2 2 0 012 2zM7 8H5v2h2V8zm2 0h2v2H9V8zm6 0h-2v2h2V8z" clip-rule="evenodd"/>
                    </svg>
                    Contact Support
                </a>
            </div>
            
            <div class="mt-8 pt-8 border-t border-gray-200">
                <p class="text-sm text-gray-500 text-center">
                    Last updated: {{ date('F d, Y') }}
                </p>
                <p class="text-sm text-gray-500 text-center mt-2">
                    This Cookie Policy should be read in conjunction with our <a href="{{ route('privacy-policy') }}" class="text-[#073a89] hover:underline font-medium">Privacy Policy</a> and <a href="{{ route('terms-of-service') }}" class="text-[#073a89] hover:underline font-medium">Terms of Service</a>.
                </p>
            </div>
        </div>
    </div>
</section>
@endsection

@section('styles')
<style>
.policy-card {
    @apply bg-gray-50 rounded-xl p-6 border border-gray-200 hover:border-[#073a89] transition-all duration-300;
}

.policy-section {
    @apply transition-all duration-500;
}

/* Smooth scrolling */
html {
    scroll-behavior: smooth;
}

/* Cookie icon animation */
@keyframes cookie-bounce {
    0%, 100% { transform: translateY(0); }
    50% { transform: translateY(-5px); }
}

.cookie-icon {
    animation: cookie-bounce 2s infinite;
}
</style>
@endsection

@section('scripts')
<script>
    // Cookie consent reminder (optional)
    document.addEventListener('DOMContentLoaded', function() {
        // Check if cookie consent has been given
        const cookieConsent = localStorage.getItem('dotbitz_cookie_consent');
        
        if (!cookieConsent) {
            // Optionally show a cookie consent banner
            setTimeout(() => {
                // You can add cookie consent banner logic here
                console.log('Cookie consent check');
            }, 1000);
        }
    });
</script>
@endsection