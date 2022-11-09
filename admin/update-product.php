<?php include('partials/menu.php'); ?>
<?php
    // kiểm tra id có hoặc không
    if(isset($_GET['id']))
    {
        // lấy tất cả dữ liệu
        $id = $_GET['id'];
        // tạo câu sql để truy vấn sản phẩm
        $sql2 = "SELECT * FROM tbl_products WHERE id=$id";
        // truy vấn
        $res2 = mysqli_query($conn, $sql2);
        // lấy dữ liệu truy vấn dc
        $row2 = mysqli_fetch_assoc($res2);

        // lấy dữ liệu lưu vào biến
        $title = $row2['title'];
        $description = $row2['description'];
        $price = $row2['price'];
        $current_image = $row2['image_name'];
        $current_category = $row2['category_id'];
        $featured = $row2['featured'];
        $active = $row2['active'];
    }
    else
    {
        // chuyển hướng trang nếu không có
        header('location:'.SITEURL.'admin/manager-product.php');
    }

?>
    <div class="main-content">
        <div class="wrapper">
            <h1 class="heading">Update Product</h1>
            <br><br>

            <form action="" method="POST" enctype="multipart/form-data">
                <table class="tbl-30">
                    <tr>
                        <td>Tên bánh: </td>
                        <td>
                            <input type="text" name="title" value="<?php echo $title; ?>">
                        </td>
                    </tr>
                    <tr>
                        <td>Mô tả: </td>
                        <td>
                            <textarea name="description" id="" cols="30" rows="5"><?php echo $description; ?></textarea>
                        </td>
                    </tr> 
                    <tr>
                        <td>Giá: </td>
                        <td>
                            <input type="number" name="price" value="<?php echo $price; ?>">
                        </td>
                    </tr>
                    <tr>
                        <td>Ảnh hiện tại: </td>
                        <td>
                            <?php
                                if($current_image == "")
                                {
                                    echo "<div class='error'>Chưa có ảnh.</div>";
                                }
                                else
                                {
                                    ?>
                                        <img src="<?php echo SITEURL;?>images/cakes/<?php echo $current_image; ?>" width="95px">
                                    <?php
                                }
                            ?>
                        </td>
                    </tr>
                    <tr>
                        <td>Chọn ảnh mới: </td>
                        <td>
                            <input type="file" name="image">
                        </td> 
                    </tr>
                    <tr>
                        <td>Loại bánh: </td>
                        <td>
                            <select name="category">
                                <?php
                                    // liên kết khoá ngoại với bảng danh mục để lấy giá trị
                                    $sql = "SELECT * FROM tbl_category WHERE featured='Còn hàng'";
                                    // truy vấn
                                    $res = mysqli_query($conn, $sql);
                                    // đếm các trường lấy dc
                                    $count = mysqli_num_rows($res);
                                    // kiểm tra có danh mục hay khog6
                                    if($count > 0)
                                    {
                                        while($row=mysqli_fetch_assoc($res))
                                        {
                                            // lấy id với tên loại 
                                            $category_title = $row['title'];
                                            $category_id = $row['id'];
                                            // cách 1 không thể sử dụng vì nó không tự điền dữ liệu vào trong combobox
                                            //echo "<option value='$category_id'>$category_title</option>";
                                            // cách  tự điền vào combobox
                                            ?>
                                                <option <?php if($current_category == $category_id) {echo "selected";} ?> value="<?php echo $category_id; ?>"><?php echo $category_title; ?></option>
                                                
                                            <?php
                                        }

                                    }
                                    else
                                    {
                                        echo "<option value='0'>Không tìm thấy loại bánh!</option>";
                                    }

                                ?>
                                
                            </select>
                        </td>
                    </tr>
                    <tr>
                        <td>Tình trạng: </td>
                        <td>
                            <input <?php if($featured == "Còn hàng") {echo "checked";} ?> type="radio" name="featured" value="Còn hàng"> Còn hàng
                            <input <?php if($featured == "Hêt hàng") {echo "checked";} ?> type="radio" name="featured" value="Hết hàng"> Hết hàng

                        </td>
                    </tr>
                    <tr>
                        <td>Size: </td>
                        <td>
                            <input <?php if($active == "Nhỏ") {echo "checked";} ?> type="radio" name="active" value="Nhỏ"> Nhỏ
                            <input <?php if($active == "Lớn") {echo "checked";} ?> type="radio" name="active" value="Lớn"> Lớn
                        </td>
                    </tr>
                    <tr>
                        <td >
                            <input type="hidden" name="id" value="<?php echo $id; ?>">
                            <input type="hidden" name="current_image" value="<?php echo $current_image; ?>">
                            <input type="submit" name="submit" value="Cập Nhật" class="btn-secondary">
                        </td>
                    </tr>   
                </table>

            </form>
            <?php
                if(isset($_POST['submit']))
                {
                    // echo "Clicked";
                    // 1. lấy tất cả các giá trị có trong form
                    $id = $_POST['id'];
                    $title = $_POST['title'];
                    $description = $_POST['description'];
                    $price = $_POST['price'];
                    $current_image = $_POST['current_image'];
                    $category = $_POST['category'];
                    $featured = $_POST['featured'];
                    $active = $_POST['active'];

                    // $image_name = $_FILES['image']['name'];
                    // echo $image_name;
                    // die();

                    // $check = getimagesize($_FILES["image"]["name"]);
                    // if($check !== false) {
                    //   echo "File is an image - " . $check["mime"] . ".";
                    //   $uploadOk = 1;
                    // } else {
                    //   echo "File is not an image.";
                    //   $uploadOk = 0;
                    // }

                    //2. tải ảnh lên nếu có update ảnh
                        // kiểm tra button tải ảnh có dc nhấn hay chưa
                    if(isset($_FILES['image']['name']))
                    {
                        $image_name = $_FILES['image']['name']; //name : tên gốc (ban đầu) của file.
                        
                        // kiểm tra ảnh có lấy dc hay chưa
                        if($image_name != "")
                        {
                            // A. Tải lên ảnh mới
                            $ext = end(explode('.',$image_name)); // lấy phần đuôi của ảnh
                            $image_name = "Cake-num-".rand(0000, 9999).'.'.$ext; // đổi tên ảnh
                            // láy đường dẫn nguồn và vị trí lưu ảnh
                            $src_path = $_FILES['image']['tmp_name']; //tmp_name : nơi lưu tạm file upload lên  nếu muốn di 
                            //chuyển nó ra khỏi thư mục tạm dùng hàm move_uploaded_file.
                            
                            $dest_path = "../images/cakes/".$image_name;
                            // tải ảnh lên
                            $upload = move_uploaded_file($src_path, $dest_path);
                            // kiểm tra ảnh up có thành công hay không 
                            if($upload == FALSE)
                            {
                                $_SESSION['upload'] = "<div class='error'>Tải ảnh thất bại!</div>";
                                header('location:'.SITEURL.'admin/manager-product.php');
                                // dừng tiến trình
                                die();
                            }
                            // 3. xoá ảnh hiện tại nếu có ảnh mới dc cập nhật
                            // B. xoá ảnh cũ nếu có
                            if($current_image !="")
                            {
                                // xoá ảnh 
                                $remove_path = "../images/cakes/".$current_image;
                                $remove = unlink($remove_path);
                                if($upload == FALSE)
                                {
                                    $_SESSION['remove-failed'] = "<div class='error'>Xoá ảnh hiện tại thất bại!</div>";
                                    header('location:'.SITEURL.'admin/manager-product.php');
                                    // dừng tiến trình
                                    die();
                                }
                            }
            
                        }
                        else
                        {
                            $image_name = $current_image;
                        }
                    }
                    else
                    {
                        $image_name = $current_image;
                      
                    }
                    
                    // 4. cập nhật vào database

                        // tạo câu truy vấn
                    $sql3 = "UPDATE tbl_products SET
                        title='$title',
                        description = '$description',
                        price = $price,
                        image_name = '$image_name',
                        category_id = $category,
                        featured = '$featured',
                        active = '$active'
                        WHERE id=$id
                    ";
                    // echo $sql3;

                    // //truy vấn
                    $res3 = mysqli_query($conn, $sql3);

                    // kiểm tra truy vấn dc hay không 
                    // 5. chuyển hướng trang
                    if($res3 == TRUE)
                    {
                        $_SESSION['update'] = "<div class='success'>Cập nhật thành công.</div>";
                        header('location:'.SITEURL.'admin/manager-product.php');
                    }
                    else
                    {
                        $_SESSION['update'] = "<div class='error'>Cập nhật không thành công.</div>";
                        header('location:'.SITEURL.'admin/manager-product.php');
                    }

                    
                }
            ?>

        </div>
    </div>
<?php include('partials/footer.php'); ?>