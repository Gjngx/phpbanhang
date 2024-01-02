<?php

class LoginAdminController
{
    private $adminModel;
    private $roleModel;
    private $db;
    public function __construct()
    {
        $this->db = (new Database())->getConnection();
        $this->adminModel = new AdminModel($this->db);
        $this->roleModel = new RoleModel($this->db);
    }
    public function index()
    {
        session_start();
        include_once 'app/views/admin/login.php';
    }
    public function checkLogin()
    {
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $username = $_POST['username'] ?? '';
            $password = $_POST['password'] ?? '';

            if (empty($username)) {
                $_SESSION['errorMessage'] = "Vui lòng điền tài khoản!";
                header('Location: /phpbanhang/loginadmin');
            } elseif (empty($password)) {
                $_SESSION['errorMessage'] = "Vui lòng điền mật khẩu!";
                header('Location: /phpbanhang/loginadmin');
            } else {
                $account = $this->adminModel->getAccountByUsername($username);

                if ($account) {
                    $pwd_hashed = $account->password;
                    if (password_verify($password, $pwd_hashed)) {
                        $_SESSION['user_id'] = $account->id;
                        $_SESSION['user_idrole'] = $account->id_role;
                        $_SESSION['username'] = $account->username;

                        header('Location: /phpbanhang/admin');
                        exit;
                    } else {
                        $_SESSION['errorMessage'] = "Đăng nhập không thành công.";
                        header('Location: /phpbanhang/loginadmin');
                    }
                } else {
                    $_SESSION['errorMessage'] = "Đăng nhập không thành công.";
                    header('Location: /phpbanhang/loginadmin');
                }
            }
        }
    }
    public function logout()
    {
        unset($_SESSION['user_id']);
        unset($_SESSION['user_idrole']);
        unset($_SESSION['username']);
        header("Location: /phpbanhang/loginadmin");
        exit();
    }
}
