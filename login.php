<!-- Path: /login.php -->
<!DOCTYPE html>
<html lang="en">
<?php
$title = "Đăng nhập hệ thống";
include "modules/plugin.php";
?>
<?php
include_once 'context.php';
$context = new Context();
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Lấy thông tin từ form người dùng gửi lên
    // Sử dụng biến toàn cục $_POST và lấy giá trị của các trường thông qua thuộc tính name của form
    $user_name = $_POST['user_name'];
    $password = $_POST['password'];
    try {
        $query = "SELECT * FROM users WHERE user_name = '{$user_name}'";
        // Thực thi câu lệnh truy vấn SQL với phương thức execute_query của class Context
        $result = $context->execute_query($query);
        if ($result != null && $result->num_rows > 0) {
            // Lấy thông tin người dùng từ kết quả truy vấn
            // Sử dụng phương thức fetch_assoc để lấy phần tử đầu tiên của kết quả truy vấn
            $user = $result->fetch_assoc();
            // So sánh mật khẩu người dùng nhập vào với mật khẩu đã mã hóa trong cơ sở dữ liệu
            if (!password_verify($password, $user['password_hash'])) {
                throw new Exception("Tên đăng nhập hoặc mật khẩu không đúng");
            }
            // Tạo session và cookie để lưu trạng thái đăng nhập
            $session_id = session_id();
            $_SESSION[$session_id] = $user;
            // Thiết lập cookie session_id với thời gian sống 36000 giây (10 giờ)
            setcookie('session_id', $session_id, time() + 36000, '/');
            // Chuyển hướng người dùng về trang chủ
            header('Location: index.php');
        } else {
            throw new Exception("Tên đăng nhập hoặc mật khẩu không đúng");
        }
    } catch (Exception $e) {
        $form_error = $e->getMessage();
    }
}
?>

<body>
    <div class="container-lg mt-4">
        <h1 class="text-center">Đăng nhập hệ thống</h1>
        <!-- Các bạn lưu ý action của form chính là tên file đường dẫn tới trang php cần gửi thông tin -->
        <!-- Với các dữ liệu lớn, hoặc dữ liệu nhạy cảm như mật khẩu, chúng ta sẽ gủi qua method POSTs -->
        <form action="login.php" method="POST">
            <div class="mb-3">
                <label class="form-label">Địa chỉ email</label>
                <input type="text" class="form-control" name="user_name">
            </div>
            <div class="mb-3">
                <label class="form-label">Mật khẩu</label>
                <input type="password" name="password" class="form-control">
            </div>
            <div class="form-text text-danger my-4"><?php echo $form_error ?? '' ?></div>
            <!-- Chú ý: Button phải có type submit -->
            <button type="submit" class="btn btn-primary">Đăng nhập</button>
        </form>
    </div>
    <?php include_once ("modules/footer.php"); ?>
</body>

</html>