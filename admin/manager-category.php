<?php include('partials/menu.php'); ?>
<div class="main-content">
        <div class="wrapper">
            <h2 class="heading">Manage Category</h2>
            <br><br>
            <?php
                if(isset($_SESSION['delete']))
                {
                    echo $_SESSION['delete']; // hiện thông báo
                    unset($_SESSION['delete']); // xoá thông báo
                }
                if(isset($_SESSION['add']))
                {
                    echo $_SESSION['add']; // hiện thông báo
                    unset($_SESSION['add']); // xoá thông báo
                }
                if(isset($_SESSION['remove']))
                {
                    echo $_SESSION['remove']; // hiện thông báo
                    unset($_SESSION['remove']); // xoá thông báo
                }

                // thông báo cho update
                if(isset($_SESSION['no-category-found']))
                {
                    echo $_SESSION['no-category-found']; // hiện thông báo
                    unset($_SESSION['no-category-found']); // xoá thông báo
                }

                if(isset($_SESSION['update']))
                {
                    echo $_SESSION['update']; // hiện thông báo
                    unset($_SESSION['update']); // xoá thông báo
                }

                if(isset($_SESSION['upload']))
                {
                    echo $_SESSION['upload']; // hiện thông báo
                    unset($_SESSION['upload']); // xoá thông báo
                }

                if(isset($_SESSION['failed-remove']))
                {
                    echo $_SESSION['failed-remove']; // hiện thông báo
                    unset($_SESSION['failed-remove']); // xoá thông báo
                }
            ?>
        
            <br><br>
            <a href="<?php echo SITEURL; ?>admin/add-category.php" class="btn-primary">Add Category</a>
            <br><br>
            <table class="table-content">
                    <tr>
                        <th>TT</th>
                        <th>Tên bánh</th>
                        <th>Ảnh</th>
                        <th>Trạng thái</th>
                        <th>Kích thước</th>
                        <th>Hành động</th>
                    </tr>
                    <?php
                        // hiện tất cả trong danh mục
                        $sql = "SELECT * FROM tbl_category";
                        // thực hiện truy vấn
                        $res = mysqli_query($conn, $sql);

                        // đếm số lượng dữ liệu có trong database
                        $count = mysqli_num_rows($res);
                        // kiểm tra có dữ liệu trong database hay không
                        $sn = 1;
                        if($count > 0)
                        {
                            // có dữ liệu trong database
                            // hiện dữ liệu lên bảng
                            while($row=mysqli_fetch_assoc($res))
                            {
                                $id = $row['id'];
                                $title = $row['title'];
                                $image_name = $row['image_name'];
                                $featured = $row['featured'];
                                $active = $row['active'];
                                ?>
                                    <tr>
                                        <td><?php echo $sn++; ?></td>
                                        <td><?php echo $title; ?></td>
                                        <td>
                                            <!-- Kiểm tra ảnh có dc thêm hay không -->
                                            <?php
                                                if($image_name != "")
                                                {
                                                    // hiện ảnh
                                                    ?>
                                                        <img class="img_category" src="<?php echo SITEURL; ?>images/category/<?php echo $image_name; ?>" alt="" width="95px" style="border: 1px solid #ccc; border-radius:4px">

                                                    <?php
                                                
                                                }
                                                else
                                                {
                                                    echo "<div class='error'>Chưa thêm ảnh.</div>";
                                                }
                                            ?>
                                        </td>
                                        <td><?php echo $featured; ?></td>
                                        <td><?php echo $active; ?></td>
                                        <td>
                                            <a href="<?php echo SITEURL; ?>admin/update-category.php?id=<?php echo $id; ?>" class="btn-secondary">Update Category</a>
                                            <a href="<?php echo SITEURL; ?>admin/delete-category.php?id=<?php echo $id;?>&image_name=<?php echo $image_name;?>" class="btn-danger">Delete Category</a>
                                        </td>
                                    </tr>
                                <?php
                            }
                        }
                        else
                        {
                            // không có dữ liệu
                            // hiện lên thông báo ko có dữ liệu 
                            ?>
                                <tr>
                                    <td colspan = "6"><div class='error'>Không có dữ liệu.</div></td>
                                </tr>

                            <?php
                        }
                    ?>
                    

                    
                </table>
        </div>
</div>
<?php include('partials/footer.php'); ?>