<?php

use PHPUnit\Framework\TestCase;

class LoginTest extends TestCase {

    public function testCheckLoginWithEmptyCredentials() {
        $controller = $this->getMockBuilder(UserController::class)
            ->setConstructorArgs([$this->createMock(Database::class)]) // Mock Database class
            ->onlyMethods(['getAccountByUserName'])
            ->getMock();

        $_POST['username'] = '';
        $_POST['password'] = '';

        $controller->checkLogin();

        $this->assertEquals('Vui lòng điền đầy đủ thông tin!', $_SESSION['errorMessage']);
    }

    public function testCheckLoginWithInvalidCredentials() {
        $mockDatabase = $this->createMock(Database::class);
        $controller = $this->getMockBuilder(UserController::class)
            ->setConstructorArgs([$mockDatabase])
            ->onlyMethods(['getAccountByUserName'])
            ->getMock();

        $_POST['username'] = 'invalid_username';
        $_POST['password'] = 'invalid_password';

        $mockDatabase->expects($this->once())
            ->method('getAccountByUserName')
            ->willReturn(false);

        $controller->checkLogin();

        $this->assertEquals('Đăng nhập không thành công.', $_SESSION['errorMessage']);
    }


}