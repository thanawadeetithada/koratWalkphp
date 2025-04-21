<!-- forgot-password.html -->
<!DOCTYPE html>
<html lang="th">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>ลืมรหัสผ่าน</title>
  <link href="https://fonts.googleapis.com/css2?family=Prompt&display=swap" rel="stylesheet">
  <link rel="stylesheet" href="style.css">
  <style>
    .forgot-box {
      /* background-color: #4169e1; */
      border-radius: 30px 30px 20px 20px;
      padding: 30px 20px;
      text-align: center;
      color: white;
    }
    .forgot-box img {
      width: 40px;
      margin-bottom: 15px;
    }
    .btn-orange {
      background-color: #ff9800;
      color: white;
      font-weight: bold;
      margin-top: 20px;
    }
    .desc {
      margin-top: 15px;
      font-size: 14px;
      color: #fff;
    }
  </style>
</head>
<body>
  <div class="screen">
    <div class="forgot-box">
      <img src="https://img.icons8.com/ios-filled/50/lock--v1.png" alt="lock">
      <h3>คุณลืมรหัสผ่านใช่ไหม?</h3>
      <p>ไม่ต้องห่วงค่ะ<br>กรอกเบอร์มือถือ เพื่อรับ OTP</p>
      <input type="text" class="input-field" placeholder="เบอร์โทรศัพท์"><br>
      <button class="btn btn-orange">ส่งรหัส OTP</button>
      <div class="desc">
        เราจะส่งรหัส OTP ไปที่เบอร์ของคุณผ่าน SMS
      </div>
    </div>
  </div>
</body>
</html>