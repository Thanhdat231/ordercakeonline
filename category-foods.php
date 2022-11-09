<?php include('partials-front/menu.php'); ?>

    <?php 
    //kiểm tra id danh mục có hay hông
    if(isset($_GET['category_id']))
    {
        //gán id danh mục vào biến
        $category_id = $_GET['category_id'];
        //tạo câu truy vấn lấy tên danh mục theo id
        $sql = "SELECT title FROM tbl_category WHERE id=$category_id";
        //thực hiện truy vấn
        $res = mysqli_query($conn,$sql);

        //kt có dữ liệu hay không
        $count = mysqli_num_rows($res);
        if($count==1)
        {
            $row=mysqli_fetch_assoc($res);     
            // lấy tên danh mục
            $category_title = $row['title'];
        }
        else
        {
            //id danh mục không tồn tại
            //chuyển hướng trang
            header("location:".SITEURL);
        }
    }
    else
    {
        //Category not passed
        //Redirect to home page
        header("location:".SITEURL);
    }

    ?>

    

    <!-- fOOD sEARCH Section Starts Here -->
    <section class="food-search text-center">
        <div class="container">
            
            <h2>Danh mục <a href="#" class="text-white">"<?php echo $category_title; ?>"</a></h2>

        </div>
    </section>
    <!-- fOOD sEARCH Section Ends Here -->



    <!-- fOOD MEnu Section Starts Here -->
    <section class="food-menu">
        <div class="container">
            <h2 class="text-center">Menu</h2>
            
            <?php
                // tạo câu truy vấn lấy giá trị của bảng tbl_products
                $sql2 = "SELECT * FROM tbl_products WHERE category_id=$category_id";

                // thực hiện ttruy vấn
                $res2 = mysqli_query($conn, $sql2);
                // kt dữ liệu có lấy dc không
                $count2 = mysqli_num_rows($res2);
                if($count2 > 0)
                {
                    // có sản phẩm
                    while($row2 = mysqli_fetch_assoc($res2))
                    {
                        $id = $row2['id'];
                        $title = $row2['title'];
                        $price = $row2['price'];
                        $description = $row2['description'];
                        $image_name = $row2['image_name'];
                        $active = $row2['active'];
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
                    echo "<div class='error'>Không có sản phẩm trong mục này.</div>";
                }

            ?>


            

            <div class="clearfix"></div>

            

        </div>

    </section>
    <!-- fOOD Menu Section Ends Here -->

    <?php include('partials-front/footer.php'); ?> 