@extends('user.layouts.app')
@section('content')
<style>
.policy-card {
    @apply bg-gray-50 rounded-xl p-6 border border-gray-200 hover:border-[#073a89] transition-all duration-300;
}

.policy-section {
    @apply transition-all duration-500;
}

.policy-section.active {
    @apply block;
}

.policy-tab {
    @apply cursor-pointer;
}

/* Smooth scrolling */
html {
    scroll-behavior: smooth;
}

/* Custom list styling */
ul.custom-list {
    @apply space-y-2;
}

ul.custom-list li {
    @apply flex items-start;
}

ul.custom-list li::before {
    content: "•";
    @apply text-[#073a89] font-bold mr-3 mt-0.5;
}

/* Fix for content overflow */
.policy-content {
    overflow-x: hidden;
    width: 100%;
}

.policy-content img,
.policy-content table,
.policy-content iframe,
.policy-content video {
    max-width: 100%;
    height: auto;
}

.policy-content pre,
.policy-content code {
    white-space: pre-wrap;
    word-wrap: break-word;
    overflow-x: auto;
}

.policy-content table {
    display: block;
    overflow-x: auto;
    white-space: nowrap;
}

/* Mobile-specific fixes */
@media (max-width: 768px) {
    .policy-content .prose {
        font-size: 1rem;
        line-height: 1.6;
    }

    .policy-content .prose h1 {
        font-size: 1.5rem;
    }

    .policy-content .prose h2 {
        font-size: 1.25rem;
    }

    .policy-content .prose h3 {
        font-size: 1.125rem;
    }
}
</style>
<!-- breadcrumb -->
      <div class="site-breadcrumb" style="background: url({{asset('assets/images/course-banner.png')}})">
        <div class="container">
          <div class="col-lg-6">
            <div class="course-single-header">
              <div class="top">
                <span class="category c1">Course Details</span>
                <a href="#" class="bookmark" data-bs-toggle="tooltip" data-bs-title="Bookmark"><i class="far fa-bookmark"></i></a>
              </div>
              <h4 class="title">{{$course->course_name}}</h4>
              <p>
                {{ $course->short_description }}
              </p>
              <div class="rating">
                <i class="fas fa-star"></i>
                <i class="fas fa-star"></i>
                <i class="fas fa-star"></i>
                <i class="fas fa-star"></i>
                <i class="far fa-star"></i>
                <span class="rating-avg">4.5</span>
                <span>(1.5k Reviews)</span>
              </div>
              <div class="info">
                <div class="instructor">
                  <img src="{{asset('assets/images/instructor.jpg')}}" alt="" />
                  <h6>{{$course->instructor->first_name}} {{$course->instructor->last_name }}</h6>
                </div>

              </div>
            </div>
          </div>
        </div>
      </div>
      <!-- breadcrumb end -->

      <!-- course-single -->
      <div class="course-single pt-50 pb-80">
        <div class="container">
          <div class="row">
            <div class="col-lg-7 col-xl-8">
              <div class="course-single-wrap">
                <!--  video area -->
                <div class="video-area" style="background-image: url({{asset('assets/images/courses/' . $course->thumbnail_image)}})">
                  <div class="row">
                    <div class="col-lg-12">

                    </div>
                  </div>
                </div>
                <!-- video area end -->

                <!-- course single tab -->
                <div class="course-single-tab">
                  <ul class="nav nav-underline">
                    <li class="nav-item">
                      <button class="nav-link" data-bs-toggle="tab" data-bs-target="#course-tab1" type="button">Description</button>
                    </li>
                    <li class="nav-item">
                      <button class="nav-link active" data-bs-toggle="tab" data-bs-target="#course-tab2" type="button">Curriculum</button>
                    </li>
                    <li class="nav-item">
                      <button class="nav-link" data-bs-toggle="tab" data-bs-target="#course-tab3" type="button">Instructor</button>
                    </li>
                    <li class="nav-item">
                      <button class="nav-link" data-bs-toggle="tab" data-bs-target="#course-tab4" type="button">Review</button>
                    </li>
                  </ul>

                  <div class="tab-content">
                    <!-- tab 1 -->
                    <div class="tab-pane fade" id="course-tab1">
                      <div class="course-details mt-4">
                        <div class="mb-4">
                          <h5 class="mb-10">Description</h5>
                          <p>
                            {!! $course->description !!}
                          </p>
                        </div>
                      </div>
                    </div>

                    <!-- tab 2 -->
                    <div class="tab-pane fade active show" id="course-tab2">
                      <div class="course-curriculum mt-4">
                        <div class="accordion accordion-flush" id="course-accordion">
                          <div class="accordion-item">
                            <h2 class="accordion-header">
                              <button class="accordion-button" type="button" data-bs-toggle="collapse" data-bs-target="#curriculum1">
                                Get Started
                              </button>
                            </h2>
                            <div id="curriculum1" class="accordion-collapse collapse show" data-bs-parent="#course-accordion">
                              <div class="accordion-body">
                                <div class="curriculum-item unlock completed">
                                  <div class="left">
                                    <h6><i class="fad fa-check-circle"></i> <span>Video:</span> Greetings and Introduction</h6>
                                  </div>
                                  <div class="right">
                                    <span class="duration">12:43</span>
                                    <span class="lock"><i class="fad fa-unlock"></i></span>
                                  </div>
                                </div>
                                <div class="curriculum-item unlock">
                                  <div class="left">
                                    <h6><i class="fad fa-play-circle"></i> <span>Video:</span> Greetings and Introduction</h6>
                                  </div>
                                  <div class="right">
                                    <span class="duration">12:43</span>
                                    <span class="lock"><i class="fad fa-unlock"></i></span>
                                  </div>
                                </div>
                                <div class="curriculum-item unlock">
                                  <div class="left">
                                    <h6><i class="fad fa-play-circle"></i> <span>Video:</span> Greetings and Introduction</h6>
                                  </div>
                                  <div class="right">
                                    <span class="duration">12:43</span>
                                    <span class="lock"><i class="fad fa-unlock"></i></span>
                                  </div>
                                </div>
                                <div class="curriculum-item">
                                  <div class="left">
                                    <h6><i class="fad fa-play-circle"></i> <span>Video:</span> Greetings and Introduction</h6>
                                  </div>
                                  <div class="right">
                                    <span class="duration">12:43</span>
                                    <span class="lock"><i class="fad fa-lock"></i></span>
                                  </div>
                                </div>
                                <div class="curriculum-item">
                                  <div class="left">
                                    <h6><i class="fad fa-volume"></i> <span>Audio:</span> Interactive lesson</h6>
                                  </div>
                                  <div class="right">
                                    <span class="duration">12:43</span>
                                    <span class="lock"><i class="fad fa-lock"></i></span>
                                  </div>
                                </div>
                                <div class="curriculum-item">
                                  <div class="left">
                                    <h6><i class="fad fa-file-alt"></i> <span>Reading:</span> Web Design &amp; Development</h6>
                                  </div>
                                  <div class="right">
                                    <span class="duration">12:43</span>
                                    <span class="lock"><i class="fad fa-lock"></i></span>
                                  </div>
                                </div>
                              </div>
                            </div>
                          </div>
                          <div class="accordion-item">
                            <h2 class="accordion-header">
                              <button
                                class="accordion-button collapsed"
                                type="button"
                                data-bs-toggle="collapse"
                                data-bs-target="#curriculum2"
                              >
                                Course Project Overview
                              </button>
                            </h2>
                            <div id="curriculum2" class="accordion-collapse collapse" data-bs-parent="#course-accordion">
                              <div class="accordion-body">
                                <div class="curriculum-item unlock completed">
                                  <div class="left">
                                    <h6><i class="fad fa-check-circle"></i> <span>Video:</span> Greetings and Introduction</h6>
                                  </div>
                                  <div class="right">
                                    <span class="duration">12:43</span>
                                    <span class="lock"><i class="fad fa-unlock"></i></span>
                                  </div>
                                </div>
                                <div class="curriculum-item unlock">
                                  <div class="left">
                                    <h6><i class="fad fa-play-circle"></i> <span>Video:</span> Greetings and Introduction</h6>
                                  </div>
                                  <div class="right">
                                    <span class="duration">12:43</span>
                                    <span class="lock"><i class="fad fa-unlock"></i></span>
                                  </div>
                                </div>
                                <div class="curriculum-item unlock">
                                  <div class="left">
                                    <h6><i class="fad fa-play-circle"></i> <span>Video:</span> Greetings and Introduction</h6>
                                  </div>
                                  <div class="right">
                                    <span class="duration">12:43</span>
                                    <span class="lock"><i class="fad fa-unlock"></i></span>
                                  </div>
                                </div>
                                <div class="curriculum-item">
                                  <div class="left">
                                    <h6><i class="fad fa-play-circle"></i> <span>Video:</span> Greetings and Introduction</h6>
                                  </div>
                                  <div class="right">
                                    <span class="duration">12:43</span>
                                    <span class="lock"><i class="fad fa-lock"></i></span>
                                  </div>
                                </div>
                                <div class="curriculum-item">
                                  <div class="left">
                                    <h6><i class="fad fa-volume"></i> <span>Audio:</span> Interactive lesson</h6>
                                  </div>
                                  <div class="right">
                                    <span class="duration">12:43</span>
                                    <span class="lock"><i class="fad fa-lock"></i></span>
                                  </div>
                                </div>
                                <div class="curriculum-item">
                                  <div class="left">
                                    <h6><i class="fad fa-file-alt"></i> <span>Reading:</span> Web Design &amp; Development</h6>
                                  </div>
                                  <div class="right">
                                    <span class="duration">12:43</span>
                                    <span class="lock"><i class="fad fa-lock"></i></span>
                                  </div>
                                </div>
                              </div>
                            </div>
                          </div>
                          <div class="accordion-item">
                            <h2 class="accordion-header">
                              <button
                                class="accordion-button collapsed"
                                type="button"
                                data-bs-toggle="collapse"
                                data-bs-target="#curriculum3"
                              >
                                Development Advance Level
                              </button>
                            </h2>
                            <div id="curriculum3" class="accordion-collapse collapse" data-bs-parent="#course-accordion">
                              <div class="accordion-body">
                                <div class="curriculum-item unlock completed">
                                  <div class="left">
                                    <h6><i class="fad fa-check-circle"></i> <span>Video:</span> Greetings and Introduction</h6>
                                  </div>
                                  <div class="right">
                                    <span class="duration">12:43</span>
                                    <span class="lock"><i class="fad fa-unlock"></i></span>
                                  </div>
                                </div>
                                <div class="curriculum-item unlock">
                                  <div class="left">
                                    <h6><i class="fad fa-play-circle"></i> <span>Video:</span> Greetings and Introduction</h6>
                                  </div>
                                  <div class="right">
                                    <span class="duration">12:43</span>
                                    <span class="lock"><i class="fad fa-unlock"></i></span>
                                  </div>
                                </div>
                                <div class="curriculum-item unlock">
                                  <div class="left">
                                    <h6><i class="fad fa-play-circle"></i> <span>Video:</span> Greetings and Introduction</h6>
                                  </div>
                                  <div class="right">
                                    <span class="duration">12:43</span>
                                    <span class="lock"><i class="fad fa-unlock"></i></span>
                                  </div>
                                </div>
                                <div class="curriculum-item">
                                  <div class="left">
                                    <h6><i class="fad fa-play-circle"></i> <span>Video:</span> Greetings and Introduction</h6>
                                  </div>
                                  <div class="right">
                                    <span class="duration">12:43</span>
                                    <span class="lock"><i class="fad fa-lock"></i></span>
                                  </div>
                                </div>
                                <div class="curriculum-item">
                                  <div class="left">
                                    <h6><i class="fad fa-volume"></i> <span>Audio:</span> Interactive lesson</h6>
                                  </div>
                                  <div class="right">
                                    <span class="duration">12:43</span>
                                    <span class="lock"><i class="fad fa-lock"></i></span>
                                  </div>
                                </div>
                                <div class="curriculum-item">
                                  <div class="left">
                                    <h6><i class="fad fa-file-alt"></i> <span>Reading:</span> Web Design &amp; Development</h6>
                                  </div>
                                  <div class="right">
                                    <span class="duration">12:43</span>
                                    <span class="lock"><i class="fad fa-lock"></i></span>
                                  </div>
                                </div>
                              </div>
                            </div>
                          </div>
                        </div>
                      </div>
                    </div>

                    <!-- tab 3 -->
                    <div class="tab-pane fade" id="course-tab3">
                      <div class="course-instructor mt-4">
                        <div class="instructor-img">
                          <img src="{{asset('assets/images/instructor.jpg')}}" alt="" />
                        </div>
                        <div class="instructor-info">
                          <h4>{{$course->instructor->first_name}} {{$course->instructor->last_name}}</h4>
                          <div class="instructor-info-wrap">
                            <div class="rating">
                              <i class="fas fa-star"></i>
                              <i class="fas fa-star"></i>
                              <i class="fas fa-star"></i>
                              <i class="fas fa-star"></i>
                              <i class="fas fa-star"></i>
                              <span>(4.5)</span>
                            </div>
                            <span class="course"><i class="fad fa-book-open"></i> 15 Courses</span>
                            <span class="enrolled"><i class="fad fa-user-friends"></i> 1.5k Enrolled</span>
                          </div>
                          <p>
                            There are many variations of passages orem psum available but the majority have suffered alteration in some
                            form, by injected humour.
                          </p>
                        </div>
                      </div>
                    </div>

                    <!-- tab 4 -->
                    <div class="tab-pane fade" id="course-tab4">
                      <div class="course-review">
                        <div class="review-wrap mt-4">
                          <!-- review-rating -->
                          <div class="review-rating">
                            <div class="rating-count">
                              <h2>4.5</h2>
                              <div class="rating-star">
                                <i class="fas fa-star"></i>
                                <i class="fas fa-star"></i>
                                <i class="fas fa-star"></i>
                                <i class="fas fa-star"></i>
                                <i class="far fa-star"></i>
                              </div>
                              <p>15.5k Students Review</p>
                            </div>
                            <div class="rating-range">
                              <div class="rating-range-item">
                                <div class="rating-range-star">
                                  <i class="fas fa-star"></i>
                                  <i class="fas fa-star"></i>
                                  <i class="fas fa-star"></i>
                                  <i class="fas fa-star"></i>
                                  <i class="fas fa-star"></i>
                                </div>
                                <div class="rating-range-bar">
                                  <div class="progress">
                                    <div class="progress-width" style="width: 90%"></div>
                                  </div>
                                </div>
                                <div class="rating-range-percentage">
                                  <span>90%</span>
                                </div>
                              </div>
                              <div class="rating-range-item">
                                <div class="rating-range-star">
                                  <i class="fas fa-star"></i>
                                  <i class="fas fa-star"></i>
                                  <i class="fas fa-star"></i>
                                  <i class="fas fa-star"></i>
                                  <i class="far fa-star"></i>
                                </div>
                                <div class="rating-range-bar">
                                  <div class="progress">
                                    <div class="progress-width" style="width: 80%"></div>
                                  </div>
                                </div>
                                <div class="rating-range-percentage">
                                  <span>80%</span>
                                </div>
                              </div>
                              <div class="rating-range-item">
                                <div class="rating-range-star">
                                  <i class="fas fa-star"></i>
                                  <i class="fas fa-star"></i>
                                  <i class="fas fa-star"></i>
                                  <i class="far fa-star"></i>
                                  <i class="far fa-star"></i>
                                </div>
                                <div class="rating-range-bar">
                                  <div class="progress">
                                    <div class="progress-width" style="width: 59%"></div>
                                  </div>
                                </div>
                                <div class="rating-range-percentage">
                                  <span>59%</span>
                                </div>
                              </div>
                              <div class="rating-range-item">
                                <div class="rating-range-star">
                                  <i class="fas fa-star"></i>
                                  <i class="fas fa-star"></i>
                                  <i class="far fa-star"></i>
                                  <i class="far fa-star"></i>
                                  <i class="far fa-star"></i>
                                </div>
                                <div class="rating-range-bar">
                                  <div class="progress">
                                    <div class="progress-width" style="width: 70%"></div>
                                  </div>
                                </div>
                                <div class="rating-range-percentage">
                                  <span>70%</span>
                                </div>
                              </div>
                              <div class="rating-range-item">
                                <div class="rating-range-star">
                                  <i class="fas fa-star"></i>
                                  <i class="far fa-star"></i>
                                  <i class="far fa-star"></i>
                                  <i class="far fa-star"></i>
                                  <i class="far fa-star"></i>
                                </div>
                                <div class="rating-range-bar">
                                  <div class="progress">
                                    <div class="progress-width" style="width: 49%"></div>
                                  </div>
                                </div>
                                <div class="rating-range-percentage">
                                  <span>49%</span>
                                </div>
                              </div>
                            </div>
                          </div>

                          <!-- review-content -->
                          <div class="review-content">
                            <h5 class="title">Reviews (1,500)</h5>
                            <div class="review-item">
                              <div class="review-author">
                                <img src="assets/img/instructor/rev-1.png" alt="" />
                                <div class="info">
                                  <div>
                                    <h6>Erich T. Genao</h6>
                                    <span><i class="far fa-clock"></i> 1 day ago</span>
                                  </div>
                                  <div class="rating">
                                    <i class="fas fa-star"></i>
                                    <i class="fas fa-star"></i>
                                    <i class="fas fa-star"></i>
                                    <i class="fas fa-star"></i>
                                    <i class="fas fa-star"></i>
                                  </div>
                                </div>
                              </div>
                              <p>
                                There are many variations of passages available but the majority have suffered alteration in some form by
                                injected humour randomised words. It is a long established fact that reader will be distracted by the
                                readable content of web page editors now use page when looking at its layout.
                              </p>
                            </div>
                            <div class="review-item">
                              <div class="review-author">
                                <img src="assets/img/instructor/rev-2.png" alt="" />
                                <div class="info">
                                  <div>
                                    <h6>Erich T. Genao</h6>
                                    <span><i class="far fa-clock"></i> 1 day ago</span>
                                  </div>
                                  <div class="rating">
                                    <i class="fas fa-star"></i>
                                    <i class="fas fa-star"></i>
                                    <i class="fas fa-star"></i>
                                    <i class="fas fa-star"></i>
                                    <i class="fas fa-star"></i>
                                  </div>
                                </div>
                              </div>
                              <p>
                                There are many variations of passages available but the majority have suffered alteration in some form by
                                injected humour randomised words. It is a long established fact that reader will be distracted by the
                                readable content of web page editors now use page when looking at its layout.
                              </p>
                            </div>
                            <div class="review-item">
                              <div class="review-author">
                                <img src="assets/img/instructor/rev-1.png" alt="" />
                                <div class="info">
                                  <div>
                                    <h6>Erich T. Genao</h6>
                                    <span><i class="far fa-clock"></i> 1 day ago</span>
                                  </div>
                                  <div class="rating">
                                    <i class="fas fa-star"></i>
                                    <i class="fas fa-star"></i>
                                    <i class="fas fa-star"></i>
                                    <i class="fas fa-star"></i>
                                    <i class="fas fa-star"></i>
                                  </div>
                                </div>
                              </div>
                              <p>
                                There are many variations of passages available but the majority have suffered alteration in some form by
                                injected humour randomised words. It is a long established fact that reader will be distracted by the
                                readable content of web page editors now use page when looking at its layout.
                              </p>
                            </div>
                            <div class="text-center mt-4">
                              <a href="#" class="theme-btn"> <span class="fas fa-sync-alt"></span> Load More</a>
                            </div>
                          </div>

                          <!-- review-form -->
                          <div class="review-form">
                            <h5>Leave A Review</h5>
                            <form action="#">
                              <div class="form-group">
                                <label class="form-label">Your Rating</label>
                                <select class="form-select">
                                  <option value="">Choose Your Rating</option>
                                  <option value="5">5 Stars</option>
                                  <option value="4">4 Stars</option>
                                  <option value="3">3 Stars</option>
                                  <option value="2">2 Stars</option>
                                  <option value="1">1 Star</option>
                                </select>
                              </div>
                              <div class="form-group">
                                <label class="form-label">Your Review</label>
                                <textarea class="form-control" cols="30" rows="5" placeholder="Write your review"></textarea>
                              </div>
                              <button class="theme-btn" type="button">Post Your Review<i class="far fa-arrow-right"></i></button>
                            </form>
                          </div>
                        </div>
                      </div>
                    </div>
                  </div>
                </div>
                <!-- course single tab end -->
              </div>
            </div>
            <div class="col-lg-5 col-xl-4">
              <!-- course-single-sidebar -->
              <div class="course-single-sidebar">
                <div class="price-wrap">
                  <div class="price-amount"><span>${{$course->course_fee}}</span></div>
                  {{-- <span class="price-off">35% Off</span> --}}
                </div>
                <a href="#" class="theme-btn"> <span class="far fa-shopping-bag"></span> Add To Cart</a>
                <div class="more-info">
                  <ul>
                    <li><i class="fad fa-user"></i> Instructor: <span>{{$course->instructor->first_name}} {{$course->instructor->last_name}}</span></li>
                    <li><i class="fad fa-layer-group"></i> Level : <span>{{$course->course_level}}</span></li>
                    <li><i class="fad fa-book"></i> Lectures : <span>35 Lectures</span></li>
                    <li><i class="fad fa-clock"></i> Duration: <span>03 Months</span></li>
                    <li><i class="fad fa-user-friends"></i> Enrolled: <span>259 Students</span></li>
                    <li><i class="fad fa-globe"></i> Language: <span>English</span></li>
                  </ul>
                </div>
                <div class="include">
                  <h5>Course Includes</h5>
                  <ul>
                    <li><i class="fad fa-check-circle"></i> Full Lifetime Access</li>
                    <li><i class="fad fa-check-circle"></i> 35+ Downloadable Resources</li>
                    <li><i class="fad fa-check-circle"></i> Certificate Of Completion</li>
                    <li><i class="fad fa-check-circle"></i> Free Trial 7 Days</li>
                    <li><i class="fad fa-check-circle"></i> 15 Days Money Back Guarantee</li>
                  </ul>
                </div>
                <div class="share">
                  <h5>Social Share</h5>
                  <div class="share-link">
                    <a href="#"><i class="fab fa-facebook-f"></i></a>
                    <a href="#"><i class="fab fa-x-twitter"></i></a>
                    <a href="#"><i class="fab fa-instagram"></i></a>
                    <a href="#"><i class="fab fa-linkedin-in"></i></a>
                    <a href="#"><i class="fab fa-youtube"></i></a>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
      <!-- course-single end -->
       <!-- course area -->
      <div class="course-area bg-img py-80">
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
                <a href="course-single.html"><img src="{{asset('assets/images/courses/' . $course->thumbnail_image)}}" alt="" /></a>
              </div>
              <div class="course-content">
                {{-- <div class="course-meta">
                  <span class="category c1">Development</span>
                  <div class="rating">
                    <i class="fas fa-star"></i>
                    <span>3.5k</span>
                  </div>
                </div> --}}
                <h4 class="course-title"><a href="{{ route('user.course.details', $course->slug) }}">{{$course->course_name}}</a></h4>
                <div class="course-info">
                  <p style="
                    overflow: hidden;
                    text-overflow: ellipsis;display: -webkit-box;
                    -webkit-line-clamp: 2;
                    -webkit-box-orient: vertical;">{{$course->short_description}}</p>
                </div>
                <div class="course-bottom">
                  <a href="javascript:void(0)" data-course-id="{{ $course->id }}"
                                        data-course-name="{{ $course->course_name }}">
                    <div class="course-instructor">

                      <h6>Book Free Assessment</h6>
                    </div>
                  </a>
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
    <!-- Hero Section -->
    <section class="bg-gradient-to-br from-[#073a89] to-[#0091b9] text-white py-16 relative">
        <div class="container mx-auto px-6">
            <!-- Breadcrumb -->
            <nav class="text-sm mb-6 opacity-90">
                <ol class="flex items-center space-x-2">
                    <li>
                        <a href="/" class="hover:text-[#ffd500] transition">Home</a>
                    </li>
                    <li>/</li>
                    <li>
                        <a href="{{ route('courses.index') }}" class="hover:text-[#ffd500] transition">Courses</a>
                    </li>
                    <li>/</li>
                    <li class="text-[#ffd500] font-semibold">{{ $course->slug }}</li>
                </ol>
            </nav>



            <h1 class="text-4xl md:text-5xl font-bold mb-4">
                {{ $course->course_name }}
            </h1>

            <div class="flex flex-wrap items-center gap-4 mb-4 opacity-90">
                <div class="flex items-center">
                    <i class="fas fa-signal mr-2"></i>
                    <span>{{ $course->course_level }}</span>
                </div>
                <div class="flex items-center">
                    <i class="fas fa-clock mr-2"></i>
                    <span>{{ $course->course_duration }}</span>
                </div>
                <div class="flex items-center">
                    <i class="fas fa-calendar-alt mr-2"></i>
                    <span>{{ \Carbon\Carbon::parse($course->start_date)->format('M d, Y') }}</span>
                </div>
            </div>

            @if($course->is_featured)
                <div class="inline-flex items-center px-3 py-1 rounded-full bg-red-500 text-white text-sm">
                    <i class="fas fa-star mr-1"></i>
                    Featured Course
                </div>
            @endif
        </div>

        <!-- Decorative blur -->
        <div class="absolute top-0 right-0 w-64 h-64 bg-[#ffd500] opacity-10 blur-3xl rounded-full"></div>
    </section>

    <!-- Course Details Section -->
    <section class="py-16 bg-white">
        <div class="container mx-auto px-4 sm:px-6 lg:px-8">
            <div class="grid grid-cols-1 lg:grid-cols-3 gap-12">
                <!-- Left Column: Course Details -->
                <div class="lg:col-span-2">
                    <!-- Course Description -->
                    <div class="mb-12">
                        <h2 class="text-3xl font-bold mb-6" style="color: #073a89;">Course Description</h2>
                        <div class="policy-content overflow-hidden">
            <div class="prose prose-lg max-w-none break-words overflow-wrap-anywhere">
                {!! $course->course_description !!}
            </div>
                    </div>

                    <!-- Course Highlights -->
                     <div class="mb-12">
                         @php
                                $benefits = explode(",", $course->benefits);
                            @endphp
                            @if($course->benefits)
                        <h2 class="text-3xl font-bold mb-6" style="color: #073a89;">Parent-Friendly Benefits</h2>
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">

                            @foreach($benefits as $benefit)
                                <div class="flex items-start space-x-3">
                                    <div class="w-8 h-8 rounded-full flex items-center justify-center mt-1" style="background-color: #bae4f0;">
                                        <i class="fas fa-check text-sm" style="color: #073a89;"></i>
                                    </div>
                                    <p style="color: #1d1d1d;">{{ $benefit }}</p>
                            </div>
                            @endforeach
                        </div>
                            @endif

                    </div>

                    <!-- Instructor Section -->
                    @if($course->instructor)
                    <div class="mb-12">
                        <h2 class="text-3xl font-bold mb-6" style="color: #073a89;">Meet Your Instructor</h2>
                        <div class="bg-gradient-to-br from-[#f8fafc] to-[#f0f9ff] rounded-2xl p-8 border border-gray-100">
                            <div class="flex flex-col md:flex-row items-start md:items-center gap-6">
                                <!-- Instructor Image -->
                                <div class="flex-shrink-0">
                                    <div class="w-24 h-24 rounded-full overflow-hidden border-4 border-white shadow-lg">
                                        @if($course->instructor->profile_image)
                                            <img src="{{ asset('storage/' . $course->instructor->profile_image) }}"
                                                 alt="{{ $course->instructor->name }}"
                                                 class="w-full h-full object-cover">
                                        @else
                                            <div class="w-full h-full flex items-center justify-center" style="background-color: #bae4f0;">
                                                <i class="fas fa-user text-3xl" style="color: #073a89;"></i>
                                            </div>
                                        @endif
                                    </div>
                                </div>

                                <!-- Instructor Details -->
                                <div class="flex-1">
                                    <h3 class="text-2xl font-bold mb-2" style="color: #073a89;">
                                        {{ $course->instructor->first_name }} {{ $course->instructor->last_name }}
                                    </h3>
                                    @if($course->instructor->title)
                                        <p class="text-lg mb-3" style="color: #0091b9;">{{ $course->instructor->title }}</p>
                                    @endif

                                    @if($course->instructor->description)
                                        <p class="text-gray-700 mb-4">{{ Str::limit($course->instructor->description, 200) }}</p>
                                    @endif

                                    <!-- Instructor Stats -->
                                    <div class="flex flex-wrap gap-4">
                                        @if($course->instructor->experience_years)
                                            <div class="flex items-center">
                                                <div class="w-8 h-8 rounded-full flex items-center justify-center mr-2"
                                                     style="background-color: #bae4f0;">
                                                    <i class="fas fa-briefcase text-sm" style="color: #073a89;"></i>
                                                </div>
                                                <div>
                                                    <p class="text-sm text-gray-600">Experience</p>
                                                    <p class="font-semibold">{{ $course->instructor->experience_years }}+ Years</p>
                                                </div>
                                            </div>
                                        @endif

                                        @if($course->instructor->students_taught)
                                            <div class="flex items-center">
                                                <div class="w-8 h-8 rounded-full flex items-center justify-center mr-2"
                                                     style="background-color: #bae4f0;">
                                                    <i class="fas fa-users text-sm" style="color: #073a89;"></i>
                                                </div>
                                                <div>
                                                    <p class="text-sm text-gray-600">Students</p>
                                                    <p class="font-semibold">{{ number_format($course->instructor->students_taught) }}+</p>
                                                </div>
                                            </div>
                                        @endif
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    @endif
                </div>

                <!-- Right Column: Course Info & Registration -->
                <div class="lg:col-span-1">
                    <div class="sticky top-24">
                        <!-- Course Thumbnail -->
                        <div class="rounded-2xl overflow-hidden shadow-xl mb-6">
                            @if($course->thumbnail_image)
                                <img src="{{ asset('assets/images/courses/' . $course->thumbnail_image) }}"
                                     alt="{{ $course->course_name }}"
                                     class="w-full h-48 object-cover">
                            @else
                                <div class="w-full h-48 flex items-center justify-center"
                                     style="background: linear-gradient(135deg, #bae4f0 0%, #0091b9 100%);">
                                    <i class="fas fa-laptop-code text-5xl" style="color: #073a89;"></i>
                                </div>
                            @endif
                        </div>

                        <!-- Course Details Card -->
                        <div class="bg-gradient-to-br from-[#f8fafc] to-[#f0f9ff] rounded-2xl shadow-xl p-8 border border-gray-100 mb-6">
                            <h3 class="text-2xl font-bold mb-6 text-center" style="color: #073a89;">Course Details</h3>

                            <div class="space-y-4">
                                <!-- Course Fee -->
                                <div class="flex justify-between items-center pb-4 border-b border-gray-200">
                                    <span class="text-gray-700">Course Fee</span>
                                    <span class="text-2xl font-bold" style="color: #FF6500;">
                                        ${{ number_format($course->course_fee) }}
                                    </span>
                                </div>

                                <!-- Duration -->
                                <div class="flex justify-between items-center">
                                    <div class="flex items-center">
                                        <div class="w-8 h-8 rounded-full flex items-center justify-center mr-3"
                                             style="background-color: #bae4f0;">
                                            <i class="fas fa-clock text-sm" style="color: #073a89;"></i>
                                        </div>
                                        <span>Duration</span>
                                    </div>
                                    <span class="font-semibold">{{ $course->course_duration }}</span>
                                </div>

                                <!-- Level -->
                                <div class="flex justify-between items-center">
                                    <div class="flex items-center">
                                        <div class="w-8 h-8 rounded-full flex items-center justify-center mr-3"
                                             style="background-color: #bae4f0;">
                                            <i class="fas fa-signal text-sm" style="color: #073a89;"></i>
                                        </div>
                                        <span>Level</span>
                                    </div>
                                    <span class="font-semibold">{{ $course->course_level }}</span>
                                </div>

                                <!-- Age Limit -->
                                <div class="flex justify-between items-center">
                                    <div class="flex items-center">
                                        <div class="w-8 h-8 rounded-full flex items-center justify-center mr-3"
                                             style="background-color: #bae4f0;">
                                            <i class="fas fa-user-graduate text-sm" style="color: #073a89;"></i>
                                        </div>
                                        <span>Age Limit</span>
                                    </div>
                                    <span class="font-semibold">{{ $course->age_limit }}+ Years</span>
                                </div>

                                <!-- Start Date -->
                                <div class="flex justify-between items-center">
                                    <div class="flex items-center">
                                        <div class="w-8 h-8 rounded-full flex items-center justify-center mr-3"
                                             style="background-color: #bae4f0;">
                                            <i class="fas fa-calendar-alt text-sm" style="color: #073a89;"></i>
                                        </div>
                                        <span>Start Date</span>
                                    </div>
                                    <span class="font-semibold">{{ \Carbon\Carbon::parse($course->start_date)->format('M d, Y') }}</span>
                                </div>

                                <!-- End Date -->
                                <div class="flex justify-between items-center">
                                    <div class="flex items-center">
                                        <div class="w-8 h-8 rounded-full flex items-center justify-center mr-3"
                                             style="background-color: #bae4f0;">
                                            <i class="fas fa-calendar-check text-sm" style="color: #073a89;"></i>
                                        </div>
                                        <span>End Date</span>
                                    </div>
                                    <span class="font-semibold">{{ \Carbon\Carbon::parse($course->end_date)->format('M d, Y') }}</span>
                                </div>
                            </div>

                            <!-- Status Badge -->
                            <div class="mt-6 text-center">
                                @if($course->status == 'active')
                                    <span class="inline-flex items-center px-4 py-2 rounded-full text-sm font-semibold bg-green-100 text-green-800">
                                        <i class="fas fa-circle text-xs mr-2"></i>
                                        {{ ucfirst($course->status) }}
                                    </span>
                                @elseif($course->status == 'upcoming')
                                    <span class="inline-flex items-center px-4 py-2 rounded-full text-sm font-semibold bg-blue-100 text-blue-800">
                                        <i class="fas fa-clock text-xs mr-2"></i>
                                        {{ ucfirst($course->status) }}
                                    </span>
                                @else
                                    <span class="inline-flex items-center px-4 py-2 rounded-full text-sm font-semibold bg-red-100 text-red-800">
                                        <i class="fas fa-times text-xs mr-2"></i>
                                        {{ ucfirst($course->status) }}
                                    </span>
                                @endif
                            </div>
                        </div>

                        <!-- Enroll Button -->
                        @if($course->status == 'active')
                            <button onclick="openEnrollmentModal()"
                                    class="w-full py-4 rounded-xl font-bold text-lg text-white transition-all duration-300 transform hover:scale-[1.02] hover:shadow-lg active:scale-[0.98] mb-6"
                                    style="background: linear-gradient(135deg, #FF6500 0%, #FF8C42 100%);">
                                <i class="fas fa-shopping-cart mr-2"></i>
                                ENROLL NOW
                            </button>
                        @elseif($course->status == 'upcoming')
                            <button onclick="openWaitlistModal()"
                                    class="w-full py-4 rounded-xl font-bold text-lg text-white transition-all duration-300 transform hover:scale-[1.02] hover:shadow-lg active:scale-[0.98] mb-6"
                                    style="background: linear-gradient(135deg, #0091b9 0%, #073a89 100%);">
                                <i class="fas fa-bell mr-2"></i>
                                JOIN WAITLIST
                            </button>
                        @else
                            <button disabled
                                    class="w-full py-4 rounded-xl font-bold text-lg text-gray-400 bg-gray-200 cursor-not-allowed mb-6">
                                <i class="fas fa-lock mr-2"></i>
                                COURSE NOT AVAILABLE
                            </button>
                        @endif

                        <!-- Share Course -->
                        <div class="text-center">
                            <p class="text-gray-600 mb-3">Share this course</p>
                            <div class="flex justify-center space-x-4">
                                <a href="#" class="w-10 h-10 rounded-full flex items-center justify-center bg-blue-100 text-blue-600 hover:bg-blue-200 transition">
                                    <i class="fab fa-facebook-f"></i>
                                </a>
                                <a href="#" class="w-10 h-10 rounded-full flex items-center justify-center bg-blue-100 text-blue-400 hover:bg-blue-200 transition">
                                    <i class="fab fa-twitter"></i>
                                </a>
                                <a href="#" class="w-10 h-10 rounded-full flex items-center justify-center bg-red-100 text-red-600 hover:bg-red-200 transition">
                                    <i class="fab fa-linkedin-in"></i>
                                </a>
                                <a href="#" class="w-10 h-10 rounded-full flex items-center justify-center bg-gray-100 text-gray-800 hover:bg-gray-200 transition">
                                    <i class="fas fa-link"></i>
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Related Courses Section -->
    @if($relatedCourses && $relatedCourses->count() > 0)
    <section class="py-16" style="background-color: #f8fafc;">
        <div class="container mx-auto px-4 sm:px-6 lg:px-8">
            <div class="text-center mb-12">
                <h2 class="text-3xl md:text-4xl font-bold mb-4" style="color: #073a89;">
                    Related Courses
                </h2>
                <p class="text-lg text-gray-600 max-w-2xl mx-auto">
                    Explore more courses that match your interests
                </p>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
                @foreach($relatedCourses as $relatedCourse)
                <div class="bg-white rounded-2xl overflow-hidden shadow-lg hover:shadow-xl transition-shadow duration-300">
                    @if($relatedCourse->thumbnail_image)
                        <img src="{{ asset('assets/images/courses/' . $relatedCourse->thumbnail_image) }}"
                             alt="{{ $relatedCourse->course_name }}"
                             class="w-full h-48 object-cover">
                    @else
                        <div class="w-full h-48 flex items-center justify-center"
                             style="background: linear-gradient(135deg, #bae4f0 0%, #0091b9 100%);">
                            <i class="fas fa-laptop-code text-4xl" style="color: #073a89;"></i>
                        </div>
                    @endif

                    <div class="p-6">

                        <h3 class="text-xl font-bold mb-3" style="color: #073a89;">
                            <a href="{{ route('courses.show', $relatedCourse->slug) }}"
                               class="hover:text-[#0091b9] transition">
                                {{ $relatedCourse->course_name }}
                            </a>
                        </h3>

                        <p class="text-gray-600 mb-4 line-clamp-2">
                            {{ Str::limit($relatedCourse->short_description, 100) }}
                        </p>

                        <div class="flex items-center justify-between">
                            <div class="flex items-center text-sm text-gray-500">
                                <i class="fas fa-clock mr-1"></i>
                                <span>{{ $relatedCourse->course_duration }}</span>
                            </div>
                            <a href="{{ route('courses.show', $relatedCourse->slug) }}"
                               class="font-semibold hover:text-[#FF6500] transition"
                               style="color: #0091b9;">
                                Learn More →
                            </a>
                        </div>
                    </div>
                </div>
                @endforeach
            </div>
        </div>
    </section>
    @endif
@endsection

@section('styles')
<style>
    .line-clamp-2 {
        display: -webkit-box;
        -webkit-line-clamp: 2;
        -webkit-box-orient: vertical;
        overflow: hidden;
    }

    .prose {
        line-height: 1.75;
    }

    .prose p {
        margin-bottom: 1rem;
    }
</style>
@endsection
