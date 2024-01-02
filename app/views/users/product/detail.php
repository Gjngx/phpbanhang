<?= session_start(); ?>
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


    <!-- Shop Detail Start -->
    <div class="container-fluid pb-5">
        <div class="row px-xl-5">
            <div class="col-lg-5 mb-30">
                <div class="carousel slide">
                    <div class="carousel-inner bg-light">
                        <div class="carousel-item active">
                            <img class="w-100 h-100" src="/phpbanhang/public/images/products/<?php echo $product['image']; ?>" alt="Image">
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-lg-7 h-auto mb-30">
                <div class="h-100 bg-light p-30">
                    <h3><?php echo $product['name']; ?></h3>
                    <br>
                    <h3 class="font-weight-semi-bold mb-4">
                        <?php
                        $price = $product['price'];
                        $formattedPrice = number_format($price, 0, ',', '.');
                        echo $formattedPrice . ' VND';
                        ?>
                    </h3>
                    <h3 class="font-weight-semi-bold mb-4">Giới thiệu</h3>
                    <p class="mb-4"><?php echo $product['description']; ?></p>
                    <div class="d-flex align-items-center mb-4 pt-2">
                        <?php if ($product['status'] == 1) : ?>
                            <a class="btn btn-primary px-3" href="/phpbanhang/product/addtocartoneproduct/<?= $product['id']; ?>" >
                                <i class=" fa fa-shopping-cart mr-1"></i> Thêm vào giỏ hàng
                            </a>
                        <?php else : ?>
                            <button class="btn btn-secondary px-3" disabled>
                                <i class="fa fa-shopping-cart mr-1"></i> Hết hàng
                            </button>
                        <?php endif; ?>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Shop Detail End -->

    <!-- Products Start -->
    <div class="container-fluid py-5">
        <h2 class="section-title position-relative text-uppercase mx-xl-5 mb-4"><span class="bg-secondary pr-3">Sản phẩm liên quan</span></h2>
        <div class="row px-xl-5">
            <div class="col">
                <div class="owl-carousel related-carousel">
                    <?php while ($product = $products->fetch(PDO::FETCH_ASSOC)) : ?>
                        <?php
                        // Kiểm tra trạng thái của sản phẩm
                        $isInStock = ($product['status'] == 1);
                        ?>
                        <div class="product-item bg-light mb-4">
                            <div class="product-img position-relative overflow-hidden">
                                <img class="img-fluid w-100" src="/phpbanhang/public/images/products/<?php echo $product['image']; ?>" alt="<?php echo $product['name']; ?>">
                                <div class="product-action">
                                    <?php if ($isInStock) : ?>
                                        <a class="btn btn-outline-dark btn-square" href=""><i class="fa fa-shopping-cart"></i></a>
                                    <?php endif; ?>
                                    <a class="btn btn-outline-dark btn-square" href="/phpbanhang/product/detail/<?php echo $product['id']; ?>"><i class="fa fa-search"></i></a>
                                </div>
                            </div>
                            <div class="text-center py-4">
                                <a class="h6 text-decoration-none text-truncate" href="/phpbanhang/product/detail/<?php echo $product['id']; ?>"><?php echo $product['name']; ?></a>
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
                    <?php endwhile; ?>
                </div>
            </div>
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