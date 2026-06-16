@extends('user.layouts.app')
@section('content')
<div class="site-breadcrumb" style="background: url({{asset('assets/images/course-banner.png')}})">
    <div class="container">
        <h2 class="breadcrumb-title">Book Free Assessment</h2>
        <ul class="breadcrumb-menu">
        <li><a href="{{ route('user.home') }}">Home</a></li>
        <li class="active">Book Free Assessment</li>
        </ul>
    </div>
</div>
<div class="about-area py-120">
    <div class="container">
      <div class="row">
        <form action="{{ route('assessment.store') }}" method="POST" class="form">
                                @csrf
                                <input type="hidden" id="assessment_course_id" name="course_id" value="{{$course->id}}">
                                <div class="form-row">
                                    <div class="form-group">
                                        <label class="form-label">Full Name *</label>
                                        <input type="text" name="full_name" placeholder="Enter your full name" required class="form-input" value="{{ old('full_name') }}">
                                    </div>
                                    <div class="form-group">
                                        <label class="form-label">Email *</label>
                                        <input type="email" name="email" placeholder="Enter your email" required class="form-input" value="{{ old('email') }}">
                                    </div>
                                </div>
                                <div class="form-row">
                                    <div class="form-group">
                                        <label class="form-label">Phone *</label>
                                        <input type="text" name="phone" placeholder="Enter your phone number" required class="form-input" value="{{ old('phone') }}">
                                    </div>
                                    <div class="form-group">
                                        <label class="form-label">Course *</label>
                                        <input type="text" id="assessment_course_name" value="{{$course->course_name}}" disabled class="form-input" style="background-color: #f3f4f6;">
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="form-label">Message</label>
                                    <textarea name="message" placeholder="Enter your message" rows="3" class="form-textarea">{{ old('message') }}</textarea>
                                </div>
                                <div class="form-submit">
                                    <button type="submit" class="btn btn-primary">Submit Assessment</button>
                                </div>
                            </form>
      </div>
    </div>
</div>
        
@endsection