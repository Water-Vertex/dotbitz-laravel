@extends('user.layouts.app')

@section('content')
<div class="site-breadcrumb" style="background: url({{asset('assets/images/course-banner.png')}})">
    <div class="container">
        <h2 class="breadcrumb-title">Contact Us</h2>
        <ul class="breadcrumb-menu">
        <li><a href="{{ route('user.home') }}">Home</a></li>
        <li class="active">Contact Us</li>
        </ul>
    </div>
</div>
 <!-- contact area -->
      <div class="contact-area pt-120 pb-100">
        <div class="container">
          <div class="contact-content pb-80">
            <div class="row">
              <div class="col-md-3">
                <div class="contact-info">
                  <div class="icon">
                    <i class="fa fa-map-location-dot"></i>
                  </div>
                  <div class="content">
                    <h5>Office Address</h5>
                    <p>Dublin, OH 43016</p>
                  </div>
                </div>
              </div>
              <div class="col-md-3">
                <div class="contact-info">
                  <div class="icon">
                    <i class="fa fa-phone-volume"></i>
                  </div>
                  <div class="content">
                    <h5>Call Us</h5>
                    <p>+1 (380) 257-7761</p>
                  </div>
                </div>
              </div>
              <div class="col-md-3">
                <div class="contact-info">
                  <div class="icon">
                    <i class="fa fa-envelopes"></i>
                  </div>
                  <div class="content">
                    <h5>Email Us</h5>
                    <p><a href="mailto:info@dotbitz.com" class="" >info@dotbitz.com</a></p>
                  </div>
                </div>
              </div>
              <div class="col-md-3">
                <div class="contact-info">
                  <div class="icon">
                    <i class="fa fa-alarm-clock"></i>
                  </div>
                  <div class="content">
                    <h5>Open Time</h5>
                    <p>Mon - Fri (10.00AM - 08.00PM)</p>
                  </div>
                </div>
              </div>
            </div>
          </div>
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
                    <h2>Get In Touch</h2>
                    <p>
                     Have questions? We're here to help. Send us a message and we'll respond as soon as possible.
                    </p>
                  </div>
                  <div class="form-message"></div>
                  <form method="post" action="{{route('contact.store')}}">
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
                    <button type="submit" class="theme-btn">Send Message <i class="far fa-paper-plane"></i></button>
                  </form>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
      <!-- end contact area -->

      <!-- map -->
      <div class="contact-map pb-120">
        <div class="container">
          <iframe
            src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d48820.900750188615!2d-83.14592345!3d40.113177050000004!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x8838ecc4d450a11f%3A0xc2176815689028!2sDublin%2C%20OH%2C%20USA!5e0!3m2!1sen!2s!4v1770120548168!5m2!1sen!2s"
            style="border: 0"
            allowfullscreen=""
            loading="lazy"
          ></iframe>
        </div>
      </div>
      <!-- map end -->

@endsection
