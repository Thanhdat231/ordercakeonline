<?php 
    // start session (phiên bắt đầu)
    ob_start();
    session_start();

    // đặt các biến chứa localhoast, root, mật khẩu, tên CSDL của phpAdmin
    define('SITEURL', 'http://localhost:8888/DoAnWeb/');
    define('LOCALHOST', 'localhost');
    define('DB_USERNAME', 'root');
    define('DB_PASSWORD', '');
    define('DB_NAME', 'cakestore');

    // 3. thực hiện kết nối với mysql (execute query) và lưu vào database
    $conn = mysqli_connect(LOCALHOST, DB_USERNAME, DB_PASSWORD) or die (mysqli_error()); // tạo chuỗi kết nối sql
    $db_select = mysqli_select_db($conn, DB_NAME) or die (mysqli_error()); // chọn cơ sở dữ liệu

?>