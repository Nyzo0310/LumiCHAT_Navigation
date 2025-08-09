<?php
header('Content-Type: application/json');

// TEMP: show PHP errors while debugging (remove later)
error_reporting(E_ALL);
ini_set('display_errors', 1);

require_once __DIR__ . '/database/db_connect.php';

// 1) Validate input
if (!isset($_POST['id']) || !ctype_digit($_POST['id'])) {
  echo json_encode(['success' => false, 'message' => 'Invalid appointment ID.']);
  exit;
}
$appointmentId = (int)$_POST['id'];

// TODO: when you have login, use the real student from session
$student_name = 'Juan Dela Cruz';

// 2) Delete (change column name if your PK is different)
$sql  = "DELETE FROM tbl_appointment WHERE id = ? AND student_name = ?";
$stmt = $conn->prepare($sql);
if (!$stmt) {
  echo json_encode(['success' => false, 'message' => 'Prepare failed: '.$conn->error]);
  exit;
}
$stmt->bind_param("is", $appointmentId, $student_name);

if (!$stmt->execute()) {
  echo json_encode(['success' => false, 'message' => 'Execute failed: '.$stmt->error]);
  exit;
}

if ($stmt->affected_rows === 0) {
  echo json_encode([
    'success' => false,
    'message' => 'No matching record found. (Wrong ID/owner or already deleted.)'
  ]);
  exit;
}

echo json_encode(['success' => true]);
