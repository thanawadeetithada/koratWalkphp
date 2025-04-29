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
        font-family: 'Prompt', sans-serif;
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
        background-color: #4a65d3;
        color: white;
        font-size: 30px;
        font-weight: bold;
        padding: 20px 30px;
        border: none;
        border-radius: 40px;
        cursor: pointer;
    }

    .button:hover {
        background-color: #3a54c0;
    }


    </style>
</head>

<body>
    <div class="icon-bell">
        <i class="fa-solid fa-bell"></i>
    </div>


    <h1>บันทึกการเดินของฉัน</h1>

    <div class="card">
        <div class="row"><span class="label">วันที่</span></div>
        <div class="row"><span class="label">ระยะทาง</span> <span class="label">เมตร</span></div>
        <div class="row"><span class="label">จำนวนการเดิน</span> <span class="label">ก้าว</span></div>
        <div class="row"><span class="label">แคลอรี่ที่เผาผลาญ</span> <span class="label">แคลอรี่</span></div>
    </div>

    <div class="card">
        <div class="row"><span class="label">วันที่</span> </div>
        <div class="row"><span class="label">ระยะทาง</span><span class="label">เมตร</span></div>
        <div class="row"><span class="label">จำนวนการเดิน</span> <span class="label">ก้าว</span></div>
        <div class="row"><span class="label">แคลอรี่ที่เผาผลาญ</span> <span class="label">แคลอรี่</span></div>
    </div>

    <div class="card">
        <div class="row"><span class="label">วันที่</span></div>
        <div class="row"><span class="label">ระยะทาง</span> <span class="label">เมตร</span></div>
        <div class="row"><span class="label">จำนวนการเดิน</span> <span class="label">ก้าว</span></div>
        <div class="row"><span class="label">แคลอรี่ที่เผาผลาญ</span> <span class="label">แคลอรี่</span></div>
    </div>

    <button class="button" onclick="location.href='menu.php'">กลับสู่เมนูหลัก</button>
</body>

</html>