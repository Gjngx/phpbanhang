<?php

class ProductController
{
    private $authorModel;
    private $categoryModel;
    private $productsModel;
    private $db;
    public function __construct()
    {
        $this->db = (new Database())->getConnection();
        $this->authorModel = new AuthorModel($this->db);
        $this->categoryModel = new CategoryModel($this->db);
        $this->productsModel = new ProductModel($this->db);
    }
    public function index()
    {
        session_start();
        $limit = 12;
        $currentPage = isset($_GET['page']) ? $_GET['page'] : 1;
        $offset = ($currentPage - 1) * $limit;
        $totalPropucts = $this->productsModel->getTotalProducts();
        $totalPages = ceil($totalPropucts / $limit);
        $products = $this->productsModel->getNewestProductsByCreateDatePaginated($limit, $offset);
        include_once 'app/views/users/product/index.php';
    }
    public function detail($id)
    {
        session_start();
        $product = $this->productsModel->getProductById($id);
        $products = $this->productsModel->getRandomProducts();
        include_once 'app/views/users/product/detail.php';
    }
    public function craetedateordersortbyasc()
    {
        session_start();
        $limit = 12;
        $currentPage = isset($_GET['page']) ? $_GET['page'] : 1;
        $offset = ($currentPage - 1) * $limit;
        $totalPropucts = $this->productsModel->getTotalProducts();
        $totalPages = ceil($totalPropucts / $limit);
        $products = $this->productsModel->getProductSortAscCreateDatePaginated($limit, $offset);
        include_once 'app/views/users/product/index.php';
    }
    public function priceordersortbyasc()
    {
        session_start();
        $limit = 12;
        $currentPage = isset($_GET['page']) ? $_GET['page'] : 1;
        $offset = ($currentPage - 1) * $limit;
        $totalPropucts = $this->productsModel->getTotalProducts();
        $totalPages = ceil($totalPropucts / $limit);
        $products = $this->productsModel->getProductSortAscPricePaginated($limit, $offset);
        include_once 'app/views/users/product/index.php';
    }
    public function priceorderdecbydecs()
    {
        session_start();
        $limit = 12;
        $currentPage = isset($_GET['page']) ? $_GET['page'] : 1;
        $offset = ($currentPage - 1) * $limit;
        $totalPropucts = $this->productsModel->getTotalProducts();
        $totalPages = ceil($totalPropucts / $limit);
        $products = $this->productsModel->getProductSortDecsPricePaginated($limit, $offset);
        include_once 'app/views/users/product/index.php';
    }
    public function fineNameProduct()
    {
        // $limit = 12;
        // $currentPage = isset($_GET['page']) ? $_GET['page'] : 1;

        // $offset = ($currentPage - 1) * $limit;
        // $totalPropucts = $this->productsModel->getTotalProducts();
        // $totalPages = ceil($totalPropucts / $limit);
        session_start();
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $name = htmlspecialchars(strip_tags($_POST['name'] ?? ''));
            $products = $this->productsModel->getProductsByName($name);
            
            include_once 'app/views/users/product/search.php';
        }
    }
    public function addtocartoneproduct($idProduct)
    {
        session_start();
        if (!isset($_SESSION['cart'])) {
            $_SESSION['cart'] = array();
        }
        if (!isset($_SESSION['cart'][$idProduct])) {
            $_SESSION['cart'][$idProduct] = 1;
        } else {
            $_SESSION['cart'][$idProduct]++;
        }
        header("Location: /phpbanhang/product/viewcart");
        exit();
    }
    public function viewcart()
    {
        session_start();
        if (isset($_SESSION['cart']) && !empty($_SESSION['cart'])) {
            $idProducts = array_keys($_SESSION['cart']);
            $cartProducts = $this->productsModel->getProductsByIds($idProducts);
            include_once 'app/views/users/cart.php';
        } else {
            include_once 'app/views/users/cart.php';
        }
    }
    public function updatecart()
    {
        session_start();
        $productId = $_POST['productId'];
        $quantity = $_POST['quantity'];
        $_SESSION['cart'][$productId] = $quantity;
    }
    public function removecart()
    {
    session_start();
    $productId = $_POST['productId'];
    if (isset($_SESSION['cart'][$productId])) {
        unset($_SESSION['cart'][$productId]);
        }
    }
}
