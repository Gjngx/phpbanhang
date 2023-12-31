<?php
$this->db = (new Database())->getConnection();
$this->categoryModel = new CategoryModel($this->db);
$categories = $this->categoryModel->getCategories()->fetchAll(PDO::FETCH_ASSOC);
?>
<div class="row align-items-center bg-light py-3 px-xl-5 d-none d-lg-flex">
    <div class="col-lg-4">
        <a href="/phpbanhang" class="text-decoration-none">
            <span class="h1 text-uppercase text-primary bg-dark px-2">GPPT</span>
            <span class="h1 text-uppercase text-dark bg-primary px-2 ml-n1">Bookstore</span>
        </a>
    </div>
    <div class="col-lg-4 col-6 text-left">
        <form method="POST" action="/phpbanhang/product/fineNameProduct">
            <div class="input-group">
                <input type="text" class="form-control" id = "name" name="name" placeholder="Tìm kiếm sách">
                <div class="input-group-append">
                    <button class="input-group-text bg-transparent text-primary">
                        <i class="fa fa-search"></i>
                    </button>
                </div>
            </div>
        </form>
    </div>
    <div class="col-lg-4 col-6 text-right">
        <p class="m-0">Dịch vụ khách hàng</p>
        <h5 class="m-0">+012 345 6789</h5>
    </div>
</div>
<div class="container-fluid bg-dark mb-30">
    <div class="row px-xl-5">
        <div class="col-lg-3 d-none d-lg-block">
            <a class="btn d-flex align-items-center justify-content-between bg-primary w-100" data-toggle="collapse" href="#navbar-vertical" style="height: 65px; padding: 0 30px;">
                <h6 class="text-dark m-0"><i class="fa fa-bars mr-2"></i>Thể loại</h6>
                <i class="fa fa-angle-down text-dark"></i>
            </a>
            <nav class="collapse position-absolute navbar navbar-vertical navbar-light align-items-start p-0 bg-light" id="navbar-vertical" style="width: calc(100% - 30px); z-index: 999;">
                <div class="navbar-nav w-100">
                    <?php
                    $categories = $this->categoryModel->getCategories();
                    while ($category = $categories->fetch(PDO::FETCH_ASSOC)) : ?>
                        <a href="/phpbanhang/category/product/<?php echo $category['id']; ?>" class="nav-item nav-link"><?php echo $category['name']; ?></a>
                    <?php endwhile; ?>
                </div>
            </nav>
        </div>
        <div class="col-lg-9">
            <nav class="navbar navbar-expand-lg bg-dark navbar-dark py-3 py-lg-0 px-0">
                <a href="" class="text-decoration-none d-block d-lg-none">
                    <span class="h1 text-uppercase text-dark bg-light px-2">GPPT</span>
                    <span class="h1 text-uppercase text-light bg-primary px-2 ml-n1">Bookstore</span>
                </a>
                <button type="button" class="navbar-toggler" data-toggle="collapse" data-target="#navbarCollapse">
                    <span class="navbar-toggler-icon"></span>
                </button>
                <div class="collapse navbar-collapse justify-content-between" id="navbarCollapse">
                    <div class="navbar-nav mr-auto py-0">
                        <a href="/phpbanhang" class="nav-item nav-link">Trang chủ</a>
                        <a href="/phpbanhang/product" class="nav-item nav-link">Sách</a>
                        <a href="/phpbanhang/contact" class="nav-item nav-link">Liên hệ</a>
                    </div>
                    <div class="navbar-nav ml-auto py-0 d-none d-lg-block">
                        <a href="/phpbanhang/product/viewcart" class="btn px-0 ml-3">
                            <i class="fas fa-shopping-cart text-primary"></i>
                        </a>
                        
                        <?php if (isset($_SESSION['customer_id'])) : ?> 
                            <a href='/phpbanhang/user/info' class='btn px-0 ml-3'><i class='fa-solid fa-user text-primary'></i></a>
                            <a href='/phpbanhang/user/logout' class='btn px-0 ml-3'><i class='fa-solid fa-right-from-bracket text-primary'></i></a>
                        <?php else :?>
                            <a href='/phpbanhang/user/login'><i class='fa-solid fa-right-to-bracket text-primary'></i></a>
                        <?php endif ?>
                        </a>
                    </div>
                </div>
            </nav>
        </div>
    </div>
</div>
<script>
    var currentPath = window.location.pathname.toLowerCase();
    var navLinks = document.querySelectorAll('.navbar-nav a');
    navLinks.forEach(function(link) {
        var linkPath = link.getAttribute('href').toLowerCase();
        if (currentPath === linkPath || (currentPath === '/' && linkPath === '/phpbanhang')) {
            // Nếu khớp, thêm lớp 'active'
            link.classList.add('active');
        } else {
            link.classList.remove('active');
        }
    });
</script>