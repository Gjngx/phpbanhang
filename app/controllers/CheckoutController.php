<?php
require_once('app/helpers/SessionHelper.php');
class CheckoutController
{
    private $productsModel;
    private $ordersModel;
    private $db;
    public function __construct()
    {
        $this->db = (new Database())->getConnection();
        $this->productsModel = new ProductModel($this->db);
        $this->ordersModel = new OrdersModel($this->db);
    }
    public function index()
    {
        if (!SessionHelper::isLoggedInCustom()) {
            header('Location: /phpbanhang/user/login');
            exit;
        }
        
        if (isset($_SESSION['cart']) && !empty($_SESSION['cart'])) {
            $idProducts = array_keys($_SESSION['cart']);
            $cartProducts = $this->productsModel->getProductsByIds($idProducts);
            include_once 'app/views/users/checkout.php';
        }else{
            header('Location: /phpbanhang/product/viewcart');
            exit;
        }

    }

    public function listorders()
    {
        if (!SessionHelper::isLoggedInCustom()) {
            header('Location: /phpbanhang/user/login');
            exit;
        }
        $id = $_SESSION['customer_id'];
        $orders = $this->ordersModel->getOdersByIdUser($id);
        include_once 'app/views/users/listorder.php';
    }

    public function detailorder($id)
    {
        if (!SessionHelper::isLoggedInCustom()) {
            header('Location: /phpbanhang/user/login');
            exit;
        }
        $orderProducts = $this->ordersModel->getProductsByOrders($id);
        $order = $this->ordersModel->getOdersById($id);
        include_once 'app/views/users/detailorder.php';
    }

    public function checkout()
    {
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            // Làm sạch và kiểm tra dữ liệu đầu vào         
            $customerName = htmlspecialchars(strip_tags($_POST['customerName'] ?? ''));
            $email = htmlspecialchars(strip_tags($_POST['email'] ?? ''));
            $phone = htmlspecialchars(strip_tags($_POST['phone'] ?? ''));
            $createDate = date('Y-m-d H:i:s');
            $total = htmlspecialchars(strip_tags($_POST['total'] ?? ''));
            $status = "1";
            $address = htmlspecialchars(strip_tags($_POST['address'] ?? ''));
            $id_user = $_SESSION['customer_id'];
            
            if (empty($customerName) || empty($email) || empty($phone) || empty($address)) {
                $_SESSION['errorMessage'] = "Vui lòng điền đầy đủ thông tin.";
                header('location: /phpbanhang/checkout');
                exit();
            }
            // Kiểm tra xác thực và phân quyền ở đây nếu cần
            if (!preg_match('/(84|0[3|5|7|8|9])+([0-9]{8})\b/', $phone)) {
                $_SESSION['errorMessage'] = "Số điện thoại không hợp lệ.";
                header('location: /phpbanhang/checkout');
                exit();
            }
            // Thử tạo sản phẩm mới
            $result = $this->ordersModel->createOrder($customerName, $email, $phone, $address, $createDate, $total, $status, $id_user);
            if ($result['success']) {
                $orderId = $this->ordersModel->getLastOrderId();
                if ($orderId !== null) {
                    foreach ($_POST['products'] as $productId => $productInfo) {
                        $productId = htmlspecialchars(strip_tags($productId));
                        $quantity = htmlspecialchars(strip_tags($productInfo['quantity']));
                        $resultProduct = $this->ordersModel->createOrderProduct($orderId, $productId, $quantity);
                    }
                    if ($resultProduct['success']) {
                    // Lưu thông báo thành công vào session
                    $_SESSION['successMessage'] = $result['message'];
                    unset($_SESSION['cart']);
                    // Chuyển hướng người dùng sau khi cập nhật thành công
                    header('location: /phpbanhang/product/viewcart');
                    exit();
                    }
                }
            } else {
                // Hiển thị trang tạo sản phẩm với thông báo lỗi
                $_SESSION['errorMessage'] = $result['message'];
                header('location: /phpbanhang/checkout');
            }
        }
    }
}
