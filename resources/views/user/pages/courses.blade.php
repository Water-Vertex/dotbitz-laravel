@extends('user.layouts.app')
@section('styles')
<style>
/* Add smooth transitions for the tabs */
.filter-btn {
    transition: all 0.3s ease;
}

.active-tab {
    transform: scale(1.05);
    box-shadow: 0 4px 12px rgba(255, 101, 0, 0.3);
}

/* Better responsive line clamping */
.line-clamp-3 {
    display: -webkit-box;
    -webkit-line-clamp: 3;
    -webkit-box-orient: vertical;
    overflow: hidden;
}

.line-clamp-4 {
    display: -webkit-box;
    -webkit-line-clamp: 4;
    -webkit-box-orient: vertical;
    overflow: hidden;
}

/* Improve mobile touch targets */
@media (max-width: 640px) {
    .book-assessment-btn,
    .filter-btn {
        min-height: 44px; /* Better touch target */
    }
}

/* Better card hover effects */
.course-card:hover img {
    transform: scale(1.05);
    transition: transform 0.5s ease;
}

/* Fix for no results message */
#no-results {
    display: none;
}
</style>
@endsection

@section('content')
<section class="bg-gradient-to-br from-[#073a89] to-[#0091b9] text-white py-16 relative">
    <div class="container mx-auto px-6">
        <!-- Breadcrumb -->
        <nav class="text-sm mb-4 opacity-90">
            <ol class="flex items-center space-x-2">
                <li>
                    <a href="/" class="hover:text-[#ffd500] transition">Home</a>
                </li>
                <li>/</li>
                <li class="text-[#ffd500] font-semibold">Courses</li>
            </ol>
        </nav>

        <!-- Heading -->
        <h1 class="text-4xl md:text-5xl font-bold mb-4">
            All Courses
        </h1>
        <p class="max-w-2xl text-lg opacity-90">
            Structured programs designed for different age groups and skill levels
        </p>
    </div>

</section>

<!-- Courses Section -->
<section class="pt-10 sm:pt-14 md:pt-16 lg:pt-20 pb-12 md:pb-16 lg:pb-24 bg-gray-50">
    <div class="container mx-auto px-4 sm:px-6 lg:px-8">
        <!-- Filter Tabs -->
        <div class="flex flex-wrap justify-center gap-2 sm:gap-4 mb-10">
            <button class="filter-btn active-tab px-4 sm:px-6 py-2 sm:py-3 rounded-lg font-medium text-white bg-[#FF6500] hover:bg-[#e65a00] transition-all duration-300 text-sm sm:text-base whitespace-nowrap"
                    data-level="all">
                All Courses
            </button>
            <button class="filter-btn px-4 sm:px-6 py-2 sm:py-3 rounded-lg font-medium text-white bg-gray-400 hover:bg-gray-500 transition-all duration-300 text-sm sm:text-base whitespace-nowrap"
                    data-level="beginner">
                Beginner
            </button>
            <button class="filter-btn px-4 sm:px-6 py-2 sm:py-3 rounded-lg font-medium text-white bg-gray-400 hover:bg-gray-500 transition-all duration-300 text-sm sm:text-base whitespace-nowrap"
                    data-level="intermediate">
                Intermediate
            </button>
            <button class="filter-btn px-4 sm:px-6 py-2 sm:py-3 rounded-lg font-medium text-white bg-gray-400 hover:bg-gray-500 transition-all duration-300 text-sm sm:text-base whitespace-nowrap"
                    data-level="advanced">
                Advanced
            </button>
        </div>

        <!-- Courses Grid -->
        <div id="courses-container" class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6 sm:gap-8">
            @foreach($courses as $course)
            <div class="course-card bg-white rounded-2xl sm:rounded-3xl shadow-lg sm:shadow-xl overflow-hidden transition-all duration-300 hover:shadow-2xl hover:-translate-y-2 h-full"
                 data-level="{{strtolower($course->course_level)}}">
                <!-- Course Image -->
                <div class="relative h-48 sm:h-56 overflow-hidden">
                    <img src="{{asset('assets/images/courses/'. $course->thumbnail_image)}}"
                        alt="{{$course->course_name}}"
                        class="w-full h-full object-cover transition-transform duration-500">
                    <!-- Level Badge -->
                    <div class="absolute top-3 sm:top-4 left-3 sm:left-4">
                        <span class="inline-block px-3 sm:px-4 py-1 sm:py-2 rounded-full text-xs sm:text-sm font-semibold text-white"
                            style="background: rgba(7, 58, 137, 0.9);">
                            <i class="fas fa-star mr-1 sm:mr-2"></i>
                            {{$course->course_level}}
                        </span>
                    </div>
                </div>

                <!-- Card Content -->
                <div class="p-5 sm:p-6 md:p-8 flex flex-col">
                    <!-- Course Name -->
                    <div class="mb-4">
                         <a href="{{route('user.course.details',$course->slug)}}"> <h3 class="text-xl md:text-2xl font-bold" style="color: #073a89;">{{$course->course_name}}</h3></a>
                    </div>

                    <!-- Description -->
                    <p class="text-gray-700 mb-6 text-sm sm:text-base line-clamp-3 md:line-clamp-4 flex-grow">
                        {{$course->course_description}}
                    </p>

                    <!-- Age and Button -->
                    <div class="flex flex-col sm:flex-row items-start sm:items-center justify-between gap-3 sm:gap-4 mt-auto pt-4 border-t border-gray-100">
                        <!-- Age Section -->
                        <div class="w-full sm:w-auto">
                            <div class="flex items-center p-2 sm:p-3 rounded-lg" style="background-color: #bae4f0;">
                                <div>
                                    <p class="font-bold text-xs sm:text-sm md:text-base" style="color: #073a89;">Age: {{$course->age_limit}} Yrs</p>
                                </div>
                            </div>
                        </div>

                        <!-- Book Assessment Button -->
                        <button class="book-assessment-btn px-4 py-2 sm:px-5 sm:py-2.5 md:px-6 md:py-3 rounded-lg sm:rounded-xl font-bold text-white whitespace-nowrap transition-all duration-300 hover:scale-105 text-xs sm:text-sm md:text-base w-full sm:w-auto"
                                style="background: #FF6500">
                            <i class="fas fa-calendar-check mr-1 sm:mr-2"></i>
                            Book Assessment
                        </button>
                    </div>
                </div>
            </div>
            @endforeach
        </div>

        <!-- No results message (hidden by default) -->
        <div id="no-results" class="hidden text-center py-12">
            <div class="text-gray-500 mb-4">
                <i class="fas fa-search fa-3x mb-4"></i>
                <h3 class="text-xl font-semibold mb-2">No courses found</h3>
                <p>Try selecting a different level</p>
            </div>
        </div>
    </div>
</section>
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
