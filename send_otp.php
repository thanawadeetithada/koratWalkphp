<?php
require 'db.php';
header('Content-Type: application/json');

if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    echo json_encode(['success' => false, 'message' => 'Request ไม่ถูกต้อง']);
    exit;
}

$data = json_decode(file_get_contents("php://input"), true);

$username = $data['username'] ?? '';
$firstname = $data['firstname'] ?? '';
$lastname = $data['lastname'] ?? '';
$phone = $data['phone'] ?? '';

if (!$username || !$firstname || !$lastname || !$phone) {
    echo json_encode(['success' => false, 'message' => 'กรุณากรอกข้อมูลให้ครบ']);
    exit;
}

$isUsernameDuplicate = false;
$isPhoneDuplicate = false;

$stmtUser = $conn->prepare("SELECT id FROM users WHERE username = ?");
$stmtUser->bind_param("s", $username);
$stmtUser->execute();
$stmtUser->store_result();
if ($stmtUser->num_rows > 0) {
    $isUsernameDuplicate = true;
}
$stmtUser->close();

$stmtPhone = $conn->prepare("SELECT id FROM users WHERE phone = ?");
$stmtPhone->bind_param("s", $phone);
$stmtPhone->execute();
$stmtPhone->store_result();
if ($stmtPhone->num_rows > 0) {
    $isPhoneDuplicate = true;
}
$stmtPhone->close();

if ($isUsernameDuplicate && $isPhoneDuplicate) {
    echo json_encode(['success' => false, 'message' => 'ชื่อผู้ใช้งานและเบอร์โทรศัพท์ถูกใช้แล้ว']);
    exit;
} elseif ($isUsernameDuplicate) {
    echo json_encode(['success' => false, 'message' => 'ชื่อผู้ใช้งานนี้ถูกใช้แล้ว']);
    exit;
} elseif ($isPhoneDuplicate) {
    echo json_encode(['success' => false, 'message' => 'เบอร์โทรศัพท์นี้ถูกใช้แล้ว']);
    exit;
}

$otp = str_pad(rand(0, 9999), 4, '0', STR_PAD_LEFT);
$otp_created_at = date('Y-m-d H:i:s');

$stmtCheck = $conn->prepare("SELECT id FROM users WHERE phone = ?");
$stmtCheck->bind_param("s", $phone);
$stmtCheck->execute();
$stmtCheck->store_result();

if ($stmtCheck->num_rows > 0) {
    $stmt = $conn->prepare("UPDATE users SET username=?, firstname=?, lastname=?, otp=?, otp_created_at=? WHERE phone=?");
    $stmt->bind_param("ssssss", $username, $firstname, $lastname, $otp, $otp_created_at, $phone);
} else {
    $stmt = $conn->prepare("INSERT INTO users (username, firstname, lastname, phone, otp, otp_created_at) VALUES (?, ?, ?, ?, ?, ?)");
    $stmt->bind_param("ssssss", $username, $firstname, $lastname, $phone, $otp, $otp_created_at);
}

if ($stmt->execute()) {
    echo json_encode(['success' => true, 'otp' => $otp]);
} else {
    echo json_encode(['success' => false, 'message' => 'บันทึกข้อมูลล้มเหลว']);
}

$stmt->close();
$stmtCheck->close();
$conn->close();
?>
