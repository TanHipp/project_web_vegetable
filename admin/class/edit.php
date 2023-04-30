<?php
include("../../include/common.php");
$id = $_GET["id"] ?? "-1";

if (is_method_get()) {
    $sql = "select * from thongtin where id=?";
    $data = db_select($sql, [$id]);
    if (empty($data)) {
        redirect_to("index.php");
    }
    $data = $data[0]; 
} else {
    $ten = $_POST["ten"] ?? "";
	$gia = $_POST["gia"] ?? "";
	$mota = $_POST["thongtin"] ?? "";
	$img = upload_and_return_filename("img","thongtin");
    if (empty($img)==true) {
        $sql = "UPDATE thongtin SET  gia=?, ten=?, mota=?  WHERE id=?"; 
        $data =[ $id, $gia, $ten,  $mota];
        db_execute($sql, $data);
        js_alert("Cập Nhập thành công");
        js_redirect_to("admin/thongtin/index.php");
    } else {
        $sql = "UPDATE thongtin SET img=?, gia=?, ten=?, mota=?  WHERE id=?";
        $data = [ $img, $gia, $ten,  $mota, $id];
        db_execute($sql, $data);
        js_alert("Cập Nhập thành công");
        js_redirect_to("indexad .php");
    }

}

?>


<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<link rel="stylesheet" href="../../css/create.css">
	<title>Chỉnh Sửa Sản Phẩm</title>
</head>
<body>
<h2>Chỉnh sửa sản phẩm mới</h2>
<form method="post" enctype="multipart/form-data">
    <label>Tên sản phẩm</label>
    <input type="text" name="ten">
    <br><br>
    <label>Giá</label>
    <input type="text" name="gia">
    <br><br>
    <label>Mô tả</label>
    <input type="text" name="mota">
    <br><br>
    <!-- <label>Phân Loại</label>
    <input type="text" name="data_type">
    <br><br> -->
    <label>Chọn ảnh</label>
    <input type="file" name="img" accept=".pnj, .png, .jpg, .gif">
    <br><br>
    <input type="submit" value="Update">
</form>

</body>
</html>
