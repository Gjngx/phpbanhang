<?php
class OrdersModel
{
    private $conn;
    private $table_name = "orders";

    public function __construct($db)
    {
        $this->conn = $db;
    }

    public function getLastOrderId()
    {
        $query = "SELECT MAX(id) as lastOrderId FROM ". $this->table_name ;
        $stmt = $this->conn->prepare($query);
        if ($stmt->execute()) {
            $row = $stmt->fetch(PDO::FETCH_ASSOC);
            return $row['lastOrderId'];
        }
        return null;
    }

    public function createOrder($customerName, $email, $phone, $address, $createDate, $total, $status, $id_user)
    {
        // Kiểm tra đầu vào
        if (empty($customerName) || empty($email) || empty($phone) || empty($address) || empty($createDate) || empty($total) || empty($status) || empty($id_user)) {
            // Trả về mảng thông báo lỗi
            return [
                'success' => false,
                'message' => 'Vui lòng điền đầy đủ thông tin đơn hàng.'
            ];
        }

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


}
