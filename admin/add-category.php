<?php include('partials/menu.php'); ?>

<div class="main-content">
    <div class="wrapper">
        <h1 class="heading">Add Category</h1>
        <br><br> 

        <?php
            if(isset($_SESSION['add']))
            {
                echo $_SESSION['add']; // hiện thông báo
                unset($_SESSION['add']); // xoá thông báo
            }
            // thông báo tải ảnh
            if(isset($_SESSION['upload']))
            {
                echo $_SESSION['upload']; // hiện thông báo
                unset($_SESSION['upload']); // xoá thông báo
            }
        ?> 
        <br><br>

        <form action="" method="POST" enctype="multipart/form-data">
            <table class="tbl-30">
                <tr>
                    <td>Mô tả: </td>
                    <td><input type="text" name="title" placeholder="Mô tả sản phẩm"></td>
                </tr>

                <tr>
                    <td>Tình trạng: </td>
                    <td>
                        <input type="radio" name="featured" value="Còn hàng"> Còn hàng
                        <input type="radio" name="featured" value="Hết hàng"> Hết hàng
                    </td>
                </tr>

                <tr>
                    <td>Select Image: </td>
                    <td>
                        <input type="file" name="image">
                    </td>
                </tr>

                <tr>
                    <td>Kích thước: </td>
                    <td>
                        <input type="radio" name="active" value="Nhỏ">Nhỏ
                        <input type="radio" name="active" value="Lớn">Lớn
                    </td>
                </tr>

                <tr>
                    <td colspan="2">
                        <input type="submit" name="submit" value="Add Category" class="btn-secondary">
                    </td>
                </tr>
            </table>

        </form>
        <!-- Hết phần thêm sản phẩm -->

        <?php 
            if(isset($_POST['submit']))
            {
                // echo "clicked";
                // 1. lấy dữ liệu từ form
                $title = $_POST['title'];
                // lấy dữ liệu từ radio btn, kt button có chọn hay ko
                if(isset($_POST['featured']))
                {
                    // lấy dl
                    $featured = $_POST['featured']; 
                }
                else{
                    $featured = "Hết hàng";
                }

                if(isset($_POST['active']))
                {
                    // lấy dl
                    $active = $_POST['active']; 
                }
                else{
                    $active = "Nhỏ";
                }

                // // kiểm tra ảnh có chọn hay chưa và đường dẫn của ảnh
                // print_r($_FILES['image']);
                // die(); // ngắt code

                if(isset($_FILES['image']['name']))
                {
                    // tải ảnh lên
                    // để tải lên ảnh lên cần tên ảnh, đường dẫn
                    $image_name = $_FILES['image']['name'];

                    //vẫn thêm nếu không chọn ảnh
                    if($image_name != "")
                    {

                        // tự động đổi tên ảnh
                        // chỉ tải lên ảnh có đuôi jpg, png, gif, etc ví dụ anhbanh.png
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
                            header('location:'.SITEURL.'admin/add-category.php');
                            // dừng tiến trình
                            die();
    
                        }
                    }


                }
                else
                {

                    $image_name = "";
                }

                //2. tạo câu truy vấn để thêm vào database
                $sql = "INSERT INTO tbl_category SET
                    title='$title',
                    image_name='$image_name',
                    featured='$featured',
                    active='$active'
                ";

                $res = mysqli_query($conn, $sql);
                // 4. kiểm tra đã thêm thành công hay không
                if($res==TRUE)
                {
                    $_SESSION['add'] = "<div class='success'>Thêm thành công.</div>";
                    // chuyển hướng trang
                    header('location:'.SITEURL.'admin/manager-category.php');
                }
                else
                {
                    $_SESSION['add'] = "<div class='error'>Thêm thất bại.</div>";
                    // chuyển hướng trang
                    header('location:'.SITEURL.'admin/add-category.php');
                }
            }
        ?>
    </div>
</div>
<?php include('partials/footer.php'); ?> 