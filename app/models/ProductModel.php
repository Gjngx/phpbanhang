<?php
class ProductModel
{
    private $conn;
    private $table_name = "products";

    public function __construct($db)
    {
        $this->conn = $db;
    }
    public function getProducts($limit, $offset)
    {
        $query = "SELECT p.*, c.name AS categoryName, a.name AS authorName
              FROM products p
              JOIN categories c ON p.id_category = c.id
              JOIN authors a ON p.id_author = a.id
              LIMIT :limit OFFSET :offset";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(':limit', $limit, PDO::PARAM_INT);
        $stmt->bindParam(':offset', $offset, PDO::PARAM_INT);
        $stmt->execute();

        return $stmt;
    }
    public function getNewestProductsByCreateDatePaginated($limit, $offset)
    {
        $query = "SELECT * FROM " . $this->table_name . " ORDER BY createDate DESC LIMIT :limit OFFSET :offset";

        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(':limit', $limit, PDO::PARAM_INT);
        $stmt->bindParam(':offset', $offset, PDO::PARAM_INT);
        $stmt->execute();

        return $stmt;
    }
    public function getProductSortAscCreateDatePaginated($limit, $offset)
    {
        $query = "SELECT * FROM " . $this->table_name . " ORDER BY createDate ASC LIMIT :limit OFFSET :offset";

        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(':limit', $limit, PDO::PARAM_INT);
        $stmt->bindParam(':offset', $offset, PDO::PARAM_INT);
        $stmt->execute();

        return $stmt;
    }
    public function getTotalProducts()
    {
        $query = "SELECT COUNT(*) as total FROM " . $this->table_name;
        $stmt = $this->conn->prepare($query);
        $stmt->execute();
        $row = $stmt->fetch(PDO::FETCH_ASSOC);

        return $row['total'];
    }
    public function getProductsByName($name)
    {
        $query = "SELECT * FROM " . $this->table_name . " WHERE name LIKE :name";
        $stmt = $this->conn->prepare($query);
        $name = '%' . htmlspecialchars(strip_tags($name)) . '%';
        $stmt->bindParam(':name', $name, PDO::PARAM_STR);
        $stmt->execute();

        return $stmt;
    }
    public function getProductById($id)
    {
        $query = "SELECT * FROM " . $this->table_name . " WHERE id = :id";

        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(':id', $id, PDO::PARAM_INT);
        $stmt->execute();
        $results = $stmt->fetch(PDO::FETCH_ASSOC);

        return $results;
    }
    public function getProductsByIds($ids)
    {
        $placeholders = implode(',', array_fill(0, count($ids), '?'));
        $stmt = $this->conn->prepare("SELECT * FROM " . $this->table_name . " WHERE id IN ($placeholders)");
        $stmt->execute($ids);
        $products = $stmt->fetchAll(PDO::FETCH_ASSOC);

        return $products;
    }
    public function getTotalProductsByCategory($id)
    {
        $query = "SELECT COUNT(*) as total FROM " . $this->table_name . " WHERE id_category = :id";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(':id', $id, PDO::PARAM_INT);
        $stmt->execute();
        $row = $stmt->fetch(PDO::FETCH_ASSOC);

        return $row['total'];
    }
    public function getProductByIdCategoriesPaginated($id, $limit, $offset)
    {
        $query = "SELECT * FROM " . $this->table_name . " WHERE id_category = :id ORDER BY createDate DESC LIMIT :limit OFFSET :offset";

        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(':id', $id, PDO::PARAM_INT);
        $stmt->bindParam(':limit', $limit, PDO::PARAM_INT);
        $stmt->bindParam(':offset', $offset, PDO::PARAM_INT);
        $stmt->execute();

        return $stmt;
    }
    public function getProductSortAscPricePaginated($limit, $offset)
    {
        $query = "SELECT * FROM " . $this->table_name . " ORDER BY price ASC LIMIT :limit OFFSET :offset";

        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(':limit', $limit, PDO::PARAM_INT);
        $stmt->bindParam(':offset', $offset, PDO::PARAM_INT);
        $stmt->execute();

        return $stmt;
    }
    public function getProductSortDecsPricePaginated($limit, $offset)
    {
        $query = "SELECT * FROM " . $this->table_name . " ORDER BY price DESC LIMIT :limit OFFSET :offset";

        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(':limit', $limit, PDO::PARAM_INT);
        $stmt->bindParam(':offset', $offset, PDO::PARAM_INT);
        $stmt->execute();

        return $stmt;
    }
    public function getRandomProducts()
    {
        $limit = 5;

        $query = "SELECT * FROM " . $this->table_name . " ORDER BY RAND() LIMIT :limit";

        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(':limit', $limit, PDO::PARAM_INT);
        $stmt->execute();

        return $stmt;
    }
    public function getNewestProducts()
    {
        $limit = 12;
        $query = "SELECT * FROM " . $this->table_name . " ORDER BY createDate DESC LIMIT :limit";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(':limit', $limit, PDO::PARAM_INT);
        $stmt->execute();
        return $stmt;
    }

