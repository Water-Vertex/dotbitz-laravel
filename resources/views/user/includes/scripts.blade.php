<script>
    $(document).ready(function () {

        // Mobile menu functionality
        const $mobileMenuButton = $('#mobileMenuButton');
        const $closeMobileMenu  = $('#closeMobileMenu');
        const $mobileMenu       = $('#mobileMenu');
        const $overlay          = $('#overlay');

        // Open mobile menu
        $mobileMenuButton.on('click', function () {
            $mobileMenu.addClass('active');
            $overlay.addClass('active');
            $('body').css('overflow', 'hidden'); // Prevent scrolling
        });

        // Close mobile menu
        function closeMenu() {
            $mobileMenu.removeClass('active');
            $overlay.removeClass('active');
            $('body').css('overflow', 'auto'); // Re-enable scrolling
        }

        $closeMobileMenu.on('click', closeMenu);
        $overlay.on('click', closeMenu);

        // Close menu when clicking on links/buttons inside mobile menu
        $mobileMenu.find('a, button').on('click', closeMenu);

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
</script>

<script>
$(document).ready(function() {
    // Initialize modal functionality
    const consultationModal = {
        init: function() {
            this.cacheElements();
            this.setMinDate();
            this.bindEvents();
            this.bindOpenButtons(); // Bind all open buttons
        },

        cacheElements: function() {
            this.$dateInput = $('#appointment_date');
            this.$timeInput = $('#appointment_time');
            this.$modal = $('#consultationModal');
            this.$closeBtn = $('#closeModal');
            this.$overlay = this.$modal.find('.absolute');
            this.$form = this.$modal.find('form');
        },

        setMinDate: function() {
            const today = new Date().toISOString().split('T')[0];
            this.$dateInput.attr('min', today);
        },

        bindEvents: function() {
            // Date validation
            this.$dateInput.on('change', this.validateDate.bind(this));

            // Time validation
            this.$timeInput.on('change', this.validateTime.bind(this));

            // Close modal events
            this.$closeBtn.on('click', this.closeModal.bind(this));
            this.$overlay.on('click', this.closeModal.bind(this));

            // Escape key
            $(document).on('keydown', this.handleEscape.bind(this));

            // Click outside modal (improved selector)
            this.$modal.on('click', this.handleOutsideClick.bind(this));
        },

        bindOpenButtons: function() {
            // Bind to any button with class 'open-consultation-modal'
            $(document).on('click', '.open-consultation-modal', this.openModal.bind(this));

            // Also bind to your specific buttons
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
            this.$modal.removeClass('hidden');
            $('body').addClass('overflow-hidden'); // Prevent background scrolling
        },

        closeModal: function() {
            this.$modal.addClass('hidden');
            $('body').removeClass('overflow-hidden');
            if (this.$form.length) {
                this.$form[0].reset();
            }
        },

        handleEscape: function(e) {
            if (e.key === 'Escape' && !this.$modal.hasClass('hidden')) {
                this.closeModal();
            }
        },

        handleOutsideClick: function(e) {
            // Check if click is on the modal background (not the content)
            if ($(e.target).attr('id') === 'consultationModal') {
                this.closeModal();
            }
        },

        showToast: function(type, title, message) {
            // Check if toastr is available
            if (typeof toastr !== 'undefined') {
                switch(type) {
                    case 'error':
                        toastr.error(message, title, {
                            closeButton: true,
                            progressBar: true,
                            positionClass: 'toast-top-right',
                            timeOut: 5000,
                            extendedTimeOut: 2000,
                            preventDuplicates: true
                        });
                        break;
                    case 'success':
                        toastr.success(message, title, {
                            closeButton: true,
                            progressBar: true,
                            positionClass: 'toast-top-right',
                            timeOut: 3000,
                            extendedTimeOut: 1000,
                            preventDuplicates: true
                        });
                        break;
                    case 'warning':
                        toastr.warning(message, title, {
                            closeButton: true,
                            progressBar: true,
                            positionClass: 'toast-top-right',
                            timeOut: 4000,
                            extendedTimeOut: 1500,
                            preventDuplicates: true
                        });
                        break;
                    case 'info':
                        toastr.info(message, title, {
                            closeButton: true,
                            progressBar: true,
                            positionClass: 'toast-top-right',
                            timeOut: 4000,
                            extendedTimeOut: 1500,
                            preventDuplicates: true
                        });
                        break;
                }
            } else {
                // Fallback to alert if toastr is not available
                alert(`${title}: ${message}`);
            }
        }
    };

    // Initialize the modal
    consultationModal.init();

    // Expose openModal function globally as well (backward compatibility)
    window.openConsultationModal = function(e) {
        if (e) e.preventDefault();
        $('#consultationModal').removeClass('hidden');
        $('body').addClass('overflow-hidden');
    };
});

</script>
<script>
$(document).ready(function () {

    // Date Picker (Mon-Fri only)
    flatpickr("#appointment_date", {
        dateFormat: "m-d-Y",
        minDate: "today",
        disable: [
            function(date) {
                // Disable Saturday (6) and Sunday (0)
                return (date.getDay() === 0 || date.getDay() === 6);
            }
        ],
        onChange: function(selectedDates, dateStr) {
            if (!dateStr) return;
            // optional: toastr message
            // toastr.info("Date selected: " + dateStr);
        }
    });

    // Time Picker (8:00 AM - 8:00 PM)
    flatpickr("#appointment_time", {
        enableTime: true,
        noCalendar: true,
        dateFormat: "H:i",
        time_24hr: false,
        minTime: "08:00",
        maxTime: "20:00",
        minuteIncrement: 15
    });

});


</script>
<script>
$(document).ready(function() {
    const $modal = $('#assessmentModal');
    const $close = $('#closeAssessmentModal');

    $(document).on('click', '.open-assessment-modal', function() {
        const courseId = $(this).data('course-id');
        const courseName = $(this).data('course-name');

        $('#assessment_course_id').val(courseId);
        $('#assessment_course_name').val(courseName);

        $modal.removeClass('hidden');
        $('body').addClass('overflow-hidden');
    });

    $close.on('click', function() {
        $modal.addClass('hidden');
        $('body').removeClass('overflow-hidden');
        $modal.find('form')[0].reset();
    });

    // Close on clicking outside
    $modal.on('click', function(e) {
        if ($(e.target).is($modal)) {
            $modal.addClass('hidden');
            $('body').removeClass('overflow-hidden');
            $modal.find('form')[0].reset();
        }
    });

    
});
</script>
