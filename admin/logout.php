<?php
    // liên kết file kết nối 
    include('../config/constaints.php');
    // huỷ tất cả dữ liệu đã kết nối
    session_destroy();

    // chuyển đến trang login
    header('location:'.SITEURL.'admin/login.php');
?>