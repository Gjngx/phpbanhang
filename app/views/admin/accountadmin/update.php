<!doctype html>
<html lang="en">

<head>
    <?php include_once("app/views/admin/partical/head.php"); ?>
    <title>Cập nhật tác giả</title>
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
                            <h5 class="card-title fw-semibold mb-4">Cập nhật tác giả</h5>
                            <div class="card">
                                <div class="card-body">
                                    <?php
                                    if (isset($_SESSION['errorMessage']) && !empty($_SESSION['errorMessage'])) : ?>
                                        <div class="alert alert-danger" role="alert">
                                            <?php echo $_SESSION['errorMessage']; ?>
                                        </div>
                                        <?php unset($_SESSION['errorMessage']); ?>
                                    <?php endif; ?>
                                    <form method="post" action="/phpbanhang/admin/saveupdateadmin/<?php echo $admin['id']; ?>">
                                        <div class="mb-3">
                                            <label class="form-label">Tài khoản: </label>
                                            <label class="form-label"><?php echo $admin['username']; ?></label>
                                        </div>
                                        <div class="mb-3">
                                            <label class="form-label">Quyền</label>
                                            <select class="form-control" id="id_role" name="id_role">
                                                <?php while ($role = $roles->fetch(PDO::FETCH_ASSOC)) : ?>
                                                    <option value="<?php echo $role['id']; ?>" <?php echo ($role['id'] == $admin['id_role']) ? 'selected' : ''; ?>>
                                                        <?php echo $role['name']; ?>
                                                    </option>
                                                <?php endwhile; ?>
                                            </select>
                                        </div>
                                        <div class="d-flex justify-content-end">
                                            <a href="/phpbanhang/admin/accountadmin" class="btn btn-dark m-1">Trở về</a>
                                            <button type="submit" class="btn btn-primary m-1">Cập nhật</button>
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