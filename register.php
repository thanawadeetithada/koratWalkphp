<!DOCTYPE html>
<html lang="th">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>ลงทะเบียน</title>
    <link href="https://fonts.googleapis.com/css2?family=Prompt&display=swap" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">

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

    .header {
        background-color: #5371cb;
        padding: 5rem 2rem 3rem 2rem;
        border-bottom-left-radius: 30px;
        border-bottom-right-radius: 30px;
        max-width: 800px;
        width: 100%;
    }

    .header h2 {
        color: white;
        margin: 5px 0;
        font-size: 20px;
    }

    h1 {
        color: white;
    }

    .form-wrapper {
        flex: 1;
        display: flex;
        align-items: flex-start;
        justify-content: center;
        padding: 5rem 2rem;
    }

    .form-container {
        width: 100%;
        max-width: 400px;
    }

    .input-field {
        width: 100%;
        padding: 15px 20px;
        font-size: 23px;
        margin-bottom: 30px;
        border-radius: 30px;
        border: 1px solid #999;
    }

    .input-field:focus {
        outline: none;
        box-shadow: 0;
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

    .note {
        margin-top: 20px;
        text-align: center;
        font-size: 20px;
        color: #333;
    }

    .bg-primary {
        background-color: #5371cb !important;
    }

    .btn-primary {
        background-color: #5371cb;
        border: none;
        font-size: 20px;
    }

    #error-alert {
        text-align: center;
        font-size: 25px;
    }

    .modal-body {
        font-size: 25px;
    }
    </style>
</head>

<body>
    <div class="screen">
        <div class="header">
            <h1 style="font-size: 40px;">ลงทะเบียนผู้ใช้งาน</h1>
            <h2>กรุณากรอกข้อมูลสั้น ๆ</h2>
            <h2>เพื่อเริ่มใช้งาน...</h2>
        </div>

        <div class="form-wrapper">
            <div class="form-container">
            <div id="error-alert" class="alert alert-danger d-none" role="alert"></div>

                <input type="text" class="input-field" placeholder="ชื่อผู้ใช้งาน" required>
                <input type="text" class="input-field" placeholder="ชื่อจริง" required>
                <input type="text" class="input-field" placeholder="นามสกุล" required>
                <input type="tel" class="input-field" placeholder="เบอร์โทรศัพท์" required>
                <button class="btn-submit">ส่งรหัส OTP</button>
                <div class="note">กดปุ่มนี้ เราจะส่งรหัส 4 หลัก <br> ไปยัง SMS ของคุณ</div>
            </div>
        </div>
    </div>

    <!-- Modal -->
    <div class="modal fade" id="otpSuccessModal" tabindex="-1" aria-labelledby="otpSuccessLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content text-center">
                <div class="modal-header bg-primary text-white">
                    <h5 class="modal-title" id="otpSuccessLabel">ส่ง OTP สำเร็จ</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="ปิด"></button>
                </div>
                <div class="modal-body">
                    ระบบได้ส่งรหัส OTP ไปยังเบอร์โทรของคุณแล้ว
                </div>
                <div class="modal-footer">
                    <a href="login.php" class="btn btn-primary">ตกลง</a>
                </div>
            </div>
        </div>
    </div>


    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
  

</body>

</html>