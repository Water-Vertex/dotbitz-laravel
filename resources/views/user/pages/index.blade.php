 @extends('user.layouts.app')
 @section('styles')
     <!-- Swiper CSS -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.css">

<style>
/* Custom Swiper Styles */
.coursesSwiper {
    padding: 10px 0 50px 0 !important;
}

.swiper-slide {
    height: auto;
    padding: 10px 0;
}

.swiper-button-next:after,
.swiper-button-prev:after {
    font-size: 18px;
    font-weight: bold;
}

.swiper-pagination-bullet {
    width: 10px;
    height: 10px;
    background: #bae4f0;
    opacity: 1;
}

.swiper-pagination-bullet-active {
    background: #0091b9;
    transform: scale(1.2);
}


/* Mobile adjustments */
@media (max-width: 640px) {
    .coursesSwiper {
        padding: 10px 15px 40px 15px !important;
    }

    .swiper-slide {
        padding: 5px;
    }
}
</style>
 @endsection
 @section('content')
 <!-- Hero Section -->
   <section class="hero-course min-h-screen flex items-center relative overflow-hidden text-white">
    <div class="container mx-auto px-6 sm:px-8 lg:px-12 relative z-30 content-overlay">
        <div class="max-w-6xl mx-auto">
            <div class="grid grid-cols-1 lg:grid-cols-2 gap-12 items-center">
                <!-- LEFT COLUMN - staggered animations: fade up, one by one -->
                <div class="lg:pr-10 space-y-8">
                    <!-- badge: fade up, 200ms delay -->
                    <span data-aos="fade-up" data-aos-duration="800" data-aos-delay="0" class="inline-block px-4 py-2 rounded-full font-semibold text-sm tracking-wider uppercase bg-white/15 backdrop-blur-sm border border-white/20">
                        <i class="fas fa-code mr-2 text-yellow-400"></i>
                        Learn to Code
                    </span>

                    <!-- heading: fade up, 300ms delay -->
                    <h1 data-aos="fade-up" data-aos-duration="800" data-aos-delay="200" class="heading-xl">
                        <span class="text-white/95 drop-shadow-2xl">Empowering Future Innovators,</span><br>
                        <span class="bg-gradient-to-r from-yellow-300 via-amber-200 to-yellow-400 bg-clip-text text-transparent relative">
                            One Dot at a Time
                            <svg class="absolute -bottom-3 left-0 w-full" height="12" viewBox="0 0 200 12" fill="none" xmlns="http://www.w3.org/2000/svg">
                                <path d="M2 10C50 3 150 3 198 10" stroke="#FBBF24" stroke-width="4" stroke-linecap="round" stroke-dasharray="8 8"/>
                            </svg>
                        </span>
                    </h1>

                    <!-- description: fade up, 400ms delay -->
                    <div data-aos="fade-up" data-aos-duration="800" data-aos-delay="400" class="max-w-xl space-y-5">
                        <p class="text-xl text-white/90 leading-relaxed font-light drop-shadow">
                            <span class="font-bold text-amber-300 text-2xl">Project-based coding courses</span> — from game design to AI.
                        </p>
                    </div>

                    <!-- CTA: fade up, 600ms delay -->
                    <div data-aos="fade-up" data-aos-duration="800" data-aos-delay="600" class="flex flex-col sm:flex-row gap-6 pt-4">
                        <a href="https://portal.dotbitz.com/student/registration" target="_blank" class="px-6 sm:px-8 py-3 sm:py-4 rounded-xl font-bold text-base sm:text-lg text-gray-900 bg-white hover:bg-gray-100 transition-colors duration-300 flex items-center justify-center">
                            Enroll Now
                            <i class="fas fa-arrow-right ml-2"></i>
                        </a>
                    </div>
                </div>
                <!-- right column empty - bg image -->
            </div>
        </div>
    </div>
    <div class="absolute bottom-0 left-0 w-full h-24 bg-gradient-to-t from-[#073B8A] to-transparent z-20 pointer-events-none"></div>
