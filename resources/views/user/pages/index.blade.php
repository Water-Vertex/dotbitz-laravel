 @extends('user.layouts.app')
 @section('content')
 <!-- Hero Section -->
      <section class="hero-section text-white min-h-screen flex items-center relative">
         
          <div class="container mx-auto px-4 sm:px-6 lg:px-8 relative z-10">
              <div class="max-w-5xl mx-auto">
                  <div class="grid grid-cols-1 lg:grid-cols-2 gap-12 items-center">
                      <!-- Left Column: Text Content -->
                      <div>
                          <!-- Sub Heading -->
                          <div class="mb-6">
                              <span class="inline-block px-4 py-2 rounded-full font-semibold text-sm tracking-wider uppercase"
                                    style="background: rgba(255, 255, 255, 0.15); backdrop-filter: blur(10px); border: 1px solid rgba(255, 255, 255, 0.2);">
                                  <i class="fas fa-code mr-2" style="color: #ffd500;"></i>
                                  Learn to Code
                              </span>
                          </div>
                          
                          <!-- Main Heading -->
                          <h1 class="text-4xl md:text-5xl lg:text-5xl font-bold mb-6 leading-tight">
                              Empowering Future Innovators,
                              <span class="block mt-2" style="color: #ffd500;">One Dot at a Time</span>
                          </h1>
                          
                          <!-- Paragraph -->
                          <p class="text-xl mb-8 opacity-90 max-w-2xl">
                              Ages from 9 to above
                          </p>
                          
                          
                          <!-- CTA Buttons -->
                          <div class="flex flex-wrap gap-4 mb-12">
                              <button class="cta-button px-8 py-4 rounded-xl font-bold text-lg text-gray-900">
                                  Enroll Now
                                  <i class="fas fa-arrow-right ml-2"></i>
                              </button>
                              <button class="px-8 py-4 rounded-xl font-bold text-lg border-2 border-white hover:bg-white hover:text-[#073a89] transition-all duration-300">
                                  Request a Demo
                              </button>
                          </div>
                      </div>
                      
                      <!-- Right Column: Illustration/Image -->
                      <div class="relative">
                          <div class="relative">
                              <!-- Main Illustration Container -->
                              <div class="relative bg-gradient-to-br from-[#0091b9] to-[#073a89] rounded-3xl p-8 shadow-2xl">
                                  <!-- Floating Code Elements -->
                                  <div class="absolute -top-4 -left-4 w-20 h-20 bg-[#ff6500] rounded-2xl flex items-center justify-center transform -rotate-12">
                                      <i class="fas fa-laptop-code text-3xl text-white"></i>
                                  </div>
                                  <div class="absolute -bottom-4 -right-4 w-16 h-16 bg-[#ffd500] rounded-2xl flex items-center justify-center transform rotate-12">
                                      <i class="fas fa-robot text-2xl text-gray-900"></i>
                                  </div>
                                  
                                  <!-- Hero Image Placeholder -->
                                  <div class="bg-gradient-to-b from-transparent to-white/10 rounded-2xl overflow-hidden">
                                      <div class="aspect-video bg-gradient-to-r from-[#bae4f0] to-[#0091b9] rounded-2xl flex items-center justify-center">
                                          <!-- You can replace this with your actual image -->
                                          <div class="text-center p-8">
                                              <div class="text-6xl mb-4" style="color: #073a89;">
                                                  { }
                                              </div>
                                              <h3 class="text-2xl font-bold mb-2">Interactive Learning</h3>
                                              <p class="opacity-80">From beginner to advanced levels</p>
                                          </div>
                                      </div>
                                  </div>
                                  
                                  <!-- Floating Badge -->
                                  <div class="absolute -bottom-6 left-1/2 transform -translate-x-1/2 bg-white text-gray-900 px-6 py-3 rounded-full font-bold shadow-lg" style="font-size:12px">
                                      <i class="fas fa-medal mr-2" style="color: #ff6500;"></i>
                                      Recommended by Educators
                                  </div>
                              </div>
                          </div>
                          
                          <!-- Floating Elements Around -->
                          <div class="absolute -z-10 top-10 -right-10 w-40 h-40 bg-gradient-to-r from-[#ff6500] to-[#ffd500] rounded-full opacity-20 blur-3xl"></div>
                          <div class="absolute -z-10 bottom-10 -left-10 w-60 h-60 bg-gradient-to-r from-[#0091b9] to-[#073a89] rounded-full opacity-10 blur-3xl"></div>
                      </div>
                  </div>
              </div>
          </div>
      </section>
      <!-- Career Focused Learning Section -->
      <section class="py-16 md:py-24 bg-white">
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
      <section class="py-16 md:py-24 bg-gray-50">
          <div class="container mx-auto px-4 sm:px-6 lg:px-8">
              <!-- Section Header -->
              <div class="text-center mb-12">
                  <h2 class="text-3xl md:text-4xl font-bold mb-4" style="color: #073a89;">Learning Pathways</h2>
                  <p class="text-lg max-w-2xl mx-auto" style="color: #1d1d1d;">Structured programs designed for different age groups and skill levels</p>
              </div>
              
              <!-- Slider Container -->
              <div class="relative">
                  <!-- Slider Cards -->
                  <div class="grid grid-cols-1 md:grid-cols-3 gap-8" id="sliderContainer">
                      <!-- DotStart Card -->
                      <div class="bg-white rounded-3xl shadow-xl overflow-hidden transition-all duration-300 hover:shadow-2xl hover:-translate-y-2">
                          <!-- Course Image -->
                          <div class="relative h-56 overflow-hidden">
                              <img src="https://images.unsplash.com/photo-1523580494863-6f3031224c94?ixlib=rb-4.0.3&auto=format&fit=crop&w=800&q=80" 
                                  alt="Kids learning coding" 
                                  class="w-full h-full object-cover">
                              <!-- Level Badge -->
                              <div class="absolute top-4 left-4">
                                  <span class="inline-block px-4 py-2 rounded-full text-sm font-semibold text-white" 
                                        style="background: rgba(7, 58, 137, 0.9);">
                                      <i class="fas fa-star mr-2"></i>
                                      Beginner
                                  </span>
                              </div>
                          </div>
                          
                          <!-- Card Content -->
                          <div class="p-8">
                              <!-- Course Name (Moved here from image section) -->
                              <div class="mb-4">
                                  <h3 class="text-2xl font-bold" style="color: #073a89;">DotStart</h3>
                                  <h4 class="text-xl" style="color: #0091b9;">Code Foundations</h4>
                              </div>
                              
                              <!-- Paragraph -->
                              <p class="text-gray-700 mb-6">
                                  Builds a strong foundation in computers and technology essential for today's education. 
                                  Prepares students for advanced programming and future career pathways.
                              </p>
                              
                              <!-- Age and Button in Same Row -->
                              <div class="flex flex-col sm:flex-row items-start sm:items-center justify-between gap-4 mt-8">
                                  <!-- Age Section -->
                                  <div class="flex-1">
                                      <div class="flex items-center p-3 rounded-lg" style="background-color: #bae4f0; font-size:11px">
                                          <div>
                                              <p class="font-bold" style="color: #073a89;">Age: 9-12 Yrs</p>
                                              
                                          </div>
                                      </div>
                                  </div>
                                  
                                  <!-- Book Assessment Button -->
                                  <button class="px-6 py-3 rounded-xl font-bold text-white whitespace-nowrap transition-all duration-300 hover:transform hover:-translate-y-1"
                                          style="background: #FF6500">
                                      <i class="fas fa-calendar-check mr-2"></i>
                                      Book Assessment
                                  </button>
                              </div>
                          </div>
                      </div>
                      
                      <!-- DotGrow Card -->
                      <div class="bg-white rounded-3xl shadow-xl overflow-hidden transition-all duration-300 hover:shadow-2xl hover:-translate-y-2">
                          <!-- Course Image -->
                          <div class="relative h-56 overflow-hidden">
                              <img src="https://images.unsplash.com/photo-1529107386315-e1a2ed48a620?ixlib=rb-4.0.3&auto=format&fit=crop&w=800&q=80" 
                                  alt="Web development" 
                                  class="w-full h-full object-cover">
                              <!-- Level Badge -->
                              <div class="absolute top-4 left-4">
                                  <span class="inline-block px-4 py-2 rounded-full text-sm font-semibold text-white" 
                                        style="background: rgba(0, 145, 185, 0.9);">
                                      <i class="fas fa-chart-line mr-2"></i>
                                      Intermediate
                                  </span>
                              </div>
                          </div>
                          
                          <!-- Card Content -->
                          <div class="p-8">
                              <!-- Course Name (Moved here from image section) -->
                              <div class="mb-4">
                                  <h3 class="text-2xl font-bold" style="color: #073a89;">DotGrow</h3>
                                  <h4 class="text-xl" style="color: #0091b9;">Junior Developer Track</h4>
                              </div>
                              
                              <!-- Paragraph -->
                              <p class="text-gray-700 mb-6">
                                  Advances web development skills with real-world coding practices. 
                                  Builds confidence through teamwork and collaborative projects. 
                                  Develops a growth mindset for future academic and professional success.
                              </p>
                              
                               <!-- Age and Button in Same Row -->
                              <div class="flex flex-col sm:flex-row items-start sm:items-center justify-between gap-4 mt-8">
                                  <!-- Age Section -->
                                  <div class="flex-1">
                                      <div class="flex items-center p-3 rounded-lg" style="background-color: #bae4f0; font-size:11px">
                                          <div>
                                              <p class="font-bold" style="color: #073a89;">Age: 11-24 Yrs</p>
                                              
                                          </div>
                                      </div>
                                  </div>
                                  
                                  <!-- Book Assessment Button -->
                                  <button class="px-6 py-3 rounded-xl font-bold text-white whitespace-nowrap transition-all duration-300 hover:transform hover:-translate-y-1"
                                          style="background: #FF6500">
                                      <i class="fas fa-calendar-check mr-2"></i>
                                      Book Assessment
                                  </button>
                              </div>
                          </div>
                      </div>
                      
                      <!-- DotBuild Card -->
                      <div class="bg-white rounded-3xl shadow-xl overflow-hidden transition-all duration-300 hover:shadow-2xl hover:-translate-y-2">
                          <!-- Course Image -->
                          <div class="relative h-56 overflow-hidden">
                              <img src="https://images.unsplash.com/photo-1555066931-4365d14bab8c?ixlib=rb-4.0.3&auto=format&fit=crop&w=800&q=80" 
                                  alt="Software development" 
                                  class="w-full h-full object-cover">
                              <!-- Level Badge -->
                              <div class="absolute top-4 left-4">
                                  <span class="inline-block px-4 py-2 rounded-full text-sm font-semibold text-white" 
                                        style="background: rgba(7, 58, 137, 0.9);">
                                      <i class="fas fa-rocket mr-2"></i>
                                      Advanced
                                  </span>
                              </div>
                          </div>
                          
                          <!-- Card Content -->
                          <div class="p-8">
                              <!-- Course Name (Moved here from image section) -->
                              <div class="mb-4">
                                  <h3 class="text-2xl font-bold" style="color: #073a89;">DotBuild</h3>
                                  <h4 class="text-xl" style="color: #0091b9;">Software Builder Level</h4>
                              </div>
                              
                              <!-- Paragraph -->
                              <p class="text-gray-700 mb-6">
                                  Teaches object-oriented programming for real-world application. 
                                  Prepares students for advanced software development and professional opportunities.
                              </p>
                              
                               <!-- Age and Button in Same Row -->
                              <div class="flex flex-col sm:flex-row items-start sm:items-center justify-between gap-4 mt-8">
                                  <!-- Age Section -->
                                  <div class="flex-1">
                                      <div class="flex items-center p-3 rounded-lg" style="background-color: #bae4f0; font-size:11px">
                                          <div>
                                              <p class="font-bold" style="color: #073a89;">Age: 13-35 Yrs</p>
                                              
                                          </div>
                                      </div>
                                  </div>
                                  
                                  <!-- Book Assessment Button -->
                                  <button class="px-6 py-3 rounded-xl font-bold text-white whitespace-nowrap transition-all duration-300 hover:transform hover:-translate-y-1"
                                          style="background: #FF6500">
                                      <i class="fas fa-calendar-check mr-2"></i>
                                      Book Assessment
                                  </button>
                              </div>
                          </div>
                      </div>
                  </div>
                  
                  <!-- Slider Navigation (for mobile) -->
                  <div class="flex justify-center mt-8 md:hidden">
                      <div class="flex space-x-3">
                          <button class="slider-dot w-3 h-3 rounded-full" style="background-color: #0091b9;"></button>
                          <button class="slider-dot w-3 h-3 rounded-full" style="background-color: #bae4f0;"></button>
                          <button class="slider-dot w-3 h-3 rounded-full" style="background-color: #0091b9;"></button>
                      </div>
                  </div>
                  
                  <!-- Slider Arrows (for desktop) -->
                  <div class="hidden md:block">
                      <button class="absolute top-1/2 left-0 transform -translate-y-1/2 -translate-x-4 bg-[#0091B9] w-12 h-12 rounded-full shadow-lg flex items-center justify-center hover:shadow-xl transition-all duration-300 hover:-translate-x-5"
                              onclick="scrollSlider(-1)" style="color: white;">
                          <i class="fas fa-chevron-left"></i>
                      </button>
                      <button class="absolute top-1/2 right-0 transform -translate-y-1/2 translate-x-4 bg-[#0091B9] w-12 h-12 rounded-full shadow-lg flex items-center justify-center hover:shadow-xl transition-all duration-300 hover:translate-x-5"
                              onclick="scrollSlider(1)" style="color: white;">
                          <i class="fas fa-chevron-right"></i>
                      </button>
                  </div>
              </div>
          </div>
      </section>

      <script>
          let currentSlide = 0;
          const slides = document.querySelectorAll('#sliderContainer > div');
          const totalSlides = slides.length;
          
          function scrollSlider(direction) {
              currentSlide += direction;
              
              if (currentSlide < 0) {
                  currentSlide = totalSlides - 1;
              } else if (currentSlide >= totalSlides) {
                  currentSlide = 0;
              }
              
              // For mobile: Scroll to slide
              if (window.innerWidth < 768) {
                  slides[currentSlide].scrollIntoView({
                      behavior: 'smooth',
                      block: 'nearest',
                      inline: 'center'
                  });
              }
              
              updateSliderDots();
          }
          
          function updateSliderDots() {
              const dots = document.querySelectorAll('.slider-dot');
              dots.forEach((dot, index) => {
                  if (index === currentSlide) {
                      dot.style.backgroundColor = '#0091b9';
                      dot.style.transform = 'scale(1.2)';
                  } else {
                      dot.style.backgroundColor = '#bae4f0';
                      dot.style.transform = 'scale(1)';
                  }
              });
          }
          
          // Auto-slide for mobile
          if (window.innerWidth < 768) {
              setInterval(() => {
                  scrollSlider(1);
              }, 5000);
          }
          
          // Initialize dots
          updateSliderDots();
          
          // Update on window resize
          window.addEventListener('resize', () => {
              if (window.innerWidth >= 768) {
                  currentSlide = 0;
                  updateSliderDots();
              }
          });
      </script>
      <!-- Core Values Section - Exact Image Design -->
      <section class="py-16 md:py-24 bg-white">
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
      <section class="py-16 md:py-24 bg-gray-50">
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