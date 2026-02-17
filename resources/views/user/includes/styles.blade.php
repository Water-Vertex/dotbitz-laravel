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
        /* ===== Custom Scrollbar (WebKit Browsers) ===== */
::-webkit-scrollbar {
    width: 8px;
    height: 8px;
}

::-webkit-scrollbar-track {
    background: #f3f4f6; /* light gray */
    border-radius: 10px;
}

::-webkit-scrollbar-thumb {
    background: linear-gradient(180deg, #ff6500, #ff8a3d);
    border-radius: 10px;
    border: 2px solid #f3f4f6;
}

::-webkit-scrollbar-thumb:hover {
    background: linear-gradient(180deg, #e65c00, #ff6500);
}
.modal-scroll::-webkit-scrollbar {
    width: 8px;
}

.modal-scroll::-webkit-scrollbar-track {
    background: #f3f4f6;
    border-radius: 10px;
}

.modal-scroll::-webkit-scrollbar-thumb {
    background: linear-gradient(180deg, #ff6500, #ff8a3d);
    border-radius: 10px;
    border: 2px solid #f3f4f6;
}

.modal-scroll::-webkit-scrollbar-thumb:hover {
    background: linear-gradient(180deg, #e65c00, #ff6500);
}
    </style>

    <style>
        * { font-family: 'Inter', sans-serif; }
        /* hero with full-bleed background – right side unsplash course image, left overlay */
        .hero-course {
            position: relative;
            background: #073B8A; /* deep base fallback */
            isolation: isolate;
        }
        /* RIGHT SIDE: full HD unsplash image – coding / course / laptop + kid */
        .hero-course::before {
            content: "";
            position: absolute;
            top: 0;
            right: 0;
            width: 100%;
            height: 100%;
            background-image: url('https://images.unsplash.com/photo-1555066931-4365d14bab8c?ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D&auto=format&fit=crop&w=2070&q=80');
            background-size: cover;
            background-position: 70% 30%;
            background-repeat: no-repeat;
            z-index: 0;
            /* overlay on left side via gradient – opacity + tint */
            mask: linear-gradient(to right, #073B8A 45%, transparent 90%);
            -webkit-mask: linear-gradient(to right, #073B8A 45%, transparent 90%);
            opacity: 0.95; /* subtle blend */
        }
        /* left side solid dark overlay to boost content readability (additional opacity layer) */
        .hero-course::after {
            content: "";
            position: absolute;
            top: 0;
            left: 0;
            width: 60%;
            height: 100%;
            background: linear-gradient(to right, #073B8A 20%, rgba(7, 59, 138,0.7) 70%, rgba(7, 59, 138,0) 100%);
            z-index: 1;
            pointer-events: none;
        }
        .content-overlay {
            position: relative;
            z-index: 20;
        }
        /* unique material chip with fresh design */
        .unique-chip {
            background: rgba(255, 255, 255, 0.05);
            backdrop-filter: blur(8px);
            -webkit-backdrop-filter: blur(8px);
            border: 1px solid rgba(255, 215, 0, 0.5);
            border-left: 6px solid #fbbf24;
            border-radius: 60px;
            padding: 0.65rem 1.8rem;
            display: inline-flex;
            align-items: center;
            box-shadow: 0 15px 25px -8px rgba(0,0,0,0.3);
            color: white;
            font-weight: 600;
            letter-spacing: 0.5px;
            gap: 10px;
        }
        .glass-card-badge {
            background: rgba(10, 20, 40, 0.7);
            backdrop-filter: blur(16px);
            border: 1px solid rgba(255,255,255,0.2);
            border-radius: 20px;
            padding: 0.8rem 1.8rem;
            box-shadow: 0 20px 35px -10px black;
        }
        .cta-modern {
            background: #fbbf24;
            color: #0a0f1c;
            border-radius: 60px;
            padding: 1.1rem 2.8rem;
            font-weight: 800;
            letter-spacing: 0.5px;
            border: none;
            box-shadow: 0 20px 35px -5px rgba(251,191,36,0.3), 0 8px 10px -6px #073B8A;
            transition: all 0.25s ease;
            display: inline-flex;
            align-items: center;
            gap: 12px;
            font-size: 1.2rem;
            border: 1px solid rgba(255,255,255,0.3);
        }
        .cta-modern:hover {
            background: #fcd34d;
            transform: scale(1.02) translateY(-3px);
            box-shadow: 0 28px 40px -5px #fbbf24;
        }
        .cta-outline-modern {
            background: transparent;
            border: 2px solid rgba(255,255,255,0.5);
            color: white;
            border-radius: 60px;
            padding: 1.1rem 2.6rem;
            font-weight: 700;
            backdrop-filter: blur(8px);
            transition: 0.2s;
            display: inline-flex;
            align-items: center;
            gap: 10px;
        }
        .cta-outline-modern:hover {
            background: rgba(255,255,255,0.1);
            border-color: white;
        }
        /* fresh heading style */
        .heading-xl {
            font-size: 3rem;
            line-height: 1.1;
            font-weight: 800;
            letter-spacing: -0.02em;
            text-shadow: 0 4px 20px rgba(0,0,0,0.3);
        }
        @media (max-width: 768px) {
            .heading-xl { font-size: 2.8rem; }
            .hero-course::before { mask: linear-gradient(to right, #073B8A 30%, transparent 85%); }
            .hero-course::after { width: 80%; }
        }
        .stat-pill {
            background: rgba(255,255,255,0.08);
            backdrop-filter: blur(6px);
            border: 1px solid rgba(255,255,255,0.1);
            border-radius: 100px;
            padding: 0.45rem 1.2rem;
            color: rgba(255,255,255,0.9);
            font-weight: 500;
        }
        .right-fade {
            /* nothing needed, handled by pseudo */
        }
        .bento-stats {
            display: flex;
            gap: 1.8rem;
            flex-wrap: wrap;
        }
        .modern-classic-card {
            background: white;
            border-radius: 32px;
            box-shadow: 0 20px 40px -12px rgba(7, 58, 137, 0.08), 0 8px 24px -6px rgba(0,0,0,0.02);
            transition: all 0.3s cubic-bezier(0.2, 0, 0, 1);
            border: 1px solid rgba(186, 228, 240, 0.3);
        }
        .modern-classic-card:hover {
            box-shadow: 0 30px 50px -15px rgba(7, 58, 137, 0.12), 0 12px 28px -8px rgba(0,145,185,0.08);
            border-color: rgba(0,145,185,0.2);
        }
        .feature-item {
            transition: all 0.2s ease;
        }
        .feature-item:hover {
            transform: translateY(-4px);
        }
        .feature-icon {
            background: linear-gradient(145deg, #ffffff, #f0f9ff);
            box-shadow: 0 8px 18px -6px rgba(7,58,137,0.12), inset 0 1px 2px rgba(255,255,255,0.8);
            border: 1px solid rgba(0,145,185,0.15);
            color: var(--teal);
        }
        .image-frame {
            box-shadow: 0 30px 50px -20px rgba(7,58,137,0.25);
            border-radius: 28px;
            border: 1px solid rgba(255,255,255,0.3);
            background: linear-gradient(145deg, #e6f3f8, #cbeaf2);
        }
        .badge-classic {
            background: linear-gradient(115deg, var(--light-teal) 0%, #d0edf5 100%);
            color: var(--navy);
            border: 1px solid rgba(7,58,137,0.15);
            box-shadow: 0 8px 14px -6px rgba(7,58,137,0.2);
            letter-spacing: 0.03em;
            backdrop-filter: blur(4px);
        }
        .heading-serif {
            font-family: 'Playfair Display', serif;
            font-weight: 800;
            letter-spacing: -0.02em;
        }
        .btn-elevated {
            background: linear-gradient(135deg, var(--orange), #ff7e1a);
            box-shadow: 0 12px 22px -8px rgba(255,101,0,0.35), 0 4px 0 #c44c00;
            border: 1px solid rgba(255,255,255,0.2);
            transition: all 0.15s ease;
            color: white;
            font-weight: 700;
            padding: 1rem 2.5rem;
            border-radius: 40px;
            display: inline-flex;
            align-items: center;
            justify-content: center;
        }
        .btn-elevated:hover {
            transform: translateY(-3px);
            box-shadow: 0 20px 28px -6px rgba(255,101,0,0.45), 0 6px 0 #b33b00;
        }
        .stat-separator {
            width: 1px;
            height: 30px;
            background: radial-gradient(circle, rgba(0,145,185,0.3) 0%, transparent 80%);
        }
        .classic-quote {
            font-family: 'Inter', sans-serif;
            font-style: italic;
            font-weight: 400;
            border-left: 4px solid var(--orange);
            background: rgba(186, 228, 240, 0.15);
            border-radius: 0 20px 20px 0;
        }
    </style>
