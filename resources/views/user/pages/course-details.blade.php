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
            @foreach($relatedCourses as $index => $course)
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
