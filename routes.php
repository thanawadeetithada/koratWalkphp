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
        padding: 7rem 2rem 1rem 2rem;
        border-bottom-left-radius: 30px;
        border-bottom-right-radius: 30px;
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
        padding: 4rem 2rem;
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
        width: 100%;
        margin-bottom: 1rem;
    }

    .tab {
        margin-top: 20px;
    }
    </style>
</head>

<body>
    <div class="screen">
        <div class="icon-bell">
            <a href="tel:1669" style="text-decoration: none;">
                <i class="fa-solid fa-bell"></i>
            </a>
        </div>

        <div class="header">
            <h1 style="font-size: 40px;">เลือกเส้นทาง</h1>
            <h2>ที่เพลิดเพลินด้วยตัวคุณเอง</h2>
            <br>
        </div>

        <div class="form-wrapper">
            <div class="form-container">
                <a href="route1.php">
                    <img src="img/route1.jpg" alt="ทางเดินที่1" class="header-image">
                </a>
                <a href="route2.php">
                    <img src="img/route2.jpg" alt="ทางเดินที่2" class="header-image">
                </a>
                <a href="route3.php">
                    <img src="img/route3.jpg" alt="ทางเดินที่3" class="header-image">
                </a>
                <a href="route4.php">
                    <img src="img/route4.jpg" alt="ทางเดินที่4" class="header-image">
                </a>

                <div class="tab"></div>
                <button class="btn-submit" onclick="location.href='menu.php'">กลับสู่เมนูหลัก</button>

            </div>
        </div>
    </div>
</body>

</html>