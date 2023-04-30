<?php
include("include/common.php");

if (is_method_post()) {
    $username = $_POST["username"];
    $password = $_POST["password"];
    $cf_password = $_POST["cf_password"];
    if ($password != $cf_password) {
        js_alert("Mật khẩu không trùng khớp!");
        js_redirect_to("register.php");
        die;
    }

    $sql = "insert into users(username, password) values(?, ?)";
    $sql_sel = "select * from users where username=?";
    $data = db_select($sql_sel, [$username]);

    if (!empty($data)) {
        js_alert("Lỗi! Tên tài khoản đã tồn tại!");
        js_redirect_to("register.php");
        die;
    }

    $password_hash = password_hash($password, PASSWORD_DEFAULT);
    $params = [$username, $password_hash];
    db_execute($sql, $params);
    js_alert("Đăng ký thành công!");
    js_redirect_to("/");
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/register.css">
    <title>register</title>
</head>

<body>
<div class="login-container">
<form method="post">
    <h2>ĐĂNG KÍ TÀI KHOẢN</h2>
    <div class="form-group">
      <label for="username">Tên Đăng Nhập</label>
      <input type="text" id="username" name="username" required>
    </div>
    <div class="form-group">
      <label for="password">Mật Khẩu</label>
      <input type="password" id="password" name="password" required>
    </div>
    <div class="form-group">
      <label for="cf_password">Xác Nhận Lại Mật Khẩu</label>
      <input type="password" id="password" name="cf_password" required>
    </div>
    <input type="submit" value="Đăng Kí ">
    <p>Bạn đã có tài khoản? <a href="login.php">Đăng nhập ngay</a></p>
  </form>
</div>

</body>

</html>