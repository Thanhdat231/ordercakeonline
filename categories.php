<?php include('partials-front/menu.php'); ?>



    <!-- CAtegories Section Starts Here -->
    <section class="categories">
        <div class="container">
            <h2 class="text-center">Danh Mục</h2>

            <a href="<?php echo SITEURL; ?>category-foods.php?category_id=<?php echo $id; ?>">

            <?php
                // tạo câu truy vấn sql để hiển thị danh mục từ database
                $sql = "SELECT * FROM tbl_category WHERE featured='Còn hàng'";
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


        
            </a>

            <!-- <a href="category-foods.html">
                <div class="box-3 float-container">
                    <img src="images/ultraboot_bg.jpg" alt="Pizza" class="img-responsive img-curve">
    
                    <h3 class="float-text text-white">Ultraboost</h3>
                </div>
            </a>

             -->
            

            

            <div class="clearfix"></div>
        </div>
    </section>
    <!-- Categories Section Ends Here -->


<?php include('partials-front/footer.php'); ?>