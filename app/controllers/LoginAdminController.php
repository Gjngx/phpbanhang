<?php
session_start();
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
        include_once 'app/views/admin/login.php';
    }
    public function checkLogin()
    {
        // Kiểm tra xem liệu form đã được submit
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
                        $_SESSION['errorMessage'] = "Sai mật khẩu!";
                        header('Location: /phpbanhang/loginadmin');
                    }
                } else {
                    $_SESSION['errorMessage'] = "Tài khoản không tồn tại!";
                    header('Location: /phpbanhang/loginadmin');
                }
            }
        }
    }
    public function logout()
    {

        $_SESSION = array();

        session_destroy();

        header("Location: /phpbanhang/loginadmin");
        exit();
    }
}
