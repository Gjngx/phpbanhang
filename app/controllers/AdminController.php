<?php
session_start();
require_once ('app/helpers/SessionHelper.php');
class AdminController
{
    private $authorModel;
    private $categoryModel;
    private $productsModel;
    private $adminModel;
    private $roleModel;
    private $db;
    public function __construct()
    {
        $this->db = (new Database())->getConnection();
        $this->authorModel = new AuthorModel($this->db);
        $this->categoryModel = new CategoryModel($this->db);
        $this->productsModel = new ProductModel($this->db);
        $this->adminModel = new AdminModel($this->db);
        $this->roleModel = new RoleModel($this->db);
    }
    public function index()
    {
        if (!SessionHelper::isAdmin() && !SessionHelper::isMod()) {
            header('Location: /phpbanhang/loginadmin');
            exit;
        }
        include_once 'app/views/admin/index.php';
    }
    public function author()
    {
        if (!SessionHelper::isAdmin() && !SessionHelper::isMod()) {
            header('Location: /phpbanhang/loginadmin');
            exit;
        }
        $limit = 10;
        $currentPage = isset($_GET['page']) ? $_GET['page'] : 1;

        $offset = ($currentPage - 1) * $limit;
        $totalAuthors = $this->authorModel->getTotalAuthors();
        $totalPages = ceil($totalAuthors / $limit);
        $authors = $this->authorModel->getAuthorsPage($limit, $offset);

        include_once 'app/views/admin/author/author.php';
    }
    public function createauthor()
    {
        if (!SessionHelper::isAdmin() && !SessionHelper::isMod()) {
            header('Location: /phpbanhang/loginadmin');
            exit;
        }
        include_once 'app/views/admin/author/create.php';
    }
    public function saveauthor()
    {
        if (!SessionHelper::isAdmin() && !SessionHelper::isMod()) {
            header('Location: /phpbanhang/loginadmin');
            exit;
        }
        // Kiểm tra xem liệu form đã được submit
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            // Làm sạch và kiểm tra dữ liệu đầu vào
            $name = htmlspecialchars(strip_tags($_POST['name'] ?? ''));
            // Kiểm tra xác thực và phân quyền ở đây nếu cần

            // Thử tạo sản phẩm mới
            $result = $this->authorModel->createAuthor($name);

            if ($result['success']) {
                // Lưu thông báo thành công vào session
                $_SESSION['successMessage'] = $result['message'];
                // Chuyển hướng người dùng sau khi cập nhật thành công
                header('location: /phpbanhang/admin/createauthor');
                exit();
            } else {
                // Hiển thị trang tạo sản phẩm với thông báo lỗi
                $_SESSION['errorMessage'] = $result['message'];
                header('location: /phpbanhang/admin/createauthor');
            }
        }
    }
    public function updateauthor($id)
    {
        if (!SessionHelper::isAdmin() && !SessionHelper::isMod()) {
            header('Location: /phpbanhang/loginadmin');
            exit;
        }
        $author = $this->authorModel->getAuthorById($id);
        include_once 'app/views/admin/author/update.php';
    }
    public function saveupdateauthor($id)
    {
        if (!SessionHelper::isAdmin() && !SessionHelper::isMod()) {
            header('Location: /phpbanhang/loginadmin');
            exit;
        }
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $name = htmlspecialchars(strip_tags($_POST['name'] ?? ''));

            $result = $this->authorModel->updateAuthor($id, $name);

            if ($result['success']) {

                $_SESSION['successMessage'] = $result['message'];
                header('Location: /phpbanhang/admin/author');
                exit();
            } else {
                $_SESSION['errorMessage'] = $result['message'];
                header('Location: /phpbanhang/admin/updateauthor/'.$id);
            }
        }
    }
    public function deleteauthor($id)
    {
        if (!SessionHelper::isAdmin() && !SessionHelper::isMod()) {
            header('Location: /phpbanhang/loginadmin');
            exit;
        }
        $result = $this->authorModel->deleteAuthor($id);
        if ($result['success']) {

            $_SESSION['successMessage'] = $result['message'];
            header('Location: /phpbanhang/admin/author');
            exit();
        } else {

            $_SESSION['errorMessage'] = $result['message'];
            header('Location: /phpbanhang/admin/author');
            exit();
        }
    }
    public function category()
    {
        if (!SessionHelper::isAdmin() && !SessionHelper::isMod()) {
            header('Location: /phpbanhang/loginadmin');
            exit;
        }
        $limit = 10;
        $currentPage = isset($_GET['page']) ? $_GET['page'] : 1;

        $offset = ($currentPage - 1) * $limit;
        $totalCatogories = $this->categoryModel->getTotalCatogory();
        $totalPages = ceil($totalCatogories / $limit);
        $categories = $this->categoryModel->getCategoriesPage($limit, $offset);
        include_once 'app/views/admin/category/category.php';
    }
    public function createcategory()
    {
        if (!SessionHelper::isAdmin() && !SessionHelper::isMod()) {
            header('Location: /phpbanhang/loginadmin');
            exit;
        }
        include_once 'app/views/admin/category/create.php';
    }
    public function savecategory()
    {
        if (!SessionHelper::isAdmin() && !SessionHelper::isMod()) {
            header('Location: /phpbanhang/loginadmin');
            exit;
        }
        // Kiểm tra xem liệu form đã được submit
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            // Làm sạch và kiểm tra dữ liệu đầu vào
            $name = htmlspecialchars(strip_tags($_POST['name'] ?? ''));
            // Kiểm tra xác thực và phân quyền ở đây nếu cần

            // Thử tạo sản phẩm mới
            $result = $this->categoryModel->createCategory($name);

            if ($result['success']) {
                // Lưu thông báo thành công vào session
                $_SESSION['successMessage'] = $result['message'];
                // Chuyển hướng người dùng sau khi cập nhật thành công
                header('location: /phpbanhang/admin/createcategory');
                exit();
            } else {
                // Hiển thị trang tạo sản phẩm với thông báo lỗi
                $_SESSION['errorMessage'] = $result['message'];
                header('location: /phpbanhang/admin/createcategory');
            }
        }
    }
    public function updatecategory($id)
    {
        if (!SessionHelper::isAdmin() && !SessionHelper::isMod()) {
            header('Location: /phpbanhang/loginadmin');
            exit;
        }
        $category = $this->categoryModel->getCategoryById($id);
        include_once 'app/views/admin/category/update.php';
    }
    public function saveupdatecategory($id)
    {
        if (!SessionHelper::isAdmin() && !SessionHelper::isMod()) {
            header('Location: /phpbanhang/loginadmin');
            exit;
        }
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $name = htmlspecialchars(strip_tags($_POST['name'] ?? ''));
            $result = $this->categoryModel->updateCategory($id, $name);

            if ($result['success']) {

                $_SESSION['successMessage'] = $result['message'];
                header('Location: /phpbanhang/admin/category');
                exit();
            } else {
                $_SESSION['errorMessage'] = $result['message'];
                $category = $this->categoryModel->getCategoryById($id);
                header('location: /phpbanhang/admin/updatecategory/'.$id);
            }
        }
    }
    public function deletecatagory($id)
    {
        if (!SessionHelper::isAdmin() && !SessionHelper::isMod()) {
            header('Location: /phpbanhang/loginadmin');
            exit;
        }
        $result = $this->categoryModel->deleteCategory($id);
        if ($result['success']) {

            $_SESSION['successMessage'] = $result['message'];
            header('Location: /phpbanhang/admin/category');
            exit();
        } else {

            $_SESSION['errorMessage'] = $result['message'];
            header('Location: /phpbanhang/admin/category');
            exit();
        }
    }
    public function product()
    {
        if (!SessionHelper::isAdmin() && !SessionHelper::isMod()) {
            header('Location: /phpbanhang/loginadmin');
            exit;
        }
        $limit = 10;
        $currentPage = isset($_GET['page']) ? $_GET['page'] : 1;
        $offset = ($currentPage - 1) * $limit;
        $totalPropucts = $this->productsModel->getTotalProducts();
        $totalPages = ceil($totalPropucts / $limit);
        $products = $this->productsModel->getProducts($limit, $offset);
        include_once 'app/views/admin/product/product.php';
    }
    public function createproduct()
    {
        if (!SessionHelper::isAdmin() && !SessionHelper::isMod()) {
            header('Location: /phpbanhang/loginadmin');
            exit;
        }
        $authors = $this->authorModel->getAuthors();
        $categories = $this->categoryModel->getCategories();
        include_once 'app/views/admin/product/create.php';
    }
    public function saveproduct()
    {
        if (!SessionHelper::isAdmin() && !SessionHelper::isMod()) {
            header('Location: /phpbanhang/loginadmin');
            exit;
        }
        // Kiểm tra xem liệu form đã được submit
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            // Làm sạch và kiểm tra dữ liệu đầu vào
            $name = htmlspecialchars(strip_tags($_POST['name'] ?? ''));
            $price = htmlspecialchars(strip_tags($_POST['price'] ?? ''));
            $description = htmlspecialchars(strip_tags($_POST['description'] ?? ''));
            $createDate = date('Y-m-d H:i:s');
            $status = htmlspecialchars(strip_tags($_POST['status'] ?? ''));
            $id_author = htmlspecialchars(strip_tags($_POST['id_author'] ?? ''));
            $id_category = htmlspecialchars(strip_tags($_POST['id_category'] ?? ''));

            $image = $_FILES['image']['name'];
            $imageTemp = $_FILES['image']['tmp_name'];
            $uploadDirectory = 'public/images/products/' . $image;

            if (empty($image) || empty($imageTemp)) {
                $_SESSION['errorMessage'] = 'Vui lòng chọn ảnh';
                header('location: /phpbanhang/admin/createproduct');
            } else {
                if (file_exists($uploadDirectory)) {
                    $_SESSION['errorMessage'] = 'Tên ảnh đã tồn tại!';
                    header('location: /phpbanhang/admin/createproduct');
                } elseif (move_uploaded_file($imageTemp, $uploadDirectory)) {
                    $result = $this->productsModel->createProduct($name, $price, $image, $description, $createDate, $status, $id_author, $id_category);

                    if ($result['success']) {
                        $_SESSION['successMessage'] = $result['message'];
                        header('location: /phpbanhang/admin/createproduct');
                        exit();
                    } else {
                        $_SESSION['errorMessage'] = $result['message'];
                        header('location: /phpbanhang/admin/createproduct');
                    }
                } else {
                    $_SESSION['errorMessage'] = 'Lỗi tải lên ảnh!';
                    header('location: /phpbanhang/admin/createproduct');
                }
            }
        }
    }

    public function updateproduct($id)
    {
        if (!SessionHelper::isAdmin() && !SessionHelper::isMod()) {
            header('Location: /phpbanhang/loginadmin');
            exit;
        }
        $product = $this->productsModel->getProductById($id);
        $authors = $this->authorModel->getAuthors();
        $categories = $this->categoryModel->getCategories();
        include_once 'app/views/admin/product/update.php';
    }

    public function saveupdateproduct($id)
    {
        if (!SessionHelper::isAdmin() && !SessionHelper::isMod()) {
            header('Location: /phpbanhang/loginadmin');
            exit;
        }
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $name = htmlspecialchars(strip_tags($_POST['name'] ?? ''));
            $price = htmlspecialchars(strip_tags($_POST['price'] ?? ''));
            $description = htmlspecialchars(strip_tags($_POST['description'] ?? ''));
            $status = htmlspecialchars(strip_tags($_POST['status'] ?? ''));
            $id_author = htmlspecialchars(strip_tags($_POST['id_author'] ?? ''));
            $id_category = htmlspecialchars(strip_tags($_POST['id_category'] ?? ''));

            $image = $_FILES['image']['name'];
            $imageTemp = $_FILES['image']['tmp_name'];
            $uploadDirectory = 'public/images/products/' . $image;
            $allowedExtensions = ['jpg', 'jpeg', 'png', 'gif'];
            $imageExtension = strtolower(pathinfo($image, PATHINFO_EXTENSION));

            if (empty($image)) {
                $result =  $this->productsModel->updateProduct($id, $name, $image, $price, $description, $status, $id_author, $id_category);
                if ($result['success']) {
                    header('Location: /phpbanhang/admin/product');
                    exit();
                } else {
                    $_SESSION['errorMessage'] = $result['message'];
                    header('location: /phpbanhang/admin/updateproduct/'.$id);
                }
            } else {
                if (!in_array($imageExtension, $allowedExtensions)) {
                    $_SESSION['errorMessage'] = 'Chỉ cho phép tải lên các loại file ảnh (jpg, jpeg, png, gif)';
                    header('location: /phpbanhang/admin/updateproduct/'.$id);
                } elseif (file_exists($uploadDirectory)) {
                    $_SESSION['errorMessage'] = 'Tên ảnh đã tồn tại!';
                    header('location: /phpbanhang/admin/updateproduct/'.$id);
                } elseif (move_uploaded_file($imageTemp, $uploadDirectory)) {
                    $result =  $this->productsModel->updateProduct($id, $name, $image, $price, $description, $status, $id_author, $id_category);
                    if ($result['success']) {
                        header('Location: /phpbanhang/admin/product');
                        exit();
                    } else {
                        $_SESSION['errorMessage'] = $result['message'];
                        header('location: /phpbanhang/admin/updateproduct/'.$id);
                    }
                } else {
                    $_SESSION['errorMessage'] = 'Lỗi tải lên ảnh!';
                    header('location: /phpbanhang/admin/updateproduct/'.$id);
                }
            }
        }
    }

    public function deleteproduct($id)
    {
        if (!SessionHelper::isAdmin() && !SessionHelper::isMod()) {
            header('Location: /phpbanhang/loginadmin');
            exit;
        }
        $result = $this->productsModel->deleteProduct($id);
        if ($result['success']) {

            $_SESSION['successMessage'] = $result['message'];
            header('Location: /phpbanhang/admin/product');
            exit();
        } else {

            $_SESSION['errorMessage'] = $result['message'];
            header('Location: /phpbanhang/admin/product');
            exit();
        }
    }
    public function accountadmin()
    {
        if (!SessionHelper::isAdmin()) {
            header('Location: /phpbanhang/admin');
            exit;
        }
        $limit = 10;
        $currentPage = isset($_GET['page']) ? $_GET['page'] : 1;
        $offset = ($currentPage - 1) * $limit;
        $totalCatogories = $this->categoryModel->getTotalCatogory();
        $totalPages = ceil($totalCatogories / $limit);

        $admins = $this->adminModel->getAllAdmins($limit, $offset);
        include_once 'app/views/admin/accountadmin/account.php';
    }
    public function createadmin()
    {
        if (!SessionHelper::isAdmin()) {
            header('Location: /phpbanhang/admin');
            exit;
        }
        $roles = $this->roleModel->getAllRoles();
        include_once 'app/views/admin/accountadmin/create.php';
    }
    public function savecreateadmin()
    {
        if (!SessionHelper::isAdmin()) {
            header('Location: /phpbanhang/admin');
            exit;
        }
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $username = htmlspecialchars(strip_tags($_POST['username'] ?? ''));
            $password = htmlspecialchars(strip_tags($_POST['password'] ?? ''));
            $email = htmlspecialchars(strip_tags($_POST['email'] ?? ''));
            $id_role = htmlspecialchars(strip_tags($_POST['id_role'] ?? ''));

            $hashpassword = password_hash($password, PASSWORD_DEFAULT);


            $result = $this->adminModel->signin($username, $hashpassword, $email, $id_role);

            if ($result['success']) {
                $_SESSION['successMessage'] = $result['message'];
                header('location: /phpbanhang/admin/createadmin');
                exit();
            } else {
                $_SESSION['errorMessage'] = $result['message'];
                header('location: /phpbanhang/admin/createadmin');
            }
        }
    }
    public function updateadmin($id)
    {
        if (!SessionHelper::isAdmin()) {
            header('Location: /phpbanhang/admin');
            exit;
        }
        $admin = $this->adminModel->getAdminById($id);
        $roles = $this->roleModel->getAllRoles();
        include_once 'app/views/admin/accountadmin/update.php';
    }

    public function saveupdateadmin($id)
    {
        if (!SessionHelper::isAdmin()) {
            header('Location: /phpbanhang/admin');
            exit;
        }
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $id_role = htmlspecialchars(strip_tags($_POST['id_role'] ?? ''));

            $result = $this->adminModel->updateRoleAcount($id, $id_role);

            if ($result['success']) {

                $_SESSION['successMessage'] = $result['message'];
                header('Location: /phpbanhang/admin/accountadmin');
                exit();
            } else {
                $_SESSION['errorMessage'] = $result['message'];
                header('Location: /phpbanhang/admin/updateadmin/'.$id);
            }
        }
    }
    public function deleteadmin($id)
    {
        if (!SessionHelper::isAdmin()) {
            header('Location: /phpbanhang/admin');
            exit;
        }
        $result = $this->adminModel->deleteAccount($id);
        if ($result['success']) {
            $_SESSION['successMessage'] = $result['message'];
            header('Location: /phpbanhang/admin/accountadmin');
            exit();
        } else {
            $_SESSION['errorMessage'] = $result['message'];
            header('Location: /phpbanhang/admin/accountadmin');
            exit();
        }
    }
}
