<?php
class RoleModel
{
    private $conn;
    private $table_name = "roles";

    public function __construct($db)
    {
        $this->conn = $db;
    }
    public function getAllRoles()
    {
        $query = "SELECT * FROM " . $this->table_name;
        $stmt = $this->conn->prepare($query);
        $stmt->execute();
        return $stmt;
    }
    public function getRoleById($id)
    {
        $query = "SELECT name FROM " . $this->table_name. " WHERE id = :id";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(':id', $id, PDO::PARAM_INT);
        $stmt->execute();
        $result = $stmt->fetch(PDO::FETCH_ASSOC);
        return $result;
    }
}
