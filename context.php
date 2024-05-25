<?php
// Nạp file cấu hình để sử dụng các hằng số
require_once ("./config.php");
class Context
{
    // Class này sẽ thực hiện các thao tác với cơ sở dữ liệu
    private $connection;
    public function __construct()
    {
        // Khi khởi tạo đối tượng Context, chúng ta sẽ kết nối tới cơ sở dữ liệu
        // Các tham số kết nối sẽ lấy từ file config.php
        $this->connection = new mysqli(DB_HOST, DB_USER, DB_PASSWORD, DB_NAME, DB_PORT);
    }
    // Sử dụng phương thức này để thực hiện các câu lệnh SQL
    public function execute_query($query)
    {
        // Sử dụng try...catch để bắt lỗi
        try {
            // Thực thi câu lệnh SQL và trả về kết quả
            $result = $this->connection->query($query);
            return $result;
        } catch (Exception $e) {
            // Nếu có lỗi, in ra thông báo lỗi
            echo $e->getMessage();
            return null;
        }
    }
    public function __destruct()
    {
        //Đóng kết nối cơ sở dữ liệu
        $this->connection->close();
    }
}
?>