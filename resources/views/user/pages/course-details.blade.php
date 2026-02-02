@extends('user.layouts.app')
@section('content')
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
                        <div class="prose max-w-none text-lg" style="color: #1d1d1d;">
                            {!! nl2br(e($course->course_description)) !!}
                        </div>
                    </div>

                    <!-- Course Highlights -->
                    <div class="mb-12">
                        <h2 class="text-3xl font-bold mb-6" style="color: #073a89;">What You'll Learn</h2>
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                            <div class="flex items-start space-x-3">
                                <div class="w-8 h-8 rounded-full flex items-center justify-center mt-1" style="background-color: #bae4f0;">
                                    <i class="fas fa-check text-sm" style="color: #073a89;"></i>
                                </div>
                                <p style="color: #1d1d1d;">Master fundamental programming concepts</p>
                            </div>
                            <div class="flex items-start space-x-3">
                                <div class="w-8 h-8 rounded-full flex items-center justify-center mt-1" style="background-color: #bae4f0;">
                                    <i class="fas fa-check text-sm" style="color: #073a89;"></i>
                                </div>
                                <p style="color: #1d1d1d;">Build real-world projects and applications</p>
                            </div>
                            <div class="flex items-start space-x-3">
                                <div class="w-8 h-8 rounded-full flex items-center justify-center mt-1" style="background-color: #bae4f0;">
                                    <i class="fas fa-check text-sm" style="color: #073a89;"></i>
                                </div>
                                <p style="color: #1d1d1d;">Develop problem-solving and logical thinking skills</p>
                            </div>
                            <div class="flex items-start space-x-3">
                                <div class="w-8 h-8 rounded-full flex items-center justify-center mt-1" style="background-color: #bae4f0;">
                                    <i class="fas fa-check text-sm" style="color: #073a89;"></i>
                                </div>
                                <p style="color: #1d1d1d;">Prepare for advanced programming challenges</p>
                            </div>
                        </div>
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
                            {{ Str::limit($relatedCourse->course_description, 100) }}
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
