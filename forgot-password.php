<!-- forgot-password.html -->
<!DOCTYPE html>
<html lang="th">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>ลืมรหัสผ่าน</title>
    <link href="https://fonts.googleapis.com/css2?family=Prompt&display=swap" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css" rel="stylesheet">

    <style>
    body,
    html {
        height: 100%;
        margin: 0;
        font-family: 'Prompt', sans-serif;
    }

    .screen {
        display: flex;
        flex-direction: column;
        height: 100vh;
    }

    .top-section {
        flex: 1;
        display: flex;
        align-items: center;
        justify-content: center;
        padding: 0px 20px;
        align-items: flex-end
    }

    .bottom-section {
        flex: 1;
        display: flex;
        align-items: center;
        justify-content: center;
        padding: 20px;
        align-items: flex-start;
        border-top-left-radius: 30px;
        border-top-right-radius: 30px;
    }


    .top-section {
        background-color: white;
        text-align: center;
    }

    .bottom-section {
        background-color: #5371cb;
        color: white;
    }

    .forgot-box i.fa-lock {
        font-size: 4rem;
        color: #5371cb;
    }

    .input-field {
        width: 100%;
        max-width: 300px;
        padding: 10px 20px;
        font-size: 30px;
        border-radius: 30px;
        border: none;
        margin-bottom: 15px;
    }

    .btn-orange {
        background-color: #e78846;
        font-weight: bold;
        color: white;
        font-size: 30px;
        padding: 20px 30px;
        border: none;
        border-radius: 40px;
        cursor: pointer;
    }

    .btn-orange:hover {
        background-color: #e68900;
    }

    .desc {
        margin-top: 20px;
        font-size: 18px;
    }

    .otp-box {
        text-align: center;
    }

    .btn-orange {
        display: inline-block;
        margin: 0 auto;
    }

    p {
        font-size: 25px;
        font-weight: 600;
        color: #1f4f44;
    }
    </style>
</head>

<body>
    <div class="screen">
        <div class="top-section">
            <div class="forgot-box">
                <i class="fa-solid fa-lock"></i>
                <h1 style="font-size: 40px;color:#5371cb;">คุณลืมรหัสผ่าน<br>ใช่ไหม?</h1>
                <p>ไม่ต้องกังวลนะคะ<br>เราจะส่งรหัส OTP ให้คุณ</p>
            </div>
        </div>

        <div class="bottom-section">
            <div class="otp-box">
                <br>
                <input type="text" class="input-field" placeholder="เบอร์โทรศัพท์"><br><br>
                <button class="btn btn-orange">ส่งรหัส OTP</button>
                <div class="desc">
                    กดปุ่มนี้ เราจะส่งรหัส 4 หลัก <br> ไปยัง SMS ของคุณ
                </div>
            </div>
        </div>
    </div>
</body>


</html>