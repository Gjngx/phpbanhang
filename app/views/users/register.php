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
    <section class="vh-100" style="background-color: #9A616D;">
        <div class="container py-5 h-100">
            <div class="row d-flex justify-content-center align-items-center h-100">
                <div class="col col-xl-10">
                    <div class="card" style="border-radius: 1rem;">
                        <div class="row g-0">
                            <div class="col-md-6 col-lg-5 d-none d-md-block">
                            <img src="/phpbanhang/public/user/img/sign.jpeg" alt="login form" style="border-radius: 1rem 0 0 1rem; max-width: 115%; height: 100%;" />                            </div>
                            <div class="col-md-6 col-lg-7 d-flex align-items-center">
                                <div class="card-body p-4 p-lg-5 text-black">

                                    <form action="/phpbanhang/user/checkRegister" method="post">

                                        <div class="d-flex align-items-center mb-3 pb-1">
                                            <i class="fas fa-cubes fa-2x me-3" style="color: #ff6219;"></i>
                                            <span class="h1 fw-bold mb-0">GPPT Store</span>
                                        </div>

                                        <h5 class="fw-normal mb-3 pb-3" style="letter-spacing: 1px;">Đăng ký tài khoản</h5>
                                        <?php
                                        if (isset($_SESSION['errorMessage']) && !empty($_SESSION['errorMessage'])) : ?>
                                            <div class="alert alert-danger" role="alert">
                                                <?php echo $_SESSION['errorMessage']; ?>
                                            </div>
                                            <?php unset($_SESSION['errorMessage']); ?>
                                        <?php endif; ?>
                                        <div class="form-outline">
                                            <label class="form-label" for="username">Tài khoản</label>
                                            <input type="text" name="username" class="form-control form-control-lg" />
                                        </div>

                                        <div class="form-outline">
                                            <label class="form-label" for="email">Email</label>
                                            <input type="email" name="email" class="form-control form-control-lg" />
                                        </div>

                                        <div class="form-outline">
                                            <label class="form-label" for="password">Mật khẩu</label>
                                            <input type="password" name="password" class="form-control form-control-lg" />
                                        </div>
                                        
                                        <div class="pt-3 mb-4">
                                            <button class="btn btn-dark btn-lg btn-block" type="submit">Đăng ký</button>
                                        </div>

                                        <p class="mb-5 pb-lg-2" style="color: #393f81;">Bạn đã có tài khoản ? <a href="/phpbanhang/user/login" style="color: #393f81;">Đăng nhập tại đây</a></p>
                                    </form>

                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- JavaScript Libraries -->
    <script src="https://code.jquery.com/jquery-3.4.1.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.bundle.min.js"></script>
    <script src="/phpbanhang/public/user/lib/easing/easing.min.js"></script>
    <script src="/phpbanhang/public/user/lib/owlcarousel/owl.carousel.min.js"></script>

    <!-- Contact Javascript File -->
    <script src="/phpbanhang/public/user/mail/jqBootstrapValidation.min.js"></script>
</body>

</html>