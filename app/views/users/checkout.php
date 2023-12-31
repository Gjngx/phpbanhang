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


    <!-- Checkout Start -->
    <div class="container-fluid">
        <div class="row px-xl-5">

                <div class="col-lg-8">
                    <h5 class="section-title position-relative text-uppercase mb-3"><span class="bg-secondary pr-3">Địa
                            chỉ
                            giao hàng</span></h5>
                    <div class="bg-light p-30 mb-5">
                    <form method="POST">
                        <div class="row">
                            <div class="col-md-6 form-group">
                                <label>Tên khách hàng</label>
                                <input class="form-control" type="text" name="customerName" placeholder="John">
                            </div>
                            <div class="col-md-6 form-group">
                                <label>E-mail</label>
                                <input class="form-control" type="text" name= "email " placeholder="example@email.com">
                            </div>
                            <div class="col-md-6 form-group">
                                <label>Số điện thoại</label>
                                <input class="form-control" type="text" name= "phone " placeholder="+123 456 789">
                            </div>
                            <div class="col-md-6 form-group">
                                <label>Địa chỉ</label>
                                <input class="form-control" type="text" name = " address" placeholder="123 Street">
                            </div>
                        </div>
                    </form>
                    </div>
                </div>
                <div class="col-lg-4">
                    <h5 class="section-title position-relative text-uppercase mb-3"><span class="bg-secondary pr-3">Chi
                            tiết
                            hóa đơn </span></h5>
                    <div class="bg-light p-30 mb-5">
                        <div class="border-bottom">
                            <h6 class="mb-3">Sản phẩm</h6>
                            <?php
                            $totalPrice = 0;
                            if (isset($cartProducts) && is_array($cartProducts)) {
                                foreach ($cartProducts as $product) {
                                    $subtotal = $_SESSION['cart'][$product['id']] * $product['price'];
                                    $totalPrice += $subtotal
                                        ?>
                                    <div class="d-flex justify-content-between">
                                        <p>
                                            <?= $product['name']; ?>
                                        </p>
                                        <p>
                                            <?= number_format($subtotal, 0, ',', '.') . ' ₫'; ?>
                                        </p>
                                    </div>
                                    <?php
                                }
                            }
                            ?>
                        </div>

                        <div class="border-bottom pt-3 pb-2">
                            <div class="d-flex justify-content-between mb-3">
                                <h6>Tổng tiền</h6>
                                <h6>
                                    <?= number_format($totalPrice, 0, ',', '.') . ' ₫'; ?>
                                </h6>
                            </div>
                        </div>

                    </div>

                    <div class="mb-5">
                        <h5 class="section-title position-relative text-uppercase mb-3"><span
                                class="bg-secondary pr-3">Thanh toán</span></h5>
                        <div class="bg-light p-30">
                            <div class="form-group">
                                <div class="custom-control custom-radio">
                                    <input type="radio" class="custom-control-input" name="payment" id="paypal">
                                    <label class="custom-control-label" for="paypal">Paypal</label>
                                </div>
                            </div>
                            <div class="form-group">
                                <div class="custom-control custom-radio">
                                    <input type="radio" class="custom-control-input" name="payment" id="directcheck">
                                    <label class="custom-control-label" for="directcheck">Direct Check</label>
                                </div>
                            </div>
                            <div class="form-group mb-4">
                                <div class="custom-control custom-radio">
                                    <input type="radio" class="custom-control-input" name="payment" id="banktransfer">
                                    <label class="custom-control-label" for="banktransfer">Bank Transfer</label>
                                </div>
                            </div>
                            <a class="btn btn-block btn-primary font-weight-bold py-3"
                                onclick="return confirm('Bạn có chắc chắn muốn đặt hàng?')">Xác nhận đặt hàng</a>
                        </div>
                    </div>
                </div>

        </div>
    </div>
    <!-- Checkout End -->


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