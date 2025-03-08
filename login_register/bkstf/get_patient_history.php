<?php
session_start();
require_once 'config.php';

// Check if user is logged in and is a doctor
if (!isset($_SESSION['email']) || !isset($_SESSION['name'])) {
    echo "Unauthorized access";
    exit();
}

// Get doctor info
$email = $_SESSION['email'];
$result = $conn->query("SELECT * FROM users WHERE email = '$email' AND role = 'doctor'");
if ($result->num_rows == 0) {
    echo "Unauthorized access";
    exit();
}

$doctor = $result->fetch_assoc();

// Check if patient_id is provided
if (!isset($_GET['patient_id'])) {
    echo "Patient ID is required";
    exit();
}

$patient_id = $_GET['patient_id'];

// Get patient info
$patientResult = $conn->query("SELECT * FROM users WHERE id = $patient_id");
if ($patientResult->num_rows == 0) {
    echo "Patient not found";
    exit();
}

$patient = $patientResult->fetch_assoc();

// Get medical notes for this patient
$notesResult = $conn->query("
    SELECT n.*, u.name as doctor_name, u.specialty 
    FROM medical_notes n 
    JOIN users u ON n.doctor_id = u.id 
    WHERE n.patient_id = $patient_id 
    ORDER BY n.created_at DESC
");

// Get appointments for this patient
$appointmentsResult = $conn->query("
    SELECT * FROM booking 
    WHERE email = '" . $patient['email'] . "' 
    ORDER BY date DESC
");
?>

<div class="patient-history">
    <div class="patient-info">
        <h3>Patient Information</h3>
        <p><strong>Name:</strong> <?php echo htmlspecialchars($patient['name']); ?></p>
        <p><strong>Email:</strong> <?php echo htmlspecialchars($patient['email']); ?></p>
        <p><strong>Registered:</strong> <?php echo isset($patient['created_at']) ? date('Y-m-d', strtotime($patient['created_at'])) : 'N/A'; ?></p>
    </div>

    <div class="medical-notes">
        <h3>Medical Notes</h3>
        <?php if ($notesResult && $notesResult->num_rows > 0): ?>
            <table>
                <thead>
                    <tr>
                        <th>Date</th>
                        <th>Doctor</th>
                        <th>Diagnosis</th>
                        <th>Notes</th>
                        <th>Prescription</th>
                    </tr>
                </thead>
                <tbody>
                    <?php while ($note = $notesResult->fetch_assoc()): ?>
                        <tr>
                            <td><?php echo date('Y-m-d', strtotime($note['created_at'])); ?></td>
                            <td><?php echo htmlspecialchars($note['doctor_name']) . ' (' . htmlspecialchars($note['specialty']) . ')'; ?></td>
                            <td><?php echo htmlspecialchars($note['diagnosis']); ?></td>
                            <td><?php echo htmlspecialchars($note['note']); ?></td>
                            <td><?php echo htmlspecialchars($note['prescription']); ?></td>
                        </tr>
                    <?php endwhile; ?>
                </tbody>
            </table>
        <?php else: ?>
            <p>No medical notes found for this patient.</p>
        <?php endif; ?>
    </div>

    <div class="appointment-history">
        <h3>Appointment History</h3>
        <?php if ($appointmentsResult && $appointmentsResult->num_rows > 0): ?>
            <table>
                <thead>
                    <tr>
                        <th>Date</th>
                        <th>Service</th>
                        <th>Status</th>
                        <th>Doctor Notes</th>
                    </tr>
                </thead>
                <tbody>
                    <?php while ($appointment = $appointmentsResult->fetch_assoc()): ?>
                        <tr>
                            <td><?php echo htmlspecialchars($appointment['date']); ?></td>
                            <td><?php echo htmlspecialchars($appointment['service']); ?></td>
                            <td><?php echo htmlspecialchars($appointment['status'] ?? 'Scheduled'); ?></td>
                            <td><?php echo htmlspecialchars($appointment['doctor_notes'] ?? 'No notes'); ?></td>
                        </tr>
                    <?php endwhile; ?>
                </tbody>
            </table>
        <?php else: ?>
            <p>No appointment history found for this patient.</p>
        <?php endif; ?>
    </div>
</div>

<style>
    .patient-history {
        font-family: 'Poppins', sans-serif;
    }
    
    .patient-info, .medical-notes, .appointment-history {
        margin-bottom: 20px;
    }
    
    h3 {
        color: #2c3e50;
        margin-bottom: 10px;
        padding-bottom: 5px;
        border-bottom: 1px solid #e0e0e0;
    }
    
    table {
        width: 100%;
        border-collapse: collapse;
        margin-top: 10px;
    }
    
    table th, table td {
        padding: 8px 10px;
        text-align: left;
        border-bottom: 1px solid #e0e0e0;
    }
    
    table th {
        background-color: #f8f9fa;
        font-weight: 600;
        color: #2c3e50;
    }
</style>