</section>



<!-- ===== CAREER FOCUSED LEARNING SECTION - image left, content right ===== -->
<section class="py-16 md:py-20 bg-white relative overflow-hidden">
    <div class="absolute inset-0 opacity-20 pointer-events-none" style="background-image: repeating-linear-gradient(45deg, #bae4f0 0px, #bae4f0 1px, transparent 1px, transparent 24px);"></div>
    <div class="container mx-auto px-4 sm:px-6 lg:px-8 relative z-10">
        <div class="grid grid-cols-1 lg:grid-cols-2 gap-12 lg:gap-16 items-center">
            <!-- LEFT COLUMN: IMAGE - zoom in + fade -->
            <div data-aos="fade-right" data-aos-duration="1000" data-aos-delay="100" class="order-2 lg:order-1">
                <div class="relative">
                    <div class="relative">
                        <div class="aspect-[4/3] relative flex items-center justify-center">
                            <div class="relative">
                                <div class="absolute inset-0 bg-white/50 blur-3xl rounded-full"></div>
                                <img class="w-full h-full object-cover rounded-3xl shadow-xl border border-white/60"
                                     src="https://images.unsplash.com/photo-1498050108023-c5249f4df085?ixlib=rb-4.0.3&auto=format&fit=crop&w=2072&q=80"
                                     alt="Student coding"
                                     data-aos="zoom-in" data-aos-duration="900" data-aos-delay="200">
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- RIGHT COLUMN: CONTENT - sequential fade ups -->
            <div class="order-1 lg:order-2 space-y-7">
                <!-- badge -->
                <span data-aos="fade-up" data-aos-duration="800" data-aos-delay="100"
                      class="inline-flex items-center px-5 py-2.5 rounded-full font-semibold text-sm tracking-wider uppercase shadow-md bg-[#bae4f0] text-[#073a89] border border-[#0091b9]/20">
                    <i class="fas fa-user-graduate mr-2 text-[#0091b9]"></i>
                    AGES 9 TO ABOVE
                    <span class="ml-2 bg-white/60 px-2 py-0.5 rounded-full text-[10px] font-bold text-[#073a89]">lifelong</span>
                </span>

                <!-- title -->
                <div data-aos="fade-up" data-aos-duration="800" data-aos-delay="200">
                    <h2 class="text-3xl md:text-4xl lg:text-4xl font-bold leading-tight" style="color: #073a89;">
                        Career Focused Learning,
                        <span class="block text-[#ff6500] relative inline-flex items-center">
                            Not Just Coding
                            <span class="absolute -bottom-2 left-0 w-24 h-1 bg-[#ff6500]/40 rounded-full"></span>
                        </span>
                    </h2>
                </div>

                <!-- description paragraphs -->
                <div data-aos="fade-up" data-aos-duration="800" data-aos-delay="300" class="space-y-4 max-w-xl">
                    <p class="text-lg leading-relaxed" style="color: #1d1d1d; font-weight: 400;">
                        We go beyond teaching code. Starting from age 9, our students follow a structured learning path designed to build real career readiness.
                    </p>
                    <p class="text-lg leading-relaxed" style="color: #1d1d1d; font-weight: 400;">
                        With long-term mentorship, hands-on projects, and a focus on teamwork, communication, and professionalism, we prepare young learners with the skills they need for real-world success.
                    </p>
                </div>

                <!-- KEY POINTS GRID - each card animates with stagger -->
                <div class="grid grid-cols-1 sm:grid-cols-2 gap-5 pt-2">
                    <!-- Mentorship -->
                    <div data-aos="fade-up" data-aos-duration="600" data-aos-delay="350"
                         class="flex items-start space-x-2 p-2 rounded-2xl bg-white border border-[#bae4f0]/30 shadow-sm hover:shadow-md transition-all">
                        <div class="w-12 h-12 rounded-xl flex items-center justify-center flex-shrink-0 bg-[#bae4f0]/50">
                            <i class="fas fa-hands-helping text-xl" style="color: #0091b9;"></i>
                        </div>
                        <div>
                            <h4 class="font-bold text-lg mb-0.5" style="color: #073a89;">Mentorship</h4>
                            <p class="text-sm" style="color: #4a5568;">Long-term guidance</p>
                        </div>
                    </div>
                    <!-- Real Projects -->
                    <div data-aos="fade-up" data-aos-duration="600" data-aos-delay="400"
                         class="flex items-start space-x-2 p-2 rounded-2xl bg-white border border-[#bae4f0]/30 shadow-sm hover:shadow-md transition-all">
                        <div class="w-12 h-12 rounded-xl flex items-center justify-center flex-shrink-0 bg-[#bae4f0]/50">
                            <i class="fas fa-project-diagram text-xl" style="color: #0091b9;"></i>
                        </div>
                        <div>
                            <h4 class="font-bold text-lg mb-0.5" style="color: #073a89;">Real Projects</h4>
                            <p class="text-sm" style="color: #4a5568;">Hands-on experience</p>
                        </div>
                    </div>
                    <!-- Teamwork -->
                    <div data-aos="fade-up" data-aos-duration="600" data-aos-delay="450"
                         class="flex items-start space-x-2 p-2 rounded-2xl bg-white border border-[#bae4f0]/30 shadow-sm hover:shadow-md transition-all">
                        <div class="w-12 h-12 rounded-xl flex items-center justify-center flex-shrink-0 bg-[#bae4f0]/50">
                            <i class="fas fa-users text-xl" style="color: #0091b9;"></i>
                        </div>
                        <div>
                            <h4 class="font-bold text-lg mb-0.5" style="color: #073a89;">Teamwork</h4>
                            <p class="text-sm" style="color: #4a5568;">Collaborative learning</p>
                        </div>
                    </div>
                    <!-- Communication -->
                    <div data-aos="fade-up" data-aos-duration="600" data-aos-delay="500"
                         class="flex items-start space-x-2 p-2 rounded-2xl bg-white border border-[#bae4f0]/30 shadow-sm hover:shadow-md transition-all">
                        <div class="w-12 h-12 rounded-xl flex items-center justify-center flex-shrink-0 bg-[#bae4f0]/50">
                            <i class="fas fa-comments text-xl" style="color: #0091b9;"></i>
                        </div>
                        <div>
                            <h4 class="font-bold text-lg mb-0.5" style="color: #073a89;">Communication</h4>
                            <p class="text-sm" style="color: #4a5568;">Professional skills</p>
                        </div>
                    </div>
                </div>

                <!-- BUTTONS -->
                <div data-aos="fade-up" data-aos-duration="800" data-aos-delay="550" class="flex flex-col sm:flex-row gap-3 sm:gap-4">
                    <a href="https://portal.dotbitz.com/student/registration" class="font-medium px-4 py-2 rounded-lg text-white bg-[#FF6500] hover:bg-[#e55a00] transition-all">
                        Enroll Now
                    </a>
                    <a href="{{route('user.about')}}" class="font-medium px-4 py-2 rounded-lg text-black bg-transparent border border-[#FF6500] hover:bg-[#FF6500]/10 transition-all">
                        Learn More
                    </a>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- ===== COURSES SLIDER SECTION ===== -->
