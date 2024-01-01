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
        session_start();

        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $username = $_POST['username'] ?? '';
            $password = $_POST['password'] ?? '';
            if (empty($username) || empty($password)) {
                session_start();
                $_SESSION['errorMessage'] = "Vui lòng điền đầy đủ thông tin!";
                header('Location: /phpbanhang/user/login');
                exit();
            }
            $account = $this->userModel->getAccountByUserName($username);
            if ($account && password_verify($password, $account->password)) {
                $_SESSION['customer_id'] = $account->id;
                $_SESSION['customer_username'] = $account->username;
                header('Location: /phpbanhang/');
                exit;
            } else {
                $_SESSION['errorMessage'] = "Đăng nhập không thành công.";
                header('Location: /phpbanhang/user/login');
                exit;
            }
        }
    }


    public function checkRegister()
    {
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $username = $_POST['username'] ?? '';
            $password = $_POST['password'] ?? '';
            $email = $_POST['email'] ?? '';
            $hashpassword = password_hash($password, PASSWORD_DEFAULT);
            if (empty($username) || empty($email) || empty($password)) {
                session_start();
                $_SESSION['errorMessage'] = "Vui lòng điền đầy đủ thông tin!";
                header('Location: /phpbanhang/user/register');
                exit();
            }
            if (!$this->isPasswordStrongEnough($password)) {
                session_start();
                $_SESSION['errorMessage'] = "Mật khẩu phải có ít nhất 8 ký tự, 1 chữ hoa và 1 số.";
                header('Location: /phpbanhang/user/register');
                exit();
            }

            $result = $this->userModel->registerUser($username, $hashpassword, $email);

            if ($result['success']) {
                header('Location: /phpbanhang/user/login');
                exit();
            } else {
                session_start();
                $_SESSION['errorMessage'] = $result['success'];
                header('Location: /phpbanhang/user/register');
            }
        }
    }

    private function isPasswordStrongEnough($password)
    {
        return strlen($password) >= 8 && preg_match('/[A-Z]/', $password) && preg_match('/[0-9]/', $password);
    }


    public function logout()
    {
        session_start();
        unset($_SESSION['customer_id']);
        unset($_SESSION['customer_username']);
        header('Location: /phpbanhang/user/login');
        exit;
    }
}
