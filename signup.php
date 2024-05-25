<!DOCTYPE html>
<html lang="en">
<?php
$title = "Đăng ký tài khoản";
include_once "modules/plugin.php";
?>
<?php
include_once 'context.php';
$form_error = '';
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Lấy thông tin từ form người dùng gửi lên
    // Sử dụng biến toàn cục $_POST và lấy giá trị của các trường thông qua thuộc tính name của form
    $user_name = $_POST['user_name'];
    $full_name = $_POST['full_name'];
    $origin_password = $_POST['password'];
    $re_password = $_POST['re_password'];
    $context = new Context();
    try {
        if ($origin_password != $re_password) {
            throw new Exception("Mật khẩu không trùng khớp");
        }
        // Mã hóa mật khẩu trước khi lưu vào cơ sở dữ liệu
        $secure_password = password_hash($origin_password, PASSWORD_DEFAULT);
        // Câu lệnh SQL để thêm dữ liệu người dùng vào bảng users
        $query = "INSERT INTO users (user_name, full_name, password_hash) VALUES ('{$user_name}', '{$full_name}', '{$secure_password}')";
        $result = $context->execute_query($query);
        // Nếu kết quả thực thi câu lệnh trả về true, chuyển hướng người dùng về trang đăng nhập
        if ($result) {
            header('Location: login.php');
        } else {
            throw new Exception("Đăng ký tài khoản không thành công");
        }
    } catch (Exception $e) {
        // Nếu có lỗi, gán thông báo lỗi vào biến $form_error và hiển thị lên form
        $form_error = $e->getMessage();
    }
}
?>

<body>
    <div class="container-lg mt-4">
        <h1 class="text-center">Đăng ký tài khoản</h1>
        <form action="signup.php" method="POST">
            <div class="mb-3">
                <label for="exampleInputEmail1" class="form-label">Tên đăng nhập</label>
                <input type="text" class="form-control" name="user_name">
            </div>
            <div class="mb-3">
                <label for="exampleInputEmail1" class="form-label">Tên đầy đủ</label>
                <input type="text" class="form-control" name="full_name">
            </div>
            <div class="mb-3">
                <label for="exampleInputPassword1" class="form-label">Mật khẩu</label>
                <input type="password" name="password" class="form-control">
            </div>
            <div class="mb-3">
                <label for="exampleInputPassword1" class="form-label">Nhập lại mật khẩu</label>
                <input type="password" name="re_password" class="form-control">
            </div>
            <div class="form-text text-danger my-4"><?php echo $form_error ?? '' ?></div>
            <button type="submit" class="btn btn-primary">Đăng ký tài khoản</button>
        </form>
    </div>
    <?php include_once ("modules/footer.php"); ?>
</body>

</html>