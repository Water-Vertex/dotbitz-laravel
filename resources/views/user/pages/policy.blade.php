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
<div class="site-breadcrumb" style="background: url({{asset('assets/images/course-banner.png')}})">
    <div class="container">
        <h2 class="breadcrumb-title">{{$policy->title}}</h2>
        <ul class="breadcrumb-menu">
        <li><a href="{{ route('user.home') }}">Home</a></li>
        <li class="active">{{$policy->slug}}</li>
        </ul>
    </div>
</div>
<div class="privacy-area py-120">
    <div class="container">
        <div class="row">
            <div class="col">
                <div class="terms-content policy-content">
                    <h3>{{ $policy->title }}</h3>
                    <p class="prose prose-lg max-w-none break-words overflow-wrap-anywhere">
                        {!! $policy->description !!}
                    </p>
                </div>
            </div>
        </div>
    </div>
</div>

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

