<!doctype html>
<html lang="en">

<head>
    <?php include_once("app/views/admin/partical/head.php"); ?>
    <title>Thông tin đơn hàng</title>
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
                                <form method="POST" action="/phpbanhang/admin/saveupdateorder/<?php echo $order['id'] ?>">
                                    <div class="row">
                                        <div class="col-sm-3">
                                            <p class="mb-0">Trạng thái</p>
                                        </div>
                                        <div class="col-sm-9">
                                            <div class="mb-3">
                                                <select class="form-control" id="status" name="status">
                                                    <option value="1" <?php echo ($order["status"] == 1) ? 'selected' : ''; ?>>Đang chuẩn bị</option>
                                                    <option value="2" <?php echo ($order["status"] == 2) ? 'selected' : ''; ?>>Đang giao</option>
                                                    <option value="3" <?php echo ($order["status"] == 3) ? 'selected' : ''; ?>>Đã hoàn thành</option>
                                                </select>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="d-flex justify-content-end">
                                        <a href="/phpbanhang/admin/orders" class="btn btn-dark m-1">Trở về</a>
                                        <button type="submit" class="btn btn-primary m-1">Cập nhật</button>
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