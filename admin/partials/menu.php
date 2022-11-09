
<?php 
    include('../config/constaints.php'); 
    include('login-check.php');

?>


<html>
    <head>
        <title>Cake Order Website - Home Page</title>
        <link rel ="stylesheet" href = "..\css\admin.css">
    </head>
    <body>
        <!-- phần menu bắt đầu -->
        <div class="menu">
            <div class="wrapper">
                <ul>
                    <li><a href="index.php">Trang chủ</a></li>
                    <li><a href="manager-admin.php">Admin</a></li>
                    <li><a href="manager-category.php">Danh mục</a></li>
                    <li><a href="manager-product.php">Sản phẩm</a></li>
                    <li><a href="manager-order.php">Đơn hàng</a></li>
                    <li><a href="logout.php">Đăng xuất</a></li>
                </ul>
            </div>
        </div>
        <!-- phần menu kết thúc -->