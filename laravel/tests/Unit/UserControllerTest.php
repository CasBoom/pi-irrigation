<?php
namespace TDD\tests;

use PHPUnit\Framework\TestCase;
use App\Http\Controllers\UserController;

class TestUserController extends TestCase{
    function setUp(): void{
        $this->userController = new UserController;
    }

    function tearDown(): void{
        unset($this->userController);
    }

    /**
     * @dataProvider provideValidatePassword
     */
    function testValidatePassword($password, $conf, $expected){
        $this->assertEquals( $expected, $this->userController->validatePassword($password, $conf)['error']);
    }

    function provideValidatePassword(){
        return [
                ['test', 'test', 'Password must be at least 6 characters long'],
                ['tester', 'tester','Password must contain a number'],
                ['tester1', 'tester','Your passwords don\'t match'],
                ['tester1', 'tester1','']
        ];
    }
}
