<?php
    include('../config/constaints.php');

    if(isset($_GET['id']) && isset($_GET['image_name']))
    {
        // thực hiện xoá
        // lấy id và image name
        $id = $_GET['id'];
        $image_name = $_GET['image_name'];

        // kiểm tra có ảnh hay không
        if($image_name != "")
        {
            // nếu có ảnh thì xoá ảnh khỏi folder
            $path = "../images/cakes/".$image_name;

            // xoá ảnh từ folder
            $remove = unlink($path);

            // nếu xoá thất bại thì dừng tiến trình và hiện thông báo
            if($remove == false)
            {
                // hiện thông báo
                $_SESSION['remove'] = "<div class='error'>Xoá thất bại!</div>";
                // chuyển hướng trang
                header("location:".SITEURL.'admin/manager-product.php');
                // dừng tiến trình
                die();
            }

            $sql = "DELETE FROM tbl_products WHERE id=$id";
            $res = mysqli_query($conn, $sql);

            if($res == TRUE)
            {
                // echo "Xoá thành công";
        
                // tạo biến thông báo
                $_SESSION['delete'] = "<div class='success'>Xoá thành công!</div>";
                header("location:".SITEURL.'admin/manager-product.php');
    
            }
            else
            {
                // echo "Thất bại";
        
                $_SESSION['delete'] = "<div class='error'>Xoá thất bại!</div>";
                header("location:".SITEURL.'admin/manager-category.php');
            }

        }
    }
    else
    {
        // không tìm thấy id và địa chỉ ảnh -> về trang chủ
        $_SESSION['unauthorize'] = "<div class='error'>Không tìm thấy địa chỉ!</div>";
        header('location:'.SITEURL.'admin/manager-product.php');
    }
?>