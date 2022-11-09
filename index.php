<?php include('partials-front/menu.php'); ?>
    <section class="food-search text-center">
        <div class="container">
            
            <form action="<?php echo SITEURL; ?>food-search.php" method="POST">
                <input type="search" name="search" placeholder="Bánh kem.." required>
                <input type="submit" name="submit" value="Search" class="btn btn-primary">
            </form>

        </div>
    </section>
    <!-- thông báo mua hàng -->

    <?php
        if(isset($_SESSION['order']))
        {
            echo $_SESSION['order'];
            unset ($_SESSION['order']);
        }
    ?>

    <!-- CAtegories Section Starts Here -->
    <section class="categories">
        <div class="container">
            <h2 class="text-center">Khám Phá</h2>

            <?php
                // tạo câu truy vấn sql để hiển thị danh mục từ database
                $sql = "SELECT * FROM tbl_category WHERE featured='Còn hàng' LIMIT 3";
                // thực hiện truy vấn
                $res = mysqli_query($conn, $sql);
                // kiểm tra có lấy dc dữ liệu hay không
                $count = mysqli_num_rows($res);
                if($count > 0)
                {
                    // có dữ liệu
                    while($row=mysqli_fetch_assoc($res))
                    {
                        // lấy các trường giá trị như id, title, image_name
                        $id = $row['id'];
                        $title = $row['title'];
                        $image_name = $row['image_name'];

                        ?>
                            <a href="<?php echo SITEURL; ?>category-foods.php?category_id=<?php echo $id; ?>">
                                <div class="box-3 float-container">
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
                                                <img src="<?php echo SITEURL; ?>/images/category/<?php echo $image_name; ?>" alt="Bánh kem" class="img-responsive img-curve">

                                            <?php
                                        }

                                    ?>

                                    <h3 class="float-text text-white"><?php echo $title; ?></h3>
                                </div>
                            </a>
                        <?php
                        
                    }

                }
                else
                {
                    // không có dữ liệu
                    echo "<div class='error'>Không có loại bánh được thêm.</div>";
                }
            ?>

            

           

            

            <div class="clearfix"></div>
        </div>
    </section>



    <!-- fOOD MEnu Section Starts Here -->
    <section class="food-menu">
        <div class="container">
            <h2 class="text-center">Sản phẩm</h2>

            <?php
                // lấy bánh từ database tbl_product
                // LIMIT 6 giới hạn số lượng dữ liệu trả về là 6
                $sql2 = "SELECT * FROM tbl_products WHERE featured='Còn hàng' LIMIT 6"; 

                // thực hiện truy vấn
                $res2 = mysqli_query($conn, $sql2);
                // kiểm tra dữ liệu 
                $count2 = mysqli_num_rows($res2);
                
                if($count2 > 0)
                {
                    while($row = mysqli_fetch_assoc($res2))
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

                                    <a href="<?php echo SITEURL; ?>order.php?product_id=<?php echo $id; ?>" class="btn2 btn-primary">Mua Ngay</a>
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

            
            
            

            
            



            <!-- <div class="food-menu-box">
                <div class="food-menu-img">
                    <img src="images/menu-burger.jpg" alt="Chicke Hawain Pizza" class="img-responsive img-curve">
                </div>

                <div class="food-menu-desc">
                    <h4>Smoky Burger</h4>
                    <p class="food-price">$2.3</p>
                    <p class="food-detail">
                        Made with Italian Sauce, Chicken, and organice vegetables.
                    </p>
                    <br>

                    <a href="#" class="btn btn-primary">Mua Ngay</a>
                </div>
            </div>

             -->


            <div class="clearfix"></div>

            

        </div>

        <p class="text-center">
            <a href="<?php echo SITEURL; ?>/foods.php">Xem Thêm</a>
        </p>
    </section>
    <!-- fOOD Menu Section Ends Here -->
    <?php include('partials-front/footer.php'); ?>
    