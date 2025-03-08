<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>MediBook | Appointment</title>
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Poppins:300,400,500,600,700">
    <link rel="stylesheet" href="css/style.css">
</head>
<body>
    <div class="navbar flex_container justifier_navbar">
        <div style="cursor:pointer;" onclick="window.location.href='index.php'">MediBook</div>
        <nav class="logout">
            <a href="#" onclick="window.location.href='info.php'">Manage Appointments</a>
            <a href="#" onclick="window.location.href='logout.php'">Logout</a>
        </nav>
    </div>
    <section class="appointment" id="appointments">
        <h2>Book an Appointment</h2>
        <form action="booking.php" method="post">
            <input type="text" name="name" placeholder="Name" required>
            <input type="email" name="email" placeholder="Email" required>
            <input type="date" name="date" placeholder="Date" required min="<?php echo date('Y-m-d'); ?>">
            <select name="service" required>
                <option value="">Select Service</option>
                <option>Regular Checkup</option>
                <option>General Medicine</option>
                <option>Cardiology</option>
                <option>Dermatology</option>
                <option>Orthopedics</option>
                <option>Pediatrics</option>
                <option>Neurology</option>
                <option>Psychiatry</option>
                <option>Ophthalmology</option>
            </select>
            <button type="submit" name="booking">Book Appointment</button>
        </form>
    </section>

    <footer class="footer">
        <p>Follow us on</p>
        <ul class="social-links">
            <li><a href="https://www.facebook.com/" target="_blank">Facebook</a></li>
            <li><a href="https://x.com/?lang=en/" target="_blank">Twitter</a></li>
            <li><a href="https://www.instagram.com/" target="_blank">Instagram</a></li>
            <li><a href="https://www.linkedin.com/" target="_blank">LinkedIn</a></li>
        </ul>
        <p class="copyright">&copy; 2025 MediBook. All rights reserved.</p>
    </footer>
</body>
</html>