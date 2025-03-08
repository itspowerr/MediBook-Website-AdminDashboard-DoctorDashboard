<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>MediBook | Medical Appointment System</title>
    <style>
        /* Base Styles */
        :root {
            --primary: #40e0d0;
            --primary-dark: #20b2aa;
            --primary-light: #afeeee;
            --secondary: #333333;
            --light-gray: #f5f5f5;
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

        .btn-outline {
            background-color: transparent;
            border: 2px solid var(--primary);
            color: var(--primary);
        }

        .btn-outline:hover {
            background-color: var(--primary);
            color: var(--white);
        }

        .text-center {
            text-align: center;
        }

        .mt-4 {
            margin-top: 20px;
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

        .hero-buttons {
            display: flex;
            justify-content: center;
            gap: 15px;
        }

        /* Availability Section */
        .availability {
            background-color: var(--light-gray);
        }

        .availability-table {
            max-width: 800px;
            margin: 0 auto;
            background-color: var(--white);
            border-radius: var(--radius);
            overflow: hidden;
            box-shadow: var(--shadow);
        }

        .availability-row {
            display: flex;
            justify-content: space-between;
            align-items: center;
            padding: 15px 20px;
            border-bottom: 1px solid var(--medium-gray);
        }

        .availability-row:last-child {
            border-bottom: none;
        }

        .day-time {
            display: flex;
            align-items: center;
        }

        .day-time i {
            color: var(--primary);
            margin-right: 15px;
        }

        .day {
            font-weight: 500;
        }

        .time {
            color: var(--dark-gray);
            font-size: 14px;
        }

        .status {
            padding: 5px 12px;
            border-radius: 50px;
            font-size: 12px;
            font-weight: 500;
        }

        .status.available {
            background-color: rgba(64, 224, 208, 0.15);
            color: var(--primary-dark);
        }

        .status.limited {
            background-color: rgba(255, 193, 7, 0.15);
            color: #ff9800;
        }

        .status.closed {
            background-color: rgba(244, 67, 54, 0.15);
            color: #f44336;
        }

        /* Services Section */
        .services-grid {
            display: grid;
            grid-template-columns: repeat(auto-fill, minmax(300px, 1fr));
            gap: 30px;
        }

        .service-card {
            background-color: var(--white);
            border-radius: var(--radius);
            padding: 30px;
            box-shadow: var(--shadow);
            transition: var(--transition);
            border-top: 3px solid var(--primary);
            text-align: center;
        }

        .service-card:hover {
            transform: translateY(-5px);
            box-shadow: var(--shadow-lg);
        }

        .service-card i {
            font-size: 40px;
            color: var(--primary);
            margin-bottom: 20px;
            display: inline-block;
        }

        .service-card h3 {
            font-size: 20px;
            margin-bottom: 15px;
        }

        .service-card p {
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

        /* Responsive Design */
        @media (max-width: 992px) {
            .section {
                padding: 50px 0;
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

            .hero-buttons {
                flex-direction: column;
                align-items: center;
            }

            .services-grid {
                grid-template-columns: 1fr;
            }
        }

        @media (max-width: 576px) {
            .section-title {
                font-size: 24px;
            }

            .availability-row {
                flex-direction: column;
                align-items: flex-start;
            }

            .status {
                margin-top: 10px;
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
        
        .fa-calendar-alt:before {
            content: "📅";
        }
        
        .fa-ambulance:before {
            content: "🚑";
        }
        
        .fa-heartbeat:before {
            content: "💓";
        }
        
        .fa-stethoscope:before {
            content: "🩺";
        }
        
        .fa-brain:before {
            content: "🧠";
        }
        
        .fa-procedures:before {
            content: "🛏️";
        }
        
        .fa-tooth:before {
            content: "🦷";
        }
        
        .fa-map-marker-alt:before {
            content: "📍";
        }
        
        .fa-phone:before {
            content: "📞";
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
                    <a href="index.php" class="active">Home</a>
                    <a href="services.php">Services</a>
                    <a href="location.php">Location</a>
                    <a href="contact.php">Contact</a>
                    <a href="bkstf/index.php" class="btn-login">Login</a>
                </nav>
            </div>
        </div>
    </header>

    <section class="hero" style="background: linear-gradient(rgba(0, 0, 0, 0.6), rgba(0, 0, 0, 0.6)), url('https://hebbkx1anhila5yf.public.blob.vercel-storage.com/bkg-img.jpg-D7JSDY50A4LDZbmmPgAYd5mfTsvRPc.jpeg') center/cover;">
        <div class="container">
            <div class="hero-content">
                <h1>Your Health, Our Priority</h1>
                <p>Welcome to MediBook - Your trusted healthcare partner providing quality medical services and care for all your health needs.</p>
                <div class="hero-buttons">
                    <a href="services.php" class="btn">Our Services</a>
                    <a href="bkstf/index.php" class="btn btn-outline">Book Appointment</a>
                </div>
            </div>
        </div>
    </section>

    <main>
        <section class="section availability">
            <div class="container">
                <h2 class="section-title">Doctor's Availability</h2>
                <div class="availability-table">
                    <div class="availability-row">
                        <div class="day-time">
                            <span class="far fa-calendar-alt" aria-hidden="true"></span>
                            <div>
                                <div class="day">Monday - Thursday</div>
                                <div class="time">9:00 AM - 5:00 PM</div>
                            </div>
                        </div>
                        <span class="status available">Available</span>
                    </div>
                    <div class="availability-row">
                        <div class="day-time">
                            <span class="far fa-calendar-alt" aria-hidden="true"></span>
                            <div>
                                <div class="day">Friday</div>
                                <div class="time">10:00 AM - 2:00 PM</div>
                            </div>
                        </div>
                        <span class="status available">Available</span>
                    </div>
                    <div class="availability-row">
                        <div class="day-time">
                            <span class="far fa-calendar-alt" aria-hidden="true"></span>
                            <div>
                                <div class="day">Saturday</div>
                                <div class="time">9:00 AM - 12:00 PM</div>
                            </div>
                        </div>
                        <span class="status limited">Limited</span>
                    </div>
                    <div class="availability-row">
                        <div class="day-time">
                            <span class="far fa-calendar-alt" aria-hidden="true"></span>
                            <div>
                                <div class="day">Sunday</div>
                                <div class="time">Closed</div>
                            </div>
                        </div>
                        <span class="status closed">Closed</span>
                    </div>
                </div>
                <div class="text-center mt-4">
                    <a href="bkstf/index.php" class="btn">Book an Appointment</a>
                </div>
            </div>
        </section>

        <section class="section services">
            <div class="container">
                <h2 class="section-title">Our Services</h2>
                <div class="services-grid">
                    <div class="service-card">
                        <span class="fas fa-ambulance" aria-hidden="true"></span>
                        <h3>Emergency Care</h3>
                        <p>24/7 emergency medical services for critical situations requiring immediate attention.</p>
                    </div>
                    <div class="service-card">
                        <span class="fas fa-heartbeat" aria-hidden="true"></span>
                        <h3>Cardiology</h3>
                        <p>Comprehensive heart care including diagnostics, treatment, and preventive services.</p>
                    </div>
                    <div class="service-card">
                        <span class="fas fa-stethoscope" aria-hidden="true"></span>
                        <h3>General Checkup</h3>
                        <p>Routine health assessments and preventive care for overall well-being.</p>
                    </div>
                    <div class="service-card">
                        <span class="fas fa-brain" aria-hidden="true"></span>
                        <h3>Neurology</h3>
                        <p>Specialized care for neurological disorders and conditions affecting the brain and nervous system.</p>
                    </div>
                    <div class="service-card">
                        <span class="fas fa-procedures" aria-hidden="true"></span>
                        <h3>Surgery</h3>
                        <p>Advanced surgical procedures performed by experienced specialists using modern techniques.</p>
                    </div>
                    <div class="service-card">
                        <span class="fas fa-tooth" aria-hidden="true"></span>
                        <h3>Dental Care</h3>
                        <p>Comprehensive dental services including preventive care, restorative treatments, and cosmetic procedures.</p>
                    </div>
                </div>
                <div class="text-center mt-4">
                    <a href="services.php" class="btn">View All Services</a>
                </div>
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
                        <li><span class="fas fa-map-marker-alt" aria-hidden="true"></span> New Baneshwor, Kathmandu</li>
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
        });
    </script>
</body>
</html>