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
                <li class="text-[#ffd500] font-semibold">About US</li>
            </ol>
        </nav>

        <!-- Heading -->
        <h1 class="text-4xl md:text-5xl font-bold mb-4">
            About DotBitz
        </h1>
        <p class="max-w-2xl text-lg opacity-90">
            Where young minds learn to create with technology
        </p>
    </div>

    <!-- Decorative blur -->
    <div class="absolute top-0 right-0 w-64 h-64 bg-[#ffd500] opacity-10 blur-3xl rounded-full"></div>
</section>
<!-- Career Focused Learning Section -->
      <section class="py-10 md:py-10 bg-white">
          <div class="container mx-auto px-4 sm:px-6 lg:px-8">
              <div class="grid grid-cols-1 lg:grid-cols-2 gap-12 items-center">
                  <!-- Left Column: Image -->
                  <div class="order-2 lg:order-2">
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
                  <div class="order-1 lg:order-1">
                      <!-- Sub Title -->
                      <div class="mb-4">
                          <span class="inline-flex items-center px-4 py-2 rounded-full font-semibold text-sm tracking-wider uppercase"
                                style="background-color: #bae4f0; color: #073a89;">
                              LEARN, CREATE, CODE, GROW
                          </span>
                      </div>

                      <!-- Title -->
                      <h2 class="text-3xl md:text-4xl lg:text-5xl font-bold mb-6 leading-tight" style="color: #073a89;">
                          Learn About Our Work,
                          <span class="block" style="color: #ff6500;">& Our Culture</span>
                      </h2>

                      <!-- Paragraph -->
                      <div class="space-y-4 mb-8">
                          <p class="text-lg" style="color: #1d1d1d;">
                              DotBitz is an online learning institute dedicated to teaching programming and career-ready skills to students aged 9 and above. We believe that early exposure to technology, combined with the right guidance, can shape confident learners and future professionals.
                          </p>
                          <p class="text-lg" style="color: #1d1d1d;">
                              We go beyond traditional coding classes. Our programs are designed to help students not only learn how to code, but also understand how technology connects to real careers. From early learning to job readiness, we support students throughout their educational journey with structured learning paths, mentorship, and real-world skill development.
                          </p>
                      </div>

                  </div>
              </div>
          </div>
      </section>
      <!-- Investment Section -->
