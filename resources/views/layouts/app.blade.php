<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Orchid Ushers and Hospitality Agency</title>
    @vite('resources/css/app.css')
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <style>
        :root {
            --primary-color: #d4af37;
            --dark-bg: #1a1a1a;
            --light-text: #ffffff;
            --gray-text: #666666;
        }

        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            line-height: 1.6;
            color: var(--gray-text);
            background-color: #f8f9fa;
        }

        /* Navbar Styles */
        nav {
            background: linear-gradient(135deg, var(--dark-bg) 0%, #2a2a2a 100%);
            box-shadow: 0 4px 12px rgba(0, 0, 0, 0.15);
            position: sticky;
            top: 0;
            z-index: 100;
        }

        .navbar-container {
            display: flex;
            justify-content: space-between;
            align-items: center;
            padding: 1rem 2rem;
            max-width: 100%;
        }

        /* Logo Section */
        .logo-section {
            display: flex;
            align-items: center;
            gap: 1rem;
        }

        .logo {
            width: 50px;
            height: 50px;
            background: linear-gradient(135deg, var(--primary-color), #b8860b);
            border-radius: 8px;
            display: flex;
            align-items: center;
            justify-content: center;
            font-weight: bold;
            color: var(--dark-bg);
            font-size: 1.5rem;
            box-shadow: 0 2px 8px rgba(212, 175, 55, 0.3);
        }

        .brand-text {
            display: flex;
            flex-direction: column;
        }

        .brand-text h1 {
            font-size: 1.4rem;
            font-weight: 700;
            color: var(--light-text);
            letter-spacing: 0.5px;
            margin: 0;
        }

        .brand-text p {
            font-size: 0.7rem;
            color: var(--primary-color);
            margin: 0;
            letter-spacing: 1px;
            text-transform: uppercase;
            font-weight: 600;
        }

        /* Menu Button (Mobile) */
        .menu-toggle {
            display: none;
            flex-direction: column;
            cursor: pointer;
            gap: 6px;
            background: none;
            border: none;
            padding: 0.5rem;
        }

        .menu-toggle span {
            width: 28px;
            height: 3px;
            background: var(--light-text);
            border-radius: 2px;
            transition: all 0.3s ease;
        }

        .menu-toggle.active span:nth-child(1) {
            transform: rotate(45deg) translate(10px, 10px);
        }

        .menu-toggle.active span:nth-child(2) {
            opacity: 0;
        }

        .menu-toggle.active span:nth-child(3) {
            transform: rotate(-45deg) translate(8px, -8px);
        }

        /* Navigation Links */
        .nav-links {
            display: flex;
            list-style: none;
            gap: 2.5rem;
            align-items: center;
        }

        .nav-links a {
            color: var(--light-text);
            text-decoration: none;
            font-weight: 500;
            font-size: 0.95rem;
            padding: 0.5rem 0;
            border-bottom: 2px solid transparent;
            transition: all 0.3s ease;
            position: relative;
        }

        .nav-links a:hover {
            color: var(--primary-color);
            border-bottom-color: var(--primary-color);
        }

        /* Active Link Styling */
        .nav-links a.active {
            color: var(--primary-color);
            border-bottom-color: var(--primary-color);
            font-weight: 600;
        }

        /* Mobile Responsive */
        @media (max-width: 768px) {
            .menu-toggle {
                display: flex;
            }

            .navbar-container {
                padding: 1rem 1.5rem;
            }

            .brand-text h1 {
                font-size: 1.1rem;
            }

            .logo {
                width: 40px;
                height: 40px;
                font-size: 1.2rem;
            }

            .nav-links {
                position: absolute;
                top: 100%;
                left: 0;
                right: 0;
                background: linear-gradient(135deg, var(--dark-bg), #2a2a2a);
                flex-direction: column;
                gap: 0;
                max-height: 0;
                overflow: hidden;
                transition: max-height 0.3s ease;
            }

            .nav-links.active {
                max-height: 300px;
                box-shadow: 0 8px 16px rgba(0, 0, 0, 0.2);
            }

            .nav-links a {
                padding: 1rem 2rem;
                border-bottom: 1px solid rgba(212, 175, 55, 0.1);
                width: 100%;
                display: block;
            }

            .nav-links a:last-child {
                border-bottom: none;
            }
        }

        /* Main Content */
        main {
            min-height: calc(100vh - 200px);
            padding: 2rem;
        }

        @media (max-width: 768px) {
            main {
                padding: 1rem;
            }
        }

        /* Footer */
        footer {
            background: linear-gradient(135deg, var(--dark-bg), #2a2a2a);
            color: var(--light-text);
            padding: 1.2rem 2rem;
            border-top: 2px solid var(--primary-color);
            margin-top: 3rem;
        }

        .footer-content {
            display: flex;
            justify-content: space-between;
            align-items: center;
            max-width: 100%;
            margin: 0 auto;
            gap: 2rem;
            flex-wrap: nowrap;
        }

        .footer-left {
            text-align: left;
            flex: 1;
            min-width: 0;
        }

        .footer-right {
            text-align: right;
            flex: 1;
            min-width: 0;
        }

        footer p {
            margin: 0;
            font-size: 0.8rem;
            line-height: 1.4;
            white-space: nowrap;
        }

        .footer-accent {
            color: var(--primary-color);
            font-weight: 600;
        }



        .developer-link {
            color: var(--primary-color);
            text-decoration: none;
            font-weight: 600;
            transition: all 0.3s ease;
        }

        .developer-link:hover {
            text-decoration: underline;
            color: #ffd700;
        }

        @media (max-width: 768px) {
            .footer-content {
                flex-direction: column;
                gap: 0.8rem;
            }

            .footer-left,
            .footer-right {
                text-align: center;
            }

            footer p {
                white-space: normal;
                font-size: 0.75rem;
            }
        }
    </style>
</head>
<body>

<nav>
    <div class="navbar-container">
        <!-- Logo Section -->
        <div class="logo-section">
            <div class="logo">
                <img src="{{ asset('images/orchid.jpg') }}" alt="Orchid Logo">
            </div>
            <div class="brand-text">
                <h1>Orchid</h1>
                <p>Ushers and Hospitality Agency</p>
            </div>
        </div>

        <!-- Mobile Menu Toggle -->
        <button class="menu-toggle" id="menuToggle">
            <span></span>
            <span></span>
            <span></span>
        </button>

        <!-- Navigation Links -->
        <ul class="nav-links" id="navLinks">
            <li><a href="/" class="{{ request()->is('/') ? 'active' : '' }}">Home</a></li>
            <li><a href="{{ route('about') }}" class="{{ request()->routeIs('about') ? 'active' : '' }}">About</a></li>
            <li><a href="/services" class="{{ request()->is('services') ? 'active' : '' }}">Services</a></li>
            <li><a href="/gallery" class="{{ request()->is('gallery') ? 'active' : '' }}">Gallery</a></li>
            <li><a href="/contact" class="{{ request()->is('contact') ? 'active' : '' }}">Contact</a></li>
        </ul>
    </div>
</nav>

<main>
    @yield('content')
</main>

<footer>
    <div class="footer-content">
        <div class="footer-left">
            <p><span class="footer-accent">©</span> {{ date('Y') }} <span class="footer-accent">Orchid Ushers and Hospitality Agency</span> | Premium Event Management Solutions</p>
        </div>
        
        <div class="footer-social">
            <a href="https://twitter.com" target="_blank" rel="noopener noreferrer" title="Twitter">
                <i class="fab fa-twitter"></i>
            </a>
            <a href="https://facebook.com" target="_blank" rel="noopener noreferrer" title="Facebook">
                <i class="fab fa-facebook"></i>
            </a>
            <a href="https://instagram.com" target="_blank" rel="noopener noreferrer" title="Instagram">
                <i class="fab fa-instagram"></i>
            </a>
            <a href="https://linkedin.com" target="_blank" rel="noopener noreferrer" title="LinkedIn">
                <i class="fab fa-linkedin"></i>
            </a>
        </div>
        
        <div class="footer-right">
            <p>Developed and Maintained By <span class="footer-accent">Guuga Consults</span> | <a href="mailto:guugaconsults@gmail.com" class="developer-link">guugaconsults@gmail.com</a></p>
        </div>
    </div>
</footer>

<script>
    const menuToggle = document.getElementById('menuToggle');
    const navLinks = document.getElementById('navLinks');

    menuToggle.addEventListener('click', () => {
        menuToggle.classList.toggle('active');
        navLinks.classList.toggle('active');
    });

    // Close menu when a link is clicked
    navLinks.querySelectorAll('a').forEach(link => {
        link.addEventListener('click', () => {
            menuToggle.classList.remove('active');
            navLinks.classList.remove('active');
        });
    });

    // Close menu when clicking outside
    document.addEventListener('click', (e) => {
        if (!e.target.closest('nav')) {
            menuToggle.classList.remove('active');
            navLinks.classList.remove('active');
        }
    });
</script>

</body>
</html>
