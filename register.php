<!-- register.html -->
<!DOCTYPE html>
<html lang="th">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>สมัครสมาชิก</title>
  <link href="https://fonts.googleapis.com/css2?family=Prompt&display=swap" rel="stylesheet">
  <link rel="stylesheet" href="style.css">
  <style>
    .register-header {
      /* background-color: #5c6bc0; */
      color: white;
      border-radius: 20px 20px 0 0;
      padding: 20px;
      text-align: center;
    }
    .register-form {
      padding: 20px;
      text-align: center;
    }
    .btn-purple {
      background-color: #5c6bc0;
      color: white;
      font-weight: bold;
      margin-top: 20px;
      margin-bottom: 20px
    }
    .note {
      font-size: 13px;
      color: #666;
      text-align: center;
      margin-top: 10px;
    }
  </style>
</head>
<body>
  <div class="screen">
    <div class="register-header">
      <!-- <h3>ลงทะเบียนผู้ใช้งาน</h3>
      <p>กรอกข้อมูลของคุณให้ครบถ้วน</p> -->
    </div>
    <div class="register-form">
      <input type="text" class="input-field" placeholder="ชื่อผู้ใช้งาน">
      <input type="text" class="input-field" placeholder="ชื่อจริง">
      <input type="text" class="input-field" placeholder="นามสกุล">
      <input type="text" class="input-field" placeholder="เบอร์โทรศัพท์"><br>
      <button class="btn btn-purple">ขอรหัส OTP</button>
      <div class="note">
        เราจะส่งรหัส OTP ไปที่เบอร์ของคุณผ่าน SMS
      </div>
    </div>
  </div>
</body>
</html>
