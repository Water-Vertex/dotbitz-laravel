@extends('user.layouts.app')
@section('content')
<div class="site-breadcrumb" style="background: url({{asset('assets/images/course-banner.png')}})">
    <div class="container">
        <h2 class="breadcrumb-title">About Us</h2>
        <ul class="breadcrumb-menu">
        <li><a href="{{ route('user.home') }}">Home</a></li>
        <li class="active">About Us</li>
        </ul>
    </div>
</div>
<!-- about area -->
      <div class="about-area py-120">
        <div class="container">
          <div class="row">
            <div class="col-lg-6">
              <div class="about-left wow fadeInLeft" data-wow-delay=".25s">
                <div class="about-img">
                  <div class="row g-0">
                    <div class="col-6">
                      <img class="img-1" src="{{asset('assets/images/about.jpg')}}" alt="" />
                    </div>
                    <div class="col-6">
                      <img class="img-2" src="{{asset('assets/images/about2.jpg')}}" alt="" />
                    </div>
                  </div>
                </div>
                <div class="about-experience">
                  <h5>10<span>+</span></h5>
                  <p>Years Of Experience</p>
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
      <!-- choose area -->
      <div class="choose-area py-120">
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
                    <img src="{{asset('assets/images/about3.jpg')}}" alt="" />
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
      <div class="our-mission py-80">
        <div class="container">
          <div class="row align-items-center">
            <div class="col-lg-6">
              <div class="mission-left wow fadeInLeft" data-wow-duration="1s" data-wow-delay=".25s" >
                <div class="mission-img">
                  <img class="mission-img-1" src="{{asset('assets/images/about4.png')}}" alt="">
                  <img class="mission-img-2" src="{{asset('assets/images/about5.jpg')}}" alt="">
                </div>
                <div class="mission-shape">
                  <img src="{{asset('assets/images/shape.svg')}}" alt="">
                </div>
              </div>
            </div>
            <div class="col-lg-6">
              <div class="mission-right wow fadeInUp" data-wow-duration="1s" data-wow-delay=".25s" style="visibility: visible; animation-duration: 1s; animation-delay: 0.25s; animation-name: fadeInUp;">
                <div class="site-heading mb-3">
                  <span class="site-title-tagline"><i class="far fa-lightbulb-on"></i> Our Mission</span>
                  <h2 class="site-title">Generation of <span class="text-gradient">Confident </span> Innovators</h2>
                </div>
                <p>
                  To empower young learners with technical, professional, and career-focused skills through age-appropriate programming education and long-term mentorship.
                </p>
                <p class="mt-3">
                 To become a globally trusted platform that guides students from early learning to career success in technology.
                </p>
              </div>
            </div>
          </div>
        </div>
      </div>
      <!-- choose area end -->
      <div class="cta-area pb-120">
        <div class="container">
          <div class="cta-wrap">
            <div class="row align-items-center">
              <div class="col-lg-6 col-xl-5">
                <div class="cta-content wow fadeInUp" data-wow-delay=".25s">
                  <h1>Learn About <span>Our Work, </span> & Our Culture</h1>
                  <p>DotBitz is an online learning institute dedicated to teaching programming and career-ready skills to students aged 9 and above. We believe that early exposure to technology, combined with the right guidance, can shape confident learners and future professionals.</p>
                  <a href="{{route('user.contact')}}" class="theme-btn">Contact Us<i class="fas fa-arrow-right"></i></a>
                </div>
              </div>
              <div class="col-lg-6 col-xl-7">
                <div class="cta-img">
                  <img src="{{asset('assets/images/cta.jpg')}}" alt="">
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>

      <!-- feature-area -->
      <div class="feature-area pb-120">
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
  
@endsection
