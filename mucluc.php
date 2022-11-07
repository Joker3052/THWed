<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
    <style>
        .list-group-item:hover {
            color: #DC143C;
        }

        .btn-danger:hover {
            color: #006400;
        }
    </style>
</head>

<body>
    <?php
    $idLogin = '';
    if (isset($_GET['idLogin'])) {
        $idLogin = $_GET['idLogin'];
    }
   
    // if (isset($_SESSION['login'][$idLogin])) {
    //     echo "hi <b>" . $_SESSION['login'][$idLogin] . "</b>";
    // } else {
    //     echo 'pl login';
    // }
    ?>
    <div class="list-group">
        <a class="btn list-group-item active" href="" target="page2">Trang chủ</a>
        <a class="btn list-group-item" href="./nhanvien.php?idLogin=<?= $idLogin ?>" target="page2">Danh sách nhân viên</a>
        <a class="btn list-group-item" href="./phongban.php?idLogin=<?= $idLogin ?>" target="page2">Danh sách phòng ban</a>
        <a class="btn list-group-item" href="./search.php?idLogin=<?= $idLogin ?>" target="page2">Tìm kiếm nhân viên</a>
        <a class="btn list-group-item" href="./update.php?idLogin=<?= $idLogin ?>" target="page2">Cập nhật thông tin</a></a>
        <a class="btn btn-danger" onclick="Delete()" href="./nhanvien.php?idLogin=<?= $idLogin ?>" target="page2">Xóa tất cả</a>

    </div>
    <script type="text/javascript">
        function Delete() {
            option = confirm('Bạn có chắc là muốn XÓA TẤT CẢ?')
            if (!option) {
                return;
            }
            $.post('delete.php', function(data) {
                alert(data)
                location.reload()
            })
        }
    </script>
</body>

</html>