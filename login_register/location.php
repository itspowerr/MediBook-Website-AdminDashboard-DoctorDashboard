<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>MediBook | Our Location</title>
    <style>
        /* Base Styles */
        :root {
            --primary: #40e0d0;
            --primary-dark: #20b2aa;
            --primary-light: #afeeee;
            --secondary: #333333;
            --light: #f5f5f5;
            --medium-gray: #e0e0e0;
            --dark-gray: #666666;
            --white: #ffffff;
            --shadow: 0 2px 10px rgba(0, 0, 0, 0.1);
            --shadow-lg: 0 5px 15px rgba(0, 0, 0, 0.1);
            --radius: 6px;
            --transition: all 0.3s ease;
        }

        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: "Poppins", sans-serif;
            line-height: 1.6;
            color: var(--secondary);
            background-color: var(--white);
        }

        a {
            text-decoration: none;
            color: var(--secondary);
            transition: var(--transition);
        }

        a:hover {
            color: var(--primary);
        }

        .container {
            width: 100%;
            max-width: 1200px;
            margin: 0 auto;
            padding: 0 20px;
        }

        .section {
            padding: 60px 0;
        }

        .section-title {
            font-size: 28px;
            font-weight: 600;
            text-align: center;
            margin-bottom: 40px;
            position: relative;
            padding-bottom: 15px;
        }

        .section-title::after {
            content: "";
            position: absolute;
            bottom: 0;
            left: 50%;
            transform: translateX(-50%);
            width: 60px;
            height: 3px;
            background-color: var(--primary);
        }

        .btn {
            display: inline-block;
            background-color: var(--primary);
            color: var(--white);
            padding: 10px 20px;
            border-radius: var(--radius);
            border: none;
            cursor: pointer;
            font-weight: 500;
            transition: var(--transition);
            text-align: center;
        }

        .btn:hover {
            background-color: var(--primary-dark);
            color: var(--white);
            transform: translateY(-2px);
            box-shadow: var(--shadow);
        }

        .text-center {
            text-align: center;
        }

        /* Header */
        header {
            background-color: var(--white);
            box-shadow: var(--shadow);
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            z-index: 1000;
            transition: var(--transition);
        }

        header.scrolled {
            padding: 10px 0;
            background: rgba(255, 255, 255, 0.95);
            backdrop-filter: blur(10px);
        }

        .header-container {
            display: flex;
            justify-content: space-between;
            align-items: center;
            padding: 15px 0;
        }

        .logo {
            font-size: 24px;
            font-weight: 700;
            color: var(--primary);
            display: flex;
            align-items: center;
        }

        .logo i {
            margin-right: 8px;
        }

        .navigation {
            display: flex;
            align-items: center;
        }

        .navigation a {
            margin-left: 25px;
            font-weight: 500;
            position: relative;
        }

        .navigation a::after {
            content: "";
            position: absolute;
            bottom: -5px;
            left: 0;
            width: 0;
            height: 2px;
            background-color: var(--primary);
            transition: var(--transition);
        }

        .navigation a:hover::after,
        .navigation a.active::after {
            width: 100%;
        }

        .navigation a.active {
            color: var(--primary);
        }

        .btn-login {
            margin-left: 25px;
            background-color: var(--primary);
            color: var(--white);
            padding: 8px 20px;
            border-radius: 50px;
            font-weight: 500;
            transition: var(--transition);
        }

        .btn-login:hover {
            background-color: var(--primary-dark);
            color: var(--white);
            transform: translateY(-2px);
            box-shadow: var(--shadow);
        }

        .mobile-toggle {
            display: none;
            cursor: pointer;
            font-size: 24px;
            color: var(--primary);
        }

        /* Hero Section */
        .hero {
            background-color: var(--primary);
            color: var(--white);
            padding: 120px 0 80px;
            text-align: center;
            background-size: cover;
            background-position: center;
            position: relative;
            height: 50vh;
            display: flex;
            align-items: center;
            justify-content: center;
        }

        .hero-content {
            max-width: 800px;
            margin: 0 auto;
            position: relative;
            z-index: 1;
        }

        .hero h1 {
            font-size: 36px;
            font-weight: 700;
            margin-bottom: 20px;
        }

        .hero p {
            font-size: 18px;
            margin-bottom: 30px;
            opacity: 0.9;
        }

        /* Location Content */
        .location-content {
            display: flex;
            flex-direction: column;
            gap: 40px;
        }
        
        .location-info {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(300px, 1fr));
            gap: 30px;
        }
        
        .info-card {
            display: flex;
            background: white;
            border-radius: var(--radius);
            padding: 20px;
            box-shadow: var(--shadow);
            transition: var(--transition);
        }
        
        .info-card:hover {
            transform: translateY(-5px);
            box-shadow: var(--shadow-lg);
        }
        
        .info-card .icon {
            font-size: 2rem;
            color: var(--primary);
            margin-right: 20px;
            display: flex;
            align-items: center;
        }
        
        .info-card .info h3 {
            font-size: 1.2rem;
            margin-bottom: 10px;
            color: var(--secondary);
        }
        
        .info-card .info p {
            color: var(--dark-gray);
            line-height: 1.6;
        }
        
        .map-container {
            width: 100%;
            height: 450px;
            border-radius: var(--radius);
            overflow: hidden;
            box-shadow: var(--shadow);
        }
        
        .map-container iframe {
            width: 100%;
            height: 100%;
            border: none;
        }
        
        .directions-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(300px, 1fr));
            gap: 30px;
        }
        
        .direction-card {
            background: white;
            border-radius: var(--radius);
            padding: 30px;
            text-align: center;
            box-shadow: var(--shadow);
            transition: var(--transition);
        }
        
        .direction-card:hover {
            transform: translateY(-5px);
            box-shadow: var(--shadow-lg);
        }
        
        .direction-card .icon {
            font-size: 2.5rem;
            color: var(--primary);
            margin-bottom: 20px;
        }
        
        .direction-card h3 {
            font-size: 1.3rem;
            margin-bottom: 15px;
            color: var(--secondary);
        }
        
        .direction-card p {
            color: var(--dark-gray);
        }

        /* Footer */
        .footer {
            background-color: #333;
            color: #fff;
            padding: 60px 0 20px;
        }

        .footer-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(200px, 1fr));
            gap: 30px;
            margin-bottom: 40px;
        }

        .footer-column h3 {
            font-size: 18px;
            margin-bottom: 20px;
            position: relative;
            padding-bottom: 10px;
        }

        .footer-column h3::after {
            content: "";
            position: absolute;
            bottom: 0;
            left: 0;
            width: 30px;
            height: 2px;
            background-color: var(--primary);
        }

        .footer-links {
            list-style: none;
        }

        .footer-links li {
            margin-bottom: 10px;
        }

        .footer-links a {
            color: #ccc;
            transition: var(--transition);
        }

        .footer-links a:hover {
            color: var(--primary);
            padding-left: 5px;
        }

        .footer-links li i {
            margin-right: 10px;
            color: var(--primary);
        }

        .social-links {
            display: flex;
            gap: 10px;
            margin-top: 20px;
        }

        .social-links a {
            display: flex;
            align-items: center;
            justify-content: center;
            width: 36px;
            height: 36px;
            background-color: rgba(255, 255, 255, 0.1);
            border-radius: 50%;
            color: #fff;
            transition: var(--transition);
        }

        .social-links a:hover {
            background-color: var(--primary);
            transform: translateY(-3px);
        }

        .footer-bottom {
            text-align: center;
            padding-top: 20px;
            border-top: 1px solid rgba(255, 255, 255, 0.1);
            color: #ccc;
            font-size: 14px;
        }

        /* CTA Section */
        .cta-section {
            text-align: center;
            background-size: cover;
            background-position: center;
            background-attachment: fixed;
            position: relative;
            color: var(--white);
        }

        /* Responsive Design */
        @media (max-width: 992px) {
            .section {
                padding: 50px 0;
            }
            
            .location-info {
                grid-template-columns: 1fr;
            }
            
            .directions-grid {
                grid-template-columns: 1fr;
            }
        }

        @media (max-width: 768px) {
            .header-container {
                position: relative;
            }

            .mobile-toggle {
                display: block;
            }

            .navigation {
                position: absolute;
                top: 100%;
                left: 0;
                width: 100%;
                background-color: var(--white);
                flex-direction: column;
                align-items: center;
                padding: 20px 0;
                box-shadow: var(--shadow);
                transform: scaleY(0);
                transform-origin: top;
                transition: transform 0.3s ease;
                z-index: 1000;
            }

            .navigation.active {
                transform: scaleY(1);
            }

            .navigation a {
                margin: 10px 0;
            }

            .btn-login {
                margin: 10px 0 0;
            }

            .hero {
                padding: 100px 0 60px;
            }

            .hero h1 {
                font-size: 28px;
            }

            .hero p {
                font-size: 16px;
            }
        }

        @media (max-width: 576px) {
            .section-title {
                font-size: 24px;
            }
            
            .info-card {
                flex-direction: column;
            }
            
            .info-card .icon {
                margin-bottom: 15px;
                margin-right: 0;
                justify-content: center;
            }
            
            .info-card .info {
                text-align: center;
            }
        }

        /* Font Awesome Icons (minimal subset) */
        .fas, .fab, .far {
            display: inline-block;
            width: 1em;
            height: 1em;
            text-align: center;
        }
        
        /* Specific icon styles */
        .fa-heartbeat:before {
            content: "♥";
            color: var(--primary);
        }
        
        .fa-bars:before {
            content: "☰";
        }
        
        .fa-map-marker-alt:before {
            content: "📍";
        }
        
        .fa-phone-alt:before, .fa-phone:before {
            content: "📞";
        }
        
        .fa-clock:before {
            content: "🕒";
        }
        
        .fa-car:before {
            content: "🚗";
        }
        
        .fa-bus:before {
            content: "🚌";
        }
        
        .fa-taxi:before {
            content: "🚕";
        }
        
        .fa-envelope:before {
            content: "✉";
        }
        
        .fa-facebook-f:before {
            content: "f";
            font-weight: bold;
        }
        
        .fa-twitter:before {
            content: "t";
            font-weight: bold;
        }
        
        .fa-instagram:before {
            content: "i";
            font-weight: bold;
        }
        
        .fa-linkedin-in:before {
            content: "l";
            font-weight: bold;
        }

        /* Accessibility improvements */
        .sr-only {
            position: absolute;
            width: 1px;
            height: 1px;
            padding: 0;
            margin: -1px;
            overflow: hidden;
            clip: rect(0, 0, 0, 0);
            white-space: nowrap;
            border-width: 0;
        }
    </style>
