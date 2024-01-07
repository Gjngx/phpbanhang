<?php
require_once('config/database.php');
require_once('app/models/UserModel.php');
require_once('app/controllers/UserController.php');

use PHPUnit\Framework\TestCase;

class UserControllerTest extends TestCase
{
    // Mocked user model to be injected into UserController
    private $userModel;

    protected function setUp(): void
    {
        // Create a mock for UserModel
        $this->userModel = $this->getMockBuilder(UserModel::class)
            ->disableOriginalConstructor()
            ->getMock();
    }

    // public function testCheckLoginSuccessful()
    // {
    //     $controller = new UserController();
    //     $controller->setUserModel($this->userModel);

    //     // Mock input data
    //     $_SERVER['REQUEST_METHOD'] = 'POST';
    //     $_POST['username'] = 'testuser';
    //     $_POST['password'] = 'testpassword';

    //     // Mock the expected behavior of the UserModel
    //     $this->userModel->expects($this->once())
    //         ->method('getAccountByUserName')
    //         ->with('testuser')
    //         ->willReturn((object)['id' => 1, 'username' => 'testuser', 'password' => password_hash('testpassword', PASSWORD_DEFAULT)]);

    //     // Start session
    //     session_start();

    //     // Call the method to test
    //     $controller->checkLogin();

    //     // Assert session variables are set and the user is redirected
    //     $this->assertEquals(1, $_SESSION['customer_id']);
    //     $this->assertEquals('testuser', $_SESSION['customer_username']);
    //     $this->assertStringContainsString('/phpbanhang/', headers_sent()[0]);
    // }

    // public function testCheckLoginUnsuccessful()
    // {
    //     $controller = new UserController();
    //     $controller->setUserModel($this->userModel);

    //     // Mock input data
    //     $_SERVER['REQUEST_METHOD'] = 'POST';
    //     $_POST['username'] = 'testuser';
    //     $_POST['password'] = 'wrongpassword';

    //     // Mock the expected behavior of the UserModel
    //     $this->userModel->expects($this->once())
    //         ->method('getAccountByUserName')
    //         ->with('testuser')
    //         ->willReturn(null);

    //     // Start session
    //     session_start();

    //     // Call the method to test
    //     $controller->checkLogin();

    //     // Assert session variable is not set and the user is redirected
    //     $this->assertArrayNotHasKey('customer_id', $_SESSION);
    //     $this->assertArrayNotHasKey('customer_username', $_SESSION);
    //     $this->assertStringContainsString('/phpbanhang/user/login', headers_sent()[0]);
    // }

    public function testCheckLoginWithEmptyCredentials()
    {
        $controller = new UserController();
        $controller->setUserModel($this->userModel);

        // $_SERVER['REQUEST_METHOD'] = 'POST';
        $username = '';
        $password = '';

        $controller->checkLoginTest($username, $password);

        $this->assertEquals('Vui lòng điền đầy đủ thông tin!', $_SESSION['errorMessage']);
    }
}
