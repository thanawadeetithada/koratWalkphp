<?php
require_once 'db.php';
session_start(); // อย่าลืมเริ่ม session

$firstname = $_POST['firstname'] ?? '';
$lastname = $_POST['lastname'] ?? '';
$weight = $_POST['weight'] ?? '';

if (!empty($firstname) && !empty($lastname) && !empty($weight)) {
    // ตรวจสอบว่ามีผู้ใช้ที่มีชื่อเดียวกันอยู่แล้วหรือไม่
    $stmt = $conn->prepare("SELECT id FROM users WHERE firstname = ? AND lastname = ? AND weight = ?");
    $stmt->bind_param("ssd", $firstname, $lastname, $weight);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($row = $result->fetch_assoc()) {
        // ถ้ามีผู้ใช้เดิมในฐานข้อมูล
        $_SESSION['user_id'] = $row['id'];
        $_SESSION['firstname'] = $firstname;
        $_SESSION['lastname'] = $lastname;
        $_SESSION['weight'] = $weight;

        header("Location: menu.php");
        exit();
    }
    $stmt->close();

    // ถ้าไม่พบข้อมูลเดิม ให้เพิ่มข้อมูลใหม่
    $stmt = $conn->prepare("INSERT INTO users (firstname, lastname, weight) VALUES (?, ?, ?)");
    $stmt->bind_param("ssd", $firstname, $lastname, $weight);

    if ($stmt->execute()) {
        $_SESSION['user_id'] = $conn->insert_id;
        $_SESSION['firstname'] = $firstname;
        $_SESSION['lastname'] = $lastname;
        $_SESSION['weight'] = $weight;

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
