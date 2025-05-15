<?php
require 'db.php';

if (!isset($_POST['lat'], $_POST['lon'])) {
    echo json_encode(['success' => false, 'message' => 'Missing coordinates']);
    exit;
}

$lat = floatval($_POST['lat']);
$lon = floatval($_POST['lon']);
$user_id = $_SESSION['user_id'] ?? null;

$stmt = $conn->prepare("INSERT INTO gps_logs (user_id, latitude, longitude, timestamp) VALUES (?, ?, ?, NOW())");

if ($stmt) {
    $stmt->bind_param("idd", $user_id, $lat, $lon);
    $stmt->execute();
    $stmt->close();
    echo json_encode(['success' => true]);
} else {
    echo json_encode(['success' => false, 'message' => 'DB Error: ' . $conn->error]);
}
