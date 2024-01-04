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


    <!-- Shop Start -->
    <div class="container-fluid">
        <div class="row px-xl-5">
            <!-- Shop Sidebar Start -->
            <div class="col-lg-3 col-md-4">
                <!-- Price Start -->
                <h5 class="section-title position-relative text-uppercase mb-3"><span class="bg-secondary pr-3">Lọc theo giá</span></h5>
                <div class="bg-light p-4 mb-30">
                    <form>
                        <div class="custom-control custom-checkbox d-flex align-items-center justify-content-between mb-3">
                            <input type="checkbox" class="custom-control-input" checked id="price-all">
                            <label class="custom-control-label" for="price-all">Giá</label>
                            <span class="badge border font-weight-normal">1000</span>
                        </div>
                        <div class="custom-control custom-checkbox d-flex align-items-center justify-content-between mb-3">
                            <input type="checkbox" class="custom-control-input" id="price-1">
                            <label class="custom-control-label" for="price-1">$0 - $100</label>
                            <span class="badge border font-weight-normal">150</span>
                        </div>
                        <div class="custom-control custom-checkbox d-flex align-items-center justify-content-between mb-3">
                            <input type="checkbox" class="custom-control-input" id="price-2">
                            <label class="custom-control-label" for="price-2">$100 - $200</label>
                            <span class="badge border font-weight-normal">295</span>
                        </div>
                        <div class="custom-control custom-checkbox d-flex align-items-center justify-content-between mb-3">
                            <input type="checkbox" class="custom-control-input" id="price-3">
                            <label class="custom-control-label" for="price-3">$200 - $300</label>
                            <span class="badge border font-weight-normal">246</span>
                        </div>
                        <div class="custom-control custom-checkbox d-flex align-items-center justify-content-between mb-3">
                            <input type="checkbox" class="custom-control-input" id="price-4">
                            <label class="custom-control-label" for="price-4">$300 - $400</label>
                            <span class="badge border font-weight-normal">145</span>
                        </div>
                        <div class="custom-control custom-checkbox d-flex align-items-center justify-content-between">
                            <input type="checkbox" class="custom-control-input" id="price-5">
                            <label class="custom-control-label" for="price-5">$400 - $500</label>
                            <span class="badge border font-weight-normal">168</span>
                        </div>
                    </form>
                </div>
                <!-- Price End -->
            </div>
            <!-- Shop Sidebar End -->


            <!-- Shop Product Start -->
            <div class="col-lg-9 col-md-8">
                <div class="row pb-3">
                    <div class="col-12 pb-1">
                        <div class="d-flex align-items-center justify-content-between mb-4">
                            <div class="ml-2">
                                <div class="btn-group">
                                    <button type="button" class="btn btn-sm btn-light dropdown-toggle" data-toggle="dropdown">Sắp xếp</button>
                                    <div class="dropdown-menu dropdown-menu-right">
                                        <a class="dropdown-item" href="/phpbanhang/product">Mới đến cũ</a>
                                        <a class="dropdown-item" href="/phpbanhang/product/craetedateordersortbyasc">Cũ đến mới</a>
                                        <a class="dropdown-item" href="/phpbanhang/product/priceordersortbyasc">Giá thấp đến cao</a>
                                        <a class="dropdown-item" href="/phpbanhang/product/priceorderdecbydecs">Giá cao đến thấp</a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
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
                        </div>
                    <?php endwhile; ?>
                </div>
            </div>
            <!-- Shop Product End -->
        </div>
    </div>
    <!-- Shop End -->


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