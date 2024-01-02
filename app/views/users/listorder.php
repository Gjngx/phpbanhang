
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
                                <h5 class="card-title fw-semibold">Đơn hàng</h5>
                            </div>
                        </div>
                        <?php
                        if (isset($_SESSION['successMessage']) && !empty($_SESSION['successMessage'])) : ?>
                            <div class="alert alert-success" role="alert">
                                <?php echo $_SESSION['successMessage']; ?>
                            </div>
                            <?php unset($_SESSION['successMessage']); ?>
                        <?php endif; ?>
                        <?php
                        if (isset($_SESSION['errorMessage']) && !empty($_SESSION['errorMessage'])) : ?>
                            <div class="alert alert-danger" role="alert">
                                <?php echo $_SESSION['errorMessage']; ?>
                            </div>
                            <?php unset($_SESSION['errorMessage']); ?>
                        <?php endif; ?>
                        <div class="row">
                            <table class="table table-hover">
                                <thead>
                                    <tr>
                                        <th scope="col">#</th>
                                        <th scope="col">Số hóa đơn</th>
                                        <th scope="col">Tên khách hàng</th>
                                        <th scope="col">Số điện thoại</th>
                                        <th scope="col">Địa chỉ</th>
                                        <th scope="col">Trạng thái</th>
                                        <th scope="col">Chức năng</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                    $counter = 1;
                                    while ($row = $orders->fetch(PDO::FETCH_ASSOC)) : ?>
                                        <tr>
                                            <td scope="row"><?php echo $counter; ?></td>
                                            <td><?php echo $row['id'] ?></td>
                                            <td><?php echo $row['customerName'] ?></td>
                                            <td><?php echo $row['phone'] ?></td>
                                            <td><?php echo $row['address'] ?></td>
                                            <td>
                                                <?php
                                                $statusMapping = [
                                                    1 => 'Đang chuẩn bị',
                                                    2 => 'Đang giao',
                                                    3 => 'Đã hoàn thành',
                                                ];

                                                $status = $row['status'];

                                                echo isset($statusMapping[$status]) ? $statusMapping[$status] : 'Trạng thái không xác định';
                                                ?>
                                            </td>
                                            <td>
                                                <a href="/phpbanhang/checkout/detailorder/<?php echo $row['id']; ?>" class="btn btn-warning">Chi tiết</a>
                                            </td>
                                        </tr>
                                    <?php
                                        $counter++;
                                    endwhile; ?>
                                </tbody>
                            </table>
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