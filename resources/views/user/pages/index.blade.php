 @extends('user.layouts.app')
@section('styles')
<style>
    .pre-reg-modal .modal-dialog {
        max-width: 500px;
        margin: 30px auto;
    }
    .pre-reg-modal .modal-content {
        border-radius: 20px;
        border: none;
    }
    .pre-reg-modal .modal-header {
        border-bottom: none;
        padding: 15px 20px 0 20px;
    }
    .pre-reg-modal .modal-body {
        padding: 10px 30px 30px 30px;
    }
    .pre-reg-modal .modal-header .btn-close {
        background-color: #f0f0f0;
        border-radius: 50%;
        padding: 8px;
        opacity: 1;
    }
    .pre-reg-modal .modal-header .btn-close:hover {
        background-color: #FF6500;
        opacity: 1;
    }
    .pre-reg-popup-icon {
        width: 70px;
        height: 70px;
        background: linear-gradient(135deg, #FF6500, #FECE09);
        border-radius: 50%;
        display: flex;
        align-items: center;
        justify-content: center;
        margin: 0 auto 15px;
    }
    .pre-reg-popup-icon i {
        font-size: 30px;
        color: white;
    }
    .pre-reg-modal h3 {
        font-size: 24px;
        font-weight: 700;
        margin-bottom: 10px;
        color: #063989;
    }
    .pre-reg-seat-info {
        background: #f8f9fa;
        border-radius: 15px;
        padding: 12px;
        margin: 15px 0;
        text-align: center;
    }
    .pre-reg-seat-info .seat-number {
        font-size: 28px;
        font-weight: 800;
        color: #FF6500;
        display: block;
    }
    .pre-reg-seat-info .seat-text {
        font-size: 14px;
        color: #666;
    }
    .seat-progress {
        height: 8px;
        border-radius: 4px;
        margin: 10px 0 0 0;
    }
    .seat-progress .progress-bar {
        background: linear-gradient(90deg, #FF6500, #FECE09);
        border-radius: 4px;
    }
    .pre-reg-button {
        background: #FF6500 !important;
        color: white !important;
        padding: 12px 20px !important;
        border-radius: 8px !important;
        text-decoration: none !important;
        display: block !important;
        width: 100% !important;
        text-align: center !important;
        font-weight: bold !important;
        font-size: 16px !important;
        border: none !important;
        margin: 15px 0 8px 0 !important;
        cursor: pointer !important;
    }
    .pre-reg-button:hover {
        background: #e05a00 !important;
        color: white !important;
    }
    .pre-reg-later {
        background: none !important;
        border: none !important;
        color: #999 !important;
        cursor: pointer !important;
        padding: 8px !important;
        display: inline-block !important;
    }
    .pre-reg-later:hover {
        color: #FF6500 !important;
    }
    #preRegistrationModal {
    z-index: 1055 !important;
}
.modal-backdrop {
    z-index: 1050 !important;
}
.pre-reg-modal .btn-close {
    background: transparent url("data:image/svg+xml,%3csvg xmlns='http://www.w3.org/2000/svg' viewBox='0 0 16 16' fill='%23000'%3e%3cpath d='M.293.293a1 1 0 011.414 0L8 6.586 14.293.293a1 1 0 111.414 1.414L9.414 8l6.293 6.293a1 1 0 01-1.414 1.414L8 9.414l-6.293 6.293a1 1 0 01-1.414-1.414L6.586 8 .293 1.707a1 1 0 010-1.414z'/%3e%3c/svg%3e") center/1em no-repeat;
}
#preRegistrationModal .modal-content {
    pointer-events: all !important;
}
#preRegistrationModal .btn-close {
    z-index: 1060 !important;
    position: relative !important;
}
.pre-reg-button {
    pointer-events: all !important;
    z-index: 1060 !important;
    position: relative !important;
}
</style>
@endsection

 @section('content')
 
