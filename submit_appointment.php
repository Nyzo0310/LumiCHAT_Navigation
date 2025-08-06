<?php
require_once 'database/db_connect.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $counselor_id = $_POST['counselor_id'];
    $appointment_date = $_POST['appointment_date'];
    $appointment_time = $_POST['appointment_time'];

    // TEMP STATIC student name for demo
    $student_name = 'Juan Dela Cruz'; // ✅ you can change this to session later

    // Get counselor name using counselor_id
    $stmt = $conn->prepare("SELECT name FROM tbl_counselors WHERE id = ?");
    $stmt->bind_param("i", $counselor_id);
    $stmt->execute();
    $result = $stmt->get_result();
    $row = $result->fetch_assoc();
    $counselor_name = $row['name'];
    $stmt->close();

    // Insert to tbl_appointment
    $stmt = $conn->prepare("INSERT INTO tbl_appointment (student_name, counselor_name, preferred_date, preferred_time, consent, created_at) VALUES (?, ?, ?, ?, ?, NOW())");
    $consent = 1; // default to agreed
    $stmt->bind_param("ssssi", $student_name, $counselor_name, $appointment_date, $appointment_time, $consent);

    if ($stmt->execute()) {
        echo "<script>alert('Appointment successfully booked!'); window.location.href='student_appointment.html';</script>";
    } else {
        echo "Error: " . $stmt->error;
    }

    $stmt->close();
    $conn->close();
}
?>
