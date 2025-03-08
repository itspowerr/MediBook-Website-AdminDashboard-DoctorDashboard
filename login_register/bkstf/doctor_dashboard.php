<?php
session_start();
require_once 'config.php';

// Check if user is logged in and is a doctor
if (!isset($_SESSION['email']) || !isset($_SESSION['name'])) {
    header("Location: index.php");
    exit();
}

// Get doctor info
$email = $_SESSION['email'];
$result = $conn->query("SELECT * FROM users WHERE email = '$email' AND role = 'doctor'");
if ($result->num_rows == 0) {
    header("Location: index.php");
    exit();
}

$doctor = $result->fetch_assoc();

// Handle actions
$action = isset($_GET['action']) ? $_GET['action'] : 'dashboard';
$message = '';

// Update doctor profile
if (isset($_POST['update_profile'])) {
    $name = $_POST['name'];
    $email = $_POST['email'];
    $specialty = $_POST['specialty'];
    
    // Check if email exists for another user
    $checkEmail = $conn->query("SELECT email FROM users WHERE email = '$email' AND id != " . $doctor['id']);
    if ($checkEmail->num_rows > 0) {
        $message = '<div class="alert error">Email is already registered to another user!</div>';
    } else {
        // Update password only if provided
        if (!empty($_POST['password'])) {
            $password = password_hash($_POST['password'], PASSWORD_DEFAULT);
            $sql = "UPDATE users SET name = '$name', email = '$email', password = '$password', specialty = '$specialty' WHERE id = " . $doctor['id'];
        } else {
            $sql = "UPDATE users SET name = '$name', email = '$email', specialty = '$specialty' WHERE id = " . $doctor['id'];
        }
        
        if ($conn->query($sql) === TRUE) {
            $message = '<div class="alert success">Profile updated successfully!</div>';
            // Update session variables
            $_SESSION['name'] = $name;
            $_SESSION['email'] = $email;
            // Refresh doctor data
            $result = $conn->query("SELECT * FROM users WHERE id = " . $doctor['id']);
            $doctor = $result->fetch_assoc();
        } else {
            $message = '<div class="alert error">Error: ' . $conn->error . '</div>';
        }
    }
}

// Add medical note
if (isset($_POST['add_note'])) {
    $patient_id = $_POST['patient_id'];
    $note = $_POST['note'];
    $diagnosis = $_POST['diagnosis'];
    $prescription = $_POST['prescription'];
    
    // Check if medical_notes table exists, if not create it
    $conn->query("CREATE TABLE IF NOT EXISTS medical_notes (
        id INT(11) AUTO_INCREMENT PRIMARY KEY,
        patient_id INT(11) NOT NULL,
        doctor_id INT(11) NOT NULL,
        note TEXT NOT NULL,
        diagnosis VARCHAR(255) NOT NULL,
        prescription TEXT NOT NULL,
        created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
    )");
    
    $sql = "INSERT INTO medical_notes (patient_id, doctor_id, note, diagnosis, prescription) 
            VALUES ('$patient_id', '" . $doctor['id'] . "', '$note', '$diagnosis', '$prescription')";
    
    if ($conn->query($sql) === TRUE) {
        $message = '<div class="alert success">Medical note added successfully!</div>';
    } else {
        $message = '<div class="alert error">Error: ' . $conn->error . '</div>';
    }
}

// Update appointment status
if (isset($_POST['update_appointment'])) {
    $id = $_POST['appointment_id'];
    $status = $_POST['status'];
    $doctor_notes = $_POST['doctor_notes'];
    
    // Check if appointment_status column exists in booking table, if not add it
    $result = $conn->query("SHOW COLUMNS FROM booking LIKE 'status'");
    if ($result->num_rows == 0) {
        $conn->query("ALTER TABLE booking ADD COLUMN status VARCHAR(50) DEFAULT 'Scheduled'");
    }
    
    // Check if doctor_notes column exists in booking table, if not add it
    $result = $conn->query("SHOW COLUMNS FROM booking LIKE 'doctor_notes'");
    if ($result->num_rows == 0) {
        $conn->query("ALTER TABLE booking ADD COLUMN doctor_notes TEXT");
    }
    
    $sql = "UPDATE booking SET status = '$status', doctor_notes = '$doctor_notes' WHERE id = $id";
    if ($conn->query($sql) === TRUE) {
        $message = '<div class="alert success">Appointment updated successfully!</div>';
    } else {
        $message = '<div class="alert error">Error: ' . $conn->error . '</div>';
    }
}

