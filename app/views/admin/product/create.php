<!doctype html>
<html lang="en">

<head>
    <?php include_once("app/views/admin/partical/head.php"); ?>
    <title>Thêm sách mới</title>
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
                <div class="container-fluid">
                    <div class="card">
                        <div class="card-body">
                            <h5 class="card-title fw-semibold mb-4">Thêm sách mới</h5>
                            <div class="card">
                                <div class="card-body">
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
                                    <form method="post" action="/phpbanhang/admin/saveproduct" enctype="multipart/form-data">
                                        <div class="mb-3">
                                            <label class="form-label">Tên sách</label>
                                            <input type="text" class="form-control" id="name" name="name" placeholder="Nhập tên sách">
                                        </div>
                                        <div class="mb-3">
                                            <label class="form-label">Ảnh sách</label>
                                            <input type="file" class="form-control" id="image" name="image">
                                        </div>
                                        <div class="mb-3">
                                            <label class="form-label">Thể loại</label>
                                            <select class="form-control" id="id_category" name="id_category">
                                                <?php while ($category = $categories->fetch(PDO::FETCH_ASSOC)) : ?>
                                                    <option value="<?php echo $category['id']; ?>"><?php echo $category['name']; ?></option>
                                                <?php endwhile; ?>
                                            </select>
                                        </div>
                                        <div class="mb-3">
                                            <label class="form-label">Tác giả</label>
                                            <select class="form-control" id="id_author" name="id_author">
                                                <?php while ($author = $authors->fetch(PDO::FETCH_ASSOC)) : ?>
                                                    <option value="<?php echo $author['id']; ?>"><?php echo $author['name']; ?></option>
                                                <?php endwhile; ?>
                                            </select>
                                        </div>
                                        <div class="mb-3">
                                            <label class="form-label">Giá sách</label>
                                            <input type="number" class="form-control" id="price" name="price" placeholder="Nhập giá sách">
                                        </div>
                                        <div class="mb-3">
                                            <label class="form-label">Mô tả sách</label>
                                            <textarea rows="3" cols="50" type="text" class="form-control" id="description" name="description" placeholder="Nhập mô tả sách"></textarea>
                                        </div>
                                        <div class="mb-3">
                                            <label class="form-label">Trạng thái</label>
                                            <select class="form-control" id="status" name="status">
                                                <option value="1">Còn bán</option>
                                                <option value="0">Hết bán</option>
                                            </select>
                                        </div>
                                        <div class="d-flex justify-content-end">
                                            <a href="/phpbanhang/admin/product" class="btn btn-dark m-1">Trở về</a>
                                            <button type="submit" class="btn btn-primary m-1">Thêm mới</button>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <script src="/phpbanhang/public/libs/jquery/dist/jquery.min.js"></script>
    <script src="/phpbanhang/public/libs/bootstrap/dist/js/bootstrap.bundle.min.js"></script>
    <script src="/phpbanhang/public/js/sidebarmenu.js"></script>
    <script src="/phpbanhang/public/js/app.min.js"></script>
    <script src="/phpbanhang/public/libs/simplebar/dist/simplebar.js"></script>
</body>

</html>