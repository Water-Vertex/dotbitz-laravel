@extends('user.layouts.app')

@section('content')
<div class="site-breadcrumb" style="background: url({{asset('assets/images/course-banner.png')}})">
    <div class="container">
        <h2 class="breadcrumb-title">Frequently Asked Questions</h2>
        <ul class="breadcrumb-menu">
        <li><a href="{{ route('user.home') }}">Home</a></li>
        <li class="active">FAQs</li>
        </ul>
    </div>
</div>
 <!-- faq area -->
      <div class="faq-area py-120">
        <div class="container">
          <div class="row">
            <div class="col-lg-12">
              <div class="faq-content wow fadeInUp" data-wow-delay=".25s">
                <div class="site-heading mb-3">
                  <span class="site-title-tagline"><i class="far fa-lightbulb-on"></i> Faq's</span>
                  <h2 class="site-title my-3">General <span class="text-gradient">frequently</span> asked questions</h2>
                </div>
                <p class="mb-3">
                 Got Questions? We’ve Got Answers
                </p>

              </div>
            </div>
            @foreach($faqs as $index => $faq)
            <div class="col-lg-6">
              <div class="accordion wow fadeInRight" data-wow-delay=".25s" id="accordionExample">

                <div class="accordion-item">
                  <h2 class="accordion-header" id="heading{{ $index + 1 }}">
                    <button
                      class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapse{{ $index + 1 }}" aria-expanded="false" aria-controls="collapse{{ $index + 1 }}"
                    >
                      <span><i class="far fa-question"></i></span> {{ $faq->question }}
                    </button>
                  </h2>
                  <div
                    id="collapse{{ $index + 1 }}"
                    class="accordion-collapse collapse"
                    aria-labelledby="heading{{ $index + 1 }}"
                    data-bs-parent="#accordionExample"
                  >
                    <div class="accordion-body">
                     {!! nl2br(e($faq->answer)) !!}
                    </div>
                  </div>
                </div>

              </div>
            </div>
             @endforeach
          </div>
        </div>
      </div>
      <!-- faq area end -->

@endsection


