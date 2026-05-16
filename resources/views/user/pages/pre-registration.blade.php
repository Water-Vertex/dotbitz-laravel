@extends('user.layouts.app')

@section('content')
<div class="site-breadcrumb" style="background: url({{asset('assets/images/course-banner.png')}})">
    <div class="container">
        <h2 class="breadcrumb-title">Pre Registration</h2>
        <ul class="breadcrumb-menu">
            <li><a href="{{ route('user.home') }}">Home</a></li>
            <li class="active">Pre Registration</li>
        </ul>
    </div>
</div>

<!-- contact area -->
<div class="contact-area pt-120 pb-100">
    <div class="container">
        
        <!-- Seat Alert Box -->
        <div class="row mb-5">
            <div class="col-12">
                @if($isFull)
                    <div class="alert alert-danger text-center" style="border-radius: 15px;">
                        <i class="fas fa-ban fa-2x mb-2"></i>
                        <h4>Sorry! All seats are filled</h4>
                        <p>Registration is currently closed. Please check back later for new sessions.</p>
                    </div>
                @else
                    <div class="alert alert-warning text-center" style="border-radius: 15px; background: linear-gradient(135deg, #FFF8E7, #FFF); border: 2px solid #FECE09;">
                        <div class="row align-items-center">
                            <div class="col-md-4">
                                <i class="fas fa-chair fa-3x" style="color: #FF6500;"></i>
                            </div>
                            <div class="col-md-8">
                                <h4 class="mb-2" style="color: #063989;">Limited Seats Available!</h4>
                                <div class="d-flex justify-content-between align-items-center">
                                    <div>
                                        <span style="font-size: 32px; font-weight: 800; color: #FF6500;">{{ $remainingSeats }}</span>
                                        <span>Seats Remaining</span>
                                    </div>
                                    <div class="progress flex-grow-1 mx-3" style="height: 10px;">
                                        @php
                                            $percentage = (($totalSeats - $remainingSeats) / $totalSeats) * 100;
                                        @endphp
                                        <div class="progress-bar bg-success" style="width: {{ $percentage }}%;"></div>
                                    </div>
                                    <div>
                                        <span>Total: {{ $totalSeats }}</span>
                                    </div>
                                </div>
                                <p class="mt-2 mb-0 small">Hurry up! Only {{ $remainingSeats }} spots left. Register now to secure your seat.</p>
                            </div>
                        </div>
                    </div>
                @endif
            </div>
        </div>
        
        <div class="contact-form-wrap">
            <div class="row g-4">
                <div class="col-lg-5">
                    <div class="contact-img">
                        <img src="{{asset('assets/images/contact.jpg')}}" alt="" />
                    </div>
                </div>
                <div class="col-lg-7">
                    <div class="contact-form">
                        <div class="contact-form-header">
                            <h2>Pre Registration</h2>
                            <p>Pre-register now to secure your spot before seats fill up!</p>
                        </div>
                        <div class="form-message"></div>
                        
                        @if($isFull)
                            <div class="text-center p-5">
                                <i class="fas fa-times-circle fa-4x text-danger mb-3"></i>
                                <h4>Registration Closed</h4>
                                <p>All {{ $totalSeats }} seats have been filled. New batch will be announced soon!</p>
                            </div>
                        @else
                            <form method="post" action="{{route('user.store-pre-register')}}">
                                @csrf
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <div class="form-icon">
                                                <i class="far fa-user-tie"></i>
                                                <input type="text" class="form-control" name="name" placeholder="Your Name" required />
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <div class="form-icon">
                                                <i class="far fa-envelope"></i>
                                                <input type="email" class="form-control" name="email" placeholder="Your Email" required />
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <div class="form-icon">
                                        <i class="far fa-pen"></i>
                                        <input type="text" class="form-control" name="phone" placeholder="Your Phone" required />
                                    </div>
                                </div>
                                <div class="form-group">
                                    <div class="form-icon">
                                        <i class="far fa-comment-lines"></i>
                                        <textarea name="message" cols="30" rows="5" class="form-control" placeholder="Write Your Message" required></textarea>
                                    </div>
                                </div>
                                <button type="submit" class="theme-btn">Register <i class="far fa-paper-plane"></i></button>
                            </form>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- end contact area -->

@endsection