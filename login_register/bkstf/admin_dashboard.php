<?php
session_start();
require_once 'config.php';

// Check if user is logged in and is admin
if (!isset($_SESSION['email']) || !isset($_SESSION['name'])) {
    header("Location: index.php");
    exit();
}

// Get admin info
$email = $_SESSION['email'];
$result = $conn->query("SELECT * FROM users WHERE email = '$email' AND role = 'admin'");
if ($result->num_rows == 0) {
    header("Location: index.php");
    exit();
}

$admin = $result->fetch_assoc();

// Handle actions
$action = isset($_GET['action']) ? $_GET['action'] : 'dashboard';
$message = '';

// Add admin
if (isset($_POST['add_admin'])) {
    $name = $_POST['name'];
    $email = $_POST['email'];
    $password = password_hash($_POST['password'], PASSWORD_DEFAULT);
    
    $checkEmail = $conn->query("SELECT email FROM users WHERE email = '$email'");
    if ($checkEmail->num_rows > 0) {
        $message = '<div class="alert error">Email is already registered!</div>';
    } else {
        $sql = "INSERT INTO users (name, email, password, role, created_at) VALUES ('$name', '$email', '$password', 'admin', CURRENT_TIMESTAMP)";
        if ($conn->query($sql) === TRUE) {
            $message = '<div class="alert success">Admin added successfully!</div>';
        } else {
            $message = '<div class="alert error">Error: ' . $conn->error . '</div>';
        }
    }
}

// Add patient - FIXED
if (isset($_POST['add_patient'])) {
    $name = $_POST['name'];
    $email = $_POST['email'];
    $password = password_hash($_POST['password'], PASSWORD_DEFAULT);
    $role = 'user'; // Set role to user as required
    
    $checkEmail = $conn->query("SELECT email FROM users WHERE email = '$email'");
    if ($checkEmail->num_rows > 0) {
        $message = '<div class="alert error">Email is already registered!</div>';
    } else {
        $sql = "INSERT INTO users (name, email, password, role, created_at) VALUES ('$name', '$email', '$password', '$role', CURRENT_TIMESTAMP)";
        if ($conn->query($sql) === TRUE) {
            $message = '<div class="alert success">Patient added successfully!</div>';
        } else {
            $message = '<div class="alert error">Error: ' . $conn->error . '</div>';
        }
    }
}

// Edit patient
if (isset($_POST['edit_patient'])) {
    $id = $_POST['user_id'];
    $name = $_POST['name'];
    $email = $_POST['email'];
    
    // Check if email exists for another user
    $checkEmail = $conn->query("SELECT email FROM users WHERE email = '$email' AND id != $id");
    if ($checkEmail->num_rows > 0) {
        $message = '<div class="alert error">Email is already registered to another user!</div>';
    } else {
        // Update password only if provided
        if (!empty($_POST['password'])) {
            $password = password_hash($_POST['password'], PASSWORD_DEFAULT);
            $sql = "UPDATE users SET name = '$name', email = '$email', password = '$password' WHERE id = $id";
        } else {
            $sql = "UPDATE users SET name = '$name', email = '$email' WHERE id = $id";
        }
        
        if ($conn->query($sql) === TRUE) {
            $message = '<div class="alert success">Patient updated successfully!</div>';
        } else {
            $message = '<div class="alert error">Error: ' . $conn->error . '</div>';
        }
    }
}

// Add doctor
if (isset($_POST['add_doctor'])) {
    $name = $_POST['name'];
    $email = $_POST['email'];
    $password = password_hash($_POST['password'], PASSWORD_DEFAULT);
    $specialty = $_POST['specialty'];
    $role = 'doctor';
    
    $checkEmail = $conn->query("SELECT email FROM users WHERE email = '$email'");
    if ($checkEmail->num_rows > 0) {
        $message = '<div class="alert error">Email is already registered!</div>';
    } else {
        $sql = "INSERT INTO users (name, email, password, role, specialty, created_at) VALUES ('$name', '$email', '$password', 'doctor', '$specialty', CURRENT_TIMESTAMP)";
        if ($conn->query($sql) === TRUE) {
            $message = '<div class="alert success">Doctor added successfully!</div>';
        } else {
            $message = '<div class="alert error">Error: ' . $conn->error . '</div>';
        }
    }
}

