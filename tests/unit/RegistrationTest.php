<?php
require 'processRegistration.php';
use PHPUnit\Framework\TestCase;

class RegistrationTest extends TestCase {

    // Test Case: Email is already registered
    public function testisEmailRegistered() {
        $_POST['firstname'] = 'John';
        $_POST['lastname'] = 'Doe';
        $_POST['mobilenumber'] = '1234567890';
        $_POST['email'] = 'john@example.com';
        $_POST['password'] = 'password';
        $_POST['addressline1'] = '123 Main St';
        $_POST['addressline2'] = 'Apt 101';
        $_POST['city'] = 'Anytown';
        $_POST['state'] = 'CA';
        $_POST['zipcode'] = '12345';

        
        // Create a mock for the DbOperations class
        $dboperationsMock = $this->getMockBuilder(DbOperations::class)
            ->disableOriginalConstructor()
            ->getMock();
        $dboperationsMock->expects($this->once())
            ->method('isEmailRegistered')
            ->with("john@example.com")
            ->willReturn(true);
            
        // Create a ProcessRegistration instance with the mock object
        $processRegistration = new ProcessRegistration($dboperationsMock);

        // Call the registerUser method
        $processRegistration->registerUser();
        
        // Assertions
        $this->assertEquals("The email is already registered. Please try another one", $_SESSION['error-message']);
    }
}