<?php
session_start();

if (isset($_SESSION['user_id']) && !empty($_SESSION['user_id'])) {
    // มี user_id แปลว่ายังล็อกอินอยู่
    header('Location: menu.php');
    exit;
}
?>
<!DOCTYPE html>
<html lang="th">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>KoratWalk</title>
    <!-- Manifest for Add to Home Screen -->
   <link rel="manifest" href="/manifest.json">

    <link rel="icon" href="/img/Home.jpg" sizes="192x192">
    <link rel="icon" href="/img/Home.jpg" sizes="512x512">

    <!-- สำหรับ iOS -->
    <link rel="apple-touch-icon" href="/img/Home.jpg" sizes="180x180">
    <meta name="apple-mobile-web-app-title" content="koratWalk">
    <meta name="apple-mobile-web-app-status-bar-style" content="black-translucent">
    <meta name="theme-color" content="#5371cb">

    <link href="https://fonts.googleapis.com/css2?family=Prompt&display=swap" rel="stylesheet">
    <style>
    * {
        box-sizing: border-box;
        margin: 0;
        padding: 0;
    }

    body {
        background-color: white;
        display: flex;
        flex-direction: column;
        align-items: center;
        justify-content: center;
        min-height: 100vh;
        padding: 20px;
    }

    .screen {
        max-width: 400px;
        width: 100%;
        background-color: white;
        border-radius: 20px;
        margin-bottom: 30px;
    }

    .screen img {
        width: 100%;
        max-width: 500px;
        margin: 0 auto 20px;
        display: block;
    }

    .btn {
        width: fit-content;
        padding: .5rem 2rem;
        border: none;
        border-radius: 30px;
        background-color: #5371cb;
        color: white;
        font-size: 30px;
        cursor: pointer;
    }

    .btn:hover {
        background-color: #5371cb;
    }
    </style>
</head>

<body>
    <div class="screen">
        <img src="img/Home.jpg" alt="elderly">
        <form action="login.php" style="text-align: center;">
            <button class="btn">เริ่ม</button>
        </form>
    </div>
    <script>
    if ('serviceWorker' in navigator) {
        navigator.serviceWorker.register('sw.js')
            .then(() => console.log("Service Worker registered"))
            .catch(err => console.error("SW registration failed:", err));
    }
    </script>

</body>

</html>