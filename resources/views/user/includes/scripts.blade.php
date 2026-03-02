{{-- <script>

$(document).ready(function () {
    // Mobile menu functionality
    const $mobileMenuButton = $('#mobileMenuButton');
    const $closeMobileMenu  = $('#closeMobileMenu');
    const $mobileMenu       = $('#mobileMenu');
    const $overlay          = $('#overlay');

    // Open mobile menu
    $mobileMenuButton.on('click', function () {
        $mobileMenu.removeClass('translate-x-full').addClass('translate-x-0');
        $overlay.removeClass('hidden');
        $('body').css('overflow', 'hidden');
    });

    // Close mobile menu
    function closeMenu() {
        $mobileMenu.removeClass('translate-x-0').addClass('translate-x-full');
        $overlay.addClass('hidden');
        $('body').css('overflow', 'auto');
    }

    $closeMobileMenu.on('click', closeMenu);
    $overlay.on('click', closeMenu);

    // Close menu when clicking on links/buttons inside mobile menu
    $mobileMenu.find('a, button:not(#closeMobileMenu)').on('click', function() {
        if(!$(this).hasClass('open-consultation-modal')) {
            closeMenu();
        }
    });

    // Simple scroll effect for header
    const $header = $('.sticky-header');
    $(window).on('scroll', function () {
        if ($(window).scrollTop() > 10) {
            $header.css('box-shadow', '0 2px 10px rgba(0,0,0,0.1)');
        } else {
            $header.css('box-shadow', 'none');
        }
    });

    // Close menu on escape key
    $(document).on('keydown', function (e) {
        if (e.key === 'Escape') {
            closeMenu();
        }
    });
});
</script> --}}
<script>
    function initMobileMenu() {
      const menu = document.getElementById('mobileMenu');
      const search = document.getElementById('mobileSearch');
      const overlay = document.getElementById('overlay');

      const menuToggle = document.getElementById('menuToggle');
      const closeMenu = document.getElementById('closeMenu');
      const searchToggle = document.getElementById('searchToggle');
      const closeSearch = document.getElementById('closeSearch');

      if (menuToggle) {
          menuToggle.onclick = () => {
              menu.classList.remove('-translate-x-full');
              overlay.classList.remove('hidden');
          };
      }

      if (closeMenu) {
          closeMenu.onclick = () => {
              menu.classList.add('-translate-x-full');
              overlay.classList.add('hidden');
          };
      }

      if (searchToggle) {
          searchToggle.onclick = () => {
              search.classList.remove('-translate-y-full');
              overlay.classList.remove('hidden');
          };
      }

      if (closeSearch) {
          closeSearch.onclick = () => {
              search.classList.add('-translate-y-full');
              overlay.classList.add('hidden');
          };
      }

      if (overlay) {
          overlay.onclick = () => {
              menu.classList.add('-translate-x-full');
              search.classList.add('-translate-y-full');
              overlay.classList.add('hidden');
          };
      }
    }


    document.addEventListener('DOMContentLoaded', () => {
      initMobileMenu();
    });

    document.addEventListener('livewire:navigated', () => {
        initMobileMenu();
    });
  </script>
