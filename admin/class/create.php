
<?php
include("../../include/common.php");
// check_login();
if (is_method_post()) {
	// upload và nhận lại filename
	$ten = $_POST["ten"] ?? "";
	$gia = $_POST["gia"] ?? "";
	$mota = $_POST["mota"] ?? "";
	// $data_type = $_POST["data_type"] ?? "";
	$id = $_POST["id"] ?? "";
	// Lưu file 
	$img = upload_and_return_filename("img","thongtin");

	$sql = "insert into thongtin( img, gia, ten, mota,id)
			values( ?, ?, ?,? ,?)";
	$data = array($img, $gia, $ten, $mota,$id);
	db_execute($sql, $data);

	js_alert("Thêm Thông Tin thành công");
	// js_redirect_to("/admin/thongtin/");	
}

	// $_title = "Thêm Thông Tin";
	// include("../../_header.php");
?>



<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<link rel="stylesheet" href="../../css/create.css">
	<title>Thêm Sản Phẩm Mới</title>
</head>
<body>
<h2>Thêm sản phẩm mới</h2>
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
    <input type="submit" value="Thêm">
</form>

</body>
</html>
