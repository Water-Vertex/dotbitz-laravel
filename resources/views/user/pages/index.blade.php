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

/* For line clamping */
.line-clamp-3 {
    display: -webkit-box;
    -webkit-line-clamp: 3;
    -webkit-box-orient: vertical;
    overflow: hidden;
}

.line-clamp-4 {
    display: -webkit-box;
    -webkit-line-clamp: 4;
    -webkit-box-orient: vertical;
    overflow: hidden;
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
      <section class="hero-section text-white min-h-screen flex items-center relative">
    <div class="container mx-auto px-4 sm:px-6 lg:px-8 relative z-10">
        <div class="max-w-5xl mx-auto">
            <div class="grid grid-cols-1 lg:grid-cols-2 gap-8 lg:gap-12 items-center">
                <!-- Left Column: Text Content -->
                <div class="order-1 lg:order-1 mt-8 lg:mt-0">
                    <!-- Sub Heading -->
                    <div class="mb-6">
                        <span class="inline-block px-4 py-2 rounded-full font-semibold text-sm tracking-wider uppercase bg-white/15 backdrop-blur-sm border border-white/20">
                            <i class="fas fa-code mr-2 text-yellow-400"></i>
                            Learn to Code
                        </span>
                    </div>

                    <!-- Main Heading -->
                    <h1 class="text-3xl sm:text-4xl md:text-5xl lg:text-5xl font-bold mb-4 lg:mb-6 leading-tight">
                        Empowering Future Innovators,
                        <span class="block mt-2 text-yellow-400">One Dot at a Time</span>
                    </h1>

                    <!-- Paragraph -->
                    <p class="text-lg sm:text-xl mb-6 lg:mb-8 opacity-90 max-w-2xl">
                        Ages from 9 to above
                    </p>

                    <!-- CTA Buttons -->
                    <div class="flex flex-col sm:flex-row gap-3 sm:gap-4 mb-8 lg:mb-12">
                        <button class="cta-button px-6 sm:px-8 py-3 sm:py-4 rounded-xl font-bold text-base sm:text-lg text-gray-900 bg-white hover:bg-gray-100 transition-colors duration-300 flex items-center justify-center">
                            Enroll Now
                            <i class="fas fa-arrow-right ml-2"></i>
                        </button>
                        <button class="px-6 sm:px-8 py-3 sm:py-4 rounded-xl font-bold text-base sm:text-lg border-2 border-white hover:bg-white hover:text-blue-900 transition-all duration-300 flex items-center justify-center">
                            Request a Demo
                        </button>
                    </div>
                </div>

                <!-- Right Column: Illustration/Image -->
                <div class="order-2 lg:order-2 relative">
                    <div class="relative">
                        <!-- Main Illustration Container -->
                        <div class="relative bg-gradient-to-br from-cyan-600 to-blue-900 rounded-3xl p-4 sm:p-6 lg:p-8 shadow-2xl">
                            <!-- Floating Code Elements -->
                            <div class="absolute -top-3 sm:-top-4 -left-3 sm:-left-4 w-16 h-16 sm:w-20 sm:h-20 bg-orange-500 rounded-2xl flex items-center justify-center transform -rotate-12">
                                <i class="fas fa-laptop-code text-2xl sm:text-3xl text-white"></i>
                            </div>
                            <div class="absolute -bottom-3 sm:-bottom-4 -right-3 sm:-right-4 w-14 h-14 sm:w-16 sm:h-16 bg-yellow-400 rounded-2xl flex items-center justify-center transform rotate-12">
                                <i class="fas fa-robot text-xl sm:text-2xl text-gray-900"></i>
                            </div>

                            <!-- Hero Image Placeholder -->
                            <div class="bg-gradient-to-b from-transparent to-white/10 rounded-2xl overflow-hidden">
                                <div class="aspect-video bg-gradient-to-r from-cyan-100 to-cyan-600 rounded-2xl flex items-center justify-center">
                                    <!-- You can replace this with your actual image -->
                                    <div class="text-center p-4 sm:p-6 lg:p-8">
                                        <div class="text-4xl sm:text-5xl lg:text-6xl mb-3 sm:mb-4 text-blue-900">
                                            { }
                                        </div>
                                        <h3 class="text-lg sm:text-xl lg:text-2xl font-bold mb-1 sm:mb-2">Interactive Learning</h3>
                                        <p class="text-sm sm:text-base opacity-80">From beginner to advanced levels</p>
                                    </div>
                                </div>
                            </div>

                            <!-- Floating Badge -->
                            <div class="absolute -bottom-4 lg:-bottom-6 left-1/2 transform -translate-x-1/2 bg-white text-gray-900 px-4 sm:px-5 lg:px-6 py-2 sm:py-3 rounded-full font-bold shadow-lg text-xs sm:text-sm">
                                <i class="fas fa-medal mr-1 sm:mr-2 text-orange-500"></i>
                                Recommended by Educators
                            </div>
                        </div>
                    </div>

                    <!-- Floating Elements Around -->
                    <div class="absolute -z-10 top-4 sm:top-10 -right-4 sm:-right-10 w-32 h-32 sm:w-40 sm:h-40 bg-gradient-to-r from-orange-500 to-yellow-400 rounded-full opacity-20 blur-2xl sm:blur-3xl"></div>
                    <div class="absolute -z-10 bottom-4 sm:bottom-10 -left-4 sm:-left-10 w-48 h-48 sm:w-60 sm:h-60 bg-gradient-to-r from-cyan-600 to-blue-900 rounded-full opacity-10 blur-2xl sm:blur-3xl"></div>
                </div>
            </div>
        </div>
    </div>
</section>
      <!-- Career Focused Learning Section -->
      <section class="py-10 md:py-10 bg-white">
          <div class="container mx-auto px-4 sm:px-6 lg:px-8">
              <div class="grid grid-cols-1 lg:grid-cols-2 gap-12 items-center">
                  <!-- Left Column: Image -->
                  <div class="order-2 lg:order-1">
                      <div class="relative">
                          <!-- Main Image Container -->
                          <div class="rounded-3xl overflow-hidden shadow-2xl">
                              <div class="aspect-[4/3] bg-gradient-to-br from-[#bae4f0] to-[#0091b9] flex items-center justify-center">
                                  <!-- Replace with your actual image -->
                                  <div class="text-center p-8">
                                      <div class="text-5xl mb-4" style="color: #073a89;">
                                          <i class="fas fa-graduation-cap"></i>
                                      </div>
                                      <h3 class="text-xl font-bold mb-2" style="color: #073a89;">Career Ready Skills</h3>
                                      <p class="opacity-80" style="color: #073a89;">From Classroom to Career</p>
                                  </div>
                              </div>
                          </div>
                      </div>
                  </div>

                  <!-- Right Column: Content -->
                  <div class="order-1 lg:order-2">
                      <!-- Sub Title -->
                      <div class="mb-4">
                          <span class="inline-flex items-center px-4 py-2 rounded-full font-semibold text-sm tracking-wider uppercase"
                                style="background-color: #bae4f0; color: #073a89;">
                              <i class="fas fa-user-graduate mr-2"></i>
                              AGES 9 TO ABOVE
                          </span>
                      </div>

                      <!-- Title -->
                      <h2 class="text-3xl md:text-4xl lg:text-5xl font-bold mb-6 leading-tight" style="color: #073a89;">
                          Career Focused Learning,
                          <span class="block" style="color: #ff6500;">Not Just Coding</span>
                      </h2>

                      <!-- Paragraph -->
                      <div class="space-y-4 mb-8">
                          <p class="text-lg" style="color: #1d1d1d;">
                              We go beyond teaching code. Starting from age 9, our students follow a structured learning path designed to build real career readiness.
                          </p>
                          <p class="text-lg" style="color: #1d1d1d;">
                              With long-term mentorship, hands-on projects, and a focus on teamwork, communication, and professionalism, we prepare young learners with the skills they need for real-world success.
                          </p>
                      </div>

                      <!-- Key Points -->
                      <div class="grid grid-cols-1 sm:grid-cols-2 gap-4 mb-10">
                          <div class="flex items-start space-x-3">
                              <div class="w-10 h-10 rounded-lg flex items-center justify-center flex-shrink-0" style="background-color: #bae4f0;">
                                  <i class="fas fa-hands-helping" style="color: #0091b9;"></i>
                              </div>
                              <div>
                                  <h4 class="font-bold mb-1" style="color: #073a89;">Mentorship</h4>
                                  <p class="text-sm" style="color: #1d1d1d;">Long-term guidance</p>
                              </div>
                          </div>

                          <div class="flex items-start space-x-3">
                              <div class="w-10 h-10 rounded-lg flex items-center justify-center flex-shrink-0" style="background-color: #bae4f0;">
                                  <i class="fas fa-project-diagram" style="color: #0091b9;"></i>
                              </div>
                              <div>
                                  <h4 class="font-bold mb-1" style="color: #073a89;">Real Projects</h4>
                                  <p class="text-sm" style="color: #1d1d1d;">Hands-on experience</p>
                              </div>
                          </div>

                          <div class="flex items-start space-x-3">
                              <div class="w-10 h-10 rounded-lg flex items-center justify-center flex-shrink-0" style="background-color: #bae4f0;">
                                  <i class="fas fa-users" style="color: #0091b9;"></i>
                              </div>
                              <div>
                                  <h4 class="font-bold mb-1" style="color: #073a89;">Teamwork</h4>
                                  <p class="text-sm" style="color: #1d1d1d;">Collaborative learning</p>
                              </div>
                          </div>

                          <div class="flex items-start space-x-3">
                              <div class="w-10 h-10 rounded-lg flex items-center justify-center flex-shrink-0" style="background-color: #bae4f0;">
                                  <i class="fas fa-comments" style="color: #0091b9;"></i>
                              </div>
                              <div>
                                  <h4 class="font-bold mb-1" style="color: #073a89;">Communication</h4>
                                  <p class="text-sm" style="color: #1d1d1d;">Professional skills</p>
                              </div>
                          </div>
                      </div>

                      <!-- Enroll Now Button -->
                      <button class="px-8 py-4 rounded-xl font-bold text-lg text-white transition-all duration-300 hover:transform hover:-translate-y-1"
                              style="background: #FF6500; box-shadow: 0 10px 25px rgba(255, 101, 0, 0.3);">
                          <i class="fas fa-user-plus mr-2 text-white"></i>
                          Enroll Now
                      </button>
                  </div>
              </div>
          </div>
      </section>
      <!-- Courses Slider Section -->
        <section class="py-10 md:py-10 bg-gray-50">
            <div class="container mx-auto px-4 sm:px-6 lg:px-8">
                <!-- Section Header -->
                <div class="text-center mb-12">
                    <h2 class="text-3xl md:text-4xl font-bold mb-4" style="color: #073a89;">Learning Pathways</h2>
                    <p class="text-lg max-w-2xl mx-auto" style="color: #1d1d1d;">Structured programs designed for different age groups and skill levels</p>
                </div>

                <!-- Swiper Container -->
                <div class="swiper coursesSwiper !overflow-visible">
                    <div class="swiper-wrapper">
                        @foreach($courses as $course)
                        <div class="swiper-slide">
                            <div class="bg-white rounded-3xl shadow-xl overflow-hidden transition-all duration-300 hover:shadow-2xl hover:-translate-y-2 h-full">
                                <!-- Course Image -->
                                <div class="relative h-56 overflow-hidden">
                                    <img src="{{asset('assets/images/courses/'. $course->thumbnail_image)}}"
                                        alt="Kids learning coding"
                                        class="w-full h-full object-cover">
                                    <!-- Level Badge -->
                                    <div class="absolute top-4 left-4">
                                        <span class="inline-block px-4 py-2 rounded-full text-sm font-semibold text-white"
                                            style="background: rgba(7, 58, 137, 0.9);">
                                            <i class="fas fa-star mr-2"></i>
                                            {{$course->course_level}}
                                        </span>
                                    </div>
                                </div>

                                <!-- Card Content -->
                                <div class="p-6 md:p-8 flex flex-col h-[calc(100%-14rem)]">
                                    <!-- Course Name -->
                                    <div class="mb-4">
                                       <a href="{{route('user.course.details',$course->slug)}}"> <h3 class="text-xl md:text-2xl font-bold" style="color: #073a89;">{{$course->course_name}}</h3></a>

                                    </div>

                                    <!-- Paragraph -->
                                    <p class="text-gray-700 mb-6 text-sm md:text-base flex-grow line-clamp-3 md:line-clamp-4">
                                        {{$course->course_description}}
                                    </p>

                                    <!-- Age and Button in Same Row -->
                                    <div class="flex flex-col sm:flex-row items-start sm:items-center justify-between gap-4 mt-auto pt-4">
                                        <!-- Age Section -->
                                        <div class="w-full sm:w-auto">
                                            <div class="flex items-center p-3 rounded-lg" style="background-color: #bae4f0;">
                                                <div>
                                                    <p class="font-bold text-xs md:text-sm" style="color: #073a89;">Age: {{$course->age_limit}} Yrs</p>
                                                </div>
                                            </div>
                                        </div>

                                        <!-- Book Assessment Button -->
                                        <button class="px-4 py-2 md:px-6 md:py-3 rounded-xl font-bold text-white whitespace-nowrap transition-all duration-300 hover:scale-105 text-sm md:text-base w-full sm:w-auto"
                                                style="background: #FF6500">
                                            <i class="fas fa-calendar-check mr-2"></i>
                                            Book Assessment
                                        </button>
                                    </div>
                                </div>
                            </div>
                        </div>
                        @endforeach
                    </div>

                    <!-- Navigation buttons -->
                    <div class="swiper-button-next !hidden md:!flex" style="color: #0091b9; background: white; width: 48px; height: 48px; border-radius: 50%; box-shadow: 0 4px 12px rgba(0,0,0,0.1);"></div>
                    <div class="swiper-button-prev !hidden md:!flex" style="color: #0091b9; background: white; width: 48px; height: 48px; border-radius: 50%; box-shadow: 0 4px 12px rgba(0,0,0,0.1);"></div>

                    <!-- Pagination dots -->
                    <div class="swiper-pagination !relative !bottom-0 mt-8 md:!hidden"></div>
                </div>
            </div>
        </section>




      <!-- Core Values Section - Exact Image Design -->
      <section class="py-10 md:py-10 bg-white">
          <div class="container mx-auto px-4 sm:px-6 lg:px-8">
              <!-- Top Content Section -->
              <div class=" mb-12">
                  <!-- Small Subheading -->
                  <p class="text-lg font-bold tracking-wider uppercase text-[#FF6500]" style="">
                      Our Core Value
                  </p>

                  <!-- Main Large Heading -->
                  <h2 class="text-4xl md:text-5xl font-bold mb-3" style="color: #073a89;">
                      LEARN, BUILD, GROW
                  </h2>

                  <!-- Subheading -->
                  <p class="text-xl font-medium mb-3" style="color: #1d1d1d;">
                      Coding Fun, Future Ready Tomorrow
                  </p>

                  <!-- Description -->
                  <p class="text-lg" style="color: #1d1d1d;">
                      We make learning to code creative, practical, and career-ready. Here's how we bring it to life:
                  </p>
              </div>

              <!-- Values Grid -->
              <div class="grid grid-cols-1 md:grid-cols-2 gap-8">

                  <!-- Value 1 -->
                  <div class="flex items-start space-x-6 p-6 bg-white rounded-2xl border" style="border-color: #e5e7eb;">
                      <!-- Number -->
                      <div class="flex-shrink-0">
                          <div class="w-16 h-16 rounded-2xl flex items-center justify-center text-2xl font-bold text-white bg-[#FF6500]"
                              >
                              01
                          </div>
                      </div>

                      <!-- Content -->
                      <div>
                          <h3 class="text-xl font-bold mb-3" style="color: #073a89;">
                              PERSONALIZED LEARNING
                          </h3>
                          <p class="text-gray-700" style="color: #1d1d1d;">
                              We assess each student's age, interests, and skill level to create a customized,
                              age-appropriate learning path.
                          </p>
                      </div>
                  </div>

                  <!-- Value 2 -->
                  <div class="flex items-start space-x-6 p-6 bg-white rounded-2xl border" style="border-color: #e5e7eb;">
                      <!-- Number -->
                      <div class="flex-shrink-0">
                          <div class="w-16 h-16 rounded-2xl flex items-center justify-center text-2xl font-bold text-white bg-[#FF6500]">
                              02
                          </div>
                      </div>

                      <!-- Content -->
                      <div>
                          <h3 class="text-xl font-bold mb-3" style="color: #073a89;">
                              SKILL GROWTH & CAREER READINESS
                          </h3>
                          <p class="text-gray-700" style="color: #1d1d1d;">
                              We focus on building both technical and professional skills, preparing students
                              for future education and tech careers.
                          </p>
                      </div>
                  </div>

                  <!-- Value 3 -->
                  <div class="flex items-start space-x-6 p-6 bg-white rounded-2xl border" style="border-color: #e5e7eb;">
                      <!-- Number -->
                      <div class="flex-shrink-0">
                          <div class="w-16 h-16 rounded-2xl flex items-center justify-center text-2xl font-bold text-white bg-[#FF6500]">
                              03
                          </div>
                      </div>

                      <!-- Content -->
                      <div>
                          <h3 class="text-xl font-bold mb-3" style="color: #073a89;">
                              ACTIVE, HANDS-ON EXPERIENCE
                          </h3>
                          <p class="text-gray-700" style="color: #1d1d1d;">
                              Students learn through interactive live sessions, hands-on projects, and real-world
                              challenges, making coding fun and practical.
                          </p>
                      </div>
                  </div>

                  <!-- Value 4 -->
                  <div class="flex items-start space-x-6 p-6 bg-white rounded-2xl border" style="border-color: #e5e7eb;">
                      <!-- Number -->
                      <div class="flex-shrink-0">
                          <div class="w-16 h-16 rounded-2xl flex items-center justify-center text-2xl font-bold text-white bg-[#FF6500]">
                              04
                          </div>
                      </div>

                      <!-- Content -->
                      <div>
                          <h3 class="text-xl font-bold mb-3" style="color: #073a89;">
                              SAFE & SUPPORTIVE ENVIRONMENT
                          </h3>
                          <p class="text-gray-700" style="color: #1d1d1d;">
                              Our programs provide a mentorship-driven, structured, and supportive space where
                              students can explore, ask questions, and grow confidently.
                          </p>
                      </div>
                  </div>
              </div>

          </div>
      </section>
      <!-- What Makes DotBitz Different Section -->
      <section class="py-10 md:py-10 bg-gray-50">
          <div class="container mx-auto px-4 sm:px-6 lg:px-8">
              <!-- Top Content -->
              <div class=" text-center max-w-3xl mx-auto mb-16">
                  <!-- Main Heading -->
                  <h1 class="text-lg font-bold mb-2 text-[#ff6500]">
                      What Makes DotBitz Different
                  </h1>

                  <!-- Sub Heading -->
                  <h2 class="text-5xl md:text-5xl font-bold mb-4 text-[#073a89]">
                      LEARNING PROGRESSION
                  </h2>

                  <!-- Sub Sub Heading -->
                  <h3 class="text-xl font-medium mb-8" style="color: #0091b9;">
                      From Beginner to Career-Ready
                  </h3>
              </div>

              <!-- Levels Grid -->
              <div class="grid grid-cols-1 md:grid-cols-3 gap-8">

                  <!-- Junior Level Card -->
                  <div class="bg-white rounded-2xl p-8 border" style="border-color: #e5e7eb;">
                      <!-- Level Header -->
                      <div class="mb-6">
                          <div class="flex items-center mb-4">
                              <div class="w-12 h-12 rounded-xl flex items-center justify-center mr-4"
                                  style="background-color: #bae4f0;">
                                  <span class="text-xl font-bold" style="color: #073a89;">1</span>
                              </div>
                              <div>
                                  <h3 class="text-xl font-bold" style="color: #073a89;">Our Junior Level</h3>
                                  <p class="font-medium" style="color: #ff6500;">Build Your First Web Projects</p>
                              </div>
                          </div>
                      </div>

                      <!-- Content -->
                      <div class="space-y-4">
                          <p class="text-gray-700" style="color: #1d1d1d;">
                              Our junior teams craft interactive and web-based projects like games, apps, and websites,
                              using HTML, CSS, JavaScript and design. They gain hands-on experience in basic coding,
                              problem-solving, and project presentation, building confidence in their first steps in programming.
                          </p>
                      </div>
                  </div>

                  <!-- Mid Level Card -->
                  <div class="bg-white rounded-2xl p-8 border" style="border-color: #e5e7eb;">
                      <!-- Level Header -->
                      <div class="mb-6">
                          <div class="flex items-center mb-4">
                              <div class="w-12 h-12 rounded-xl flex items-center justify-center mr-4"
                                  style="background-color: #bae4f0;">
                                  <span class="text-xl font-bold" style="color: #073a89;">2</span>
                              </div>
                              <div>
                                  <h3 class="text-xl font-bold" style="color: #073a89;">Our Mid Level</h3>
                                  <p class="font-medium" style="color: #ff6500;">End-to-End Applications</p>
                              </div>
                          </div>
                      </div>

                      <!-- Content -->
                      <div class="space-y-4">
                          <p class="text-gray-700" style="color: #1d1d1d;">
                              At the mid-level, students create complete applications with frontend and backend functionality,
                              incorporating Python, Java, Git, REST APIs, and debugging techniques. They learn online
                              collaboration, teamwork, and real-world development practices, preparing them for more complex projects.
                          </p>
                      </div>
                  </div>

                  <!-- Senior Level Card -->
                  <div class="bg-white rounded-2xl p-8 border" style="border-color: #e5e7eb;">
                      <!-- Level Header -->
                      <div class="mb-6">
                          <div class="flex items-center mb-4">
                              <div class="w-12 h-12 rounded-xl flex items-center justify-center mr-4"
                                  style="background-color: #bae4f0;">
                                  <span class="text-xl font-bold" style="color: #073a89;">3</span>
                              </div>
                              <div>
                                  <h3 class="text-xl font-bold" style="color: #073a89;">Our Senior Level</h3>
                                  <p class="font-medium" style="color: #ff6500;">Career Ready Developers</p>
                              </div>
                          </div>
                      </div>

                      <!-- Content -->
                      <div class="space-y-4">
                          <p class="text-gray-700" style="color: #1d1d1d;">
                              Senior learners tackle real-world and portfolio projects within professional teams.
                              They master advanced programming languages, database integration, mobile-app development,
                              game development, and agile workflows, while building portfolio projects that meet industry
                              standards, making them fully prepared for internships, freelance work, or high-tech careers.
                          </p>
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
