<?php
include("include/common.php");
// if (is_logged()) {
//     js_redirect_to("/");
// }
//1. Get thông tin từ form
if (is_method_post()) {
    $username = $_POST["username"] ?? "";
    $password = $_POST["password"] ?? "";

    //2. Select từ database dựa vào username
    $sql = "select * from users where username=?";
    $user = db_select($sql, [$username]);

    //3. Nếu kết quả select là rỗng thì thông báo nhập sai username
    if (empty($user)) {
        js_alert("Nhập sai username rồi đại vương ơi!");
        js_redirect_to("login.php");
        die;
    }
    $user = $user[0];

    //4. Nếu kết quả select không rỗng thì so sánh password trong db với password ở bước 1.
    //đến đây viết bằng funtion => password_verify()
    if (password_verify($password, $user["password"]) == true) {
        js_alert("Đăng nhập thành công");
        $_SESSION["username"] = $username;
        js_redirect_to("/");
    } else {
        js_alert("Lỗi, tên hoặc mật khẩu không hợp lệ!");
        js_redirect_to("login.php");
        die;
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Form Đăng Nhập</title>
  <link rel="stylesheet" href="css/login.css">
</head>
<body>
<div class="login-container">
  <form method="post">
    <h2>ĐĂNG NHẬP TÀI KHOẢN</h2>
    <div class="form-group">
      <label for="username">Tên Đăng Nhập</label>
      <input type="text" id="username" name="username" required>
    </div>
    <div class="form-group">
      <label for="password">Mật Khẩu</label>
      <input type="password" id="password" name="password" required>
    </div>
    <input type="submit" value="Đăng Nhập ">
    <p>Bạn chưa có tài khoản? <a href="register.php">Đăng kí ngay</a></p>
  </form>
</div>
</body>
</html>
