<?php
session_start();
include 'config.php';

// Check if user is logged in
if (!isset($_SESSION['email'])) {
    header("Location: login.php");
    exit();
}

$userEmail = $_SESSION['email'];

// Handle appointment cancellation
if (isset($_GET['cancel']) && isset($_GET['id'])) {
    $appointmentId = $_GET['id'];
    $sql = "DELETE FROM booking WHERE id = ? AND email = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("is", $appointmentId, $userEmail);
    $stmt->execute();
    
    if ($stmt->affected_rows > 0) {
        $successMessage = "Appointment cancelled successfully!";
    } else {
        $errorMessage = "Failed to cancel appointment.";
    }
    $stmt->close();
}

// Handle date update
if (isset($_POST['update'])) {
    $appointmentId = $_POST['appointment_id'];
    $newDate = $_POST['new_date'];
    
    $sql = "UPDATE booking SET date = ? WHERE id = ? AND email = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("sis", $newDate, $appointmentId, $userEmail);
    $stmt->execute();
    
    if ($stmt->affected_rows > 0) {
        $successMessage = "Appointment date updated successfully!";
    } else {
        $errorMessage = "Failed to update appointment date.";
    }
    $stmt->close();
}

// Fetch user's appointments
$sql = "SELECT * FROM booking WHERE email = ? ORDER BY date ASC";
$stmt = $conn->prepare($sql);
$stmt->bind_param("s", $userEmail);
$stmt->execute();
$result = $stmt->get_result();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>MediBook | Manage Appointments</title>
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Poppins:300,400,500,600,700">
    <link rel="stylesheet" href="css/style.css">
    <link rel="stylesheet" href="css/info.css">
</head>
<body>
    <div class="navbar flex_container justifier_navbar">
        <div style="cursor:pointer;" onclick="window.location.href='index.php'">MediBook</div>
        <nav class="logout">
            <a href="#" onclick="window.location.href='appointment.php'">Book Appointment</a>
            <a href="#" onclick="window.location.href='logout.php'">Logout</a>
        </nav>
    </div>
    
    <div class="appointment-manager">
        <h2>Manage Your Appointments</h2>
        
        <?php if (isset($successMessage)): ?>
            <div class="alert success"><?php echo $successMessage; ?></div>
        <?php endif; ?>
        
        <?php if (isset($errorMessage)): ?>
            <div class="alert error"><?php echo $errorMessage; ?></div>
        <?php endif; ?>
        
        <?php if ($result->num_rows > 0): ?>
            <div class="appointments-container">
                <?php while ($row = $result->fetch_assoc()): ?>
                    <div class="appointment-card">
                        <div class="appointment-details">
                            <h3><?php echo htmlspecialchars($row['service']); ?></h3>
                            <p><strong>Date:</strong> <?php echo htmlspecialchars($row['date']); ?></p>
                            <p><strong>Name:</strong> <?php echo htmlspecialchars($row['name']); ?></p>
                            <p><strong>Email:</strong> <?php echo htmlspecialchars($row['email']); ?></p>
                        </div>
                        <div class="appointment-actions">
                            <button class="edit-btn" onclick="showEditForm(<?php echo $row['id']; ?>)">Change Date</button>
                            <a href="info.php?cancel=1&id=<?php echo $row['id']; ?>" class="cancel-btn" onclick="return confirm('Are you sure you want to cancel this appointment?')">Cancel Appointment</a>
                            
                            <form id="edit-form-<?php echo $row['id']; ?>" class="edit-form" style="display: none;" method="post" action="info.php">
                                <input type="hidden" name="appointment_id" value="<?php echo $row['id']; ?>">
                                <input type="date" name="new_date" required min="<?php echo date('Y-m-d'); ?>">
                                <button type="submit" name="update">Update Date</button>
                            </form>
                        </div>
                    </div>
                <?php endwhile; ?>
            </div>
        <?php else: ?>
            <div class="no-appointments">
                <p>You don't have any appointments scheduled.</p>
                <a href="appointment.php" class="book-btn">Book an Appointment</a>
            </div>
        <?php endif; ?>
    </div>
    
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
    
    <script>
        function showEditForm(id) {
            const form = document.getElementById('edit-form-' + id);
            if (form.style.display === 'none') {
                form.style.display = 'block';
            } else {
                form.style.display = 'none';
            }
        }
    </script>
</body>
</html>