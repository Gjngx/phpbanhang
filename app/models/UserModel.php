<?php
class UserModel
{
    private $conn;

    private $table_name = "users";

    public function __construct($db)
    {
        $this->conn = $db;
    }

    public function getAccountByUsername($username)
    {
        $query = "SELECT * FROM users WHERE username = :username";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(':username', $username, PDO::PARAM_STR);
        $stmt->execute();
        $result = $stmt->fetch(PDO::FETCH_OBJ);
        return $result;
    }

    public function registerUser($username, $password)
    {
        // Kiểm tra xem username đã tồn tại hay chưa
        if ($this->getAccountByUsername($username)) {
            echo "Tài khoản đã tồn tại.";
            return false;
        }

        // Mã hóa mật khẩu
        $hashed_password = password_hash($password, PASSWORD_DEFAULT);

        // Thực hiện lưu thông tin người dùng vào cơ sở dữ liệu
        $query = "INSERT INTO users (username, password) VALUES (:username, :password)";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(':username', $username, PDO::PARAM_STR);
        $stmt->bindParam(':password', $hashed_password, PDO::PARAM_STR);

        if ($stmt->execute()) {
            return true;
        } else {
            echo "Đã xảy ra lỗi khi đăng ký tài khoản.";
            return false;
        }
    }
}
