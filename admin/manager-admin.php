<?php include('partials/menu.php'); ?>
        <!-- phần content bắt đầu -->
        <div class="main-content">
            <div class="wrapper">
                <h2 class="heading">Manage Admin</h2>
                <br />
                <!-- Hiện thông báo thêm thành công hoặc không -->
                <?php

                    // thông báo của thêm
                    if(isset($_SESSION['add']))
                    {
                        echo $_SESSION['add']; // hiện thông báo
                        unset($_SESSION['add']); // xoá thông báo
                    }

                    // thông báo của xoá
                    if(isset($_SESSION['delete']))
                    {
                        echo $_SESSION['delete']; // hiện thông báo
                        unset($_SESSION['delete']); // xoá thông báo
                    }

                    // thông báo của update
                    if(isset($_SESSION['update']))
                    {
                        echo $_SESSION['update']; // hiện thông báo
                        unset($_SESSION['update']); // xoá thông báo
                    }

                    // thông báo của đổi mật khẩu
                    if(isset($_SESSION['user-not-found']))
                    {
                        echo $_SESSION['user-not-found']; // hiện thông báo
                        unset($_SESSION['user-not-found']); // xoá thông báo
                    }

                    
                    if(isset($_SESSION['pwd-not-match']))
                    {
                        echo $_SESSION['pwd-not-match']; // hiện thông báo
                        unset($_SESSION['pwd-not-match']); // xoá thông báo
                    } 
                    if(isset($_SESSION['change-pwd']))
                    {
                        echo $_SESSION['change-pwd']; // hiện thông báo
                        unset($_SESSION['change-pwd']); // xoá thông báo
                    }

                ?>
                <br><br><br>
                <a href="add-admin.php" class="btn-primary">Add admin</a>
                <br><br>
                <table class="table-content">
                    <tr>
                        <th>TT</th>
                        <th>Họ tên</th>
                        <th>Tài khoản</th>
                        <th>Hành động</th>
                    </tr>
                    
                    <!-- Hiện các thông tin admin lên bảng -->
                    <?php

                        // truy vấn dữ liệu từ bảng admin 
                        $sql = "SELECT * FROM tbl_admin";
                        $res = mysqli_query($conn, $sql); // kết nối csdl và truy vấn

                        // kiểm tra truy vấn thành công hay không
                        if($res ==TRUE)
                        {
                            $sn=1; // biến đếm thứ tự 

                            // đếm số hàng đã có trong csdl hoặc không
                            $rows = mysqli_num_rows($res); // hàm lấy số dữ liệu đã có trong database
                            // kiểm tra số lượng dữ liệu
                            if($rows > 0)
                            {
                                // đã có dữ liệu
                                while($rows = mysqli_fetch_assoc($res)) // hàm trả về kết quả truy vấn
                                {
                                    // lấy dữ liệu
                                    
                                    $id = $rows['id'];
                                    $full_name = $rows['full_name']; // lấy dữ liệu full_name trong database gán cho biến full_name
                                    $username = $rows['username'];
                                    // không lấy password vì ko cho hiển thị lên 

                                    // hiển thị giá trị ra ngoài bảng
                                    ?>
                                        <tr>
                                            <td><?php echo $sn++; ?> </td>
                                            <td><?php echo $full_name; ?></td>
                                            <td><?php echo $username; ?></td>
                                            <td>
                                                <a href="<?php echo SITEURL; ?>admin/update-password.php?id=<?php echo $id; ?>" class="btn-primary">Đổi mật khẩu</a>
                                                <a href="<?php echo SITEURL; ?>admin/update-admin.php?id=<?php echo $id; ?>" class="btn-secondary btn-modifi">Update Admin</a>
                                                <a href="<?php echo SITEURL; ?>admin/delete-admin.php?id=<?php echo $id; ?>" class="btn-danger">Delete Admin</a>
                                            </td>
                                        </tr>
                                    <?php
                                }

                            }
                            else{
                                // chưa có dữ liệu
                            }
                        }

                    ?>

                    
                </table>
            </div>
        </div>
        <!-- phần content kết thúc -->
<?php include('partials/footer.php'); ?>