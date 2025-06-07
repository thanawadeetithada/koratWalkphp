<?php
require_once 'db.php';

$firstname = $_POST['firstname'] ?? '';
$lastname = $_POST['lastname'] ?? '';
$weight = $_POST['weight'] ?? '';

if (!empty($firstname) && !empty($lastname) && !empty($weight)) {
    // ป้องกัน SQL Injection
    $stmt = $conn->prepare("INSERT INTO users (firstname, lastname, weight) VALUES (?, ?, ?)");
    // firstname, lastname เป็น string (s), weight เป็น float (d)
    $stmt->bind_param("ssd", $firstname, $lastname, $weight);

    if ($stmt->execute()) {
        // เก็บ user_id ลง session เพื่อใช้กับ gps_logs
        $_SESSION['user_id'] = $conn->insert_id;
        $_SESSION['firstname'] = $firstname;
        $_SESSION['lastname'] = $lastname;

        header("Location: menu.php");
        exit();
    } else {
        echo "เกิดข้อผิดพลาดในการเพิ่มข้อมูล: " . $stmt->error;
    }

    $stmt->close();
} else {
    echo "กรุณากรอกข้อมูลให้ครบถ้วน";
}
?>
