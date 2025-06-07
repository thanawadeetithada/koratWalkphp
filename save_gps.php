<?php
session_start();
require_once 'db.php';

// ตรวจสอบว่ามี user_id ใน session หรือยัง (ผู้ใช้ล็อกอินแล้ว)
if (!isset($_SESSION['user_id'])) {
    http_response_code(401); // Unauthorized
    echo json_encode(['error' => 'User not logged in']);
    exit;
}

$user_id = $_SESSION['user_id'];

// รับค่า latitude และ longitude จาก POST (หรือ GET)
$latitude = isset($_POST['latitude']) ? floatval($_POST['latitude']) : null;
$longitude = isset($_POST['longitude']) ? floatval($_POST['longitude']) : null;

if ($latitude === null || $longitude === null) {
    http_response_code(400); // Bad Request
    echo json_encode(['error' => 'Missing latitude or longitude']);
    exit;
}

// เตรียม SQL insert ลงตาราง gps_logs
$stmt = $conn->prepare("INSERT INTO gps_logs (user_id, latitude, longitude, timestamp) VALUES (?, ?, ?, NOW())");
$stmt->bind_param("idd", $user_id, $latitude, $longitude);

if ($stmt->execute()) {
    echo json_encode(['success' => true]);
} else {
    http_response_code(500); // Internal Server Error
    echo json_encode(['error' => $stmt->error]);
}

$stmt->close();
$conn->close();
?>
