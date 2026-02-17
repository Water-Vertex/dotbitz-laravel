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
             <div class="course-card group relative overflow-hidden rounded-xl bg-white shadow-md transition-all duration-300 hover:shadow-lg hover:-translate-y-1"  data-level="{{strtolower($course->course_level)}}">
                        <span class="absolute left-3 top-3 z-10 rounded-full bg-indigo-600 px-3 py-1 text-xs font-semibold text-white">
                            {{$course->course_level}}
                        </span>
                        <div class="relative h-48 overflow-hidden">
                            <img src="{{asset('assets/images/courses/' . $course->thumbnail_image)}}" alt="{{$course->course_name}}" class="h-full w-full object-cover transition-transform duration-500 group-hover:scale-105">
                            
                        </div>
                        <div class="p-5">
                            <a href=""><h3 class="mb-2 text-lg font-bold text-gray-900">{{$course->course_name}}</h3></a>
                            <p class="mb-4 text-sm text-gray-600 line-clamp-5">{{$course->short_description}}</p>
                            <div class="flex items-center justify-between border-t border-gray-100 pt-4">
                                <div class="flex items-center">
                                    <p class="font-bold text-xs md:text-sm" style="color: #073a89;">Age: 20-23 Yrs</p>
                                </div>
                                <div class="text-right">
                                    <button class="open-assessment-modal px-4 py-2 rounded-xl font-bold text-white bg-[#FF6500] hover:bg-[#e55a00] transition-all"
                                        data-course-id="{{ $course->id }}"
                                        data-course-name="{{ $course->course_name }}">
                                        <i class="fas fa-calendar-check mr-2"></i> Book Assessment
                                    </button>
                                </div>
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
