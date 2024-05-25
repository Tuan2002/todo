<?php
// Path: modules/plugin.php
// Khởi tạo session
session_start();
?>

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo $title ?? "Học lập trình PHP" ?></title>
    <!-- Thêm các file css và js vào trang web -->
    <link rel="stylesheet" href="assets/vendor/bootstrap/css/bootstrap.min.css">
    <link rel="stylesheet" href="assets/css/style.css">
    <script defer type="text/javascript" src="assets/vendor/bootstrap/js/bootstrap.min.js"></script>
    <script defer type="text/javascript" src="assets/js/script.js"></script>
</head>