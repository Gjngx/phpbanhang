<?php
class OrdersModel
{
    private $conn;
    private $table_name = "orders";

    public function __construct($db)
    {
        $this->conn = $db;
    }

    public function getAllOders($limit, $offset)
    {
        $query = "SELECT * FROM " . $this->table_name . " ORDER BY createDate DESC LIMIT :limit OFFSET :offset";

        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(':limit', $limit, PDO::PARAM_INT);
        $stmt->bindParam(':offset', $offset, PDO::PARAM_INT);
        $stmt->execute();

        return $stmt;
    }

    public function getOdersById($id)
    {
        $query = "SELECT * FROM " . $this->table_name . " WHERE id = :id";

        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(':id', $id, PDO::PARAM_INT);
        $stmt->execute();
        $results = $stmt->fetch(PDO::FETCH_ASSOC);

        return $results;
    }

    public function getOdersByIdUser($id)
    {
        $query = "SELECT * FROM " . $this->table_name . " WHERE id_user = :id ORDER BY createDate DESC";

        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(':id', $id, PDO::PARAM_INT);
        $stmt->execute();

        return $stmt;
    }

    public function getTotalOrders()
    {
        $query = "SELECT COUNT(*) as total FROM " . $this->table_name;
        $stmt = $this->conn->prepare($query);
        $stmt->execute();
        $row = $stmt->fetch(PDO::FETCH_ASSOC);

        return $row['total'];
    }
    public function getProductsByOrders($id)
    {
        $query = "SELECT p.name, p.price, op.amount, (p.price * op.amount) AS total_price
        FROM orders o
        JOIN orderProduct op ON o.id = op.id_order
        JOIN products p ON p.id = op.id_product
        WHERE o.id = :id";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(':id', $id, PDO::PARAM_INT);
        $stmt->execute();
        return $stmt;
    }
    public function getLastOrderId()
    {
        $query = "SELECT MAX(id) as lastOrderId FROM " . $this->table_name;
        $stmt = $this->conn->prepare($query);
        if ($stmt->execute()) {
            $row = $stmt->fetch(PDO::FETCH_ASSOC);
            return $row['lastOrderId'];
        }
        return null;
    }

    public function createOrder($customerName, $email, $phone, $address, $createDate, $total, $status, $id_user)
    {

        $query = "INSERT INTO " . $this->table_name . " (customerName, email, phone, address, createDate, total, status, id_user) VALUES (:customerName, :email, :phone, :address, :createDate, :total, :status, :id_user)";
        $stmt = $this->conn->prepare($query);

        // Làm sạch dữ liệu
        $customerName = htmlspecialchars(strip_tags($customerName));
        $email = htmlspecialchars(strip_tags($email));
        $phone = htmlspecialchars(strip_tags($phone));
        $address = htmlspecialchars(strip_tags($address));
        $createDate = htmlspecialchars(strip_tags($createDate));
        $total = htmlspecialchars(strip_tags($total));
        $status = htmlspecialchars(strip_tags($status));
        $id_user = htmlspecialchars(strip_tags($id_user));


        // Gán dữ liệu vào câu lệnh
        $stmt->bindParam(':customerName', $customerName);
        $stmt->bindParam(':email', $email);
        $stmt->bindValue(':phone', $phone,);
        $stmt->bindParam(':address', $address);
        $stmt->bindParam(':createDate', $createDate);
        $stmt->bindParam(':total', $total);
        $stmt->bindParam(':status', $status);
        $stmt->bindParam(':id_user', $id_user);
        // Thực thi câu lệnh
        if ($stmt->execute()) {
            return [
                'success' => true,
                'message' => 'Đơn hàng đã được thêm thành công.'
            ];
        }
        // Trả về mảng thông báo lỗi
        return [
            'success' => false,
            'message' => 'Đã xảy ra lỗi khi thêm đơn hàng.'
        ];
    }

    public function createOrderProduct($orderId, $productId, $quantity)
    {
        $query = "INSERT INTO orderProduct (id_order, id_product, amount) VALUES (:orderId, :productId, :quantity)";
        $stmt = $this->conn->prepare($query);

        $stmt->bindParam(':orderId', $orderId);
        $stmt->bindParam(':productId', $productId);
        $stmt->bindParam(':quantity', $quantity);

        if ($stmt->execute()) {
            return [
                'success' => true,
                'message' => 'Thông tin sản phẩm đã được thêm thành công.'
            ];
        }

        return [
            'success' => false,
            'message' => 'Đã xảy ra lỗi khi thêm thông tin sản phẩm.'
        ];
    }

    public function updateOrder($id, $status)
    {

        $query = "UPDATE " . $this->table_name . " SET `status`=:status WHERE id=:id";
        $stmt = $this->conn->prepare($query);

        // Gán dữ liệu vào câu lệnh
        $stmt->bindParam(':id', $id, PDO::PARAM_INT);
        $stmt->bindParam(':status', $status);

        // Thực thi câu lệnh
        if ($stmt->execute()) {
            return [
                'success' => true,
                'message' => 'Trạng thái đơn hàng đã cập nhật thành công.'
            ];
        }

        // Trả về mảng thông báo lỗi
        return [
            'success' => false,
            'message' => 'Đã xảy ra lỗi khi cập nhật trạng thái đơn hàng.'
        ];
    }

    public function deleteOrder($id)
    {
        $query = "DELETE FROM " . $this->table_name . " WHERE id=:id";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(':id', $id, PDO::PARAM_INT);

        if ($stmt->execute()) {
            if ($stmt->rowCount() > 0) {
                return [
                    'success' => true,
                    'message' => 'Đơn hàng được xóa thành công.'
                ];
            } else {
                return [
                    'success' => false,
                    'message' => 'Không tìm thấy đơn hàng để xóa.'
                ];
            }
        }
        return [
            'success' => false,
            'message' => 'Đã xảy ra lỗi khi xóa đơn hàng.'
        ];
    }
}