<!-- Pre Registration Modal - Only show if seats are available -->
@if($remainingSeats > 0)
<div class="modal fade pre-reg-modal" id="preRegistrationModal" tabindex="-1">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body text-center">
                <!-- <div class="pre-reg-popup-icon">
                  <i class="fas fa-graduation-cap"></i>
                </div> -->
                
                <h3>Limited Seats Available!</h3>
                
                <p>Secure your spot before it's too late. Pre-register now to get early access and exclusive benefits.</p>
                
                <div class="pre-reg-seat-info">
                    <span class="seat-number">Only {{ $remainingSeats }} Seats Remaining</span>
                    <span class="seat-text">out of {{ $totalSeats }} total seats</span>
                    <div class="progress seat-progress">
                        @php
                            $percentage = (($totalSeats - $remainingSeats) / $totalSeats) * 100;
                        @endphp
                        <div class="progress-bar" style="width: {{ $percentage }}%"></div>
                    </div>
                </div>
                
                <p>⭐ Limited seats available for our upcoming session!<br>Pre-register now to get early bird benefits and guaranteed admission.</p>
                
                <!-- ✅ SIMPLE BUTTON - Direct link -->
                <a href="{{ route('user.pre-registration') }}" class="pre-reg-button">
                    Pre-Register Now
                    <!-- <i class="fas fa-arrow-right"></i> -->
                </a>
                
                <button type="button" class="pre-reg-later" data-bs-dismiss="modal">
                    Maybe Later
                </button>
            </div>
        </div>
    </div>
