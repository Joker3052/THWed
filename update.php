<?php
require_once ('dbhelper.php');
?>
<!DOCTYPE html>
<html>
<head>
	<title>Update</title>
	<!-- Latest compiled and minified CSS -->
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css">

	<!-- jQuery library -->
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>

	
</head>
<body>
	<div class="container">
		<div class="panel panel-primary">
			<div class="panel-heading">
				Quản lý thông tin nhân viên
			</div>
			<div class="panel-body">
				<table class="table table-bordered">
					<thead>
						<tr>
							<th>STT</th>
							<th>Họ và Tên</th>
							<th>Phòng Ban</th>
							<th>Địa chỉ</th>
							<th width="60px"></th>
							<th width="60px"></th>
						</tr>
					</thead>
					<tbody>
<?php
if (isset($_GET['s']) && $_GET['s'] != '') {
	$sql = 'select * from nhanvien where Hoten like "%'.$_GET['s'].'%"';
} else {
	$sql = 'SELECT nhanvien.IDNV,nhanvien.Hoten,phongban.Tenpb,nhanvien.Diachi
	FROM nhanvien
   INNER JOIN phongban
   ON nhanvien.IDPB = phongban.IDPB';
}

$studentList = executeResult($sql);

$index = 1;
foreach ($studentList as $std) {
	echo '<tr>
			<td>'.($index++).'</td>
			<td>'.$std['Hoten'].'</td>
			<td>'.$std['Tenpb'].'</td>
			<td>'.$std['Diachi'].'</td>
			<td><button class="btn btn-warning" onclick=\'window.open("input.php?id='.$std['IDNV'].'","_self")\'>Edit</button></td>
			<td><button class="btn btn-danger" onclick="Delete('.$std['IDNV'].')">Delete</button></td>
		</tr>';
}
?>

					</tbody>
				</table>
				<button class="btn btn-success" onclick="window.open('input.php', '_self')">Add Student</button>
			</div>
		</div>
	</div>

	<script type="text/javascript">
		function Delete(id) {
			option = confirm('Bạn có muốn xoá nhân viên này không')
			if(!option) {
				return;
			}

			$.post('delete.php', {
				'IDNV': id
			}, function(data) {
				alert(data)
				location.reload()
			})
		}
	</script>
</body>
</html>