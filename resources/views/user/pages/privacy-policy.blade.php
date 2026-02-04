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
                <li class="text-[#ffd500] font-semibold">Privacy Policy</li>
            </ol>
        </nav>

        <!-- Heading -->
        <h1 class="text-4xl md:text-5xl font-bold mb-4">
            Privacy Policy
        </h1>
        <p class="max-w-2xl text-lg opacity-90">
            Your privacy is our priority. Learn how we collect, use, and protect your information.
        </p>
    </div>

    <!-- Decorative blur -->
    <div class="absolute top-0 right-0 w-64 h-64 bg-[#ffd500] opacity-10 blur-3xl rounded-full"></div>
</section>

<section class="py-20 bg-white">
    <div class="container mx-auto px-6 max-w-6xl">
        
        <!-- Last Updated -->
        <div class="mb-8 p-6 rounded-xl border-l-4 border-[#073a89] bg-blue-50">
            <div class="flex items-start">
                <svg class="w-6 h-6 text-[#073a89] mt-1 mr-3 flex-shrink-0" fill="currentColor" viewBox="0 0 20 20">
                    <path fill-rule="evenodd" d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7-4a1 1 0 11-2 0 1 1 0 012 0zM9 9a1 1 0 000 2v3a1 1 0 001 1h1a1 1 0 100-2v-3a1 1 0 00-1-1H9z" clip-rule="evenodd"/>
                </svg>
                <div>
                    <p class="text-gray-700 font-medium">At Dotbitz, we value your privacy and are committed to protecting the personal information you share with us. This Privacy Policy explains how we collect, use, store, and safeguard your information when you visit our website, https://www.dotbitz.com, and any other websites or services we own or operate. We are dedicated to maintaining your trust and handling your data responsibly and transparently.</p>
                </div>
            </div>
        </div>

        

        <!-- Policies Content -->
        <div class="policy-content">
            
            <!-- Overview Section -->
            <div id="overview-policy" class="policy-section mb-6">
                <div class="mb-8">
                    <h2 class="text-3xl font-bold text-gray-900 mb-6">Privacy Commitment</h2>
                    <p class="text-gray-600 mb-6">
                        At Dotbitz, we value your privacy and are committed to protecting the personal information you share with us. This Privacy Policy explains how we collect, use, store, and safeguard your information when you visit our website, https://www.dotbitz.com, and any other websites or services we own or operate.
                    </p>
                    <div class="bg-blue-50 p-6 rounded-xl">
                        <h3 class="text-xl font-semibold text-[#073a89] mb-3">Our Commitment</h3>
                        <p class="text-gray-700">
                            We are dedicated to maintaining your trust and handling your data responsibly and transparently. Your privacy is not just a policy—it's a promise.
                        </p>
                    </div>
                </div>
            </div>

            <!-- Data Collection Section -->
            <div id="collection-policy" class="policy-section ">
                <div class="mb-8">
                    <h2 class="text-3xl font-bold text-gray-900 mb-6">How Your Data is Collected</h2>
                    <p class="text-gray-600 mb-8">
                        We may collect personal information from you in the following ways:
                    </p>
                </div>

                <div class="space-y-8">
                    <!-- Collection Methods -->
                    <div class="policy-card">
                        <h3 class="text-xl font-semibold text-gray-900 mb-4 flex items-center">
                            <span class="w-8 h-8 rounded-full flex items-center justify-center mr-3"
                                  style="background: rgba(7, 58, 137, 0.1); color: #073a89;">
                                <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20">
                                    <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm1-11a1 1 0 10-2 0v2H7a1 1 0 100 2h2v2a1 1 0 102 0v-2h2a1 1 0 100-2h-2V7z" clip-rule="evenodd"/>
                                </svg>
                            </span>
                            Direct Collection Methods
                        </h3>
                        <div class="text-gray-600 ml-11">
                            <ul class="space-y-3">
                                <li class="flex items-start">
                                    <span class="w-2 h-2 bg-[#073a89] rounded-full mt-2 mr-3 flex-shrink-0"></span>
                                    <span>When you create an account with us</span>
                                </li>
                                <li class="flex items-start">
                                    <span class="w-2 h-2 bg-[#073a89] rounded-full mt-2 mr-3 flex-shrink-0"></span>
                                    <span>When you subscribe to our newsletters or marketing communications</span>
                                </li>
                                <li class="flex items-start">
                                    <span class="w-2 h-2 bg-[#073a89] rounded-full mt-2 mr-3 flex-shrink-0"></span>
                                    <span>When you submit inquiries or contact us</span>
                                </li>
                                <li class="flex items-start">
                                    <span class="w-2 h-2 bg-[#073a89] rounded-full mt-2 mr-3 flex-shrink-0"></span>
                                    <span>When you purchase our products or services</span>
                                </li>
                                <li class="flex items-start">
                                    <span class="w-2 h-2 bg-[#073a89] rounded-full mt-2 mr-3 flex-shrink-0"></span>
                                    <span>When you voluntarily provide information to our customer support team via email, phone, live chat, or written communication</span>
                                </li>
                            </ul>
                        </div>
                    </div>

                    <!-- Automatic Collection -->
                    <div class="policy-card">
                        <h3 class="text-xl font-semibold text-gray-900 mb-4 flex items-center">
                            <span class="w-8 h-8 rounded-full flex items-center justify-center mr-3"
                                  style="background: rgba(7, 58, 137, 0.1); color: #073a89;">
                                <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20">
                                    <path fill-rule="evenodd" d="M12.395 2.553a1 1 0 00-1.45-.385c-.345.23-.614.558-.822.88-.214.33-.403.713-.57 1.116-.334.804-.614 1.768-.84 2.734a31.365 31.365 0 00-.613 3.58 2.64 2.64 0 01-.945-1.067c-.328-.68-.398-1.534-.398-2.654A1 1 0 005.05 6.05 6.981 6.981 0 003 11a7 7 0 1011.95-4.95c-.592-.591-.98-.985-1.348-1.467-.363-.476-.724-1.063-1.207-2.03zM12.12 15.12A3 3 0 017 13s.879.5 2.5.5c0-1 .5-4 1.25-4.5.5 1 .786 1.293 1.371 1.879A2.99 2.99 0 0113 13a2.99 2.99 0 01-.879 2.121z" clip-rule="evenodd"/>
                                </svg>
                            </span>
                            Automatic Collection (Cookies & Similar Technologies)
                        </h3>
                        <div class="text-gray-600 ml-11">
                            <p>We also use cookies and similar technologies to enhance your experience and collect information automatically. By using our website, you consent to the use of these cookies and our ability to access them during future visits.</p>
                            <div class="mt-4 p-4 bg-blue-50 rounded-lg">
                                <p class="text-sm text-gray-700"><strong>Note:</strong> You can manage your cookie preferences through your browser settings. However, disabling cookies may affect your experience on our website.</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Use of Data Section -->
            <div id="use-policy" class="policy-section  mb-6">
                <div class="mb-8">
                    <h2 class="text-3xl font-bold text-gray-900 mb-6">Use of Data & Information</h2>
                    <p class="text-gray-600 mb-6">
                        We may collect, store, use, and disclose your information for the following purposes. Your personal data will not be processed in a way that is incompatible with these purposes:
                    </p>
                </div>

                <div class="grid md:grid-cols-2 gap-6">
                    <div class="policy-card">
                        <h3 class="text-xl font-semibold text-gray-900 mb-4">User Experience & Service</h3>
                        <ul class="text-gray-600 space-y-3">
                            <li class="flex items-start">
                                <svg class="w-5 h-5 text-[#073a89] mr-2 mt-0.5 flex-shrink-0" fill="currentColor" viewBox="0 0 20 20">
                                    <path fill-rule="evenodd" d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z" clip-rule="evenodd"/>
                                </svg>
                                <span>Personalizing your experience on our website</span>
                            </li>
                            <li class="flex items-start">
                                <svg class="w-5 h-5 text-[#073a89] mr-2 mt-0.5 flex-shrink-0" fill="currentColor" viewBox="0 0 20 20">
                                    <path fill-rule="evenodd" d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z" clip-rule="evenodd"/>
                                </svg>
                                <span>Processing transactions and payments</span>
                            </li>
                            <li class="flex items-start">
                                <svg class="w-5 h-5 text-[#073a89] mr-2 mt-0.5 flex-shrink-0" fill="currentColor" viewBox="0 0 20 20">
                                    <path fill-rule="evenodd" d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z" clip-rule="evenodd"/>
                                </svg>
                                <span>Fulfilling orders, refunds, and service requests</span>
                            </li>
                            <li class="flex items-start">
                                <svg class="w-5 h-5 text-[#073a89] mr-2 mt-0.5 flex-shrink-0" fill="currentColor" viewBox="0 0 20 20">
                                    <path fill-rule="evenodd" d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z" clip-rule="evenodd"/>
                                </svg>
                                <span>Creating and managing your account</span>
                            </li>
                            <li class="flex items-start">
                                <svg class="w-5 h-5 text-[#073a89] mr-2 mt-0.5 flex-shrink-0" fill="currentColor" viewBox="0 0 20 20">
                                    <path fill-rule="evenodd" d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z" clip-rule="evenodd"/>
                                </svg>
                                <span>Communicating with you regarding services, updates, or support</span>
                            </li>
                        </ul>
                    </div>

                    <div class="policy-card">
                        <h3 class="text-xl font-semibold text-gray-900 mb-4">Business & Compliance</h3>
                        <ul class="text-gray-600 space-y-3">
                            <li class="flex items-start">
                                <svg class="w-5 h-5 text-[#073a89] mr-2 mt-0.5 flex-shrink-0" fill="currentColor" viewBox="0 0 20 20">
                                    <path fill-rule="evenodd" d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z" clip-rule="evenodd"/>
                                </svg>
                                <span>Analytics, market research, and business development</span>
                            </li>
                            <li class="flex items-start">
                                <svg class="w-5 h-5 text-[#073a89] mr-2 mt-0.5 flex-shrink-0" fill="currentColor" viewBox="0 0 20 20">
                                    <path fill-rule="evenodd" d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z" clip-rule="evenodd"/>
                                </svg>
                                <span>Sending marketing communications (where consent is provided)</span>
                            </li>
                            <li class="flex items-start">
                                <svg class="w-5 h-5 text-[#073a89] mr-2 mt-0.5 flex-shrink-0" fill="currentColor" viewBox="0 0 20 20">
                                    <path fill-rule="evenodd" d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z" clip-rule="evenodd"/>
                                </svg>
                                <span>Saving preferences to customize our website and communications</span>
                            </li>
                            <li class="flex items-start">
                                <svg class="w-5 h-5 text-[#073a89] mr-2 mt-0.5 flex-shrink-0" fill="currentColor" viewBox="0 0 20 20">
                                    <path fill-rule="evenodd" d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z" clip-rule="evenodd"/>
                                </svg>
                                <span>Internal administration and record keeping</span>
                            </li>
                            <li class="flex items-start">
                                <svg class="w-5 h-5 text-[#073a89] mr-2 mt-0.5 flex-shrink-0" fill="currentColor" viewBox="0 0 20 20">
                                    <path fill-rule="evenodd" d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z" clip-rule="evenodd"/>
                                </svg>
                                <span>Complying with legal and regulatory obligations</span>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>

            <!-- Data Security Section -->
            <div id="security-policy" class="policy-section  mb-6">
                <div class="mb-8">
                    <h2 class="text-3xl font-bold text-gray-900 mb-6">How We Secure Your Data</h2>
                    <div class="bg-blue-50 p-6 rounded-xl mb-8">
                        <p class="text-gray-700 font-medium">We take the security, integrity, and confidentiality of your personal information seriously. Dotbitz implements appropriate technical and organizational safeguards to protect your data from unauthorized access, misuse, or disclosure.</p>
                    </div>
                </div>

                <div class="grid md:grid-cols-2 gap-8">
                    <div class="policy-card">
                        <div class="flex items-center mb-4">
                            <div class="w-12 h-12 rounded-lg bg-[#073a89] flex items-center justify-center mr-4">
                                <svg class="w-6 h-6 text-white" fill="currentColor" viewBox="0 0 20 20">
                                    <path fill-rule="evenodd" d="M2.166 4.999A11.954 11.954 0 0010 1.944 11.954 11.954 0 0017.834 5c.11.65.166 1.32.166 2.001 0 5.225-3.34 9.67-8 11.317C5.34 16.67 2 12.225 2 7c0-.682.057-1.35.166-2.001zm11.541 3.708a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"/>
                                </svg>
                            </div>
                            <h3 class="text-xl font-semibold text-gray-900">SSL Encryption</h3>
                        </div>
                        <p class="text-gray-600">Our website uses Secure Socket Layer (SSL) encryption to protect information transmitted online. This ensures that all data passed between your browser and our servers remains private and secure.</p>
                    </div>

                    <div class="policy-card">
                        <div class="flex items-center mb-4">
                            <div class="w-12 h-12 rounded-lg bg-[#0091b9] flex items-center justify-center mr-4">
                                <svg class="w-6 h-6 text-white" fill="currentColor" viewBox="0 0 20 20">
                                    <path fill-rule="evenodd" d="M5 9V7a5 5 0 0110 0v2a2 2 0 012 2v5a2 2 0 01-2 2H5a2 2 0 01-2-2v-5a2 2 0 012-2zm8-2v2H7V7a3 3 0 016 0z" clip-rule="evenodd"/>
                                </svg>
                            </div>
                            <h3 class="text-xl font-semibold text-gray-900">Secure Payment Processing</h3>
                        </div>
                        <p class="text-gray-600">We do not store payment details on our servers. Payment processing is handled through secure, encrypted third-party payment providers to ensure your financial information remains protected.</p>
                    </div>
                </div>

                <div class="mt-8 policy-card">
                    <h3 class="text-xl font-semibold text-gray-900 mb-4">Our Security Measures Include:</h3>
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-4 mt-4">
                        <div class="flex items-center">
                            <svg class="w-5 h-5 text-green-500 mr-3" fill="currentColor" viewBox="0 0 20 20">
                                <path fill-rule="evenodd" d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z" clip-rule="evenodd"/>
                            </svg>
                            <span class="text-gray-700">Regular security audits and updates</span>
                        </div>
                        <div class="flex items-center">
                            <svg class="w-5 h-5 text-green-500 mr-3" fill="currentColor" viewBox="0 0 20 20">
                                <path fill-rule="evenodd" d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z" clip-rule="evenodd"/>
                            </svg>
                            <span class="text-gray-700">Access controls and authentication</span>
                        </div>
                        <div class="flex items-center">
                            <svg class="w-5 h-5 text-green-500 mr-3" fill="currentColor" viewBox="0 0 20 20">
                                <path fill-rule="evenodd" d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z" clip-rule="evenodd"/>
                            </svg>
                            <span class="text-gray-700">Data encryption at rest and in transit</span>
                        </div>
                        <div class="flex items-center">
                            <svg class="w-5 h-5 text-green-500 mr-3" fill="currentColor" viewBox="0 0 20 20">
                                <path fill-rule="evenodd" d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z" clip-rule="evenodd"/>
                            </svg>
                            <span class="text-gray-700">Regular employee security training</span>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Data Sharing Section -->
            <div id="sharing-policy" class="policy-section  mb-6">
                <div class="mb-8">
                    <h2 class="text-3xl font-bold text-gray-900 mb-6">Who We May Share Your Data With</h2>
                    <p class="text-gray-600 mb-8">
                        We may share your personal information with trusted third parties where necessary, including:
                    </p>
                </div>

                <div class="space-y-8">
                    <!-- Service Providers -->
                    <div class="policy-card">
                        <div class="flex items-center mb-4">
                            <div class="w-10 h-10 rounded-full bg-blue-100 flex items-center justify-center mr-4">
                                <svg class="w-5 h-5 text-[#073a89]" fill="currentColor" viewBox="0 0 20 20">
                                    <path d="M13 6a3 3 0 11-6 0 3 3 0 016 0zM18 8a2 2 0 11-4 0 2 2 0 014 0zM14 15a4 4 0 00-8 0v3h8v-3zM6 8a2 2 0 11-4 0 2 2 0 014 0zM16 18v-3a5.972 5.972 0 00-.75-2.906A3.005 3.005 0 0119 15v3h-3zM4.75 12.094A5.973 5.973 0 004 15v3H1v-3a3 3 0 013.75-2.906z"/>
                                </svg>
                            </div>
                            <h3 class="text-xl font-semibold text-gray-900">Service Providers</h3>
                        </div>
                        <div class="text-gray-600 ml-14">
                            <p class="mb-3">Third-party vendors that help us operate our business, such as:</p>
                            <ul class="grid grid-cols-1 md:grid-cols-2 gap-2">
                                <li class="flex items-center">
                                    <span class="w-1.5 h-1.5 bg-[#073a89] rounded-full mr-2"></span>
                                    IT and technical support providers
                                </li>
                                <li class="flex items-center">
                                    <span class="w-1.5 h-1.5 bg-[#073a89] rounded-full mr-2"></span>
                                    Data storage, hosting, and server providers
                                </li>
                                <li class="flex items-center">
                                    <span class="w-1.5 h-1.5 bg-[#073a89] rounded-full mr-2"></span>
                                    Payment processors
                                </li>
                                <li class="flex items-center">
                                    <span class="w-1.5 h-1.5 bg-[#073a89] rounded-full mr-2"></span>
                                    Marketing and advertising partners
                                </li>
                                <li class="flex items-center">
                                    <span class="w-1.5 h-1.5 bg-[#073a89] rounded-full mr-2"></span>
                                    Professional advisors (legal, accounting, consulting)
                                </li>
                            </ul>
                        </div>
                    </div>

                    <!-- Business Partners -->
                    <div class="policy-card">
                        <div class="flex items-center mb-4">
                            <div class="w-10 h-10 rounded-full bg-green-100 flex items-center justify-center mr-4">
                                <svg class="w-5 h-5 text-green-600" fill="currentColor" viewBox="0 0 20 20">
                                    <path fill-rule="evenodd" d="M4 4a2 2 0 00-2 2v4a2 2 0 002 2V6h10a2 2 0 00-2-2H4zm2 6a2 2 0 012-2h8a2 2 0 012 2v4a2 2 0 01-2 2H8a2 2 0 01-2-2v-4zm6 4a2 2 0 100-4 2 2 0 000 4z" clip-rule="evenodd"/>
                                </svg>
                            </div>
                            <h3 class="text-xl font-semibold text-gray-900">Business Partners</h3>
                        </div>
                        <div class="text-gray-600 ml-14">
                            <ul class="space-y-2">
                                <li class="flex items-start">
                                    <span class="w-2 h-2 bg-[#0091b9] rounded-full mt-2 mr-3 flex-shrink-0"></span>
                                    Sponsors or promoters of any competitions, promotions, or campaigns we may run
                                </li>
                            </ul>
                        </div>
                    </div>

                    <!-- Legal Authorities -->
                    <div class="policy-card">
                        <div class="flex items-center mb-4">
                            <div class="w-10 h-10 rounded-full bg-red-100 flex items-center justify-center mr-4">
                                <svg class="w-5 h-5 text-red-600" fill="currentColor" viewBox="0 0 20 20">
                                    <path fill-rule="evenodd" d="M13.477 14.89A6 6 0 015.11 6.524l8.367 8.368zm1.414-1.414L6.524 5.11a6 6 0 018.367 8.367zM18 10a8 8 0 11-16 0 8 8 0 0116 0z" clip-rule="evenodd"/>
                                </svg>
                            </div>
                            <h3 class="text-xl font-semibold text-gray-900">Legal & Regulatory Authorities</h3>
                        </div>
                        <div class="text-gray-600 ml-14">
                            <ul class="space-y-2">
                                <li class="flex items-start">
                                    <span class="w-2 h-2 bg-red-500 rounded-full mt-2 mr-3 flex-shrink-0"></span>
                                    Courts, law enforcement agencies, regulators, or government authorities where required by law, or to establish, exercise, or defend legal rights
                                </li>
                            </ul>
                        </div>
                    </div>

                    <div class="bg-blue-50 p-6 rounded-xl mt-6">
                        <p class="text-gray-700 font-medium">All third parties are required to handle your data securely and in accordance with applicable privacy laws. We conduct due diligence on all third-party providers and ensure they maintain appropriate security measures.</p>
                    </div>
                </div>
            </div>

            <!-- Policy Changes Section -->
            <div id="changes-policy" class="policy-section  mb-6">
                <div class="mb-8">
                    <h2 class="text-3xl font-bold text-gray-900 mb-6">Changes to This Policy</h2>
                </div>

                <div class="space-y-8">
                    <div class="policy-card">
                        <div class="flex items-center mb-4">
                            <div class="w-12 h-12 rounded-lg bg-yellow-100 flex items-center justify-center mr-4">
                                <svg class="w-6 h-6 text-yellow-600" fill="currentColor" viewBox="0 0 20 20">
                                    <path fill-rule="evenodd" d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7-4a1 1 0 11-2 0 1 1 0 012 0zM9 9a1 1 0 000 2v3a1 1 0 001 1h1a1 1 0 100-2v-3a1 1 0 00-1-1H9z" clip-rule="evenodd"/>
                                </svg>
                            </div>
                            <div>
                                <h3 class="text-xl font-semibold text-gray-900">Policy Updates</h3>
                                <p class="text-gray-600 text-sm mt-1">Dotbitz reserves the right to update this Privacy Policy at any time</p>
                            </div>
                        </div>
                        <div class="text-gray-600">
                            <p>Dotbitz reserves the right to update this Privacy Policy at any time to reflect changes in our practices, legal requirements, or business operations. We will make reasonable efforts to notify users of any significant updates via our website.</p>
                        </div>
                    </div>

                    <div class="policy-card">
                        <div class="flex items-center mb-4">
                            <div class="w-12 h-12 rounded-lg bg-green-100 flex items-center justify-center mr-4">
                                <svg class="w-6 h-6 text-green-600" fill="currentColor" viewBox="0 0 20 20">
                                    <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"/>
                                </svg>
                            </div>
                            <div>
                                <h3 class="text-xl font-semibold text-gray-900">Continued Use & Consent</h3>
                                <p class="text-gray-600 text-sm mt-1">Your acceptance of updated terms</p>
                            </div>
                        </div>
                        <div class="text-gray-600">
                            <p>Your continued use of our website after changes are posted constitutes acceptance of the updated Privacy Policy. Where legally required, we will seek your consent again for material changes affecting how your personal information is processed.</p>
                        </div>
                    </div>

                    <div class="bg-gray-50 p-6 rounded-xl">
                        <h4 class="font-semibold text-gray-900 mb-3">How We Notify You of Changes:</h4>
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                            <div class="flex items-center">
                                <svg class="w-5 h-5 text-[#073a89] mr-3" fill="currentColor" viewBox="0 0 20 20">
                                    <path d="M10 12a2 2 0 100-4 2 2 0 000 4z"/>
                                    <path fill-rule="evenodd" d="M.458 10C1.732 5.943 5.522 3 10 3s8.268 2.943 9.542 7c-1.274 4.057-5.064 7-9.542 7S1.732 14.057.458 10zM14 10a4 4 0 11-8 0 4 4 0 018 0z" clip-rule="evenodd"/>
                                </svg>
                                <span>Website notifications and banners</span>
                            </div>
                            <div class="flex items-center">
                                <svg class="w-5 h-5 text-[#073a89] mr-3" fill="currentColor" viewBox="0 0 20 20">
                                    <path d="M2.003 5.884L10 9.882l7.997-3.998A2 2 0 0016 4H4a2 2 0 00-1.997 1.884z"/>
                                    <path d="M18 8.118l-8 4-8-4V14a2 2 0 002 2h12a2 2 0 002-2V8.118z"/>
                                </svg>
                                <span>Email notifications for registered users</span>
                            </div>
                            <div class="flex items-center">
                                <svg class="w-5 h-5 text-[#073a89] mr-3" fill="currentColor" viewBox="0 0 20 20">
                                    <path fill-rule="evenodd" d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7-4a1 1 0 11-2 0 1 1 0 012 0zM9 9a1 1 0 000 2v3a1 1 0 001 1h1a1 1 0 100-2v-3a1 1 0 00-1-1H9z" clip-rule="evenodd"/>
                                </svg>
                                <span>Updated date stamp on this page</span>
                            </div>
                            <div class="flex items-center">
                                <svg class="w-5 h-5 text-[#073a89] mr-3" fill="currentColor" viewBox="0 0 20 20">
                                    <path fill-rule="evenodd" d="M2 5a2 2 0 012-2h8a2 2 0 012 2v10a2 2 0 002 2H4a2 2 0 01-2-2V5zm3 1h6v4H5V6zm6 6H5v2h6v-2z" clip-rule="evenodd"/>
                                </svg>
                                <span>In-app notifications for mobile users</span>
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
        <div class="bg-white rounded-2xl shadow-lg p-8 md:p-12 text-center">
            <h2 class="text-3xl font-bold text-gray-900 mb-4">Questions About Our Privacy Policy?</h2>
            <p class="text-gray-600 mb-8 max-w-2xl mx-auto">
                If you have any questions about how we handle your data or want to exercise your privacy rights, our team is here to help.
            </p>
            <div class="flex flex-col sm:flex-row gap-4 justify-center">
                <a href="{{ route('user.contact') }}" 
                   class="px-8 py-3 rounded-lg font-semibold transition-all duration-300"
                   style="background: #073a89; color: white; hover:opacity-90;">
                    Contact Our Privacy Team
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
<style>
.policy-card {
    @apply bg-gray-50 rounded-xl p-6 border border-gray-200 hover:border-[#073a89] transition-all duration-300;
}

.policy-section {
    @apply transition-all duration-500;
}

.policy-section.active {
    @apply block;
}

.policy-tab {
    @apply cursor-pointer;
}

/* Smooth scrolling */
html {
    scroll-behavior: smooth;
}

/* Custom list styling */
ul.custom-list {
    @apply space-y-2;
}

ul.custom-list li {
    @apply flex items-start;
}

ul.custom-list li::before {
    content: "•";
    @apply text-[#073a89] font-bold mr-3 mt-0.5;
}
</style>
@endsection

@section('scripts')

@endsection

