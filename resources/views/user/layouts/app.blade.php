<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Course Platform</title>
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
  <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/flatpickr/dist/flatpickr.min.css">
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    @include('user.includes.styles')
    @yield('styles')
</head>
<body class="bg-gray-50">
    <!-- Mobile Menu Overlay -->
    <div class="overlay" id="overlay"></div>
     <!-- Success / Error Messages -->
                @if ($errors->any())
                    <div class="mb-4 bg-red-100 text-red-700 px-4 py-3 rounded-lg text-sm">
                        {{ $errors->first() }}
                    </div>
                @endif

                @if (session('success'))
                    <div class="mb-4 bg-green-100 text-green-700 px-4 py-3 rounded-lg text-sm">
                        {{ session('success') }}
                    </div>
                @endif

    <!-- Sticky Header -->
    @include('user.includes.header')


    <!-- Mobile Menu Drawer -->

    @yield('content')


     <!-- Consultation Modal -->
<div id="consultationModal" class="fixed inset-0 hidden z-50">

    <!-- Overlay -->
    <div class="absolute inset-0 bg-black/60"></div>

    <!-- Modal Wrapper (Scrollable Area) -->
    <div class="flex items-center justify-center h-screen p-4 overflow-hidden">

        <!-- Modal Content -->
        <div class="modal-scroll bg-white rounded-2xl shadow-2xl w-full max-w-4xl relative max-h-[90vh] overflow-y-auto" style="height:580px;overflow-y:scroll">

            <!-- Close Button -->
            <button id="closeModal"
                class="absolute top-4 right-4 text-gray-400 hover:text-gray-700 transition z-20">
                <i class="fas fa-times text-xl"></i>
            </button>

            <div class="p-6 md:p-8">
                <h2 class="text-2xl font-bold mb-6 text-center text-gray-800">
                    Book Free Consultation
                </h2>
                <form action="{{route('appointment.store')}}" method="POST" class="space-y-6">
                    @csrf

                    <!-- Row 1 -->
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-4 md:gap-6">
                        <div>
                            <label for="name" class="block text-sm font-medium text-gray-700 mb-1">
                                Full Name *
                            </label>
                            <input type="text" id="name" name="name" placeholder="Enter your full name" value="{{old('name')}}" required
                                class="w-full px-2 py-2 text-sm border border-gray-300 rounded-lg
                                focus:outline-none focus:ring-2 focus:ring-orange-400 focus:border-orange-400">
                        </div>

                        <div>
                            <label for="email" class="block text-sm font-medium text-gray-700 mb-1">
                                Email Address *
                            </label>
                            <input type="email" id="email" name="email" placeholder="Enter your email" value="{{old('email')}}" required
                                class="w-full px-2 py-2 text-sm border border-gray-300 rounded-lg
                                focus:outline-none focus:ring-2 focus:ring-orange-400 focus:border-orange-400">
                        </div>
                    </div>

                    <!-- Row 2 -->
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-4 md:gap-6">
                        <div>
                            <label for="phone" class="block text-sm font-medium text-gray-700 mb-1">
                                Phone Number *
                            </label>
                            <input type="text" id="phone" name="phone" placeholder="Enter your phone number" value="{{old('phone')}}" required
                                class="w-full px-2 py-2 text-sm border border-gray-300 rounded-lg
                                focus:outline-none focus:ring-2 focus:ring-orange-400 focus:border-orange-400">
                        </div>

                        <div>
                            <label for="course_id" class="block text-sm font-medium text-gray-700 mb-1">
                                Select Course *
                            </label>
                            <select id="course_id" name="course_id" required
                                class="w-full px-2 py-2 text-sm border border-gray-300 rounded-lg
                                focus:outline-none focus:ring-2 focus:ring-orange-400 focus:border-orange-400">
                                <option value="">Choose a course...</option>
                                @php
                                    $courses = \App\Models\Course::where('status','active')->get();
                                @endphp
                                @foreach($courses as $course)
                                    <option value="{{ $course->id ?: old('course_id') }}">{{ $course->course_name }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>

                    <!-- Row 3 -->
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-4 md:gap-6">
                        <div>
                            <label for="appointment_date" class="block text-sm font-medium text-gray-700 mb-1">
                                Consultation Date *
                            </label>
                            <input type="date" id="appointment_date" name="appointment_date" value="{{old('appointment_date')}}" required
                                min="{{ date('Y-m-d') }}"
                                class="w-full px-2 py-2 text-sm border border-gray-300 rounded-lg
                                focus:outline-none focus:ring-2 focus:ring-orange-400 focus:border-orange-400">
                            <p class="text-xs text-gray-500 mt-2">Available Monday to Friday only</p>
                        </div>

                        <div>
                            <label for="appointment_time" class="block text-sm font-medium text-gray-700 mb-1">
                                Consultation Time *
                            </label>
                            <select name="appointment_time" id="appointment_time" required
                                class="w-full px-2 py-2 text-sm border border-gray-300 rounded-lg
                                focus:outline-none focus:ring-2 focus:ring-orange-400 focus:border-orange-400">
                                <option value="">Select a time...</option>
                                @php
                                    $start = strtotime('08:00 AM');
                                    $end = strtotime('08:00 PM');
                                    while ($start <= $end) {
                                        $time = date('h:i A', $start);
                                        echo "<option value=\"$time\"".(old('appointment_time') == $time ? ' selected' : '').">$time</option>";
                                        $start = strtotime('+30 minutes', $start);
                                    }
                                @endphp
                            </select>
                            <p class="text-xs text-gray-500 mt-2">Available from 8:00 AM to 8:00 PM</p>
                        </div>
                    </div>

                    <!-- Message -->
                    <div>
                        <label for="message" class="block text-sm font-medium text-gray-700 mb-1">
                            Message (Optional)
                        </label>
                        <textarea id="message" name="message" rows="2" placeholder="Any additional information..."
                            class="w-full px-2 py-2 text-sm border border-gray-300 rounded-lg
                            focus:outline-none focus:ring-2 focus:ring-orange-400 focus:border-orange-400">{{old('message')}}</textarea>
                    </div>

                    <!-- Submit -->
                    <div class="pt-4">
                        <button type="submit"
                            class="w-full bg-[#FF6500] hover:bg-[#e65c00]
                            text-white px-4 sm:px-6 py-2 sm:py-2 rounded-lg font-semibold text-base transition duration-200
                            focus:outline-none focus:ring-2 focus:ring-orange-400 focus:ring-offset-2">
                            Submit Consultation
                        </button>
                    </div>
                </form>
            </div>

        </div>
    </div>
</div>

<!-- Assessment Modal -->
<div id="assessmentModal" class="fixed inset-0 hidden z-50">

    <!-- Overlay -->
    <div class="absolute inset-0 bg-black/60"></div>

    <!-- Modal Wrapper (Scrollable Area) -->
    <div class="flex items-center justify-center h-screen p-4 overflow-hidden">

        <!-- Modal Content -->
        <div class="modal-scroll bg-white rounded-2xl shadow-2xl w-full max-w-4xl relative max-h-[90vh] overflow-y-auto">

            <!-- Close Button -->
            <button id="closeAssessmentModal"
                class="absolute top-4 right-4 text-gray-400 hover:text-gray-700 transition z-20">
                <i class="fas fa-times text-xl"></i>
            </button>

            <div class="p-6 md:p-8">
                <h2 class="text-2xl font-bold mb-6 text-center text-gray-800">
                    Book Assessment
                </h2>

                <form action="{{ route('assessment.store') }}" method="POST" class="space-y-6">
                    @csrf

                    <input type="hidden" id="assessment_course_id" name="course_id">

                    <!-- Row 1 -->
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-4 md:gap-6">
                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-1">Full Name *</label>
                            <input type="text" name="full_name"  placeholder="Enter your full name" required
                                class="w-full px-2 py-2 text-sm border border-gray-300 rounded-lg
                                focus:outline-none focus:ring-2 focus:ring-orange-400 focus:border-orange-400"
                                value="{{ old('full_name') }}">
                        </div>

                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-1">Email *</label>
                            <input type="email" name="email"  placeholder="Enter your email" required
                                class="w-full px-2 py-2 text-sm border border-gray-300 rounded-lg
                                focus:outline-none focus:ring-2 focus:ring-orange-400 focus:border-orange-400"
                                value="{{ old('email') }}">
                        </div>
                    </div>

                    <!-- Row 2 -->
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-4 md:gap-6">
                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-1">Phone *</label>
                            <input type="text" name="phone"  placeholder="Enter your phone number " required
                                class="w-full px-2 py-2 text-sm border border-gray-300 rounded-lg
                                focus:outline-none focus:ring-2 focus:ring-orange-400 focus:border-orange-400"
                                value="{{ old('phone') }}">
                        </div>

                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-1">Course *</label>
                            <input type="text" id="assessment_course_name" disabled
                                class="w-full px-2 py-2 text-sm border border-gray-300 rounded-lg
                                bg-gray-100">
                        </div>
                    </div>

                    <!-- Row 3 -->
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-1">Message</label>
                        <textarea name="message"  placeholder="Enter your message" rows="3"
                            class="w-full px-2 py-2 text-sm border border-gray-300 rounded-lg
                            focus:outline-none focus:ring-2 focus:ring-orange-400 focus:border-orange-400">{{ old('message') }}</textarea>
                    </div>

                    <!-- Submit -->
                    <div class="pt-4">
                        <button type="submit"
                            class="w-full bg-[#FF6500] hover:bg-[#e65c00]
                            text-white px-4 sm:px-6 py-2 sm:py-2 rounded-lg font-semibold text-base transition duration-200
                            focus:outline-none focus:ring-2 focus:ring-orange-400 focus:ring-offset-2">
                            Submit Assessment
                        </button>
                    </div>

                </form>
            </div>

        </div>
    </div>
</div>

     <!-- Footer -->

    @include('user.includes.footer')
    <script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/flatpickr"></script>
    @include('user.includes.scripts')
    @yield('scripts')
     <!-- Modal Script -->

</body>
</html>
