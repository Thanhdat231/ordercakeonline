<?php include('partials/menu.php'); ?>
    <div class="main-content">
        <div class="wrapper">
            <h1 class="heading">Update Addmin</h1>
            <br><br>

            <?php
                $id = $_GET['id'];

                $sql = "SELECT * FROM tbl_admin WHERE id=$id";

                $res = mysqli_query($conn, $sql);

                if($res == TRUE)
                {
                    //kt điều kiện có tồn tại hay không
                    $count = mysqli_num_rows($res);
                    // kt có dữ liệu hay chưa
                    if($count == 1)
                    {
                        // lấy dữ liệu
                        // echo "Tồn tại dữ liệu";
                        $row = mysqli_fetch_assoc($res);
                        $full_name = $row['full_name'];
                        $username = $row['username'];

                    }
                    else{
                        // chuyển đến trang manager-admin
                        header("location:".SITEURL.'admin/manager-admin.php');

                    }
                }
            ?>
            <form action="" method="POST">
                <table class="tbl-30">
                    <tr>
                        <td>Họ tên: </td>
                        <td><input type="text" name="full_name" value="<?php echo $full_name; ?>"></td>
                    </tr>

                    <tr>
                        <td>Tên đăng nhập: </td>
                        <td>
                            <input type="text" name="username" value="<?php echo $username; ?>">
                        </td>
                    </tr>


                    <tr>
                        <td colspan="2">
                            <input type="hidden" name="id" value="<?php echo $id; ?>">
                            <input type="submit" name="submit" value="Update Admin" class="btn-secondary">
                        </td>
                    </tr>
                </table>

            </form>
        </div>
    </div>
    <?php
        // kiểm tra điều kiện nút update
        if(isset($_POST['submit']))
        {
            // echo "đã nhấn";
            // lấy giá trị để update
            $id = $_POST['id']; 
            $full_name = $_POST['full_name'];
            $username = $_POST['username'];

            // // // tạo câu truy vấn
            $sql = "UPDATE tbl_admin SET
                full_name = '$full_name',
                username = '$username'
                WHERE id = '$id'
            ";
            // // kết nối và thực hiện truy vấn
            $res = mysqli_query($conn, $sql);

            // // kiểm tra và hiện thông báo
            if($res == TRUE)
            {
                // tạo 1 biến session để hiện message
                $_SESSION['update'] = "<div class='success'>Cập nhật thành công</div>";

                // chuyển hướng page đến trang manager-admin
                header("location:".SITEURL.'admin/manager-admin.php');
            }
            else 
            {
                // tạo 1 biến session để hiện message
                $_SESSION['update'] = "<div class='error'>Cập nhật thất bại!</div>";   
    
                // chuyển hướng page đến trang manager-admin
                header("location:".SITEURL.'admin/manager-admin.php');
            }
        }
    ?>
<?php include('partials/footer.php'); ?>