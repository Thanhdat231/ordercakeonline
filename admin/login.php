<?php include('../config/constaints.php'); ?>
<html>
    <head>
        <title>Login - Food Order System</title>
        <link rel="stylesheet" href="../css/login.css">
    </head>
    <body>
       <div class="wrapper">

           <div class="login-page">
             <div class="form">
               <h1>ĐĂNG NHẬP</h1>
               <!-- <form class="register-form" method="POST">
                 <input type="text" placeholder="name"/>
                 <input type="password" placeholder="password"/>
                 <input type="text" placeholder="email address"/>
                 <button>create</button>
                 <p class="message">Already registered? <a href="#">Sign In</a></p>
               </form> -->
               <form class="login-form" method="POST">
                 <input type="text" name="username" placeholder="username"/>
                 <input type="password" name="password" placeholder="password"/>
                 <button type="submit" name="submit">login</button>
                 <br><br>
                 <?php
                   if(isset($_SESSION['login']))
                   {
                       echo $_SESSION['login']; // hiện thông báo
                       unset($_SESSION['login']); // xoá thông báo
                   }

                   if(isset($_SESSION['no-login-message']))
                   {
                       echo $_SESSION['no-login-message']; // hiện thông báo
                       unset($_SESSION['no-login-message']); // xoá thông báo
                   }
                 ?>
               </form>
             </div>
           </div>
       </div> 

    </body>
</html>
<?php
// kiểm tra nút dc nhấn hay chưa
    if(isset($_POST['submit']))
    {
        // thực hiện đăng nhập
        // 1. lấy dữ liệu từ form
        $username = $_POST['username'];
        $password = md5($_POST['password']); 
        // tạo câu truy vấn kiểm tra có tài khoản hay chưa
        $sql = "SELECT * FROM tbl_admin WHERE username='$username' AND password='$password'";
        // truy vấn kết nối sql
        $res = mysqli_query($conn, $sql);
        
        // đếm dữ liệu đã truy vấn
        $count = mysqli_num_rows($res);
        if($count == 1)
        {
            // tài khoản tồn tại và đăng nhập thành công
            $_SESSION['login'] = "<div class='success'>Đăng nhập thành công.</div>";
            $_SESSION['user'] = $username;

            // chuyển đến trang chủ
            header('location:'.SITEURL.'admin/');
        }
        else
        {
            // đăng nhập thất bại
            $_SESSION['login'] = "<div class='error'>Tài khoản hoặc mật khẩu không đúng.</div>";
            header('location:'.SITEURL.'admin/login.php');
        }
    }
?>