</div>
@endif
 <!-- hero area -->
      <div class="hero-section hs-1">
        <div class="hero-single" style="background-image: url({{asset('assets/images/01.png')}})">
          <div class="container">
            <div class="row">
              <div class="col-md-12 col-lg-6">
                <div class="hero-content">
                  <h6 class="hero-sub-title wow fadeInUp" data-delay=".25s" style="color:#FF6500"><i class="far fa-lightbulb-on"></i> Learn to Code</h6>
                  <h1 class="hero-title wow fadeInRight" data-delay=".50s">Empowering Future <span class="" style="color:#FF6500">Innovators,</span> One Dot at a Time</h1>
                  <p class="wow fadeInLeft" data-delay=".75s">
                    Project-based coding courses — from game design to AI.
                  </p>
                  <div class="hero-btn wow fadeInUp" data-delay="1s">
                    <a href="{{route('user.about')}}" class="theme-btn" style="background: #FECE09 !important;color:#063989">About More<i class="fas fa-arrow-right"></i></a>
                    <a href="https://portal.dotbitz.com/student/registration" target="_blank" class="theme-btn2" style="background: #FECE09 !important;color:#063989">Register Now<i class="fas fa-arrow-right"></i></a>
                  </div>
                </div>
              </div>
              <div class="col-md-12 col-lg-6">
                <div class="hero-info-wrap">
                  <div class="hero-avatar-group">
                    <!--<h6><span>250k +</span> Students</h6>-->
                    <!--<span class="avatar"><img src="{{asset('assets/images/01.jpg')}}" alt="" /></span>-->
                    <!--<span class="avatar"><img src="{{asset('assets/images/02.jpg')}}" alt="" /></span>-->
                    <!--<span class="avatar"><img src="{{asset('assets/images/03.jpg')}}" alt="" /></span>-->
                    <!--<span class="avatar"><img src="{{asset('assets/images/04.jpg')}}" alt="" /></span>-->
                    <!--<span class="avatar"><img src="{{asset('assets/images/05.jpg')}}" alt="" /></span>-->
                  </div>
                  <!--<div class="hero-course-info">-->
                  <!--  <div class="icon">-->
                  <!--    <img src="{{asset('assets/images/course.svg')}}" alt="" />-->
                  <!--  </div>-->
                    <!--<h6 class="title"><span>160+</span> Courses</h6>-->
                  <!--</div>-->
                </div>
                <div class="hero-img">
                  <img class="img-1" src="{{asset('assets/images/hero.png')}}" alt="" />
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
      <!-- hero area end -->
      <!-- partner area -->
      <!--<div class="partner-area2 negative">-->
      <!--  <div class="col-lg-10 col-xl-9 ms-auto">-->
      <!--    <div class="partner-wrapper">-->
      <!--      <div class="row g-4 align-items-center">-->
      <!--        <div class="col-lg-2">-->
      <!--          <div class="partner-title">-->
      <!--            <h5>Let's check our <span>350+</span> partners</h5>-->
      <!--          </div>-->
      <!--        </div>-->
      <!--        <div class="col-lg-10">-->
      <!--          <div class="partner-slider owl-carousel owl-theme">-->
      <!--            <img src="{{asset('assets/images/partner/01.png')}}" alt="thumb" />-->
      <!--            <img src="{{asset('assets/images/partner/02.png')}}" alt="thumb" />-->
      <!--            <img src="{{asset('assets/images/partner/03.png')}}" alt="thumb" />-->
      <!--            <img src="{{asset('assets/images/partner/04.png')}}" alt="thumb" />-->
      <!--            <img src="{{asset('assets/images/partner/05.png')}}" alt="thumb" />-->
      <!--            <img src="{{asset('assets/images/partner/06.png')}}" alt="thumb" />-->
      <!--            <img src="{{asset('assets/images/partner/07.png')}}" alt="thumb" />-->
      <!--          </div>-->
      <!--        </div>-->
      <!--      </div>-->
      <!--    </div>-->
      <!--  </div>-->
      <!--</div>-->
       <!-- partner area end -->
       <!-- about area -->
      <div class="about-area padding">
        <div class="container">
          <div class="row">
            <div class="col-lg-6">
              <div class="about-left wow fadeInLeft" data-wow-delay=".25s">
                <div class="about-img">
                  <div class="row g-0">
                    <div class="col-6">
                      <img class="img-1" src="{{asset('assets/images/kids1.png')}}" alt="" />
                    </div>
                    <div class="col-6">
                      <img class="img-2" src="{{asset('assets/images/about2.jpg')}}" alt="" />
                    </div>
                  </div>
                </div>
                <div class="about-experience" >
                  <h5 style="color:#063989">10<span>+</span></h5>
                  <p style="color:#063989">Years Of Experience</p>
                </div>
              </div>
            </div>
            <div class="col-lg-6">
              <div class="about-right wow fadeInUp" data-wow-delay=".25s">
                <div class="site-heading mb-3">
                  <span class="site-title-tagline"><i class="far fa-lightbulb-on"></i> About Us</span>
                  <h2 class="site-title">Career Focused Learning, <span class="text-gradient">Not Just Coding</span></h2>
                </div>
                <p class="about-text">
                  We go beyond teaching code. Starting from age 9, our students follow a structured learning path designed to build real career readiness. <br>
                  With long-term mentorship, hands-on projects, and a focus on teamwork, communication, and professionalism, we prepare young learners with the skills they need for real-world success.
                </p>
                <div class="about-content">
                  <div class="row g-3">
                    <div class="col-md-6">
                      <div class="about-item">
                        <div class="icon">
                          <img src="{{asset('assets/images/learn.svg')}}" alt="" />
                        </div>
                        <div class="content">
                          <h6>Mentorship</h6>
                          <p>Take a look at our up of the round shows</p>
                        </div>
                      </div>
                    </div>
                    <div class="col-md-6">
                      <div class="about-item">
                        <div class="icon">
                          <img src="{{asset('assets/images/support.svg')}}" alt="" />
                        </div>
                        <div class="content">
                          <h6>Real Projects</h6>
                          <p>Take a look at our up of the round shows</p>
                        </div>
                      </div>
                    </div>
                  </div>
                </div>
                <a href="{{ route('user.about') }}" class="theme-btn" style="background: #FF6500 !important">Discover More<i class="fas fa-arrow-right"></i></a>
              </div>
            </div>
          </div>
        </div>
      </div>
      <!-- about area end -->
      <!-- category area -->
      <div class="category-area padding">
        <div class="container">
          <div class="row">
            <div class="col-lg-7 mx-auto">
              <div class="site-heading text-center wow fadeInDown" data-wow-delay=".25s">
                <span class="site-title-tagline"><i class="far fa-lightbulb-on"></i> Our Category</span>
                <h2 class="site-title">Let's check our <span class="text-gradient">category</span></h2>
              </div>
            </div>
          </div>
          <div class="row g-4 justify-content-center wow fadeInUp" data-wow-delay=".25s">
            <div class="col-6 col-md-4 col-lg-3 col-xl-2">
              <a href="course-category-single.html" class="category-item">
                <div class="content">
                  <div class="icon">
                    <img src="{{asset('assets/images/icons/development.svg')}}" alt="" />
                  </div>
                  <div class="info">
                    <h6>Development</h6>
                    <p>150 Courses</p>
                  </div>
                </div>
              </a>
            </div>
            <div class="col-6 col-md-4 col-lg-3 col-xl-2">
              <a href="course-category-single.html" class="category-item">
                <div class="content">
                  <div class="icon">
                    <img src="{{asset('assets/images/icons/marketing.svg')}}" alt="" />
                  </div>
                  <div class="info">
                    <h6>Digital Marketing</h6>
                    <p>45 Courses</p>
                  </div>
                </div>
              </a>
            </div>
            <div class="col-6 col-md-4 col-lg-3 col-xl-2">
              <a href="course-category-single.html" class="category-item">
                <div class="content">
                  <div class="icon">
                    <img src="{{asset('assets/images/icons/design.svg')}}" alt="" />
                  </div>
                  <div class="info">
                    <h6>Design</h6>
                    <p>60 Courses</p>
                  </div>
                </div>
              </a>
            </div>
            <div class="col-6 col-md-4 col-lg-3 col-xl-2">
              <a href="course-category-single.html" class="category-item">
                <div class="content">
                  <div class="icon">
                    <img src="{{asset('assets/images/icons/office.svg')}}" alt="" />
                  </div>
                  <div class="info">
                    <h6>Artificial Intelligence</h6>
                    <p>36 Courses</p>
                  </div>
                </div>
              </a>
            </div>
            <div class="col-6 col-md-4 col-lg-3 col-xl-2">
              <a href="course-category-single.html" class="category-item">
                <div class="content">
                  <div class="icon">
                    <img src="{{asset('assets/images/icons/health.svg')}}" alt="" />
                  </div>
                  <div class="info">
                    <h6>Mobile App Development</h6>
                    <p>59 Courses</p>
                  </div>
                </div>
              </a>
            </div>
            <div class="col-6 col-md-4 col-lg-3 col-xl-2">
              <a href="course-category-single.html" class="category-item">
                <div class="content">
                  <div class="icon">
                    <img src="{{asset('assets/images/icons/lifestyle.svg')}}" alt="" />
                  </div>
                  <div class="info">
                    <h6>Machine Learning</h6>
                    <p>65 Courses</p>
                  </div>
                </div>
              </a>
            </div>
          </div>
          <div class="col-12 text-center">
            <a href="course-category.html" class="theme-btn mt-5"><span class="fad fa-rotate"></span> All Category</a>
          </div>
        </div>
      </div>
      <!-- category area end -->
       <!-- course area -->
      <div class="course-area bg-img padding">
        <div class="container">
          <div class="row">
            <div class="col-lg-7 mx-auto">
              <div class="site-heading text-center wow fadeInDown" data-wow-delay=".25s">
                <span class="site-title-tagline"><i class="far fa-lightbulb-on"></i> Our Courses</span>
                <h2 class="site-title">Our Most Popular <span class="text-gradient">Courses</span></h2>
              </div>
            </div>
          </div>
          <div class="course-slider owl-carousel owl-theme wow fadeInUp" data-wow-delay=".25s">
            @foreach($courses as $index => $course)
            <div class="course-item">
              <span class="course-tag c1">{{$course->course_level}}</span>
              <div class="course-img">
                <a href="{{ route('user.course.details', $course->slug) }}"><img src="{{asset('assets/images/courses/' . $course->thumbnail_image)}}" alt="" /></a>
              </div>
              <div class="course-content">
                {{-- <div class="course-meta">
                  <span class="category c1">Development</span>
                  <div class="rating">
                    <i class="fas fa-star"></i>
                    <span>3.5k</span>
                  </div>
                </div> --}}
                <h4 class="course-title" style="height:45px"><a href="{{ route('user.course.details', $course->slug) }}">{{$course->course_name}}</a></h4>
                <div class="course-info">
                  <p style="
  overflow: hidden;
  text-overflow: ellipsis;display: -webkit-box;
   -webkit-line-clamp: 5;
   -webkit-box-orient: vertical;">{{$course->short_description}}</p>
                </div>
                <div class="course-bottom">
                  <!--<a href="{{route('user.book-assessment',$course->id)}}" class="" data-course-id="{{ $course->id }}"-->
                  <!--                      data-course-name="{{ $course->course_name }}">-->
                  <!--  <div class="course-instructor">-->

                  <!--    <h6>Book Free Assessment</h6>-->
                  <!--  </div>-->
                  <!--</a>-->
                  <a href="{{route('user.book-assessment',$course->id)}}" class="theme-btn" style="background: #FECE09 !important;color:#063989;padding: 5px 10px;font-size: 14px;">Book Free Assessment</a>
                  <div class="course-price">

                    <span style="font-size: 14px;">Age: {{$course->age_limit}}</span>
                  </div>
                </div>
              </div>
            </div>
            @endforeach
          </div>
        </div>
      </div>
      <!-- course area end -->
      <!-- choose area -->
      <div class="choose-area padding">
        <div class="container">
          <div class="row g-4">
            <div class="col-lg-5">
              <div class="choose-content wow fadeInLeft" data-wow-delay=".25s">
                <div class="site-heading mb-0">
                  <span class="site-title-tagline"><i class="far fa-lightbulb-on"></i> Why Choose Us</span>
                  <h2 class="site-title">Learn. <span class="text-gradient">Build. </span> Grow</h2>
                  <p>
                    We make learning to code creative, practical, and career-ready. Here's how we bring it to life
                  </p>
                  <div class="choose-img">
                    <img src="{{asset('assets/images/kids3.jpg')}}" alt="" />
                  </div>
                </div>
              </div>
            </div>
            <div class="col-lg-7">
              <div class="row g-4 wow fadeInRight" data-wow-delay=".25s">
                <div class="col-lg-6">
                  <div class="choose-item">

                    <div class="info">
                      <h5>01- Personalized Learning</h5>
                      <p>We assess each student's age, interests, and skill level to create a customized, age-appropriate learning path.</p>
                    </div>
                  </div>
                </div>
                <div class="col-lg-6">
                  <div class="choose-item">

                    <div class="info">
                      <h5>02- Skill Growth & Career Readiness</h5>
                      <p>We focus on building both technical and professional skills, preparing students for future education and tech careers.</p>
                    </div>
                  </div>
                </div>
                <div class="col-lg-6">
                  <div class="choose-item">

                    <div class="info">
                      <h5>03- Active, Hands-on Experience</h5>
                      <p>Students learn through interactive live sessions, hands-on projects, and real-world challenges, making coding fun and practical.</p>
                    </div>
                  </div>
                </div>
                <div class="col-lg-6">
                  <div class="choose-item">

                    <div class="info">
                      <h5>04- Safe and Supportive Environment</h5>
                      <p>Our programs provide a mentorship-driven, structured, and supportive space where students can explore, ask questions, and grow confidently.</p>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
      <!-- choose area end -->
      <!-- feature-area -->
      <div class="feature-area padding">
        <div class="container">
          <div class="feature-wrap">
            <div class="row g-4">
              <div class="col-md-6 col-lg-4">
                <div class="feature-item wow fadeInUp" data-wow-delay=".25s">
                  <div class="feature-content">
                    <span class="count">01</span>
                    <div class="feature-icon">
                      <img src="{{asset('assets/images/course-3.svg')}}" alt="" />
                    </div>
                    <div class="feature-info">
                      <h4>25k Online Course</h4>
                      <p>It is a long established fact that a reader will be distracted by the readable content layout.</p>
                    </div>
                  </div>
                </div>
              </div>
              <div class="col-md-6 col-lg-4">
                <div class="feature-item wow fadeInUp" data-wow-delay=".35s">
                  <div class="feature-content">
                    <span class="count">02</span>
                    <div class="feature-icon">
                      <img src="{{asset('assets/images/instructor-3.svg')}}" alt="" />
                    </div>
                    <div class="feature-info">
                      <h4>Expert Instructors</h4>
                      <p>It is a long established fact that a reader will be distracted by the readable content layout.</p>
                    </div>
                  </div>
                </div>
              </div>
              <div class="col-md-6 col-lg-4">
                <div class="feature-item wow fadeInUp" data-wow-delay=".45s">
                  <div class="feature-content">
                    <span class="count">03</span>
                    <div class="feature-icon">
                      <img src="{{asset('assets/images/lifetime-course.svg')}}" alt="" />
                    </div>
                    <div class="feature-info">
                      <h4>Lifetime Access</h4>
                      <p>It is a long established fact that a reader will be distracted by the readable content layout.</p>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
      <!-- feature-area end -->
      <!-- process area -->
      <div class="process-area padding">
        <div class="container">
          <div class="row">
            <div class="col-lg-7 mx-auto">
              <div class="site-heading text-center wow fadeInDown" data-wow-delay=".25s">
                <span class="site-title-tagline"><i class="far fa-lightbulb-on"></i>Learning Progression</span>
                <h2 class="site-title">What Makes <span class="text-gradient">DotBitz </span>Different</h2>
              </div>
            </div>
          </div>
          <div class="process-wrap wow fadeInUp" data-wow-delay=".25s">
            <div class="row g-4">
              <div class="col-md-6 col-xl-4">
                <div class="process-item">
                  <span class="count">01</span>

                  <div class="content" style="height:330px">
                    <h4>Our Junior Level</h4>
                    <p>Our junior teams craft interactive and web-based projects like games, apps, and websites, using HTML, CSS, JavaScript and design. </p>
                  </div>
                </div>
              </div>
              <div class="col-md-6 col-xl-4">
                <div class="process-item">
                  <span class="count">02</span>

                  <div class="content" style="height:330px">
                    <h4>Our Mid Level</h4>
                    <p>At the mid-level, students create complete applications with frontend and backend functionality, incorporating Python, Java, Git, REST APIs, and debugging techniques. They learn online collaboration, teamwork, and real-world development practices, preparing them for more complex projects.</p>
                  </div>
                </div>
              </div>
              <div class="col-md-6 col-xl-4">
                <div class="process-item">
                  <span class="count">03</span>

                  <div class="content" style="height:330px">
                    <h4>Our Senior Level</h4>
                    <p>Senior learners tackle real-world and portfolio projects within professional teams. They master advanced programming languages, database integration, mobile-app development, game development, and agile workflows, while building portfolio projects that meet industry standards, making them fully prepared for internships, freelance work, or high-tech careers..</p>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
      <!-- process area end -->
      <!-- faq area -->
      <div class="faq-area padding">
        <div class="container">
          <div class="row">
            <div class="col-lg-12">
              <div class="faq-content wow fadeInUp" data-wow-delay=".25s">
                <div class="site-heading mb-3">
                  <span class="site-title-tagline"><i class="far fa-lightbulb-on"></i> Faq's</span>
                  <h2 class="site-title my-3">General <span class="text-gradient">frequently</span> asked questions</h2>
                </div>
                <p class="mb-3">
                 Got Questions? We’ve Got Answers
                </p>

              </div>
            </div>
            @foreach($faqs as $index => $faq)
            <div class="col-lg-6">
              <div class="accordion wow fadeInRight" data-wow-delay=".25s" id="accordionExample">

                <div class="accordion-item">
                  <h2 class="accordion-header" id="heading{{ $index + 1 }}">
                    <button
                      class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapse{{ $index + 1 }}" aria-expanded="false" aria-controls="collapse{{ $index + 1 }}"
                    >
                      <span><i class="far fa-question"></i></span> {{ $faq->question }}
                    </button>
                  </h2>
                  <div
                    id="collapse{{ $index + 1 }}"
                    class="accordion-collapse collapse"
                    aria-labelledby="heading{{ $index + 1 }}"
                    data-bs-parent="#accordionExample"
                  >
                    <div class="accordion-body">
                     {!! nl2br(e($faq->answer)) !!}
                    </div>
                  </div>
                </div>

              </div>
            </div>
             @endforeach
          </div>
        </div>
      </div>
      <!-- faq area end -->
      <!-- testimonial-area -->
      <div class="testimonial-area ts-bg padding">
        <div class="container">
          <div class="row">
            <div class="col-lg-7 mx-auto">
              <div class="site-heading text-center wow fadeInDown" data-wow-delay=".25s">
                <span class="site-title-tagline"><i class="far fa-lightbulb-on"></i> Testimonials</span>
                <h2 class="site-title">What Our Client <span class="text-gradient">Say's About Us</span></h2>
              </div>
            </div>
          </div>
          <div class="testimonial-slider owl-carousel owl-theme wow fadeInUp" data-wow-delay=".25s">
            <div class="testimonial-item">
              <div class="content">
                <div class="icon">
                  <img src="assets/img/icon/quote.svg" alt="" />
                </div>
                <div class="rating">
                  <i class="fas fa-star"></i>
                  <i class="fas fa-star"></i>
                  <i class="fas fa-star"></i>
                  <i class="fas fa-star"></i>
                  <i class="fas fa-star"></i>
                </div>
                <div class="quote">
                  <p>
                    There are many variations of passage available the majority have suffered of alteration of the some humour words look
                    even slightly form by the injected to default model believable.
                  </p>
                </div>
                <div class="author">
                  <div class="author-img">
                    <img src="assets/img/testimonial/01.jpg" alt="" />
                  </div>
                  <div class="author-info">
                    <h5>Niesha Phips</h5>
                    <p>Student</p>
                  </div>
                </div>
              </div>
            </div>
            <div class="testimonial-item">
              <div class="content">
                <div class="icon">
                  <img src="assets/img/icon/quote.svg" alt="" />
                </div>
                <div class="rating">
                  <i class="fas fa-star"></i>
                  <i class="fas fa-star"></i>
                  <i class="fas fa-star"></i>
                  <i class="fas fa-star"></i>
                  <i class="fas fa-star"></i>
                </div>
                <div class="quote">
                  <p>
                    There are many variations of passage available the majority have suffered of alteration of the some humour words look
                    even slightly form by the injected to default model believable.
                  </p>
                </div>
                <div class="author">
                  <div class="author-img">
                    <img src="assets/img/testimonial/02.jpg" alt="" />
                  </div>
                  <div class="author-info">
                    <h5>Eugene Ivan</h5>
                    <p>Student</p>
                  </div>
                </div>
              </div>
            </div>
            <div class="testimonial-item">
              <div class="content">
                <div class="icon">
                  <img src="assets/img/icon/quote.svg" alt="" />
                </div>
                <div class="rating">
                  <i class="fas fa-star"></i>
                  <i class="fas fa-star"></i>
                  <i class="fas fa-star"></i>
                  <i class="fas fa-star"></i>
                  <i class="fas fa-star"></i>
                </div>
                <div class="quote">
                  <p>
                    There are many variations of passage available the majority have suffered of alteration of the some humour words look
                    even slightly form by the injected to default model believable.
                  </p>
                </div>
                <div class="author">
                  <div class="author-img">
                    <img src="assets/img/testimonial/03.jpg" alt="" />
                  </div>
                  <div class="author-info">
                    <h5>Martha Brown</h5>
                    <p>Student</p>
                  </div>
                </div>
              </div>
            </div>
            <div class="testimonial-item">
              <div class="content">
                <div class="icon">
                  <img src="assets/img/icon/quote.svg" alt="" />
                </div>
                <div class="rating">
                  <i class="fas fa-star"></i>
                  <i class="fas fa-star"></i>
                  <i class="fas fa-star"></i>
                  <i class="fas fa-star"></i>
                  <i class="fas fa-star"></i>
                </div>
                <div class="quote">
                  <p>
                    There are many variations of passage available the majority have suffered of alteration of the some humour words look
                    even slightly form by the injected to default model believable.
                  </p>
                </div>
                <div class="author">
                  <div class="author-img">
                    <img src="assets/img/testimonial/04.jpg" alt="" />
                  </div>
                  <div class="author-info">
                    <h5>Robert Dese</h5>
                    <p>Student</p>
                  </div>
                </div>
              </div>
            </div>
            <div class="testimonial-item">
              <div class="content">
                <div class="icon">
                  <img src="assets/img/icon/quote.svg" alt="" />
                </div>
                <div class="rating">
                  <i class="fas fa-star"></i>
                  <i class="fas fa-star"></i>
                  <i class="fas fa-star"></i>
                  <i class="fas fa-star"></i>
                  <i class="fas fa-star"></i>
                </div>
                <div class="quote">
                  <p>
                    There are many variations of passage available the majority have suffered of alteration of the some humour words look
                    even slightly form by the injected to default model believable.
                  </p>
                </div>
                <div class="author">
                  <div class="author-img">
                    <img src="assets/img/testimonial/05.jpg" alt="" />
                  </div>
                  <div class="author-info">
                    <h5>Buchan Conie</h5>
                    <p>Student</p>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
      <!-- testimonial-area end -->


 @endsection
 @section('scripts')
    <!-- Swiper JS -->
