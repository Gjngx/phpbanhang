<!doctype html>
<html lang="en">

<head>
    <?php include_once("app/views/admin/partical/head.php"); ?>
    <title>Thông tin tài khoản</title>
</head>

<body>
    <!--  Body Wrapper -->
    <div class="page-wrapper" id="main-wrapper" data-layout="vertical" data-navbarbg="skin6" data-sidebartype="full" data-sidebar-position="fixed" data-header-position="fixed">
        <!-- Sidebar Start -->
        <?php include_once("app/views/admin/partical/sidebar.php"); ?>
        <!--  Sidebar End -->
        <!--  Main wrapper -->
        <div class="body-wrapper">
            <!--  Header Start -->
            <?php include_once("app/views/admin/partical/header.php"); ?>
            <!--  Header End -->
            <div class="container-fluid">
                <!--  Row 1 -->
                <div class="row">
                    <div class="col-lg d-flex align-items-strech">
                        <div class="card w-100">
                            <div class="card-body">
                                <div class="d-sm-flex d-block align-items-center justify-content-between mb-9">
                                    <div class="mb-3 mb-sm-0">
                                        <h5 class="card-title fw-semibold">Đổi mật khẩu</h5>
                                    </div>
                                </div>
                                <form method="POST" , action="/phpbanhang/admin/saveupdatepasswordprofile/<?php echo $admin['id'] ?>">
                                    <div class="row">
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
                                        <div class="col-sm-3">
                                            <p class="mb-0">Tên tài khoản</p>
                                        </div>
                                        <div class="col-sm-9">
                                            <input type="text" class="form-control" id="username" name="username" value="<?php echo $admin['username']; ?>" readonly>
                                        </div>
                                    </div>
                                    <hr>
                                    <div class="row">
                                        <div class="col-sm-3">
                                            <p class="mb-0">Mật khẩu</p>
                                        </div>
                                        <div class="col-sm-9">
                                            <input type="password" class="form-control" id="password" name="password" placeholder="Nhập mật khẩu">
                                        </div>
                                    </div>
                                    <hr>
                                    <div class="row">
                                        <div class="col-sm-3">
                                            <p class="mb-0">xác nhận mật khẩu</p>
                                        </div>
                                        <div class="col-sm-9">
                                            <input type="password" class="form-control" id="confirmpassword" name="confirmpassword" placeholder="Nhập lại mật khẩu">
                                        </div>
                                    </div>
                                    <hr>
                                    <div class="row">
                                        <div class="col-sm-3">
                                            <p class="mb-0">Mật khẩu mới</p>
                                        </div>
                                        <div class="col-sm-9">
                                            <input type="password" class="form-control" id="newpassword" name="newpassword" placeholder="Nhập mật khẩu mới">
                                        </div>
                                    </div>
                                    <br>
                                    <div class="d-flex justify-content-end">
                                        <a href="/phpbanhang/admin" class="btn btn-dark m-1">Trở về</a>
                                        <button type="submit" class="btn btn-primary m-1">Đổi mật khẩu</button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
                <?php include_once("app/views/admin/partical/footer.php"); ?>
            </div>
        </div>
    </div>
    <script src="/phpbanhang/public/libs/jquery/dist/jquery.min.js"></script>
    <script src="/phpbanhang/public/libs/bootstrap/dist/js/bootstrap.bundle.min.js"></script>
    <script src="/phpbanhang/public/js/sidebarmenu.js"></script>
    <script src="/phpbanhang/public/js/app.min.js"></script>
    <script src="/phpbanhang/public/libs/apexcharts/dist/apexcharts.min.js"></script>
    <script src="/phpbanhang/public/libs/simplebar/dist/simplebar.js"></script>
    <script src="/phpbanhang/public/js/dashboard.js"></script>
</body>

</html>