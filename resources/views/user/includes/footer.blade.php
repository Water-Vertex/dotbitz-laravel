<footer class="footer-area light">
      <div class="footer-shape">
        <img src="assets/img/shape/02.png" alt="" />
      </div>
      <div class="footer-widget">
        <div class="container">
          <div class="footer-widget-wrap pt-100 pb-50">
            <div class="row g-4">
              <div class="col-lg-5">
                <div class="footer-widget-box about-us">
                  <a href="{{route('user.home')}}" class="footer-logo">
                    <img src="{{asset('assets/images/logo/dotbitz-logo.png')}}" alt="" />
                  </a>
                  <p class="mb-3">
                     DotBitz is an online learning institute dedicated to teaching programming and career-ready skills to students aged 9 and above. We believe that early exposure to technology, combined with the right guidance, can shape confident learners and future professionals.
                  </p>

                  <div class="footer-newsletter">
                    <h6>Subscribe Our Newsletter</h6>
                    <div class="newsletter-form">
                      <form action="#">
                        <div class="form-group">
                          <div class="form-icon">
                            <i class="far fa-envelopes"></i>
                            <input type="email" class="form-control" placeholder="Your Email" />
                            <button class="theme-btn" type="submit">Subscribe <span class="far fa-paper-plane"></span></button>
                          </div>
                        </div>
                      </form>
                    </div>
                  </div>
                </div>
              </div>
              <div class="col-6 col-lg-2">
                <div class="footer-widget-box list">
                  <h4 class="footer-widget-title">Company</h4>
                  <ul class="footer-list">
                    <li>
                      <a href="{{route('user.about')}}"><i class="far fa-angle-double-right"></i>About Us</a>
                    </li>
                    <li>
                      <a href="{{route('user.faq')}}"><i class="far fa-angle-double-right"></i>FAQs</a>
                    </li>
                    <li>
                      <a href="{{route('user.contact')}}"><i class="far fa-angle-double-right"></i>Contact Us</a>
                    </li>
                  </ul>
                </div>
              </div>
              <div class="col-6 col-lg-2">
                <div class="footer-widget-box list">
                  <h4 class="footer-widget-title">Informations</h4>
                  <ul class="footer-list">
                    @php
                        $policies = \App\Models\Policy::all();
                    @endphp
                    @foreach($policies as $policy)
                    <li>
                      <a href="{{route('user.policy', $policy->slug)}}"><i class="far fa-angle-double-right"></i>{{$policy->title}}</a>
                    </li>
                    @endforeach
                  </ul>
                </div>
              </div>
              <div class="col-lg-3">
                <div class="footer-widget-box">
                  <h4 class="footer-widget-title">Get In Touch</h4>
                  <ul class="footer-contact">
                    <li>
                      <div class="icon">
                        <i class="far fa-location-dot"></i>
                      </div>
                      <div class="content">
                        <h6>Our Address</h6>
                        <p>Dublin, OH 43016</p>
                      </div>
                    </li>
                    <li>
                      <div class="icon">
                        <i class="far fa-phone"></i>
                      </div>
                      <div class="content">
                        <h6>Call Us</h6>
                        <a href="tel:+1 (614) 332-5066">+1 (614) 332-5066</a>
                      </div>
                    </li>
                    <li>
                      <div class="icon">
                        <i class="far fa-envelope"></i>
                      </div>
                      <div class="content">
                        <h6>Mail Us</h6>
                        <a href="mailto:info@dotbitz.com"><span class="" >info@dotbitz.com</span></a>
                      </div>
                    </li>
                  </ul>
                </div>
              </div>
            </div>

          </div>
        </div>
      </div>
      <div class="container">
        <div class="copyright">
          <div class="row">
            <div class="col-md-6 align-self-center">
              <p class="copyright-text">&copy; Copyright <span id="date"></span> <a href="#"> Dotbitz </a> All Rights Reserved.</p>
            </div>
            <div class="col-md-6 align-self-center">
              <ul class="footer-social">
                <li>
                  <a href="#"><i class="fab fa-facebook-f"></i></a>
                </li>
                <li>
                  <a href="#"><i class="fab fa-x-twitter"></i></a>
                </li>
                <li>
                  <a href="#"><i class="fab fa-linkedin-in"></i></a>
                </li>
                <li>
                  <a href="#"><i class="fab fa-youtube"></i></a>
                </li>
              </ul>
            </div>
          </div>
        </div>
      </div>
    </footer>
