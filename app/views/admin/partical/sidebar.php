<aside class="left-sidebar">
  <!-- Sidebar scroll-->
  <div>
    <div class="brand-logo d-flex align-items-center justify-content-between">
      <a href="/phpbanhang/admin" class="text-nowrap logo-img">
        <img src="/phpbanhang/public/images/logos/dark-logo.svg" width="180" alt="" />
      </a>
      <div class="close-btn d-xl-none d-block sidebartoggler cursor-pointer" id="sidebarCollapse">
        <i class="ti ti-x fs-8"></i>
      </div>
    </div>
    <!-- Sidebar navigation-->
    <nav class="sidebar-nav scroll-sidebar" data-simplebar="">
      <ul id="sidebarnav">
        <li class="nav-small-cap">
          <i class="ti ti-dots nav-small-cap-icon fs-4"></i>
          <span class="hide-menu">Home</span>
        </li>
        <li class="sidebar-item">
          <a class="sidebar-link" href="/phpbanhang/admin" aria-expanded="false">
            <span>
              <i class="ti ti-layout-dashboard"></i>
            </span>
            <span class="hide-menu">Trang chủ</span>
          </a>
        </li>
        <li class="nav-small-cap">
          <i class="ti ti-dots nav-small-cap-icon fs-4"></i>
          <span class="hide-menu">Nhân viên</span>
        </li>
        <li class="sidebar-item">
          <a class="sidebar-link" href="/phpbanhang/admin/category" aria-expanded="false">
            <span>
              <i class="ti ti-category"></i>
            </span>
            <span class="hide-menu">Thể loại</span>
          </a>
        </li>
        <li class="sidebar-item">
          <a class="sidebar-link" href="/phpbanhang/admin/author" aria-expanded="false">
            <span>
              <i class="ti ti-home"></i>
            </span>
            <span class="hide-menu">Tác giả</span>
          </a>
        </li>
        <li class="sidebar-item">
          <a class="sidebar-link" href="/phpbanhang/admin/product" aria-expanded="false">
            <span>
              <i class="ti ti-books"></i>
            </span>
            <span class="hide-menu">Sản phẩm</span>
          </a>
        </li>
        <li class="sidebar-item">
          <a class="sidebar-link" href="/phpbanhang/admin/orders" aria-expanded="false">
            <span>
              <i class="ti ti-file-description"></i>
            </span>
            <span class="hide-menu">Hóa đơn</span>
          </a>
        </li>
        <li class="sidebar-item">
          <a class="sidebar-link" href="/phpbanhang/admin/chart" aria-expanded="false">
            <span>
              <i class="ti ti-chart-dots-2"></i>
            </span>
            <span class="hide-menu">Thống kê</span>
          </a>
        </li>
        <?php
        if (isset($_SESSION['user_idrole']) && $_SESSION['user_idrole'] === 1) : ?>
          <li class="nav-small-cap">
            <i class="ti ti-dots nav-small-cap-icon fs-4"></i>
            <span class="hide-menu">Quản trị viên</span>
          </li>
          <li class="sidebar-item">
            <a class="sidebar-link" href="/phpbanhang/admin/accountadmin" aria-expanded="false">
              <span>
                <i class="ti ti-user"></i>
              </span>
              <span class="hide-menu">Tài khoản Amin</span>
            </a>
          </li>
          <li class="sidebar-item">
            <a class="sidebar-link" href="/phpbanhang/admin/accountuser" aria-expanded="false">
              <span>
                <i class="ti ti-user-plus"></i>
              </span>
              <span class="hide-menu">Tài khoản người dùng</span>
            </a>
          </li>
        <?php endif; ?>

      </ul>
    </nav>
    <!-- End Sidebar navigation -->
  </div>
  <!-- End Sidebar scroll-->
</aside>