<section class="py-10 md:py-10 bg-gray-50 overflow-x-hidden">
    <div class="container mx-auto px-4 sm:px-6 lg:px-8">
        <!-- Section Header - animated -->
        <div data-aos="fade-down" data-aos-duration="800" class="text-center mb-12">
            <h2 class="text-3xl md:text-4xl font-bold mb-4" style="color: #073a89;">Learning Pathways</h2>
            <p class="text-lg max-w-2xl mx-auto" style="color: #1d1d1d;">Structured programs designed for different age groups and skill levels</p>
        </div>

        <!-- Swiper Container -->
        <div class="swiper coursesSwiper overflow-hidden">
            <div class="swiper-wrapper">
                @foreach($courses as $index => $course)
                <div class="swiper-slide" data-aos="fade-up" data-aos-duration="600" data-aos-delay="{{ $index * 100 }}">
                    <div class="group relative overflow-hidden rounded-xl bg-white shadow-md transition-all duration-300 hover:shadow-lg hover:-translate-y-1">
                        <span class="absolute left-3 top-3 z-10 rounded-full bg-indigo-600 px-3 py-1 text-xs font-semibold text-white">
                            {{$course->course_level}}
                        </span>
                        <div class="relative h-48 overflow-hidden">
                            <img src="{{asset('assets/images/courses/' . $course->thumbnail_image)}}" alt="{{$course->course_name}}" class="h-full w-full object-cover transition-transform duration-500 group-hover:scale-105">

                        </div>
                        <div class="p-5">
                            <a href=""><h3 class="mb-2 text-lg font-bold text-gray-900">{{$course->course_name}}</h3></a>
                            <p class="mb-4 text-sm text-gray-600 line-clamp-5">{{$course->short_description}}</p>
                            <div class="flex items-center justify-between border-t border-gray-100 pt-4">
                                <div class="flex items-center">
                                    <p class="font-bold text-xs md:text-sm" style="color: #073a89;">Age: 20-23 Yrs</p>
                                </div>
                                <div class="text-right">
                                    <button class="open-assessment-modal px-4 py-2 rounded-xl font-bold text-white bg-[#FF6500] hover:bg-[#e55a00] transition-all"
                                        data-course-id="{{ $course->id }}"
                                        data-course-name="{{ $course->course_name }}">
                                        <i class="fas fa-calendar-check mr-2"></i> Book Assessment
                                    </button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                @endforeach
            </div>
            <div class="swiper-button-next !hidden md:!flex"></div>
            <div class="swiper-button-prev !hidden md:!flex"></div>
            <div class="swiper-pagination !relative !bottom-0 mt-8 md:!hidden"></div>
        </div>
    </div>
