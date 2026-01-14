 <style>
        .sticky-header {
            position: sticky;
            top: 0;
            z-index: 50;
            backdrop-filter: blur(8px);
            background: rgba(255, 255, 255, 0.95);
            border-bottom: 1px solid #e5e7eb;
        }
        
        .nav-link {
            position: relative;
        }
        
        .nav-link:hover::after {
            content: '';
            position: absolute;
            bottom: -4px;
            left: 0;
            width: 100%;
            height: 2px;
            background-color: #ff6500;
        }
    
        .footer-link {
            transition: all 0.2s ease;
        }
        .footer-link:hover {
            color: #ff6500;
            transform: translateX(5px);
        }
        .social-icon {
            transition: all 0.3s ease;
        }
        .social-icon:hover {
            transform: translateY(-3px);
        }
        .newsletter-btn {
            background: #0091B9;
            transition: all 0.3s ease;
        }
        .newsletter-btn:hover {
            transform: translateY(-2px);
            box-shadow: 0 5px 15px rgba(255, 101, 0, 0.3);
        }
        
        /* Mobile Menu Styles */
        .mobile-menu {
            transform: translateX(100%);
            transition: transform 0.3s ease-in-out;
            position: fixed;
            top: 0;
            right: 0;
            height: 100vh;
            width: 100%;
            max-width: 300px;
            z-index: 100;
            background: white;
            box-shadow: -5px 0 25px rgba(0, 0, 0, 0.1);
        }
        
        .mobile-menu.active {
            transform: translateX(0);
        }
        
        .overlay {
            display: none;
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background: rgba(0, 0, 0, 0.5);
            z-index: 99;
        }
        
        .overlay.active {
            display: block;
        }
        
        /* Responsive adjustments */
        @media (max-width: 768px) {
            .header-buttons {
                display: flex;
                align-items: center;
            }
            
            .logo-container img {
                max-width: 120px;
            }
        }
         .hero-section {
            background: linear-gradient(135deg, #073a89 0%, #0091b9 100%);
            position: relative;
            overflow: hidden;
        }
        
        .hero-section::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            bottom: 0;
            background-image: url("data:image/svg+xml,%3Csvg width='60' height='60' viewBox='0 0 60 60' xmlns='http://www.w3.org/2000/svg'%3E%3Cg fill='none' fill-rule='evenodd'%3E%3Cg fill='%23ffffff' fill-opacity='0.05'%3E%3Cpath d='M36 34v-4h-2v4h-4v2h4v4h2v-4h4v-2h-4zm0-30V0h-2v4h-4v2h4v4h2V6h4V4h-4zM6 34v-4H4v4H0v2h4v4h2v-4h4v-2H6zM6 4V0H4v4H0v2h4v4h2V6h4V4H6z'/%3E%3C/g%3E%3C/g%3E%3C/svg%3E");
        }
        
        .code-dot {
            animation: float 6s ease-in-out infinite;
        }
        
        .code-dot:nth-child(2) {
            animation-delay: 1s;
        }
        
        .code-dot:nth-child(3) {
            animation-delay: 2s;
        }
        
        @keyframes float {
            0%, 100% {
                transform: translateY(0);
            }
            50% {
                transform: translateY(-20px);
            }
        }
        
        .cta-button {
            background: #FF6500;
            transition: all 0.3s ease;
            color:white;
            box-shadow: 0 10px 30px rgba(255, 101, 0, 0.3);
        }
        
        .cta-button:hover {
            transform: translateY(-3px);
            box-shadow: 0 15px 40px rgba(255, 101, 0, 0.4);
        }
        
        .stats-card {
            background: rgba(255, 255, 255, 0.1);
            backdrop-filter: blur(10px);
            border: 1px solid rgba(255, 255, 255, 0.2);
            transition: all 0.3s ease;
        }
        
        .stats-card:hover {
            transform: translateY(-5px);
            background: rgba(255, 255, 255, 0.15);
        }
    </style>