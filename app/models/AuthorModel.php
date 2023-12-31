<?php
class AuthorModel
{
    private $conn;
    private $table_name = "authors";

    public function __construct($db)
    {
        $this->conn = $db;
    }
    public function getAuthors()
    {
        $query = "SELECT * FROM " . $this->table_name;

        $stmt = $this->conn->prepare($query);
        $stmt->execute();

        return $stmt;
    }
    public function getAuthorsPage($limit, $offset)
    {
        $query = "SELECT id, name FROM " . $this->table_name . " LIMIT :limit OFFSET :offset";

        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(':limit', $limit, PDO::PARAM_INT);
        $stmt->bindParam(':offset', $offset, PDO::PARAM_INT);
        $stmt->execute();

        return $stmt;
    }

    public function getAuthorById($id)
    {
        $query = "SELECT id, name FROM " . $this->table_name . " WHERE id = :id";

        $stmt = $this->conn->prepare($query);

        $stmt->bindParam(':id', $id, PDO::PARAM_INT);

        $stmt->execute();

        $result = $stmt->fetch(PDO::FETCH_ASSOC);

        return $result;
    }

    public function getTotalAuthors()
    {
        $query = "SELECT COUNT(*) as total FROM " . $this->table_name;
        $stmt = $this->conn->prepare($query);
        $stmt->execute();
        $row = $stmt->fetch(PDO::FETCH_ASSOC);

        return $row['total'];
    }

    private function isAuthorExists($name) {
        $query = "SELECT id FROM " . $this->table_name . " WHERE name = :name";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(':name', $name);
        $stmt->execute();

        return $stmt->rowCount() > 0;
    }

    public function createAuthor($name)
    {
        // Kiểm tra đầu vào
        if (empty($name)) {
            // Trả về mảng thông báo lỗi
            return [
                'success' => false,
                'message' => 'Vui lòng điền đầy đủ thông tin tác giả.'
            ];
        }
        if ($this->isAuthorExists($name)) {
            return [
                'success' => false,
                'message' => 'Tên tác giả đã tồn tại.'
            ];
        }
        // Truy vấn tạo sản phẩm mới
        $query = "INSERT INTO " . $this->table_name . " (name) VALUES (:name)";
        $stmt = $this->conn->prepare($query);

        // Làm sạch dữ liệu
        $name = htmlspecialchars(strip_tags($name));


        // Gán dữ liệu vào câu lệnh
        $stmt->bindParam(':name', $name);

        // Thực thi câu lệnh
        if ($stmt->execute()) {
            return [
                'success' => true,
                'message' => 'Tác giả đã được thêm thành công.'
            ];
        }
        // Trả về mảng thông báo lỗi
        return [
            'success' => false,
            'message' => 'Đã xảy ra lỗi khi thêm tác giả.'
        ];
    }
    public function updateAuthor($id, $name)
    {
        // Kiểm tra đầu vào
        if (empty($name)) {
            // Trả về mảng thông báo lỗi
            return [
                'success' => false,
                'message' => 'Vui lòng điền đầy đủ thông tin tác giả.'
            ];
        }

        // Truy vấn cập nhật sản phẩm
        $query = "UPDATE " . $this->table_name . " SET `name`=:name WHERE id=:id";
        $stmt = $this->conn->prepare($query);

        // Gán dữ liệu vào câu lệnh
        $stmt->bindParam(':id', $id, PDO::PARAM_INT);
        $stmt->bindParam(':name', $name);

        // Thực thi câu lệnh
        if ($stmt->execute()) {
            return [
                'success' => true,
                'message' => 'Tác giả đã được cập nhật thành công.'
            ];
        }

        // Trả về mảng thông báo lỗi
        return [
            'success' => false,
            'message' => 'Đã xảy ra lỗi khi cập nhật tác giả.'
        ];
    }
    public function deleteAuthor($id)
    {
        $query = "DELETE FROM " . $this->table_name . " WHERE id=:id";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(':id', $id, PDO::PARAM_INT);

        if ($stmt->execute()) {
            if ($stmt->rowCount() > 0) {
                return [
                    'success' => true,
                    'message' => 'Tác giả đã được xóa thành công.'
                ];
            } else {
                return [
                    'success' => false,
                    'message' => 'Không tìm thấy tác giả để xóa.'
                ];
            }
        }
        return [
            'success' => false,
            'message' => 'Đã xảy ra lỗi khi xóa tác giả.'
        ];
    }
}