</head>
<body>
    <header>
        <div class="container">
            <div class="header-container">
                <a href="index.php" class="logo">
                    <span class="fas fa-heartbeat" aria-hidden="true"></span> MediBook
                </a>
                <div class="mobile-toggle" id="mobileToggle" aria-label="Toggle menu">
                    <span class="fas fa-bars" aria-hidden="true"></span>
                </div>
                <nav class="navigation" id="navigation">
                    <a href="index.php">Home</a>
                    <a href="services.php">Services</a>
                    <a href="location.php" class="active">Location</a>
                    <a href="contact.php">Contact</a>
                    <a href="bkstf/index.php" class="btn-login">Login</a>
                </nav>
            </div>
        </div>
    </header>

    <section class="hero" style="background: linear-gradient(rgba(0, 0, 0, 0.6), rgba(0, 0, 0, 0.6)), url('https://hebbkx1anhila5yf.public.blob.vercel-storage.com/bkg-img.jpg-D7JSDY50A4LDZbmmPgAYd5mfTsvRPc.jpeg') center/cover;">
        <div class="hero-content">
            <h1>Our Location</h1>
            <p>Find us at our convenient location in Kathmandu</p>
        </div>
    </section>

    <main>
        <section class="section location">
            <div class="container">
                <h2 class="section-title">Visit Our Medical Center</h2>
                <div class="location-content">
                    <div class="location-info">
                        <div class="info-card">
                            <div class="icon">
                                <span class="fas fa-map-marker-alt" aria-hidden="true"></span>
                            </div>
                            <div class="info">
                                <h3>Address</h3>
                                <p>MediBook Medical Center<br>New Baneshwor, Kathmandu 44600<br>Nepal</p>
                            </div>
                        </div>
                        <div class="info-card">
                            <div class="icon">
                                <span class="fas fa-phone-alt" aria-hidden="true"></span>
                            </div>
                            <div class="info">
                                <h3>Phone</h3>
                                <p>+977 0214 2456<br>+977 3434 5678</p>
                            </div>
                        </div>
                        <div class="info-card">
                            <div class="icon">
                                <span class="fas fa-clock" aria-hidden="true"></span>
                            </div>
                            <div class="info">
                                <h3>Working Hours</h3>
                                <p>Monday - Thursday: 9:00 AM - 5:00 PM<br>
                                Friday: 10:00 AM - 2:00 PM<br>
                                Saturday: 9:00 AM - 12:00 PM<br>
                                Sunday: Closed</p>
                            </div>
                        </div>
                    </div>
                    <div class="map-container">
                        <iframe 
                            src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d14167.641785409947!2d85.342346214591!3d27.691557138587868!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x39eb1a2e3724c59b%3A0x2c4e008b5c8ed3f5!2sGaucharan%2C%20Kathmandu%2044600!5e1!3m2!1sen!2snp!4v1740921514484!5m2!1sen!2snp" 
                            width="600" 
                            height="450" 
                            style="border:0;" 
                            allowfullscreen="" 
                            loading="lazy" 
                            referrerpolicy="no-referrer-when-downgrade"
                            title="MediBook Location Map">
                        </iframe>
                    </div>
                </div>
            </div>
        </section>
        
        <section class="section directions" style="background-color: var(--light);">
            <div class="container">
                <h2 class="section-title">How to Reach Us</h2>
                <div class="directions-grid">
                    <div class="direction-card">
                        <div class="icon">
                            <span class="fas fa-car" aria-hidden="true"></span>
                        </div>
                        <h3>By Car</h3>
                        <p>We have ample parking space available for patients and visitors. Follow the main road to New Baneshwor and look for MediBook signage.</p>
                    </div>
                    <div class="direction-card">
                        <div class="icon">
                            <span class="fas fa-bus" aria-hidden="true"></span>
                        </div>
                        <h3>By Public Transport</h3>
                        <p>Several bus routes stop near our facility. The nearest bus stop is "New Baneshwor Chowk," just a 5-minute walk from our center.</p>
                    </div>
                    <div class="direction-card">
                        <div class="icon">
                            <span class="fas fa-taxi" aria-hidden="true"></span>
                        </div>
                        <h3>By Taxi</h3>
                        <p>Taxis are readily available throughout Kathmandu. Ask the driver to take you to MediBook Medical Center in New Baneshwor.</p>
                    </div>
                </div>
            </div>
        </section>
        
        <section class="section cta-section" style="background: linear-gradient(135deg, var(--primary), var(--primary-dark)); color: white; text-align: center;">
            <div class="container">
                <h2 style="margin-bottom: 20px;">Need Directions?</h2>
                <p style="margin-bottom: 30px; max-width: 700px; margin-left: auto; margin-right: auto;">If you're having trouble finding us, please don't hesitate to call. Our staff will be happy to guide you to our location.</p>
                <a href="contact.php" class="btn" style="background: white; color: var(--primary);">Contact Us</a>
            </div>
        </section>
    </main>
    
    <footer class="footer">
        <div class="container">
            <div class="footer-grid">
                <div class="footer-column">
                    <h3>MediBook</h3>
                    <p>Your trusted healthcare partner providing quality medical services and care for all your health needs.</p>
                    <div class="social-links">
                        <a href="#" aria-label="Facebook"><span class="fab fa-facebook-f" aria-hidden="true"></span></a>
                        <a href="#" aria-label="Twitter"><span class="fab fa-twitter" aria-hidden="true"></span></a>
                        <a href="#" aria-label="Instagram"><span class="fab fa-instagram" aria-hidden="true"></span></a>
                        <a href="#" aria-label="LinkedIn"><span class="fab fa-linkedin-in" aria-hidden="true"></span></a>
                    </div>
                </div>
                <div class="footer-column">
                    <h3>Quick Links</h3>
                    <ul class="footer-links">
                        <li><a href="index.php">Home</a></li>
                        <li><a href="services.php">Services</a></li>
                        <li><a href="location.php">Location</a></li>
                        <li><a href="contact.php">Contact</a></li>
                        <li><a href="bkstf/index.php">Login</a></li>
                    </ul>
                </div>
                <div class="footer-column">
                    <h3>Contact Info</h3>
                    <ul class="footer-links">
                        <li><span class="fas fa-map-marker-alt" aria-hidden="true"></span> New Baneshwor, Kathmandu, Nepal</li>
                        <li><span class="fas fa-phone" aria-hidden="true"></span> +977 0214 2456</li>
                        <li><span class="fas fa-envelope" aria-hidden="true"></span> info@medibook.com</li>
                    </ul>
                </div>
                <div class="footer-column">
                    <h3>Working Hours</h3>
                    <ul class="footer-links">
                        <li>Monday - Thursday: 9:00 AM - 5:00 PM</li>
                        <li>Friday: 10:00 AM - 2:00 PM</li>
                        <li>Saturday: 9:00 AM - 12:00 PM</li>
                        <li>Sunday: Closed</li>
                    </ul>
                </div>
            </div>
            <div class="footer-bottom">
                <p>&copy; 2025 MediBook. All rights reserved.</p>
            </div>
        </div>
    </footer>

    <script>
        // Mobile menu toggle
        document.addEventListener('DOMContentLoaded', function() {
            const mobileToggle = document.getElementById('mobileToggle');
            const navigation = document.getElementById('navigation');
            
            mobileToggle.addEventListener('click', function() {
                navigation.classList.toggle('active');
            });
            
            // Header scroll effect
            window.addEventListener('scroll', function() {
                const header = document.querySelector('header');
                header.classList.toggle('scrolled', window.scrollY > 50);
            });
        });
    </script>
</body>
</html>