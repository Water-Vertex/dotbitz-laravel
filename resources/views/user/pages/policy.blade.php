@extends('user.layouts.app')

@section('content')
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

/* Fix for content overflow */
.policy-content {
    overflow-x: hidden;
    width: 100%;
}

.policy-content img,
.policy-content table,
.policy-content iframe,
.policy-content video {
    max-width: 100%;
    height: auto;
}

.policy-content pre,
.policy-content code {
    white-space: pre-wrap;
    word-wrap: break-word;
    overflow-x: auto;
}

.policy-content table {
    display: block;
    overflow-x: auto;
    white-space: nowrap;
}

/* Mobile-specific fixes */
@media (max-width: 768px) {
    .policy-content .prose {
        font-size: 1rem;
        line-height: 1.6;
    }

    .policy-content .prose h1 {
        font-size: 1.5rem;
    }

    .policy-content .prose h2 {
        font-size: 1.25rem;
    }

    .policy-content .prose h3 {
        font-size: 1.125rem;
    }
}
</style>
<section class="bg-gradient-to-br from-[#073a89] to-[#0091b9] text-white py-16 relative">
    <div class="container mx-auto px-6">
        <!-- Breadcrumb -->
        <nav class="text-sm mb-6 opacity-90">
            <ol class="flex items-center space-x-2">
                <li>
                    <a href="/" class="hover:text-[#ffd500] transition">Home</a>
                </li>
                <li>/</li>
                <li class="text-[#ffd500] font-semibold">{{$policy->slug}}</li>
            </ol>
        </nav>

        <!-- Heading -->
        <h1 class="text-4xl md:text-5xl font-bold mb-4">
            {{$policy->title}}
        </h1>
        <!--<p class="max-w-2xl text-lg opacity-90">-->
        <!--    Your privacy is our priority. Learn how we collect, use, and protect your information.-->
        <!--</p>-->
    </div>

    <!-- Decorative blur -->
    <div class="absolute top-0 right-0 w-64 h-64 bg-[#ffd500] opacity-10 blur-3xl rounded-full"></div>
</section>

<section class="py-20 bg-white">
    <div class="container mx-auto px-4 sm:px-6 max-w-6xl">
        <!-- Policies Content -->
        <div class="policy-content overflow-hidden">
            <div class="prose prose-lg max-w-none break-words overflow-wrap-anywhere">
                {!! $policy->description !!}
            </div>
        </div>
    </div>
</section>

<!-- Contact Section -->
<section class="py-16 bg-gray-50">
    <div class="container mx-auto px-6 max-w-6xl">
        <div class="bg-white rounded-2xl shadow-lg p-8 md:p-12 text-center">
            <h2 class="text-3xl font-bold text-gray-900 mb-4">Questions About Our {{$policy->title}}?</h2>
            <p class="text-gray-600 mb-8 max-w-2xl mx-auto">
                If you have any questions about how we handle your data or want to exercise your privacy rights, our team is here to help.
            </p>
            <div class="flex flex-col sm:flex-row gap-4 justify-center">
                <a href="{{ route('user.contact') }}"
                   class="px-8 py-3 rounded-lg font-semibold transition-all duration-300"
                   style="background: #073a89; color: white; hover:opacity-90;">
                    Contact Our Team
                </a>
                <a href="mailto:info@dotbitz.com"
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

