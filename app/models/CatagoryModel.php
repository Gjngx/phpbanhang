<?php
class CategoryModel {
    private $conn;
    private $table_name = "categories";

    public function __construct($db)
    {
        $this->conn = $db;
    }
    public function getCategories()
    {
        $query = "SELECT * FROM " . $this->table_name;

        $stmt = $this->conn->prepare($query);
        $stmt->execute();

        return $stmt;
    }
    public function getCategoriesPage($limit,$offset)
    {
        $query = "SELECT id, name FROM " . $this->table_name . " LIMIT :limit OFFSET :offset";

        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(':limit', $limit, PDO::PARAM_INT);
        $stmt->bindParam(':offset', $offset, PDO::PARAM_INT);
        $stmt->execute();

        return $stmt;
    }
    public function getCategoryById($id)
    {
        $query = "SELECT id, name FROM " . $this->table_name . " WHERE id = :id";

        $stmt = $this->conn->prepare($query);

        $stmt->bindParam(':id', $id, PDO::PARAM_INT);

        $stmt->execute();

        $result = $stmt->fetch(PDO::FETCH_ASSOC);

        return $result;
    }
    public function getTotalCatogory()
    {
        $query = "SELECT COUNT(*) as total FROM " . $this->table_name;
        $stmt = $this->conn->prepare($query);
        $stmt->execute();
        $row = $stmt->fetch(PDO::FETCH_ASSOC);

        return $row['total'];
    }
    private function isCategoryExists($name) {
        $query = "SELECT id FROM " . $this->table_name . " WHERE name = :name";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(':name', $name);
        $stmt->execute();

        return $stmt->rowCount() > 0;
    }
    public function createCategory($name)
    {
        // Kiểm tra đầu vào
        if (empty($name)) {
            // Trả về mảng thông báo lỗi
            return [
                'success' => false,
                'message' => 'Vui lòng điền đầy đủ thông tin thể loại.'
            ];
        }
        if ($this->isCategoryExists($name)) {
            return [
                'success' => false,
                'message' => 'Tên thể loại đã tồn tại.'
            ];
        }
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
                'message' => 'Thể loại đã được thêm thành công.'
            ];
        }
        // Trả về mảng thông báo lỗi
        return [
            'success' => false,
            'message' => 'Đã xảy ra lỗi khi thêm thể loại.'
        ];
    }

    public function updateCategory($id, $name)
    {
        // Kiểm tra đầu vào
        if (empty($name)) {
            // Trả về mảng thông báo lỗi
            return [
                'success' => false,
                'message' => 'Vui lòng điền đầy đủ thông tin thể loại.'
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
                'message' => 'Thể loại đã được cập nhật thành công.'
            ];
        }

        // Trả về mảng thông báo lỗi
        return [
            'success' => false,
            'message' => 'Đã xảy ra lỗi khi cập nhật thể loại.'
        ];
    }
    public function deleteCategory($id)
    {
        $query = "DELETE FROM " . $this->table_name . " WHERE id=:id";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(':id', $id, PDO::PARAM_INT);

        if ($stmt->execute()) {
            if ($stmt->rowCount() > 0) {
                return [
                    'success' => true,
                    'message' => 'Thể loại đã được xóa thành công.'
                ];
            } else {
                return [
                    'success' => false,
                    'message' => 'Không tìm thấy thể loại để xóa.'
                ];
            }
        }
        return [
            'success' => false,
            'message' => 'Đã xảy ra lỗi khi xóa thể loại.'
        ];
    }

}