// Edit doctor
if (isset($_POST['edit_doctor'])) {
    $id = $_POST['user_id'];
    $name = $_POST['name'];
    $email = $_POST['email'];
    $specialty = $_POST['specialty'];
    
    // Check if email exists for another user
    $checkEmail = $conn->query("SELECT email FROM users WHERE email = '$email' AND id != $id");
    if ($checkEmail->num_rows > 0) {
        $message = '<div class="alert error">Email is already registered to another user!</div>';
    } else {
        // Update password only if provided
        if (!empty($_POST['password'])) {
            $password = password_hash($_POST['password'], PASSWORD_DEFAULT);
            $sql = "UPDATE users SET name = '$name', email = '$email', password = '$password', specialty = '$specialty' WHERE id = $id";
        } else {
            $sql = "UPDATE users SET name = '$name', email = '$email', specialty = '$specialty' WHERE id = $id";
        }
        
        if ($conn->query($sql) === TRUE) {
            $message = '<div class="alert success">Doctor updated successfully!</div>';
        } else {
            $message = '<div class="alert error">Error: ' . $conn->error . '</div>';
        }
    }
}

// Delete user
if (isset($_GET['delete_user']) && isset($_GET['id'])) {
    $id = $_GET['id'];
    $conn->query("DELETE FROM users WHERE id = $id");
    $message = '<div class="alert success">User deleted successfully!</div>';
}

// Delete appointment
if (isset($_GET['delete_appointment']) && isset($_GET['id'])) {
    $id = $_GET['id'];
    $conn->query("DELETE FROM booking WHERE id = $id");
    $message = '<div class="alert success">Appointment deleted successfully!</div>';
}

// Edit appointment - NEW
if (isset($_POST['edit_appointment'])) {
    $id = $_POST['appointment_id'];
    $name = $_POST['name'];
    $email = $_POST['email'];
    $date = $_POST['date'];
    $service = $_POST['service'];
    
    $sql = "UPDATE booking SET name = '$name', email = '$email', date = '$date', service = '$service' WHERE id = $id";
    if ($conn->query($sql) === TRUE) {
        $message = '<div class="alert success">Appointment updated successfully!</div>';
    } else {
        $message = '<div class="alert error">Error: ' . $conn->error . '</div>';
    }
}

// Get counts for dashboard
$adminCount = $conn->query("SELECT COUNT(*) as count FROM users WHERE role = 'admin'")->fetch_assoc()['count'];
$patientCount = $conn->query("SELECT COUNT(*) as count FROM users WHERE role = 'patient' OR (role != 'admin' AND role != 'doctor')")->fetch_assoc()['count'];
$doctorCount = $conn->query("SELECT COUNT(*) as count FROM users WHERE role = 'doctor'")->fetch_assoc()['count'];
$appointmentCount = $conn->query("SELECT COUNT(*) as count FROM booking")->fetch_assoc()['count'];
$todayAppointments = $conn->query("SELECT COUNT(*) as count FROM booking WHERE date = CURDATE()")->fetch_assoc()['count'];
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>MediBook | Admin Dashboard</title>
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Poppins:300,400,500,600,700">
    <link rel="stylesheet" href="css/admin.css">