    private function isProductExists($name)
    {
        $query = "SELECT id FROM " . $this->table_name . " WHERE name = :name";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(':name', $name);
        $stmt->execute();

        return $stmt->rowCount() > 0;
    }

    public function createProduct($name, $price, $image, $description, $createDate, $status, $id_author, $id_category)
    {
        if (empty($name || empty($price) || empty($image) || empty($description) || empty($createDate) || empty($id_author) || empty($id_category))) {
            // Trả về mảng thông báo lỗi
            return [
                'success' => false,
                'message' => 'Vui lòng điền đầy đủ thông tin sách.'
            ];
        }
        if ($this->isProductExists($name)) {
            return [
                'success' => false,
                'message' => 'Tên sách đã tồn tại.'
            ];
        }
        $query = "INSERT INTO " . $this->table_name . " (name, price, image, description, createDate, status, id_author, id_category) VALUES (:name, :price, :image, :description, :createDate, :status, :id_author, :id_category)";
        $stmt = $this->conn->prepare($query);

        // Làm sạch dữ liệu 
        $name = htmlspecialchars(strip_tags($name));
        $price = htmlspecialchars(strip_tags($price));
        $image = htmlspecialchars(strip_tags($image));
        $description = htmlspecialchars(strip_tags($description));
        $createDate = htmlspecialchars(strip_tags($createDate));
        $status = htmlspecialchars(strip_tags($status));
        $id_author = htmlspecialchars(strip_tags($id_author));
        $id_category = htmlspecialchars(strip_tags($id_category));

        // Gán dữ liệu vào câu lệnh
        $stmt->bindParam(':name', $name);
        $stmt->bindParam(':price', $price);
        $stmt->bindValue(':image', $image, PDO::PARAM_STR);
        $stmt->bindParam(':description', $description);
        $stmt->bindParam(':createDate', $createDate);
        $stmt->bindParam(':status', $status);
        $stmt->bindParam(':id_author', $id_author);
        $stmt->bindParam(':id_category', $id_category);

        // Thực thi câu lệnh
        if ($stmt->execute()) {
            return [
                'success' => true,
                'message' => 'Sách đã được thêm thành công.'
            ];
        }
        // Trả về mảng thông báo lỗi
        return [
            'success' => false,
            'message' => 'Đã xảy ra lỗi khi thêm sách.'
        ];
    }
    public function getImagePathById($id)
    {
        $query = "SELECT image FROM " . $this->table_name . " WHERE id = :id";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(':id', $id, PDO::PARAM_INT);

        if ($stmt->execute()) {
            $row = $stmt->fetch(PDO::FETCH_ASSOC);
            if ($row) {
                return $row['image'];
            }
        }
        return 'default_image.jpg';
    }
    public function updateProduct($id, $name, $image, $price, $description, $status, $id_author, $id_category)
    {
        if (empty($name) || empty($price) || empty($description) || empty($id_author) || empty($id_category)) {
            return [
                'success' => false,
                'message' => 'Vui lòng điền đầy đủ thông tin sách.'
            ];
        }


        if (empty($image)) {
            $query = "UPDATE " . $this->table_name . " SET  `name`=:name, 
                                                        `price`=:price, 
                                                        `description`=:description, 
                                                        `status`=:status, 
                                                        `id_author`=:id_author, 
                                                        `id_category`=:id_category 
                                                        WHERE id=:id";
        } else {
            $query = "UPDATE " . $this->table_name . " SET  `name`=:name, 
                                                        `price`=:price, 
                                                        `image`=:image, 
                                                        `description`=:description, 
                                                        `status`=:status, 
                                                        `id_author`=:id_author, 
                                                        `id_category`=:id_category 
                                                        WHERE id=:id";
        }

        $stmt = $this->conn->prepare($query);

        $stmt->bindParam(':id', $id, PDO::PARAM_INT);
        $stmt->bindParam(':name', $name);
        $stmt->bindParam(':price', $price);

        // Bind các tham số khác chỉ khi có ảnh mới
        if (!empty($image)) {
            $stmt->bindParam(':image', $image);
        }

        $stmt->bindParam(':description', $description);
        $stmt->bindParam(':status', $status);
        $stmt->bindParam(':id_author', $id_author);
        $stmt->bindParam(':id_category', $id_category);

        if ($stmt->execute()) {
            return [
                'success' => true,
                'message' => 'Sách đã được cập nhật thành công.'
            ];
        }

        return [
            'success' => false,
            'message' => 'Đã xảy ra lỗi khi cập nhật sách.'
        ];
    }


    public function deleteProduct($id)
    {
        $query = "DELETE FROM " . $this->table_name . " WHERE id=:id";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(':id', $id, PDO::PARAM_INT);

        if ($stmt->execute()) {
            if ($stmt->rowCount() > 0) {
                return [
                    'success' => true,
                    'message' => 'Sách đã được xóa thành công.'
                ];
            } else {
                return [
                    'success' => false,
                    'message' => 'Không tìm thấy sách để xóa.'
                ];
            }
        }
        return [
            'success' => false,
            'message' => 'Đã xảy ra lỗi khi xóa sách.'
        ];
    }
}
