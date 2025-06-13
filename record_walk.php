<?php
session_start();
require_once 'db.php';

if (!isset($_SESSION['user_id'])) {
    header('Location: index.php');
    exit;
}

$user_id = $_SESSION['user_id'] ?? 0;
$data = [];

if ($user_id) {
    $stmt = $conn->prepare("SELECT distance, steps, calories, created_at FROM walk_summary WHERE user_id = ? ORDER BY created_at DESC");
    $stmt->bind_param("i", $user_id);
    $stmt->execute();
    $result = $stmt->get_result();

    while ($row = $result->fetch_assoc()) {
        $data[] = $row;
    }
}
?>

<!DOCTYPE html>
<html lang="th">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>บันทึกการเดิน</title>
    <link href="https://fonts.googleapis.com/css2?family=Prompt&display=swap" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css" rel="stylesheet">

    <style>
    * {
        margin: 0;
        padding: 0;
        box-sizing: border-box;
    }

    body {
        background-color: #a8dde1;
        display: flex;
        flex-direction: column;
        align-items: center;
        padding: 20px;
    }

    .fa-bell {
        padding: 20px;
        background-color: red;
        color: white;
        border-radius: 30px;
        font-size: 25px;
    }

    .icon-bell {
        position: absolute;
        top: 20px;
        right: 20px;
    }

    h1 {
        font-size: 35px;
        font-weight: bold;
        margin-top: 70px;
        margin-bottom: 20px;
        color: #000;
    }

    .card {
        background-color: white;
        border-radius: 20px;
        width: 100%;
        max-width: 400px;
        padding: 20px;
        margin-bottom: 20px;
        box-shadow: 0 2px 8px rgba(0, 0, 0, 0.1);
    }

    .row {
        display: flex;
        justify-content: space-between;
        margin-bottom: 8px;
    }

    .label {
        font-weight: bold;
        color: #333;
        font-size: 20px;
    }

    .button {
        background-color: #5371cb;
        color: white;
        font-weight: bold;
        font-size: 25px;
        padding: 20px 30px;
        width: auto;
        border: none;
        border-radius: 40px;
        cursor: pointer;
        display: block;
        margin: 0 auto;
    }

    .button:hover {
        background-color: #3a54c0;
    }
    </style>
</head>

<body>
    <div class="icon-bell">
        <a href="tel:1669" style="text-decoration: none;">
            <i class="fa-solid fa-bell"></i>
        </a>
    </div>

    <h1>บันทึกการเดินของฉัน</h1>
    <?php if (empty($data)): ?>
    <h2>ยังไม่มีข้อมูลการเดิน</h2>
    <br>
    <?php else: ?>
    <?php foreach ($data as $row): ?>
    <div class="card">
        <div class="row"><span class="label">วันที่</span> <span
                class="label"><?= date("d/m/Y H:i", strtotime($row['created_at'])) ?></span></div>
        <div class="row"><span class="label">ระยะทาง</span> <span class="label"><?= round($row['distance'], 2) ?>
                เมตร</span></div>
        <div class="row"><span class="label">จำนวนการเดิน</span> <span class="label"><?= $row['steps'] ?> ก้าว</span>
        </div>
        <div class="row"><span class="label">แคลอรี่ที่เผาผลาญ</span> <span class="label"><?= $row['calories'] ?>
                แคลอรี่</span></div>
    </div>
    <?php endforeach; ?>
    <?php endif; ?>
    <button class="button" onclick="location.href='menu.php'">กลับสู่เมนูหลัก</button>
</body>

</html>