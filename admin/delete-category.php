 <?php 
    // include file kết nối
    include('../config/constaints.php');



    // kiểm tra id và đường dẫn ảnh có hay không
    if(isset($_GET['id']) AND isset($_GET['image_name']))
    {
        // lấy dữ liệu và xoá
        // echo "lấy dữ liệu thành công";
        $id = $_GET['id']; // hàm lấy giá trị 
        $image_name = $_GET['image_name'];
        if($image_name != "")
        {
            // có ảnh, lấy đường dẫn và xoá
            $path = "../images/category/".$image_name;
            // xoá hình
            $remove = unlink($path);

            // nếu xoá thất bại thì dừng tiến trình và hiện thông báo
            if($remove == false)
            {
                // hiện thông báo
                $_SESSION['remove'] = "<div class='error'>Xoá thất bại!</div>";
                // chuyển hướng trang
                header("location:".SITEURL.'admin/manager-category.php');
                // dừng tiến trình
                die();
            }
        }
        $sql = "DELETE FROM tbl_category WHERE id=$id";
        $res = mysqli_query($conn, $sql);

        if($res == TRUE)
        {
            // echo "Xoá thành công";
    
            // tạo biến thông báo
            $_SESSION['delete'] = "<div class='success'>Xoá thành công!</div>";
            header("location:".SITEURL.'admin/manager-category.php');
    
        }
        else
        {
            // echo "Thất bại";
    
            $_SESSION['delete'] = "<div class='error'>Xoá thất bại!</div>";
            header("location:".SITEURL.'admin/manager-category.php');
        }
        
    }
    else
    {
        // chuyển hướng trang 
        header("location:".SITEURL.'admin/manager-category.php');

    }



    
 ?>