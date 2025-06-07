<?php // login.php ?>
<!DOCTYPE html>
<html lang="th">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>KoratWalk</title>
    <link href="https://fonts.googleapis.com/css2?family=Prompt&display=swap" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css" rel="stylesheet">
    <style>
    * {
        box-sizing: border-box;
        margin: 0;
        padding: 0;
    }

    /* สำหรับ Chrome, Safari, Edge */
    input[type="number"]::-webkit-outer-spin-button,
    input[type="number"]::-webkit-inner-spin-button {
        -webkit-appearance: none;
        margin: 0;
    }

    /* สำหรับ Firefox */
    input[type="number"] {
        -moz-appearance: textfield;
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
        padding: 30px;
        margin-bottom: 30px;
    }

    .screen img {
        width: 100%;
        max-width: 500px;
        margin: 0 auto 20px;
        display: block;
    }

    h1,
    h2,
    h3 {
        text-align: center;
        color: #333;
    }

    p {
        text-align: center;
        color: #555;
        margin-bottom: 20px;
    }

    .input-field {
        margin: 10px 0;
        border: none;
        font-size: 23px;
        width: 100%;
        padding: 10px 4.5rem;
        box-sizing: border-box;
        background-color: #a8dde2;
        border-radius: 30px;
    }

    .input-field:focus,
    .input-field:hover {
        border: none;
        outline: none;
        box-shadow: 0;
        background-color: #a8dde2;
    }

    .btn {
        width: fit-content;
        padding: .5rem 2rem;
        border: none;
        border-radius: 20px;
        background-color: #5371cb;
        color: white;
        font-size: 18px;
        cursor: pointer;
    }

    .btn:hover {
        background-color: #5371cb;
    }

    .menu-btn {
        display: flex;
        align-items: center;
        padding: 12px;
        margin-bottom: 10px;
        background-color: #e3e9ff;
        border-radius: 12px;
        cursor: pointer;
        text-decoration: none;
        color: #000;
    }

    .menu-btn img {
        width: 30px;
        margin-right: 15px;
    }

    .input-container {
        position: relative;
        margin: 10px auto;
        box-sizing: border-box;
        background-color: #a8dde2;
        border: none;
        border-radius: 40px;
    }

    .input-container i {
        position: absolute;
        left: 10px;
        top: 50%;
        transform: translateY(-50%);
        color: #a8dde2;
        background-color: white;
        padding: 15px;
        border-radius: 30px;
        font-size: x-large;
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
        <img src="img/Login.jpg" alt="elderly">
        <h1 style="color: #695956;"><span>กรุณากรอกชื่อ</span></h1>
        <br>
        <form method="POST" action="login_process.php" style="text-align: center;">
            <div class="input-container">
                <i class="fa-solid fa-user"></i>
                <input class="input-field" type="text" name="firstname" placeholder="ชื่อจริง" required
                    autocomplete="off">
            </div>
            <div class="input-container">
                <i class="fa-solid fa-user"></i>
                <input class="input-field" type="text" name="lastname" placeholder="นามสกุล" required>
            </div>
            <div class="input-container">
                <i class="fa-solid fa-weight-scale"></i>
                <input class="input-field" type="number" name="weight" placeholder="น้ำหนัก" required>
            </div>
            <br>
            <button class="btn" type="submit">เข้าสู่ระบบ</button><br><br>
        </form>
    </div>
</body>

</html>