<section class="py-10 md:py-10 bg-white">
    <div class="container mx-auto px-4 sm:px-6 lg:px-8">
        <div class="grid grid-cols-1 lg:grid-cols-2 gap-12 lg:gap-20 items-center">
            <!-- Left Column: Text Content -->
            <div class="order-2 lg:order-1">
                <!-- Investment Heading -->
                <h2 class="text-3xl md:text-4xl lg:text-5xl font-bold mb-6 leading-tight" style="color: #073a89;">
                    Why Choose
                    <span class="block" style="color: #0091b9;">DotBiz?</span>
                </h2>

                <!-- Main Paragraph -->
                <div class="mb-8">
                    <p class="text-lg md:text-xl leading-relaxed" style="color: #1d1d1d;">
                        Choosing <span class="font-bold" style="color: #0091b9;">DotBiz</span> is more than enrolling in a coding program — it's an investment in a student's long-term success. Our learners develop skills that stay with them for life, empowering them to thrive in any academic, professional, or creative path they choose.
                    </p>
                </div>

                <!-- Divider Line -->
                <div class="w-20 h-1 mb-8 rounded-full" style="background-color: #FF6500;"></div>

                <!-- Key Points List -->
                <ul class="space-y-4 mb-8">
                    <li class="flex items-start">
                        <div class="flex-shrink-0 mt-1 mr-3">
                            <div class="w-6 h-6 rounded-full flex items-center justify-center" style="background-color: #bae4f0;">
                                <i class="fas fa-check text-xs" style="color: #073a89;"></i>
                            </div>
                        </div>
                        <p class="text-lg" style="color: #1d1d1d;">Life-long skill development</p>
                    </li>
                    <li class="flex items-start">
                        <div class="flex-shrink-0 mt-1 mr-3">
                            <div class="w-6 h-6 rounded-full flex items-center justify-center" style="background-color: #bae4f0;">
                                <i class="fas fa-check text-xs" style="color: #073a89;"></i>
                            </div>
                        </div>
                        <p class="text-lg" style="color: #1d1d1d;">Real-world career preparation</p>
                    </li>
                    <li class="flex items-start">
                        <div class="flex-shrink-0 mt-1 mr-3">
                            <div class="w-6 h-6 rounded-full flex items-center justify-center" style="background-color: #bae4f0;">
                                <i class="fas fa-check text-xs" style="color: #073a89;"></i>
                            </div>
                        </div>
                        <p class="text-lg" style="color: #1d1d1d;">Personalized learning paths</p>
                    </li>
                </ul>
            </div>

            <!-- Right Column: Registration Form -->
            <div class="order-1 lg:order-2">
                <div class="bg-gradient-to-br from-[#f8fafc] to-[#f0f9ff] rounded-3xl shadow-2xl p-8 md:p-10 lg:p-12 border border-gray-100">
                    <!-- Form Header -->
                    <div class="text-center mb-8">
                        {{-- <div class="w-16 h-16 rounded-full flex items-center justify-center mx-auto mb-4" style="background-color: #bae4f0;">
                            <i class="fas fa-laptop-code text-2xl" style="color: #073a89;"></i>
                        </div> --}}
                        <h3 class="text-2xl md:text-3xl font-bold mb-2" style="color: #073a89;">Book Assessment</h3>
                        <p class="text-gray-600">Start your coding journey today</p>
                    </div>

                    <!-- Form -->
                    <form class="space-y-6" action="{{ route('assessment.store') }}">
                        @csrf
                        <!-- Full Name -->
                        <div>
                            <label class="block text-sm font-medium mb-2" style="color: #073a89;">Full Full Name</label>
                            <input type="text"
                                   class="w-full px-4 py-3 rounded-xl border border-gray-300 focus:border-[#0091b9] focus:ring-2 focus:ring-[#0091b9]/20 outline-none transition"
                                   placeholder="Enter your full name" name="full_name" value="{{ old('full_name') }}"
                                   required>
                        </div>

                        <!-- Email Address -->
                        <div>
                            <label class="block text-sm font-medium mb-2" style="color: #073a89;">Email Address</label>
                            <input type="email"
                                   class="w-full px-4 py-3 rounded-xl border border-gray-300 focus:border-[#0091b9] focus:ring-2 focus:ring-[#0091b9]/20 outline-none transition"
                                   placeholder="Enter your email" name="email" value="{{ old('email') }}"
                                   required>
                        </div>

                        <!-- Age and Gender in Row -->
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                            <!-- Age -->
                            <div>
                                <label class="block text-sm font-medium mb-2" style="color: #073a89;">Phone</label>
                                <input type="tel"
                                       class="w-full px-4 py-3 rounded-xl border border-gray-300 focus:border-[#0091b9] focus:ring-2 focus:ring-[#0091b9]/20 outline-none transition"
                                       placeholder="Phone" name="phone" value="{{ old('phone') }}"
                                       required>
                            </div>

                            <!-- Gender -->
                            <div>
                                <label class="block text-sm font-medium mb-2" style="color: #073a89;">Courses</label>
                                <select class="w-full px-4 py-3 rounded-xl border border-gray-300 focus:border-[#0091b9] focus:ring-2 focus:ring-[#0091b9]/20 outline-none transition appearance-none" name="course_id"
                                        required>
                                    <option value="" disabled selected>Select Course</option>
                                    @php
                                        $courses = \App\Models\Course::where('status','active')->get();
                                    @endphp
                                    @foreach($courses as $course)
                                    <option value="{{$course->id ?: old('course_id')}}">{{$course->name}}</option>
                                    @endforeach
                                </select>
                                <div class="absolute right-4 top-1/2 transform -translate-y-1/2 pointer-events-none">
                                    <i class="fas fa-chevron-down text-gray-400"></i>
                                </div>
                            </div>
                        </div>

                        <!-- Requirements -->
                        <div>
                            <label class="block text-sm font-medium mb-2" style="color: #073a89;">Type your requirements</label>
                            <textarea
                                class="w-full px-4 py-3 rounded-xl border border-gray-300 focus:border-[#0091b9] focus:ring-2 focus:ring-[#0091b9]/20 outline-none transition min-h-[120px] resize-none"
                                placeholder="Tell us about your learning goals, experience level, or any specific requirements..." name="message"
                                required>{{ old('message') }}</textarea>
                        </div>

                        <!-- Submit Button -->
                        <button type="submit"
                                class="w-full py-4 rounded-xl font-bold text-lg text-white transition-all duration-300 transform hover:scale-[1.02] hover:shadow-lg active:scale-[0.98]"
                                style="background: linear-gradient(135deg, #FF6500 0%, #FF8C42 100%);">
                            <i class="fas fa-paper-plane mr-2"></i>
                            SUBMIT
                        </button>


                    </form>
                </div>
            </div>
        </div>
    </div>
