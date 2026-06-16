@extends('user.layouts.app')
@section('content')
<div class="site-breadcrumb" style="background: url({{asset('assets/images/course-banner.png')}})">
    <div class="container">
        <h2 class="breadcrumb-title">Thank You</h2>
        <ul class="breadcrumb-menu">
        <li><a href="{{ route('user.home') }}">Home</a></li>
        <li class="active">Thank You</li>
        </ul>
    </div>
</div>
<div class="about-area py-120">
  <div class="container">
    <div class="row align-items-center">

     

      <!-- RIGHT SIDE (CONTENT) -->
      <div class="col-lg-12">
        <div class="about-right wow fadeInUp" data-wow-delay=".25s">

          <div class="site-heading mb-3">
            <span class="site-title-tagline">
              <i class="far fa-check-circle"></i> Thank You
            </span>

            <h2 class="site-title">
              Your Contact Request 
              <span class="text-gradient">Has Been Received</span>
            </h2>
          </div>

          <p class="about-text">
            Thank you for choosing <strong>Dotbitz</strong> 🚀 <br>
            We’ve successfully received your contact query. 
            Our team is reviewing your details and will contact you shortly 
            with the next steps.
          </p>

          <div class="about-content">
            <div class="row g-3">

              <div class="col-md-6">
                <div class="about-item">
                  <div class="icon">
                    <img src="{{asset('assets/images/support.svg')}}" alt="" />
                  </div>
                  <div class="content">
                    <h6>Expert Contact</h6>
                    <p>Our team will reach out to understand your needs.</p>
                  </div>
                </div>
              </div>

              <div class="col-md-6">
                <div class="about-item">
                  <div class="icon">
                    <img src="{{asset('assets/images/learn.svg')}}" alt="" />
                  </div>
                  <div class="content">
                    <h6>Personalized Plan</h6>
                    <p>You’ll receive a custom assessment & guidance.</p>
                  </div>
                </div>
              </div>

            </div>
          </div>

          <p class="mt-3">
            ⏱ <strong>Response Time:</strong> Within 24 hours (business days)
          </p>

          <a href="{{ route('user.home') }}" class="theme-btn" style="background: #FF6500 !important">
            Back To Home <i class="fas fa-arrow-right"></i>
          </a>

        </div>
      </div>

    </div>
  </div>
</div>
@endsection