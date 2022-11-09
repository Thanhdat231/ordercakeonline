<?php include('partials-front/menu.php'); ?>

    <!-- fOOD sEARCH Section Starts Here -->
    <section class="food-search text-center">
        <div class="container">
            
            <form action="<?php echo SITEURL; ?>food-search.php" method="POST">
                <input type="search" name="search" placeholder="Search for Food.." required>
                <input type="submit" name="submit" value="Search" class="btn btn-primary">
            </form>

        </div>
    </section>
    <!-- fOOD sEARCH Section Ends Here -->



    <!-- fOOD MEnu Section Starts Here -->
    <section class="food-menu">
        <div class="container">
            <h2 class="text-center">Menu Bánh</h2>

            <?php
                // lấy bánh từ database tbl_product
                // LIMIT 6 giới hạn số lượng dữ liệu trả về là 6
                $sql = "SELECT * FROM tbl_products WHERE featured='Còn hàng' LIMIT 6"; 

                // thực hiện truy vấn
                $res = mysqli_query($conn, $sql);
                // kiểm tra dữ liệu 
                $count = mysqli_num_rows($res);
                
                if($count > 0)
                {
                    while($row = mysqli_fetch_assoc($res))
                    {
                        // lấy tất cả dữ liệu
                        $id = $row['id'];
                        $title = $row['title'];
                        $price = $row['price'];
                        $description = $row['description'];
                        $image_name = $row['image_name'];
                        $active = $row['active'];
                        ?>
                            <div class="food-menu-box">
                                <div class="food-menu-img">
                                    <?php
                                        if($image_name == "")
                                        {
                                            // không có ảnh
                                            echo "<div class='error'>Không tìm thấy ảnh.</div>";
                                        }
                                        else
                                        {
                                            // có ảnh
                                            ?>
                                                <img src="<?php echo SITEURL; ?>/images/cakes/<?php echo $image_name; ?>" alt="Bánh kem" class="img-responsive img-curve">
                                                

                                            <?php
                                        }
                                    ?>

                                    
                                </div>

                                <div class="food-menu-desc">
                                    <h4><?php echo $title; ?></h4>
                                    <p class="food-price"><?php echo $price; ?>đ</p>
                                    <p class="food-detail">
                                        <?php echo $description; ?>
                                    </p>
                                    <p class="food-detail">
                                        Size: <?php echo $active; ?>
                                    </p>
                                    <br>

                                    <a href="<?php echo SITEURL; ?>order.php?product_id=<?php echo $id; ?>" class="btn2 btn-primary">Mua ngay</a>
                                </div>
                            </div>

                        <?php
                    } 
                }
                else
                {
                    echo "<div class='error'>Không tìm thấy sản phẩm.</div>";
                }
            ?>


            

           


            <div class="clearfix"></div>

            

        </div>

    </section>
    <!-- fOOD Menu Section Ends Here -->

    <?php include('partials-front/footer.php'); ?>