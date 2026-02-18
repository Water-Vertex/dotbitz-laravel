<header class="header">
      <!-- navbar -->
      <div class="main-navigation">
        <nav class="navbar navbar-expand-lg">
          <div class="container position-relative">
            <a class="navbar-brand" href="index.html">
              <img src="{{asset('assets/images/logo/dotbitz-logo.png')}}" alt="logo" />
            </a>
            <div class="mobile-menu-right">
              <div class="mobile-menu-btn">
                <button type="button" class="nav-right-link search-box-outer"><i class="far fa-search"></i></button>
              </div>

              <button
                class="navbar-toggler"
                type="button"
                data-bs-toggle="offcanvas"
                data-bs-target="#offcanvasNavbar"
                aria-controls="offcanvasNavbar"
                aria-label="Toggle navigation"
              >
                <span></span>
                <span></span>
                <span></span>
              </button>
            </div>
            <div class="offcanvas offcanvas-start" tabindex="-1" id="offcanvasNavbar" aria-labelledby="offcanvasNavbarLabel">
              <div class="offcanvas-header">
                <a href="index.html" class="offcanvas-brand" id="offcanvasNavbarLabel">
                  <img src="assets/img/logo/logo.png" alt="" />
                </a>
                <button type="button" class="btn-close" data-bs-dismiss="offcanvas" aria-label="Close">
                  <i class="far fa-xmark"></i>
                </button>
              </div>
              <div class="offcanvas-body gap-xl-4">
                <ul class="navbar-nav justify-content-end flex-grow-1">

                  <li class="nav-item"><a class="nav-link" href="{{route('user.home')}}">Home</a></li>
                  <li class="nav-item"><a class="nav-link" href="{{route('user.courses')}}">Courses</a></li>
                  <li class="nav-item"><a class="nav-link" href="{{route('user.about')}}">About</a></li>
                  <li class="nav-item"><a class="nav-link" href="{{route('user.faq')}}">FAQs</a></li>
                  <li class="nav-item"><a class="nav-link" href="{{route('user.contact')}}">Contact</a></li>
                </ul>
                <!-- nav-right -->
                <div class="nav-right">
                  <div class="search-btn">
                    <button type="button" class="nav-right-link search-box-outer"><i class="far fa-search"></i></button>
                  </div>
                  <div class="nav-btn">
                    <a href="https://portal.dotbitz.com" target="_blank" class="nav-link"><span class="far fa-sign-in"></span> Sign In</a>
                  </div>
                  <div class="nav-btn">
                    <a href="https://portal.dotbitz.com" target="_blank" class="theme-btn" style="background: #FF6500 !important">Book Free Consultation</a>
                  </div>

                </div>
              </div>
            </div>
          </div>
        </nav>
      </div>
      <!-- navbar end-->
    </header>
