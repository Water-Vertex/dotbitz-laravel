<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dotbitz.</title>
    <link rel="icon" href="{{asset('assets/images/logo/dotbitz-favicon.png')}}"/>
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
  <!--<link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css" rel="stylesheet">-->
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/7.0.1/css/all.min.css" integrity="sha512-2SwdPD6INVrV/lHTZbO2nodKhrnDdJK9/kg2XD1r9uGqPo1cUbujc+IYdlYdEErWNu69gVcYgdxlmVmzTWnetw==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/flatpickr/dist/flatpickr.min.css">
    @include('user.includes.styles')
    @yield('styles')
</head>
<body class="bg-gray-50">
    <!-- Mobile Menu Overlay -->
    <div class="overlay" id="overlay"></div>
     <!-- Success / Error Messages -->


    <!-- Sticky Header -->
    @include('user.includes.header')


    <!-- Mobile Menu Drawer -->
<main class="main">
    @yield('content')
</main>

<style>
/* Modal Base Styles */
.modal {
    position: fixed;
    inset: 0;
    z-index: 50;
    display: none;
}

.modal.active {
    display: block;
}

.modal-overlay {
    position: absolute;
    inset: 0;
    background: rgba(0, 0, 0, 0.6);
}

.modal-wrapper {
    display: flex;
    align-items: center;
    justify-content: center;
    height: 100vh;
    padding: 1rem;
    overflow: hidden;
}

.modal-content {
    background: white;
    border-radius: 1rem;
    box-shadow: 0 20px 25px -5px rgba(0, 0, 0, 0.1), 0 10px 10px -5px rgba(0, 0, 0, 0.04);
    width: 100%;
    max-width: 64rem;
    position: relative;
    max-height: 90vh;
    overflow-y: auto;
    height: 580px;
}

.modal-close {
    position: absolute;
    top: 1rem;
    right: 1rem;
    color: #9ca3af;
    background: none;
    border: none;
    cursor: pointer;
    z-index: 20;
    transition: color 0.2s;
}

.modal-close:hover {
    color: #374151;
}

.modal-close i {
    font-size: 1.25rem;
}

.modal-body {
    padding: 1.5rem;
}

@media (min-width: 768px) {
    .modal-body {
        padding: 2rem;
    }
}

.modal-title {
    font-size: 1.5rem;
    font-weight: bold;
    margin-bottom: 1.5rem;
    text-align: center;
    color: #1f2937;
}

/* Form Styles */
.form {
    display: flex;
    flex-direction: column;
    gap: 1.5rem;
}

.form-row {
    display: grid;
    grid-template-columns: 1fr;
    gap: 1rem;
}

@media (min-width: 768px) {
    .form-row {
        grid-template-columns: repeat(2, 1fr);
        gap: 1.5rem;
    }
}

.form-group {
    display: flex;
    flex-direction: column;
}

.form-label {
    display: block;
    font-size: 0.875rem;
    font-weight: 500;
    color: #374151;
    margin-bottom: 0.25rem;
}

.form-input,
.form-select,
.form-textarea {
    width: 100%;
    padding: 0.5rem 0.5rem;
    font-size: 0.875rem;
    border: 1px solid #d1d5db;
    border-radius: 0.5rem;
    transition: all 0.2s;
}

.form-input:focus,
.form-select:focus,
.form-textarea:focus {
    outline: none;
    ring: 2px solid #f97316;
    border-color: #f97316;
}

.form-input[disabled] {
    background-color: #f3f4f6;
}

.form-hint {
    font-size: 0.75rem;
    color: #6b7280;
    margin-top: 0.5rem;
}

/* Button Styles */
.btn {
    padding: 0.5rem 1.5rem;
    font-weight: 600;
    font-size: 1rem;
    border: none;
    border-radius: 0.5rem;
    cursor: pointer;
    transition: all 0.2s;
    width: 100%;
}

.btn-primary {
    background: #FF6500;
    color: white;
}

.btn-primary:hover {
    background: #e65c00;
}

.btn-primary:focus {
    outline: none;
    ring: 2px solid #f97316;
    ring-offset: 2px;
}

/* Utility Classes */
.overflow-hidden {
    overflow: hidden;
}

.hidden {
    display: none !important;
}

/* Form Submit Wrapper */
.form-submit {
    padding-top: 1rem;
}
</style>

<!-- Consultation Modal -->


<!-- Assessment Modal -->
<div id="assessmentModal" class="modal">
    <div class="modal-overlay"></div>
    <div class="modal-wrapper">
        <div class="modal-content" style="height: auto;">
            <button id="closeAssessmentModal" class="modal-close">
                <i class="fas fa-times"></i>
            </button>
            <div class="modal-body">
                <h2 class="modal-title">Book Assessment</h2>
                <form action="{{ route('assessment.store') }}" method="POST" class="form">
                    @csrf
                    <input type="hidden" id="assessment_course_id" name="course_id">
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
                            <input type="text" id="assessment_course_name" disabled class="form-input" style="background-color: #f3f4f6;">
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
</div>



     <!-- Footer -->

    @include('user.includes.footer')
    <script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/flatpickr"></script>
    <!--Start of Tawk.to Script-->
<script type="text/javascript">
var Tawk_API=Tawk_API||{}, Tawk_LoadStart=new Date();
(function(){
var s1=document.createElement("script"),s0=document.getElementsByTagName("script")[0];
s1.async=true;
s1.src='https://embed.tawk.to/699c15a2faf0a71c36d944cb/1ji4r9101';
s1.charset='UTF-8';
s1.setAttribute('crossorigin','*');
s0.parentNode.insertBefore(s1,s0);
})();
</script>
<!--End of Tawk.to Script-->
    @include('user.includes.scripts')
    @yield('scripts')
     <!-- Modal Script -->

</body>
</html>
