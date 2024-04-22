<?php
require 'process_login.php';
use PHPUnit\Framework\TestCase;

class LoginTest extends TestCase{

    // Method to initialize the test environment
    public function setUp(): void {
        parent::setUp();
        // Start or reset the session
        session_start();
        // Clear any existing session data
        $_SESSION = array();
    }

    // Method to clean up the test environment
    public function tearDown(): void {
        // Clean up the session
        session_unset();
        session_destroy();
        parent::tearDown();
    }

    // Test Case: Login attempt with an invalid email and valid password
    public function test_loginUser_InvalidEmail_ValidPassword(){
        $_POST['email'] = 'invalid@example.com'; // An email that is not registered
        $_POST['password'] = 'correctpassword'; // Assuming 'correctpassword' is the correct password

        // Create a mock for the DbOperations class
        $dboperationsMock = $this->getMockBuilder(DbOperations::class)
            ->disableOriginalConstructor()
            ->getMock();
        $dboperationsMock->expects($this->once())
            ->method('loginUser')
            ->with("invalid@example.com",md5('correctpassword'))
            ->willReturn(false);
            
        // Create a ProcessRegistration instance with the mock object
        $processlogin = new Process_login($dboperationsMock);

        // Call the registerUser method
        $processlogin->loginUser();
        
        // Assertions
        $this->assertEquals("This email is not registered", $_SESSION['error-message']);
    }


    // Test Case: Login attempt with an valid email and invalid password
    public function testLoginUserIncorrectPassword(){
        $_POST['email'] = 'valid@example.com'; // An email that is registered
        $_POST['password'] = 'incorrectpassword'; // Assuming 'incorrectpassword'

        // Create a mock for the DbOperations class
        $dboperationsMock = $this->getMockBuilder(DbOperations::class)
            ->disableOriginalConstructor()
            ->getMock();
        $dboperationsMock->expects($this->once())
            ->method('loginUser')
            ->with("valid@example.com",md5('incorrectpassword'))
            ->willReturn(array(
                'email' => 'valid@example.com',
                'password' => md5('correctpassword'), // Different password than provided
                'firstname' => 'John',
                'id' => 123
            ));

        // Create a ProcessRegistration instance with the mock object
        $processlogin = new Process_login($dboperationsMock);

        // Call the registerUser method
        $processlogin->loginUser();
        
        // Assertions
        $this->assertEquals("Incorect password", $_SESSION['error-message']);
    }


    // Test case for successful login with valid credentials
    public function test_loginUser_ValidCredentials() {
        // Mocking the Dboperations class
        $dboperationsMock = $this->getMockBuilder(Dboperations::class)
            ->disableOriginalConstructor()
            ->getMock();

        // Simulate a user with valid credentials
        $user = array(
            'email' => 'valid@example.com',
            'password' => md5('correct_password'), // Assuming password is hashed in the database
            'firstname' => 'John',
            'id' => 123
        );

        $dboperationsMock->expects($this->once())
            ->method('loginUser')
            ->with('valid@example.com', md5('correct_password'))
            ->willReturn($user);

        // Set POST data
        $_POST['email'] = 'valid@example.com'; // Valid email
        $_POST['password'] = 'correct_password'; // Correct password

        // Initialize Process_login with mocked Dboperations
        $processLogin = new Process_login($dboperationsMock);

        // Call the loginUser method
        $processLogin->loginUser();
        // Assertions
        // Assert that session variables are set correctly
        $this->assertEquals($user['email'], $_SESSION['email']);
        $this->assertEquals($user['firstname'], $_SESSION['firstname']);
        $this->assertEquals($user['id'], $_SESSION['id']);
        // Assert that there is no error message
        $this->assertArrayNotHasKey('error-message', $_SESSION);
    }
}
