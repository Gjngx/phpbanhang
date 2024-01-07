<?php
require_once('config/database.php');
require_once('app/models/UserModel.php');
require_once('app/controllers/UserController.php');

use PHPUnit\Event\Test\Failed;
use PHPUnit\Framework\TestCase;

class CheckLoginTest extends TestCase
{
    public function testCheckLoginMissingCredentials()
    {
        $username = '';
        $password = '';

        $userController = new UserController();

        $expected = false;

        $actual = $userController->checkLogin($username, $password); 

        $this->assertEquals($expected, $actual);
    }
    public function testCheckLogin()
    {
        $username = 'aa';
        $password = '11';

        $userController = new UserController();

        $expected = false;

        $actual = $userController->checkLogin($username, $password); 

        $this->assertEquals($expected, $actual);
    }
}
