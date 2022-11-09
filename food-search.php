<?php include('partials-front/menu.php'); ?>
    <!-- Navbar Section Ends Here -->

    <!-- fOOD sEARCH Section Starts Here -->
    <section class="food-search text-center">
        <div class="container">

            <?php
                // lấy dữ liệu từ thanh tìm kiếm lưu vào biến 
                $search = $_POST['search'];
            ?>

            <h2><span>Bánh bạn tìm kiếm</span> <a href="#" class="text-white">"<?php echo $search; ?>"</a></h2>

        </div>
    </section>
    <!-- fOOD sEARCH Section Ends Here -->



    <!-- fOOD MEnu Section Starts Here -->
    <section class="food-menu">
        <div class="container">
            <h2 class="text-center">Menu</h2>
            
            <?php 

                

                // tạo câu truy vấn để kím trong database
                // sử dụng like để tìm kím tương tự và dấu % để tìm ở mọi vị trí có keyword
                $sql = "SELECT * FROM tbl_products WHERE title LIKE '%$search%' OR description LIKE '%$search%'";

                // thực hiện truy vấn
                $res = mysqli_query($conn, $sql);
                // kt dữ liệu

                $count = mysqli_num_rows($res);
                if($count > 0)
                {
                    // tìm thấy
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

                                    <a href="order.html" class="btn2 btn-primary">Mua Ngay</a>
                                </div>
                            </div>


                        <?php
                    }
                }
                else
                {
                    // không tìm thấy
                    echo "<div class='error'>Không tìm thấy bánh này.</div>";
                }

            ?>

            

            


            <div class="clearfix"></div>

            

        </div>

    </section>
    <!-- fOOD Menu Section Ends Here -->

    <!-- social Section Starts Here -->
    <?php include('partials-front/footer.php'); ?>