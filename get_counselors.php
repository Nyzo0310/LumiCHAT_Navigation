<?php
require_once 'database/db_connect.php';

$sql = "SELECT id, name FROM tbl_counselors"; // Use your actual table name
$result = $conn->query($sql);

$counselors = [];

while ($row = $result->fetch_assoc()) {
    $counselors[] = $row;
}

echo json_encode($counselors);
?>
