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
html {
    scroll-behavior: smooth;
}
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
@media (max-width: 768px) {
    .policy-content .prose { font-size: 1rem; line-height: 1.6; }
    .policy-content .prose h1 { font-size: 1.5rem; }
    .policy-content .prose h2 { font-size: 1.25rem; }
    .policy-content .prose h3 { font-size: 1.125rem; }
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
        <p>{{ $course->short_description }}</p>
        <div class="rating">
          <i class="fas fa-star"></i>
          <i class="fas fa-star"></i>
          <i class="fas fa-star"></i>
          <i class="fas fa-star"></i>
          <i class="far fa-star"></i>
          <span class="rating-avg">4.5</span>
          <span>(1.5k Reviews)</span>
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

          <!-- video area -->
          <div class="video-area" style="background-image: url({{asset('assets/images/courses/' . $course->thumbnail_image)}})">
            <div class="row"><div class="col-lg-12"></div></div>
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
                <button class="nav-link" data-bs-toggle="tab" data-bs-target="#course-tab3" type="button">
                  Instructor
                  @if(isset($courseInstructors) && $courseInstructors->count() > 1)
                    <span style="background:#063989; color:#fff; font-size:11px;
                                 padding:1px 7px; border-radius:20px; margin-left:4px;">
                      {{ $courseInstructors->count() }}
                    </span>
                  @endif
                </button>
              </li>
              <li class="nav-item">
                <button class="nav-link" data-bs-toggle="tab" data-bs-target="#course-tab4" type="button">Review</button>
              </li>
            </ul>

            <div class="tab-content">

              <!-- tab 1 — Description -->
              <div class="tab-pane fade" id="course-tab1">
                <div class="course-details mt-4">
                  <div class="mb-4">
                    <h5 class="mb-10">Description</h5>
                    <p>{!! $course->course_description !!}</p>
                  </div>
                </div>
              </div>

              <!-- tab 2 — Curriculum -->
              <div class="tab-pane fade active show" id="course-tab2">
                <div class="course-curriculum mt-4">
                  <div class="accordion accordion-flush" id="course-accordion">
                    <div class="accordion-item">
                      <h2 class="accordion-header">
                        <button class="accordion-button" type="button"
                          data-bs-toggle="collapse" data-bs-target="#curriculum1">
                          Get Started
                        </button>
                      </h2>
                      <div id="curriculum1" class="accordion-collapse collapse show"
                           data-bs-parent="#course-accordion">
                        <div class="accordion-body">
                          @foreach($course->curriculums as $curriculum)
                          <div class="curriculum-item unlock">
                            <div class="left">
                              <h6>{{$curriculum->title}}</h6>
                            </div>
                            <div class="right">
                              <span class="duration">{{$curriculum->duration}} Weeks</span>
                              <span class="lock"><i class="fad fa-unlock"></i></span>
                            </div>
                          </div>
                          @endforeach
                        </div>
                      </div>
                    </div>
                  </div>
                </div>
              </div>

              <!-- tab 3 — Instructor -->
              <div class="tab-pane fade" id="course-tab3">
                <div class="mt-4">

                  @php
                    $instructorsToShow = isset($courseInstructors) && $courseInstructors->count()
                      ? $courseInstructors
                      : collect();
                  @endphp

                  @forelse($instructorsToShow as $inst)

                    {{-- Instructor Profile --}}
                    <div class="course-instructor">

                      {{-- Avatar with initials --}}
                      <div class="instructor-img">
                        <div style="width:110px; height:110px; border-radius:50%;
                                    background:linear-gradient(135deg,#063989,#0e5de0);
                                    display:flex; align-items:center; justify-content:center;
                                    font-size:36px; color:#fff; font-weight:700;">
                          {{ strtoupper(substr($inst['first_name'] ?? 'I', 0, 1)) }}{{ strtoupper(substr($inst['last_name'] ?? '', 0, 1)) }}
                        </div>
                      </div>

                      {{-- Info --}}
                      <div class="instructor-info">
                        <h4>{{ $inst['first_name'] }} {{ $inst['last_name'] }}</h4>
                        <div class="instructor-info-wrap">
                          <div class="rating">
                            <i class="fas fa-star"></i>
                            <i class="fas fa-star"></i>
                            <i class="fas fa-star"></i>
                            <i class="fas fa-star"></i>
                            <i class="fas fa-star"></i>
                          </div>
                          <span class="course">
                            <i class="fad fa-book-open"></i>
                            {{ $inst['total_courses'] }} Course{{ $inst['total_courses'] != 1 ? 's' : '' }}
                          </span>
                          <span class="enrolled">
                            <i class="fad fa-user-friends"></i>
                            {{ $inst['total_students'] }} Enrolled
                          </span>
                        </div>
                        <p>Experienced instructor dedicated to helping students build real-world tech skills.</p>
                      </div>
                    </div>

                    {{-- Other Courses by this Instructor --}}
                    @if(!empty($inst['other_courses']) && count($inst['other_courses']) > 0)
                    <div style="margin-top:24px; padding-top:20px; border-top:1px solid #eee;">
                      <h5 style="color:#063989; font-weight:700; margin-bottom:16px;">
                        <i class="fad fa-chalkboard-teacher" style="color:#FF6500; margin-right:6px;"></i>
                        Other Courses by {{ $inst['first_name'] }}
                        <span style="background:#063989; color:#fff; font-size:12px;
                                     padding:2px 9px; border-radius:20px; margin-left:6px;">
                          {{ count($inst['other_courses']) }}
                        </span>
                      </h5>

                      <div class="row g-3">
                        @foreach($inst['other_courses'] as $otherCourse)
                        <div class="col-md-6 col-lg-4">
                          <a href="{{ route('user.course.details', $otherCourse->slug) }}"
                             style="display:block; text-decoration:none;">
                            <div class="course-item" style="margin-bottom:0;">
                              <span class="course-tag c1">{{ $otherCourse->course_level }}</span>
                              <div class="course-img">
                                @if($otherCourse->thumbnail_image)
                                  <img src="{{ asset('assets/images/courses/' . $otherCourse->thumbnail_image) }}"
                                       alt="{{ $otherCourse->course_name }}" />
                                @else
                                  <div style="height:160px; background:linear-gradient(135deg,#e8f0fe,#f0f4ff);
                                              display:flex; align-items:center; justify-content:center; font-size:40px;">
                                    📚
                                  </div>
                                @endif
                              </div>
                              <div class="course-content">
                                <h4 class="course-title" style="font-size:14px; height:auto; margin-bottom:8px;">
                                  {{ $otherCourse->course_name }}
                                </h4>
                                <div class="course-bottom">
                                  <span style="font-size:13px; color:#888;">
                                    <i class="fad fa-user-friends" style="color:#063989; margin-right:3px;"></i>
                                    {{ $otherCourse->students->count() }} Students
                                  </span>
                                  @if($otherCourse->course_fee)
                                    <div class="course-price">
                                      <span>${{ number_format($otherCourse->course_fee, 0) }}</span>
                                    </div>
                                  @endif
                                </div>
                              </div>
                            </div>
                          </a>
                        </div>
                        @endforeach
                      </div>
                    </div>
                    @endif

                    {{-- Separator agar multiple instructors hain --}}
                    @if(!$loop->last)
                      <hr style="border:none; border-top:2px dashed #e5e9f5; margin:28px 0;">
                    @endif

                  @empty
                    <div style="text-align:center; padding:48px 20px;">
                      <div style="font-size:52px; margin-bottom:12px;">👨‍🏫</div>
                      <p style="font-size:16px; color:#888;">No instructor assigned to this course yet.</p>
                    </div>
                  @endforelse

                </div>
              </div>

      <!-- tab 4 — Review -->
<div class="tab-pane fade" id="course-tab4">
    <div class="course-review">
        <div class="review-wrap mt-4">

            <!-- review-rating -->
            <div class="review-rating">

                <!-- rating-count -->
                <div class="rating-count">
                    <h2>{{ number_format($averageRating, 1) }}</h2>

                    <div class="rating-star">
                        @for($i = 1; $i <= 5; $i++)
                            @if($i <= floor($averageRating))
                                <i class="fas fa-star"></i>
                            @elseif($i - $averageRating < 1)
                                <i class="fas fa-star-half-alt"></i>
                            @else
                                <i class="far fa-star"></i>
                            @endif
                        @endfor
                    </div>

                    <p>
                        {{ $totalReviews }}
                        Student{{ $totalReviews != 1 ? 's' : '' }} Review
                    </p>
                </div>

                <!-- rating-range -->
                <div class="rating-range">
                    @foreach($ratingDistribution as $star => $data)
                    <div class="rating-range-item">

                        <div class="rating-range-star">
                            @for($i = 1; $i <= 5; $i++)
                                @if($i <= $star)
                                    <i class="fas fa-star"></i>
                                @else
                                    <i class="far fa-star"></i>
                                @endif
                            @endfor
                        </div>

                        <div class="rating-range-bar">
                            <div class="progress">
                                <div class="progress-width"
                                     style="width: {{ $data['percent'] }}%">
                                </div>
                            </div>
                        </div>

                        <div class="rating-range-percentage">
                            <span>{{ $data['percent'] }}%</span>
                        </div>

                    </div>
                    @endforeach
                </div>
            </div>

            <!-- review-content -->
            <div class="review-content">
                <h5 class="title">
                    Reviews ({{ $totalReviews }})
                </h5>

                @forelse($reviews as $review)

                <div class="review-item">

                    <div class="review-author">

                        <!-- avatar -->
                        <div style="
                            width:50px;
                            height:50px;
                            border-radius:50%;
                            background:linear-gradient(135deg,#063989,#0e5de0);
                            display:flex;
                            align-items:center;
                            justify-content:center;
                            color:#fff;
                            font-weight:700;
                            font-size:18px;
                            flex-shrink:0;
                        ">
                            {{ strtoupper(substr($review->reviewer_name, 0, 1)) }}
                        </div>

                        <div class="info">

                            <div>
                                <h6>{{ $review->reviewer_name }}</h6>

                                <span>
                                    <i class="far fa-clock"></i>
                                    {{ $review->created_at->diffForHumans() }}
                                </span>
                            </div>

                            <div class="rating">
                                @for($i = 1; $i <= 5; $i++)
                                    @if($i <= $review->rating)
                                        <i class="fas fa-star"></i>
                                    @else
                                        <i class="far fa-star"></i>
                                    @endif
                                @endfor
                            </div>

                        </div>
                    </div>

                    @if($review->review)
                        <p>{{ $review->review }}</p>
                    @endif

                </div>

                @empty

                <div class="text-center py-5">
                    <i class="fas fa-star fa-3x text-muted mb-3 d-block"
                       style="opacity:0.3;"></i>

                    <p class="text-muted">
                        No reviews yet.
                    </p>
                </div>

                @endforelse
            </div>

            <!-- review-form -->
            <div class="review-form">
                <h5>Leave A Review</h5>

                <p style="color:#888; font-size:14px; margin-bottom:16px;">
                    To leave a review, please login to your student portal.
                </p>

                <a href="https://portal.dotbitz.com/student/registration"
                   class="theme-btn"
                   target="_blank">
                    Go to Portal
                    <i class="fas fa-arrow-right"></i>
                </a>
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
          </div>
          @php
            $curriculum = \App\Models\CourseCurriculum::where('course_id',$course->id)->get();
          @endphp
          @if($curriculum->isEmpty())
            <a href="javascript:;" class="theme-btn">
              <span class="far fa-shopping-bag"></span> Coming Soon...
            </a>
          @else
            <a href="https://portal.dotbitz.com/student/registration" class="theme-btn">
              <span class="far fa-shopping-bag"></span> Enroll Now
            </a>
          @endif
          <div class="more-info">
            <ul>
              <li><i class="fad fa-layer-group"></i> Level : <span>{{$course->course_level}}</span></li>
              <li><i class="fad fa-book"></i> Classes : <span>35 Lectures</span></li>
              <li><i class="fad fa-clock"></i> Duration: <span>03 Months</span></li>
              <li><i class="fad fa-user-friends"></i> Enrolled: <span>{{$student_count}} Students</span></li>
              <li><i class="fad fa-globe"></i> Language: <span>English</span></li>
            </ul>
          </div>
          <div class="include">
            <h5>Course Includes</h5>
            <ul>
              <li><i class="fad fa-check-circle"></i> Full Lifetime Access</li>
              <li><i class="fad fa-check-circle"></i> 35+ Downloadable Resources</li>
              <li><i class="fad fa-check-circle"></i> Certificate Of Completion</li>
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

<!-- related courses -->
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
      @foreach($relatedCourses as $relatedCourse)
      <div class="course-item">
        <span class="course-tag c1">{{$relatedCourse->course_level}}</span>
        <div class="course-img">
          <a href="{{ route('user.course.details', $relatedCourse->slug) }}">
            <img src="{{asset('assets/images/courses/' . $relatedCourse->thumbnail_image)}}" alt="" />
          </a>
        </div>
        <div class="course-content">
          <h4 class="course-title">
            <a href="{{ route('user.course.details', $relatedCourse->slug) }}">{{$relatedCourse->course_name}}</a>
          </h4>
          <div class="course-info">
            <p style="overflow:hidden; text-overflow:ellipsis; display:-webkit-box;
                      -webkit-line-clamp:2; -webkit-box-orient:vertical;">
              {{$relatedCourse->short_description}}
            </p>
          </div>
          <div class="course-bottom">
            <a href="{{route('user.book-assessment', $relatedCourse->id)}}"
               class="theme-btn"
               style="background:#FECE09 !important; color:#063989; padding:5px 10px; font-size:14px;">
              Book Free Assessment
            </a>
            <div class="course-price">
              <span style="font-size:14px;">Age: {{$relatedCourse->age_limit}}</span>
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
.prose { line-height: 1.75; }
.prose p { margin-bottom: 1rem; }
</style>
@endsection