<?php include('partials/menu.php'); ?>
<div class="main-content">
        <div class="wrapper">
            <h2 class="heading">Manage Order</h2>
            <br><br>
            
            <?php
                if(isset($_SESSION['update']))
                {
                    echo $_SESSION['update']; // hiện thông báo
                    unset($_SESSION['update']); // xoá thông báo
                }
            ?>

            <table class="table-content">
                    <tr>
                        <th>TT</th>
                        <th>Tên hàng</th>
                        <th>Giá</th>
                        <th>SLượng</th>
                        <th>Tổng tiền</th>
                        <th>Ngày mua</th>
                        <th>Trạng thái</th>
                        <th>Khách hàng</th>
                        <th>Số điện thoại</th>
                        <th>Email</th>
                        <th>Địa chỉ</th>
                        <th>Hành động</th>
                    </tr>
                    <?php
                        // lấy dữ liệu trong bảng order
                        $sql = "SELECT * FROM tbl_order ORDER BY id DESC";
                        // truy vấn
                        $res = mysqli_query($conn, $sql);

                        $count = mysqli_num_rows($res);
                        $sn = 1;
                        if($count > 0)
                        {
                            // có đơn hàng
                            while($row=mysqli_fetch_assoc($res))
                            {
                                $id = $row['id'];
                                $product = $row['product'];
                                $price = $row['price'];
                                $qty = $row['qty'];
                                $total = $row['total'];
                                $order_date = $row['order_date'];
                                $status = $row['status'];
                                $customer_name = $row['customer_name'];
                                $customer_contact = $row['customer_contact'];
                                $customer_email = $row['customer_email'];
                                $customer_address = $row['customer_address'];

                                ?>
                                    <tr>
                                        <td><?php echo $sn++; ?></td>
                                        <td><?php echo $product; ?></td>
                                        <td><?php echo $price; ?></td>
                                        <td><?php echo $qty; ?></td>
                                        <td><?php echo $total; ?></td>
                                        <td><?php echo $order_date; ?></td>

                                        <td>
                                            <?php 
                                                
                                                if($status=="Đang chuẩn bị hàng")
                                                {
                                                    echo "<label>$status</label>";
                                                }
                                                elseif($status=="Đang giao")
                                                {
                                                    echo "<label style='color: orange;'>$status</label>";
                                                }
                                                elseif($status=="Đã giao")
                                                {
                                                    echo "<label style='color: green;'>$status</label>";
                                                }
                                                elseif($status=="Huỷ đơn")
                                                {
                                                    echo "<label style='color: red;'>$status</label>";
                                                }
                                            ?>
                                        </td>


                                        <td><?php echo $customer_name; ?></td>
                                        <td><?php echo $customer_contact; ?></td>
                                        <td><?php echo $customer_email; ?></td>
                                        <td><?php echo $customer_address; ?></td>
                                        <td>
                                            <a href="<?php echo SITEURL; ?>admin/update-order.php?id=<?php echo $id; ?>" class="btn-secondary">Cập nhật</a>
                                        
                                        </td>
                                    </tr>
                                <?php
                            }
                        }
                        else
                        {
                            // không có đơn hàng
                            echo "<tr><td colspan='12' class='error'>Không có đơn hàng nào</td></tr>";
                        }
                    ?>

                    

                    
                </table>   
        </div>
</div>
<?php include('partials/footer.php'); ?>