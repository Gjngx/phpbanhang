<?php
session_start();
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <title>GPPT Bookstore</title>
    <?php include_once("app/views/users/partical/head.php"); ?>
</head>

<body>
    <!-- Navbar Start -->
    <?php include_once("app/views/users/partical/header.php"); ?>
    <!-- Navbar End -->
    <!-- Carousel Start -->
    <div class="container-fluid mb-3">
        <div class="row px-xl-5">
            <div class="col-lg-8">
                <div id="header-carousel" class="carousel slide carousel-fade mb-30 mb-lg-0" data-ride="carousel">
                    <ol class="carousel-indicators">
                        <li data-target="#header-carousel" data-slide-to="0" class="active"></li>
                        <li data-target="#header-carousel" data-slide-to="1"></li>
                        <li data-target="#header-carousel" data-slide-to="2"></li>
                    </ol>
                    <div class="carousel-inner">
                        <div class="carousel-item position-relative active" style="height: 430px;">
                            <img class="position-absolute w-100 h-100" src="/phpbanhang/public/user/img/slider-1.jpg" style="object-fit: cover;">
                            <div class="carousel-caption d-flex flex-column align-items-center justify-content-center">
                                <div class="p-3" style="max-width: 700px;">
                                    <h1 class="display-4 text-white mb-3 animate__animated animate__fadeInDown">GPPT Bookstore</h1>
                                    <p class="mx-md-5 px-5 animate__animated animate__bounceIn">Chào mừng quý khách đến với GPPT Bookstore - nơi lý tưởng để khám phá vẻ đẹp của từng trang sách và trải nghiệm sự
                                        phong phú của văn hóa đọc. Tại GPPT Bookstore, chúng tôi tự hào mang đến cho quý độc giả một không gian ấm cúng và đầy sáng tạo, nơi mà trí tưởng tượng có thể bay bổng và kiến thức được lan tỏa</p>
                                    <a class="btn btn-outline-light py-2 px-4 mt-3 animate__animated animate__fadeInUp" href="/phpbanhang/product">Mua ngay</a>
                                </div>
                            </div>
                        </div>
                        <div class="carousel-item position-relative" style="height: 430px;">
                            <img class="position-absolute w-100 h-100" src="/phpbanhang/public/user/img/slider-2.jpg" style="object-fit: cover;">
                            <div class="carousel-caption d-flex flex-column align-items-center justify-content-center">
                                <div class="p-3" style="max-width: 700px;">
                                    <h1 class="display-4 text-white mb-3 animate__animated animate__fadeInDown">GPPT Bookstore</h1>
                                    <p class="mx-md-5 px-5 animate__animated animate__bounceIn">Chào mừng quý khách đến với GPPT Bookstore - nơi lý tưởng để khám phá vẻ đẹp của từng trang sách và trải nghiệm sự
                                        phong phú của văn hóa đọc. Tại GPPT Bookstore, chúng tôi tự hào mang đến cho quý độc giả một không gian ấm cúng và đầy sáng tạo, nơi mà trí tưởng tượng có thể bay bổng và kiến thức được lan tỏa</p>
                                    <a class="btn btn-outline-light py-2 px-4 mt-3 animate__animated animate__fadeInUp" href="/phpbanhang/product">Mua ngay</a>
                                </div>
                            </div>
                        </div>
                        <div class="carousel-item position-relative" style="height: 430px;">
                            <img class="position-absolute w-100 h-100" src="/phpbanhang/public/user/img/slider-3.jpg" style="object-fit: cover;">
                            <div class="carousel-caption d-flex flex-column align-items-center justify-content-center">
                                <div class="p-3" style="max-width: 700px;">
                                    <h1 class="display-4 text-white mb-3 animate__animated animate__fadeInDown">GPPT SHOP</h1>
                                    <p class="mx-md-5 px-5 animate__animated animate__bounceIn">Chào mừng quý khách đến với GPPT Bookstore - nơi lý tưởng để khám phá vẻ đẹp của từng trang sách và trải nghiệm sự
                                        phong phú của văn hóa đọc. Tại GPPT Bookstore, chúng tôi tự hào mang đến cho quý độc giả một không gian ấm cúng và đầy sáng tạo, nơi mà trí tưởng tượng có thể bay bổng và kiến thức được lan tỏa</p>
                                    <a class="btn btn-outline-light py-2 px-4 mt-3 animate__animated animate__fadeInUp" href="/phpbanhang/product">Mua ngay</a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-lg-4">
                <div class="product-offer mb-30" style="height: 200px;">
                    <img class="img-fluid" src="/phpbanhang/public/user/img/bannel-tuan.jpeg" alt="">
                    <div class="offer-text">
                        <h3 class="text-white mb-3">Sách tuần</h3>
                        <a href="/phpbanhang/product" class="btn btn-primary">Mua ngay</a>
                    </div>
                </div>
                <div class="product-offer mb-30" style="height: 200px;">
                    <img class="img-fluid" src="/phpbanhang/public/user/img/bannel-thang.jpeg" alt="">
                    <div class="offer-text">
                        <h3 class="text-white mb-3">Sách tháng</h3>
                        <a href="/phpbanhang/product" class="btn btn-primary">Mua ngay</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Carousel End -->


    <!-- Featured Start -->
    <div class="container-fluid pt-5">
        <div class="row px-xl-5 pb-3">
            <div class="col-lg-3 col-md-6 col-sm-12 pb-1">
                <div class="d-flex align-items-center bg-light mb-4" style="padding: 30px;">
                    <h1 class="fa fa-check text-primary m-0 mr-3"></h1>
                    <h5 class="font-weight-semi-bold m-0">Chất lượng</h5>
                </div>
            </div>
            <div class="col-lg-3 col-md-6 col-sm-12 pb-1">
                <div class="d-flex align-items-center bg-light mb-4" style="padding: 30px;">
                    <h1 class="fa fa-shipping-fast text-primary m-0 mr-2"></h1>
                    <h5 class="font-weight-semi-bold m-0">Miễn phí giao hàng</h5>
                </div>
            </div>
            <div class="col-lg-3 col-md-6 col-sm-12 pb-1">
                <div class="d-flex align-items-center bg-light mb-4" style="padding: 30px;">
                    <h1 class="fas fa-exchange-alt text-primary m-0 mr-3"></h1>
                    <h5 class="font-weight-semi-bold m-0">Hoàn hàng - 7 ngày</h5>
                </div>
            </div>
            <div class="col-lg-3 col-md-6 col-sm-12 pb-1">
                <div class="d-flex align-items-center bg-light mb-4" style="padding: 30px;">
                    <h1 class="fa fa-phone-volume text-primary m-0 mr-3"></h1>
                    <h5 class="font-weight-semi-bold m-0">Hỗ trợ 24/7               
                    </h5>
                </div>
            </div>
        </div>
    </div>
    <!-- Featured End -->

    <!-- Products Start -->
    <div class="container-fluid pt-5 pb-3">
        <h2 class="section-title position-relative text-uppercase mx-xl-5 mb-4"><span class="bg-secondary pr-3">Sản phẩm mới nhất</span></h2>
        <div class="row px-xl-5">
            <?php while ($product = $products->fetch(PDO::FETCH_ASSOC)) : ?>
                <?php
                // Kiểm tra trạng thái của sản phẩm
                $isInStock = ($product['status'] == 1);
                ?>
                <div class="col-lg-3 col-md-4 col-sm-6 pb-1">
                    <div class="product-item bg-light mb-4">
                        <div class="product-img position-relative overflow-hidden">
                            <img class="img-fluid w-100" src="/phpbanhang/public/images/products/<?php echo $product['image']; ?>" alt="<?php echo $product['name']; ?>">
                            <div class="product-action">
                                <?php if ($isInStock) : ?>
                                    <a class="btn btn-outline-dark btn-square" href="/phpbanhang/product/addtocartoneproduct/<?= $product['id']; ?>"><i class="fa fa-shopping-cart"></i></a>
                                <?php endif; ?>
                                <a class="btn btn-outline-dark btn-square" href="/phpbanhang/product/detail/<?php echo $product['id']; ?>"><i class="fa fa-search"></i></a>
                            </div>
                        </div>
                        <div class="text-center py-4">
                            <a class="h6 text-decoration-none text-truncate" href="/phpbanhang/product/detail/<?php echo $product['id']; ?>"><?php  echo $product['name'] . " Cart"  . $_SESSION['cart'][$product['id']];?> </a>
                            <div class="d-flex align-items-center justify-content-center mt-2">
                                <h5>
                                    <?php
                                    $price = $product['price'];
                                    $formattedPrice = number_format($price, 0, ',', '.');
                                    echo $formattedPrice . ' VND';
                                    ?>
                                </h5>
                            </div>
                        </div>
                    </div>
                </div>
            <?php endwhile; ?>
        </div>
    </div>
    <!-- Products End -->

    <!-- Footer Start -->
    <?php include_once("app/views/users/partical/footer.php"); ?>
    <!-- Footer End -->


    <!-- Back to Top -->
    <a href="#" class="btn btn-primary back-to-top"><i class="fa fa-angle-double-up"></i></a>


    <!-- JavaScript Libraries -->
    <script src="https://code.jquery.com/jquery-3.4.1.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.bundle.min.js"></script>
    <script src="/phpbanhang/public/user/lib/easing/easing.min.js"></script>
    <script src="/phpbanhang/public/user/lib/owlcarousel/owl.carousel.min.js"></script>

    <!-- Contact Javascript File -->
    <script src="/phpbanhang/public/user/mail/jqBootstrapValidation.min.js"></script>
    <script src="/phpbanhang/public/user/mail/contact.js"></script>

    <!-- Template Javascript -->
    <script src="/phpbanhang/public/user/js/main.js"></script>
</body>

</html>