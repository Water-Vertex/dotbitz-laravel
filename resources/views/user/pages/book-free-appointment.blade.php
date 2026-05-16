@extends('user.layouts.app')
@section('content')
<div class="site-breadcrumb" style="background: url({{asset('assets/images/course-banner.png')}})">
    <div class="container">
        <h2 class="breadcrumb-title">Book Free Appointment</h2>
        <ul class="breadcrumb-menu">
        <li><a href="{{ route('user.home') }}">Home</a></li>
        <li class="active">Book Free Appointment</li>
        </ul>
    </div>
</div>
<div class="about-area py-120">
    <div class="container">
      <div class="row">
        <form action="{{route('appointment.store')}}" method="POST" class="form">
                    @csrf
                    <div class="form-row">
                        <div class="form-group">
                            <label for="name" class="form-label">Full Name *</label>
                            <input type="text" id="name" name="name" placeholder="Enter your full name" value="{{old('name')}}" required class="form-input">
                        </div>
                        <div class="form-group">
                            <label for="email" class="form-label">Email Address *</label>
                            <input type="email" id="email" name="email" placeholder="Enter your email" value="{{old('email')}}" required class="form-input">
                        </div>
                    </div>
                    <div class="form-row">
                        <div class="form-group">
                            <label for="phone" class="form-label">Phone Number *</label>
                            <input type="text" id="phone" name="phone" placeholder="Enter your phone number" value="{{old('phone')}}" required class="form-input">
                        </div>
                        <div class="form-group">
                            <label for="course_id" class="form-label">Select Course *</label>
                            <select id="course_id" name="course_id" required class="form-select">
                                <option value="">Choose a course...</option>
                                
                                @foreach($courses as $course)
                                    <option value="{{ $course->id ?: old('course_id') }}">{{ $course->course_name }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <div class="form-row">
                        <div class="form-group">
                            <label for="appointment_date" class="form-label">Consultation Date *</label>
                            <input type="date" id="appointment_date" name="appointment_date" value="{{old('appointment_date')}}" required min="{{ date('Y-m-d') }}" class="form-input">
                            <p class="form-hint">Available Monday to Friday only</p>
                        </div>
                        <div class="form-group">
                            <label for="appointment_time" class="form-label">Consultation Time *</label>
                            <select name="appointment_time" id="appointment_time" required class="form-select">
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
                            <p class="form-hint">Available from 8:00 AM to 8:00 PM</p>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="message" class="form-label">Message (Optional)</label>
                        <textarea id="message" name="message" rows="2" placeholder="Any additional information..." class="form-textarea">{{old('message')}}</textarea>
                    </div>
                    <div class="form-submit">
                        <button type="submit" class="btn btn-primary">Submit Consultation</button>
                    </div>
                </form>
      </div>
    </div>
</div>
        
@endsection