</section>
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
                              Our Mission and Vision
                          </span>
                      </div>

                      <!-- Title -->
                      <h2 class="text-3xl md:text-4xl lg:text-5xl font-bold mb-6 leading-tight" style="color: #073a89;">
                          Generation of
                          <span class="block" style="color: #ff6500;">Confident Innovators</span>
                      </h2>

                      <!-- Paragraph -->
                      <div class="space-y-4 mb-8">
                          <p class="text-lg" style="color: #1d1d1d;">
                              To empower young learners with technical, professional, and career-focused skills through age-appropriate programming education and long-term mentorship.
                          </p>
                          <p class="text-lg" style="color: #1d1d1d;">
                              To become a globally trusted platform that guides students from early learning to career success in technology.
                          </p>
                      </div>

                  </div>
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
                      Future Success
                  </p>

                  <!-- Main Large Heading -->
                  <h2 class="text-4xl md:text-5xl font-bold mb-3" style="color: #073a89;">
                      Where DotBitz Takes You <br> To Build Your Dreams
                  </h2>
                  <!-- Description -->
                  <p class="text-lg" style="color: #1d1d1d;">
                      Choosing DotBitz is more than enrolling in a coding program, it’s an investment in a student’s long-term success. Our learners develop skills that stay with them for life, empowering them to thrive in any academic, professional, or creative path they choose.
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
                              Creativity and Innovation
                          </h3>
                          <p class="text-gray-700" style="color: #1d1d1d;">
                              Students turn ideas into real digital projects, strengthening their creative thinking and gaining confidence to design original solutions.
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
                              Problem-Solving and Logical Thinking
                          </h3>
                          <p class="text-gray-700" style="color: #1d1d1d;">
                              They learn to break down challenges into steps and solve problems with logic, improving analytical skills and confidence.
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
                              Practical Technical Skills
                          </h3>
                          <p class="text-gray-700" style="color: #1d1d1d;">
                              Hands-on projects teach programming, application building, and real-world technical skills, preparing students for advanced opportunities.
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
                              Future-Ready Mindset
                          </h3>
                          <p class="text-gray-700" style="color: #1d1d1d;">
                              Exposure to modern technologies, teamwork, and industry practices equips students to adapt and thrive in a fast-changing digital world.
                          </p>
                      </div>
                  </div>
                  <!-- Value 5 -->
                  <div class="flex items-start space-x-6 p-6 bg-white rounded-2xl border" style="border-color: #e5e7eb;">
                      <!-- Number -->
                      <div class="flex-shrink-0">
                          <div class="w-16 h-16 rounded-2xl flex items-center justify-center text-2xl font-bold text-white bg-[#FF6500]">
                              05
                          </div>
                      </div>

                      <!-- Content -->
                      <div>
                          <h3 class="text-xl font-bold mb-3" style="color: #073a89;">
                              Confidence and Communication
                          </h3>
                          <p class="text-gray-700" style="color: #1d1d1d;">
                              Through presentations and collaborative projects, students develop leadership, communication, and teamwork skills essential for success
                          </p>
                      </div>
                  </div>

                  <!-- Value 6 -->
                  <div class="flex items-start space-x-6 p-6 bg-white rounded-2xl border" style="border-color: #e5e7eb;">
                      <!-- Number -->
                      <div class="flex-shrink-0">
                          <div class="w-16 h-16 rounded-2xl flex items-center justify-center text-2xl font-bold text-white bg-[#FF6500]">
                              06
                          </div>
                      </div>

                      <!-- Content -->
                      <div>
                          <h3 class="text-xl font-bold mb-3" style="color: #073a89;">
                              Career and Portfolio Readiness
                          </h3>
                          <p class="text-gray-700" style="color: #1d1d1d;">
                             Advanced learners graduate with professional portfolios, ready for higher education, internships, or tech careers.
                          </p>
                      </div>
                  </div>
              </div>

          </div>
      </section>
@endsection
