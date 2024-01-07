<?php
use PHPUnit\Framework\TestCase;
use phpbanhang\app\controllers\UserController;
class LoginTest extends TestCase {
    public function testCheckLoginWithEmptyPassword() {
        $controller = $this->getMockBuilder(UserController::class)
            ->onlyMethods(['redirect'])
            ->getMock();

        $_POST['username'] = 'admin';
        $_POST['password'] = '';

        $controller->checkLogin();

        $this->expectOutputString('');
        $this->assertStringContainsString('Vui lòng điền mật khẩu!', $_SESSION['errorMessage']);
    }
}