<!doctype html>
<html lang="en">

<head>
  <?php include_once("app/views/admin/partical/head.php"); ?>
  <title>Quản lý đơn hàng</title>
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
                            <a href="/phpbanhang/admin/updateorder/<?php echo $row['id']; ?>" class="btn btn-warning">Cập nhật</a>
                            <?php if (isset($_SESSION['user_idrole']) && $_SESSION['user_idrole'] === 1) : ?>
                              <a href="/phpbanhang/admin/deleteorder/<?php echo $row['id']; ?>" class="btn btn-danger" onclick="return confirm('Bạn có chắc xóa đơn hàng số <?php echo $row['id'] ?> không?')">Xóa đơn</a>
                            <?php endif; ?>
                          </td>
                        </tr>
                      <?php
                        $counter++;
                      endwhile; ?>
                    </tbody>
                  </table>

                  <div class="d-flex align-items-end flex-column">
                    <nav aria-label="Page navigation example">
                      <ul class="pagination">
                        <?php
                        // Previous page link
                        if ($currentPage > 1) {
                          echo '<li class="page-item"><a class="page-link" href="?page=' . ($currentPage - 1) . '" aria-label="Previous">&laquo;</a></li>';
                        }

                        // Display individual page links
                        for ($i = 1; $i <= $totalPages; $i++) {
                          echo '<li class="page-item ' . ($currentPage == $i ? 'active' : '') . '"><a class="page-link" href="?page=' . $i . '">' . $i . '</a></li>';
                        }

                        // Next page link
                        if ($currentPage < $totalPages) {
                          echo '<li class="page-item"><a class="page-link" href="?page=' . ($currentPage + 1) . '" aria-label="Next">&raquo;</a></li>';
                        }
                        ?>
                      </ul>
                    </nav>
                  </div>
                </div>
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