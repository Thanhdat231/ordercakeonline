<?php include('partials/menu.php'); ?>
<div class="main-content">
    <div class="wrapper">
        <h1 class="heading">Add Admin</h1>
        <br><br> 

        <?php
            if(isset($_SESSION['add']))
            {
                echo $_SESSION['add']; // hiện thông báo
                        unset($_SESSION['add']); // xoá thông báo
            }
        ?>


        <form action="" method="POST">
            <table class="tbl-30">
                <tr>
                    <td>Họ tên: </td>
                    <td><input type="text" name="full_name" placeholder="Nhập họ tên"></td>
                </tr>

                <tr>
                    <td>Tên đăng nhập: </td>
                    <td><input type="text" name="username" placeholder="Tên đăng nhập.."></td>
                </tr>

                <tr>
                    <td>Mật khẩu: </td>
                    <td><input type="password" name="password" placeholder="Mật khẩu.."></td>
                </tr>

                <tr>
                    <td colspan="2">
                        <input type="submit" name="submit" value="Add Admin" class="btn-secondary">
                    </td>
                </tr>
            </table>

        </form>
    </div>
</div>

<?php include('partials/footer.php'); ?>

<?php
    // quá trình lấy dữ liệu từ form lưu vào database

    // kiểm tra button có nhấn hay không

    if(isset($_POST['submit'])) // hàm isset kt biến có tồn tại hay không
    {
        // button submit đã nhấn
        // 1. lấy data từ form
        $full_name = $_POST['full_name'];
        $username = $_POST['username'];
        $password =md5($_POST['password']); // mã hoá mật khẩu

        // 2. truy vấn SQL để lưu data vào database
        $sql = "INSERT INTO tbl_admin SET
            full_name = '$full_name',
            username = '$username',
            password = '$password'
        ";
        
        // 3. Qua file config -> constants.php 
        // 4. tiến hành truy vấn với database
        $res = mysqli_query($conn, $sql) or die (mysqli_error());

        // 5. kiểm tra truy vấn dữ liệu có thành công hay không
        if($res == TRUE)
        {
            // tạo 1 biến session để hiện message
            $_SESSION['add'] = "<div class='success'>Thêm thành công!</div>";

            // chuyển hướng page đến trang manager-admin
            header("location:".SITEURL.'admin/manager-admin.php');
        }
        else 
        {
            // tạo 1 biến session để hiện message
            $_SESSION['add'] = "<div class='error'>Thêm thất bại!</div>";   

            // chuyển hướng page đến trang manager-admin
            header("location:".SITEURL.'admin/add-admin.php');
        }
    }
?>