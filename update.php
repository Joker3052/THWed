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

		<?php
			if (isset($_SESSION['login'])) {
			?>
				<a href="logout.php">logout</a>
			<?php
			} else {
			?>
				<a href="login.php">login</a>

			<?php
			}
			?>

			<?php

			if (isset($_SESSION['login'])) {
				echo "hi <b>" . $_SESSION['login']. "</b>";
			} else {
				echo 'pl login';
			}
			?>
		
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
			<td><button class="btn btn-warning" onclick="edit(' . $std['IDNV'] . ','.$idLogin.')">Edit</button></td>
			<td><button class="btn btn-danger" onclick="Delete('.$std['IDNV'].')">Delete</button></td>
		</tr>';
}
?>

					</tbody>
				</table>
				<button class="btn btn-success" onclick="add(<?=$idLogin?>)">Add Student</button>
			</div>
		</div>
	</div>

	<script type="text/javascript">
		
		function add(id) {
			<?php
			if (isset($_SESSION['login'])) {
				//header("Location: index.php?idLogin=$idLogin");
			?>
				location.href = "input.php?idLogin=" + id;
				// console.log('id is :'+id);
			<?php
			} else {
			?>
				option = confirm('CẦN ĐĂNG NHẬP');
				if (!option) {
					return;
				} else {
					location.href = 'login.php';
				}

			<?php  } ?>
		}

		function edit(id,idLogin) {
			<?php
			if (isset($_SESSION['login'][$idLogin])) {
				//header("Location: index.php?idLogin=$idLogin");
				?>
				location.href = "input.php?idEdit=" + id+"&idLogin="+idLogin;
				// console.log('id is :'+id);
			<?php
			} else {
			?>
				option = confirm('CẦN ĐĂNG NHẬP');
				if (!option) {
					return;
				} else {
					location.href = 'login.php';
				}

			<?php  } ?>
		}


		function Delete(id) {
			<?php
			if (isset($_SESSION['login'][$idLogin])) { ?>
				option = confirm('Bạn có muốn xoá sinh viên này không')
				if (!option) {
					return;
				}

				console.log(id)
				$.post('delete.php', {
					'IDNV': id
				}, function(data) {
					alert(data)
					location.reload()
				})
			<?php
			} else {
			?>
				option = confirm('CẦN ĐĂNG NHẬP');
				if (!option) {
					return;
				} else {
					location.href = 'login.php';
				}

			<?php  } ?>
		}
	</script>
</body>
</html>