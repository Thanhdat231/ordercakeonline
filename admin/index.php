<?php include('partials/menu.php'); ?>

        <!-- phần content bắt đầu -->
        <div class="main-content">
            <div class="wrapper">
                <h2 class="heading">DASHBOARD</h2>
                <div class="col-4 text-center">
                    <?php 
                        // tạo câu truy vấn lấy số lượng
                        $sql = "SELECT * FROM tbl_category";
                        $res = mysqli_query($conn, $sql);
                        $count = mysqli_num_rows($res);
                    ?>

                    <h1><?php echo $count; ?></h1>
                    <br>
                    Danh mục
                </div>
                <div class="col-4 text-center">
                    <?php 
                        // tạo câu truy vấn lấy số lượng
                        $sql2 = "SELECT * FROM tbl_products";
                        $res2 = mysqli_query($conn, $sql2);
                        $count2 = mysqli_num_rows($res2);
                    ?>
                    <h1><?php echo $count2; ?></h1>
                    <br>
                    Sản phẩm
                </div>
                <div class="col-4 text-center">
                    <?php 
                        // tạo câu truy vấn lấy số lượng
                        $sql3 = "SELECT * FROM tbl_order";
                        $res3 = mysqli_query($conn, $sql3);
                        $count3 = mysqli_num_rows($res3);
                    ?>
                    <h1><?php echo $count3; ?></h1>
                    <br>
                    Đơn hàng
                </div>
                <div class="col-4 text-center">
                    <?php
                        //t ạo câu truy vấn lấy tổng tiền
                        // tính tổng tiền đơn hàng
                        $sql4 = "SELECT SUM(total) AS Total FROM tbl_order WHERE status='Đã giao'";
                        $res4 = mysqli_query($conn, $sql4);
                        $row4 = mysqli_fetch_assoc($res4);

                        // lấy tổng doanh thu
                        $total_revenue = $row4['Total'];
                    ?>
                    <h1><?php echo $total_revenue; ?>VND</h1>
                    <br>
                    Doanh thu
                </div>
                
                <div class="clear-fix"></div>
            </div>
        </div>
        <!-- phần content kết thúc -->

        <!-- phần footer bắt đầu -->
<?php include('partials/footer.php'); ?>