<?php
    // phân quyền và kiểm soát truy cập

    //kt người dùng đăng nhập chưa
    if(!isset($_SESSION['user'])) // nếu biến user chưa thiết lập
    {
        // user chưa đăng nhập
        // chuyển hướng đến trang login với thông báo
        $_SESSION['no-login-message'] = "<div class='error'>Vui lòng đăng nhập để truy cập.</div>";
        header('location:'.SITEURL.'admin/login.php');
        
    }
?>