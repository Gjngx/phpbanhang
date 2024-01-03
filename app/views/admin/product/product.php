<!doctype html>
<html lang="en">

<head>
  <?php include_once("app/views/admin/partical/head.php"); ?>
  <title>Quản lý sách</title>
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
                    <h5 class="card-title fw-semibold">Sản phẩm</h5>
                  </div>
                  <a href="/phpbanhang/admin/createproduct" class="btn btn-primary">
                    Thêm mới sản phẩm
                  </a>
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
                        <th scope="col">Tên sách</th>
                        <th scope="col">Giá sách</th>
                        <th scope="col">Ngày tạo</th>
                        <th scope="col">Tác giả</th>
                        <th scope="col">Thể loại</th>
                        <th scope="col">Trạng thái</th>
                        <th scope="col">Chức năng</th>
                      </tr>
                    </thead>
                    <tbody>
                      <?php
                      $counter = 1;
                      while ($row = $products->fetch(PDO::FETCH_ASSOC)) : ?>
                        <tr>
                          <td scope="row"><?php echo $counter; ?></td>
                          <td><?php echo $row['name'] ?></td>
                          <td><?php
                              $price = $row['price'];
                              $formattedPrice = number_format($price, 0, ',', '.');
                              echo $formattedPrice . ' VND';
                              ?></td>
                          <td> <?php
                                $createDate = new DateTime($row['createDate']);
                                echo $createDate->format('d/m/Y');
                                ?></td>
                          <td><?php echo $row['authorName'] ?></td>
                          <td><?php echo $row['categoryName'] ?></td>
                          <td><?php echo ($row['status'] == 1) ? 'Còn hàng' : 'Hết hàng'; ?></td>
                          <td>
                            <a href="/phpbanhang/admin/updateproduct/<?php echo $row['id']; ?>" class="btn mb-1 btn-warning">Cập nhật</a>
                            <?php if (isset($_SESSION['user_idrole']) && $_SESSION['user_idrole'] === 1) : ?>
                            <a href="/phpbanhang/admin/deleteproduct/<?php echo $row['id']; ?>" class="btn mb-1 btn-danger" onclick="return confirm('Bạn có chắc xóa sách <?php echo $row['name'] ?> không?')">Xóa sách</a>
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