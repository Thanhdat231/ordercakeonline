<?php include('partials-front/menu.php'); ?>

    <?php
        //  kiểm tra có lấy dc id của sản phẩm
        if(isset($_GET['product_id']))
        {
            // LẤY ID
            $product_id = $_GET['product_id'];

            // tạo câu truy vấn để lấy dữ liệu
            $sql = "SELECT * FROM tbl_products WHERE id=$product_id";
            // echo $sql;
            // die();
            // thực hiện truy vấn
            $res = mysqli_query($conn, $sql);
            // kiểm tra dữ liệu
            $count = mysqli_num_rows($res);
            if($count == 1) 
            {
                // có sản phẩm, lấy dữ liệu từ database
                $row = mysqli_fetch_assoc($res);
                $title = $row['title'];
                $price = $row['price'];
                $image_name = $row['image_name'];

                
            }
            else
            {
                // không tìm thấy sản phẩm về trang chủ
                header('location:'.SITEURL);
            }
        }
        else
        {
            // không có id thì chuyển hướng trang 
            header('location:'.SITEURL);
        }
    ?>

    <!-- fOOD sEARCH Section Starts Here -->
    <section class="food-search">
        <div class="container">
            
            <h2 class="text-center text-white">Điền các thông tin để xác nhận đơn hàng.</h2>

            <form action="" method="POST" class="order">
                <fieldset>
                    <legend>Thông tin bánh</legend>

                    <div class="food-menu-img">

                        <?php 
                            // kiểm tra ảnh có tồn tại hay không
                            if($image_name=="")
                            {
                                // không có ảnh
                                echo "<div class='error'>Không có ảnh.</div>";
                            }
                            else
                            {
                                // có ảnh
                                ?>
                                    <img src="<?php echo SITEURL; ?>images/cakes/<?php echo $image_name; ?>" alt="Chicke Hawain Pizza" class="img-responsive img-curve">

                                <?php
                            }
                        ?>


                    </div>
    
                    <div class="food-menu-desc">
                        <h3><?php echo $title; ?></h3>

                        <!-- tạo thẻ input để POST giá trị  -->
                        <input type="hidden" name="product" value="<?php echo $title; ?>">


                        <p class="food-price"><?php echo $price; ?>đ</p>
                        <input type="hidden" name="price" value="<?php echo $price; ?>">
                        
                        <div class="order-label">Số lượng</div>
                        <input type="number" name="qty" class="input-responsive" value="1" required>
                        
                    </div>

                </fieldset>
                
                <fieldset>
                    <legend>Thông tin cá nhân</legend>
                    <div class="order-label">Họ tên</div>
                    <input type="text" name="full-name" placeholder="VD. Thanh Dat" class="input-responsive" required>

                    <div class="order-label">Số điện thoại</div>
                    <input type="tel" name="contact" placeholder="VD. 0823040712" class="input-responsive" required>

                    <div class="order-label">Email</div>
                    <input type="email" name="email" placeholder="VD. 20004019@gmail.com" class="input-responsive" required>

                    <div class="order-label">Địa chỉ</div>
                    <textarea name="address" rows="10" placeholder="VD. 69, Phó Cơ Điều" class="input-responsive" required></textarea>

                    <input type="submit" name="submit" value="Mua hàng" class="btn btn-primary">
                </fieldset>

            </form>

            <?php
                // kiểm tra nút mua hàng
                if(isset($_POST['submit']))
                {
                    $product = $_POST['product'];
                    $price = $_POST['price'];
                    $qty = $_POST['qty'];
                    $total = $price * $qty; // tổng tiền
                    $order_date = date("Y-m-d h:i:sa"); // thời gian mua hàng
                    $status = "Đang chuẩn bị hàng"; // trạng thái mua thành công

                    // thông tin khách hàng mua
                    $customer_name = $_POST['full-name'];
                    $customer_contact = $_POST['contact'];
                    $customer_email = $_POST['email'];
                    $customer_address = $_POST['address'];

                    // lưu vào database
                    // tạo câu truy vấn để lưu
                    $sql2 = "INSERT INTO tbl_order SET
                        product = '$product',
                        price = $price,
                        qty = $qty,
                        total = $total,
                        order_date = '$order_date',
                        status = '$status',
                        customer_name = '$customer_name',
                        customer_contact = '$customer_contact',
                        customer_email = '$customer_email',
                        customer_address = '$customer_address'
                    ";

                    // echo $sql2;
                    // die();
                    // thực hiện truy vấn
                    $res2 = mysqli_query($conn, $sql2);
                    if($res2 == true)
                    {
                        $_SESSION['order'] = "<div class='success text-center'>Mua hàng thành công :).</div>";
                        
                        header('location:'.SITEURL);
                    }
                    else
                    {
                        $_SESSION['order'] = "<div class='error text-center'>Mua hàng thất bại:(.</div>";
                        header('location:'.SITEURL);
                    }
                }
            ?>

        </div>
    </section>
    <!-- fOOD sEARCH Section Ends Here -->

    <?php include('partials-front/footer.php'); ?>