<script>
$(document).ready(function() {
    // Consultation Modal
    const consultationModal = {
        init: function() {
            this.cacheElements();
            this.setMinDate();
            this.bindEvents();
            this.bindOpenButtons();
        },

        cacheElements: function() {
            this.$dateInput = $('#appointment_date');
            this.$timeInput = $('#appointment_time');
            this.$modal = $('#consultationModal');
            this.$closeBtn = $('#closeModal');
            this.$overlay = this.$modal.find('.modal-overlay');
            this.$form = this.$modal.find('form');
        },

        setMinDate: function() {
            const today = new Date().toISOString().split('T')[0];
            this.$dateInput.attr('min', today);
        },

        bindEvents: function() {
            this.$dateInput.on('change', this.validateDate.bind(this));
            this.$timeInput.on('change', this.validateTime.bind(this));
            this.$closeBtn.on('click', this.closeModal.bind(this));
            this.$overlay.on('click', this.closeModal.bind(this));
            $(document).on('keydown', this.handleEscape.bind(this));
            this.$modal.on('click', this.handleOutsideClick.bind(this));
        },

        bindOpenButtons: function() {
            $(document).on('click', '.open-consultation-modal', this.openModal.bind(this));
            $(document).on('click', '#openConsultationBtn', this.openModal.bind(this));
        },

        validateDate: function() {
            const selectedDate = new Date(this.$dateInput.val());
            const day = selectedDate.getDay();

            if (day === 0 || day === 6) {
                this.showToast('error', 'Weekend Not Available', 'Consultations are only available Monday to Friday. Please select a weekday.');
                this.$dateInput.val('');
            }
        },

        validateTime: function() {
            const selectedTime = this.$timeInput.val();
            const [hours, minutes] = selectedTime.split(':').map(Number);

            if (hours < 8 || hours > 19 || (hours === 19 && minutes > 0)) {
                this.showToast('error', 'Invalid Time', 'Consultations are only available from 8:00 AM to 8:00 PM. Please select a valid time.');
                this.$timeInput.val('');
            }
        },

        openModal: function(e) {
            e.preventDefault();
            this.$modal.addClass('active');
            $('body').addClass('overflow-hidden');
        },

        closeModal: function() {
            this.$modal.removeClass('active');
            $('body').removeClass('overflow-hidden');
            if (this.$form.length) {
                this.$form[0].reset();
            }
        },

        handleEscape: function(e) {
            if (e.key === 'Escape' && this.$modal.hasClass('active')) {
                this.closeModal();
            }
        },

        handleOutsideClick: function(e) {
            if ($(e.target).attr('id') === 'consultationModal') {
                this.closeModal();
            }
        },

        showToast: function(type, title, message) {
            if (typeof toastr !== 'undefined') {
                const options = {
                    closeButton: true,
                    progressBar: true,
                    positionClass: 'toast-top-right',
                    timeOut: type === 'error' ? 5000 : 3000,
                    extendedTimeOut: type === 'error' ? 2000 : 1000,
                    preventDuplicates: true
                };

                switch(type) {
                    case 'error':
                        toastr.error(message, title, options);
                        break;
                    case 'success':
                        toastr.success(message, title, options);
                        break;
                    case 'warning':
                        toastr.warning(message, title, options);
                        break;
                    case 'info':
                        toastr.info(message, title, options);
                        break;
                }
            } else {
                alert(`${title}: ${message}`);
            }
        }
    };

    // Assessment Modal
    const assessmentModal = {
        init: function() {
            this.cacheElements();
            this.bindEvents();
        },

        cacheElements: function() {
            this.$modal = $('#assessmentModal');
            this.$close = $('#closeAssessmentModal');
        },

        bindEvents: function() {
            $(document).on('click', '.open-assessment-modal', this.openModal.bind(this));
            this.$close.on('click', this.closeModal.bind(this));
            this.$modal.on('click', this.handleOutsideClick.bind(this));
        },

        openModal: function(e) {
            const courseId = $(e.currentTarget).data('course-id');
            const courseName = $(e.currentTarget).data('course-name');

            $('#assessment_course_id').val(courseId);
            $('#assessment_course_name').val(courseName);

            this.$modal.addClass('active');
            $('body').addClass('overflow-hidden');
        },

        closeModal: function() {
            this.$modal.removeClass('active');
            $('body').removeClass('overflow-hidden');
            this.$modal.find('form')[0].reset();
        },

        handleOutsideClick: function(e) {
            if ($(e.target).is(this.$modal)) {
                this.closeModal();
            }
        }
    };

    // Initialize both modals
    consultationModal.init();
    assessmentModal.init();

    // Flatpickr initialization
    if ($('#appointment_date').length) {
        flatpickr("#appointment_date", {
            dateFormat: "m-d-Y",
            minDate: "today",
            disable: [
                function(date) {
                    return (date.getDay() === 0 || date.getDay() === 6);
                }
            ]
        });
    }

    if ($('#appointment_time').length) {
        flatpickr("#appointment_time", {
            enableTime: true,
            noCalendar: true,
            dateFormat: "H:i",
            time_24hr: false,
            minTime: "08:00",
            maxTime: "20:00",
            minuteIncrement: 15
        });
    }

    // Global open function for backward compatibility
    window.openConsultationModal = function(e) {
        if (e) e.preventDefault();
        $('#consultationModal').addClass('active');
        $('body').addClass('overflow-hidden');
    };
});
</script>
<!-- AOS Animation Library -->
    <link href="https://unpkg.com/aos@2.3.1/dist/aos.css" rel="stylesheet">
    <script src="https://unpkg.com/aos@2.3.1/dist/aos.js"></script>
<!-- AOS Initialization -->
<script>
    document.addEventListener('DOMContentLoaded', function() {
        AOS.init({
            duration: 900,
            once: true,           // animation only once
            offset: 100,          // trigger offset
            easing: 'ease-out-cubic'
        });

        // Swiper initialization (if courses exist)
        if (document.querySelector('.coursesSwiper')) {
            new Swiper('.coursesSwiper', {
                slidesPerView: 1,
                spaceBetween: 20,
                loop: true,
                autoplay: { delay: 4000, disableOnInteraction: false },
                pagination: { el: '.swiper-pagination', clickable: true },
                navigation: { nextEl: '.swiper-button-next', prevEl: '.swiper-button-prev' },
                breakpoints: {
                    640: { slidesPerView: 2, spaceBetween: 25 },
                    1024: { slidesPerView: 3, spaceBetween: 30 }
                }
            });
        }
    });
</script>
<script src="{{asset('assets/js/jquery-3.7.1.min.js')}}"></script>
    <script src="{{asset('assets/js/modernizr.min.js')}}"></script>
    <script src="{{asset('assets/js/bootstrap.bundle.min.js')}}"></script>
    <script src="{{asset('assets/js/imagesloaded.pkgd.min.js')}}"></script>
    <script src="{{asset('assets/js/jquery.magnific-popup.min.js')}}"></script>
    <script src="{{asset('assets/js/isotope.pkgd.min.js')}}"></script>
    <script src="{{asset('assets/js/jquery.appear.min.js')}}"></script>
    <script src="{{asset('assets/js/jquery.easing.min.js')}}"></script>
    <script src="{{asset('assets/js/owl.carousel.min.js')}}"></script>
    <script src="{{asset('assets/js/counter-up.js')}}"></script>
    <script src="{{asset('assets/js/jquery.nice-select.min.js')}}"></script>
    <script src="{{asset('assets/js/wow.min.js')}}"></script>
    <script src="{{asset('assets/js/main.js')}}"></script>
