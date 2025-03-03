<?php
include 'db.php'; // ✅ เชื่อมต่อฐานข้อมูล

// ✅ ตรวจสอบว่ามี ID ถูกส่งมาหรือไม่
if (isset($_GET['id'])) {
    $id = $_GET['id'];
    $stmt = $conn->prepare("SELECT * FROM contacts WHERE id = ?");
    $stmt->bind_param("i", $id);
    $stmt->execute();
    $result = $stmt->get_result();
    $row = $result->fetch_assoc();
    $stmt->close();

    // ✅ ถ้าไม่มีข้อมูลให้กลับไปที่ index.php
    if (!$row) {
        header("Location: index.php");
        exit();
    }
} else {
    header("Location: index.php");
    exit();
}

// ✅ เมื่อกดปุ่ม "บันทึก"
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $fname = $_POST['first_name'];
    $lname = $_POST['last_name'];
    $email = $_POST['email'];

    // ✅ ตรวจสอบว่ามีข้อมูลครบทุกช่อง
    if (!empty($fname) && !empty($lname) && !empty($email)) {
        $stmt = $conn->prepare("UPDATE contacts SET first_name = ?, last_name = ?, email = ? WHERE id = ?");
        $stmt->bind_param("sssi", $fname, $lname, $email, $id);
        
        // ✅ เช็กว่าอัปเดตสำเร็จหรือไม่
        if ($stmt->execute()) {
            $stmt->close();
            header("Location: index.php"); // ✅ กลับไปหน้าแรก
            exit();
        } else {
            echo "<p style='color:red;'>เกิดข้อผิดพลาดในการบันทึก</p>";
        }
    } else {
        echo "<p style='color:red;'>กรุณากรอกข้อมูลให้ครบทุกช่อง</p>";
    }
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>แก้ไขรายชื่อ</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <div class="container mt-4">
        <h2>✏️ แก้ไขรายชื่อ</h2>
        <form method="POST">
            <input type="text" name="first_name" value="<?= htmlspecialchars($row['first_name']) ?>" required class="form-control mb-2">
            <input type="text" name="last_name" value="<?= htmlspecialchars($row['last_name']) ?>" required class="form-control mb-2">
            <input type="email" name="email" value="<?= htmlspecialchars($row['email']) ?>" required class="form-control mb-2">
            <button type="submit" class="btn btn-warning">บันทึกการเปลี่ยนแปลง</button>
            <a href="index.php" class="btn btn-secondary">🔙 กลับ</a>
        </form>
    </div>
</body>
</html>