</section>

<!-- ===== CORE VALUES - brutalist, collage style ===== -->
<section class="py-20 bg-white relative overflow-hidden">
    <div class="absolute inset-0">
        <div class="absolute top-0 right-0 w-1/3 h-full bg-[#FF6500]/5"></div>
        <div class="absolute bottom-0 left-0 w-1/4 h-1/2 bg-[#073a89]/5"></div>
        <div class="absolute top-1/2 left-1/3 w-40 h-40 border-8 border-[#FF6500]/10 rounded-full"></div>
        <div class="absolute bottom-10 right-10 w-60 h-60 border-[20px] border-[#073a89]/5 rounded-full"></div>
    </div>
    <div class="container mx-auto px-4 sm:px-6 lg:px-8 relative z-10">
        <!-- HEADER - brutalist, sequential animations -->
        <div class="max-w-5xl mx-auto mb-20">
            <div class="flex flex-col md:flex-row md:items-end justify-between gap-6">
                <div class="relative">
                    <span data-aos="fade-right" data-aos-duration="800" data-aos-delay="0"
                          class="relative inline-block px-6 py-2 bg-[#FF6500] text-white font-bold text-sm tracking-[.25em] uppercase -rotate-1 mb-4">
                        Our Core Value
                        <span class="absolute -top-1 -right-1 w-2 h-2 bg-white"></span>
                        <span class="absolute -bottom-1 -left-1 w-2 h-2 bg-white"></span>
                    </span>
                    <h2 data-aos="fade-up" data-aos-duration="900" data-aos-delay="100"
                        class="text-7xl md:text-8xl lg:text-9xl font-black text-[#073a89] leading-none tracking-[-0.05em] uppercase">
                        LEARN
                        <span class="block text-[#FF6500] text-6xl md:text-7xl lg:text-8xl mt-2">BUILD</span>
                        <span class="block text-7xl md:text-8xl lg:text-9xl mt-2">GROW</span>
                    </h2>
                </div>
                <div data-aos="fade-left" data-aos-duration="800" data-aos-delay="200" class="md:text-right md:max-w-xs">
                    <p class="text-2xl md:text-3xl font-black text-[#1d1d1d] uppercase leading-tight mb-2">
                        Coding Fun,<br>Future Ready Tomorrow
                    </p>
                    <div class="h-1 w-24 bg-[#FF6500] ml-auto md:ml-auto mt-4"></div>
                </div>
            </div>
            <div data-aos="fade-up" data-aos-duration="800" data-aos-delay="250" class="mt-12 border-l-8 border-[#FF6500] pl-6 py-2 bg-white/80 backdrop-blur-sm max-w-3xl">
                <p class="text-xl md:text-2xl font-medium text-[#1d1d1d] italic">
                    "We make learning to code creative, practical, and career-ready. Here's how we bring it to life:"
                </p>
            </div>
        </div>

        <!-- VALUES GRID - each value with unique animation -->
        <div class="max-w-7xl mx-auto">
            <!-- Value 1 -->
            <div data-aos="fade-right" data-aos-duration="900" data-aos-delay="100" class="relative mb-12 last:mb-0">
                <div class="absolute -left-4 top-0 w-32 h-full bg-[#FF6500]/10 -z-10"></div>
                <div class="grid grid-cols-1 md:grid-cols-12 gap-6 items-start">
                    <div class="md:col-span-2">
                        <span class="text-8xl md:text-9xl font-black text-[#FF6500]/20 select-none">01</span>
                    </div>
                    <div class="md:col-span-10">
                        <div class="flex flex-col md:flex-row gap-8">
                            <div class="md:w-1/3">
                                <h3 class="text-3xl md:text-4xl font-black text-[#073a89] uppercase leading-tight tracking-tight">PERSONALIZED<br>LEARNING</h3>
                                <div class="w-full h-1 bg-[#FF6500] mt-4"></div>
                            </div>
                            <div class="md:w-2/3">
                                <p class="text-xl text-[#1d1d1d] leading-relaxed font-medium">We assess each student's age, interests, and skill level to create a customized, age-appropriate learning path.</p>
                                <div class="flex items-center gap-3 mt-6">
                                    <span class="w-3 h-3 bg-[#FF6500] rotate-45"></span>
                                    <span class="text-sm font-bold text-[#073a89] uppercase tracking-wider">individual approach</span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- Value 2 -->
            <div data-aos="fade-left" data-aos-duration="900" data-aos-delay="200" class="relative mb-12 last:mb-0">
                <div class="absolute -right-4 top-0 w-40 h-full bg-[#073a89]/10 -z-10"></div>
                <div class="grid grid-cols-1 md:grid-cols-12 gap-6 items-start">
                    <div class="md:col-span-2 order-2 md:order-1">
                        <span class="text-8xl md:text-9xl font-black text-[#073a89]/20 select-none">02</span>
                    </div>
                    <div class="md:col-span-10 order-1 md:order-2">
                        <div class="flex flex-col md:flex-row gap-8 md:text-right">
                            <div class="md:w-1/3 md:order-2">
                                <h3 class="text-3xl md:text-4xl font-black text-[#073a89] uppercase leading-tight tracking-tight">SKILL GROWTH<br>& CAREER READINESS</h3>
                                <div class="w-full h-1 bg-[#FF6500] mt-4 md:ml-auto"></div>
                            </div>
                            <div class="md:w-2/3 md:order-1">
                                <p class="text-xl text-[#1d1d1d] leading-relaxed font-medium">We focus on building both technical and professional skills, preparing students for future education and tech careers.</p>
                                <div class="flex items-center gap-3 mt-6 md:justify-end">
                                    <span class="text-sm font-bold text-[#073a89] uppercase tracking-wider">future proof</span>
                                    <span class="w-3 h-3 bg-[#073a89] rotate-45"></span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- Value 3 -->
            <div data-aos="zoom-in" data-aos-duration="900" data-aos-delay="150" class="relative mb-12 last:mb-0">
                <div class="absolute -left-6 top-1/2 -translate-y-1/2 w-20 h-20 bg-[#FF6500] rotate-12 -z-10"></div>
                <div class="grid grid-cols-1 md:grid-cols-12 gap-6 items-start">
                    <div class="md:col-span-2">
                        <span class="text-8xl md:text-9xl font-black text-[#FF6500]/20 select-none">03</span>
                    </div>
                    <div class="md:col-span-10">
                        <div class="flex flex-col md:flex-row gap-8 bg-white p-8 -rotate-[0.5deg] hover:rotate-0 transition-transform duration-300 shadow-[8px_8px_0_0_rgba(255,101,0,0.2)]">
                            <div class="md:w-1/3">
                                <h3 class="text-3xl md:text-4xl font-black text-[#073a89] uppercase leading-tight tracking-tight">ACTIVE, HANDS-ON<br>EXPERIENCE</h3>
                                <div class="w-12 h-1 bg-[#FF6500] mt-4"></div>
                            </div>
                            <div class="md:w-2/3">
                                <p class="text-xl text-[#1d1d1d] leading-relaxed font-medium">Students learn through interactive live sessions, hands-on projects, and real-world challenges, making coding fun and practical.</p>
                                <div class="flex items-center gap-4 mt-6">
                                    <span class="px-4 py-2 bg-[#073a89] text-white text-xs font-bold uppercase tracking-wider">live sessions</span>
                                    <span class="px-4 py-2 border-2 border-[#FF6500] text-[#FF6500] text-xs font-bold uppercase">projects</span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- Value 4 -->
            <div data-aos="fade-up" data-aos-duration="900" data-aos-delay="250" class="relative mt-16">
                <div class="grid grid-cols-1 md:grid-cols-12 gap-6 items-center">
                    <div class="md:col-span-2">
                        <span class="text-8xl md:text-9xl font-black text-[#073a89]/20 select-none">04</span>
                    </div>
                    <div class="md:col-span-10">
                        <div class="border-t-4 border-b-4 border-[#073a89] py-8">
                            <div class="flex flex-col md:flex-row gap-8 items-center">
                                <div class="md:w-2/5">
                                    <h3 class="text-3xl md:text-4xl font-black text-[#073a89] uppercase leading-tight tracking-tight">SAFE & SUPPORTIVE ENVIRONMENT</h3>
                                </div>
                                <div class="md:w-3/5">
                                    <p class="text-xl text-[#1d1d1d] leading-relaxed font-medium">Our programs provide a mentorship-driven, structured, and supportive space where students can explore, ask questions, and grow confidently.</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div data-aos="zoom-in-left" data-aos-duration="800" data-aos-delay="300" class="mt-20 flex justify-end">
            <div class="inline-block border-4 border-[#FF6500] px-8 py-4 rotate-1">
                <span class="text-[#073a89] font-black text-xl uppercase tracking-[.25em]">dotbitz · since 2018</span>
            </div>
        </div>
    </div>
