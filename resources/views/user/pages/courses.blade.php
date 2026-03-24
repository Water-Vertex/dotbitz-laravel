@extends('user.layouts.app')
@section('styles')

@endsection

@section('content')
<div class="site-breadcrumb" style="background: url({{asset('assets/images/course-banner.png')}})">
    <div class="container">
        <h2 class="breadcrumb-title">Courses</h2>
        <ul class="breadcrumb-menu">
        <li><a href="{{ route('user.home') }}">Home</a></li>
        <li class="active">Courses</li>
        </ul>
    </div>
</div>


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
          <div class="row g-4" data-wow-delay=".25s">
            @foreach($courses as $index => $course)
           <div class="col-lg-4 col-md-6">
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
                <h4 class="course-title" style="height:45px"><a href="{{ route('user.course.details', $course->slug) }}">{{$course->course_name}}</a></h4>
                <div class="course-info">
                  <p style="
  overflow: hidden;
  text-overflow: ellipsis;display: -webkit-box;
   -webkit-line-clamp: 5;
   -webkit-box-orient: vertical;">{{$course->short_description}}</p>
                </div>
                <div class="course-bottom">
                  <a href="javascript:void(0)" class="open-assessment-modal" data-course-id="{{ $course->id }}"
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
           </div>
            @endforeach
          </div>
        </div>
      </div>
      <!-- course area end -->
@endsection

@section('scripts')
<script>
$(document).ready(function () {

    // function to set active tab UI
    function setActiveTab($btn) {
        $('.filter-btn')
            .removeClass('active-tab')
            .css({
                "background-color": "#9CA3AF", // gray-400
                "color": "#fff"
            });

        $btn
            .addClass('active-tab')
            .css({
                "background-color": "#FF6500", // orange
                "color": "#fff"
            });
    }

    // Default Active = All Courses
    setActiveTab($('.filter-btn[data-level="all"]'));

    // Filter courses by level
    $('.filter-btn').on('click', function () {
        const level = $(this).data('level');

        // Active Tab Styling
        setActiveTab($(this));

        // Filter Cards
        let visibleCount = 0;

        $('.course-card').each(function () {
            const cardLevel = $(this).data('level');

            if (level === 'all' || cardLevel === level) {
                $(this).fadeIn(300);
                visibleCount++;
            } else {
                $(this).fadeOut(300);
            }
        });

        // No results logic
        if (visibleCount === 0) {
            $('#no-results').fadeIn(300);
            $('#courses-container').fadeOut(300);
        } else {
            $('#no-results').fadeOut(300);
            $('#courses-container').fadeIn(300);
        }
    });

});
</script>
@endsection
