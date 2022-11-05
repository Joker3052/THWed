<?php
require_once ('dbhelper.php');
if (isset($_POST['IDNV'])) {
	$id = $_POST['IDNV'];

	$sql = 'delete from nhanvien where IDNV = '.$id;
	execute($sql);

	echo 'Xóa nhân viên thành công';
}
else
{
	$sql = 'delete from nhanvien';
    execute($sql);
	echo 'Đã xóa tất cả';
}