<?php
include 'db.php';
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $fname = $_POST['first_name'];
    $lname = $_POST['last_name'];
    $email = $_POST['email'];
    $conn->query("INSERT INTO contacts (first_name, last_name, email) VALUES ('$fname', '$lname', '$email')");
    header("Location: index.php");
}
?>
<!DOCTYPE html>
<html>
<head>
    <title>เพิ่มรายชื่อ</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="style.css"> <!-- ✅ ใช้ CSS -->
</head>
<body>
    <div class="container mt-4">
        <h2>➕ เพิ่มรายชื่อ</h2>
        <form method="POST">
            <input type="text" name="first_name" placeholder="ชื่อ" required class="form-control mb-2">
            <input type="text" name="last_name" placeholder="นามสกุล" required class="form-control mb-2">
            <input type="email" name="email" placeholder="อีเมล" required class="form-control mb-2">
            <button type="submit" class="btn btn-success">บันทึกข้อมูล</button>
            <a href="index.php" class="btn btn-secondary">🔙 กลับ</a>
        </form>
    </div>
</body>
</html>