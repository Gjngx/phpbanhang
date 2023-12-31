Để xây dựng một ứng dụng bán hàng đơn giản theo mô hình MVC (Model-View-Controller) trong PHP, bạn có thể làm theo các bước sau:

1. **Tạo Cấu Trúc Thư Mục**: Một cấu trúc thư mục đơn giản cho mô hình MVC có thể như sau:
   ```
   /app
       /controllers
       /models
       /views
   /public
       /css
       /js
       /images
   /config
   .htaccess
   index.php
   ```

2. **Thiết Lập Router và .htaccess**: Sử dụng file `.htaccess` để viết lại URL, điều hướng mọi yêu cầu qua `index.php`. Trong `index.php`, bạn sẽ phân tích URL và gọi đến controller tương ứng.

3. **Tạo Models**: Models sẽ tương tác với cơ sở dữ liệu. Ví dụ, `ProductModel.php` có thể chứa các hàm để lấy thông tin sản phẩm từ cơ sở dữ liệu.

4. **Tạo Controllers**: Controllers sẽ xử lý logic nghiệp vụ. Ví dụ, `ProductController.php` sẽ xử lý các yêu cầu liên quan đến sản phẩm và gọi đến các model tương ứng.

5. **Tạo Views**: Views là các file PHP chứa HTML và sẽ được gọi bởi controllers để hiển thị giao diện người dùng. Ví dụ, `product_list.php` có thể hiển thị danh sách sản phẩm.

6. **Kết Nối CSDL và Tạo Config File**: Tạo một file cấu hình trong thư mục `/config` để quản lý thông tin kết nối cơ sở dữ liệu.

7. **Thiết Lập Session và Authentication**: Điều này quan trọng cho việc quản lý đăng nhập và bảo mật.

8. **Tạo Frontend**: Sử dụng HTML, CSS, và JavaScript để thiết kế giao diện người dùng trong thư mục `/public`.

9. **Testing và Debugging**: Kiểm tra ứng dụng của bạn trên nhiều trình duyệt và môi trường để đảm bảo nó hoạt động đúng cách.

10. **Deployment**: Cuối cùng, triển khai ứng dụng của bạn lên một máy chủ web.

Đây là một khung làm việc cơ bản và bạn có thể tùy chỉnh theo nhu cầu cụ thể của dự án. Nếu bạn mới làm quen với PHP và MVC, bạn cũng có thể xem xét sử dụng một framework sẵn có như Laravel hoặc CodeIgniter để bắt đầu nhanh chóng.

#CONTINUE

### 1. .htaccess
Để điều hướng tất cả các yêu cầu qua `index.php`:
```apache
RewriteEngine On
RewriteCond %{REQUEST_FILENAME} !-f
RewriteCond %{REQUEST_FILENAME} !-d
RewriteRule ^(.*)$ index.php?url=$1 [QSA,L]
```

### 2. index.php
Đây là điểm nhập chính:
```php
<?php
require_once 'config/database.php';
require_once 'app/controllers/ProductController.php';
require_once 'app/controllers/UserController.php';
// Yêu cầu thêm các file cần thiết khác

$url = $_GET['url'] ?? '';
$url = rtrim($url, '/');
$url = filter_var($url, FILTER_SANITIZE_URL);
$url = explode('/', $url);

// Kiểm tra phần đầu tiên của URL để xác định controller
$controllerName = isset($url[0]) && $url[0] != '' ? ucfirst($url[0]) . 'Controller' : 'DefaultController';

// Kiểm tra phần thứ hai của URL để xác định action
$action = isset($url[1]) && $url[1] != '' ? $url[1] : 'index';

// Kiểm tra xem controller và action có tồn tại không
if (!file_exists('app/controllers/' . $controllerName . '.php')) {
    // Xử lý không tìm thấy controller
    die('Controller not found');
}

require_once 'app/controllers/' . $controllerName . '.php';

$controller = new $controllerName();

if (!method_exists($controller, $action)) {
    // Xử lý không tìm thấy action
    die('Action not found');
}

// Gọi action với các tham số còn lại (nếu có)
call_user_func_array([$controller, $action], array_slice($url, 2));

```

### 3. /config/database.php
Kết nối CSDL:
```php
<?php
class Database {
    private $host = "localhost";
    private $db_name = "your_db_name";
    private $username = "your_username";
    private $password = "your_password";
    public $conn;

    public function getConnection() {
        $this->conn = null;

        try {
            $this->conn = new PDO("mysql:host=" . $this->host . ";dbname=" . $this->db_name, $this->username, $this->password);
            $this->conn->exec("set names utf8");
        } catch(PDOException $exception) {
            echo "Connection error: " . $exception->getMessage();
        }

        return $this->conn;
    }
}
```

### 4. /app/models/ProductModel.php
Mô hình cho sản phẩm:
```php
<?php
class ProductModel {
    private $conn;
    private $table_name = "products";

    public function __construct($db) {
        $this->conn = $db;
    }

    function readAll() {
        $query = "SELECT id, name, description, price FROM " . $this->table_name;

        $stmt = $this->conn->prepare($query);
        $stmt->execute();

        return $stmt;
    }
}
```

