<?php include('partials/menu.php'); ?>
<div class="main-content">
    <div class="wrapper">
        <h1 class="heading">Đổi mật khẩu</h1>
        <br><br>

        <?php 
            if(isset($_GET['id']))
            {
                $id = $_GET['id'];
            }
        ?>

        <form action="" method="POST">
            <table class="tbl-30">
                <tr>
                    <td>Mật khẩu cũ: </td>
                    <td>
                        <input type="password" name="current_password" placeholder="nhập mật khẩu cũ..">
                    </td>
                </tr>

                <tr>
                    <td>Mật khẩu mới: </td>
                    <td>
                        <input type="password" name="new_password" placeholder="Nhập mật khẩu mới..">
                    </td>
                </tr>
                <tr>
                    <td>Nhập lại mật khẩu: </td>
                    <td>
                        <input type="password" name="confirm_password" placeholder="Nhập lại mật khẩu..">
                    </td>
                </tr>


                <tr>
                    <td colspan="2">
                        <input type="hidden" name="id" value="<?php echo $id; ?>">
                        <input type="submit" name="submit" value="Đổi mật khẩu" class="btn-secondary">
                    </td>
                </tr>
            </table>

        </form>

    </div>  
</div>
<?php 
    if(isset($_POST['submit']))
    {
        // echo "clicked";
        // lấy data từ form
        $id = $_POST['id'];
        $current_password = md5($_POST['current_password']);
        $new_password = md5($_POST['new_password']);
        $confirm_password = md5($_POST['confirm_password']);

        // tạo câu truy vấn
        $sql = "SELECT * FROM tbl_admin WHERE id=$id AND password='$current_password'";

        // kết nối sql và truy vấn

        $res = mysqli_query($conn, $sql);
        if($res ==  TRUE)
        {
            // kiểm tra có dữ liệu hay chưa
            $count = mysqli_num_rows($res);
            if($count == 1)
            {
                // tài khoản tồn tại và có thể đổi mật khẩu
                // echo "tìm thấy tài khoản";
                // kiểm tra 2 mật khẩu mới có giống nhau không
                if($new_password == $confirm_password)
                {
                    // cập nhật mật khẩu
                    // echo "mật khẩu trùng";
                    // tạo câu truy vấn đổi mật khẩu
                    $sql2 = "UPDATE tbl_admin SET
                        password='$new_password'
                        WHERE id=$id";
                    // kết nối truy vấn
                    $res2 = mysqli_query($conn, $sql2);

                    // kiểm tra 
                    if($res2 == TRUE)
                    {
                        // thông báo thành công
                        $_SESSION['change-pwd'] =  "<div class='success'>Đổi mật khẩu thành công :)</div>";
                        header("location:".SITEURL.'admin/manager-admin.php');
                    }
                    else{
                        // thất bại
                        $_SESSION['change-pwd'] =  "<div class='error'>Đổi mật khẩu thất bại :(</div>";
                        header("location:".SITEURL.'admin/manager-admin.php');
                    }

                }
                else{
                    // chuyển đến trang manager-admin
                    $_SESSION['pwd-not-match'] =  "<div class='error'>Mật khẩu không trùng nhau!</div>";
                    header("location:".SITEURL.'admin/manager-admin.php');
                }
            }
            else{
                // tài khoản không tồn tại ko thể đổi mật khẩu
                $_SESSION['user-not-found'] =  "<div class='error'>Mật khẩu cũ không đúng!</div>"; 
                header("location:".SITEURL.'admin/manager-admin.php');

            }
        }
    }
?>
<?php include('partials/footer.php'); ?>
