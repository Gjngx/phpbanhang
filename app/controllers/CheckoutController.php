<?php
class CheckoutController {
    private $productsModel;
    private $ordersModel;
    private $db;
    public function __construct()
    {
        $this->db = (new Database())->getConnection();
        $this->productsModel = new ProductModel($this->db);
        $this->ordersModel = new OrdersModel($this->db);
    }
    public function index() {
        session_start();
        if (isset($_SESSION['cart']) && !empty($_SESSION['cart'])) {
            $idProducts = array_keys($_SESSION['cart']);
            $cartProducts = $this->productsModel->getProductsByIds($idProducts);
            include_once 'app/views/users/checkout.php';
        }
    }

    public function checkout() {
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            // Làm sạch và kiểm tra dữ liệu đầu vào         
            $customerName = htmlspecialchars(strip_tags($_POST['customerName'] ?? ''));
            $email = htmlspecialchars(strip_tags($_POST['email'] ?? ''));
            $phone = htmlspecialchars(strip_tags($_POST['phone'] ?? ''));
            $createDate = date('Y-m-d H:i:s');
            $total = htmlspecialchars(strip_tags($_POST['total'] ?? ''));
            $status = htmlspecialchars(strip_tags($_POST['status'] ?? ''));
            $address = htmlspecialchars(strip_tags($_POST['address'] ?? ''));
            $id_user = htmlspecialchars(strip_tags($_POST['id_user'] ?? ''));
            // Kiểm tra xác thực và phân quyền ở đây nếu cần

            // Thử tạo sản phẩm mới
            $result = $this->ordersModel->createOrder($customerName, $email, $phone, $address, $createDate, $total, $status, $id_user);

            if ($result['success']) {
                // Lưu thông báo thành công vào session
                $_SESSION['successMessage'] = $result['message'];
                // Chuyển hướng người dùng sau khi cập nhật thành công
                header('location: /phpbanhang/admin/checkout');
                exit();
            } else {
                // Hiển thị trang tạo sản phẩm với thông báo lỗi
                $_SESSION['errorMessage'] = $result['message'];
                header('location: /phpbanhang/admin/checkout');
            }
        }
    }
}

