<?php
require_once('dbhelper.php');

$s_Hoten = $s_IDPB = $s_Diachi = '';

if (!empty($_POST)) {
	$s_id = '';

	if (isset($_POST['Hoten'])) {
		$s_Hoten = $_POST['Hoten'];
	}

	if (isset($_POST['IDPB'])) {
		$s_IDPB = $_POST['IDPB'];
	}

	if (isset($_POST['Diachi'])) {
		$s_Diachi = $_POST['Diachi'];
	}

	if (isset($_POST['id'])) {
		$s_id = $_POST['id'];
	}
	function remove_special_character($string)
	{

		$t = $string;

		$specChars = array(
			'!' => '',    '"' => '',
			'#' => '',    '$' => '',    '%' => '',
			'&' => '',    '\'' => '',   '(' => '',
			')' => '',    '*' => '',    '+' => '',
			',' => '',    '₹' => '',    '.' => '',
			'/-' => '',    ':' => '',    ';' => '',
			'<' => '',    '=' => '',    '>' => '',
			'?' => '',    '@' => '',    '[' => '',
			'\\' => '',   ']' => '',    '^' => '',
			'_' => '',    '`' => '',    '{' => '',
			'|' => '',    '}' => '',    '~' => '',
			'-----' => '-',    '----' => '-',    '---' => '-',
			'/' => '',    '--' => '-',   '/_' => '-',

		);

		foreach ($specChars as $k => $v) {
			$t = str_replace($k, $v, $t);
			//$k: kí tự cần thay thế
			//$v: kí tự được thay thế
			//$t: biến ban đầu
		}

		return $t;
	}
	$s_Hoten = remove_special_character($s_Hoten);
	$s_IDPB      = remove_special_character($s_IDPB);
	$s_Diachi  = remove_special_character($s_Diachi);
	$s_id       = remove_special_character($s_id);
	if ($s_id != '') {
		//update
		$sql = "update nhanvien set Hoten = '$s_Hoten', IDPB = '$s_IDPB', Diachi = '$s_Diachi' where IDNV = " . $s_id;
	} else {
		//insert
		$sql = "insert into nhanvien(Hoten, IDPB, Diachi) value ('$s_Hoten', '$s_IDPB', '$s_Diachi')";
	}

	// echo $sql;

	execute($sql);

	$idLogin = '';
	if (isset($_GET['idLogin'])) {
		$idLogin = $_GET['idLogin'];
		// header("Location: index.php?idLogin= $idLogin");
		header("Location: update.php?idLogin=$idLogin");
	}
	die();
}

$id = '';
if (isset($_GET['idEdit'])) {
	$id          = $_GET['idEdit'];
	$sql         = 'select * from nhanvien where IDNV = ' . $id;
	$studentList = executeResult($sql);
	if ($studentList != null && count($studentList) > 0) {
		$std        = $studentList[0];
		$s_Hoten = $std['Hoten'];
		$s_IDPB      = $std['IDPB'];
		$s_Diachi  = $std['Diachi'];
	} else {
		$id = '';
	}
}

// 
?>

<!DOCTYPE html>
<html>

<head>
	<title>Registation Form * Form Tutorial</title>
	<!-- Latest compiled and minified CSS -->
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css">

	<!-- jQuery library -->
	<!-- <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script> -->

	<!-- Popper JS -->
	<!-- <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script> -->

	<!-- Latest compiled JavaScript -->
	<!-- <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js"></script> -->
</head>

<body>
	<div class="container">
		<div class="panel panel-primary">
			<div class="panel-heading">
				<h2 class="text-center">Add Student</h2>
			</div>
			<div class="panel-body">
				<form method="post">
					<div class="form-group">
						<label for="usr">Name:</label>
						<input type="number" name="id" value="<?= $id ?>" style="display: none;">
						<input required="true" type="text" class="form-control" id="usr" name="Hoten" value="<?= $s_Hoten ?>">
					</div>
					<div class="form-group">
						<label for="birthday">IDPB:</label>
						<select required="true"  class="form-control" id="IDPB" name="IDPB" value="<?= $s_IDPB ?>">
							<option value="1">Ban kế toán</option>
							<option value="2">Ban quản lý</option>
							<option value="3">Ban chính trị</option>
						</select>
					</div>

					<div class="form-group">
						<label for="Diachi">Diachi:</label>
						<input required="true" type="text" class="form-control" id="Diachi" name="Diachi" value="<?= $s_Diachi ?>">
					</div>
					<button class="btn btn-success">Save</button>
				</form>
			</div>
		</div>
	</div>
</body>

</html>