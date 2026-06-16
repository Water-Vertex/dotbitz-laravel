@extends('user.layouts.app')

@section('content')
<div class="site-breadcrumb" style="background: url({{asset('assets/images/course-banner.png')}})">
    <div class="container">
        <h2 class="breadcrumb-title">Pre Registration</h2>
        <ul class="breadcrumb-menu">
        <li><a href="{{ route('user.home') }}">Home</a></li>
        <li class="active">Pre Registration</li>
        </ul>
    </div>
</div>
 <!-- contact area -->
      <div class="contact-area pt-120 pb-100">
        <div class="container">
          
          <div class="contact-form-wrap">
            <div class="row g-4">
              <div class="col-lg-5">
                <div class="contact-img">
                  <img src="{{asset('assets/images/contact.jpg')}}" alt="" />
                </div>
              </div>
              <div class="col-lg-7">
                <div class="contact-form">
                  <div class="contact-form-header">
                    <h2>Pre Registration</h2>
                    <p>
                     Pre-register now to secure your spot before seats fill up!
                    </p>
                  </div>
                  <div class="form-message"></div>
                  <form method="post" action="{{route('user.store-pre-register')}}">
                    @csrf
                    <div class="row">
                      <div class="col-md-6">
                        <div class="form-group">
                          <div class="form-icon">
                            <i class="far fa-user-tie"></i>
                            <input type="text" class="form-control" name="name" placeholder="Your Name" required />
                          </div>
                        </div>
                      </div>
                      <div class="col-md-6">
                        <div class="form-group">
                          <div class="form-icon">
                            <i class="far fa-envelope"></i>
                            <input type="email" class="form-control" name="email" placeholder="Your Email" required />
                          </div>
                        </div>
                      </div>
                    </div>
                    <div class="form-group">
                      <div class="form-icon">
                        <i class="far fa-pen"></i>
                        <input type="text" class="form-control" name="phone" placeholder="Your Phone" required />
                      </div>
                    </div>
                    <div class="form-group">
                      <div class="form-icon">
                        <i class="far fa-comment-lines"></i>
                        <textarea
                          name="message"
                          cols="30"
                          rows="5"
                          class="form-control"
                          placeholder="Write Your Message"
                          required
                        ></textarea>
                      </div>
                    </div>
                    <button type="submit" class="theme-btn">Register <i class="far fa-paper-plane"></i></button>
                  </form>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
      <!-- end contact area -->

      

@endsection