</section>

<!-- ===== WHAT MAKES DOTBITZ DIFFERENT ===== -->
<section class="py-10 md:py-10 bg-gray-50">
    <div class="container mx-auto px-4 sm:px-6 lg:px-8">
        <div data-aos="fade-down" data-aos-duration="800" class="text-center max-w-3xl mx-auto mb-16">
            <h1 class="text-lg font-bold mb-2 text-[#ff6500]">What Makes DotBitz Different</h1>
            <h2 class="text-5xl md:text-5xl font-bold mb-4 text-[#073a89]">LEARNING PROGRESSION</h2>
            <h3 class="text-xl font-medium mb-8" style="color: #0091b9;">From Beginner to Career-Ready</h3>
        </div>
        <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
            <!-- Junior Level -->
            <div data-aos="flip-left" data-aos-duration="700" data-aos-delay="100" class="bg-white rounded-2xl p-8 border border-gray-200 hover:shadow-xl transition-all">
                <div class="mb-6">
                    <div class="flex items-center mb-4">
                        <div class="w-12 h-12 rounded-xl flex items-center justify-center mr-4 bg-[#bae4f0]">
                            <span class="text-xl font-bold text-[#073a89]">1</span>
                        </div>
                        <div>
                            <h3 class="text-xl font-bold text-[#073a89]">Our Junior Level</h3>
                            <p class="font-medium text-[#ff6500]">Build Your First Web Projects</p>
                        </div>
                    </div>
                </div>
                <div class="space-y-4">
                    <p class="text-gray-700">Our junior teams craft interactive and web-based projects like games, apps, and websites, using HTML, CSS, JavaScript and design. They gain hands-on experience in basic coding, problem-solving, and project presentation, building confidence in their first steps in programming.</p>
                </div>
            </div>
            <!-- Mid Level -->
            <div data-aos="flip-up" data-aos-duration="700" data-aos-delay="200" class="bg-white rounded-2xl p-8 border border-gray-200 hover:shadow-xl transition-all">
                <div class="mb-6">
                    <div class="flex items-center mb-4">
                        <div class="w-12 h-12 rounded-xl flex items-center justify-center mr-4 bg-[#bae4f0]">
                            <span class="text-xl font-bold text-[#073a89]">2</span>
                        </div>
                        <div>
                            <h3 class="text-xl font-bold text-[#073a89]">Our Mid Level</h3>
                            <p class="font-medium text-[#ff6500]">End-to-End Applications</p>
                        </div>
                    </div>
                </div>
                <div class="space-y-4">
                    <p class="text-gray-700">At the mid-level, students create complete applications with frontend and backend functionality, incorporating Python, Java, Git, REST APIs, and debugging techniques. They learn online collaboration, teamwork, and real-world development practices, preparing them for more complex projects.</p>
                </div>
            </div>
            <!-- Senior Level -->
            <div data-aos="flip-right" data-aos-duration="700" data-aos-delay="300" class="bg-white rounded-2xl p-8 border border-gray-200 hover:shadow-xl transition-all">
                <div class="mb-6">
                    <div class="flex items-center mb-4">
                        <div class="w-12 h-12 rounded-xl flex items-center justify-center mr-4 bg-[#bae4f0]">
                            <span class="text-xl font-bold text-[#073a89]">3</span>
                        </div>
                        <div>
                            <h3 class="text-xl font-bold text-[#073a89]">Our Senior Level</h3>
                            <p class="font-medium text-[#ff6500]">Career Ready Developers</p>
                        </div>
                    </div>
                </div>
                <div class="space-y-4">
                    <p class="text-gray-700">Senior learners tackle real-world and portfolio projects within professional teams. They master advanced programming languages, database integration, mobile-app development, game development, and agile workflows, while building portfolio projects that meet industry standards, making them fully prepared for internships, freelance work, or high-tech careers.</p>
                </div>
            </div>
        </div>
    </div>
</section>
 @endsection
 @section('scripts')
      <!-- Swiper JS -->
    <script src="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.js"></script>
    <script>
    document.addEventListener('DOMContentLoaded', function() {
        // Initialize Swiper
        const coursesSwiper = new Swiper('.coursesSwiper', {
            // Optional parameters
            slidesPerView: 1,
            spaceBetween: 20,
            loop: true,
            autoplay: {
                delay: 5000,
                disableOnInteraction: false,
            },

            // Responsive breakpoints
            breakpoints: {
                640: {
                    slidesPerView: 1,
                    spaceBetween: 20
                },
                768: {
                    slidesPerView: 2,
                    spaceBetween: 30
                },
                1024: {
                    slidesPerView: 3,
                    spaceBetween: 30
                }
            },

            // If we need pagination
            pagination: {
                el: '.swiper-pagination',
                clickable: true,
                dynamicBullets: true,
            },

            // Navigation arrows
            navigation: {
                nextEl: '.swiper-button-next',
                prevEl: '.swiper-button-prev',
            },
        });
    });
</script>
 @endsection
