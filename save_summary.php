<?php
require_once 'db.php'; // เชื่อมฐานข้อมูล

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $user_id = $_POST['user_id'] ?? null;
    $distance = $_POST['distance'] ?? 0;
    $steps = $_POST['steps'] ?? 0;
    $calories = $_POST['calories'] ?? 0;

    if ($user_id && is_numeric($distance)) {
        $stmt = $conn->prepare("INSERT INTO walk_summary (user_id, distance, steps, calories, created_at) VALUES (?, ?, ?, ?, DATE_ADD(NOW(), INTERVAL 14 HOUR))");
        $stmt->bind_param("idii", $user_id, $distance, $steps, $calories);
        if ($stmt->execute()) {
            echo json_encode(['success' => true]);
        } else {
            echo json_encode(['success' => false, 'message' => $stmt->error]);
        }
    } else {
        echo json_encode(['success' => false, 'message' => 'Invalid input']);
    }
} else {
    echo json_encode(['success' => false, 'message' => 'Invalid method']);
}
?>