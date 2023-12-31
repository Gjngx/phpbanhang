<?php
class DefaultController {
    private $productsModel;
    private $db;
    public function __construct()
    {
        $this->db = (new Database())->getConnection();
        $this->productsModel = new ProductModel($this->db);
    }
    public function index() {
        $products = $this->productsModel-> getNewestProducts();
        include_once 'app/views/users/index.php';
    }
}