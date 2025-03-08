<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>MediBook | Contact Us</title>
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

        /* Contact Section */
        .contact-container {
            display: grid;
            grid-template-columns: 1fr 2fr;
            gap: 30px;
        }

        .contact-info {
            background-color: var(--primary);
            color: var(--white);
            padding: 40px;
            border-radius: var(--radius);
        }

        .contact-info h3 {
            font-size: 24px;
            margin-bottom: 30px;
        }

        .contact-detail {
            display: flex;
            margin-bottom: 25px;
        }

        .contact-detail i {
            font-size: 20px;
            margin-right: 15px;
            margin-top: 3px;
        }

        .contact-detail-content h4 {
            font-size: 16px;
            margin-bottom: 5px;
        }

        .contact-detail-content p {
            opacity: 0.9;
            font-size: 14px;
        }

        .contact-form {
            background-color: var(--white);
            padding: 40px;
            border-radius: var(--radius);
            box-shadow: var(--shadow);
        }

        .contact-form h3 {
            font-size: 24px;
            margin-bottom: 10px;
        }

        .contact-form p {
            color: var(--dark-gray);
            margin-bottom: 25px;
        }

        .form-group {
            margin-bottom: 20px;
        }

        .form-group label {
            display: block;
            margin-bottom: 8px;
            font-weight: 500;
        }

        .form-control {
            width: 100%;
            padding: 12px 15px;
            border: 1px solid var(--medium-gray);
            border-radius: var(--radius);
            font-family: "Poppins", sans-serif;
            transition: var(--transition);
        }

        .form-control:focus {
            outline: none;
            border-color: var(--primary);
            box-shadow: 0 0 0 3px rgba(64, 224, 208, 0.2);
        }

        textarea.form-control {
            min-height: 120px;
            resize: vertical;
        }

        .btn-submit {
            background-color: var(--primary);
            color: var(--white);
            border: none;
            padding: 12px 25px;
            border-radius: var(--radius);
            font-weight: 500;
            cursor: pointer;
            transition: var(--transition);
            display: inline-flex;
            align-items: center;
        }

        .btn-submit i {
            margin-right: 8px;
        }

        .btn-submit:hover {
            background-color: var(--primary-dark);
            transform: translateY(-2px);
            box-shadow: var(--shadow);
        }

        .status-message {
            margin-top: 15px;
            padding: 10px 15px;
            border-radius: var(--radius);
            font-weight: 500;
            display: none;
        }

        .status-message.success {
            display: block;
            background-color: rgba(76, 175, 80, 0.1);
            color: #4caf50;
            border: 1px solid rgba(76, 175, 80, 0.3);
        }

        .status-message.error {
            display: block;
            background-color: rgba(244, 67, 54, 0.1);
            color: #f44336;
            border: 1px solid rgba(244, 67, 54, 0.3);
        }

        .status-message.loading {
            display: block;
            background-color: rgba(64, 224, 208, 0.1);
            color: var(--primary);
            border: 1px solid rgba(64, 224, 208, 0.3);
        }

        /* FAQ Section */
        .faq-container {
            max-width: 800px;
            margin: 0 auto;
        }

        .faq-item {
            background-color: var(--white);
            border-radius: var(--radius);
            margin-bottom: 15px;
            box-shadow: var(--shadow);
            overflow: hidden;
        }

        .faq-question {
            padding: 15px 20px;
            display: flex;
            justify-content: space-between;
            align-items: center;
            cursor: pointer;
            transition: var(--transition);
        }

        .faq-question:hover {
            background-color: rgba(64, 224, 208, 0.05);
        }

        .faq-question h3 {
            font-size: 16px;
            font-weight: 500;
        }

        .faq-question i {
            color: var(--primary);
            transition: transform 0.3s ease;
        }

        .faq-item.active .faq-question i {
            transform: rotate(180deg);
        }

        .faq-answer {
            padding: 0;
            max-height: 0;
            overflow: hidden;
            transition: max-height 0.3s ease, padding 0.3s ease;
        }

        .faq-item.active .faq-answer {
            padding: 0 20px 15px;
            max-height: 200px;
        }

        .faq-answer p {
            color: var(--dark-gray);
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

            .contact-container {
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

            .contact-info, 
            .contact-form {
                padding: 25px;
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
        
        .fa-phone:before {
            content: "📞";
        }
        
        .fa-envelope:before {
            content: "✉";
        }
        
        .fa-clock:before {
            content: "🕒";
        }
        
        .fa-chevron-down:before {
            content: "▼";
            font-size: 12px;
        }
        
        .fa-paper-plane:before {
            content: "📨";
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
                    <a href="location.php">Location</a>
                    <a href="contact.php" class="active">Contact</a>
                    <a href="bkstf/index.php" class="btn-login">Login</a>
                </nav>
            </div>
        </div>
    </header>

    <section class="hero" style="background: linear-gradient(rgba(0, 0, 0, 0.6), rgba(0, 0, 0, 0.6)), url('https://hebbkx1anhila5yf.public.blob.vercel-storage.com/bkg-img.jpg-D7JSDY50A4LDZbmmPgAYd5mfTsvRPc.jpeg') center/cover;">
        <div class="container">
            <div class="hero-content">
                <h1>Get in Touch</h1>
                <p>We're here to help with any questions you may have</p>
            </div>
        </div>
    </section>

    <main>
        <section class="section">
            <div class="container">
                <h2 class="section-title">Contact Us</h2>
                <div class="contact-container">
                    <div class="contact-info">
                        <h3>Contact Information</h3>
                        <div class="contact-detail">
                            <span class="fas fa-map-marker-alt" aria-hidden="true"></span>
                            <div class="contact-detail-content">
                                <h4>Address</h4>
                                <p>MediBook Medical Center<br>New Baneshwor, Kathmandu 44600<br>Nepal</p>
                            </div>
                        </div>
                        <div class="contact-detail">
                            <span class="fas fa-phone" aria-hidden="true"></span>
                            <div class="contact-detail-content">
                                <h4>Phone</h4>
                                <p>+977 0214 2456<br>+977 3434 5678</p>
                            </div>
                        </div>
                        <div class="contact-detail">
                            <span class="fas fa-envelope" aria-hidden="true"></span>
                            <div class="contact-detail-content">
                                <h4>Email</h4>
                                <p>info@medibook.com<br>support@medibook.com</p>
                            </div>
                        </div>
                        <div class="contact-detail">
                            <span class="fas fa-clock" aria-hidden="true"></span>
                            <div class="contact-detail-content">
                                <h4>Working Hours</h4>
                                <p>Monday - Thursday: 9:00 AM - 5:00 PM<br>
                                Friday: 10:00 AM - 2:00 PM<br>
                                Saturday: 9:00 AM - 12:00 PM<br>
                                Sunday: Closed</p>
                            </div>
                        </div>
                    </div>
                    <div class="contact-form">
                        <h3>Send Us a Message</h3>
                        <p>Have questions or need assistance? Please fill out the form below and we'll get back to you as soon as possible.</p>
                        <form id="contactForm" action="#" method="post" onsubmit="return validateForm(event)">
                            <div class="form-group">
                                <label for="name">Your Name</label>
                                <input type="text" id="name" name="name" class="form-control" placeholder="Enter your full name" required>
                            </div>
                            <div class="form-group">
                                <label for="email">Your Email</label>
                                <input type="email" id="email" name="email" class="form-control" placeholder="Enter your email address" required>
                            </div>
                            <div class="form-group">
                                <label for="subject">Subject</label>
                                <input type="text" id="subject" name="subject" class="form-control" placeholder="Enter message subject" required>
                            </div>
                            <div class="form-group">
                                <label for="message">Your Message</label>
                                <textarea id="message" name="message" class="form-control" placeholder="Enter your message" required></textarea>
                            </div>
                            <button type="submit" class="btn-submit">
                                <span class="fas fa-paper-plane" aria-hidden="true"></span> Send Message
                            </button>
                        </form>
                        <div id="status" class="status-message"></div>
                    </div>
                </div>
            </div>
        </section>

        <section class="section" style="background-color: #f5f5f5;">
            <div class="container">
                <h2 class="section-title">Frequently Asked Questions</h2>
                <div class="faq-container">
                    <div class="faq-item">
                        <div class="faq-question" onclick="toggleFaq(this)">
                            <h3>How do I schedule an appointment?</h3>
                            <span class="fas fa-chevron-down" aria-hidden="true"></span>
                        </div>
                        <div class="faq-answer">
                            <p>You can schedule an appointment by logging into your account on our website, calling our reception desk at +977 0214 2456, or visiting our medical center in person during working hours.</p>
                        </div>
                    </div>
                    <div class="faq-item">
                        <div class="faq-question" onclick="toggleFaq(this)">
                            <h3>What insurance plans do you accept?</h3>
                            <span class="fas fa-chevron-down" aria-hidden="true"></span>
                        </div>
                        <div class="faq-answer">
                            <p>We accept most major insurance plans. Please contact our billing department for specific information about your insurance coverage and benefits.</p>
                        </div>
                    </div>
                    <div class="faq-item">
                        <div class="faq-question" onclick="toggleFaq(this)">
                            <h3>How can I access my medical records?</h3>
                            <span class="fas fa-chevron-down" aria-hidden="true"></span>
                        </div>
                        <div class="faq-answer">
                            <p>You can access your medical records by logging into your patient portal on our website. If you need assistance, please contact our medical records department.</p>
                        </div>
                    </div>
                    <div class="faq-item">
                        <div class="faq-question" onclick="toggleFaq(this)">
                            <h3>What should I bring to my first appointment?</h3>
                            <span class="fas fa-chevron-down" aria-hidden="true"></span>
                        </div>
                        <div class="faq-answer">
                            <p>Please bring your identification, insurance card, a list of current medications, and any relevant medical records or test results from previous healthcare providers.</p>
                        </div>
                    </div>
                </div>
            </div>
        </section>

        <section class="section cta-section" style="background: linear-gradient(rgba(0, 0, 0, 0.7), rgba(0, 0, 0, 0.7)), url('https://hebbkx1anhila5yf.public.blob.vercel-storage.com/bkg-img.jpg-D7JSDY50A4LDZbmmPgAYd5mfTsvRPc.jpeg') center/cover fixed;">
            <div class="container">
                <h2 class="section-title" style="color: white;">Need Immediate Assistance?</h2>
                <div class="text-center" style="max-width: 700px; margin: 0 auto;">
                    <p style="margin-bottom: 30px; color: white;">If you have an urgent medical question or need immediate assistance, please don't hesitate to call our emergency hotline.</p>
                    <a href="tel:+9779*********" class="btn">Call Now</a>
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
                        <li><a href="index.html">Home</a></li>
                        <li><a href="services.html">Services</a></li>
                        <li><a href="location.html">Location</a></li>
                        <li><a href="contact.html">Contact</a></li>
                        <li><a href="login.html">Login</a></li>
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
            
            // Form validation
            window.validateForm = function(event) {
                event.preventDefault();
                
                const name = document.getElementById("name").value;
                const email = document.getElementById("email").value;
                const subject = document.getElementById("subject").value;
                const message = document.getElementById("message").value;
                const statusElement = document.getElementById("status");
                
                if (!name || !email || !subject || !message) {
                    statusElement.innerHTML = 'Please fill all the fields';
                    statusElement.className = 'status-message error';
                    return false;
                }
                
                // Email validation
                const emailRegex = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
                if (!emailRegex.test(email)) {
                    statusElement.innerHTML = 'Please enter a valid email address';
                    statusElement.className = 'status-message error';
                    return false;
                }
                
                // Show loading message
                statusElement.innerHTML = 'Sending your message...';
                statusElement.className = 'status-message loading';
                
                // Simulate sending email (replace with actual email sending code)
                setTimeout(function() {
                    statusElement.innerHTML = 'Your message has been sent successfully!';
                    statusElement.className = 'status-message success';
                    document.getElementById("contactForm").reset();
                }, 2000);
                
                return false;
            };
            
            // FAQ toggle
            window.toggleFaq = function(element) {
                const faqItem = element.parentElement;
                const isActive = faqItem.classList.contains('active');
                
                // Close all FAQs
                document.querySelectorAll('.faq-item').forEach(item => {
                    item.classList.remove('active');
                });
                
                // If the clicked FAQ wasn't active, open it
                if (!isActive) {
                    faqItem.classList.add('active');
                }
            };
        });
    </script>
</body>
</html>