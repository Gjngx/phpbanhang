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
    <div class="container-fluid">
        <div class="row px-xl-5">
            <div class="col-lg d-flex align-items-strech">
                <div class="card w-100">
                    <div class="card-body">
                        <div class="d-sm-flex d-block align-items-center justify-content-between mb-9">
                            <div class="mb-3 mb-sm-0">
                                <h5 class="card-title fw-semibold">Thông tin đơn hàng</h5>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-sm-3">
                                <p class="mb-0">Số hóa đơn</p>
                            </div>
                            <div class="col-sm-9">
                                <p class="text-muted mb-0"><?php echo $order['id'] ?></p>
                            </div>
                        </div>
                        <hr>
                        <div class="row">
                            <div class="col-sm-3">
                                <p class="mb-0">Tên khách hàng</p>
                            </div>
                            <div class="col-sm-9">
                                <p class="text-muted mb-0"><?php echo $order['customerName'] ?></p>
                            </div>
                        </div>
                        <hr>
                        <div class="row">
                            <div class="col-sm-3">
                                <p class="mb-0">Chi tiết hóa đơn</p>
                            </div>
                            <div class="col-sm-9">
                                <div class="mb-3">
                                    <table class="table table-hover">
                                        <thead>
                                            <tr>
                                                <th scope="col">#</th>
                                                <th scope="col">Tên sản phẩm</th>
                                                <th scope="col">Giá</th>
                                                <th scope="col">Số lượng</th>
                                                <th scope="col">Tổng tiền</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php $counter = 1;
                                            while ($row = $orderProducts->fetch(PDO::FETCH_ASSOC)) : ?>
                                                <tr>
                                                    <td scope="row"><?php echo $counter; ?></td>
                                                    <td><?php echo $row['name'] ?></td>
                                                    <td><?php echo $row['price'] ?></td>
                                                    <td><?php echo $row['amount'] ?></td>
                                                    <td><?= number_format($row['total_price'], 0, ',', '.') . ' ₫'; ?></td>
                                                </tr>
                                        </tbody>
                                    <?php
                                                $counter++;
                                            endwhile; ?>
                                    </table>
                                </div>
                            </div>
                        </div>
                        <hr>
                        <div class="row">
                            <div class="col-sm-3">
                                <p class="mb-0">Địa chỉ giao hàng</p>
                            </div>
                            <div class="col-sm-9">
                                <p class="text-muted mb-0"><?php echo $order['address'] ?></p>
                            </div>
                        </div>
                        <hr>
                        <div class="row">
                            <div class="col-sm-3">
                                <p class="mb-0">Email</p>
                            </div>
                            <div class="col-sm-9">
                                <p class="text-muted mb-0"><?php echo $order['email'] ?></p>
                            </div>
                        </div>
                        <hr>
                        <div class="row">
                            <div class="col-sm-3">
                                <p class="mb-0">Số điện thoại</p>
                            </div>
                            <div class="col-sm-9">
                                <p class="text-muted mb-0"><?php echo $order['phone'] ?></p>
                            </div>
                        </div>
                        <hr>
                        <div class="row">
                            <div class="col-sm-3">
                                <p class="mb-0">Tổng tiền đơn hàng</p>
                            </div>
                            <div class="col-sm-9">
                                <p class="text-muted mb-0"><?= number_format($order['total'], 0, ',', '.') . ' ₫'; ?></p>
                            </div>
                        </div>
                        <hr>
                        <div class="row">
                            <div class="col-sm-3">
                                <p class="mb-0">Trạng thái</p>
                            </div>
                            <div class="col-sm-9">
                                <div class="mb-3">
                                    <p class="text-muted mb-0"> <?php
                                                                $statusMapping = [
                                                                    1 => 'Đang chuẩn bị',
                                                                    2 => 'Đang giao',
                                                                    3 => 'Đã hoàn thành',
                                                                ];

                                                                $status = $order['status'];

                                                                echo isset($statusMapping[$status]) ? $statusMapping[$status] : 'Trạng thái không xác định';
                                                                ?></p>
                                </div>
                            </div>
                        </div>

                        <div class="d-flex justify-content-end">
                            <a href="/phpbanhang/checkout/listorders" class="btn btn-dark m-1">Trở về</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
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