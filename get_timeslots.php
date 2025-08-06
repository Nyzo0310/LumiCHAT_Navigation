<?php
require_once 'database/db_connect.php';

if (isset($_GET['counselor_id'])) {
    $counselorId = intval($_GET['counselor_id']);

    $stmt = $conn->prepare("SELECT time_slot FROM tbl_time_slots WHERE counselor_id = ?");
    $stmt->bind_param("i", $counselorId);
    $stmt->execute();
    $result = $stmt->get_result();

    $slots = [];
    while ($row = $result->fetch_assoc()) {
        $slots[] = $row;
    }

    echo json_encode($slots);
}
?>
