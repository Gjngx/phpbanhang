<?php
class AdminModel
{
    private $conn;
    private $table_name = "admins";

    public function __construct($db)
    {
        $this->conn = $db;
    }
    public function getAllAdmins($limit, $offset)
    {
        $query = "SELECT a.*, r.name AS roleName
        FROM admins a
        JOIN roles r ON a.id_role = r.id
        LIMIT :limit OFFSET :offset";

        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(':limit', $limit, PDO::PARAM_INT);
        $stmt->bindParam(':offset', $offset, PDO::PARAM_INT);
        $stmt->execute();

        return $stmt;
    }

    public function getAdminRoleById($id)
    {
        $query = "SELECT a.*, r.name AS roleName
        FROM admins a
        JOIN roles r ON a.id_role = r.id
        WHERE a.id = :id ";

        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(':id', $id, PDO::PARAM_INT);
        $stmt->execute();
        $result = $stmt->fetch(PDO::FETCH_ASSOC);

        return $result;
    }

    public function getAdminById($id)
    {
        $query = "SELECT * FROM " . $this->table_name . " WHERE id = :id";

        $stmt = $this->conn->prepare($query);

        $stmt->bindParam(':id', $id, PDO::PARAM_INT);

        $stmt->execute();

        $result = $stmt->fetch(PDO::FETCH_ASSOC);

        return $result;
    }
    private function isUserExistsUsername($username)
    {
        $query = "SELECT id FROM " . $this->table_name . " WHERE username = :username";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(':username', $username);
        $stmt->execute();

        return $stmt->rowCount() > 0;
    }
    private function isUserExistsEmail($email)
    {
        $query = "SELECT id FROM " . $this->table_name . " WHERE email = :email";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(':email', $email);
        $stmt->execute();

        return $stmt->rowCount() > 0;
    }
    public function getAccountByUsername($username)
    {
        $query = "SELECT * FROM admins WHERE username = :username";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(':username', $username, PDO::PARAM_STR);
        $stmt->execute();
        $result = $stmt->fetch(PDO::FETCH_OBJ);
        return $result;
    }
    public function signin($username, $password, $email, $id_role)
    {
        // Kiểm tra đầu vào
        if (empty($username) || empty($password) || empty($email) || empty($id_role)) {
            // Trả về mảng thông báo lỗi
            return [
                'success' => false,
                'message' => 'Vui lòng điền đầy đủ thông tin tài khoản.'
            ];
        }

        if ($this->isUserExistsUsername($username)) {
            return [
                'success' => false,
                'message' => 'Tên tài khoản đã tồn tại.'
            ];
        }

        if ($this->isUserExistsEmail($email)) {
            return [
                'success' => false,
                'message' => 'Tên email đã tồn tại.'
            ];
        }

        // Truy vấn tạo sản phẩm mới
        $query = "INSERT INTO " . $this->table_name . " (username, password, email, id_role) VALUES (:username, :password, :email, :id_role)";
        $stmt = $this->conn->prepare($query);

        // Làm sạch dữ liệu
        $username = htmlspecialchars(strip_tags($username));
        $password = htmlspecialchars(strip_tags($password));
        $email = htmlspecialchars(strip_tags($email));
        $id_role = htmlspecialchars(strip_tags($id_role));


        // Gán dữ liệu vào câu lệnh
        $stmt->bindParam(':username', $username);
        $stmt->bindParam(':password', $password);
        $stmt->bindParam(':email', $email);
        $stmt->bindParam(':id_role', $id_role);

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

    public function updateRoleAcount($id, $id_role)
    {
        // Kiểm tra đầu vào
        if (empty($id_role)) {
            // Trả về mảng thông báo lỗi
            return [
                'success' => false,
                'message' => 'Vui lòng chọn quyền cho tài khoản.'
            ];
        }

        // Truy vấn tạo sản phẩm mới
        $query = "UPDATE " . $this->table_name . " SET `id_role`=:id_role WHERE id=:id";
        $stmt = $this->conn->prepare($query);

        // Gán dữ liệu vào câu lệnh
        $stmt->bindParam(':id', $id, PDO::PARAM_INT);
        $stmt->bindParam(':id_role', $id_role);

        // Thực thi câu lệnh
        if ($stmt->execute()) {
            return [
                'success' => true,
                'message' => 'Tài khoản đã được cập nhật thành công.'
            ];
        }
        // Trả về mảng thông báo lỗi
        return [
            'success' => false,
            'message' => 'Đã xảy ra lỗi khi cập nhật tài khoản.'
        ];
    }
    public function deleteAccount($id)
    {
        $query = "DELETE FROM " . $this->table_name . " WHERE id=:id";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(':id', $id, PDO::PARAM_INT);

        if ($stmt->execute()) {
            if ($stmt->rowCount() > 0) {
                return [
                    'success' => true,
                    'message' => 'Tài khoản đã được xóa thành công.'
                ];
            } else {
                return [
                    'success' => false,
                    'message' => 'Không tìm thấy tài khoản để xóa.'
                ];
            }
        }
        return [
            'success' => false,
            'message' => 'Đã xảy ra lỗi khi xóa tài khoản.'
        ];
    }
    public function updateAdmin($id, $email)
    {

        $query = "UPDATE " . $this->table_name . " SET `email`=:email WHERE id=:id";
        $stmt = $this->conn->prepare($query);

        // Gán dữ liệu vào câu lệnh
        $stmt->bindParam(':id', $id, PDO::PARAM_INT);
        $stmt->bindParam(':email', $email);

        // Thực thi câu lệnh
        if ($stmt->execute()) {
            return [
                'success' => true,
                'message' => 'Email cập nhật thành công.'
            ];
        }

        // Trả về mảng thông báo lỗi
        return [
            'success' => false,
            'message' => 'Đã xảy ra lỗi khi cập nhật email.'
        ];
    }
    public function updatePasswordAdmin($id, $password)
    {

        $query = "UPDATE " . $this->table_name . " SET `password`=:password WHERE id=:id";
        $stmt = $this->conn->prepare($query);

        // Gán dữ liệu vào câu lệnh
        $stmt->bindParam(':id', $id, PDO::PARAM_INT);
        $stmt->bindParam(':password', $password);

        // Thực thi câu lệnh
        if ($stmt->execute()) {
            return [
                'success' => true,
                'message' => 'Mật khẩu cập nhật thành công.'
            ];
        }

        // Trả về mảng thông báo lỗi
        return [
            'success' => false,
            'message' => 'Đã xảy ra lỗi khi cập nhật mật khẩu.'
        ];
    }
}
