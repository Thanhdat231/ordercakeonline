<?php include('partials/menu.php'); ?>

<div class="main-content">
    <div class="wrapper">
        <h1 class="heading">
            Cập nhật đơn hàng
        </h1>
        <br><br>

        <?php 
            // kiểm tra id
            if(isset($_GET['id']))
            {
                $id = $_GET['id'];

                // lấy dữ liệu từ database tự điền vào form
                // tạo câu truy vấn
                $sql = "SELECT * FROM tbl_order WHERE id=$id";

                $res = mysqli_query($conn, $sql);
                $count = mysqli_num_rows($res);
                if($count == 1)
                {
                    // lấy dữ liệu
                    $row = mysqli_fetch_assoc($res);
                    $product = $row['product'];
                    $price = $row['price'];
                    $qty = $row['qty'];
                    
                    
                    $status = $row['status'];

                    // thông tin khách hàng mua
                    $customer_name = $row['customer_name'];
                    $customer_contact = $row['customer_contact'];
                    $customer_email = $row['customer_email'];
                    $customer_address = $row['customer_address'];
 
                }
                else
                {
                    header('location:'.SITEURL.'admin/manager-order.php');

                }
            }
            else
            {
                header('location:'.SITEURL.'admin/manager-order.php');
            }
        ?>


        <form action="" method="POST">
            <table class="tbl-30">
                <tr>
                    <td>Tên bánh</td>
                    <td><?php echo $product; ?></td>
                </tr>
                <tr>
                    <td>Giá</td>
                    <td><?php echo $price; ?>đ</td>
                </tr>
                <tr>
                    <td>Số lượng</td>
                    <td>
                        <input type="number" name="qty" value="<?php echo $qty; ?>">
                    </td>
                </tr>
                <tr>
                    <td>Trạng thái</td>
                    <td>
                        <select name="status">
                            <option <?php if($status=="Đang chuẩn bị hàng"){echo "selected";} ?> value="Đang chuẩn bị hàng">Đang chuẩn bị hàng</option>
                            <option <?php if($status=="Đang giao"){echo "selected";} ?> value="Đang giao">Đang giao</option>
                            <option <?php if($status=="Đã giao"){echo "selected";} ?> value="Đã giao">Đã giao</option>
                            <option <?php if($status=="Huỷ đơn"){echo "selected";} ?> value="Huỷ đơn">Huỷ đơn</option>
                        </select>
                    </td>
                </tr>
                <tr>
                    <td>Khách hàng: </td>
                    <td>
                        <input type="text" name="customer_name" value="<?php echo $customer_name; ?>">
                    </td>
                </tr>
                <tr>
                    <td>Số điện thoại: </td>
                    <td>
                        <input type="text" name="customer_contact" value="<?php echo $customer_contact; ?>">
                    </td>
                </tr>
                <tr>
                    <td>Email: </td>
                    <td>
                        <input type="text" name="customer_email" value="<?php echo $customer_email; ?>">
                    </td>
                </tr>
                <tr>
                    <td>Địa chỉ: </td>
                    <td>
                        <textarea name="customer_address" cols="30" rows="5"><?php echo $customer_address; ?></textarea>
                    </td>
                </tr>
                <tr>
                    <td colspan="2">
                        <input type="hidden" name="id" value="<?php echo $id; ?>">
                        <input type="hidden" name="price" value="<?php echo $price; ?>">
                        <input type="submit" name="submit" class="btn-secondary" value="Cập nhật">

                    </td>
                </tr>
            </table>

        </form>
        <!-- khi nhấn nút cập nhật -->
        <?php

            if(isset($_POST['submit']))
            {
                // echo "clicked";
                // lấy tất cả dữ liệu từ form để cập nhật
                    $id = $_POST['id'];
                    $price = $_POST['price'];
                    $qty = $_POST['qty'];
                    $total = $price * $qty; // tổng tiền
                    $status = $_POST['status']; // trạng thái mua thành công

                    // thông tin khách hàng mua
                    $customer_name = $_POST['customer_name'];
                    $customer_contact = $_POST['customer_contact'];
                    $customer_email = $_POST['customer_email'];
                    $customer_address = $_POST['customer_address'];

                    // tạo câu truy vấn
                    $sql2 = "UPDATE tbl_order SET 
                        qty = $qty,
                        total = $total,
                        status = '$status',
                        customer_name = '$customer_name',
                        customer_contact = '$customer_contact',
                        customer_email = '$customer_email',
                        customer_address = '$customer_address'
                        WHERE id=$id
                    ";

                    // echo $sql2; die();
                    // truy vấn
                    $res2 = mysqli_query($conn, $sql2);
                    // xuất thông báo
                    if($res2 == true)
                    {
                        $_SESSION['update'] = "<div class='success'>Cập nhật thành công.</div>";
                        header('location:'.SITEURL.'admin/manager-order.php');
                    }
                    else
                    {
                        $_SESSION['update'] = "<div class='error'>Cập nhật thất bại.</div>";
                        header('location:'.SITEURL.'admin/manager-order.php');
                    }
            }
        ?>


    </div>
</div>

<?php include('partials/footer.php'); ?>