// Get counts for dashboard
$myAppointmentsCount = $conn->query("SELECT COUNT(*) as count FROM booking WHERE service = '" . $doctor['specialty'] . "'")->fetch_assoc()['count'];
$todayAppointments = $conn->query("SELECT COUNT(*) as count FROM booking WHERE date = CURDATE() AND service = '" . $doctor['specialty'] . "'")->fetch_assoc()['count'];
$patientCount = $conn->query("SELECT COUNT(*) as count FROM users WHERE role = 'user' OR role = 'patient'")->fetch_assoc()['count'];
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>MediBook | Doctor Dashboard</title>
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Poppins:300,400,500,600,700">
    <link rel="stylesheet" href="css/doctor.css">
</head>
<body>
    <div class="doctor-container">
        <!-- Sidebar -->
        <div class="sidebar">
            <div class="sidebar-header">
                <h2>MediBook</h2>
                <p>Doctor Panel</p>
            </div>
            <div class="sidebar-menu">
                <a href="?action=dashboard" class="<?php echo $action == 'dashboard' ? 'active' : ''; ?>">
                    <span class="icon">📊</span> Dashboard
                </a>
                <a href="?action=appointments" class="<?php echo $action == 'appointments' ? 'active' : ''; ?>">
                    <span class="icon">📅</span> My Appointments
                </a>
                <a href="?action=patients" class="<?php echo $action == 'patients' ? 'active' : ''; ?>">
                    <span class="icon">🧑</span> Patient Records
                </a>
                <a href="?action=profile" class="<?php echo $action == 'profile' ? 'active' : ''; ?>">
                    <span class="icon">👨‍⚕️</span> My Profile
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
                        case 'appointments':
                            echo 'My Appointments';
                            break;
                        case 'patients':
                            echo 'Patient Records';
                            break;
                        case 'profile':
                            echo 'My Profile';
                            break;
                        default:
                            echo 'Dashboard Overview';
                    }
                    ?>
                </h1>
                <div class="user-info">
                    <span>Dr. <?php echo htmlspecialchars($doctor['name']); ?> | <?php echo htmlspecialchars($doctor['specialty']); ?></span>
                </div>
            </div>

            <?php echo $message; ?>

            <!-- Dashboard Content -->
            <?php if ($action == 'dashboard'): ?>
                <div class="dashboard-stats">
                    <div class="stat-card">
                        <div class="stat-value"><?php echo $myAppointmentsCount; ?></div>
                        <div class="stat-label">Total Appointments</div>
                    </div>
                    <div class="stat-card">
                        <div class="stat-value"><?php echo $todayAppointments; ?></div>
                        <div class="stat-label">Today's Appointments</div>
                    </div>
                    <div class="stat-card">
                        <div class="stat-value"><?php echo $patientCount; ?></div>
                        <div class="stat-label">Total Patients</div>
                    </div>
                </div>

                <div class="recent-section">
                    <h2>Today's Appointments</h2>
                    <div class="table-container">
                        <table>
                            <thead>
                                <tr>
                                    <th>Patient Name</th>
                                    <th>Email</th>
                                    <th>Time</th>
                                    <th>Status</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                $todayAppointments = $conn->query("SELECT * FROM booking WHERE date = CURDATE() AND service = '" . $doctor['specialty'] . "' ORDER BY id DESC");
                                if ($todayAppointments->num_rows > 0) {
                                    while ($row = $todayAppointments->fetch_assoc()) {
                                        echo "<tr>";
                                        echo "<td>" . htmlspecialchars($row['name']) . "</td>";
                                        echo "<td>" . htmlspecialchars($row['email']) . "</td>";
                                        echo "<td>" . htmlspecialchars($row['date']) . "</td>";
                                        echo "<td>" . htmlspecialchars($row['status'] ?? 'Scheduled') . "</td>";
                                        echo "</tr>";
                                    }
                                } else {
                                    echo "<tr><td colspan='4'>No appointments for today</td></tr>";
                                }
                                ?>
                            </tbody>
                        </table>
                    </div>
                </div>

                <div class="recent-section">
                    <h2>Recent Patient Records</h2>
                    <div class="table-container">
                        <table>
                            <thead>
                                <tr>
                                    <th>Patient Name</th>
                                    <th>Diagnosis</th>
                                    <th>Date</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                // Join medical_notes with users to get patient names
                                $recentNotes = $conn->query("
                                    SELECT n.*, u.name as patient_name 
                                    FROM medical_notes n 
                                    JOIN users u ON n.patient_id = u.id 
                                    WHERE n.doctor_id = " . $doctor['id'] . " 
                                    ORDER BY n.created_at DESC 
                                    LIMIT 5
                                ");
                                
                                if ($recentNotes && $recentNotes->num_rows > 0) {
                                    while ($row = $recentNotes->fetch_assoc()) {
                                        echo "<tr>";
                                        echo "<td>" . htmlspecialchars($row['patient_name']) . "</td>";
                                        echo "<td>" . htmlspecialchars($row['diagnosis']) . "</td>";
                                        echo "<td>" . date('Y-m-d', strtotime($row['created_at'])) . "</td>";
                                        echo "</tr>";
                                    }
                                } else {
                                    echo "<tr><td colspan='3'>No patient records found</td></tr>";
                                }
                                ?>
                            </tbody>
                        </table>
                    </div>
                </div>
            <?php endif; ?>

            <!-- Appointments Management -->
            <?php if ($action == 'appointments'): ?>
                <div class="doctor-section">
                    <div class="list-section full-width">
                        <h2>All Appointments</h2>
                        <div class="table-container">
                            <table>
                                <thead>
                                    <tr>
                                        <th>ID</th>
                                        <th>Patient Name</th>
                                        <th>Email</th>
                                        <th>Date</th>
                                        <th>Status</th>
                                        <th>Actions</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                    $appointments = $conn->query("SELECT * FROM booking WHERE service = '" . $doctor['specialty'] . "' ORDER BY date DESC");
                                    if ($appointments->num_rows > 0) {
                                        while ($row = $appointments->fetch_assoc()) {
                                            echo "<tr>";
                                            echo "<td>" . $row['id'] . "</td>";
                                            echo "<td>" . htmlspecialchars($row['name']) . "</td>";
                                            echo "<td>" . htmlspecialchars($row['email']) . "</td>";
                                            echo "<td>" . htmlspecialchars($row['date']) . "</td>";
                                            echo "<td>" . htmlspecialchars($row['status'] ?? 'Scheduled') . "</td>";
                                            echo "<td class='action-buttons'>";
                                            echo "<button class='edit-btn' onclick='openAppointmentModal(" . $row['id'] . ", \"" . htmlspecialchars($row['name']) . "\", \"" . htmlspecialchars($row['email']) . "\", \"" . htmlspecialchars($row['date']) . "\", \"" . htmlspecialchars($row['status'] ?? 'Scheduled') . "\", \"" . htmlspecialchars($row['doctor_notes'] ?? '') . "\")'>Update</button>";
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

                <!-- Update Appointment Modal -->
                <div id="appointmentModal" class="modal">
                    <div class="modal-content">
                        <span class="close" onclick="closeAppointmentModal()">&times;</span>
                        <h2>Update Appointment</h2>
                        <form method="post" action="?action=appointments">
                            <input type="hidden" id="appointment_id" name="appointment_id">
                            <div class="form-group">
                                <label for="patient_name">Patient Name</label>
                                <input type="text" id="patient_name" readonly>
                            </div>
                            <div class="form-group">
                                <label for="patient_email">Email</label>
                                <input type="email" id="patient_email" readonly>
                            </div>
                            <div class="form-group">
                                <label for="appointment_date">Date</label>
                                <input type="date" id="appointment_date" readonly>
                            </div>
                            <div class="form-group">
                                <label for="appointment_status">Status</label>
                                <select id="appointment_status" name="status" required>
                                    <option value="Scheduled">Scheduled</option>
                                    <option value="Completed">Completed</option>
                                    <option value="Cancelled">Cancelled</option>
                                    <option value="No-Show">No-Show</option>
                                </select>
                            </div>
                            <div class="form-group">
                                <label for="doctor_notes">Doctor Notes</label>
                                <textarea id="doctor_notes" name="doctor_notes" rows="4"></textarea>
                            </div>
                            <button type="submit" name="update_appointment">Update Appointment</button>
                        </form>
                    </div>
                </div>

                <script>
                    // Get the modal
                    var appointmentModal = document.getElementById("appointmentModal");

                    // Function to open the modal and populate it with data
                    function openAppointmentModal(id, name, email, date, status, notes) {
                        document.getElementById("appointment_id").value = id;
                        document.getElementById("patient_name").value = name;
                        document.getElementById("patient_email").value = email;
                        document.getElementById("appointment_date").value = date;
                        document.getElementById("appointment_status").value = status;
                        document.getElementById("doctor_notes").value = notes;
                        appointmentModal.style.display = "block";
                    }

                    // Function to close the modal
                    function closeAppointmentModal() {
                        appointmentModal.style.display = "none";
                    }

                    // Close the modal if user clicks outside of it
                    window.onclick = function(event) {
                        if (event.target == appointmentModal) {
                            closeAppointmentModal();
                        } else if (event.target == patientModal) {
                            closePatientModal();
                        }
                    }
                </script>
            <?php endif; ?>

            <!-- Patient Records -->
            <?php if ($action == 'patients'): ?>
                <div class="doctor-section">
                    <div class="list-section full-width">
                        <h2>Patient Records</h2>
                        <div class="table-container">
                            <table>
                                <thead>
                                    <tr>
                                        <th>ID</th>
                                        <th>Name</th>
                                        <th>Email</th>
                                        <th>Registration Date</th>
                                        <th>Actions</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                    $patients = $conn->query("SELECT * FROM users WHERE role = 'user' OR role = 'patient' ORDER BY id DESC");
                                    if ($patients->num_rows > 0) {
                                        while ($row = $patients->fetch_assoc()) {
                                            echo "<tr>";
                                            echo "<td>" . $row['id'] . "</td>";
                                            echo "<td>" . htmlspecialchars($row['name']) . "</td>";
                                            echo "<td>" . htmlspecialchars($row['email']) . "</td>";
                                            echo "<td>" . (isset($row['created_at']) ? date('Y-m-d', strtotime($row['created_at'])) : 'N/A') . "</td>";
                                            echo "<td class='action-buttons'>";
                                            echo "<button class='edit-btn' onclick='openPatientModal(" . $row['id'] . ", \"" . htmlspecialchars($row['name']) . "\")'>Add Note</button>";
                                            echo "<button class='view-btn' onclick='viewPatientHistory(" . $row['id'] . ", \"" . htmlspecialchars($row['name']) . "\")'>View History</button>";
                                            echo "</td>";
                                            echo "</tr>";
                                        }
                                    } else {
                                        echo "<tr><td colspan='5'>No patients found</td></tr>";
                                    }
                                    ?>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>

                <!-- Add Medical Note Modal -->
                <div id="patientModal" class="modal">
                    <div class="modal-content">
                        <span class="close" onclick="closePatientModal()">&times;</span>
                        <h2>Add Medical Note</h2>
                        <form method="post" action="?action=patients">
                            <input type="hidden" id="patient_id" name="patient_id">
                            <div class="form-group">
                                <label for="patient_name_display">Patient Name</label>
                                <input type="text" id="patient_name_display" readonly>
                            </div>
                            <div class="form-group">
                                <label for="diagnosis">Diagnosis</label>
                                <input type="text" id="diagnosis" name="diagnosis" required>
                            </div>
                            <div class="form-group">
                                <label for="note">Medical Notes</label>
                                <textarea id="note" name="note" rows="4" required></textarea>
                            </div>
                            <div class="form-group">
                                <label for="prescription">Prescription</label>
                                <textarea id="prescription" name="prescription" rows="4" required></textarea>
                            </div>
                            <button type="submit" name="add_note">Save Medical Note</button>
                        </form>
                    </div>
                </div>

                <!-- Patient History Modal -->
                <div id="historyModal" class="modal">
                    <div class="modal-content">
                        <span class="close" onclick="closeHistoryModal()">&times;</span>
                        <h2>Patient Medical History</h2>
                        <div id="patient_history_content">
                            Loading...
                        </div>
                    </div>
                </div>

                <script>
                    // Get the modals
                    var patientModal = document.getElementById("patientModal");
                    var historyModal = document.getElementById("historyModal");

                    // Function to open the patient modal
                    function openPatientModal(id, name) {
                        document.getElementById("patient_id").value = id;
                        document.getElementById("patient_name_display").value = name;
                        document.getElementById("diagnosis").value = "";
                        document.getElementById("note").value = "";
                        document.getElementById("prescription").value = "";
                        patientModal.style.display = "block";
                    }

                    // Function to close the patient modal
                    function closePatientModal() {
                        patientModal.style.display = "none";
                    }

                    // Function to view patient history
                    function viewPatientHistory(id, name) {
                        historyModal.style.display = "block";
                        document.getElementById("patient_history_content").innerHTML = "Loading medical history for " + name + "...";
                        
                        // Use AJAX to fetch patient history
                        var xhr = new XMLHttpRequest();
                        xhr.open("GET", "get_patient_history.php?patient_id=" + id, true);
                        xhr.onreadystatechange = function() {
                            if (xhr.readyState === 4 && xhr.status === 200) {
                                document.getElementById("patient_history_content").innerHTML = xhr.responseText;
                            }
                        };
                        xhr.send();
                    }

                    // Function to close the history modal
                    function closeHistoryModal() {
                        historyModal.style.display = "none";
                    }

                    // Close the modals if user clicks outside of them
                    window.onclick = function(event) {
                        if (event.target == patientModal) {
                            closePatientModal();
                        } else if (event.target == historyModal) {
                            closeHistoryModal();
                        } else if (event.target == appointmentModal) {
                            closeAppointmentModal();
                        }
                    }
                </script>
            <?php endif; ?>

            <!-- Doctor Profile -->
            <?php if ($action == 'profile'): ?>
                <div class="doctor-section">
                    <div class="add-form full-width">
                        <h2>Update Your Profile</h2>
                        <form method="post" action="?action=profile">
                            <div class="form-group">
                                <label for="name">Name</label>
                                <input type="text" id="name" name="name" value="<?php echo htmlspecialchars($doctor['name']); ?>" required>
                            </div>
                            <div class="form-group">
                                <label for="email">Email</label>
                                <input type="email" id="email" name="email" value="<?php echo htmlspecialchars($doctor['email']); ?>" required>
                            </div>
                            <div class="form-group">
                                <label for="specialty">Specialty</label>
                                <select id="specialty" name="specialty" required>
                                    <option value="">Select Specialty</option>
                                    <option value="General Medicine" <?php echo $doctor['specialty'] == 'General Medicine' ? 'selected' : ''; ?>>General Medicine</option>
                                    <option value="Cardiology" <?php echo $doctor['specialty'] == 'Cardiology' ? 'selected' : ''; ?>>Cardiology</option>
                                    <option value="Dermatology" <?php echo $doctor['specialty'] == 'Dermatology' ? 'selected' : ''; ?>>Dermatology</option>
                                    <option value="Orthopedics" <?php echo $doctor['specialty'] == 'Orthopedics' ? 'selected' : ''; ?>>Orthopedics</option>
                                    <option value="Pediatrics" <?php echo $doctor['specialty'] == 'Pediatrics' ? 'selected' : ''; ?>>Pediatrics</option>
                                    <option value="Neurology" <?php echo $doctor['specialty'] == 'Neurology' ? 'selected' : ''; ?>>Neurology</option>
                                    <option value="Psychiatry" <?php echo $doctor['specialty'] == 'Psychiatry' ? 'selected' : ''; ?>>Psychiatry</option>
                                    <option value="Ophthalmology" <?php echo $doctor['specialty'] == 'Ophthalmology' ? 'selected' : ''; ?>>Ophthalmology</option>
                                </select>
                            </div>
                            <div class="form-group">
                                <label for="password">Password (leave blank to keep current)</label>
                                <input type="password" id="password" name="password">
                            </div>
                            <button type="submit" name="update_profile">Update Profile</button>
                        </form>
                    </div>
                </div>
            <?php endif; ?>
        </div>
    </div>
</body>
</html>