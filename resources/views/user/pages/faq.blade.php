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
                <li class="text-[#ffd500] font-semibold">FAQs</li>
            </ol>
        </nav>

        <!-- Heading -->
        <h1 class="text-4xl md:text-5xl font-bold mb-4">
            Frequently Asked Questions
        </h1>
        <p class="max-w-2xl text-lg opacity-90">
            Everything you need to know about our programs, learning paths, and enrollment.
        </p>
    </div>

    <!-- Decorative blur -->
    <div class="absolute top-0 right-0 w-64 h-64 bg-[#ffd500] opacity-10 blur-3xl rounded-full"></div>
</section>

<section class="py-20 bg-gray-50">
    <div class="container mx-auto px-6 max-w-4xl">

        <!-- Section Title -->
        <div class="text-center mb-12">
            <span class="inline-block px-4 py-2 rounded-full text-sm font-semibold uppercase tracking-wider mb-4"
                  style="background: rgba(7, 58, 137, 0.1); color:#073a89;">
                FAQs
            </span>
            <h2 class="text-3xl md:text-4xl font-bold text-gray-900">
                Got Questions? We’ve Got Answers
            </h2>
        </div>

        <!-- Accordion -->
        <div class="space-y-6">

            <!-- Item -->
            <div class="bg-white rounded-2xl shadow-lg overflow-hidden">
                <button onclick="toggleFaq(1)"
                        class="w-full flex justify-between items-center p-6 text-left font-semibold text-lg text-gray-900">
                    What age groups can enroll in the program?
                    <span id="icon-1" class="text-[#073a89] text-xl">+</span>
                </button>
                <div id="faq-1" class="hidden px-6 pb-6 text-gray-600 leading-relaxed">
                    Our programs are designed for students aged **9 years and above**, including beginners and advanced learners.
                </div>
            </div>

            <!-- Item -->
            <div class="bg-white rounded-2xl shadow-lg overflow-hidden">
                <button onclick="toggleFaq(2)"
                        class="w-full flex justify-between items-center p-6 text-left font-semibold text-lg text-gray-900">
                    Do students need prior coding experience?
                    <span id="icon-2" class="text-[#073a89] text-xl">+</span>
                </button>
                <div id="faq-2" class="hidden px-6 pb-6 text-gray-600 leading-relaxed">
                    No prior experience is required. We start from basics and gradually move to advanced concepts.
                </div>
            </div>

            <!-- Item -->
            <div class="bg-white rounded-2xl shadow-lg overflow-hidden">
                <button onclick="toggleFaq(3)"
                        class="w-full flex justify-between items-center p-6 text-left font-semibold text-lg text-gray-900">
                    Is learning online or in-person?
                    <span id="icon-3" class="text-[#073a89] text-xl">+</span>
                </button>
                <div id="faq-3" class="hidden px-6 pb-6 text-gray-600 leading-relaxed">
                    We offer **interactive online sessions** with live instructors and real-time coding practice.
                </div>
            </div>

            <!-- Item -->
            <div class="bg-white rounded-2xl shadow-lg overflow-hidden">
                <button onclick="toggleFaq(4)"
                        class="w-full flex justify-between items-center p-6 text-left font-semibold text-lg text-gray-900">
                    Can I request a demo class?
                    <span id="icon-4" class="text-[#073a89] text-xl">+</span>
                </button>
                <div id="faq-4" class="hidden px-6 pb-6 text-gray-600 leading-relaxed">
                    Yes! You can request a demo class from our website to experience our teaching style.
                </div>
            </div>

        </div>
    </div>
</section>



@endsection

@section('scripts')
<script>
    function toggleFaq(id) {
        const content = document.getElementById('faq-' + id);
        const icon = document.getElementById('icon-' + id);

        if (content.classList.contains('hidden')) {
            content.classList.remove('hidden');
            icon.textContent = '−';
        } else {
            content.classList.add('hidden');
            icon.textContent = '+';
        }
    }
</script>

@endsection