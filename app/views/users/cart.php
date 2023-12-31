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


    <!-- Cart Start -->
    <div class="container-fluid">
        <div class="row px-xl-5">
            <div class="col-lg-8 table-responsive mb-5">
                <table class="table table-light table-borderless table-hover text-center mb-0">
                    <thead class="thead-dark">
                        <tr>
                            <th>Tên sách</th>
                            <th>Giá sách</th>
                            <th>Số lượng</th>
                            <th>Tổng tiền</th>
                            <th>Xóa</th>
                        </tr>
                    </thead>
                    <tbody class="align-middle">
                        <?php
                        $totalPrice = 0; // Khởi tạo biến tổng tiền

                        foreach ($cartProducts as $product) :
                            $formattedPrice = number_format($product['price'], 0, ',', '.');
                            $subtotal = $_SESSION['cart'][$product['id']] * $product['price']; // Tính giá trị của từng sản phẩm trong giỏ hàng
                            $totalPrice += $subtotal; // Cập nhật tổng tiền
                        ?>
                            <tr data-product-id="<?= $product['id']; ?>" data-product-price="<?= $product['price']; ?>">
                                <td class="align-middle"><img src="/phpbanhang/public/images/products/<?= $product['image']; ?>" alt="<?= $product['name']; ?>" style="width: 50px;"> <?= $product['name']; ?></td>
                                <td class="align-middle"><?= $formattedPrice . ' VND'; ?></td>
                                <td class="align-middle">
                                    <div class="input-group quantity mx-auto" style="width: 100px;">
                                        <div class="input-group-btn">
                                            <button class="btn btn-sm btn-primary btn-minus">
                                                <i class="fa fa-minus"></i>
                                            </button>
                                        </div>
                                        <input disabled type="text" min="1" class="form-control form-control-sm bg-secondary border-0 text-center disable" value="<?php echo $_SESSION['cart'][$product['id']]; ?>">
                                        <div class="input-group-btn">
                                            <button class="btn btn-sm btn-primary btn-plus">
                                                <i class="fa fa-plus"></i>
                                            </button>
                                        </div>
                                    </div>
                                </td>
                                <td class="align-middle total-price"><?= number_format($subtotal, 0, ',', '.') . ' ₫'; ?></td>
                                <td class="align-middle">
                                    <button class="btn btn-sm btn-danger btn-remove-product" data-product-id="<?= $product['id']; ?>">
                                        <i class="fa fa-times"></i>
                                    </button>
                                </td>
                            </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
            </div>
            <div class="col-lg-4">
                <form class="mb-30" action="/phpbanhang/checkout">
                </form>
                <h5 class="section-title position-relative text-uppercase mb-3"><span class="bg-secondary pr-3">Tóm tắt giỏ hàng</span></h5>
                <div class="bg-light p-30 mb-5">
                    <div class="pt-2">
                        <div class="d-flex justify-content-between mt-2">
                            <h5>Tổng tiền</h5>
                            <h5 id="cart-total"><?= number_format($totalPrice, 0, ',', '.') . '₫'; ?></h5>
                        </div>
                        <button class="btn btn-block btn-primary font-weight-bold my-3 py-3">Đặt hàng</button>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Cart End -->




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
    <script src="/phpbanhang/public/user/mail/contact.js"></script>

    <!-- Template Javascript -->
    <script src="/phpbanhang/public/user/js/main.js"></script>
    <script src="/phpbanhang/public/user/js/cartupdate.js"></script>
</body>

</html>