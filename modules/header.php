<header>
    <nav class="navbar navbar-expand-lg bg-body-tertiary">
        <div class="container-fluid">
            <a class="navbar-brand" href="index.php">TODO</a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse"
                data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false"
                aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarSupportedContent">
                <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                    <li class="nav-item">
                        <a class="nav-link active" aria-current="page" href="index.php">Quản lý công việc</a>
                    </li>
                </ul>
                <!-- -->
                <?php
                // Chúng ta sẽ kiểm tra xem người dùng đã đăng nhập hay chưa
                // Bằng cách kiểm tra xem session có tồn tại hay không
                // Nếu session tồn tại, hiển thị thông tin người dùng và nút đăng xuất
                // Ngược lại, hiển thị nút đăng nhập và đăng ký
                if (isset($_SESSION[$_COOKIE['session_id'] ?? false])) {
                    $user = $_SESSION[$_COOKIE['session_id']];
                    $html = "<ul class='navbar-nav mb-2 mb-lg-0'>
                        <li class='nav-item'>
                            <a class='nav-link active' aria-current='page' href='#'>Xin chào, {$user['full_name']}</a>
                        </li>
                        <li class='nav-item'>
                            <a class='nav-link text-danger' href='logout.php'>Đăng xuất</a>
                        </li>
                    </ul>";
                    echo $html;
                } else {
                    $html = "<ul class='navbar-nav mb-2 mb-lg-0'>
                        <li class='nav-item'>
                            <a class='nav-link active' aria-current='page' href='login.php'>Đăng nhập</a>
                        </li>
                        <li class='nav-item'>
                            <a class='nav-link' href='signup.php'>Đăng ký</a>
                        </li>
                    </ul>";
                    echo $html;
                }
                ?>
            </div>
        </div>
    </nav>
</header>