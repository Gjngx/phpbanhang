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
        
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $username = $_POST['username'] ?? '';
            $password = $_POST['password'] ?? '';

            $account = $this->userModel->getAccountByUserName($username);
            session_start();
            if ($account) {
                $pwd_hashed = $account->password;
                //check mat khau
                if (password_verify($password, $pwd_hashed)) {
                    
                    $_SESSION['customer_id'] = $account->id;
                    $_SESSION['customer_username'] = $account->username;
                    header('Location: /phpbanhang/');
                    exit;
                } else {
                    $_SESSION['errorMessage'] = "Mật khẩu không chính xác.";
                    header('Location: /phpbanhang/user/login');
                }
            } else {
                $_SESSION['errorMessage'] = "Tài khoản không tồn tại";
                header('Location: /phpbanhang/user/login');
            }
        }
    }

    public function checkRegister()
    {
        
        // Kiểm tra xem liệu form đã được submit
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $username = $_POST['username'] ?? '';
            $password = $_POST['password'] ?? '';
            $email = $_POST['email'] ?? '';
            $hashpassword = password_hash($password, PASSWORD_DEFAULT);
            // Gọi hàm đăng ký người dùng

            $result = $this->userModel->registerUser($username, $hashpassword, $email);
            session_start();
            if ($result['success']) {
                header('Location: /phpbanhang/user/login');
                exit();
            } else {
                $_SESSION['errorMessage'] = $result['success'];
                header('Location: /phpbanhang/user/register');
            }
        }
    }

    public function logout()
    {
        session_start();
        session_destroy();
        header('Location: /phpbanhang/user/login');
        exit;
    }
}
