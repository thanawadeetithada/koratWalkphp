<!DOCTYPE html>
<html lang="th">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>เส้นทาง</title>
    <link href="https://fonts.googleapis.com/css2?family=Prompt&display=swap" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css" rel="stylesheet">

    <style>
    * {
        margin: 0;
        padding: 0;
        box-sizing: border-box;
    }

    html,
    body {
        height: 100%;
    }

    body {
        display: flex;
        flex-direction: column;
    }

    .screen {
        flex: 1;
        display: flex;
        flex-direction: column;
        align-items: center;
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

    .header {
        background-color: #a8dde1;
        max-width: 800px;
        width: 100%;
    }

    .header h2 {
        color: black;
        margin: 5px 0;
        font-size: 20px;
    }

    h1 {
        color: black;
    }

    .form-wrapper {
        flex: 1;
        display: flex;
        align-items: flex-start;
        justify-content: center;
        padding: 2rem;
    }

    .form-container {
        width: 100%;
        max-width: 400px;
    }

    .btn-submit {
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

    .btn-submit:hover {
        background-color: #5371cb;
    }

    .form-container img {
        width: 95%;
        margin-bottom: 1rem;
    }

    .tab {
        margin-top: 20px;
    }

    .username {
        font-size: 35px;
        margin: 0 20px;
        color: black;
    }
    </style>
</head>

<body>
    <div class="screen">
        <div class="icon-bell">
            <i class="fa-solid fa-bell"></i>
        </div>

        <div class="header">
            <img src="img/Welcome_menu.jpg" style="width: 80%;" alt="คู่มือการใช้งาน" class="header-image">
            <p class="username">คุณสมชาย</p>

            <img src="img/Welcome_menu2.jpg" style="width: 80%;" alt="คู่มือการใช้งาน" class="header-image">
            <br>
        </div>

        <div class="form-wrapper">
            <div class="form-container">
                <img src="img/select_route.jpg" alt="ทางเดิน" class="header-image"
                    onclick="window.location.href='routes.php'" style="cursor: pointer;">
                <img src="img/record_route.jpg" alt="บันทึกการเดินทาง" class="header-image"
                    onclick="window.location.href='record_walk.php'" style="cursor: pointer;">
                <img src="img/usermanual_btn.jpg" alt="คู่มือ" class="header-image"
                    onclick="window.location.href='contact.php'" style="cursor: pointer;">
                <div class="tab"></div>
                <button class="btn-submit" onclick="location.href='menu.php'">กลับสู่เมนูหลัก</button>

            </div>
        </div>
    </div>
</body>

</html>