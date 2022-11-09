<?php include('partials/menu.php'); ?>
<div class="main-content">
        <div class="wrapper">
            <h2 class="heading">Quản lý sản phẩm</h2>
            <br><br>
          
            <a href="<?php echo SITEURL; ?>admin/add-products.php" class="btn-primary">Thêm Bánh</a>
            <br><br>

            <?php
                if(isset($_SESSION['add']))
                {
                    echo $_SESSION['add']; // hiện thông báo
                    unset($_SESSION['add']); // xoá thông báo
                }

                
                if(isset($_SESSION['unauthorize']))
                {
                    echo $_SESSION['unauthorize']; // hiện thông báo
                    unset($_SESSION['unauthorize']); // xoá thông báo
                }

                // thông báo của delete
                if(isset($_SESSION['delete']))
                {
                    echo $_SESSION['delete']; // hiện thông báo
                    unset($_SESSION['delete']); // xoá thông báo
                }

                if(isset($_SESSION['remove']))
                {
                    echo $_SESSION['remove']; // hiện thông báo
                    unset($_SESSION['remove']); // xoá thông báo
                }
                // thông báo của cập nhật
                if(isset($_SESSION['update']))
                {
                    echo $_SESSION['update']; // hiện thông báo
                    unset($_SESSION['update']); // xoá thông báo
                }
                if(isset($_SESSION['remove-failed']))
                {
                    echo $_SESSION['remove-failed']; // hiện thông báo
                    unset($_SESSION['remove-failed']); // xoá thông báo
                }
            ?>
            <table class="table-content">
                    <tr>
                        <th>TT</th>
                        <th>Tên bánh</th>
                        <th>Giá</th>
                        <th>Ảnh</th>
                        <th>Tình trạng</th>
                        <th>Size</th>
                        <th>Hành động</th>
                    </tr>
                    <?php
                        $sql = "SELECT *FROM tbl_products";

                        $res = mysqli_query($conn, $sql);
                        
                        $count = mysqli_num_rows($res);
                        $sn = 1;

                        if($count > 0)
                        {
                            while($row = mysqli_fetch_assoc($res))
                            {
                                $id = $row['id'];
                                $title = $row['title'];
                                $price = $row['price'];
                                $image_name = $row['image_name'];
                                $featured = $row['featured'];
                                $active = $row['active'];

                                ?>
                                    <tr>
                                        <td><?php echo $sn++; ?>. </td>
                                        <td><?php echo $title; ?></td>
                                        <td><?php echo $price ?>đ</td>
                                        <td>
                                            <?php 
                                            
                                                if($image_name == "")
                                                {
                                                    // hiện ảnh
                                                    echo  "<div class='error'>Chưa có ảnh.</div>";
                                                
                                                }
                                                else
                                                {
                                                    ?>
                                                        <img src="<?php echo SITEURL; ?>images/cakes/<?php echo $image_name; ?>" width="95px" style="border: 1px solid #ccc; border-radius:4px">
                                                    <?php
                                                }
                                        

                                            ?>
                                        </td>
                                        <td><?php echo $featured ?></td>
                                        <td><?php echo $active ?></td>
                                        <td>
                                            <a href="<?php echo SITEURL;?>admin/update-product.php?id=<?php echo $id; ?>&image_name=<?php echo $image_name; ?>" class="btn-secondary">update</a>
                                            <a href="<?php echo SITEURL;?>admin/delete-product.php?id=<?php echo $id; ?>&image_name=<?php echo $image_name; ?>" class="btn-danger">delete</a>
                                        </td>
                                    </tr>

                                <?php

                            }
                        }
                        else
                        {
                                echo "<tr> <td colspan='7' class='error'>Chưa có sản phẩm. </td> </tr>";
                        }
                    ?>
                     
                </table> 
        </div>
</div>
<?php include('partials/footer.php'); ?>