<?php
session_start();
if (!isset($_SESSION['user_id'])) {
    header('Location: index.php');
    exit;
}
?>
<!DOCTYPE html>
<html lang="th">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>คู่มือการใช้งาน</title>
    <link href="https://fonts.googleapis.com/css2?family=Prompt&display=swap" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css" rel="stylesheet">

    <style>
    body {
        margin: 0;
    }

    .container {
        background-color: #ffffff;
        border-top-left-radius: 30px;
        border-top-right-radius: 30px;
        margin-top: -50px;
        padding: 70px;
        text-align: center;
    }

    .header-image {
        width: 100%;
        max-width: 500px;
        display: block;
        margin: 0 auto;
        border-bottom: none;
    }

    h1 {
        font-size: 45px;
        color: #333;
        margin-bottom: 10px;
        font-weight: 500;
    }

    ol {
        text-align: left;
        font-size: 18px;
        color: #444;
        padding-left: 20px;
        margin-bottom: 0px;
    }

    li {
        margin-bottom: 5px;
    }

    .support {
        display: flex;
        justify-content: space-between;
        align-items: flex-start;
        gap: 20px;
        text-align: left;
    }

    .support-left {
        display: flex;
        align-items: center;
        gap: 15px;
    }

    .icon-circle {
        background-color: #02a69f;
        border-radius: 50%;
        color: white;
        display: flex;
        align-items: center;
        justify-content: center;
        min-width: 40px;
        height: 40px;
    }

    .icon-circle i {
        font-size: 20px;
    }

    .support-text {
        font-size: 16px;
        color: #1e88e5;
        line-height: 1.3;
    }


    .qr-code {
        width: 140px;
        height: auto;
        margin: 0 auto 15px;
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

    .fa-phone {
        padding: 10px;
        background-color: #02a69f;
        color: white;
        border-radius: 30px;
    }
    </style>
</head>

<body>

    <img src="img/Usermanual.jpg" alt="คู่มือการใช้งาน" class="header-image">

    <div class="container">
        <button class="button" onclick="location.href='menu.php'">กลับสู่เมนูหลัก</button>

    </div>

</body>

</html>