<?php
session_start();
require_once 'db.php';

$username = $_POST['username'] ?? '';
$otp = $_POST['otp'] ?? '';

if (!$username || !$otp) {
    echo "กรุณากรอกชื่อผู้ใช้งานและรหัส OTP";
    exit;
}

$stmt = $conn->prepare("SELECT id, username, firstname, lastname, phone, otp FROM users WHERE username = ?");
$stmt->bind_param("s", $username);
$stmt->execute();
$result = $stmt->get_result();

if ($user = $result->fetch_assoc()) {
    if ($otp === $user['otp']) {
        $_SESSION['user_id'] = $user['id'];
        $_SESSION['username'] = $user['username'];
        $_SESSION['firstname'] = $user['firstname'];
        $_SESSION['lastname'] = $user['lastname'];
        $_SESSION['phone'] = $user['phone'];
        header("Location: menu.php");
        exit;
    } else {
        echo "รหัส OTP ไม่ถูกต้อง";
    }
} else {
    echo "ไม่พบชื่อผู้ใช้นี้ในระบบ";
}
?>
