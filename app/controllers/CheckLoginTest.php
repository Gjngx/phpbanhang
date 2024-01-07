<?php

use PHPUnit\Framework\TestCase;

class CheckLoginTest extends TestCase
{
    public function testCheckLoginMissingCredentials()
    {
        $username = '';
        $password = '';

        $userController = new UserController();  // Tạo một đối tượng của class UserController

        $expected = false;

        $actual = $userController->checkLogin($username, $password); // Gọi hàm checkLogin() thông qua đối tượng

        $this->assertEquals($expected, $actual);
    }
}