<script src="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.js"></script>

<!-- ⭐⭐⭐ IMPORTANT: Bootstrap JS (Modal ke liye REQUIRED) ⭐⭐⭐ -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>

<script>
    // Wait for everything to load
  // window.addEventListener('load', function() {
  //       @if($remainingSeats > 0)
  //           var modalElement = document.getElementById('preRegistrationModal');
  //           if (modalElement) {
  //               var myModal = new bootstrap.Modal(modalElement, {
  //                   // backdrop: true,  
  //                   keyboard: false
  //               });
  //               myModal.show();
  //           }
  //       @endif
  //   });
    window.addEventListener('load', function() {
    @if($remainingSeats > 0)
        var modalElement = document.getElementById('preRegistrationModal');
        if (modalElement) {
            var myModal = new bootstrap.Modal(modalElement, {
                backdrop: true,
                keyboard: true
            });
            myModal.show();
            
            // ✅ Force z-index fix
            setTimeout(function() {
                var backdrop = document.querySelector('.modal-backdrop');
                if (backdrop) {
                    backdrop.style.zIndex = '1040';
                }
                modalElement.style.zIndex = '1050';
            }, 300);
        }
    @endif
});
    // Initialize Swiper (only once)
    if (document.querySelector('.course-slider')) {
        new Swiper('.course-slider', {
            slidesPerView: 1,
            spaceBetween: 20,
            loop: true,
            autoplay: {
                delay: 5000,
                disableOnInteraction: false,
            },
            breakpoints: {
                640: { slidesPerView: 1, spaceBetween: 20 },
                768: { slidesPerView: 2, spaceBetween: 30 },
                1024: { slidesPerView: 3, spaceBetween: 30 }
            },
            pagination: {
                el: '.swiper-pagination',
                clickable: true,
            },
            navigation: {
                nextEl: '.swiper-button-next',
                prevEl: '.swiper-button-prev',
            },
        });
    }

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