### 5. /app/controllers/ProductController.php
Controller cho sản phẩm:
```php
<?php
class ProductController {
    public function listProducts() {
        $database = new Database();
        $db = $database->getConnection();

        $product = new ProductModel($db);
        $stmt = $product->readAll();

        include_once 'app/views/product_list.php';
    }
}
```

### 6. /app/views/product_list.php
View hiển thị danh sách sản phẩm:
```php
<!DOCTYPE html>
<html>
<head>
    <title>Danh sách sản phẩm</title>
</head>
<body>
    <h1>Danh sách sản phẩm</h1>
    <ul>
    <?php while ($row = $stmt->fetch(PDO::FETCH_ASSOC)): ?>
        <li>
            <?php echo $row['name'] . " - " . $row['description'] . " - " . $row['price']; ?>
        </li>
    <?php endwhile; ?>
    </ul>
</body>
</html>
```

#CONTINUE 
Xây dựng một hệ thống CRUD (Create, Read, Update, Delete) đầy đủ cho sản phẩm với tính năng xác thực và vai trò admin trong PHP MVC là một tác vụ lớn, nhưng tôi có thể cung cấp một bản tóm tắt và một số đoạn code mẫu để bạn bắt đầu. Để đơn giản hóa, tôi sẽ giả định rằng bạn đã có cơ sở dữ liệu và bảng `products` (với các cột `id`, `name`, `description`, `price`) và bảng `users` (với các cột `id`, `username`, `password`, `role`).

### 1. Authentication và Role Checking

Đầu tiên, bạn cần một hệ thống xác thực người dùng và kiểm tra vai trò. Điều này có thể được thực hiện thông qua một session PHP.

**/app/helpers/SessionHelper.php**
```php
<?php
session_start();

class SessionHelper {
    public static function isLoggedIn() {
        return isset($_SESSION['user_id']);
    }

    public static function isAdmin() {
        return isset($_SESSION['user_role']) && $_SESSION['user_role'] === 'admin';
    }
}
```

### 2. ProductController Update

Bây giờ, cập nhật `ProductController` để bao gồm các hành động CRUD và kiểm tra quyền admin cho các hành động nhất định.

**/app/controllers/ProductController.php**
```php
<?php
// Require SessionHelper and other necessary files

class ProductController {
    private $productModel;
    private $db;

    public function __construct() {
        $this->db = (new Database())->getConnection();
        $this->productModel = new ProductModel($this->db);
    }

    public function listProducts() {
        $products = $this->productModel->getProducts();
        include_once 'app/views/products/list.php';
    }

    public function createProduct() {
        if (!SessionHelper::isAdmin()) {
            header('Location: login.php');
            exit;
        }
        // Xử lý tạo sản phẩm
    }

    public function updateProduct($id) {
        if (!SessionHelper::isAdmin()) {
            header('Location: login.php');
            exit;
        }
        // Xử lý cập nhật sản phẩm
    }

    public function deleteProduct($id) {
        if (!SessionHelper::isAdmin()) {
            header('Location: login.php');
            exit;
        }
        // Xử lý xóa sản phẩm
    }
}
```

### 3. Cập nhật Model

Cập nhật `ProductModel` để bao gồm các phương thức cho CRUD.

**/app/models/ProductModel.php**
```php
<?php
class ProductModel {
    private $conn;

    public function __construct($db) {
        $this->conn = $db;
    }

    public function getProducts() {
        // Truy vấn lấy tất cả sản phẩm
    }

    public function createProduct($name, $description, $price) {
        // Truy vấn tạo sản phẩm mới
    }

    public function updateProduct($id, $name, $description, $price) {
        // Truy vấn cập nhật sản phẩm
    }

    public function deleteProduct($id) {
        // Truy vấn xóa sản phẩm
    }
}
```

### 4. Views

Tạo các file view tương ứng trong `/app/views/products/` cho các hành động như `list`, `create`, `edit`, và `delete`.

### 5. User Authentication

Cuối cùng, bạn cần một cách để xác thực người dùng. Điều này thường bao gồm việc tạo một trang đăng nhập, xác minh thông tin người dùng từ cơ sở dữ liệu, và thiết lập session.

**/app/controllers/UserController.php**
```php
<?php
class UserController {
    private $userModel;

    public function __construct() {
        $this->db = (new Database())->getConnection();
        $this->userModel = new UserModel($this->db);
    }

        public function login() {
        // Kiểm tra nếu form đăng nhập đã được submit
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $username = $_POST['username'];
            $password = $_POST['password'];

            // Xác thực người dùng từ cơ sở dữ liệu
            $user = $this->userModel->getUserByUsername($username);

            if ($user && password_verify($password, $user['password'])) {
                // Thiết lập session
                $_SESSION['user_id'] = $user['id'];
                $_SESSION['user_role'] = $user['role'];

                // Chuyển hướng người dùng tới trang chủ hoặc dashboard
                header('Location: index.php');
                exit;
            } else {
                // Hiển thị thông báo lỗi
                $error = "Sai thông tin đăng nhập!";
            }
        }

        // Hiển thị form đăng nhập
        include_once 'app/views/users/login.php';
    }

    public function logout() {
        // Hủy tất cả các session
        session_destroy();

        // Chuyển hướng người dùng về trang đăng nhập
        header('Location: login.php');
        exit;
    }
}

```
