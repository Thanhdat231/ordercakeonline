<?php
    // include file kết nối constaints.php
    include('../config/constaints.php');

    // 1. lấy id để thực hiện xoá
    $id = $_GET['id']; // hàm lấy giá trị 

    //2. tạo câu truy vấn để xoá
    $sql = "DELETE FROM tbl_admin WHERE id=$id";
    // 3. thực hiện truy vấn
    $res = mysqli_query($conn, $sql);

    // 4. kiểm tra truy vấn
    if($res == TRUE)
    {
        // echo "Xoá thành công";

        // tạo biến thông báo
        $_SESSION['delete'] = "<div class='success'>Xoá thành công!</div>";
        header("location:".SITEURL.'admin/manager-admin.php');

    }
    else
    {
        // echo "Thất bại";

        $_SESSION['delete'] = "<div class='error'>Xoá thất bại!</div>";
        header("location:".SITEURL.'admin/manager-admin.php');
    }

?>