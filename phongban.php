<?php
require_once ('dbhelper.php');
?>
<!DOCTYPE html>
<html>
<head>
	<title>phongban</title>
	<!-- Latest compiled and minified CSS -->
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css">

	<!-- jQuery library -->
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>

	
</head>
<body>
	<div class="container">
		<div class="panel panel-primary">
		<?php
			$idLogin = '';
			if (isset($_GET['idLogin'])) {
				$idLogin = $_GET['idLogin'];
			}
			if (isset($_SESSION['login'][$idLogin])) {
			?>
				<a href="logout.php">logout</a>
			<?php
			} else {
			?>
				<a href="login.php?linklogin=2">login</a>

			<?php
			}
			?>

			<?php

			if (isset($_SESSION['login'][$idLogin])) {
				echo "hi <b>" . $_SESSION['login'][$idLogin] . "</b>";
			} else {
				echo 'pl login';
			}
			?>
			<div class="panel-heading">
			 Thông tin phòng ban
			</div>
			<div class="panel-body">
				<table class="table table-bordered">
					<thead>
						<tr>
							<th>STT</th>
							<th>Tên phòng ban</th>
							<th>Mô tả</th>
							<th>Danh sách nhân viên </th>
						</tr>
					</thead>
					<tbody>
<?php
	$sql = 'SELECT * FROM phongban';
$studentList = executeResult($sql);

$index = 1;
foreach ($studentList as $std) {
	echo '<tr>
			<td>'.($index++).'</td>
			<td>'.$std['Tenpb'].'</td>
			<td>'.$std['Mota'].'</td>
			<td><button class="btn btn-info" onclick=\'window.open("nhanvien.php?idphongban='.$std['IDPB'].'","_self")\'>Xem chi tiết</button></td>
		</tr>';
}
// <td>'.$std['Diachi'].'</td>
?>				</tbody>
				</table>
			</div>
		</div>
	</div>

	
</body>
</html>