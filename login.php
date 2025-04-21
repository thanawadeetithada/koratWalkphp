<?php // login.php ?>
<!DOCTYPE html>
<html lang="th">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>KoratWalk - Login</title>
  <link href="https://fonts.googleapis.com/css2?family=Prompt&display=swap" rel="stylesheet">
  <link rel="stylesheet" href="style.css">
</head>
<body>
  <div class="screen">
    <img src="img/Login.jpg" alt="elderly">
    <h2 style="color: black;"><span>กรุณากรอกชื่อ</span></h2>
    <br>
    <form action="menu.php" method="post" style="text-align: center;">
      <input class="input-field" type="text" name="username" placeholder="ชื่อผู้ใช้งาน" required>
      <input class="input-field" type="password" name="password" placeholder="รหัสผ่าน" required>
      <div style="text-align: right; width: 90%; margin: 5px auto 15px;">
        <a href="forgot-password.php" style="font-size: 16px; color: orange; text-decoration: none;">ลืมรหัสผ่าน?</a>
      </div>
      
      <button class="btn" type="submit">เข้าสู่ระบบ</button><br><br>
      <p style="font-size: 16px;">
        <a href="register.php" style="text-decoration: none; color: black;">ลงทะเบียน</a>
      </p>
    </form>
  </div>
</body>
</html>
