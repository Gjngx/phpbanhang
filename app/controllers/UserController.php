<?php
class UserController
{
    private $userModel;
    private $db;
    public function __construct()
    {
        $this->db = (new Database())->getConnection();
        $this->userModel = new UserModel($this->db);
    }
    public function login()
    {
        include_once 'app/views/users/login.php';
    }
    public function register()
    {
        include_once 'app/views/users/register.php';
    }
    public function userinfo()
    {
        include_once 'app/views/users/info.php';
    }
    public function checkLogin()
    {
        // Kiểm tra xem liệu form đã được submit
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $username = $_POST['username'] ?? '';
            $password = $_POST['password'] ?? '';

            $account = $this->userModel->getAccountByUserName($username);
            if ($account) {
                $pwd_hashed = $account->password;
                //check mat khau
                if (password_verify($password, $pwd_hashed)) {

                    session_start();

                    $_SESSION['customer_id'] = $account->id;
                    $_SESSION['customer_username'] = $account->username;

                    header('Location: /phpbanhang/');
                    exit;
                } else {
                    echo "Mật khẩu không chính xác.";
                }
            } else {
                echo "Tài khoản không tồn tại";
            }
        }
    }

    public function checkRegister()
    {
        // Kiểm tra xem liệu form đã được submit
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $username = $_POST['username'] ?? '';
            $password = $_POST['password'] ?? '';

            // Gọi hàm đăng ký người dùng
            if ($this->userModel->registerUser($username, $password)) {
                // echo "Đăng ký tài khoản thành công.";

                header('Location: /phpbanhang/user/login');
            } else {
                echo "Đăng ký tài khoản không thành công.";
            }
        }
    }

    public function logout()
    {
        session_start();
        session_unset();
        session_destroy();
        header('Location: /phpbanhang/user/login');
        exit;
    }
}
