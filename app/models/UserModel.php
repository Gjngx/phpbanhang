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

    public function registerUser($username, $password, $email)
    {
        if ($this->getAccountByUsername($username)) {
            return [
                'success' => false,
                'message' => 'Tên tài khoản đã tồn tại.'
            ];
        }
        // Truy vấn tạo sản phẩm mới
        $query = "INSERT INTO " . $this->table_name . " (username, password, email, name, phone, address) VALUES (:username, :password, :email, :name, :phone, :address)"; 
        $stmt = $this->conn->prepare($query);

        // Làm sạch dữ liệu
        $username = htmlspecialchars(strip_tags($username));
        $password = htmlspecialchars(strip_tags($password));
        $email = htmlspecialchars(strip_tags($email));
        $name = '';
        $phone = '';
        $address = '';

        // Gán dữ liệu vào câu lệnh
        $stmt->bindParam(':username', $username);
        $stmt->bindParam(':password', $password);
        $stmt->bindParam(':email', $email);
        $stmt->bindParam(':name', $name);
        $stmt->bindParam(':phone', $phone);
        $stmt->bindParam(':address', $address);

        // Thực thi câu lệnh
        if ($stmt->execute()) {
            return [
                'success' => true,
                'message' => 'Tài khoản đã được thêm thành công.'
            ];
        }
        // Trả về mảng thông báo lỗi
        return [
            'success' => false,
            'message' => 'Đã xảy ra lỗi khi thêm tài khoản.'
        ];
    }
}
