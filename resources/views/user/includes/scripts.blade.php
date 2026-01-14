<script>
        // Mobile menu functionality
        const mobileMenuButton = document.getElementById('mobileMenuButton');
        const closeMobileMenu = document.getElementById('closeMobileMenu');
        const mobileMenu = document.getElementById('mobileMenu');
        const overlay = document.getElementById('overlay');
        
        // Open mobile menu
        mobileMenuButton.addEventListener('click', () => {
            mobileMenu.classList.add('active');
            overlay.classList.add('active');
            document.body.style.overflow = 'hidden'; // Prevent scrolling
        });
        
        // Close mobile menu
        function closeMenu() {
            mobileMenu.classList.remove('active');
            overlay.classList.remove('active');
            document.body.style.overflow = 'auto'; // Re-enable scrolling
        }
        
        closeMobileMenu.addEventListener('click', closeMenu);
        overlay.addEventListener('click', closeMenu);
        
        // Close menu when clicking on links
        const mobileLinks = mobileMenu.querySelectorAll('a, button');
        mobileLinks.forEach(link => {
            link.addEventListener('click', closeMenu);
        });
        
        // Simple scroll effect for header
        const header = document.querySelector('.sticky-header');
        window.addEventListener('scroll', () => {
            if (window.scrollY > 10) {
                header.style.boxShadow = '0 2px 10px rgba(0,0,0,0.1)';
            } else {
                header.style.boxShadow = 'none';
            }
        });
        
        // Close menu on escape key
        document.addEventListener('keydown', (e) => {
            if (e.key === 'Escape') {
                closeMenu();
            }
        });
    </script>
