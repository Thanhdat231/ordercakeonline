<?php include('partials/menu.php'); ?>
<div class="main-content">
    <div class="wrapper">
        <h1 class="heading">Update Category</h1>
        <br><br>

        <?php
            if(isset($_GET['id']))
            {
                // echo "getting data";

                $id = $_GET['id'];
                $sql = "SELECT * FROM tbl_category WHERE id=$id";
                $res = mysqli_query($conn, $sql);
                $count = mysqli_num_rows($res);
                if($count == 1)
                {
                    // lấy tất cả dữ liệu
                    $row = mysqli_fetch_assoc($res);
                    $title = $row['title'];
                    $current_image = $row['image_name'];
                    $featured = $row['featured'];
                    $active = $row['active'];
                }
                else
                {
                    // chuyển về trang quản lý và hiện thông báo lỗi
                    $_SESSION['no-category-found'] = "<div class='error'>Không tìm thấy danh mục này.</div>";
                    header('location:'.SITEURL.'admin/manager-category.php');


                }
            }
            else
            {
                header("location:".SITEURL.'admin/manager-category.php');
            }
        ?>

        <form action="" method="POST" enctype="multipart/form-data">
            <table class="tbl-30">
                <tr>
                    <td>Tên loại: </td>
                    <td>
                        <input type="text" name="title" value="<?php echo $title; ?>">
                    </td>
                </tr>
                <tr>
                        <td>Ảnh hiện tại: </td>
                        <td>
                        <?php
                                if($current_image != "")
                                {
                                    ?>
                                        <img src="<?php echo SITEURL; ?>images/category/<?php echo $current_image; ?>" width="150px">
                                    <?php
                                }
                                else
                                {
                                    echo "<div class='error'>Chưa thêm ảnh.</div>";
                                }
                            ?>
                        </td>
                </tr>
                <tr>
                    <td>
                            Ảnh mới:
                    </td>
                    <td>
                            <input type="file" name="image">
                    </td>
                </tr>
                <tr>
                    <td>Trạng thái: </td>
                    <td>
                            <input <?php if($featured == "Yes"){echo "checked";} ?> type="radio" name="featured" value="Còn hàng">Còn hàng
                            <input <?php if($featured == "No"){echo "checked";} ?> type="radio" name="featured" value="Hết hàng">Hết hàng
                    </td>
                </tr>
                <tr>
                    <td>Size: </td>
                    <td>
                            <input <?php if($active == "Nhỏ"){echo "checked";} ?> type="radio" name="active" value="Nhỏ">Nhỏ
                            <input <?php if($active == "Lớn"){echo "checked";} ?> type="radio" name="active" value="Lớn">Lớn

                    </td>
                </tr>
                <tr>
                    <td>
                        <input type="hidden" name="current_image" value="<?php echo $current_image; ?>">
                        <input type="hidden" name="id" value="<?php echo $id; ?>">
                        <input type="submit" name="submit" value="Update Catgory" class="btn-secondary">
                        

                    </td>
                </tr>
            </table>
        </form>

        <?php
                if(isset($_POST['submit']))
                {
                    
                    // echo "cliked";
                    $id = $_POST['id'];
                    $title = $_POST['title'];
                    $current_image = $_POST['current_image'];
                    $featured = $_POST['featured'];
                    $active = $_POST['active'];

                    if(isset($_FILES['image']['name']))
                    {
                        $image_name = $_FILES['image']['name'];
                        
                        if($image_name != "")
                        {
                            $ext = end(explode('.', $image_name));
    
                            // đổi tên anhbanh.png thành Cake_category_123.png
                            $image_name = "Cake_Category_".rand(000, 999).'.'.$ext;
        
                            // lấy đường dẫn
                            $source_path = $_FILES['image']['tmp_name'];
                            $destination_path = "../images/category/".$image_name;
                                            
                            // bước cuối up ảnh lên
                            $upload = move_uploaded_file($source_path, $destination_path);
        
                            // kiểm tra ảnh đã dc up chưa
                            // nếu up thất bại thì dừng quá trình up và hiện thông báo lỗi
                            if($upload == false)
                            {
                                $_SESSION['upload'] = "<div class='error'>Tải ảnh lên không thành công.</div>";
                                // chuyển trang
                                header('location:'.SITEURL.'admin/manager-category.php');
                                // dừng tiến trình
                                die();
        
                            }

                            // xoá ảnh hiện tại nếu nó tồn tại
                            if($current_image != "")
                            {
                                $remove_path = "../images/category".$current_image;
                                $remove = unlink($remove_path);
                                //kiểm tra ảnh xoá được hay không
                                if($remove == false)
                                { 
                                    // xoá thất bại
                                    $_SESSION['failed-remove'] = "<div class='error'>Xoá ảnh hiện tại không thành công.</div>";
                                    header('location:'.SITEURL.'admin/manager-category.php');
                                    die();
                                }

                            }

                        }
                        else
                        {

                        }
                
                    }
                    else{
                        $image_name = $current_image;
                    }


                    $sql2 = "UPDATE tbl_category SET
                        title = '$title',
                        image_name = '$image_name',
                        featured = '$featured',
                        active = '$active'
                        WHERE id=$id
                    ";
                    // echo $sql2;
                    $res2 = mysqli_query($conn, $sql2);
                    if($res2 == true)
                    {
                        $_SESSION['update'] = "<div class='success'>Cập nhật thành công.</div>";
                        header('location:'.SITEURL.'admin/manager-category.php');
                    }
                    else
                    {
                        $_SESSION['update'] = "<div class='error'>Cập nhật không thất bại.</div>";
                        header('location:'.SITEURL.'admin/manager-category.php');
                    }

                }

            ?> 
    </div>
</div>
<?php include('partials/footer.php'); ?>
