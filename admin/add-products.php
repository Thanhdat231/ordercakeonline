<?php include('partials/menu.php'); ?>
    <div class="main-content">
        <div class="wrapper">
            <h1 class="heading">Thêm Bánh</h1>
            <br><br>
            <?php
                if(isset($_SESSION['upload']))
                {
                    echo $_SESSION['upload']; // hiện thông báo
                    unset($_SESSION['upload']); // xoá thông báo
                }
            ?>
            <form action="" method="POST" enctype="multipart/form-data">
                <table class="tbl-30">
                    <tr>
                        <td>Tên bánh: </td>
                        <td>
                            <input type="text" name="title" placeholder="Tên bánh...">
                        </td>

                    </tr>
                    <tr>
                        <td>Mô tả: </td>
                        <td>
                            <textarea name="description" id="" cols="30" rows="5" placeholder="Mô tả bánh của bạn..."></textarea>
                        </td>
                    </tr>
                    <tr>
                        <td>Giá bán: </td>
                        <td>
                            <input type="number" name="price">
                        </td>
                    </tr>

                    <tr>
                        <td>Chọn ảnh: </td>
                        <td>
                            <input type="file" name="image">
                        </td>
                    </tr>
                    <tr>
                        <td>Loại bánh: </td>
                        <td>
                            <select name="category">
                                <!-- tạo code php để hiển thị danh mục từ bảng category trong database -->
                                <?php
                                    $sql = "SELECT * FROM tbl_category WHERE featured='Còn hàng'";

                                    // truy vấn
                                    $res = mysqli_query($conn, $sql);
                                    // kiểm tra dữ liệu
                                    $count = mysqli_num_rows($res);
                                    // nếu biến count lớn hơn 0 thì có danh mục ngược lại chưa có
                                    if($count > 0)
                                    {
                                        while($row=mysqli_fetch_assoc($res))
                                        {
                                            $id = $row['id'];
                                            $title = $row['title'];
                                            ?>
                                                <option value="<?php echo $id; ?>"><?php echo $title; ?></option>
                                                
                                            <?php
                                        }

                                    }
                                    else
                                    {
                                        ?>
                                            <option value="0">Không tìm thấy loại bánh</option>
                                        <?php
                                    }

                                ?>

                            </select>
                        </td>
                    </tr>
                    <tr>
                        <td>Tình trạng: </td>
                        <td>
                            <input type="radio" name="featured" value="Còn hàng"> Còn hàng
                            <input type="radio" name="featured" value="Hết hàng"> Hết hàng

                        </td>
                    </tr>
                    <tr>
                        <td>Size: </td>
                        <td>
                            <input type="radio" name="active" value="Nhỏ"> Nhỏ
                            <input type="radio" name="active" value="Lớn"> Lớn
                        </td>
                    </tr>
                    <tr>
                        <td colspan="2">
                            <input type="submit" name="submit" value="Thêm Bánh" class="btn-secondary">
                        </td>
                    </tr>
                </table>

            </form>

            <!-- Khi nhấn nút thêm -->
            <?php
                if(isset($_POST['submit']))
                {
                    // echo "clicked";
                    // echo "clicked";
                    // lấy dữ liệu từ form
                    $title = $_POST['title'];
                    $description = $_POST['description'];
                    $price = $_POST['price'];
                    $category = $_POST['category'];

                    // kiểm tra buton radio
                    if(isset($_POST['featured']))
                    {
                        $featured = $_POST['featured'];
                    }
                    else
                    {
                        $featured = "Hết hàng";
                    }
                    if(isset($_POST['active']))
                    {
                        $active = $_POST['active'];
                    }
                    else
                    {
                        $active = "Nhỏ";
                    }
                     
                    if(isset($_FILES['image']['name']))
                    {
                        $image_name = $_FILES['image']['name'];

                        if($image_name!="")
                        {
                            $image_info = explode('.', $image_name);
                            $ext = end($image_info);

                            $image_name = "Cake-num-".rand(0000,9999).".".$ext;
                            
                            $src = $_FILES['image']['tmp_name'];

                            $dst = "../images/cakes/".$image_name;

                            $upload = move_uploaded_file($src, $dst);

                            if($upload==false)
                            {
                                $_SESSION['upload'] = "<div class='error'>Tải ảnh thất bại.</div>";
                                header('location:'.SITEURL.'admin/add-products.php' );

                                die();
                            }
                        }
                    }
                    else
                    {
                        $image_name = "";
                    }

                    $sql2 = "INSERT INTO tbl_products SET
                        title = '$title',
                        description = '$description',
                        price = '$price',
                        image_name = '$image_name',
                        category_id = $category, 
                        featured = '$featured',
                        active = '$active'
                    ";

                    $res2 = mysqli_query($conn, $sql2);

                    if($res == true)
                    {
                        $_SESSION['add'] = "<div class='success'>Thêm thành công.</div>";
                        header('location:'.SITEURL.'admin/manager-product.php');
                    }
                    else
                    {
                        $_SESSION['add'] = "<div class='error'>Không thêm được! </div>";
                        header('location:'.SITEURL.'admin/manager-product.php');
                    }

                }
            ?>
        </div>
    </div>
<?php include('partials/footer.php'); ?> 
