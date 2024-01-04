
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
                                <h5 class="card-title fw-semibold">Thông tin tài khoản</h5>
                            </div>
                        </div>
                        <?php
                        if (isset($_SESSION['errorMessage']) && !empty($_SESSION['errorMessage'])) : ?>
                            <div class="alert alert-danger" role="alert">
                                <?php echo $_SESSION['errorMessage']; ?>
                            </div>
                            <?php unset($_SESSION['errorMessage']); ?>
                        <?php endif; ?>
                        <?php
                        if (isset($_SESSION['successMessage']) && !empty($_SESSION['successMessage'])) : ?>
                            <div class="alert alert-success" role="alert">
                                <?php echo $_SESSION['successMessage']; ?>
                            </div>
                            <?php unset($_SESSION['successMessage']); ?>
                        <?php endif; ?>
                        <form method="POST" , action="/phpbanhang/user/saveupdateuserinfo/<?php echo $user['id'] ?>">
                            <div class="row">

                                <div class="col-sm-3">
                                    <p class="mb-0">Tên tài khoản</p>
                                </div>
                                <div class="col-sm-9">
                                    <p class="text-muted mb-0"><?php echo $user['username'] ?></p>
                                </div>
                            </div>
                            <hr>
                            <div class="row">
                                <div class="col-sm-3">
                                    <p class="mb-0">Tên khách hàng</p>
                                </div>
                                <div class="col-sm-9">
                                    <input type="text" class="form-control" id="name" name="name" placeholder="Nhập tên khách hàng" value="<?php echo $user['name'] ?>">
                                </div>
                            </div>
                            <hr>
                            <div class="row">
                                <div class="col-sm-3">
                                    <p class="mb-0">Số điện thoại</p>
                                </div>
                                <div class="col-sm-9">
                                    <input type="text" class="form-control" id="phone" name="phone" placeholder="Nhập số điện thoại" value="<?php echo $user['phone'] ?>">
                                </div>
                            </div>
                            <hr>
                            <div class="row">
                                <div class="col-sm-3">
                                    <p class="mb-0">Email</p>
                                </div>
                                <div class="col-sm-9">
                                    <input type="email" class="form-control" id="email" name="email" placeholder="Nhập email" value="<?php echo $user['email'] ?>">
                                </div>
                            </div>
                            <hr>
                            <div class="row">
                                <div class="col-sm-3">
                                    <p class="mb-0">Địa chỉ</p>
                                </div>
                                <div class="col-sm-9">
                                    <input type="text" class="form-control" id="address" name="address" placeholder="Nhập địa chỉ" value="<?php echo $user['address'] ?>">
                                </div>
                            </div>
                            <br>
                            <div class="d-flex justify-content-end">
                                <a href="/phpbanhang" class="btn btn-dark m-1">Trở về</a>
                                <button type="submit" class="btn btn-primary m-1">Cập nhật</button>
                            </div>
                        </form>
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