</head>
<body>
    <div class="admin-container">
        <!-- Sidebar -->
        <div class="sidebar">
            <div class="sidebar-header">
                <h2>MediBook</h2>
                <p>Admin Panel</p>
            </div>
            <div class="sidebar-menu">
                <a href="?action=dashboard" class="<?php echo $action == 'dashboard' ? 'active' : ''; ?>">
                    <span class="icon">📊</span> Dashboard
                </a>
                <a href="?action=admins" class="<?php echo $action == 'admins' ? 'active' : ''; ?>">
                    <span class="icon">👑</span> Manage Admins
                </a>
                <a href="?action=patients" class="<?php echo $action == 'patients' ? 'active' : ''; ?>">
                    <span class="icon">🧑</span> Manage Patients
                </a>
                <a href="?action=doctors" class="<?php echo $action == 'doctors' ? 'active' : ''; ?>">
                    <span class="icon">👨‍⚕️</span> Manage Doctors
                </a>
                <a href="?action=appointments" class="<?php echo $action == 'appointments' ? 'active' : ''; ?>">
                    <span class="icon">📅</span> Appointments
                </a>
                <a href="logout.php" class="logout-btn">
                    <span class="icon">🚪</span> Logout
                </a>
            </div>
        </div>

        <!-- Main Content -->
        <div class="main-content">
            <div class="header">
                <h1>
                    <?php
                    switch ($action) {
                        case 'dashboard':
                            echo 'Dashboard Overview';
                            break;
                        case 'admins':
                            echo 'Manage Administrators';
                            break;
                        case 'patients':
                            echo 'Manage Patients';
                            break;
                        case 'doctors':
                            echo 'Manage Doctors';
                            break;
                        case 'appointments':
                            echo 'Appointment Management';
                            break;
                        default:
                            echo 'Dashboard Overview';
                    }
                    ?>
                </h1>
                <div class="user-info">
                    <span>Welcome, <?php echo htmlspecialchars($admin['name']); ?></span>
                </div>
            </div>

            <?php echo $message; ?>

            <!-- Dashboard Content -->
            <?php if ($action == 'dashboard'): ?>
                <div class="dashboard-stats">
                    <div class="stat-card">
                        <div class="stat-value"><?php echo $adminCount; ?></div>
                        <div class="stat-label">Administrators</div>
                    </div>
                    <div class="stat-card">
                        <div class="stat-value"><?php echo $patientCount; ?></div>
                        <div class="stat-label">Patients</div>
                    </div>
                    <div class="stat-card">
                        <div class="stat-value"><?php echo $doctorCount; ?></div>
                        <div class="stat-label">Doctors</div>
                    </div>
                    <div class="stat-card">
                        <div class="stat-value"><?php echo $appointmentCount; ?></div>
                        <div class="stat-label">Total Appointments</div>
                    </div>
                    <div class="stat-card">
                        <div class="stat-value"><?php echo $todayAppointments; ?></div>
                        <div class="stat-label">Today's Appointments</div>
                    </div>
                </div>

                <div class="recent-section">
                    <h2>Recent Appointments</h2>
                    <div class="table-container">
                        <table>
                            <thead>
                                <tr>
                                    <th>Name</th>
                                    <th>Email</th>
                                    <th>Date</th>
                                    <th>Service</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                $recentAppointments = $conn->query("SELECT * FROM booking ORDER BY id DESC LIMIT 5");
                                if ($recentAppointments->num_rows > 0) {
                                    while ($row = $recentAppointments->fetch_assoc()) {
                                        echo "<tr>";
                                        echo "<td>" . htmlspecialchars($row['name']) . "</td>";
                                        echo "<td>" . htmlspecialchars($row['email']) . "</td>";
                                        echo "<td>" . htmlspecialchars($row['date']) . "</td>";
                                        echo "<td>" . htmlspecialchars($row['service']) . "</td>";
                                        echo "</tr>";
                                    }
                                } else {
                                    echo "<tr><td colspan='4'>No appointments found</td></tr>";
                                }
                                ?>
                            </tbody>
                        </table>
                    </div>
                </div>

                <div class="recent-section">
                    <h2>Recent Patients</h2>
                    <div class="table-container">
                        <table>
                            <thead>
                                <tr>
                                    <th>Name</th>
                                    <th>Email</th>
                                    <th>Registration Date</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                $recentPatients = $conn->query("SELECT * FROM users WHERE role = 'patient' OR (role != 'admin' AND role != 'doctor') ORDER BY id DESC LIMIT 5");
                                if ($recentPatients->num_rows > 0) {
                                    while ($row = $recentPatients->fetch_assoc()) {
                                        echo "<tr>";
                                        echo "<td>" . htmlspecialchars($row['name']) . "</td>";
                                        echo "<td>" . htmlspecialchars($row['email']) . "</td>";
                                        echo "<td>" . (isset($row['created_at']) ? date('Y-m-d', strtotime($row['created_at'])) : 'N/A') . "</td>";
                                        echo "</tr>";
                                    }
                                } else {
                                    echo "<tr><td colspan='3'>No patients found</td></tr>";
                                }
                                ?>
                            </tbody>
                        </table>
                    </div>
                </div>
            <?php endif; ?>

            <!-- Admins Management -->
            <?php if ($action == 'admins'): ?>
                <div class="admin-section">
                    <div class="add-form">
                        <h2>Add New Administrator</h2>
                        <form method="post" action="?action=admins">
                            <div class="form-group">
                                <label for="name">Name</label>
                                <input type="text" id="name" name="name" required>
                            </div>
                            <div class="form-group">
                                <label for="email">Email</label>
                                <input type="email" id="email" name="email" required>
                            </div>
                            <div class="form-group">
                                <label for="password">Password</label>
                                <input type="password" id="password" name="password" required>
                            </div>
                            <button type="submit" name="add_admin">Add Administrator</button>
                        </form>
                    </div>

                    <div class="list-section">
                        <h2>Current Administrators</h2>
                        <div class="table-container">
                            <table>
                                <thead>
                                    <tr>
                                        <th>ID</th>
                                        <th>Name</th>
                                        <th>Email</th>
                                        <th>Actions</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                    $admins = $conn->query("SELECT * FROM users WHERE role = 'admin'");
                                    if ($admins->num_rows > 0) {
                                        while ($row = $admins->fetch_assoc()) {
                                            echo "<tr>";
                                            echo "<td>" . $row['id'] . "</td>";
                                            echo "<td>" . htmlspecialchars($row['name']) . "</td>";
                                            echo "<td>" . htmlspecialchars($row['email']) . "</td>";
                                            echo "<td>";
                                            if ($row['email'] != $_SESSION['email']) { // Don't allow deleting yourself
                                                echo "<a href='?action=admins&delete_user=1&id=" . $row['id'] . "' class='delete-btn' onclick='return confirm(\"Are you sure you want to delete this admin?\")'>Delete</a>";
                                            } else {
                                                echo "<span class='current-user'>Current User</span>";
                                            }
                                            echo "</td>";
                                            echo "</tr>";
                                        }
                                    } else {
                                        echo "<tr><td colspan='4'>No administrators found</td></tr>";
                                    }
                                    ?>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            <?php endif; ?>

            <!-- Patients Management -->
            <?php if ($action == 'patients'): ?>
                <div class="admin-section">
                    <div class="add-form">
                        <h2>Add New Patient</h2>
                        <form method="post" action="?action=patients">
                            <div class="form-group">
                                <label for="name">Name</label>
                                <input type="text" id="name" name="name" required>
                            </div>
                            <div class="form-group">
                                <label for="email">Email</label>
                                <input type="email" id="email" name="email" required>
                            </div>
                            <div class="form-group">
                                <label for="password">Password</label>
                                <input type="password" id="password" name="password" required>
                            </div>
                            <button type="submit" name="add_patient">Add Patient</button>
                        </form>
                    </div>

                    <div class="list-section">
                        <h2>Current Patients</h2>
                        <div class="table-container">
                            <table>
                                <thead>
                                    <tr>
                                        <th>ID</th>
                                        <th>Name</th>
                                        <th>Email</th>
                                        <th>Actions</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                    // Get all users with role 'patient' or where role is not 'admin'
                                    $patients = $conn->query("SELECT * FROM users WHERE role = 'patient' OR (role != 'admin' AND role != 'doctor')");
                                    if ($patients->num_rows > 0) {
                                        while ($row = $patients->fetch_assoc()) {
                                            echo "<tr>";
                                            echo "<td>" . $row['id'] . "</td>";
                                            echo "<td>" . htmlspecialchars($row['name']) . "</td>";
                                            echo "<td>" . htmlspecialchars($row['email']) . "</td>";
                                            echo "<td class='action-buttons'>";
                                            echo "<button class='edit-btn' onclick='openEditModal(" . $row['id'] . ", \"" . htmlspecialchars($row['name']) . "\", \"" . htmlspecialchars($row['email']) . "\")'>Edit</button>";
                                            echo "<a href='?action=patients&delete_user=1&id=" . $row['id'] . "' class='delete-btn' onclick='return confirm(\"Are you sure you want to delete this patient?\")'>Delete</a>";
                                            echo "</td>";
                                            echo "</tr>";
                                        }
                                    } else {
                                        echo "<tr><td colspan='4'>No patients found</td></tr>";
                                    }
                                    ?>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>

                <!-- Edit Patient Modal -->
                <div id="editPatientModal" class="modal">
                    <div class="modal-content">
                        <span class="close" onclick="closeEditModal()">&times;</span>
                        <h2>Edit Patient</h2>
                        <form method="post" action="?action=patients">
                            <input type="hidden" id="edit_user_id" name="user_id">
                            <div class="form-group">
                                <label for="edit_name">Name</label>
                                <input type="text" id="edit_name" name="name" required>
                            </div>
                            <div class="form-group">
                                <label for="edit_email">Email</label>
                                <input type="email" id="edit_email" name="email" required>
                            </div>
                            <div class="form-group">
                                <label for="edit_password">Password (leave blank to keep current)</label>
                                <input type="password" id="edit_password" name="password">
                            </div>
                            <button type="submit" name="edit_patient">Update Patient</button>
                        </form>
                    </div>
                </div>

                <script>
                    // Get the modal
                    var modal = document.getElementById("editPatientModal");

                    // Function to open the edit modal and populate it with data
                    function openEditModal(id, name, email) {
                        document.getElementById("edit_user_id").value = id;
                        document.getElementById("edit_name").value = name;
                        document.getElementById("edit_email").value = email;
                        document.getElementById("edit_password").value = "";
                        modal.style.display = "block";
                    }

                    // Function to close the modal
                    function closeEditModal() {
                        modal.style.display = "none";
                    }

                    // Close the modal if user clicks outside of it
                    window.onclick = function(event) {
                        if (event.target == modal) {
                            closeEditModal();
                        }
                    }
                </script>
            <?php endif; ?>

            <!-- Doctors Management -->
            <?php if ($action == 'doctors'): ?>
                <div class="admin-section">
                    <div class="add-form">
                        <h2>Add New Doctor</h2>
                        <form method="post" action="?action=doctors">
                            <div class="form-group">
                                <label for="name">Name</label>
                                <input type="text" id="name" name="name" required>
                            </div>
                            <div class="form-group">
                                <label for="email">Email</label>
                                <input type="email" id="email" name="email" required>
                            </div>
                            <div class="form-group">
                                <label for="password">Password</label>
                                <input type="password" id="password" name="password" required>
                            </div>
                            <div class="form-group">
                                <label for="specialty">Specialty</label>
                                <select id="specialty" name="specialty" required>
                                    <option value="">Select Specialty</option>
                                    <option value="General Medicine">General Medicine</option>
                                    <option value="Cardiology">Cardiology</option>
                                    <option value="Dermatology">Dermatology</option>
                                    <option value="Orthopedics">Orthopedics</option>
                                    <option value="Pediatrics">Pediatrics</option>
                                    <option value="Neurology">Neurology</option>
                                    <option value="Psychiatry">Psychiatry</option>
                                    <option value="Ophthalmology">Ophthalmology</option>
                                </select>
                            </div>
                            <button type="submit" name="add_doctor">Add Doctor</button>
                        </form>
                    </div>

                    <div class="list-section">
                        <h2>Current Doctors</h2>
                        <div class="table-container">
                            <table>
                                <thead>
                                    <tr>
                                        <th>ID</th>
                                        <th>Name</th>
                                        <th>Email</th>
                                        <th>Specialty</th>
                                        <th>Actions</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                    $doctors = $conn->query("SELECT * FROM users WHERE role = 'doctor'");
                                    if ($doctors->num_rows > 0) {
                                        while ($row = $doctors->fetch_assoc()) {
                                            echo "<tr>";
                                            echo "<td>" . $row['id'] . "</td>";
                                            echo "<td>" . htmlspecialchars($row['name']) . "</td>";
                                            echo "<td>" . htmlspecialchars($row['email']) . "</td>";
                                            echo "<td>" . htmlspecialchars($row['specialty'] ?? 'Not specified') . "</td>";
                                            echo "<td class='action-buttons'>";
                                            echo "<button class='edit-btn' onclick='openDoctorEditModal(" . $row['id'] . ", \"" . htmlspecialchars($row['name']) . "\", \"" . htmlspecialchars($row['email']) . "\", \"" . htmlspecialchars($row['specialty'] ?? '') . "\")'>Edit</button>";
                                            echo "<a href='?action=doctors&delete_user=1&id=" . $row['id'] . "' class='delete-btn' onclick='return confirm(\"Are you sure you want to delete this doctor?\")'>Delete</a>";
                                            echo "</td>";
                                            echo "</tr>";
                                        }
                                    } else {
                                        echo "<tr><td colspan='5'>No doctors found</td></tr>";
                                    }
                                    ?>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>

                <!-- Edit Doctor Modal -->
                <div id="editDoctorModal" class="modal">
                    <div class="modal-content">
                        <span class="close" onclick="closeDoctorEditModal()">&times;</span>
                        <h2>Edit Doctor</h2>
                        <form method="post" action="?action=doctors">
                            <input type="hidden" id="edit_doctor_id" name="user_id">
                            <div class="form-group">
                                <label for="edit_doctor_name">Name</label>
                                <input type="text" id="edit_doctor_name" name="name" required>
                            </div>
                            <div class="form-group">
                                <label for="edit_doctor_email">Email</label>
                                <input type="email" id="edit_doctor_email" name="email" required>
                            </div>
                            <div class="form-group">
                                <label for="edit_doctor_specialty">Specialty</label>
                                <select id="edit_doctor_specialty" name="specialty" required>
                                    <option value="">Select Specialty</option>
                                    <option value="General Medicine">General Medicine</option>
                                    <option value="Cardiology">Cardiology</option>
                                    <option value="Dermatology">Dermatology</option>
                                    <option value="Orthopedics">Orthopedics</option>
                                    <option value="Pediatrics">Pediatrics</option>
                                    <option value="Neurology">Neurology</option>
                                    <option value="Psychiatry">Psychiatry</option>
                                    <option value="Ophthalmology">Ophthalmology</option>
                                </select>
                            </div>
                            <div class="form-group">
                                <label for="edit_doctor_password">Password (leave blank to keep current)</label>
                                <input type="password" id="edit_doctor_password" name="password">
                            </div>
                            <button type="submit" name="edit_doctor">Update Doctor</button>
                        </form>
                    </div>
                </div>

                <script>
                    // Get the doctor modal
                    var doctorModal = document.getElementById("editDoctorModal");

                    // Function to open the edit modal and populate it with data
                    function openDoctorEditModal(id, name, email, specialty) {
                        document.getElementById("edit_doctor_id").value = id;
                        document.getElementById("edit_doctor_name").value = name;
                        document.getElementById("edit_doctor_email").value = email;
                        document.getElementById("edit_doctor_specialty").value = specialty;
                        document.getElementById("edit_doctor_password").value = "";
                        doctorModal.style.display = "block";
                    }

                    // Function to close the modal
                    function closeDoctorEditModal() {
                        doctorModal.style.display = "none";
                    }

                    // Close the modal if user clicks outside of it
                    window.onclick = function(event) {
                        if (event.target == doctorModal) {
                            closeDoctorEditModal();
                        } else if (event.target == modal) {
                            closeEditModal();
                        } else if (event.target == appointmentModal) {
                            closeAppointmentEditModal();
                        }
                    }
                </script>
            <?php endif; ?>

            <!-- Appointments Management - UPDATED with Edit functionality -->
            <?php if ($action == 'appointments'): ?>
                <div class="admin-section">
                    <div class="list-section full-width">
                        <h2>All Appointments</h2>
                        <div class="table-container">
                            <table>
                                <thead>
                                    <tr>
                                        <th>ID</th>
                                        <th>Name</th>
                                        <th>Email</th>
                                        <th>Date</th>
                                        <th>Service</th>
                                        <th>Actions</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                    $appointments = $conn->query("SELECT * FROM booking ORDER BY date DESC");
                                    if ($appointments->num_rows > 0) {
                                        while ($row = $appointments->fetch_assoc()) {
                                            echo "<tr>";
                                            echo "<td>" . $row['id'] . "</td>";
                                            echo "<td>" . htmlspecialchars($row['name']) . "</td>";
                                            echo "<td>" . htmlspecialchars($row['email']) . "</td>";
                                            echo "<td>" . htmlspecialchars($row['date']) . "</td>";
                                            echo "<td>" . htmlspecialchars($row['service']) . "</td>";
                                            echo "<td class='action-buttons'>";
                                            echo "<button class='edit-btn' onclick='openAppointmentEditModal(" . $row['id'] . ", \"" . htmlspecialchars($row['name']) . "\", \"" . htmlspecialchars($row['email']) . "\", \"" . htmlspecialchars($row['date']) . "\", \"" . htmlspecialchars($row['service']) . "\")'>Edit</button>";
                                            echo "<a href='?action=appointments&delete_appointment=1&id=" . $row['id'] . "' class='delete-btn' onclick='return confirm(\"Are you sure you want to delete this appointment?\")'>Delete</a>";
                                            echo "</td>";
                                            echo "</tr>";
                                        }
                                    } else {
                                        echo "<tr><td colspan='6'>No appointments found</td></tr>";
                                    }
                                    ?>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>

                <!-- Edit Appointment Modal -->
                <div id="editAppointmentModal" class="modal">
                    <div class="modal-content">
                        <span class="close" onclick="closeAppointmentEditModal()">&times;</span>
                        <h2>Edit Appointment</h2>
                        <form method="post" action="?action=appointments">
                            <input type="hidden" id="edit_appointment_id" name="appointment_id">
                            <div class="form-group">
                                <label for="edit_appointment_name">Name</label>
                                <input type="text" id="edit_appointment_name" name="name" required>
                            </div>
                            <div class="form-group">
                                <label for="edit_appointment_email">Email</label>
                                <input type="email" id="edit_appointment_email" name="email" required>
                            </div>
                            <div class="form-group">
                                <label for="edit_appointment_date">Date</label>
                                <input type="date" id="edit_appointment_date" name="date" required>
                            </div>
                            <div class="form-group">
                                <label for="edit_appointment_service">Service</label>
                                <select id="edit_appointment_service" name="service" required>
                                    <option value="">Select Service</option>
                                    <option value="Regular Checkup">Regular Checkup</option>
                                    <option value="General Checkup">General Checkup</option>
                                    <option value="Dental Care">Dental Care</option>
                                    <option value="Eye Checkup">Eye Checkup</option>
                                    <option value="Cardiology">Cardiology</option>
                                    <option value="Orthopedics">Orthopedics</option>
                                    <option value="Neurology">Neurology</option>
                                    <option value="Dermatology">Dermatology</option>
                                    <option value="Pediatrics">Pediatrics</option>
                                </select>
                            </div>
                            <button type="submit" name="edit_appointment">Update Appointment</button>
                        </form>
                    </div>
                </div>

                <script>
                    // Get the appointment modal
                    var appointmentModal = document.getElementById("editAppointmentModal");

                    // Function to open the edit modal and populate it with data
                    function openAppointmentEditModal(id, name, email, date, service) {
                        document.getElementById("edit_appointment_id").value = id;
                        document.getElementById("edit_appointment_name").value = name;
                        document.getElementById("edit_appointment_email").value = email;
                        document.getElementById("edit_appointment_date").value = date;
                        document.getElementById("edit_appointment_service").value = service;
                        appointmentModal.style.display = "block";
                    }

                    // Function to close the modal
                    function closeAppointmentEditModal() {
                        appointmentModal.style.display = "none";
                    }

                    // Update the window.onclick function to include the appointment modal
                    window.onclick = function(event) {
                        if (event.target == appointmentModal) {
                            closeAppointmentEditModal();
                        } else if (event.target == doctorModal) {
                            closeDoctorEditModal();
                        } else if (event.target == modal) {
                            closeEditModal();
                        }
                    }
                </script>
            <?php endif; ?>
        </div>
    </div>
</body>
</html>