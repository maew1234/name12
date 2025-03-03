<?php
include 'db.php';
$result = $conn->query("SELECT * FROM contacts");
?>
<!DOCTYPE html>
<html>
<head>
    <title>รายชื่อ</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="style.css">
</head>
<body class="container mt-4">
    <h2>รายชื่อผู้ติดต่อ</h2>
    <a href="add.php" class="btn btn-success mb-2">เพิ่มข้อมูล</a>
    <table class="table table-bordered">
        <tr><th>ID</th><th>ชื่อ</th><th>นามสกุล</th><th>อีเมล</th><th>จัดการ</th></tr>
        <?php while ($row = $result->fetch_assoc()) { ?>
            <tr>
                <td><?= $row['id'] ?></td>
                <td><?= $row['first_name'] ?></td>
                <td><?= $row['last_name'] ?></td>
                <td><?= $row['email'] ?></td>
                <td>
                    <a href="edit.php?id=<?= $row['id'] ?>" class="btn btn-warning btn-sm">แก้ไข</a>
                    <a href="delete.php?id=<?= $row['id'] ?>" class="btn btn-danger btn-sm" onclick="return confirm('ยืนยันการลบ?');">ลบ</a>
                </td>
            </tr>
        <?php } ?>
    </table>
</body>
</html>
